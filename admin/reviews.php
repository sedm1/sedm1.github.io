<?php


require_once 'lock.php';


$dir_images = __DIR__.'/../usersfiles/';
$url_images = '/usersfiles/';


//+ удаление отзыва
if( isset( $_POST['del_review'] ) )
{
  if( !isset( $_POST['id'] ) || !( $review = sql_fetch_query( "SELECT * FROM `reviews` WHERE `id`=".(int)$_POST['id'] ) ) )
    redirect( '/admin/reviews.php', 'Отзыв не найден', 'err' );

  $result = sql_delete_id( 'reviews', $review['id'] );

  //Удаление всех изображений товара
  if( $review['images'] > 0 )
  {
    $images_res = sql_result( "SELECT * FROM `reviews_images` WHERE `review_id`=".$review['id'] );
    while( $image = sql_fetch_result( $images_res ) )
    {
      if( is_file( $dir_images.$image['file_name'] ) )
        unlink( $dir_images.$image['file_name'] );
    }
    $result = sql_delete_any( 'reviews_images', array( 'review_id' => $review['id'] ) );
  }
  redirect( '/admin/reviews.php', 'Запись успешно удалена!', 'mes' );
}
//- удаление отзыва


//+ удаление фото
if( isset( $_POST['del_image'] ) )
{
  if( !( $image = sql_fetch_query( "SELECT * FROM `reviews_images` WHERE `id`=".(int)$_POST['del_image'] ) ) )
    redirect( '', 'Фото не найдено', 'err' );

  $result = sql_delete_id( 'reviews_images', $image['id'] );

  if( is_file( $dir_images.$image['file_name'] ) )
    unlink( $dir_images.$image['file_name'] );

  sql_result( "UPDATE reviews SET images=images-1 WHERE id=".$image['review_id'] );

  redirect( '/admin/reviews.php?edit&id='.$image['review_id'], 'Фото удалено!', 'mes' );
}
//- удаление фото


//+ сохранение отзыва
if( isset( $_POST['edit_review'] ) )
{
  if( !isset( $_POST['id'] ) || !( $review = sql_fetch_query( "SELECT * FROM `reviews` WHERE `id`=".(int)$_POST['id'] ) ) )
    redirect( '/admin/reviews.php', 'Отзыв не найден', 'err' );

  if( !isset( $_POST['name'] ) || !is_string( $_POST['name'] ) || ( $name = trim( $_POST['name'] ) ) == '' )
    setError( 'Укажите имя' );

  if( !isset( $_POST['text'] ) || !is_string( $_POST['text'] ) || ( $text = trim( $_POST['text'] ) ) == '' )
    setError( 'Введите текст отзыва' );

  if( noError() )
  {
    $rate = isset( $_POST['rate'] ) ? (int)$_POST['rate'] : 5;
    if( !in_array( $rate, array( 1,2,3,4,5 ) ) )
      $rate = 5;

    $nd_review = array
    (
      'name' => $name,
      'text' => $text,
      'rate' => $rate,
    );
    sql_update_id( 'reviews', $nd_review, $review['id'] );
    redirect( '/admin/reviews.php?edit&id='.$review['id'], 'Отзыв обновлён', 'mes' );
  }
}
//+ сохранение отзыва


$o = '';
//+ форма редактирования
if( isset( $_GET['edit'] ) )
{
  if( !isset( $_GET['id'] ) || !( $review = sql_fetch_query( "SELECT * FROM `reviews` WHERE `id`=".(int)$_GET['id'] ) ) )
    redirect( '/admin/reviews.php', 'Отзыв не найден', 'err' );

  $rate_inp = '';
  for( $i=1; $i<=5;$i++)
    $rate_inp .= '<label style="margin-right: 5px;"><input type="radio" name="rate" value="'.$i.'" '.( $i == $review['rate'] ? ' checked' : '' ).'> '.$i.'</label>';
  $o .= '
<div class="title"><a href="reviews.php">Отзывы</a> / Редактирование отзыва<p></div>
<form method="POST" action="" style="display:block;">
  <input name="id" type="hidden" value="'.$review['id'].'"> 
  <b>Имя</b><br>
  <input class="inp" name="name" type="text" value="'.$review['name'].'"><br>
  <b>Текст</b><br>
  <textarea class="inp" name="text" rows="4" style="width:270px;">'.$review['text'].'</textarea><br>
  <b>Оценка</b><br>
  '.$rate_inp.'<br>
  <br>
  <input type="submit" class="btn" name="edit_review" style="padding: 5px;" value="Обновить отзыв">
</form>
';
  if( $review['images'] > 0 )
  {
    $o .= '<br>
<form action="" method="post">
<div style="display: flex;">';
    $images_res = sql_result( "SELECT * FROM `reviews_images` WHERE `review_id`=".$review['id'] );
    while( $image = sql_fetch_result( $images_res ) )
    {
      $o .= '
<div style="margin:5px;position: relative;">
  <div style="width: 200px;height:200px;"><img src="'.$url_images.$image['file_name'].'" style="width:100%;height:auto;"></div>
  <div style="position:absolute;top:0;right:0;"><button type="submit" name="del_image" value="'.$image['id'].'"><img src="img/logout.png" style="width: 16px; height: auto; border:0;" title="Удалить фото"></button></div>
</div>
   ';
    }
    $o .= '</div></form>';
  }
}
//- форма редактирования
else
//+ index
{
  $o .= '
<div class="title">Отзывы</div>
<div class="table-bar">
  <form action="" method="POST">
    <input name="search_product" type="text" class="inp">
    <input type="submit" value="Найти" name="btn_search_product" style="width: 70px; height: 26px;">
  </form>
</div>
<div class="table-list">
  <table cellspacing="0">
    <thead>
      <tr>
        <th width="400">Информация</th>
        <th width="25">Действия</th>
      </tr>
    </thead>
    <div class="catalog_result"></div>';

  $page = isset( $_GET['page'] ) ? (int)$_GET['page'] : 1;
  if( $page <= 0 )
    $page = 1;
  $on_page = 10;

  $mysql_result = sql_result( "SELECT count(`id`) FROM `reviews`" );
  if( isset( $_POST['btn_search_product'] ) && isset( $_POST['search_product'] ) )
  {
    //если нажата кнопка поиска то изменяем sql запрос
    $stroka_search = $_POST['search_product'];
    $mysql_result = sql_result( "SELECT count(`id`) FROM reviews WHERE ( (name LIKE '%$stroka_search%') OR (text LIKE '%$stroka_search%')) " );
  }
  $count = mysql_fetch_row( $mysql_result );
  $posts = $count[0];
  $total = intval( ( $posts - 1 ) / $on_page ) + 1;
  if( $page > $total )
    $page = $total;

  $start = ( $page - 1 ) * $on_page;

  if( $page != 1 )
    $pervpage = '<a href="'.$_SERVER['SCRIPT_NAME'].'?page=-1"><<</a><a href="'.$_SERVER['SCRIPT_NAME'].'?page='.( $page - 1 ).'"><</a> ';
  if( $page != $total )
    $nextpage = '  <a href="'.$_SERVER['SCRIPT_NAME'].'?page='.( $page + 1 ).'">></a><a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$total.'">>></a> ';
  if( $page - 2 > 0 )
    $page2left = ' <a href="'.$_SERVER['SCRIPT_NAME'].'?page='.( $page - 2 ).'">'.( $page - 2 ).'</a>  ';
  if( $page - 1 > 0 )
    $page1left = '<a href="'.$_SERVER['SCRIPT_NAME'].'?page='.( $page - 1 ).'">'.( $page - 1 ).'</a>  ';
  if( $page + 2 <= $total )
    $page2right = '  <a href="'.$_SERVER['SCRIPT_NAME'].'?page='.( $page + 2 ).'">'.( $page + 2 ).'</a>';
  if( $page + 1 <= $total )
    $page1right = '  <a href="'.$_SERVER['SCRIPT_NAME'].'?page='.( $page + 1 ).'">'.( $page + 1 ).'</a>';

  $sql = sql_result
  ("
    SELECT r.*, c.name AS prod_name
    FROM reviews r, catalog c
    WHERE c.id=r.prod_id
    ORDER BY r.id DESC
    LIMIT $start, $on_page
  ");

  if( isset( $_POST['btn_search_product'] ) && isset( $_POST['search_product'] ) )
  //если нажата кнопка поиска то изменяем sql запрос
  {
    $sql = sql_result
    ("
      SELECT r.*, c.name AS prod_name
      FROM reviews r, catalog c
      WHERE c.id=r.prod_id AND ((r.name LIKE '%$stroka_search%') OR (r.text LIKE '%$stroka_search%'))
      ORDER BY r.id DESC
      LIMIT $start, $on_page
    ");
  }
  $list = '';
  while( $row = sql_fetch_result( $sql ) )
  {
    $images = '';
    if( $row['images'] > 0 )
    {
      $images = '<div class="images">';
      $images_res = sql_result( "SELECT * FROM `reviews_images` WHERE `review_id`=".$row['id']."" );
      while( $image = sql_fetch_result( $images_res ) )
        $images .= '<a href="'.$url_images.$image['file_name'].'" target="_blank"><img src="'.$url_images.$image['file_name'].'" alt=""></a>';
      $images .= '</div>';
    }
    $list .= '
  <tr>
    <td class="review-item">
      <span class="time">'.date( 'Y.m.d H:i', $row['time_send'] ).'</span>
      <b>'.$row['name'].'</b> на <a href="/view.php?item='.$row['prod_id'].'" target="_blank">'.$row['prod_name'].'</a>
      <div class="rate">'.str_repeat( '<img src="/img/star_gold.svg">', $row['rate'] ).str_repeat( '<img src="/img/star_gray.svg">', 5 - $row['rate'] ).'</div>
      <div class="text">'.data4www( $row['text'] ).'</div>'.$images.'
    </td>
    <td>
      <a href="?edit&id='.$row['id'].'"><img src="img/edit.png"></a>
      <form method="POST" action="">
        <input name="id" type="hidden" value="'.$row['id'].'">
        <input type="submit" class="delete" name="del_review" value="">
      </form>
    </td>
  </tr>
    ';
  }
  $o .=  $list == '' ? '<div class="none">Отзывов не обнаружено</div>' : $list;
  $o .= '
  </table>
</div>
  ';
  if( $total > 1 )
    $o .= '<p><div align="center" class="navigation">'.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right.$nextpage.'</div></p>';
  $o .= ' 
</div>';
}
//- index

?>
<!DOCTYPE>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Отзывы | CMS NBOutlet</title>
  <link href="css/style.css?1" rel="stylesheet">
  <link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/ajax.js"></script>
  <style>
    label, button,input[type=submit],input[type=radio]{cursor:pointer;}
    .inp{color: #3f3f3f;padding: 3px 5px;border-radius: 2px;border: 1px solid #ccc;}
    .table-bar{width: 100%;margin: 0 0 16px 0;}
    .review-item .time{font-size: 11px;}
    .review-item .images IMG {width:50px;height:50px;border:1px solid #def;}
    .review-item .images IMG:hover{border-color:green;}
    .review-item .rate IMG{width:14px;margin:0;}
    .review-item .text {padding:5px;}
  </style>
</head>
<body>
<div class="wrapper">
  <div class="header"></div>
  <?= htmlAlert(); ?>
  <div class="content">
    <div class="contentcontent clearfix">
      <?php require_once( 'blocks/sidebar.php' ); ?>
      <div class="right-column">
      <?= $o; ?>
      </div>
    </div>
  <?php require_once( 'blocks/footer.php' ); ?>
</body>
</html>