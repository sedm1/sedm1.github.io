<?php
header('Content-Type: application/octet-stream');
error_reporting(E_ERROR | E_PARSE);
$data = 'OK:';

function err( $error )
{
  die("err: $error");
}

function myerr( $err, $conn, $code_override )
{
  $e = mysqli_error( $conn );
  if( $e == '' ) $e = $err;
  if( $e == '' ) $e = 'unknown mysql error';
  $c = $code_override;
  if( !$c) $c = mysqli_errno( $conn );
  if( $c ) $e = $c."#".$e;
  mysqli_free_result( mysqli_query( $conn,'ROLLBACK' ) ); 
  err( $e );
}

function pgerr( $err )
{
  $e = pg_last_error();
  if( $e == '' ) $e = $err;
  if( $e == '' ) $e = 'unknown pgsql error';
  pg_free_result( pg_query( 'ROLLBACK' ) );
  err( $e );
}


function dump( $val )
{
  global $data;
  $len = strlen($val);
  if( $len < 255 )
    $data .= chr($len);
  else
    $data .= "\xFF".pack('V',$len);
  $data .= $val;
  if( strlen($data) > 100000 ) {
    echo $data;
    $data = '';    
  }

}

if( !array_key_exists('server',$_POST) ) {
   header('Content-Type: text/html');
   echo "<html><head><title>EmsProxy v2.2</title></head><body><h1>EmsProxy v2.2</h1>emsproxy.php script is installed correctly.</body></html>";
   exit;
}


array_key_exists('server',$_POST) and array_key_exists('host',$_POST) and array_key_exists('port',$_POST) and array_key_exists('user',$_POST) and array_key_exists('password',$_POST) and array_key_exists('dbname',$_POST) or err("malformed request");

if( get_magic_quotes_gpc() ) 
  foreach( $_POST as $key => $value ) 
    $_POST[$key] = stripslashes($value);


$commit = array_key_exists('commit',$_POST);

if( $_POST['server'] == 'mysql' ) {

  $port = $socket = $_POST['port'];
  $host = $_POST['host'];
  if( is_numeric($port) ) 
    $socket = null;
  else {
    if (substr($socket, 0, 1) != '/') {
      $socket = "\\\\.\\pipe\\$socket";
      $host = '.';
    } else
      $host = 'localhost';
    $port = null;
  }
  
  $conn = mysqli_connect($host, $_POST['user'],$_POST['password'], null, $port, $socket) or myerr(mysqli_connect_error(), $conn, mysqli_connect_errno());
  if( $_POST['dbname'] != '' )
    mysqli_select_db( $conn, $_POST['dbname'] ) or myerr('database not found', $conn, null);
  if( array_key_exists('charset',$_POST) && $_POST['charset'] != '' )
    mysqli_query( $conn, '/*!40101 SET NAMES \'' . $_POST['charset'] . '\' */' ) or myerr('can not set character set', $conn, null);
  $result = FALSE;
  mysqli_free_result( mysqli_query( $conn,'BEGIN' ) );
  for( $rn = 1; $rn < 1000; ++$rn ) {
    if( !array_key_exists( 'r'.$rn, $_POST ) )
      break;
    $data = 'OK:';
    $req = $_POST['r'.$rn];
    if( $req == 'connect' ) {
      dump( mysqli_get_server_info( $conn ) );
      dump( mysqli_get_client_info($conn ) );
      dump( mysqli_get_proto_info( $conn ) );
      dump( mysqli_get_host_info( $conn ) );
    } else {
      $result = mysqli_query($conn, $req) or myerr('unknown query execution error', $conn, null);
      if( $result === TRUE ) {
        dump( 0 );
        dump( mysqli_affected_rows( $conn ) );
      } else {
        $width = mysqli_num_fields($result);
        $height = mysqli_num_rows($result);
        dump($width);
        dump($height);
        for( $i = 0; $i < $width; ++$i ) {
      $properties = mysqli_fetch_field_direct($result, $i);
          dump( $properties->name );
          dump( $properties->type );
          dump( $properties->flags );
          dump( $properties->length );
        }
        for( $i = 0; $i < $height; ++$i ) {
          $row = mysqli_fetch_row( $result );
          for( $j = 0; $j < $width; ++$j ) 
            if( is_null($row[$j]) ) 
              dump( '' );
            else
              dump( ' '.$row[$j] );
        }
        mysqli_free_result( $result );
      }
    }
  }
  mysqli_free_result( mysqli_query( $conn, $commit ? 'COMMIT' : 'ROLLBACK' ) );

} elseif( $_POST['server'] == 'pgsql' ) {

  $conn = '';
  if( $_POST['host'] != '' ) $conn .= "host=$_POST[host]";
  if( $_POST['port'] != '' ) $conn .= " port=$_POST[port]";
  if( $_POST['dbname'] != '' ) $conn .= " dbname=$_POST[dbname]";
  if( $_POST['user'] != '' ) $conn .= " user=$_POST[user]";
  if( $_POST['password'] != '' ) $conn .= " password=$_POST[password]";
  $conn = pg_connect( $conn ) || pgerr('some connection error');

  if( !$commit || array_key_exists( 'r2', $_POST ) ) 
    pg_free_result( pg_query( 'BEGIN' ) );
  $result = FALSE;
  for( $rn = 1; $rn < 1000; ++$rn ) {
    if( !array_key_exists( 'r'.$rn, $_POST ) )
      break;
    $data = 'OK:';
    $req = $_POST['r'.$rn];
    if( $req == 'connect' ) {
      dump( 0 );
      dump( 0 );
      dump( 0 );
    } elseif( substr($req,0,11) == 'blob_create' ) {
      list($oid) = sscanf( $req, 'blob_create %u' );
      pg_free_result( pg_query( $commit ? 'COMMIT' : 'ROLLBACK' ) );
      pg_free_result( pg_query( 'BEGIN' ) );
      $oid = pg_lo_create() or pgerr('lo_create failed');
      pg_free_result( pg_query( 'COMMIT' ) );
      pg_free_result( pg_query( 'BEGIN' ) );
      dump($oid);
    } elseif( substr($req,0,11) == 'blob_delete' ) {
      list($oid) = sscanf( $req, 'blob_delete %u' );
      $oid = pg_lo_unlink($oid) or pgerr('lo_unlink failed');
    } elseif( substr($req,0,10) == 'blob_write' ) {
      list($oid) = sscanf( $req, 'blob_write %s ' );
      $bin = substr($req,12+strlen($oid));
      $obj = pg_lo_open($oid,'w') or pgerr( 'lo_open failed' );
      $res = pg_lo_write($obj,$bin) or pgerr( 'lo_write failed' );
      pg_lo_close($obj);
      dump($res);
    } elseif( substr($req,0,9) == 'blob_read' ) {
      list($oid) = sscanf( $req, 'blob_read %u' );
      $obj = pg_lo_open($oid,'r') or pgerr( 'lo_open failed' );
      pg_lo_seek($obj,0,PGSQL_SEEK_END);
      $len = pg_lo_tell($obj);
      pg_lo_seek($obj,0,PGSQL_SEEK_SET);
      $res = pg_lo_read($obj,$len) or pgerr( 'lo_read failed' );
      pg_lo_close($obj);
      dump($res);
    } else {
      $result = pg_query($req) or pgerr("error at request: $req");
      if( pg_result_status($result) == PGSQL_COMMAND_OK ) {
        dump( 0 );
        dump( pg_affected_rows($result) );
        dump( pg_last_oid($result) );
        pg_free_result($result);
      } elseif( pg_result_status($result) == PGSQL_EMPTY_QUERY ) {
        dump( 0 );
        dump( 0 );
        pg_free_result($result);
      } elseif( pg_result_status($result) == PGSQL_TUPLES_OK ) {
        $width = pg_num_fields($result);
        $height = pg_num_rows($result);
        dump($width);
        dump($height);
        for( $i = 0; $i < $width; ++$i ) {
          $type = pg_field_type( $result, $i );
          dump( pg_field_name( $result, $i ) );
          dump( $type );
          dump( pg_field_size( $result, $i ) );
        }
        for( $i = 0; $i < $height; ++$i ) {
          $row = pg_fetch_row( $result );
          for( $j = 0; $j < $width; ++$j ) 
            if( is_null($row[$j]) ) 
              dump( '' );
            else
              dump( ' '.$row[$j] );
        }
        pg_free_result( $result );
      } else {
        $e = pg_result_error($result);
        pg_free_result($result);
        err( $e );
      }
    }
  }
  pg_free_result( pg_query( $commit ? 'COMMIT' : 'ROLLBACK' ) );

} else {
  err("server type '$_POST[server] is not supported");
}
if( $data != '' ) echo $data;
?>