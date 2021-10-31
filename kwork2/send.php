<?php 
	//Получаем
	$name = $_POST['Name'];
	$number = $_POST['Number'];
	$model = $_POST['Model'];
	$problem = $_POST['Problem'];

	//Фильтруем
	$name = trim(urldecode(htmlspecialchars($name)));
	$number = trim(urldecode(htmlspecialchars($number)));
	$model = trim(urldecode(htmlspecialchars($model)));
	$problem = trim(urldecode(htmlspecialchars($problem)));

	//Отправка
	if(mail("novikovn383@gmail.com",
			"Заявка с сайта",
			"Имя клиента: ".$name."\n".
			"Номер клиента: ".$number."\n".
			"Модель телефона: ".$model."\n".
			"Проблема: ".$problem,
			"From: no-reply@revoltservice.ru \r\n");
	  ){
		echo "Письмо успешно отправленно";
	}
?>