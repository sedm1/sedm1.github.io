<?php
$uagent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$uagent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($uagent,0,4)))
    header('location:http://www.nboutlet.eu/index-mobile.php');
?>
    <script type="text/javascript">
        if (screen.width <= 768) {
            window.location = "http://www.nboutlet.eu/index-mobile.php";
        }
    </script>
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
$name = htmlspecialchars(trim($_POST['name']));
$mail = htmlspecialchars(trim($_POST['mail']));
$phone = htmlspecialchars(trim($_POST['phone']));  
$message = htmlspecialchars(trim($_POST['message'])); 
$product = htmlspecialchars(trim($_POST['product'])); 
$url = htmlspecialchars(trim($_POST['url'])); 

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
$subject = "Запрос с сайта (NB Outlet)";

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
<h4>Контакты:</h4>
Е-майл: <a href='mailto:". $mail."'>". $mail."</a>
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
	echo "
	<center>Ваше сообщение было отправлено!</center><br>
	<center>Thank you for your order!</center>
	<script type='text/javascript'>setTimeout(function() {location.reload('".$url."')}, 1500)</script>
	";
}
else {
	echo "<center>Сообщение не было отправлено.</center>";
}
}
?>