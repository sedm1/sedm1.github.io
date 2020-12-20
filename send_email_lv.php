<?php 
session_start();
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
$email = htmlspecialchars(trim($_POST['email']));

require_once("config.php"); //Подключение к бд


if(empty($_SESSION['captcha_podpis_footer_en']) || ($_SESSION['captcha_podpis_footer_en'] != true)) {
	
	echo '<p style="text-align:right; color:red; ">Lūdzu apstipriniet, ka neesat robots.</p>';
	//echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
	return;
	unset($_SESSION['captcha_podpis_footer_en']);
}	

if(empty($email) || !isset($email)) {
	echo '<p style="text-align:right; color:red; ">Не введен Email.</p>';
	//echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
	return;
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    echo '<p style="text-align:right;color:red;">Не корректно введен Email.</p>';
	//echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
	return;
}



$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

//Письмо 
$to = $row['email'];
$subject = "NB Outlet (Рассылка) LV";

$message = "
<style type='text/css'>
body {font: 14px/17px Arial, Helvetica, sans-serif;}
</style>
<html>
<head>
</head>
<body>
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

if (mail($to ,$subject,$multipart,$headers)) {
	echo "
	<p style='text-align:right;color:green;'>Ваше сообщение было отправлено!</p>";
		unset($_SESSION['captcha_podpis_footer_en']);
	return;
}
else {
	echo "<p style=\"text-align:right;color:red;\">Сообщение не было отправлено.</p>";
			unset($_SESSION['captcha_podpis_footer_en']);
	return;
}