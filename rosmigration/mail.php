<?php 
$to="";
$title = "Заявка с сайта";
$name=clear_data($_POST['name']);
$email=clear_data($_POST['mail']);
$phone=clear_data($_POST['phone']);
$mess=clear_data($_POST['mess']);
$headers = "From: text@site.ru\r\n";
$headers .= "Reply-To: text@site.ru\r\n";
$headers .= "X-Mailer: PHP/". phpversion();
$message = 'Имя: '. $name."\n" . "Email: ". $email."\n" . "Номер телефона: ". $phone."\n" ."Сообщение: ". $mess."\n";
function clear_data($val){
    $val = trim($val)
    $val = stripslashes($val)
    $val = htmlspecialchars($val)
    return $val;
};

mail($to, $title, $message, $headers);
?>