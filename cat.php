<?php 
session_start();
require_once("config.php"); //Подключение к бд

//Объявляем переменные
$catid = $_GET['catid'];
$subid = $_GET['subid'];
$status = $_GET['status'];
$page = $_GET['page'];

//Переадресация на страницу ошибки
$result = mysql_query("SELECT id FROM `category` WHERE id='".$catid."'");    
$myrow = mysql_fetch_array($result);
if ($myrow['id'] == $catid) {
	$result1 = mysql_query("SELECT id FROM `subcategory` WHERE id='".$subid."'");    
	$myrow1 = mysql_fetch_array($result1);
		if ($myrow1['id'] == $subid) { 
			if (empty($catid) && empty($subid) && empty($page) && empty($status)) {
				header("Location:404.php");
			}
		}
		else {
			header("Location:404.php");
		}	
}
else {
	header("Location:404.php");
}


$arr1 = array();
$subcategory = mysql_query("SELECT * FROM `subcategory`");
while($sub = mysql_fetch_array($subcategory)) {
	$arr1[] = $sub;
}
$arr2 = array();
$category = mysql_query("SELECT * FROM `category`");
while($cat = mysql_fetch_array($category)) {
	$arr2[] = $cat;
}

//Название категории
foreach($arr2 as $cat) {
	if($cat['id'] == $catid) {
		if (isset($cat['category'])) {$_SESSION['category'] = $cat['category']; }
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="">
<title>NB Outlet - <?=$_SESSION['category'] ?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/fonts.css" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/catalog.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/accordeon/accordeon.js" ></script> 
<link rel="stylesheet" type="text/css" href="js/accordeon/accordeon.css" />
<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->
</head>
<body>
<div id="wrapper">

	<!--Шапка-->
	<?php include("blocks/header.php"); ?>
   
   <!--Каталог--> 
    <div id="catalog">
        <div id="left-column">
        	<h1>Каталог</h1>
            
            <!-- Аккордеон -->
            <ul class="menu">
				<?php
				
					
				//Определяем в какой категории находится продукт
				if (isset($catid)) { 
					$_SESSION['catid'] = $catid;
					$_SESSION['subid'] = '';
				} 
				else {
					
					//Дополнительные параметры для категории
					foreach($arr1 as $sub) {
						if ($sub['id'] == $subid) $_SESSION['catid'] = $sub['cat_id'];
							if (empty($page) && empty($status)) {
								$_SESSION['subid'] = $subid;
							}	
					}
				}

				//Вывод категорий
				foreach($arr2 as $cat) {
				?>
				<li <?php if($cat['id'] == $_SESSION['catid']) { echo 'class="expand"'; } ?>><a href="?catid=<?=$cat['id'] ?>"><?=$cat['category'] ?></a>
                	<ul class="acitem">
                    	<?php

						//Вывод подкатегорий
						foreach($arr1 as $sub) {
							if ($cat["id"] == $sub["cat_id"]) {
							?>
                    		<li><a href="?subid=<?=$sub['id']?>" <?php if ($sub['id'] == $_SESSION['subid']) { echo 'id="current"'; } ?>><?=$sub['subcategory'] ?></a></li>
                        	<?php
							}
						}
						?>
                    </ul>
                </li>
                <?php
				}
                ?>
             </ul>
        </div>
        <div id="right-column">
        
        	<!--Фильтр-->
            <?php
			//Параметры для фильрта
			if (isset($status) or isset($page)) {
           		if (isset($status)) $_SESSION['status'] = $status;
			}
			else {
				$_SESSION['status'] = '';
			}
			?>
        	<div id="filter">
            	<ul>
					<li><a href="?catid=<?=$_SESSION['catid'] ?>" <?php if ($_SESSION['status'] == '') { if (!$_SESSION['subid']) { echo 'id="active"'; }} ?>>Все</a></li>
                    <li><a href="?status=1" <?php if ($_SESSION['status'] == '1') { echo 'id="active"'; } ?>>Новинка</a></li>
                    <li><a href="?status=2" <?php if ($_SESSION['status'] == '2') { echo 'id="active"'; } ?>>Продано</a></li>
                    <li><a href="?status=3" <?php if ($_SESSION['status'] == '3') { echo 'id="active"'; } ?>>Спец. Предложение</a></li>
            	</ul>
            </div>   
            
            <!--Список товаров-->
   			<div id="item-list" class="clearfix">
            	<ul>
                	<?php
					//Запрос для вывода всех подкатегорий
					if (!$sub['id'] == $_SESSION['subid']) {
						$sql_temp = 'cat_id="'.$_SESSION['catid'].'"';
					}
					else {
						$sql_temp = 'sub_id="'.$_SESSION['subid'].'"';
					}
						
					$page = intval($page); 
					
					$col_list = mysql_query("SELECT `col_list` FROM userlist");    
					$col = mysql_fetch_array($col_list);
					$num = $col['col_list'];
					
					if ($page==0) $page=1;
						
					$query = "SELECT count(`id`) FROM `catalog` WHERE ".$sql_temp." && `status` LIKE '".$_SESSION['status']."%' "; 
					$mysql_result = mysql_query($query);
					 
					if(mysql_num_rows($mysql_result)>0){
						$count=mysql_fetch_row($mysql_result);
						}
					$posts = $count[0]; 
					$total = intval(($posts - 1) / $num) + 1;
					$page = intval($page);
					
					if(empty($page) or $page < 0) $page = 1;
					if($page > $total) $page = $total;

					$start = $page * $num - $num;
					 
					if ($page != 1) $pervpage = '<a href="catalog.php?page=-1">Первая</a>
					<div class="nav_arrow_left"><a href="catalog.php?page='. ($page - 1).'"></a></div> ';

					if ($page != $total) $nextpage = '  <div class="nav_arrow_right"><a href="catalog.php?page='. ($page + 1).'"></a></div>
					<a href="catalog.php?page='.$total.'">Последняя</a> ';

					if($page - 2 > 0) $page2left = ' <a href="catalog.php?page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
					if($page - 1 > 0) $page1left = '<a href="catalog.php?page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
					if($page + 2 <= $total) $page2right = '  <a href="catalog.php?page='. ($page + 2).'">'. ($page + 2) .'</a>';
					if($page + 1 <= $total) $page1right = '  <a href="catalog.php?page='. ($page + 1).'">'. ($page + 1) .'</a>';
					
					$sql = mysql_query("SELECT * FROM `catalog` WHERE ".$sql_temp." && `status` LIKE '".$_SESSION['status']."%' ORDER BY FIELD(status, '1', '0', '2', '3') ASC, `id` DESC LIMIT $start, $num");
					$row = mysql_fetch_array($sql);
					
					if (!empty($row['id'])) {
					do
					{
					?>
                        <li>
                            <a href="view.php?item=<?=$row['id'] ?>">
                                <div class="view">
                                    <div class="status 
                                    <?php 
                                    if ($row['status'] == '0') {
                                    } elseif ($row['status'] == '1') { echo "new";
                                    } elseif ($row['status'] == '2') { echo "sold";
                                    } else { echo "offer";
                                    }
                                    ?>
                                    ">
                                </div><?php if ($row['catalog_image']) { echo '<img src="uploads/catalog/'.$row['catalog_image'].'" alt="'.$row['catalog_image'].'">'; } ?></div>
                                <div class="title"><?=$row['name'] ?></div>
                                <div class="description"><?=$row['description'] ?></div>
                                <div class="article"><?=$row['article'] ?></div>
                                <div class="price">&euro;<?=$row['price'] ?></div>
                            </a>
                        </li>
					<?php
					}
					while ($row = mysql_fetch_array($sql));
					}
					else {
					echo '<div class="empty-product">Нет предложений</div>';
					}
					?>
                    <!--
                	<li>
                        <a href="view.php">
                            <div class="view"><div class="status new"></div><img src="images/item1.jpg" alt="item1"></div>
                            <div class="title">Lavish Alice</div>
                            <div class="description">White Deep Plunge Strap</div>
                            <div class="article">#LA-125</div>
                            <div class="price">&euro;56.00</div>
                        </a>
                    </li>
                    -->
                </ul>
            </div>
            <?php
			if ($total>1) echo '<div class="nav_block"><div class="navigation">'
			.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
			.$nextpage.'</div> </div>';
			 ?>
      </div>
      
        <!--Доставка и оплата-->
        <div id="delivery"></div>
        
       <div id="message">
           <div id="left-column"></div>
           <div id="right-column">
           Уважаемые посетители. К сожалению у нас не всегда есть время, чтобы подготовить и выложить на сайт качественный фото контент. Все что вам понравилось из нашего ассортимента вы можете написать на почту и мы предоставим больше фото и информации по товару.
           </div>
       </div>      
    </div>
    
    <!--Подвал--> 
    <?php include("blocks/footer.php"); ?>
        
<!-- Программирование Соловьёв Евгений http://freelance.ru/users/belltone/ -->
</body>
</html>