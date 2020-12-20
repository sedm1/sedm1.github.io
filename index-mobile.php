<?php session_start(); ?>
<?php require_once("config.php"); ?>
<?php require_once "stat.php";
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/><!-- Adaptive -->
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
    <link rel="stylesheet" type="text/css" href="/mobile/css/main.css"/>
    <link rel="stylesheet" href="css/fonts.min.css"/>
    <link rel="icon" href="#" type="image/x-icon"/>
    <link rel="shortcut icon" href="#" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="#"/>
    <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript">
      function go_full() {
        document.cookie = "full=ok";
        window.location.href = "http://www.nboutlet.eu/";
      }
    </script>

    <title>NB OUTLET</title>
  </head>
  <body>
    <!-- [if lt IE 8]>
    <div class="browserupgrade">Вы используете <strong>устаревшую</strong> версию браузера.Пожалуйста <a href="http://browsehappy.com/">обновите свой браузер</a>.</div>
    <![endif]-->

    <?php include("mobile/module/header.php"); ?>

    <main>
        <div id="bg_layer"></div>
      <!-- Главный текст-->
      <section class="main-slogan" id="main-slogan">
        <div class="container flex">
          <div class="main-block">
            <h1 class="main-title">Брендовые товары Розница и малый опт </h1>
              <span class="main-descr">Низкие цены, доставка по всему миру</span>
              <a class="btn-sale" href="catalog-mobile.php?catid=2&status=3">% Скидки</a>
              <img src="/mobile/img/header/header-bg.png" alt="capture"/>
          </div>
        </div>
      </section>
      <!-- Бренды-->
      <section class="brand">
        <div class="container">
          <div class="brand-wrap"><img src="/mobile/img/brand/Brands.png" alt="Brand"/></div>
        </div>
      </section>
      <!--Информация-->
      <section class="info">
                <ul>
                  <li>
                    <div class="container"><a href="pdf/How To Find US (NB Outlet) RUS.pdf" target="new">
							<span>Как нас найти?</span>
						</a>
					</div>
                  </li>
                  <li>
                    <div class="container"><a href="pdf/Payment and delivery RUS.pdf" target="new">
							<span>Оплата и доставка</span>
						</a>
					</div>
                  </li>
                  <li>
                    <div class="container"><a href="http://nboutlet.eu/" target="new" onclick="go_full();">
							<span>полная версия</span>
						</a>
					</div>
                  </li>
                </ul>
      </section>
    </main>
    <?php include("mobile/module/footer.php"); ?>

  </body>
</html>