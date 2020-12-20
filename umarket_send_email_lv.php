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


if(empty($_SESSION['captcha_podpis_footer']) || ($_SESSION['captcha_podpis_footer'] != true)) {
	echo '<p style="text-align:right; color:red; ">Lūdzu apstipriniet, ka neesat robots.</p>';
	//echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
	return;
	unset($_SESSION['captcha_podpis_footer']);
}	

if(empty($email) || !isset($email)) {
	echo '<p style="text-align:right; color:red; ">Nav ievadīts Email.</p>';
	//echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
	return;
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    echo '<p style="text-align:right;color:red;">Nav ievadīts pareizi Email.</p>';
	//echo '<script type="text/javascript">setTimeout(function(){$("center").fadeOut(300)}, 1500);</script>';
	return;
}



$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

//Письмо 
$to = $row['email'];
$subject = "Рассылка UMARKET";

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


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: <UMARKET>' . "\r\nReply-to: $email\r\n";

if (mail($to ,$subject,$message,$headers)) {
	echo "
	<p style='text-align:right;color:green;'>Jūsu ziņojums ir nosūtīts.!</p>";
		unset($_SESSION['captcha_podpis_footer']);
	return;
}
else {
	echo "<p style=\"text-align:right;color:red;\">Ziņojums netika nosūtīts.</p>";
			unset($_SESSION['captcha_podpis_footer']);
	return;
}