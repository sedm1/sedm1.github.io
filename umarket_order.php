<?php
session_start();

$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';

// Обработка полей формы 
$mail = htmlspecialchars(trim($_POST['mail']));
$shiping = htmlspecialchars(trim($_POST['shiping']));  
$message = htmlspecialchars(trim($_POST['message'])); 
$kapcha = htmlspecialchars(trim($_POST['kapcha'])); 

require_once("config.php"); //Подключение к бд

if($_POST['kapcha'] != $_SESSION['rand_code']) {
		$html = '<center>Капча введена неверно.</center>';
		$json['error'] = $html;
		echo json_encode($json);
		die;
}
elseif(!$_SESSION['umarket_cart'])
{
	$html = '<center>Ваша карзина пуста.</center>';
	$json['error'] = $html;
	echo json_encode($json);
	die;
}
else {
/*
if (isset($_SERVER['HTTPS']))
    $scheme = $_SERVER['HTTPS'];
else
    $scheme = '';

if (($scheme) && ($scheme != 'off')) $scheme = 'https://';
	else $scheme = 'http://';

$image_dir = $scheme.$_SERVER['SERVER_NAME'].'/uploads/';*/
$image_dir = 'http://nboutlet.eu/uploads/';

$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

//Письмо 
$to = $row['email'];
$subject = "Заказ с сайта UMARKET (Корзина)";

$html = '<div style="width: 680px;">';
  $html .= 'E-mail покупателя: '.$mail.'<br/>';
  $html .= 'Способ доставки: '.$shiping;
  $html .= '<table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">';
  $html .= '<thead>';
    $html .= '<tr>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Фото</td>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Название</td>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Артикул</td>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Размер</td>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Колличество</td>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Цена</td>';
	  $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Сумма</td>';
	$html .= '</tr>';
  $html .= '</thead>';
  $html .= '<tbody>';
  foreach($_SESSION['umarket_cart']['product'] as $product)
  {
	 foreach($product['options'] as $option )
	 {
		 $html .= '<tr>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"> <img style="width:98px;" src="' . $image_dir . $product['image'] . '" alt="' . $product['name'] . '"/></td>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">'. $product['name'][$lang] .' (' .$product['description'][$lang]. ') </td>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">'. $product['model'].'</td>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">'. $option['size'].'</td>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">'. $product['quantity'].'</td>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">'. $product['price'].'</td>';
		   $html .= '<td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">'. $product['price'] * $product['quantity'].'</td>';
		 $html .= '</tr>';  
		 $html .= '<tr>';
		   $html .= '<td colspan="6" style="font-size: 12px; border-right: 1px solid #DDDDDD; border-top: 1px solid #DDDDDD; text-align: left;"></td>';
		 $html .= '</tr>';  
	 }
  }
  $html .= '</tbody>';
  $html .= '</table>';
  if(!empty($message))
  {
	  $html .= '<div style="padding-top:20px">Примечание:<br/>';
	  $html .= $message;
	  $html .= '</div>';
  }
$html .= '</div>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//$headers .= 'From: <NBOutlet>' . "\r\nReply-to: $mail\r\n";
$headers .= 'From: '.$mail . "\r\nReply-to: $mail\r\n";

if(mail($to,$subject, $html,$headers))
{
	if($lang == 'ru') $ext = '';
	else $ext = '_'.$lang;
	
	unset($_SESSION['umarket_cart']);
	if($lang == 'ru'){$json['success'] = 'Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время.';}
	elseif($lang == 'lv'){$json['success'] = 'Paldies par jūsu pasūtījuma. Mēs ar Jums sazināsimies tuvākajā laikā.';}
	else {$json['success'] = 'Thank you for your order. We will contact you soon. ' ;}
	$json['redirect'] = '/umarket'.$ext.'.php';
	echo json_encode($json);
}
}
?>
