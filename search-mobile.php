<?php
session_start();
require_once("config.php"); //Подключение к бд

//Объявляем переменные
$query = htmlspecialchars(trim($_GET['q']));
$page  = $_GET['page'];

?>

<?php
$page = intval($page);
$num  = 25;

if ($page == 0) $page = 1;

$query_count  = "SELECT count(`sub_id`) FROM `catalog` WHERE (`name` LIKE '%" . $query . "%' OR `description` LIKE '%" . $query . "%' OR `article` LIKE '%" . $query . "%' OR `price` LIKE '%" . $query . "%') AND `sub_id`  NOT BETWEEN 40 AND 51 ";
$mysql_result = mysql_query($query_count);

if (mysql_num_rows($mysql_result) > 0) {
    $count = mysql_fetch_row($mysql_result);
}
$posts = $count[0];
$total = intval(($posts - 1) / $num) + 1;
$page  = intval($page);

if (empty($page) or $page < 0) $page = 1;
if ($page > $total) $page = $total;

$start = $page * $num - $num;

//if ($page != 1) $pervpage = '<a href="search-mobile.php?q=' . $query . '&page=-1">Первая</a>
//			<div class="nav_arrow_left"><a href="search-mobile.php?q=' . $query . '&page=' . ($page - 1) . '"></a></div> ';
//
//if ($page != $total) $nextpage = '  <div class="nav_arrow_right"><a href="search-mobile.php?q=' . $query . '&page=' . ($page + 1) . '"></a></div>
//			<a href="search-mobile.php?q=' . $query . '&page=' . $total . '">Последняя</a> ';
//
//if ($page - 2 > 0) $page2left = ' <a href="search-mobile.php?q=' . $query . '&page=' . ($page - 2) . '">' . ($page - 2) . '</a>  ';
//if ($page - 1 > 0) $page1left = '<a href="search-mobile.php?q=' . $query . '&page=' . ($page - 1) . '">' . ($page - 1) . '</a>  ';
//if ($page + 2 <= $total) $page2right = '  <a href="search-mobile.php?q=' . $query . '&page=' . ($page + 2) . '">' . ($page + 2) . '</a>';
//if ($page + 1 <= $total) $page1right = '  <a href="search-mobile.php?q=' . $query . '&page=' . ($page + 1) . '">' . ($page + 1) . '</a>';


//$sql = mysql_query("SELECT * FROM `catalog`
//                            WHERE (`name` LIKE '%" . $query . "%'
//                            OR `description` LIKE '%" . $query . "%'
//                            OR `article` LIKE '%" . $query . "%'
//                            OR `price` LIKE '%" . $query . "%')
//                            AND (status!=2) AND  `sub_id`  NOT BETWEEN 40 AND 51 ORDER BY `id`
//                             DESC LIMIT $start, $num");
$sql = mysql_query("SELECT * FROM `catalog`
                            WHERE (`name` LIKE '%" . $query . "%' 
                            OR `description` LIKE '%" . $query . "%' 
                            OR `article` LIKE '%" . $query . "%' 
                            OR `price` LIKE '%" . $query . "%') 
                            AND (status!=2) AND  `sub_id`  NOT BETWEEN 40 AND 51 ORDER BY `id`
                             DESC ");
$row = mysql_fetch_array($sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- Adaptive -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<!-- <link rel="stylesheet" href="css/print.css" type="text/css" media="print"> -->

	<meta property="og:title" content="NB OUTLET">
	<meta property="og:site_name" content="">
	<meta property="og:url" content="NB OUTLET">
	<meta property="og:description"
		  content="NB Outlet - интернет магазин одежды для всей семьи. Низкие цены, широкий ассортимент, доставка.">
	<meta property="og:image" content="/images/NB.png">
	<link rel="icon" type="image/png" href="http://www.nboutlet.eu/favicon.ico" sizes="32x32">
	<link rel="stylesheet" href="/mobile/libs/normalize.css" />
	<link href="css/custom.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/mobile/css/main.css" />
	<link rel="stylesheet" href="css/fonts.min.css" />
	<link rel="icon" href="#" type="image/x-icon" />
	<link rel="shortcut icon" href="#" type="image/x-icon" />
	<link rel="apple-touch-icon" href="#" />
	<link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<title>Результаты поиска "<?php echo $query; ?>"</title>
	<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
	<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script>
	<script>window.onload = function () {
		e("js/ie6/")
	}</script>
	<![endif]-->


</head>
<body>
<?php include("mobile/module/header.php"); ?>
<!--Каталог-->
<div class="catalog">
	<div class="container">
		<!--Блок Назад-->
		<div class="block-return"><img src="/mobile/img/icon/arrow_back.svg" alt="Back" />
			<a class="return" href="#" onclick="window.history.go(-1); return false;">назад</a>
		</div>
	</div>

	<div class="container">

		<div class="search-result-text">
			<p class="result-search">Результаты поиска "<?php echo $query; ?>"</p>
			<p class="products-result">Найдено <?php echo $posts; ?> товаров </p>
		</div>
		<div class="my-separator"></div>

		<!--Список товаров-->
		<div class="item-list" id="item-list">
			<ul>
                <?php


                if (!empty($row['id'])) {
                    do {
                        ?>
						<li>
							<a href="product-mobile.php?catid=<?= $row['cat_id']; ?>&item=<?= $row['id'] ?>">
								<div class="view">
									<div class="status
                                    <?php
                                    if ($row['status'] == '0') {
                                    } elseif ($row['status'] == '1') {
                                        echo "new";
                                    } elseif ($row['status'] == '2') {
                                        echo "sold";
                                    } else {
                                        echo "offer";
                                    }
                                    ?>
                                    ">
									</div><?php if ($row['catalog_image']) {
                                        echo '<img class="lazy" data-src="uploads/catalog/' . $row['catalog_image'] . '" alt="' . $row['catalog_image'] . '">';
                                    } ?></div>
								<div class="title"><?= $row['name'] ?></div>
								<div class="description"><?= $row['description'] ?></div>
								<div class="article"><?= $row['article'] ?></div>
								<div class="price">&euro;<?= $row['price'] ?></div>
							</a>
						</li>
                        <?php
                    } while ($row = mysql_fetch_array($sql));
                } else {
                    echo '<div class="empty-product">Нет предложений</div>';
                }
                ?>

			</ul>
		</div>

		<div class="block-sticky">
			<!--Кнопка вверх-->
			<div class="button-up-wrap" id="btnUp"><img src="/mobile/img/icon/arrow_up.svg" alt="arrow up" />
			</div>
		</div>
        <? /*php
            if ($total > 1) echo '<div class="nav_block nav-block-search">
                                    <div class="navigation navigation-search">'
                . $pervpage . $page2left . $page1left . '<span>' . $page . '</span>' . $page1right . $page2right
                . $nextpage . '</div> </div>';
            */ ?>
	</div>

</div>

<?php include("mobile/module/footer.php"); ?>

</body>
</html>