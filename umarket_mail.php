<?php
session_start();
$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
?>

<style type="text/css">
center {
	font: 15px 'Circe-Regular', sans-serif;
	float: left;
    color: #ad2829;
	margin: 20px 0 0 0;
}
</style>

<?php
// Обработка полей формы 
$name = htmlspecialchars(trim($_POST['name']));
$mail = htmlspecialchars(trim($_POST['mail']));
$phone = htmlspecialchars(trim($_POST['phone']));  
$message = htmlspecialchars(trim($_POST['message'])); 
$product = htmlspecialchars(trim($_POST['product'])); 
$url = htmlspecialchars(trim($_POST['url'])); 
$shiping = htmlspecialchars(trim($_POST['shiping'])); 

require_once("config.php"); //Подключение к бд

if($_POST['kapcha'] != $_SESSION['rand_code']) {
		echo '<center>Капча введена неверно.</center>';
		echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
}
else {
$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

//Письмо 
$to = $row['email'];
$subject = "Заказ с сайта UMARKET (Купить Сразу)";

$message = "
<style type='text/css'>
body {font: 14px/17px Arial, Helvetica, sans-serif;}
</style>
<html>
<head>
</head>
<body>
<h4><a href='".$url."'>".$product."</a></h4>
". $message."
<br>
<h4>Доставка:</h4>". $shiping."<br>
<h4>Контакты:</h4>
Е-майл: <a href='mailto:". $mail."'>". $mail."</a>
</body>
</html> 
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//$headers .= 'From: <NBOutlet>' . "\r\nReply-to: $mail\r\n";
$headers .= 'From: '.$mail . "\r\nReply-to: $mail\r\n";

if (mail($to,$subject,$message,$headers)) {
	if($lang == 'ru'){$json['success'] = 'Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время.';}
	elseif($lang == 'lv'){$json['success'] = 'Paldies par jūsu pasūtījuma. Mēs ar Jums sazināsimies tuvākajā laikā.';}
	else {$json['success'] = 'Thank you for your order. We will contact you soon. ' ;}
	echo "
	<center>".$json['success']."</center>
	<script type='text/javascript'>setTimeout(function() {location.reload('".$url."')}, 1500)</script>
	";
}
else {
	echo "<center>Сообщение не было отправлено.</center>";
}
}
?>