<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once "stat.php"; //Статистика посищений
include_once('blocks/LanguageCart.php');
$folder = 'uploads/'; //Папка с изображениями
$lang   = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
if ($lang == 'ru') $ext = '';
else $ext = '_' . $lang;

$link_lv = str_replace(".", '_lv.', $_SERVER['REQUEST_URI']);
$link_en = str_replace(".", '_en.', $_SERVER['REQUEST_URI']);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="description" content="<?= $item['meta_d'] ?>">
	<meta name="keywords" content="<?= $item['meta_k'] ?>">
	<!-- Adaptive -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<!-- <link rel="stylesheet" href="css/print.css" type="text/css" media="print"> -->
	<!--        Ссылки в соцсетях-->
	<meta property="og:title" content="NB OUTLET">
	<meta property="og:site_name" content="">
	<meta property="og:url" content="NB OUTLET">
	<meta property="og:description"
		  content="NB Outlet - интернет магазин одежды для всей семьи. Низкие цены, широкий ассортимент, доставка.">
	<meta property="og:image" content="/images/NB.png">
	<link rel="icon" type="image/png" href="http://www.nboutlet.eu/favicon.ico" sizes="32x32">
	<link rel="stylesheet" href="/mobile/libs/normalize.css" />
	<link href="css/custom.min.css" type="text/css" rel="stylesheet">
	<link href="css/magnific-popup.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/mobile/css/main.css" />
	<link rel="stylesheet" href="css/fonts.min.css" />
	<link rel="icon" href="#" type="image/x-icon" />
	<link rel="shortcut icon" href="#" type="image/x-icon" />
	<link rel="apple-touch-icon" href="#" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
	<link href="http://allfont.ru/allfont.css?fonts=ubuntu-medium" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="js/cufon-yui.js"></script>
	<script async type="text/javascript" src="fonts/Circe-Light.min.js"></script>
	<script async type="text/javascript" src="fonts/Circe-Regular.min.js"></script>
	<script async type="text/javascript" src="fonts/Circe-Bold.min.js"></script>
	<!--    <script async type='text/javascript' src="js/ajax.min.js"></script>-->
	<script async type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script async type="text/javascript" src="js/selectize.min.js"></script>

	<script async type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>

	<link rel="stylesheet" href="js/jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
	<!--    <script src="js/jquery-modal-master/jquery.modal.min.js" type="text/javascript"></script>-->
	<title>NB OUTLET <?php echo $item['name'] ?></title>
</head>
<body>
<!--[if lte IE 10]>
<script src="js/ie6/warning.js"></script>
<script>window.onload = function () {
	e("js/ie6/")
}</script>
<![endif]-->
<!--    [if lt IE 8]>-->
<!--    <div class="browserupgrade">Вы используете <strong>устаревшую</strong> версию браузера.Пожалуйста <a href="http://browsehappy.com/">обновите свой браузер</a></div>-->
<!--    <![endif]-->
<?php include("mobile/module/header" . $ext . ".php"); ?>
<main>
	<!--Корзина-->
	<section class="checkout-form">
		<div id="bg_layer"></div>
		<!--Блок Назад-->
		<div class="container">
			<div class="block-return"><img src="/mobile/img/icon/arrow_back.svg" alt="Back" /><a class="return" href="#"
																								 onclick="window.history.go(-1); return false;"
																								 data-text="Вернуться к корзине"> <?php echo $language[$lang]['back_to_cart']; ?></a>
			</div>
		</div>
		<!--Блок Оформление-->
		<div class="block-filter">
			<div class="search-filter"><?php echo $language[$lang]['checkout']; ?></div>
		</div>
		<!--Список товаров-->
        <?php if (isset($_SESSION['cart'])) : ?>
			<div class="container flex">
				<!-- Блок сумма-->
				<div class="total-price">
					<div class="wrap-count">
						<div class="count"><?php echo $language[$lang]['amount']; ?></div>
						<div class="stuff"><?php echo ($_SESSION['cart']['total']) ? $_SESSION['cart']['total']['qty'] : 0; ?><?php echo $language[$lang]['count']; ?></div>
					</div>
					<div class="wrap-amount">
						<div class="amount"><?php echo $language[$lang]['tabletotal']; ?></div>
						<div class="cost">
							€<?php echo ($_SESSION['cart']['total']) ? $_SESSION['cart']['total']['sum'] : 0; ?> </div>
					</div>
				</div>
				<!--Блок формы заказа-->
				<div class="note"></div>
				<div class="form-block">

					<form class="form-order catalog" action="order-mobile.php" method="POST" id="order-form-mobile">
						<label for="email"><?php echo $language[$lang]['email']; ?></label>
						<input type="text" id="email" name="mail" required="required"
							   pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
						<div class="block-form-delivery">
							<label for="shiping"><?php echo $language[$lang]['shiping']; ?></label>
							<select id="shiping" name="shiping" required="required">
								<option value="" hidden="hidden"><?php echo $language[$lang]['select']; ?></option>
								<option value="Почта"><?php echo $language[$lang]['postmail']; ?></option>
								<option value="Самовывоз"><?php echo $language[$lang]['pickup']; ?></option>
								<option value="Omniva"><?php echo $language[$lang]['omniva']; ?></option>
							</select>
						</div>
						<label for="message"><?php echo $language[$lang]['comment']; ?></label>
						<textarea id="message" name="message" cols="30" rows="10" required="required"
								  pattern="^[a-zA-Z]+$"></textarea>
						<div class="form-success"></div>
					</form>
				</div>
				<!-- Кнопка Оформить-->
				<button class="btn check" type="submit" form=""
						id="newOrder-mobile"><?php echo $language[$lang]['send_form']; ?> </button>
			</div>
        <?php endif; ?>
	</section>
</main>
<?php include("mobile/module/footer" . $ext . ".php"); ?>
</body>
</html>