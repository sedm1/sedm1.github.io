<?


function sql_result( $query )
{
  $result = mysql_query( $query ) or trigger_error(mysql_error().' in '.$query );
  if( $result === false )
  {
    sql_error( mysql_error()."\n".$query );
    return false ;
  }
  return $result;
}


function sql_fetch_result( $result, $mode = MYSQLI_ASSOC )
{
  return $result ? mysql_fetch_array( $result, $mode ) : false ;
}

function sql_fetch_query( $query )
{
  return sql_fetch_result( sql_result( $query ) );
}


//+ get int after SQL_CALC_FOUND_ROWS
function sql_calc_rows()
{
  $c = mysql_fetch_row( sql_result( "SELECT FOUND_ROWS()" ) );
  return $c[0];
}


function sql_num_rows( $result )
{
  return mysql_num_rows( $result );
}


//+ get result insert
function sql_insert( $table, $data )
{
  $i = sql_data_for_insert( $data );
  $s = "INSERT INTO `".$table."` (".$i['FN'].") VALUES (".$i['FV'].")";
  sql_result( $s );
  return sql_insert_id();
}


function sql_update_id( $table, $data, $id )
{
  return sql_result( "UPDATE `".$table."` SET ".sql_data_for_update( $data )." WHERE `id`=".(int)$id );
}


function sql_update_any( $table, $data_update, $data_where, $l = 0 )
{
  if( !is_array( $data_where ) )
    return false;

  return sql_result( "UPDATE `".$table."` SET ".sql_data_for_update( $data_update )." WHERE ".sql_data_for_where( $data_where ).( $l == 1 ? " LIMIT 1" : '' ) );
}


function sql_delete_id( $table, $id )
{
  return sql_result( "DELETE FROM `".$table."` WHERE `id`=".(int)$id );
}


function sql_delete_any( $table, $data_where )
{
  if( !is_array( $data_where ) )
    return false;
  return sql_result( "DELETE FROM `".$table."` WHERE ".sql_data_for_where( $data_where ) );
}


function sql_insert_id()
{
  return mysql_insert_id();
}


function sql_escape( $str )
{
  return mysql_real_escape_string( $str ) ;
}

function sql_data_for_insert( $data )
{
  $fn = ''; // имена полей (field name)
  $fv = ''; // значения полей (field var)
  foreach( $data as $n => $v )
  {
    $fn .= ( $fn == '' ? '' : ', ' ).'`'.$n.'`';
    $fv .= ( $fv == '' ? '' : ', ' )."'".sql_escape( $v )."'";
  }
  return array( 'FN' => $fn, 'FV' => $fv );
}

//+ data for update
function sql_data_for_update( $data_update )
{
  $o = '';
  foreach( $data_update as $n => $v )
    $o .= ( $o == '' ? '' : ', ' )."`".sql_escape( $n )."`='".sql_escape( $v )."'";
  return $o;
}

function sql_data_for_where( $data_where )
{
  $o = '';
  foreach( $data_where as $n => $v )
    $o .= ( $o == '' ? '' : ' AND ' )."`".sql_escape( $n )."`='".sql_escape( $v )."'";
  return $o ;
}


function sql_error( $error )
{
  if( $error == 'MySQL server has gone away' )
    return false;

  if( strpos( $error, "Can't connect to local MySQL server through socket" ) !== false )
    return false;

  die( $error );
}