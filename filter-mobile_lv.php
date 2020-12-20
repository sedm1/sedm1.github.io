<?php
session_start();
require_once("config.php"); //Подключение к бд

$check_filter = (int)$_GET['catid'];

$sql = "SELECT * FROM  `subcategory` WHERE `cat_id` ='$check_filter' ";

$result = mysql_query($sql);

$row_filter = array();
while ($data_row_filter = mysql_fetch_assoc($result)){
    $row_filter[] = $data_row_filter;
}

?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!-- Adaptive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="/mobile/libs/normalize.css"/>
    <!--      <link href="/css/reset.min.css" rel="stylesheet" type="text/css">-->
    <!--        Ссылки в соцсетях-->
    <meta property="og:title" content="NB OUTLET">
    <meta property="og:site_name" content="">
    <meta property="og:url" content="NB OUTLET">
    <meta property="og:description" content="NB Outlet - интернет магазин одежды для всей семьи. Низкие цены, широкий ассортимент, доставка.">
    <meta property="og:image" content="http://www.nboutlet.eu/favicon.ico" sizes="32x32">

    <link rel="stylesheet" href="js/jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
    <link href="css/custom.min.css"  rel="stylesheet" type="text/css">
    <link href="/mobile/css/main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/fonts.min.css"/>
    <link rel="icon" href="#" type="image/x-icon"/>
    <link rel="shortcut icon" href="#" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="#"/>
    <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>

    <!--[if lte IE 10]>
    <script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
    <![endif]-->

    <script src="js/jquery-modal-master/jquery.modal.js" type="text/javascript"></script>

    <title>NB OUTLET Catalog Filter</title>
</head>
<body>
<!-- [if lt IE 8]>
<div class="browserupgrade">Jūs izmantojat <strong>novecojušu </strong> pārlūka versiju.Lūdzu,
    <a href="http://browsehappy.com/">atjauniniet savu pārlūkprogrammu</a>.</div>
<![endif]-->

<div id="bg_layer"></div>

<?php include("mobile/module/header_lv.php"); ?>
<main>
    <!--Секция фильтр-->
    <section class="catalog catalog-filter">
        <div class="container">
            <!--Блок Назад-->
            <div class="block-return">
                <img src="/mobile/img/icon/arrow_back.svg" alt="Back"/>
<!--                <a class="return" href="--><?php //echo $_SERVER['HTTP_REFERER'];?><!--">atpakaļ</a>-->
                <a class="return" href="#" onclick="window.history.back(); return false;">atpakaļ</a>
            </div>
        </div>
        <!--Блок поиск по категории-->
        <div class="block-filter"><span class="search-filter"> Meklēšana pēc kategorijas</span>
        </div>
        <div class="menu-list menu-list-filter">
			<a class="close-subcategory" href="#" onclick="window.history.back(); return false;">
				<img src="/mobile/img/icon/close.png" alt="close">
			</a>
            <ul>
                <?php
                foreach($row_filter as $row) :?>

                    <li  <?php
                    if ($row['id'] == 39 || $row['id'] == 37  || $row['id'] == 24 || $row['id'] == 13 ){?>
                        <?php echo 'style="border:1px solid #BA0C17; padding: 8px 40px;"';?>
                        <?php ;} ?>>
                        <a <?php
                        if ($row['id'] == 39 || $row['id'] == 37  || $row['id'] == 24 || $row['id'] == 13 ){?>
                            <?php echo 'style="color: #BA0C17;"';?>
                            <?php ;} ?> href="catalog-filter-mobile_lv.php?subid=<?=$row['id'];?>">
                            <?php echo $row['subcategory_lv'];?>
                        </a>
                    </li>

                <?php endforeach ?>
            </ul>
            <div class="menu-footer">
                <a class="adress" href="https://goo.gl/maps/65MPspUN5kwAAVAL7" target="blank">Slokas Iela 52 (LV-1007) Riga, Latvija</a>
                <a class="phone" href="tel:+(371) 26885058">+(371) 26885058</a>
            </div>
        </div>
    </section>
</main>
<!-- [if lt IE 9]>
<script src="libs/html5shiv/es5-shim.min.js"></script>
<script src="libs/html5shiv/html5shiv.min.js"></script>
<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="libs/html5shiv/respond.min.js"></script>
[endif]-->
<!--Scripts-->
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>