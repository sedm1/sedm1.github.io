<?php 
require_once('lock.php');
 
//Объявляем переменные
$id = $_POST['id'];
$name = $_POST['name'];
$name_lv = $_POST['name_lv'];
$name_en = $_POST['name_en'];
$description = $_POST['description'];
$description_lv = $_POST['description_lv'];
$description_en = $_POST['description_en'];
$text = $_POST['text'];
$text_lv = $_POST['text_lv']; 
$text_en = $_POST['text_en']; 
$article = $_POST['article'];
$price = $_POST['price'];
$price_stock = $_POST['price_stock'];
$meta_d = $_POST['meta_d'];
$meta_d_lv = $_POST['meta_d_lv'];
$meta_d_en = $_POST['meta_d_en'];
$meta_k = $_POST['meta_k'];
$meta_k_lv = $_POST['meta_k_lv'];
$meta_k_en = $_POST['meta_k_en'];
$catid = $_POST['catid'];
$subid = $_POST['subid'];
$status = $_POST['status'];
$details = $_POST['details'];
$filter_size = $_POST['filter_size'];
$age = $_POST['age'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS NBOutlet | Добавление товара</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
</head>
<body>
<div class="wrapper">

	<!-- Шапка -->   
	<div class="header"></div>
        <div class="content">
            <div class="contentcontent clearfix">
            
            <!--Меню-->
            <?php require_once('blocks/sidebar.php'); ?>
                
            <!--Контент-->
            <div class="right-column">
            <div class="title"><a href="catalog.php">Каталог</a> / Добавление товара</div>
			
			<?php
			if($name && $description && $text && $article && $price) {
				
			//Функция добавления и удаления фотографии
			$path = "../uploads/";
			
			$catalog_image = "";
			$image = "";
			$image1 = "";
			$image2 = "";
			$catalog_image_update = "";
			$image_update = "";
			$image1_update = "";
			$image2_update = "";
			$catalog_image_uploaded = false;
			$image_uploaded = false;
			$image1_uploaded = false;
			$image2_uploaded = false;
			
			$catalog_tmp = $_FILES["catalog_image"]["tmp_name"];
			$tmp = $_FILES["image"]["tmp_name"];
			$tmp1 = $_FILES["image1"]["tmp_name"];
			$tmp2 = $_FILES["image2"]["tmp_name"];
			
			if(is_uploaded_file($catalog_tmp)){		
				move_uploaded_file($catalog_tmp, $path.'catalog/' .$img = md5(uniqid(rand() , 1)) . '.jpg');
				@unlink($path.'catalog/' .$_POST['cat_img_del']);
				$catalog_image = $img;            
				$catalog_image_uploaded = true; }
			if($catalog_image_uploaded) {
				$catalog_image_update = ",catalog_image='".$catalog_image."' "; 
			}
			
			if(is_uploaded_file($tmp)){		
				move_uploaded_file($tmp, $path .$img = md5(uniqid(rand() , 1)) . '.jpg');
				@unlink($path .$_POST['del']);
				$image = $img;            
				$image_uploaded = true; }
			if($image_uploaded) {
				$image_update = ",image='".$image."' "; 
			}
			
			if(is_uploaded_file($tmp1)){		
				move_uploaded_file($tmp1, $path .$img = md5(uniqid(rand() , 1)) . '.jpg');
				@unlink($path .$_POST['del1']);
				$image1 = $img;            
				$image1_uploaded = true; }
			if($image1_uploaded) {
				$image1_update = ",image1='".$image1."' "; 
			}
			
			if(is_uploaded_file($tmp2)){		
				move_uploaded_file($tmp2, $path .$img = md5(uniqid(rand() , 1)) . '.jpg');
				@unlink($path .$_POST['del2']);
				$image2 = $img;            
				$image2_uploaded = true; }
			if($image2_uploaded) {
				$image2_update = ",image2='".$image2."' "; 
			}
		 
			//Удаление фото
			if($_POST['delete_catalog_image']) {
			  @unlink($path.'catalog/' .$_POST['cat_img_del']);
			  $catalog_image_update = ",catalog_image='' ";
			  echo '<script>window.location="edit_product.php?id='.$_POST['id'].'";</script>';
			}
			if($_POST['delete_image']) {
			  @unlink($path .$_POST['del']);
			  $image_update = ",image='' "; 
			  echo '<script>window.location="edit_product.php?id='.$_POST['id'].'";</script>';
			}
			if($_POST['delete_image1']) {
			  @unlink($path .$_POST['del1']);
			  $image1_update = ",image1='' "; 
			  echo '<script>window.location="edit_product.php?id='.$_POST['id'].'";</script>';
			}
			if($_POST['delete_image2']) {
			  @unlink($path .$_POST['del2']);
			  $image2_update = ",image2='' "; 
			  echo '<script>window.location="edit_product.php?id='.$_POST['id'].'";</script>';
			}
			
			$sql = mysql_query("SELECT id, cat_id FROM `subcategory` WHERE `id`='".$subid."'");
			$row = mysql_fetch_array($sql);
			
			$update = mysql_query("UPDATE `catalog` SET `name`='".$name."', `name_lv`='".$name_lv."', `name_en`='".$name_en."', `description`='".$description."',  `description_lv`='".$description_lv."', `description_en`='".$description_en."',  `size`='".strtoupper($filter_size)."', `text`='".$text."', `text_lv`='".$text_lv."',`text_en`='".$text_en."',  `article`='".$article."', `price`='".$price."', `price_stock`='".$price_stock."', `meta_d`='".$meta_d."', `meta_d_lv`='".$meta_d_lv."', `meta_d_en`='".$meta_d_en."', `meta_k`='".$meta_k."', `meta_k_lv`='".$meta_k_lv."', `meta_k_en`='".$meta_k_en."',  `status`='".$status."',`cat_id`='".$row['cat_id']."', `details`='".$details."', `age`='".$age."', `sub_id`='".$row['id']."' ".$catalog_image_update." ".$image_update." ".$image1_update." ".$image2_update." WHERE `id`='".$id."' ");
			if ($update == true) {
				
				
				echo 'Информация успешно обновлена!<br><br><a href="catalog.php">Вернуться</a>';
			}
			else {
				echo 'Информация не обновлена!<br><br><a href="catalog.php">Вернуться</a>';
			}
			}
			else {
				echo 'Вы ввели не всю информацию, поэтому товар не может быть обновлён.<br><br><a href="edit_product.php?id='.$id.'">Вернуться</a>';
			}
			?>
            
            </div>
        </div>
</div>

<!--Подвал-->
<?php require_once('blocks/footer.php'); ?>
</body>
</html>