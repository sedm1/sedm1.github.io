<?php


include_once 'init.php';


// Обработка полей формы
if( !isset( $_POST['name'] ) || !is_string( $_POST['name'] ) || ( $name = trim( $_POST['name'] ) ) == '' )
  sendJson( array( 'msg' => '<div style="text-align:right; color:red;">Укажите ваше имя '.$_POST['name'].'</div>' ) );

if( !isset( $_POST['comm'] ) || !is_string( $_POST['comm'] ) || ( $comm = trim( $_POST['comm'] ) ) == '' )
  sendJson( array( 'msg' => '<div style="text-align:right; color:red;">Введите текст сообщения</div>' ) );

if( !isset( $_POST['prod_id'] ) || ( $prod_id = (int)$_POST['prod_id'] ) == 0 )
  sendJson( array( 'msg' => '<div style="text-align:right; color:red;">Не указан номер артикула</div>' ) );

$rate = isset( $_POST['rating'] ) ? (int)$_POST['rating'] : 5;
if( !in_array( $rate, array( 1,2,3,4,5 ) ) )
  $rate = 5;


$nd_review = array
(
  'prod_id' => $prod_id,
  'name' => $name,
  'text' => $comm,
  'rate' => $rate,
  'status' => 1,
  'time_send' => time(),
  'time_pub' => time(),
);
$review_id = sql_insert( 'reviews', $nd_review );


//+ загружаем файлы

// Название <input type="file">
$input_name = 'file';

// Разрешенные расширения файлов.
$allow = array('jpg','png','jpeg');

// Запрещенные расширения файлов.
$deny = array(
  'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
  'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
  'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
);

// Директория куда будут загружаться файлы.
$dir = __DIR__.'/usersfiles/';
$dir_file = getFileDir( $dir );
$path = $dir.$dir_file;


$file_alert = '';
if( isset( $_FILES[$input_name] ) )
{
  // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
  $files = array();
  $diff = count( $_FILES[$input_name] ) - count( $_FILES[$input_name], COUNT_RECURSIVE );
  if( $diff == 0 )
    $files = array( $_FILES[$input_name] );
  else
  {
    foreach( $_FILES[$input_name] as $k => $l )
      foreach( $l as $i => $v )
        $files[$i][$k] = $v;
  }

  foreach( $files as $file )
  {
    //sendJson( array( 'msg' => $file ) );

    // Проверим на ошибки загрузки.
    if( !empty( $file['error'] ) || empty( $file['tmp_name'] ) )
    {
      $file_alert .= '<div style="text-align:right; color:red;">'.getFileError( $file['error'] ).'</div>';
    }
    else if( $file['tmp_name'] == 'none' || !is_uploaded_file( $file['tmp_name'] ) )
    {
      $file_alert .= '<div style="text-align:right; color:red;">Не удалось загрузить файл.</div>';
    }
    else
    {
      // Оставляем в имени файла только буквы, цифры и некоторые символы.
      $file_name_src = $file['name'];
      $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
      $name = mb_eregi_replace( $pattern, '-', $file['name'] );
      // убираем повторяющияся -
      $name = mb_ereg_replace( '[-]+', '-', $name );
      $name = getTransliterate( $name );
      $parts = pathinfo( $name );

      if( empty( $name ) || empty( $parts['extension'] ) )
      {
        $file_alert .= '<div style="text-align:right; color:red;">Недопустимое имя файла.</div>';
      }
      else if( !empty( $allow ) && !in_array( strtolower( $parts['extension'] ), $allow ) )
      {
        $file_alert .= '<div style="text-align:right; color:red;">Недопустимый разрешёный тип файла.</div>';
      }
      else if( !empty( $deny ) && in_array( strtolower( $parts['extension'] ), $deny ) )
      {
        $file_alert .= '<div style="text-align:right; color:red;">Недопустимый запрещённый тип файла.</div>';
      }
      else
      {
        // Чтобы не затереть файл с таким же названием, добавим префикс.
        $i = 0;
        $prefix = '';
        while( is_file( $path.$parts['filename'].$prefix.'.'.$parts['extension'] ) )
          $prefix = '('.++$i.')';
        $name = $parts['filename'].$prefix.'.'.$parts['extension'];

        // Перемещаем файл в директорию.
        if( move_uploaded_file( $file['tmp_name'], $path.$name ) )
        {
          $nd_file = array
          (
            'review_id' => $review_id,
            'prod_id' => $prod_id,
            'file_name' => $dir_file.$name,
            'time' => time(),
          );
          sql_insert( 'reviews_images', $nd_file );
          sql_result( "UPDATE reviews SET images=images+1 WHERE id=".$review_id );

          $file_alert .= '<div style="text-align:right; color: green">Файл «'.data4www( $file_name_src ).'» успешно загружен.</div>';
        }
        else
        {
          $file_alert .= '<div style="text-align:right; color:red;">Не удалось загрузить файл.</div>';
        }
      }
    }
  }
}

sendJson( array( 'msg' => '<div style="text-align:right; color:green;">Спасибо, Ваш отзыв отправлен.</div>'.$file_alert, 'ok' => true ) );

?>