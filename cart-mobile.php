<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once "stat.php"; //Статистика посищений
include_once('blocks/LanguageCart.php');


$folder = 'uploads/'; //Папка с изображениями
$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
if($lang == 'ru') $ext = '';
else $ext = '_'.$lang;

$link_lv = str_replace(".", '_lv.', $_SERVER['REQUEST_URI']);
$link_en = str_replace(".", '_en.', $_SERVER['REQUEST_URI']);

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description" content="<?=$item['meta_d'] ?>">
    <meta name="keywords" content="<?=$item['meta_k'] ?>">
      <!-- Adaptive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
    <!-- <link rel="stylesheet" href="css/print.css" type="text/css" media="print"> -->
    <!--        Ссылки в соцсетях-->
    <meta property="og:title" content="NB OUTLET">
    <meta property="og:site_name" content="">
    <meta property="og:url" content="NB OUTLET">
    <meta property="og:description" content="NB Outlet - интернет магазин одежды для всей семьи. Низкие цены, широкий ассортимент, доставка.">
    <meta property="og:image" content="/images/NB.png">
    <link rel="icon" type="image/png" href="http://www.nboutlet.eu/favicon.ico" sizes="32x32">
    <link rel="stylesheet" href="/mobile/libs/normalize.css"/>
    <link href="css/custom.min.css" type="text/css" rel="stylesheet">
    <link href="css/magnific-popup.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/mobile/css/main.css"/>
    <link rel="stylesheet" href="css/fonts.min.css"/>
    <link rel="icon" href="#" type="image/x-icon"/>
    <link rel="shortcut icon" href="#" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="#"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="http://allfont.ru/allfont.css?fonts=ubuntu-medium" rel="stylesheet" type="text/css" />

    <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script async type='text/javascript' src="js/ajax.min.js"></script>
    <script async type="text/javascript" src="js/jquery.uniform.min.js"></script>
    <script async type="text/javascript" src="js/selectize.min.js"></script>
    <script async type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>

    <link rel="stylesheet" href="js/jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
    <script src="js/jquery-modal-master/jquery.modal.min.js" type="text/javascript"></script>

    <title>NB OUTLET  <?php echo $item['name'] ?></title>
  <!--  <script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox().fancybox({
                helpers: {
                    title : {
                        type : 'outside'
                    },
                    overlay : {
                        speedOut : 0
                    }
                }
            });
        });
        $(function(){
            $('.pcount').selectize();
            $('#shiping').selectize();
        });
    </script>-->
  </head>
  <body>
  <!--[if lte IE 10]>
  <script src="js/ie6/warning.js"></script>
<script>window.onload=function(){e("js/ie6/")}</script>
  <![endif]-->
<!--    [if lt IE 8]>-->
<!--    <div class="browserupgrade">Вы используете <strong>устаревшую</strong> версию браузера.Пожалуйста <a href="http://browsehappy.com/">обновите свой браузер</a></div>-->
<!--    <![endif]-->
    

    <?php include("mobile/module/header".$ext.".php"); ?>

    <main>
      <!--Корзина-->
      <section class="cart" >
          <div id="bg_layer"></div>
                <!--Блок Назад-->
                <div class="container">
                  <div class="block-return"><img src="/mobile/img/icon/arrow_back.svg" alt="Back"/>
					  <a class="return" href="/index-mobile<?php echo $ext;?>.php" data-text="<?php echo $language[$lang]['continue'];?>"><?php echo $language[$lang]['continue'];?></a>
                  </div>
                </div>
                <!--Блок Корзина-->
                <div class="block-filter">
                  <div class="search-filter"><?php echo $language[$lang]['title'];?></div>
                </div>
                <!--Блок Подарки-->
                <div class="container">
                  <div class="block-delivery">
                    <p class="delivery-title"><?php echo $language[$lang]['gifts_when_ordering_from'];?>200 EUR</p>
                      <img class="close-delivery" src="/mobile/img/icon/button_close.svg" alt="Close" id="CloseDelivery"/>
                  </div>
                </div>
                <!--Заголовок -->
                <div class="container">
                  <div class="cart-title"><?php echo $language[$lang]['title'];?></div>
                </div>
                <!--Блок Подарки-->
                <div class="container">
                  <div class="block-present">
                    <div class="present"><?php echo $language[$lang]['gifts_when_ordering_from'];?> 200 EUR</div>
                  </div>
                </div>
        <!--Список товаров-->
          <?php if(isset($_SESSION['cart'])) : ?>
        <div class="container flex">
          <ul class="cart-items">
            <!--Список карточек товаров в корзине-->
              <?php foreach($_SESSION['cart']['product'] as $product) : ?>
              <?php foreach($product['options'] as $option ) : ?>
                        <li class="card-items" id="product-<?php echo $product['id']; ?>-<?php echo $option['js']; ?>">
                          <div class="card-block">
                            <div class="card_exit "><a class="exit-card delincart" href="#" data-id="<?php echo $product['id']; ?>" data-size="<?php echo $option['size']; ?>" data-js="<?php echo $option['js']; ?>"><img src="/mobile/img/icon/exit.svg" alt="exit"/></a></div>
                            <div class="card__img"><img src="<?php echo $folder . $product['image'];?>" alt="<?php echo $product['name'][$lang]; ?>"/></div>
                            <div class="card__content-wrap">
                              <div class="card__content">
                                  <div class="card-title"><?php echo $product['name'][$lang]; ?> <span>(<?php echo $product['description'][$lang]; ?>)</span></div>
                                <div class="card-size"><?php echo $language[$lang]['size'];?>  <?php echo $option['size']; ?></div>
                                <div class="card-count"><?php echo $option['quantity']; ?> <?php echo $language[$lang]['count'];?></div>
                                <div class="card-article">
                                  <p class="article-title"><?php echo  $language[$lang]['model']; ?>:</p>
                                  <p class="article-num"><?php echo $product['model']; ?></p>
                                </div>
                              </div>
                              <div class="card__price" id="price<?php echo $product['id']; ?>-<?php echo $option['js']; ?>" class="price">€<?php echo $product['price']; ?></div>
                            </div>
                          </div>
                        </li>
                  <?php endforeach; ?>
              <?php endforeach; ?>

          </ul>
                    <!-- Блок сумма-->
                    <div class="total-price">
                      <div class="wrap-count">
                        <div class="count__item"><?php echo $language[$lang]['amount'];?></div>
                          <span class="stuff"><span class="count"><?php echo ($_SESSION['cart']['total']) ? $_SESSION['cart']['total']['qty']  : 0; ?> </span><?php echo $language[$lang]['count'];?></span>
                      </div>
                      <div class="wrap-amount">  
                        <div class="amount"><?php echo $language[$lang]['tabletotal'];?></div>
                        <div class="cost ">€<span class="total"> <?php echo ($_SESSION['cart']['total']) ? $_SESSION['cart']['total']['sum']  : 0; ?></span></div>
                      </div>
                    </div>
          <!--Блок формы заказа-->
            <div class="note"></div>
          <div class="form-block">
                    <!--Заголовок -->
                    <div class="cart-form-title"><?php echo $language[$lang]['registration'];?></div>
                        <form class="form-order catalog" action="order-mobile.php" method="POST" id="order-form-mobile">
                          <label for="email"><?php echo $language[$lang]['email'];?></label>
                          <input type="text" id="email" name="mail" required="required" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
                          <div class="block-form-delivery">
                            <label for="shiping"><?php echo $language[$lang]['shiping'];?></label>
                            <select id="shiping" name="shiping" required="required">
                              <option value="" hidden="hidden"><?php echo $language[$lang]['select'];?></option>
                              <option value="Почта"><?php echo $language[$lang]['postmail'];?></option>
                              <option value="Самовывоз"><?php echo $language[$lang]['pickup'];?></option>
                              <option value="Omniva"><?php echo $language[$lang]['omniva'];?></option>
                            </select>
                          </div>
                          <label for="message"><?php echo $language[$lang]['comment'];?></label>
                          <textarea id="message" name="message" cols="30" rows="10" required="required" pattern="^[a-zA-Z]+$"></textarea>
						  <div class="form-success"></div>
						</form>
          </div>
                    <!-- Кнопка Оформить-->
                    <button class="btn check" type="submit" form="" id="newOrder-mobile"><?php echo $language[$lang]['send_form'];?></button>
          <div class="button-block">
                      <!-- Кнопка Продолжить покупки--><a class="btn shopping" href="/index-mobile<?php echo $ext;?>.php">  <?php echo $language[$lang]['continue'];?></a>
                      <!-- Кнопка Оформить заказ--><a class="btn checkout" href="checkout-mobile.php"><?php echo $language[$lang]['checkout'];?></a>
          </div>
        </div>
          <?php endif; ?>
      </section>
    </main>

    <?php include("mobile/module/footer".$ext.".php"); ?>

  </body>
</html>