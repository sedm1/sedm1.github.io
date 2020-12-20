<?php
	require_once("lock.php");
	require_once("../config.php"); //Подключение к бд
	
	$sql = mysql_query("SELECT * FROM `catalog` WHERE `id`='".$_POST['id']."'");
	$row = mysql_fetch_array($sql);

	$result = mysql_query("DELETE FROM `catalog` WHERE `id`='".$_POST['id']."';");
	if ($result == true) {
		echo '
		<div class="notification success"><a href="#" class="close">close</a><div>Запись успешно удалена!</div></div>
		<script type="text/javascript">setTimeout(function() {location.reload("catalog.php")}, 1500)</script>
		';
		
		//Удаление всех изображений товара
		$catalog_photo = "../uploads/catalog/".$row['catalog_image']."";
		$image = "../uploads/".$row['image']."";
		$image1 = "../uploads/".$row['image1']."";
		$image2 = "../uploads/".$row['image2']."";
		
		@unlink($catalog_photo);
		@unlink($image);
		@unlink($image1);
		@unlink($image2);
	}
	else {
		echo '<div class="notification error"><a href="#" class="close">close</a><div>Запись не удалена!</div></div>
		<script type="text/javascript">setTimeout(function() {location.reload("catalog.php")}, 1500)</script>
		';
	}
?>