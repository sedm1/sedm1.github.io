<?php
session_start();
$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
?>

	<style type="text/css">
		.center {
			display         : flex;
			justify-content : center;
			align-items     : center;
			font            : 15px 'Circe-Regular', sans-serif;
			/*float  : left;*/
			/*text-align: center;*/
			color           : #ad2829;
			margin          : 20px 0 0 0;
			}
	</style>

<?php
// Обработка полей формы 
$name    = htmlspecialchars(trim($_POST['name']));
$mail    = htmlspecialchars(trim($_POST['mail']));
$phone   = htmlspecialchars(trim($_POST['phone']));
$message = htmlspecialchars(trim($_POST['message']));
$product = htmlspecialchars(trim($_POST['product']));
$url     = htmlspecialchars(trim($_POST['url']));
$shiping = htmlspecialchars(trim($_POST['shiping']));

require_once("config.php"); //Подключение к бд

if ($_POST['kapcha'] != $_SESSION['rand_code']) {
    echo '<div class="center" id="center">Капча введена неверно.</div>';
    echo '<script type="text/javascript">setTimeout(function(){$(".center").fadeOut(300)}, 1500);</script>';
} else {
$result = mysql_query("SELECT `email` FROM `userlist`");
$row = mysql_fetch_array($result);

//Письмо 
$to = $row['email'];
    $subject = "NB Outlet (Купить Сразу) " . ($lang == 'ru' ? 'RUS' : ($lang == 'en' ? 'ENG' : 'LV'));

    $message = "
<style type='text/css'>
body {font: 14px/17px Arial, Helvetica, sans-serif;}
</style>
<html>
<head>
</head>
<body>
<h4><a href='" . $url . "'>" . $product . "</a></h4>
" . $message . "
<br>
<h4>Доставка:</h4>" . $shiping . "<br>
<h4>Контакты:</h4>
Е-майл: <a href='mailto:" . $mail . "'>" . $mail . "</a>
</body>
</html> 
";

    $boundary = md5(uniqid(time()));
    $sender = "=?utf-8?B?".base64_encode('Site NBOutlet.eu')."?= <zm3158589525lt@bpauto.lv>";
    $headers[] ="MIME-Version: 1.0";
    $headers[] ="Content-Type: multipart/mixed;boundary=\"$boundary\"; type=\"text/html;\"";
    $headers[] ="From: ".$sender;
    $headers[] ="Reply-To: ".$mail;
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

    if(mail($to,$subject,$multipart,$headers)) {
        if ($lang == 'ru') {
            $json['success'] = 'Спасибо за ваш заказ.<br> Мы свяжемся с вами в ближайшее время.';
        } elseif ($lang == 'lv') {
            $json['success'] = 'Paldies par jūsu pasūtījuma.<br> Mēs ar Jums sazināsimies tuvākajā laikā.';
        } else {
            $json['success'] = 'Thank you for your order.<br> We will contact you soon. ';
        }

        echo "<div class='center' id='center'>" . $json['success'] . "</div>
				<script type='text/javascript'>
		if (location.pathname.indexOf('/mail.php') != -1) {
		    
		   var center = document.getElementById('center');
		   var lang = '$lang';
		     center.style.display = 'flex';
		     center.style.alignItems = 'center';
		     center.style.justifyContent = 'center';
		     center.style.width = '90%';
		     center.style.minHeight = '150px';
		     center.style.fontSize = '24px';
		     center.style.position = 'absolute';
		     center.style.top = '50%';
		     center.style.left = '50%';
		     center.style.transform = 'translate(-50%,-50%)';
		     center.style.boxShadow = '0px 0px 11px -4px rgba(0,0,0,1)';
		     setTimeout(function() {
		     if (lang == 'ru'){	        		   
				 location.href='/index-mobile.php';
		     }else {      
				 location.href='/index-mobile_$lang.php';
		     }
		     },1500)
		}else {setTimeout(function() {location.reload('" . $url . "', true)}, 1500);
		}
	</script>";
    } else {
        echo "<div class='center' id='center'>Сообщение не было отправлено.</div>";
    }
}
?>