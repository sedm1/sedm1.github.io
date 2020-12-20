<?php session_start(); ?>
<?php require_once("config.php"); ?>
<?php require_once "stat.php";
?>
<!DOCTYPE html>
<html lang="en">
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
        window.location.href = "http://www.nboutlet.eu/index_en.php";
      }
    </script>

    <title>NB OUTLET</title>
</head>
<body>
<!-- [if lt IE 8]>
<div class="browserupgrade">You are using <strong>an outdated</strong>  version of the browser. Please
<a href="http://browsehappy.com/">update your browser</a>.</div>

<![endif] -->

<?php include("mobile/module/header_en.php"); ?>

<main>
    <div id="bg_layer"></div>
    <!-- Главный текст-->
    <section class="main-slogan" id="main-slogan">
        <div class="container flex">
            <div class="main-block">
                <h1 class="main-title">Branded GOODS in RETAIL AND WHOLESALE </h1>
                <span class="main-descr">Cheap prices worldwide delivery</span>
                <a class="btn-sale" href="catalog-mobile_en.php?catid=2&status=3">% DISCOUNT</a>
                <img src="/mobile/img/header/header-bg.png" alt="capture"/>
            </div>
        </div>
    </section>
    <!--// Главный текст-->
    <!-- Бренды-->
    <section class="brand">
        <div class="container">
            <div class="brand-wrap"><img src="/mobile/img/brand/Brands.png" alt="Brand"/></div>
        </div>
    </section>
    <!--//Бренды-->
    <!--Информация-->
    <section class="info">
        <ul>
            <li>
                <div class="container"><a href="pdf/How To Find US (NB Outlet) RUS.pdf" target="new">
                        <span>How to find us?</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="container"><a href="pdf/Payment and delivery RUS.pdf" target="new">
                        <span>Payment & Delivery</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="container"><a href="http://nboutlet.eu/index_en.php" target="new" onclick="go_full();">
                        <span>Full version</span>
                    </a>
                </div>
            </li>
        </ul>
    </section>
    <!--//Информация-->
</main>
<?php include("mobile/module/footer_en.php"); ?>
</body>
</html>
