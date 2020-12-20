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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="Umarket - малопользованные товары без дефектов. Низкие цены, доставка. " />
<meta name="keywords" content="малопользованные товары,бу товары,Малопользованная техника,mazlietotas bērnu preces,
 mazlietotas preces,nocenotas preces,nocenoto preču veikals,mazlietotas mēbeles,jaunas mazlietotas,mazlietota elektrotehnika">
<title>UMARKET- <?php echo $item['name'] ?></title>
<meta name="description" content="<?=$item['meta_d'] ?>">
<meta name="keywords" content="<?=$item['meta_k'] ?>">
<link href="css/reset.min.css" rel="stylesheet" type="text/css">
<link href="css/fonts.min.css" rel="stylesheet" type="text/css">
<link href="css/magnific-popup.min.css" rel="stylesheet" type="text/css"/>

<link href="css/main-umarket.css" rel="stylesheet" type="text/css">
<!-- <link href="css/main.min.css" rel="stylesheet" type="text/css"> -->

<link href="http://allfont.ru/allfont.css?fonts=ubuntu-medium" rel="stylesheet" type="text/css" />
<!-- <link href="css/product.min.css" rel="stylesheet" type="text/css"> -->
<link href="css/selectize.min.css" rel="stylesheet" type="text/css">
<link href="css/default.min.css" rel="stylesheet" type="text/css">
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="144x144" href="images/favicon_umarket/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_umarket/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_umarket/favicon-16x16.png">
    <link rel="manifest" href="images/favicon_umarket/site.webmanifest">
    <link rel="mask-icon" href="images/favicon_umarket/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#">
<!-- <link rel="icon" type="image/png" href="/favicon.ico" sizes="32x32"> -->
<link href="js/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css"/>

<link href="css/custom-umarket.css" type="text/css" rel="stylesheet">
<!-- <link href="css/custom.min.css" type="text/css" rel="stylesheet"> -->

<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet"> 

<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script async type="text/javascript" src="fonts/Circe-Light.min.js"></script>
<script async type="text/javascript" src="fonts/Circe-Regular.min.js"></script>
<script async type="text/javascript" src="fonts/Circe-Bold.min.js"></script>
<script async type='text/javascript' src="js/ajax.min.js"></script>
<script async type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script async type="text/javascript" src="js/selectize.min.js"></script>

<script async type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>

<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->
<link rel="stylesheet" href="js/jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
<script src="js/jquery-modal-master/jquery.modal.min.js" type="text/javascript"></script>

<!-- Просмотр фотографий -->
<script type="text/javascript" src="js/fancybox/jquery.fancybox.min.js?v=2.1.5"></script>
<script type="text/javascript">
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
</script>
<!--Cufon-->
<script type="text/javascript">
	Cufon.replace('.button1', { fontFamily: 'Circe Bold', hover: true });
</script></head>
  <body>
  <div id="wrapper">
    <div id="bg_layer"></div>
    <div class="layer"></div>
    
	<!--Шапка-->
	<?php include("blocks/umarket_header".$ext.".php"); ?> 
  	<!--Товар-->
    <div id="checkout">
      <div class="container">
	    <h1 class="page-title"><?php echo $language[$lang]['title'];?></h1>
		<!-- <div class="other-discont text-center">
		  <p><?php echo $language[$lang]['discont'];?></p>
		  <a class="transparent" href="http://nboutlet.eu/discount<?php echo $ext;?>.php?catid=2&status=3"><?php echo $language[$lang]['show'];?></a>
		</div> -->
	    <?php if(isset($_SESSION['umarket_cart'])) : ?>
		  <table class="table">
		    <thead>
			  <tr>
			    <td></td>
			    <td><?php echo $language[$lang]['designation'];?> </td>
				<td class="tetx-center"><?php echo $language[$lang]['amount'];?></td>
				<td class="tetx-center"><?php echo $language[$lang]['tableprice'];?></td>
				<td class="text-right"><?php echo $language[$lang]['tabletotal'];?></td>
			  </tr>
			</thead>
			<tbody>
			  <?php foreach($_SESSION['umarket_cart']['product'] as $product) : ?>
				<?php foreach($product['options'] as $option ) : ?>
				  <tr id="product-<?php echo $product['id']; ?>-<?php echo $option['js']; ?>">
				    <td>
					  <a class="delincart" href="#" data-id="<?php echo $product['id']; ?>" data-size="<?php echo $option['size']; ?>" data-js="<?php echo $option['js']; ?>">
						<img src="images/close.jpg" alt="close">
					  </a>
					</td>
					<td>
					  <img src="<?php echo $folder . $product['image'];?>" alt="<?php echo $product['name'][$lang]; ?>">
					  <a href="/view.php?item=<?php echo $product['id']; ?>"><?php echo $product['name'][$lang]; ?> (<?php echo $product['description'][$lang]; ?>)</a>
					  <div class="row size"><?php echo $language[$lang]['size'];?>  <?php echo $option['size']; ?></div>
					  <div class="row size"><?php echo $language[$lang]['model'];?>  <?php echo $product['model']; ?></div>
					</td>
					<td class="tetx-center"><?php echo $option['quantity']; ?> <?php echo $language[$lang]['count'];?></td>
					<td class="tetx-center"><div id="price<?php echo $product['id']; ?>-<?php echo $option['js']; ?>" class="price"><?php echo $product['price']; ?></div></td>
					<td class="total-row text-right"><div id="total<?php echo $product['id']; ?>-<?php echo $option['js']; ?>" class="price"><?php echo $product['price'] * $option['quantity']; ?></div></td>
				  </tr>
				<?php endforeach; ?>
			  <?php endforeach; ?>
			</tbody>
			<tfoot>
			  <tr>
			    <td colspan="5" class="text-right"><span class="text-grey"><?php echo $language[$lang]['fooltotal'];?></span> <span class="total"><?php echo ($_SESSION['umarket_cart']['total']) ? $_SESSION['umarket_cart']['total']['sum']  : 0; ?></span></td>
			  </tr>
			</tfoot>
		  </table>
		  <a class="button-white" href="/umarket<?php echo $ext ?>.php"><?php echo $language[$lang]['continue'];?></a>
		  <a id="btn-checkout" class="right button-dark" href="javascript:void(0);"><?php echo $language[$lang]['checkout'];?></a>
		  <div class="clearfix" style="padding-top: 50px;"></div>
		  <div class="order-form">
		    <h2><?php echo $language[$lang]['registration'];?></h2>
		    <div class="box">
		      <form id="order-form" action="umarket_order.php" class="catalog" method="POST">
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr>
				    <td>
				      <label class="control-label" for="email"><?php echo $language[$lang]['email'];?></label>
				      <input id="email" name="mail" type="text" required="" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></p>
				    </td>
				    <td>
				      <label class="control-label" for="shiping"><?php echo $language[$lang]['shiping'];?></label>
				      <select name="shiping" id="shiping">
					    <option value=""><?php echo $language[$lang]['select'];?></option>
						<option value="самовывоз"><?php echo $language[$lang]['pickup'];?></option>
						<option value="Omniva"><?php echo $language[$lang]['omniva'];?></option>
						<option value="Почта"><?php echo $language[$lang]['postmail'];?></option>
					  </select>
				    </td>
				  </tr>
			      <tr>
				    <td colspan="2">
				      <label for="msg"><?php echo $language[$lang]['comment'];?></label>
				      <textarea id="msg" name="message" cols="" rows="7" required="" pattern="^[a-zA-Z]+$"></textarea>
				    </td>
			      </tr>
			    </table>
				<div class="col-xs-4">
				  <span style="display: block; float:left;padding-top: 7px; padding-left: 40px; color: #7D8082;"><?php echo $language[$lang]['captcha'];?></span>
				  <img src="captcha.php" style="display: inline-block; padding-left: 56px;"> 
				</div>
				<div class="col-xs-4">
				  <input type="text" name="kapcha" class="input" style="top:0px; left:0px;width:136px; position:relative;">
				</div>
				<div class="col-xs-4">
				  <a id="newOrder" class="button-dark" href="javascript:void(0);"><?php echo $language[$lang]['send'];?></a>
				</div>
				<div class="clearfix"></div>
			</form>
		  </div>
		  <?php include("blocks/umarket_randomproduct.php"); ?>
		<?php else : ?>
		<div class="text-center empty">
			<h2 class="text-center"><?php echo $language[$lang]['empty'];?></h2>
			<a class="button-white" href="/umarket<?php echo $ext ?>.php"><?php echo $language[$lang]['addproduct'];?></a>
		</div>
		
		<?php include("blocks/umarket_randomproduct.php"); ?>
		<?php endif; ?>
	  </div>
	</div>
	</div>
    <!--Подвал--> 
    <?php include("blocks/umarket_footer".$ext.".php"); ?>
	<?php include_once('blocks/umarket_rightcart.php')?>
	<script async src="js/jquery.sidebar.min.js"></script>
	<script async src="js/umarket_mycart.js"></script>
	
<!-- Программирование Соловьёв Евгений http://freelance.ru/users/belltone/ -->
<!-- Интеграция корзины Коморин Роман  https://freelance.ru/Ktulchu -->
</body>
</html>