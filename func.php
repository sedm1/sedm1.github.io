<?php



function sendJson( $d )
{
  echo json_encode( $d, JSON_FORCE_OBJECT);
  die();
}


//+ сообщение об ошибке или удаче
function setAlert( $text, $type = 'mes')
  /*
    $t - текст сообщения
    $m - тип сообщения 'err' - ошибка, 'mes' - просто сообщение
  */
{
  if( $text == '' )
    return;
  if( !isset( $_SESSION['alert'] ) )
    $_SESSION['alert'] = array();
  $_SESSION['alert'][$type][] = $text;
}
//- сообщение об ошибке или удаче


//+ сообщение об ошибке
function setError( $text )
{
  setAlert( $text, 'err' );
}

function noError()
{
  return !( isset( $_SESSION['alert'] ) && isset( $_SESSION['alert']['err'] ) );
}

function htmlAlert()
{
  if( !isset( $_SESSION['alert'] ) )
    return '';
  $o = '';
  foreach( $_SESSION['alert'] as $type_name => $type_error )
  {
    foreach( $type_error as $alert )
      $o .= '<div class="alert-'.$type_name.'">'.$alert.'</div>';
  }
  unset( $_SESSION['alert'] );
  return '<div class="alert">'.$o.'</div>';
}

function redirect( $url = '', $alert = '', $type = 'err' )
{
  if( $url == '' )
    $url = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : BASE_URL;
  if( $alert != '' )
    setAlert( $alert , $type ) ;
  header( 'Location: '.$url );
  die();
}


function getFileError( $error )
{
  switch( $error)
  {
    case 1:
    case 2:
      return 'Превышен размер загружаемого файла.';
    case 3:
      return 'Файл был получен только частично.';
    case 4:
      return 'Файл не был загружен.';
    case 6:
      return 'Файл не загружен - отсутствует временная директория.';
    case 7:
      return 'Не удалось записать файл на диск.';
    case 8:
      return 'PHP-расширение остановило загрузку файла.';
    case 9:
      return 'Файл не был загружен - директория не существует.';
    case 10:
      return 'Превышен максимально допустимый размер файла.';
    case 11:
      return 'Данный тип файла запрещен.';
    case 12:
      return 'Ошибка при копировании файла.';
    default:
      return 'Файл не был загружен - неизвестная ошибка.';
  }
}


function getTransliterate( $str )
{
  // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
  // Сделаем их транслит:
  $converter = array
  (
    'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

    'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
    'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
    'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
    'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
    'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
    'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
  );
  return strtr( $str, $converter );
}


function data4www( $str, $br = '<br>' )
{
  if( get_magic_quotes_gpc() )
    $str = stripslashes( $str );
  $str = htmlspecialchars( $str, ENT_QUOTES );
  $str = str_replace( "\r" , ''  , $str );
  $str = str_replace( "\n" , $br , $str );
  return $str;
}


//+ установка папки для картинки по текущей дате
function getFileDir( $dir )
{
  $folder_y = date( 'Y' );
  $folder_m = date( 'm' );
  $folder_d = date( 'd' );
  if( !is_dir( $dir.$folder_y.'/' ) )
    mkdir( $dir.$folder_y.'/' ) ;
  if( !is_dir( $dir.$folder_y.'/'.$folder_m.'/' ) )
    mkdir( $dir.$folder_y.'/'.$folder_m.'/' ) ;
  if( !is_dir( $dir.$folder_y.'/'.$folder_m.'/'.$folder_d.'/' ) )
    mkdir( $dir.$folder_y.'/'.$folder_m.'/'.$folder_d.'/' ) ;
  return $folder_y.'/'.$folder_m.'/'.$folder_d.'/' ;
}
//- установка папки для картинки по текущей дате

?>