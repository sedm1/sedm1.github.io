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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="keywords" content="">
  <title>NB Outlet - Женская Одежда</title>
  <link href="../../css/reset.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/catalog.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/main.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/default.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/fonts.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/custom.min.css" type="text/css" rel="stylesheet">

  <link rel="stylesheet" href="css/main.css">
  <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script async type="text/javascript" src="fonts/Circe-Light.min.js"></script>
<script async type="text/javascript" src="fonts/Circe-Regular.min.js"></script>
<script async type="text/javascript" src="fonts/Circe-Bold.min.js"></script>
<script async type='text/javascript' src="js/ajax.min.js"></script>
<script async type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script async type="text/javascript" src="js/selectize.min.js"></script>

<script async type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>

</head>

<body>

  <div id="wrapper">
	<div id="bg_layer"></div>
	<!--Шапка-->
	<?php include("blocks/header.php"); ?> 
<!--
    <div id="top-header">
      <div class="container">
        <div id="logo"><a href="index.php"><img src="../../images/nboutlet_logo.png" id="nboutlet" alt="nboutlet"><img
              src="../../images/back.png" id="back" width="68" height="23" alt="back-home"></a>
        </div>
        <div class="lang-bar">
          <img src="../../images/rus.png" alt="Русский">
          <a href="/catalog_lv.php?catid=1" data-id="lv" data-href="/catalog_lv.php?catid=1"><img src="../../images/lv_l.png"
              alt="LV" style="opacity:.40"></a>
          <a href="/catalog_en.php?catid=1" data-id="en" data-href="/catalog_en.php?catid=1"><img src="../../images/eng.png"
              alt="ENG" style="opacity:.40"></a>
        </div>
        <div class="info-bar">
          <div class="h-cart">
            <a href="javascript:void(0)"><img src="../../images/cart.png" alt="Корзина" /></a>
            <span class="round"><span class="count">0</span></span>
          </div>
          <div class="phone">
            <img src="../../images/phone_info.png" alt="phone-info">
          </div>
          <div class="social">
            <a href="#"><img src="../../images/vk.png" width="29" height="27" alt="vk"></a>
            <a href="#"><img src="../../images/twitter.png" width="29" height="27" alt="twitter"></a>
            <a href="https://www.facebook.com/nboutletshop/" target="_blank"><img src="../../images/facebook.png" width="29"
                height="27" alt="facebook"></a>
            <a href="https://www.instagram.com/nboutletshop/" target="_blank"><img src="../../images/instagram.png" width="29"
                height="27" alt="instagram"></a>
          </div>

          <div class="search-block">
            <form action="search.php" name="search" method="GET">
              <input type="text" name="q" value="" placeholder="Найти товары" />
              <button class="btn-search" type="button"></button>
            </form>
          </div>
        </div>
      </div>
    </div>
-->
    <div id="catalog" style="position: relative;">

      <h2 class="catalog__title">Товары со скидкой</h2>

      <div id="filter">
        <ul>
          <li><a href="?catid=1">женская одежда</a></li>
          <li><a href="?catid=1&status=1" id="active">мужская одежда</a></li>
          <li><a href="?catid=1&status=3">детская одежда</a></li>
          <li><a href="?catid=1&status=2">обувь</a></li>
          <li><a href="?catid=1&status=2">другие товары</a></li>

        </ul>
      </div>

      <div>

        <div id="products-list">
          <div id="item-list">
            <ul>
              <li>
                <div>
                  <a href="view.php?item=1040">
                    <div class="view">
                      <div class="status 
                                          																			">
                      </div><img src="images/card-1.jpg" alt="a5c3994cca19900683a3572068cb1c92.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-716</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1039">
                    <div class="view">
                      <div class="status 
                                          																			">
                      </div><img src="images/card-2.jpg" alt="10a0bb02c7ffd9ad338cf19d751dcf28.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-832</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1038">
                    <div class="view">
                      <div class="status 
                                          																			">
                      </div><img src="images/card-3.jpg" alt="96b684495e624d7ede3d60f83f45f25a.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-825</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1033">
                    <div class="view">
                      <div class="status 
                                          																			">
                      </div><img src="images/card-4.jpg" alt="df31b09a9b9540bb9602e2f2f3cac746.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-822</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=998">
                    <div class="view">
                      <div class="status 
                                                                                ">
                      </div><img src="images/card5.jpg" alt="462728fa9f287a583099017f1a86da2f.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-716</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=984">
                    <div class="view">
                      <div class="status 
                                                                                ">
                      </div><img src="images/card-6.jpg" alt="7725f16b41c71596a8616959e0210da3.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-710</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=983">
                    <div class="view">
                      <div class="status 
                                                                                ">
                      </div><img src="images/card-7.jpg" alt="31d64650844b91738850cbbadb00da18.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-714</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=979">
                    <div class="view">
                      <div class="status 
                                                                                ">
                      </div><img src="images/card-8.jpg" alt="5dfce14d1f5cefc0149289b5524dea82.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-713</div>
                    <div class="price">&euro;35.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=978">
                    <div class="view">
                      <div class="status 
                                                                                ">
                      </div><img src="images/card-9.jpg" alt="19500c610caf79a4e6b0007e01059a15.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-712</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=975">
                    <div class="view">
                      <div class="status 
                                                                                ">
                      </div><img src="images/card-10.jpg" alt="c13e2d4a9ec79b53870374229e0ec6e7.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-710</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1040">
                    <div class="view">
                      <div class="status 
                                            																			">
                      </div><img src="images/card-1.jpg" alt="a5c3994cca19900683a3572068cb1c92.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-716</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1039">
                    <div class="view">
                      <div class="status 
                                            																			">
                      </div><img src="images/card-2.jpg" alt="10a0bb02c7ffd9ad338cf19d751dcf28.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-832</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1038">
                    <div class="view">
                      <div class="status 
                                            																			">
                      </div><img src="images/card-3.jpg" alt="96b684495e624d7ede3d60f83f45f25a.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-825</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=1033">
                    <div class="view">
                      <div class="status 
                                            																			">
                      </div><img src="images/card-4.jpg" alt="df31b09a9b9540bb9602e2f2f3cac746.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-822</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=998">
                    <div class="view">
                      <div class="status 
                                                                                  ">
                      </div><img src="images/card5.jpg" alt="462728fa9f287a583099017f1a86da2f.jpg">
                    </div>
                    <div class="title">blend he</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-716</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=984">
                    <div class="view">
                      <div class="status 
                                                                                  ">
                      </div><img src="images/card-6.jpg" alt="7725f16b41c71596a8616959e0210da3.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-710</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=983">
                    <div class="view">
                      <div class="status 
                                                                                  ">
                      </div><img src="images/card-7.jpg" alt="31d64650844b91738850cbbadb00da18.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-714</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=979">
                    <div class="view">
                      <div class="status 
                                                                                  ">
                      </div><img src="images/card-8.jpg" alt="5dfce14d1f5cefc0149289b5524dea82.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-713</div>
                    <div class="price">&euro;35.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=978">
                    <div class="view">
                      <div class="status 
                                                                                  ">
                      </div><img src="images/card-9.jpg" alt="19500c610caf79a4e6b0007e01059a15.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-712</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

              <li>
                <div>
                  <a href="view.php?item=975">
                    <div class="view">
                      <div class="status 
                                                                                  ">
                      </div><img src="images/card-10.jpg" alt="c13e2d4a9ec79b53870374229e0ec6e7.jpg">
                    </div>
                    <div class="title">antony morato</div>
                    <div class="description">Мужские джинсы</div>
                    <div class="article">NB-710</div>
                    <div class="price">&euro;30.00</div>

                  </a>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="clear"></div>
  </div>

  <div id="footer">
    <div class="container">
      <div class="block-link">
        <div class="left-column">
          <div class="title">Каталог</div>
          <ul>
            <li> <a href="catalog.php?catid=1">Женская Одежда</a>
            </li>
            <li> <a href="catalog.php?catid=2">Мужская Одежда</a>
            </li>
            <li> <a href="catalog.php?subid=25">Детская Одежда</a>
            </li>
            <li> <a href="catalog.php?catid=4">Обувь</a>
            </li>
            <li> <a href="catalog.php?catid=5">Другие Товары</a>
            </li>
          </ul>
        </div>
        <div class="right-column">
          <div>Информация</div>
          <ul>
            <li><a href="pdf/How To Find US (NB Outlet) RUS.pdf" target="new">Как нас найти</a></li>
            <li><a href="pdf/Payment and Delivery (NB Outlet).pdf" target="new">Оплата и Доставка</a></li>
          </ul>
        </div>
      </div>
      <div class="block-info" style="width: 620px;">
        <div class="logo"><a href="index.php"><img src="../../images/nboutlet1_logo.png" width="66" height="11"
              alt="nboutlet"></a></div>
        <div class="left-column" style="margin-left: 120px;">
          <div class="contact">
            <ul>
              <li><img src="../../images/icon1.png" alt="icon-phone">Тел.: +371 26885058 (WhatsApp)</li>
            </ul>
          </div>
        </div>
        <div class="right-column" style="margin-left: 389px;">
          <div class="contact">
            <ul>
              <li><img src="../../images/icon2.png" alt="icon-phone" style=" margin-top: 4px;">E-mail : <a
                  href="mailto:info@nboutlet.eu">info@nboutlet.eu</a></li>
              <li><img src="../../images/icon3.png" alt="icon-phone" style="margin-top: 0px;">Web : <a
                  href="http://www.nboutlet.eu/" target="new">www.nboutlet.eu</a></li>
            </ul>

          </div>
        </div>
        <div style="clear:both;"></div>

        <div class="subscribe" id="subs">
          <div class="subscribe-text">ПОДПИСАТЬСЯ НА РАССЫЛКУ</div>
          <form id="subs-form" action="http://nboutlet.eu/send_email.php" method="POST">
            <input style="float: left;" onFocus="if (this.value == 'Ваш E-mail') this.value = '';"
              onBlur="if (this.value == '') this.value = 'Ваш E-mail';" type="text" name="email" value="Ваш E-mail" />
            <div
              style="background: #f9f9f9;color: #000;/* width: 130px; */float: left;margin-left: 10px;height: 30px;padding-top: 6px;/* margin-left: 5px; */">
              <img id="yes_captcha_podpis" src="../../images/yes_captcha.png" width="20px" height="20px"
                style="float: left; display: none; margin-left: 5px; cursor: pointer;">
              <div id="no_captcha_podpis"
                style="float: left;width: 20px;height: 20px;/* margin: 1.5px; */border: 2px solid #c1c1c1;cursor: pointer;background: #fff;margin-left: 5px; border-radius: 4px;">
              </div>
              <span style="margin-left: 10px; margin-right: 5px; /* font-size: 14px; */">I'm not a robot</span>
            </div>
            <button id="subs-button" type="submit"> ПОДПИСАТЬСЯ</button>
            <br />
            <div class="response"></div>
            <div id="content_get_trigger_captcha_podpis"></div>
          </form>
        </div>
      </div>
      <div class="copyright"><img src="../../images/copyright.png" width="15" height="15" alt="copyright"> NB OUTLET 2016 Все
        права защищены</div>
    </div>
  </div>


</body>

</html>