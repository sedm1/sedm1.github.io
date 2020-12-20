<?php 
require_once('lock.php');


	

//Объявляем переменные
$name = $_POST['name'];
$name_lv= $_POST['name_lv'];
$name_en= $_POST['name_en'];
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
$meta_k = $_POST['meta_k'];
$meta_d_lv = $_POST['meta_d_lv'];
$meta_k_lv = $_POST['meta_k_lv'];
$meta_d_en = $_POST['meta_d_en'];
$meta_k_en = $_POST['meta_k_en'];
$catid = $_POST['catid'];
$subid = $_POST['subid'];
$status = $_POST['status'];
$details = $_POST['details'];
$filter_size = $_POST['filter_size'];
$age = $_POST['age'] ? $_POST['age'] : null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS NBOutlet | Добавление товара</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
<style>

</style>
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
			if(empty($_POST['text_copy'])) 
			{
				if ($name && $description && $text && $article && $price) {
					if($_FILES['catalog_image']['name']) {
						$catalog_image = basename(md5(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36).$_FILES['catalog_image']['name']) .'.jpg');
						move_uploaded_file($_FILES['catalog_image']['tmp_name'], '../uploads/catalog/'.$catalog_image);
					}
					if($_FILES['image']['name']) {
						$image = basename(md5(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36).$_FILES['image']['name']) .'.jpg');
						move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$image);
					}
					if($_FILES['image1']['name']) {
						$image1 = basename(md5(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36).$_FILES['image1']['name']) .'.jpg');
						move_uploaded_file($_FILES['image1']['tmp_name'], '../uploads/'.$image1);
					}
					if($_FILES['image2']['name']) {
						$image2 = basename(md5(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36).$_FILES['image2']['name']) .'.jpg');
						move_uploaded_file($_FILES['image2']['tmp_name'], '../uploads/'.$image2);
					}
					
					$result = mysql_query("INSERT INTO catalog (name, name_lv, name_en, description, description_lv, description_en, text, text_lv, text_en, article, price, price_stock, catalog_image, image, details, image1, image2, meta_d, meta_d_lv, meta_d_en, meta_k, meta_k_lv, meta_k_en, cat_id, sub_id, status, size, age) VALUES ('".$name."', '".$name_lv."', '".$name_en."','".$description."','".$description_lv."', '".$description_en."', '".$text."', '".$text_lv."', '".$text_en."', '".$article."', '".$price."', '".$price_stock."', '".$catalog_image."', '".$image."', '".$details."','".$image1."', '".$image2."', '".$meta_d."', '".$meta_d_lv."', '".$meta_d_en."', '".$meta_k."', '".$meta_k_lv."', '".$meta_k_en."','".$catid."', '".$subid."', '".$status."', '".strtoupper($filter_size)."', '".$age."')");
					//var_dump("INSERT INTO catalog (name, name_lv, name_en, description, description_lv, description_en, text, text_lv, text_en, article, price, price_stock, catalog_image, image, details, image1, image2, meta_d, meta_d_lv, meta_d_en, meta_k, meta_k_lv, meta_k_en, cat_id, sub_id, status, size, age) VALUES ('".$name."', '".$name_lv."', '".$name_en."','".$description."','".$description_lv."', '".$description_en."', '".$text."', '".$text_lv."', '".$text_en."', '".$article."', '".$price."', '".$price_stock."', '".$catalog_image."', '".$image."', '".$details."','".$image1."', '".$image2."', '".$meta_d."', '".$meta_d_lv."', '".$meta_d_en."', '".$meta_k."', '".$meta_k_lv."', '".$meta_k_en."','".$catid."', '".$subid."', '".$status."', '".strtoupper($filter_size)."', '".$age."')");
					
					if ($result == 'true') {
						echo 'Товар успешно добавлен!<br><br><a href="catalog.php">Вернуться</a>';
					}
					else {
						echo 'Товар не добавлен!<br><br><a href="catalog.php">Вернуться</a>';
					}
				}
				else {
					echo 'Вы ввели не всю информацию поэтому товар не может быть добавлен.<br><br><a href="javascript: history.go(-1)">Вернуться</a>';
				}
			}
			else {
				echo '<script>window.location="new_product.php?item_article='.$_POST['text_item'].'";</script>';
			}
			?>
            
            </div>
        </div>
</div>

<!--Подвал-->
<?php require_once('blocks/footer.php'); ?>
</body>
</html>