<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once "stat.php"; //Статистика посищений
include_once('blocks/LanguageCart.php');
//Назначаем переменные
$item_id = (int)$_GET['item'];

//Переадресация на страницу ошибки
$product = mysql_query("SELECT * FROM `catalog` WHERE id='" . $item_id . "'");
$item    = mysql_fetch_array($product);
if ($item['id'] == $item_id) {
    if (empty($item_id)) {
        header("Location:404.php");
    }
} else {
    header("Location:404.php");
}

$folder = 'uploads/'; //Папка с изображениями


?>
<!DOCTYPE html>
<html lang="lv">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- Adaptive -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<link rel="stylesheet" href="/mobile/libs/normalize.css" />
	<!--      <link href="/css/reset.min.css" rel="stylesheet" type="text/css">-->
	<!--        Ссылки в соцсетях-->
	<meta property="og:title" content="NB OUTLET">
	<meta property="og:site_name" content="">
	<meta property="og:url" content="NB OUTLET">
	<meta property="og:description"
		  content="NB Outlet - интернет магазин одежды для всей семьи. Низкие цены, широкий ассортимент, доставка.">
	<meta property="og:image" content="/images/NB.png">
	<link rel="icon" type="image/png" href="http://www.nboutlet.eu/favicon.ico" sizes="32x32">
	<link rel="stylesheet" href="js/jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
	<link href="css/custom.min.css" rel="stylesheet" type="text/css">
	<link href="/mobile/css/main.css" rel="stylesheet" type="text/css">
	<link href="/mobile/fonts/stylesheet.css" rel="stylesheet">
	<link rel="icon" href="#" type="image/x-icon" />
	<link rel="shortcut icon" href="#" type="image/x-icon" />
	<link rel="apple-touch-icon" href="#" />
	<link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>

	<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script>
	<script>window.onload = function () {
		e("js/ie6/")
	}</script>
	<![endif]-->

	<script src="js/jquery-modal-master/jquery.modal.js" type="text/javascript"></script>

	<title>NB OUTLET <?php echo $item['name_lv'] ?></title>
</head>
<body class="product-view">

<div id="bg_layer"></div>

<?php include("mobile/module/header_lv.php"); ?>
<main>
	<!--Страница Карточка Продукта-->
	<section class="product">
		<div class="container">
			<!--Блок Назад-->
			<div class="block-return"><img src="/mobile/img/icon/arrow_back.svg" alt="Back" />
				<a href="#" class="return" onclick="window.history.back(); return false;">atpakaļ</a>
			</div>
		</div>
		<!--Список карточек товаров в корзине-->
		<div class="container">
			<div class="product-item">
				<div class="product-img">
                    <?php if ($item['image']) {
                        echo '<img src="' . $folder . $item['image'] . '" alt="' . $item['image'] . '"></a>';
                    } ?>
                    <?php
                    switch ($item['status']) {
                        case 0:
                            $status = '';
                            break;
                        case 1:
                            $status = '<span class="status status-prod new rotate"></span>';
                            break;
                        case 2:
                            $status = '<span class="status status-prod sold rotate"></span>';
                            break;
//                              default: $status = '<span class="status offer rotate"></span>';
                        default:
                            $status = '';
                    }
                    echo $status; ?>

				</div>
				<div class="product-content">
					<div class="title"><?php echo $item['name_lv']; ?> (<?php echo $item['description_lv']; ?>)
					</div>
                    <?php if ($item['status'] != '2') {
                        ?>
                        <?php if ($item['status'] == 3) { ?>
							<span class="price" id="price"
								  style="float: left; margin: 0 10px 0 0;">&euro; <?= $item['price_stock'] ?></span>
							<span style="text-decoration:line-through;  font: 18px 'Circe-Bold', sans-serif; text-transform: uppercase; margin: 0 0 5px 0; display: block;"> &euro; <?= $item['price'] ?></span>
                        <?php } else { ?>
							<div class="price">&euro;<?php echo $item['price']; ?> </div>
                        <?php } ?>
                    <?php } ?>

					<div class="size">
                        <?php
                        $filters_size = explode(',', $item['size']);

                        if (!empty($filters_size)) : ?>
                        <?php ksort($filters_size); ?>
						<div class="size-title">Izmērs:</div>
						<div class="size-options">
							<select id="options">
								<option value="">Izmērs</option>
                                <?php foreach ($filters_size as $size_name): ?>
									<option value="<?php echo $size_name; ?>"><?php echo $size_name; ?></option>
                                <?php endforeach; ?>
							</select>
                            <?php endif; ?>
                            <?php if ($item['cat_id'] != 5): ?>
                            <?php endif; ?>
						</div>
					</div>
					<div class="size-error">Izvēlieties izmēru</div>

					<div class="description"><?php echo $item['text_lv'] ?>
					</div>
					<div class="article"><?= $item['article'] ?></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="block-buttons">
				<!-- Кнопка Купить сразу-->
				<span id="order-button"
                  <?php if ($item['status'] == '2') {
                      echo "class=\"order-button-sold\"";
                  } ?>>
                <a class="btn by_now" <?php if ($item['status'] != '2') { ?> href="#ex1" rel="modal:open" <?php } ?> >Pirkt Uzreiz</a>
                  <?php if ($item['status'] != '2') : ?>
					  <!-- Кнопка В корзину-->
					  <button class="btn in_cart addToCart" href="javascript:void(0)"
						 data-id="<?php echo $item_id; ?>"><?php echo $language[$lang]['addtocart']; ?></button>
                  <?php endif; ?>
              </span>
			</div>
		</div>

	</section>
</main>
<script type="text/javascript">
    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    // document.getElementById("defaultOpen").click();
</script>

<?php include('mobile/module/footer_lv.php'); ?>

<?php include_once('blocks/quickcheckout.php'); ?>

<?php include_once('blocks/rightcart.php'); ?>

</body>
</html>