<?php
	require_once("lock.php");
	require_once("../config.php"); //Подключение к бд

	$name = $_POST['name'];
	$new_password = $_POST['new_password'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$col_list = $_POST['col_list'];
	$stat = $_POST['stat'];
	
	if(!$new_password == "") $password = md5($new_password);
	
	$result = mysql_query("UPDATE userlist SET name='".$name."', pass='".$password."', email='".$email."', col_list='".$col_list."', stat='".$stat."'");
	if ($result == true) {
		echo '
		<div class="notification success"><a href="#" class="close">close</a><div>Данные успешно обновлены.</div></div>
		<script type="text/javascript">setTimeout(function(){$(".notification").fadeOut(300)}, 1500);</script>
		';
	}
	else {
		echo '<div class="notification error"></a><div>Данные не обновлены!</div></div>
		<script type="text/javascript">setTimeout(function() {location.reload("seeting.php")}, 1500)</script>
		';
	}
?>