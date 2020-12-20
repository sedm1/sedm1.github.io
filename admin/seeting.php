<?php
require_once('lock.php');
$result = mysql_query("SELECT * FROM userlist");
$row = mysql_fetch_array($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS NBOutlet | Настройки</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<style>
.table2 table {
	width:100%;
}
.table2   td, th {
	width:235px;
    padding: 2px 0;
	float:left;
}
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
            <div class="title">Настройки</div>
			
			<div class="catalog_result"></div>
			
			<div class="table2">
			<form action="update_seeting.php" class="catalog" method="POST">
			<table width="60%" cellspacing="0" border="0">
				<tr>
					<td style="width:132px;">Логин:</td>
					<td><input name="name" type="text" value="<?=$row['name'] ?>" style="width:200px;"></td>
				</tr>
				<tr>
					<td style="width:132px;">Пароль:</td>
					<td><input name="new_password" type="password" style="width:200px;"></td>
				</tr>
				<tr>
					<td style="width:132px;">Е-майл:</td>
					<td><input name="email" type="text" value="<?=$row['email'] ?>" style="width:200px;"></td>
				</tr>
				<tr>
					<td style="width:132px;">Кол-о товаров:</td>
					<td><input name="col_list" type="number" min="0" max="100" value="<?= $row['col_list']; ?>" style="width:56px;">
					</td>
				</tr>
				<tr>
					<td style="width:132px;">Статистика:</td>
					<td>
					<label>
						<input  type="radio" name="stat" value="1" <?php if($row['stat'] == '1') echo 'checked'?>>
					Да</label>
					<label style="margin-left:6px;">
						<input type="radio" name="stat" value="0" <?php if($row['stat'] == '0') echo 'checked'?>>
					Нет</label>
					</td>
				</tr>
			</table>
			
			<div class="bar">
			<input hidden name="password" value="<?=$row['pass'] ?>">
            <input name="edit" type="submit" class="btn" style="left:-15px; position:relative;" value="Изменить данные">
            </div>
			</form>
			</div>
			
            </div>
        </div>
</div>

<!--Подвал-->
<?php require_once('blocks/footer.php'); ?>
</body>
</html>