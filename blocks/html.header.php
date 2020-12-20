<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1200px">
  <title><?= isset( $page_title ) ? $page_title : 'Salemarket' ?></title>
  <?= isset( $page_meta_desc ) ? '<meta name="description" content="'.$page_meta_desc.'">' : '' ?>
  <?= isset( $page_meta_keyw ) ? '<meta name="keywords" content="'.$page_meta_keyw.'">' : '' ?>
  <link rel="icon" href="favicon.ico?1" type="image/x-icon"/>
<!--  <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">-->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.7" media="screen" />
  <link rel="stylesheet" href="css/main.2011.css?<?=filemtime( __DIR__.'/../css/main.2011.css' );?>">
  <link rel="stylesheet" href="css/custom.2011.css?<?=filemtime( __DIR__.'/../css/custom.2011.css' );?>">
<?
  if( isset( $page_css ) )
  {
    foreach( $page_css as $css )
    echo '<link rel="stylesheet" href="'.$css.'">';
  }
?>
  <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
  </script>
<?
  if( isset( $page_js_head ) )
  {
    foreach( $page_js_head as $js )
      echo '<script src="'.$js.'"></script>';
  }
?>
</head>
<body>
<a href="#" class="scrollup">Наверх</a>
<div id="wrapper">
  <div id="bg_layer"></div>

<header class="header">
  <div class="container">
    <div class="nav">
      <img class="phone-img" src="img/phone.svg" alt="phone">
      <div class="phone-number">
        <h3 class="heading-red">+371 26858674</h3>
        <span class="heading-normal">Обслуживание клиентов</span>
      </div>
      <!-- /phone-number -->
      <img class="img-facebook" src="img/facebook.svg" alt="Facebook logo">
      <img class="img-instagram" src="img/instagram.svg" alt="Instagram logo">
      <div class="logo">
        <a href="/" class="img-logo" ><img src="img/Salemarket.svg" alt="logo"></a>
        <p class="logo-text">Лучшие товары по своим ценам с доставкой по всей Латвии</p>
      </div>
      <!-- /logo -->
      <span class="trans-ru">RU</span>
      <!-- /trans-ru -->
      <span class="trans-lat">LAT</span>
      <!-- /trans-lat -->
      <span class="trans-en">EN</span>
      <div class="search-block">
        <form class="search-form" action="search.php" name="search" method="get">
          <button class="btn-search" type="button"></button>
          <input class="input-search" type="text" name="q"  value placeholder="Найти товары">
        </form>
      </div>
      <div class="h-cart" style="display: flex;">
        <img class="img-cart" src="img/cart.svg" alt="cart">
        <div class="basket">
          <h2 class="heading-red">Корзина</h2>
          <span class="heading-normal"><?=( ( isset( $_SESSION['cart'] ) && isset( $_SESSION['cart']['total'] ) ) ? $_SESSION['cart']['total']['qty']  : 0 ); ?> товара</span>
        </div>
      </div>
      <!-- /basket -->
    </div>
    <!-- /nav -->
  </div>
  <!-- /container -->
</header>