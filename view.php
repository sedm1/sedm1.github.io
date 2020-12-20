<?php

require_once 'init.php';
require_once 'stat.php';


//Назначаем переменные
$item_id = isset( $_GET['item'] ) ? (int)$_GET['item'] : 0;

if( !( $item = sql_fetch_query( "SELECT * FROM `catalog` WHERE id='".$item_id."'" ) ) )
  redirect( '/404.php' );

if( $_GET['item'] != $item['id'] )
  redirect( '/view.php?item='.$item['id'] );


$page_title = 'NB Outlet - '.$item['name'];
$page_meta_desc = $item['meta_d'];
$page_meta_keyw = $item['meta_k'];

$page_js = array
(
  'fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.7',
  'js/jquery-modal-master/jquery.modal.js',
  'js/main.view.js',
);
$page_css = array
(
  'css/main.view.css?'.filemtime( __DIR__.'/css/main.view.css' ),
  'js/jquery-modal-master/jquery.modal.css',
);

include_once 'blocks/html.header.php';

switch( $item['status'] )
{
  case 0: $status = ''; break;
  case 1: $status = '<span class="status_item new rotate"></span>'; break;
  case 2: $status = '<span class="status_item sold rotate"></span>'; break;
  //default: $status = '<span class="status_item offer rotate"></span>';
  default: $status = '';
}

// Отзывы
$reviews = '';
$review_res = sql_result("SELECT * FROM `reviews` WHERE `prod_id`=".$item_id." ORDER BY `time_send` DESC LIMIT 0, 5" );
while( $review = sql_fetch_result( $review_res ) )
{
  $reviews .= '<div class="review__users">
      <h3 class="name">'.data4www( $review['name'] ).'</h3>
      <div class="stars-block container-flex">
        <img class="stars" src="img/star_'.( $review['rate'] >= 1 ? 'gold' : 'gray' ).'.svg" alt="stars">
        <img class="stars" src="img/star_'.( $review['rate'] >= 2 ? 'gold' : 'gray' ).'.svg" alt="stars">
        <img class="stars" src="img/star_'.( $review['rate'] >= 3 ? 'gold' : 'gray' ).'.svg" alt="stars">
        <img class="stars" src="img/star_'.( $review['rate'] >= 4 ? 'gold' : 'gray' ).'.svg" alt="stars">
        <img class="stars" src="img/star_'.( $review['rate'] >= 5 ? 'gold' : 'gray' ).'.svg" alt="stars">
      </div>
      <p class="model">'.$item['article'].'</p>
      <p class="review__desk">'.data4www( $review['text'] ).'</p>
  ';
  if( $review['images'] > 0 )
  {
    $images_res = sql_result( "SELECT * FROM `reviews_images` WHERE `review_id`=".$review['id']." LIMIT 0, 3" );
    $reviews .= '<div class="review__photos-block">';
    while( $image = sql_fetch_result( $images_res ) )
      $reviews .= '<div><img src="/usersfiles/'.$image['file_name'].'" alt=""></div>';
    $reviews .= '</div>';
  }
  $reviews .= '</div>';
}

//другие товары
$prod_more = '';
$rand_product = sql_result("SELECT `id`, `name`, `description`, `text`, `article`, `price`, `catalog_image`, `status`,`price_stock` FROM `catalog` WHERE status !='2' and `id` !='".$item_id."' and `cat_id` NOT IN (7,8,9,10,11,12) ORDER BY RAND() LIMIT 10");
while( $offer = sql_fetch_result( $rand_product ) )
  $prod_more .= htmlCatItem( $offer );


?>
<section class="banner">
  <div class="container">

    <? include_once 'blocks/html.nav.php'; ?>

    <div class="banner__body container-flex">
      <div class="banner__photos container-flex">
        <a class="fancybox image__wrapper" rel="gallery1" href="<?=$folder.$item['image'];?>">
          <img class="minimized big-img" src="<?=$folder.$item['image'];?>" alt="<?=$item['image'];?>" />
        </a>
        <div class="small-photos container-flex">
          <?
          if( $item['image'] )
            echo '<a class="fancybox image__wrapper" rel="gallery1" href="'.$folder.$item['image'].'">
            <img class="minimized" src="'.$folder.$item['image'].'" alt="'.$item['image'].'" /></a>';
          if( $item['image1'] )
            echo '<a class="fancybox image__wrapper" rel="gallery1" href="'.$folder.$item['image1'].'">
            <img class="minimized" src="'.$folder.$item['image'].'" alt="'.$item['image1'].'" /></a>';
          if( $item['image2'] )
            echo '<a class="fancybox image__wrapper" rel="gallery1" href="'.$folder.$item['image2'].'">
            <img class="minimized" src="'.$folder.$item['image'].'" alt="'.$item['image2'].'" /></a>';
          ?>
        </div>
      </div>
      <div class="banner__desk">
        <div class="banner__tittle container-flex">
          <h2><?=$item['name'];?></h2>
          <?= $item['status'] != '2' ? ( $item['status'] == 3 ? '<p id="price" style="float: left; margin: 0 10px 0 0;">&euro; '.$item['price_stock'].'</p> <span style="text-decoration:line-through;  font: 24px Circe-Bold, sans-serif; text-transform: uppercase; margin: 0 0 5px 0; display: block;"> &euro; '.$item['price'].'</span>' : '<p id="price">&euro; '.$item['price'].'</p>' ) : '' ;?>
        </div>
        <p class="banner__short-desk"><?=$item['description']; ?></p>
        <div class="banner__text"><?= $item['text'] ?></div>
          <?php
          $filters_size = explode(',', $item['size']);
          if( !empty( $filters_size ) )
          {
          ?>
            <?php ksort($filters_size); ?>
        <div class="banner__sizes">
          <h2>Размеры</h2>
          <ul class="banner__sizes-ul container-flex">
          <?php foreach($filters_size as $size_name)
          {
           ?>
            <li class="banner__sizes-ul-links">
              <input type="radio" name="options" id="options_<?= $size_name; ?>" value="<?= $size_name; ?>" checked>
              <label for="options_<?= $size_name; ?>"><?= $size_name; ?></label>
            </li>
        <? } ?>
          </ul>
        </div>
          <?php } ?>
        <div class="size-error">Выберите размер</div>
        <div class="banner__desk-row container-flex">
          <p class="banner__model"><?=$item['article'];?></p>
<!--          <p class="banner__type">Б/У товар</p>-->
        </div>
        <?php if ($item['status'] != '2') { ?><div class="banner__btns-row container-flex">
          <a href="javascript:void(0)" class="addToCart btn-basket" data-id="<?php echo $item_id; ?>">В корзину</a>
          <a href="#ex1" rel="modal:open" class="btn-buy-now">Купить сразу</a>
        </div><? } ?>
      </div>
    </div>
  </div>
</section>
<section class="bonus">
  <div class="container">
    <p>Купив у нас товар и оставив отзыв с фото, вы получаете скидку в размере 10% на товары с пометкой Bonus </p>
  </div>
</section>
<section class="review">
  <div class="container">
    <h2>Оставить отзыв</h2>
    <form action="" method="post" enctype="multipart/form-data" id="file-catcher">
      <input type="hidden" name="prod_id" value="<?=$item_id;?>">
      <div class="input">
        <input type="text" name="name" class="name-form short-input" placeholder="Ваше имя">
      </div>
<!--      <div class="input">-->
<!--        <input type="text" name="prod" class="articul short-input" placeholder="Номер артикула">-->
<!--      </div>-->
      <div class="textarea">
        <textarea name="comm" class="coment" placeholder="Ваш комментарий"></textarea>
      </div>

      <div class="review__row container-flex">
        <p class="grade">Оцените работу с нами:</p>
        <div class="rating_block">
          <input name="rating" value="5" id="rating_5" type="radio" checked />
          <label for="rating_5" class="label_rating"></label>

          <input name="rating" value="4" id="rating_4" type="radio" />
          <label for="rating_4" class="label_rating"></label>

          <input name="rating" value="3" id="rating_3" type="radio" />
          <label for="rating_3" class="label_rating"></label>

          <input name="rating" value="2" id="rating_2" type="radio" />
          <label for="rating_2" class="label_rating"></label>

          <input name="rating" value="1" id="rating_1" type="radio" />
          <label for="rating_1" class="label_rating"></label>
        </div>
      </div>
      <div class="review__row container-flex">
        <div class="load-bloc container-flex">
          <img class="load-img" src="img/form.svg" alt="load">
          <div class="fl_upld">
            <label><input id='file-input' type='file' multiple/>Загрузите фото</label>
            <div id="fl_nm"></div>
          </div>
        </div>
        <button type="submit" class="review__btn" id="btn_send_review">Отправить</button>
      </div>
      <div class="response"></div>
    </form>
    <div id='file-list-display'></div>
  </div>
</section>
<section class="review2">
  <div class="container">
    <h2>Отзыв клиента о товаре</h2>
    <?= $reviews; ?>
  </div>
</section>
<section class="products">
  <div class="container">
    <h2 class="products__title">Другие товары</h2>
    <div class="product-list view-product-list">
      <ul class="product-list__ul">
        <?= $prod_more;?>
      </ul>
    </div>
    <div class="products__btns container-flex">
      <a class="to-main" href="/">Перейти на главную</a>
      <a class="to-catalog" href="/catalog.php">Перейти в каталог</a>
    </div>
  </div>
</section>

<?php
include_once 'blocks/quickcheckout.php';
include_once 'blocks/html.footer.php';
?>
