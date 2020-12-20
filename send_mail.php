<?php
session_start();

// Обработка полей формы 
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$phone = htmlspecialchars(trim($_POST['phone']));  
$message = htmlspecialchars(trim($_POST['message'])); 
$product = htmlspecialchars(trim($_POST['product'])); 
$url = htmlspecialchars(trim($_POST['url'])); 
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,700italic);
center {
	font:15px 'Circe-Regular', sans-serif;
	float:left;
    color: #ad2829;
	margin:20px 0 0 0;
}
</style>
<?php
require_once("config.php");
if($_POST['kapcha'] != $_SESSION['rand_code']) {
		echo '<center>Капча введена неверно.</center>';
		echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
}
else {
$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

$to = $row['email'];
$subject = 'Запрос с сайта';

// Письмо 
$message ="
	<style>
	body {font: 14px/17px Arial, Helvetica, sans-serif;}
	</style>
	<html>
	<head>
	</head>
	<body>
	<h4><a href='".$url."'>".$product."</a></h4>
	". $message."
	<br>
	<h4>Контакты:</h4>
	Имя: ". $name."<br>
	Телефон: ". $phone."<br>
	Е-майл: <a href='mailto:". $email."'>". $email."</a>
	</body>
	</html> 
			   ";
    $boundary = md5(uniqid(time()));
    $sender = "=?utf-8?B?".base64_encode('Site NBOutlet.eu')."?= <zm3158589525lt@bpauto.lv>";
    $headers[] ="MIME-Version: 1.0";
    $headers[] ="Content-Type: multipart/mixed;boundary=\"$boundary\"; type=\"text/html;\"";
    $headers[] ="From: ".$sender;
    $headers[] ="Reply-To: ".$email;
    $headers[] ="X-Mailer: PHP/" . phpversion();
    $headers=implode("\r\n", $headers);
    if (mb_detect_encoding($subject, "UTF-8")==FALSE)
        $subject= mb_encode_mimeheader($subject,"UTF-8", "B", "\n");

    $multipart[]= "--".$boundary;
    $multipart[]= "Content-Type: text/html; charset=utf-8";
    $multipart[]= "Content-Transfer-Encoding: Quot-Printed";
    $multipart[]= ""; // раздел между заголовками и телом html-части
    $multipart[]= $message;
    $multipart[]= "";
    $multipart[]= "--$boundary--";
    $multipart[]= "";
    $multipart=implode("\r\n", $multipart);

    if (mail($to ,$subject,$multipart,$headers))
	echo "
	<center>Ваше сообщение было отправлено!</center>
	<script type='text/javascript'>setTimeout(function() {location.reload('".$url."')}, 1500)</script>
	";
else
	echo "<center>Сообщение не было отправлено.</center>";
}
?>