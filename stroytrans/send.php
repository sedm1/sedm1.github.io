<?php
// Получаем данные
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $mail = $_POST['email'];

  //Преобразуем
  $name = htmlspecialchars($name);
  $phone = htmlspecialchars($phone);
  $mail = htmlspecialchars($mail);

  $name = urldecode($name);
  $phone = urldecode($phone);
  $mail = urldecode($mail);

  $name = trim($name);
  $phone = trim($phone);
  $mail = trim($mail);
  
  mail(
      "Sedmich1@yandex.ru", //Та почта, на которую должны приходить письма
      "Новое письмо с сайта", //Заголовок письма
      "Имя клиента:".$name."\n".
      "Телефон:".$phone."\n".
      "Почта клиента:".$mail."\n",
      "From: no-reply@mydomain.ru \r\n"
    );

?>
