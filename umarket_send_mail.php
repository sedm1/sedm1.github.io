<?php
session_start();

// Обработка полей формы 
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$phone = htmlspecialchars(trim($_POST['phone']));  
$message = htmlspecialchars(trim($_POST['message'])); 
// $product = htmlspecialchars(trim($_POST['product'])); 
// $url = htmlspecialchars(trim($_POST['url'])); 


?>
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,700italic);
center {
	font:15px 'Circe-Regular', sans-serif;
	float:left;
    color: #ad2829;
	margin:20px 0 0 0;
}

/* Стили к Всплывающая форма Ваш запрос отправлен */

    
    .wrap-login {
            z-index: 10001;
            width: 430px !important;
            height: 403px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
            border: 3px solid #f25448;
            background-color: #fff;
            position: fixed;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            padding: 30px;
            font-size: 16px;
            line-height: 1.65;
            font-family: Roboto, sans-serif;
            font-weight: 400;
            color: #212529;
            text-align: left;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
			-webkit-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.56);
			-moz-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.56);
			box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.56);
        }
        #request,
        #request-write {
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            border:none;
            /* position:absolute; */
        }
        #request-write {
            top: 0;
            left: 0;
        }
        .request-close {
            font-family: OpenSans, sans-serif;
            font-size: 14px;
            font-weight: 400;
            opacity: .7;
            position:absolute;
            top: 5px;
            right: 15px;
            text-decoration: none;
            color: #5d5d5d;
            cursor:pointer;
        }
        .request-img {
            width:50px;
            height:auto;
        }
        #request p,
        #request-write p {
            font-weight: 400;
            font-family: OpenSans, sans-serif;
            font-size: 20px;
            opacity: .7;
            color: #5d5d5d;
            text-align:center;
        }
</style>

<?php
require_once("config.php");

if ( filter_var($email, FILTER_VALIDATE_EMAIL)) {

}else{
    if($_GET['lang']=="lv") { 
            echo "<center>Адрес указан не правильно.</center>
            <script type='text/javascript'>setTimeout(function() {location.replace('http://www.nboutlet.eu/umarket_lv.php')}, 1500)</script>";
            exit (); 
        }else {
            echo "<center>Адрес указан не правильно.</center>
             <script type='text/javascript'>setTimeout(function() {location.replace('http://www.nboutlet.eu/umarket.php')},      1500)</script>";
            exit();
        }
} 

if($_POST['kapcha'] != $_SESSION['rand_code']) {

    if($_GET['lang']=="lv"){ 
		echo "<center>Captcha ievadīts nepareizi.</center>
	    <script type='text/javascript'>setTimeout(function() {location.replace('http://www.nboutlet.eu/umarket_lv.php')}, 1500)</script>";
    }else{
        echo "<center>Капча введена неверно.</center>
	    <script type='text/javascript'>setTimeout(function() {location.replace('http://www.nboutlet.eu/umarket.php')}, 1500)</script>";
    }
}
else {
$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

$to = $row['email'];
$subject = 'Запрос с сайта UMARKET';

// Письмо 
$message ="
	<style>
	body {font: 14px/17px Arial, Helvetica, sans-serif;}
	</style>
	<html>
	<head>
	</head>
	<body>
    ". $message."
    <br>
    <br>
	Е-майл: <a href='mailto:". $email."'>". $email."</a>
	</body>
	</html> 
			   "; 
$headers  = 'From: '.$email."\r\n" .
			'Reply-To: '.$email . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" .
			'Content-type: text/html; charset=utf-8' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
if(mail($to,$subject,$message,$headers)){

    if($_GET['lang']=="lv"){ 
	    echo '<div class="wrap wrap-login" id="request" style="height: 245px; display:block;">
		<div class="request-close" id="close-request" href="#">X</div>
		<img id="request-img" src="/images/umarket_check-green.png" alt="check" class="request-img">
	   <p>Paldies par Jūsu pieprasījumu!</p>
	</div>
	    <script type="text/javascript">setTimeout(function() {location.replace("http://www.nboutlet.eu/umarket_lv.php")}, 1500)</script>';
    }else {
        echo '
		<div class="wrap wrap-login" id="request" style="height: 245px; display:block;">
			<div class="request-close" id="close-request" href="#">X</div>
			<img id="request-img" src="/images/umarket_check-green.png" alt="check" class="request-img">
		   <p>Ваш запрос отправлен!</p>
		</div>
	    <script type="text/javascript">setTimeout(function() {location.replace("http://www.nboutlet.eu/umarket.php")}, 1500)</script>';
    }
}else {

    if($_GET['lang']=="lv"){ 
	echo "<center>Ziņojums netika nosūtīts.</center>";
    }else {
	echo "<center>Сообщение не было отправлено.</center>";
    }
}
}
?>
<script>
      $('.request-close').on('click',function(e){
                  $('#request').hide();
                  $('#request-write').hide();
                  $('.wrap-login').hide();
              });
           
</script>