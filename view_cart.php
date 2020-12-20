<?php
require_once("config.php"); //Подключение к бд
require_once "stat.php"; //Статистика посищений
require_once("library/cart.php"); //Подключение корзины

//Назначаем переменные
$item_id = (int)$_GET['item'];

//Переадресация на страницу ошибки
$product = mysql_query("SELECT * FROM `catalog` WHERE id='" . $item_id . "'");
$item = mysql_fetch_array($product);
if ($item['id'] == $item_id) {
	if (empty($item_id)) {
		header("Location:404.php");
	}
} else {
	header("Location:404.php");
}

$folder = 'uploads/'; //Папка с изображениями


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NB Outlet - <?php echo $item['name'] ?></title>
	<meta name="description" content="<?= $item['meta_d'] ?>">
	<meta name="keywords" content="<?= $item['meta_k'] ?>">
	<link href="css/reset.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.min.css" rel="stylesheet" type="text/css">
	<link href="css/default.min.css" rel="stylesheet" type="text/css">
	<link href="css/product.min.css" rel="stylesheet" type="text/css">
	<link href="css/selectize.min.css" rel="stylesheet" type="text/css">
	<link href="css/fonts.min.css" rel="stylesheet" type="text/css">
	<link href="css/magnific-popup.min.css" rel="stylesheet" type="text/css" />
	<link href="http://allfont.ru/allfont.css?fonts=ubuntu-medium" rel="stylesheet" type="text/css" />
	<link rel="icon" type="image/png" href="/favicon.ico" sizes="32x32">
	<link href="js/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="js/jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>

	<script type="text/javascript" src="js/cufon-yui.js"></script>
	<script type="text/javascript" src="fonts/Circe-Light.min.js"></script>
	<script type="text/javascript" src="fonts/Circe-Regular.min.js"></script>
	<script type="text/javascript" src="fonts/Circe-Bold.min.js"></script>
	<script type='text/javascript' src="js/ajax.min.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/selectize.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/jquery-modal-master/jquery.modal.min.js" type="text/javascript"></script>

	<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->
	<!-- Просмотр фотографий -->
	<script type="text/javascript" src="js/fancybox/jquery.fancybox.min.js?v=2.1.5"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox().fancybox({
				helpers: {
					title: {
						type: 'outside'
					},
					overlay: {
						speedOut: 0
					}
				}
			});
		});
		$(function() {
			/* $('select.select-size').on('change', function(){
				$('input[name="product_size"]').val($(this).val());
				if($('#table-filter-details-'+$(this).val()+'').length){
					
					$('.for-more a').attr('href', '#table-filter-details-'+$(this).val()+'').show();
				}else{
					$('.for-more a').attr('href', '#').hide();
				}
			}); */

			$('.for-more a.filter-more').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				preloader: false,
				midClick: true,
				removalDelay: 300,
				closeMarkup: '<button title="Закрыть" type="button" class="mfp-close"></button>'
			});

			$('select.select-size').selectize();
		});
	</script>
	<!--Cufon-->
	<script type="text/javascript">
		Cufon.replace('.button1', {
			fontFamily: 'Circe Bold',
			hover: true
		});
	</script>

</head>

<body>

	<div id="wrapper">

		<!--Шапка-->
		<?php include("blocks/header.php"); ?>

		<!--Товар-->
		<div id="product">
			<div id="info">
				<div id="cat-nav">
					<ul>
						<?php
						//Вывод категорий
						$category = mysql_query("SELECT * FROM `category`");
						while ($cat = mysql_fetch_assoc($category)) {
							?>
							<li>
								<?php if (isset($cat['id']) && $cat['id'] == 3) { ?>
									<a href="catalog.php?subid=25"><?= $cat['category'] ?></a>
								<?php } else { ?>
									<a href="catalog.php?catid=<?= $cat['id'] ?>" <?php if ($cat['id'] == $item['cat_id']) {
																						echo 'id="active"';
																					} ?>><?= $cat['category'] ?></a>
								<?php } ?>
							</li>
						<?php
					}
					?>
					</ul>
				</div>
				<div id="left-column">
					<div id="main-photo">
						<?php
						if ($item['image']) {
							echo '<a class="fancybox" data-fancybox-group="gallery" href="' . $folder . $item['image'] . '"><img src="' . $folder . $item['image'] . '" alt="' . $item['image'] . '"></a>';
						}
						?>
					</div>
				</div>
				<div id="right-column">
					<div id="title"><?php echo $item['name']; ?> (<?php echo $item['description']; ?>)

						<?php
						switch ($item['status']) {
							case 0:
								$status = '';
								break;
							case 1:
								$status = '<span class="status new rotate"></span>';
								break;
							case 2:
								$status = '<span class="status sold rotate"></span>';
								break;
								//default: $status = '<span class="status offer rotate"></span>';
							default:
								$status = '';
						}
						echo $status;
						?>

					</div>

					<span id="description"><?php echo $item['text'] ?></span>
					<div style="top: 96px; position:relative;">
						<div class="size-product">
							<?php
							$filters_size = explode(',', $item['size']);

							if (!empty($filters_size)) : ?>
								<?php ksort($filters_size); ?>
								<span style="font-weight:600">Размер: </span>
								<select class="select-size">
									<option value=""><span style="font-weight:700">Выбрать размер</span></option>
									<?php foreach ($filters_size as $size_name) : ?>
										<option value="<?php echo $size_name; ?>"><?php echo $size_name; ?></option>
									<?php endforeach; ?>
								</select>
							<?php endif; ?>
							<?php if ($item['cat_id'] != 5) : ?>
								<!--
								<span class="for-more">
									<a onclick="javascript:void(0);" class="filter-more" href="#table-filter-details"><i class="select-size"></i>Таблица размеров</a>
								</span>
								-->
							<?php endif; ?>
						</div>

						<span id="article"><?= $item['article'] ?></span>
						<?php if ($item['status'] != '2') {
							?>
							<?php if ($item['status'] == 3) { ?>
								<span id="price" style="float: left; margin: 0 10px 0 0;">&euro; <?= $item['price_stock'] ?></span> <span style="text-decoration:line-through;  font: 24px 'Circe-Bold', sans-serif; text-transform: uppercase; margin: 0 0 5px 0; display: block;"> &euro; <?= $item['price'] ?></span>
							<?php } else { ?>
								<span id="price">&euro; <?= $item['price'] ?></span>
							<?php } ?>
						<?php } ?>
						<span id="order-button" <?php if ($item['status'] == '2') {
													echo "class=\"order-button-sold\"";
												} ?>><a <?php if ($item['status'] != '2') { ?> href="#ex1" onclick="cart.show();" <?php } ?>>Оформить Заказ</a></span>
					</div>
					<div id="small-photo">
						<ul>
							<?php
							if ($item['image']) {
								echo '<li><a class="fancybox" data-fancybox-group="gallery" href="' . $folder . $item['image'] . '"><img src="' . $folder . $item['image'] . '" alt="' . $item['image'] . '"></a></li>';
							}
							if ($item['image1']) {
								echo '<li><a class="fancybox" data-fancybox-group="gallery" href="' . $folder . $item['image1'] . '"><img src="' . $folder . $item['image1'] . '" alt="' . $item['image1'] . '"></a></li>';
							}
							if ($item['image2']) {
								echo '<li><a class="fancybox" data-fancybox-group="gallery" href="' . $folder . $item['image2'] . '"><img src="' . $folder . $item['image2'] . '" alt="' . $item['image2'] . '"></a></li>';
							}
							?>
						</ul>
					</div>

					<!--
				<div class="nav-product">
					<ul class="tab">
						<li><a id="defaultOpen" href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'tab-1')">ПОДРОБНО</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'tab-2')">ДОСТАВКА</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'tab-3')">ОПЛАТА</a></li>
					</ul>
					<div id="tab-1" class="tabcontent">
						<?php echo $item['details']; ?>
					</div>
					<div id="tab-2" class="tabcontent">
						<p>Доставка товара по всей Латвии на заказы от 0-30 EUR - платная.</p>
						<br />
						<p>Все заказы от 30 EUR и выше - доставка идет бесплатно. Доставку товара мы осуществляем с нашими логистическими партнерами : Omniva, Latvijas Pasts. <br /><br /> По срокам - 1/2 рабочих дня после отправке. <br /> Также бесплатно мы можем передать заказ в Центре (Ориго) или в Домине. Помимо этого вы можете забрать свой заказ у нас в магазине по адресу - ул. Слокас 52 (Рига). В любой день с 10.00 до 21.00 (по предварительной договоренности).</p>
						<br />
						<p>Доставка по Европе -  пакоматы Omniva, Latvijas Pasts, DPD courier. По срокам - 2/7 рабочих дней после отправке.</p><br />
						<p>Доставка по Странам СНГ - отправка почтой или EMS. По срокам - 5/12 рабочих дней после отправке.</p>
					</div>
					<div id="tab-3" class="tabcontent">	
						
						<p class="payment-text">ОПЛАТА</p>
						<p class="payment-rule">Оплатить заказанный товар можно след. способами :</p>
						<ul class="payment-rules">
							<li>на банковский счет через Интернет Банк (если платить из Стран Балтии)</li>
							<li>денежным переводом (если платить из Стран СНГ)</li>
							<li>наличными у нас в магазине (валюта EUR)</li>
						</ul>
						<p class="payment-rule">Заказанный товар мы отправляем только после 100 % оплаты. Перед покупкой все товары можно посмотреть в нашем магазине </p>
						
					</div>
				</div>
				-->
					<div id="table-filter-details" class="modal-size mfp-hide">
						<table class="table-filter-details">
							<thead>
								<tr class="table-filter-name">
									<td colspan="5">ВЕРХНЯЯ ОДЕЖДА</td>
								</tr>
								<tr>
									<th>РАЗМЕР</th>
									<th>ОБХВАТ ГРУДИ (СМ)</th>
									<th>ОБХВАТ ТАЛИИ (СМ)</th>
									<th>ОБХВАТ БЕДЕР (СМ)</th>
								</tr>

							</thead>

							<tbody>
								<tr>
									<td>XS</td>
									<td>81-85</td>
									<td>63-67</td>
									<td>91-95</td>
								</tr>
								<tr>
									<td>S</td>
									<td>86-90</td>
									<td>68-72</td>
									<td>96-100</td>
								</tr>
								<tr>
									<td>M</td>
									<td>91-95</td>
									<td>73-77</td>
									<td>101-105</td>
								</tr>
								<tr>
									<td>L</td>
									<td>96-100</td>
									<td>78-82</td>
									<td>106-110</td>
								</tr>
								<tr>
									<td>XL</td>
									<td>101-105</td>
									<td>83-87</td>
									<td>111-115</td>
								</tr>
							</tbody>
						</table>

						<table class="table-filter-details jeans">
							<thead>
								<tr class="table-filter-name">
									<td colspan="5">БРЮКИ И ДЖИНСЫ</td>
								</tr>
								<tr>
									<th>ДЕНИМ</th>
									<th>РАЗМЕР</th>
									<th>ОБХВАТ БЕДЕР (СМ)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>25</td>
									<td>XS</td>
									<td>85-90</td>
								</tr>
								<tr>
									<td>26</td>
									<td>S</td>
									<td>90-93</td>
								</tr>
								<tr>
									<td>27</td>
									<td>S-M</td>
									<td>94-96</td>
								</tr>
								<tr>
									<td>28</td>
									<td>M</td>
									<td>97-99</td>
								</tr>
								<tr>
									<td>29</td>
									<td>M-L</td>
									<td>100-102</td>
								</tr>
								<tr>
									<td>30</td>
									<td>L</td>
									<td>103-105</td>
								</tr>
								<tr>
									<td>31</td>
									<td>L-XL</td>
									<td>106-108</td>
								</tr>
								<tr>
									<td>32</td>
									<td>XL</td>
									<td>109-111</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--Список товаров-->
			<div id="item-list">
				<h1>Другие Предложения</h1>
				<ul>
					<?php
					$rand_product = mysql_query("SELECT `id`, `name`, `description`, `text`, `article`, `price`, `catalog_image`, `status` FROM `catalog` WHERE `id` !='" . $item_id . "' ORDER BY RAND() LIMIT 10");
					while ($offer = mysql_fetch_array($rand_product)) {

						//Разбиение строки для имени товара
						$name = explode("(", $offer['name']);
						$name = str_replace(array(')'), array('', ''), $name);
						?>
						<li>
							<a href="view.php?item=<?= $offer['id'] ?>">
								<div class="view">
									<div class="status 
                        		<?php
								if ($offer['status'] == '0') { } elseif ($offer['status'] == '1') {
									echo "new";
								} elseif ($offer['status'] == '2') {
									echo "sold";
								} else {
									echo "offer";
								}
								?>"></div><?php if ($offer['catalog_image']) {
												echo '<img src="' . $folder . 'catalog/' . $offer['catalog_image'] . '" alt="' . $offer['catalog_image'] . '">';
											} ?>
								</div>
								<div class="title"><?= $offer['name'] ?></div>
								<div class="description"><?= $offer['description'] ?></div>
								<div class="article"><?= $offer['article'] ?></div>
								<?php if ($offer['status'] != '2') {
									?>
									<div class="price"><span class="symbol">EUR</span><?= $offer['price'] ?></div>
								<?php } ?>
							</a>
						</li>
					<?php
				}
				?>
				</ul>
			</div>
			<div id="item-bottom">
				<a href="catalog.php?catid=1">
					<div class="button1">Перейти в Каталог</div>
				</a>
				<a href="index.php">
					<div class="button1">На Главную</div>
				</a>
			</div>
		</div>

		<!--Модальное окно-->
		<div class="modal" id="ex1" style="display:none;">
			<form action="mail.php" class="catalog" method="POST">
				<?php if (!empty($item['size'])) : ?>
					<?php
					$_size = explode(',',  $item['size']);
					?>
					<input name="product_size" type="hidden" value="<?php echo $_size[0] ?>" placeholder="Размер" required>
				<?php endif; ?>



				<table border="0" cellspacing="0" cellpadding="0">
					<!--   <tr>
        <td colspan="2"><p><input name="name" type="text" placeholder="Имя" required></td>
      </tr>-->
					<tr>
						<td colspan="2">
							<p><input name="mail" type="text" placeholder="E-mail" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
						</td>
					</tr>
					<!--<tr>
        <td colspan="2"><p><input name="phone" type="text" placeholder="Телефон" required pattern="^[ 0-9]+$"></td>
      </tr>-->
					<tr>
						<td colspan="2">
							<p><textarea name="message" class="textarea2" placeholder="Комментарии" cols="" required pattern="^[a-zA-Z]+$"></textarea>
						</td>
					</tr>
					<tr>
						<td style="padding-left:20px;">
							<input name="product" type="hidden" value="<?= $item['name'] . ' (' . $item['description'] . ')' ?>">
							<input name="url" type="hidden" value="<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
							Капча </td>
						<td align="right"><img src="captcha.php" style=" top:2px; left: 48px; position: relative; float:left;" />
							<input type="text" name="kapcha" class="input" style="top:0px; left:0px;width:136px; position:relative;"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input name="" type="submit" value="Отправить"></td>
					</tr>
					<tr>
						<td colspan="2" align="left">
							<div class='catalog_result'></div>
						</td>
					</tr>
				</table>
			</form>
		</div>


		<!--Корзина-->
		<?php include("blocks/cart.php"); ?>

		<script async type="text/javascript">
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
			document.getElementById("defaultOpen").click();
		</script>


		<!--Подвал-->
		<?php include("blocks/footer.php"); ?>

		<!-- Программирование Соловьёв Евгений http://freelance.ru/users/belltone/ -->
</body>

</html>