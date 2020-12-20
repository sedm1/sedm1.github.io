<?php
require_once('lock.php');

if(isset($_POST['col-item'])) { 
	setcookie('col-item', $_POST['col-item'], time() + (86400 * 30), "/"); // 86400 = 1 день);	 
	header('Location: catalog.php');
}
if(isset($_POST['cat'])) { 
	setcookie('cat', $_POST['cat'], time() + (86400 * 30), "/"); // 86400 = 1 день);	 
	header('Location: catalog.php');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS NBOutlet | Каталог</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<style type="text/css">
.select-col {
	width:51px;
	height:26px;
	color:#3f3f3f;
	font-size:13px;
	padding:2px 5px;
	margin:0 0 0 3px;
	border-radius:2px;
	border:1px solid #ccc;
	cursor:pointer;
}
.table-bar {
	width:100%;
	height:26px;
	margin:0 0 16px 0px;
}
.table-bar .col-1 {
	min-width:100px;
	float:left;
}
.table-bar .col-2 {
	min-width:100px;
	float:right;
}
.notification { 
	margin: 22px 0 18px 0;
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
            
            <div class="title">Каталог</div>
			<div class="table-bar">
            <form action="catalog.php" method="POST" style="display: inline;">
            <div class="col-1">
                Категория:
                <select name="cat" class="select-col" onchange="this.form.submit()" style="width:197px;">
                <?php
                $category=mysql_query("SELECT * FROM `category`");
                while($cat = mysql_fetch_array($category)) {	
                echo '<option value="'.$cat["category"].'" disabled>-- '.$cat["category"].' --</option>'; 
                    $subcategory = mysql_query("SELECT * FROM `subcategory`");
                    while($sub = mysql_fetch_array($subcategory)) {	
                        if ($cat["id"] == $sub["cat_id"]) {
                        ?>
                        <option value="<?=$sub["id"] ?>" style="padding:0px 0 0 20px;" <?php if($sub["id"] == $_COOKIE['cat']) { echo 'selected'; } ?>><?=$sub["subcategory"] ?></option>
                        <?php
                        }
                    }
                }
                ?>
                </select>
				 </form>
            </div>
			  <form action="catalog.php" method="POST">
					      <input name="search_product" type="text" class="select-col" style="width: 123px; height: 20px; cursor: text;"/>
						  <input type="submit" value="Найти" name="btn_search_product" style="width: 70px; height: 26px; cursor: pointer;">
					    </form>
            <div class="col-2">
              <form action="new_product.php" style="text-decoration:none;" method="POST">
				
					<input type="submit" class="add" style="padding-right:0;" value="Добавить товар">
			</form>
            </div>
           
            </div>
            
            <div class="table-list">
            <table cellspacing="0">
            <thead>
              <tr>
                  <th width="200">Название товара</th>
                  <th width="25">Артикул</th>
                   <th width="25">Цена &euro;</th>
                  <th width="25">Действия</th>
              </tr>
            </thead>
			
			<div class="catalog_result"></div>

            <?php
			$page = intval($_GET['page']);
			
			if($_COOKIE['col-item'] == "") { $num = 6; } else { $num = $_COOKIE['col-item']; }
			if($_COOKIE['cat'] == "") { $cat = 1; } else { $cat = $_COOKIE['cat']; }
			
			if ($page==0) $page=1;
			
			$query = "SELECT count(`id`) FROM `catalog` WHERE sub_id='".$cat."'";
			
			if(isset($_POST['btn_search_product']) && isset($_POST['search_product'])) {        //если нажата кнопка поиска то изменяем sql запрос
					$stroka_search = $_POST['search_product'];
					$sql = mysql_query("SELECT count(`id`) FROM catalog WHERE ((name LIKE '%$stroka_search%') OR (article LIKE '%$stroka_search%')) ");
			}
			
			$mysql_result = mysql_query($query);
			 
			if(mysql_num_rows($mysql_result)>0) {
				$count=mysql_fetch_row($mysql_result);
				}
			$posts = $count[0];
			$total = intval(($posts - 1) / $num) + 1;
			$page = intval($page);
	
			if(empty($page) or $page < 0) $page = 1;
			if($page > $total) $page = $total;
	
			$start = $page * $num - $num;
			
			if ($page != 1) $pervpage = '<a href="'.$_SERVER['SCRIPT_NAME'].'?page=-1"><<</a><a href="'.$_SERVER['SCRIPT_NAME'].'?page='. ($page - 1).'"><</a> ';
			if ($page != $total) $nextpage = '  <a href="'.$_SERVER['SCRIPT_NAME'].'?page='. ($page + 1).'">></a><a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$total.'">>></a> ';
			if($page - 2 > 0) $page2left = ' <a href="'.$_SERVER['SCRIPT_NAME'].'?page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
			if($page - 1 > 0) $page1left = '<a href="'.$_SERVER['SCRIPT_NAME'].'?page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
			if($page + 2 <= $total) $page2right = '  <a href="'.$_SERVER['SCRIPT_NAME'].'?page='. ($page + 2).'">'. ($page + 2) .'</a>';
			if($page + 1 <= $total) $page1right = '  <a href="'.$_SERVER['SCRIPT_NAME'].'?page='. ($page + 1).'">'. ($page + 1) .'</a>';
			
			$sql = mysql_query("SELECT * FROM catalog WHERE sub_id='".$cat."' ORDER BY id DESC LIMIT $start, $num");
			
			if(isset($_POST['btn_search_product']) && isset($_POST['search_product'])) {        //если нажата кнопка поиска то изменяем sql запрос
					$sql = mysql_query("SELECT * FROM catalog WHERE ((name LIKE '%$stroka_search%') OR (article LIKE '%$stroka_search%')) ORDER BY id DESC LIMIT $start, $num");
			}
			
			$row = mysql_fetch_array($sql);
			if (!empty($row['id'])) {
			do
			{
				
			//Разбиение строки для имени товара
			$name = explode("(", $row['name']);
			$name = str_replace(array(')'),array('',''),$name);
			
			echo '
			<tr>
				<td>'.$name['0'].'</td>
				<td>'.$row['article'].'</td>
				<td>'.$row['price'].'</td>
				<td width="19%">
				
				<form method="GET" action="edit_product.php">
					<input name="id" type="hidden" value="'.$row['id'].'">
					<input type="submit" class="edit" value="">
				</form>
	
				<form method="POST" class="catalog" action="drop_product.php">
					<input name="id" type="hidden" value="'.$row['id'].'">
					<input type="submit" class="delete" value="">
				</form>
				
				</td>
			</tr>
			';	
			}
			while ($row = mysql_fetch_array($sql));
			}
			else {
			echo '<div class="none">Товаров не обнаружено</div>';
			}
			echo '
			 </table>
            </div>
			';		 
			if ($total>1) echo '<p><div align="center" class="navigation">'
			.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
			.$nextpage.'</div></p>';
			?>
			            <form action="catalog.php" method="POST" style="display: inline;">
			  Кол-о записей:
                <select name="col-item" class="select-col" onchange="this.form.submit()">
                    <option value="6" <?php if($_COOKIE['col-item'] == '6') { echo 'selected'; } else {} ?>>6</option>
                    <option value="12" <?php if($_COOKIE['col-item'] == '12') echo 'selected'?>>12</option>
                    <option value="24" <?php if($_COOKIE['col-item'] == '24') echo 'selected'?>>24</option>
                    <option value="48" <?php if($_COOKIE['col-item'] == '48') echo 'selected'?>>48</option>
                </select>
			</form>
            </div>
        </div>
</div>

<!--Подвал-->
<?php require_once('blocks/footer.php'); ?>
</body>
</html>