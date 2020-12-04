
<?php
  $name = $_POST['name'];
  $number = $_POST['number'];
  $email = $_POST['email'];
  $text = $_POST['text'];

  $name = htmlspecialchars($name);
  $number = htmlspecialchars($number);
  $email = htmlspecialchars($email);
  $text = htmlspecialchars($text);


  $name = urldecode($name);
  $number = urldecode($number);
  $email = urldecode($email);
  $text = urldecode($text);

  $name = trim($name);
  $number = trim($number);
  $email = trim($email);
  $text = trim($text);

  if (mail("novikovn383@gmail.com", "Заявка с сайта", "ФИО:".$name. ". Телефон:".$number.". Текст: ". $text.". E-mail: ".$email ,"From: nikolaynovikov333@gmail.com \r\n"))
   {     echo "сообщение успешно отправлено";
  } else {
      echo "при отправке сообщения возникли ошибки";
}?>
