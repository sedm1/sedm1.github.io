<?php 
session_start();
require_once("config.php"); //Подключение к бд

//Объявляем переменные
$query = htmlspecialchars(trim($_GET['q']));
$page = $_GET['page'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="">
<title>UMARKET - Meklēšanas rezultāti "<?php echo $query; ?>"</title>
<link href="css/reset.min.css" rel="stylesheet" type="text/css">
<link href="css/fonts.min.css" rel="stylesheet" type="text/css">

<link href="css/main-umarket.css" rel="stylesheet" type="text/css">
<!-- <link href="css/main.min.css" rel="stylesheet" type="text/css"> -->

<link href="css/catalog-umarket.css" rel="stylesheet" type="text/css">
<!-- <link href="css/catalog.min.css" rel="stylesheet" type="text/css"> -->

<link href="css/custom-umarket.css" type="text/css" rel="stylesheet">
<!-- <link href="css/custom.min.css" type="text/css" rel="stylesheet"> -->

 <!-- Favicon -->
 <link rel="apple-touch-icon" sizes="144x144" href="images/favicon_umarket/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon_umarket/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon_umarket/favicon-16x16.png">
<link rel="manifest" href="images/favicon_umarket/site.webmanifest">
<link rel="mask-icon" href="images/favicon_umarket/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/accordeon/accordeon.min.js" ></script> 
<link rel="stylesheet" type="text/css" href="js/accordeon/accordeon.min.css" />

<script type="text/javascript" src="js/cufon-yui.js"></script>
<script sync type="text/javascript" src="fonts/Circe-Light.min.js"></script>
<script sync type="text/javascript" src="fonts/Circe-Regular.min.js"></script>
<script sync type="text/javascript" src="fonts/Circe-Bold.min.js"></script>


<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->

<script type="text/javascript">
	Cufon.replace('.button1, .result-search', { fontFamily: 'Circe Bold', hover: true });
	Cufon.replace('.products-result', { fontFamily: 'Circe Regular', hover: true });
</script>

</head>
<body>
<div id="wrapper">
<div class="layer"></div>
        <!-- Шапка -->
        <?php include("blocks/umarket_header_lv.php"); ?>
   
   <!--Каталог--> 
    <div id="catalog">
        <div class="search-column" id="right-column ">
        
			<?php
			$page = intval($page); 
					
			//$col_list = mysql_query("SELECT `col_list` FROM userlist");    
			//$col = mysql_fetch_array($col_list);
			$num = 25;
			
			if ($page==0) $page=1;
				
            $query_count = "SELECT count(`sub_id`) FROM `catalog` WHERE (`name` LIKE '%".$query."%' OR `description` LIKE '%".$query."%' OR `article` LIKE '%".$query."%' OR `price` LIKE '%".$query."%') AND sub_id BETWEEN 40 AND 50"; 
            
			$mysql_result = mysql_query($query_count);
			 
			if(mysql_num_rows($mysql_result)>0){
				$count=mysql_fetch_row($mysql_result);
			}
			$posts = $count[0]; 
			$total = intval(($posts - 1) / $num) + 1;
			$page = intval($page);
			
			if(empty($page) or $page < 0) $page = 1;
			if($page > $total) $page = $total;

			$start = $page * $num - $num;
			 
			// if ($page != 1) $pervpage = '<a href="search.php?q='.$query.'&page=-1">Первая</a>
			// <div class="nav_arrow_left"><a href="search.php?q='.$query.'&page='. ($page - 1).'"></a></div> ';

			// if ($page != $total) $nextpage = '  <div class="nav_arrow_right"><a href="search.php?q='.$query.'&page='. ($page + 1).'"></a></div>
			// <a href="search.php?q='.$query.'&page='.$total.'">Последняя</a> ';

			// if($page - 2 > 0) $page2left = ' <a href="search.php?q='.$query.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
			// if($page - 1 > 0) $page1left = '<a href="search.php?q='.$query.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
			// if($page + 2 <= $total) $page2right = '  <a href="search.php?q='.$query.'&page='. ($page + 2).'">'. ($page + 2) .'</a>';
			// if($page + 1 <= $total) $page1right = '  <a href="search.php?q='.$query.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';
			
			
			$sql = mysql_query("SELECT * FROM `catalog` WHERE (`name` LIKE '%".$query."%' OR `description` LIKE '%".$query."%' OR `article` LIKE '%".$query."%' OR `price` LIKE '%".$query."%')  AND sub_id BETWEEN 40 AND 50 ORDER BY `id` DESC LIMIT $start, $num");
			
			$row = mysql_fetch_array($sql);
			?>
        	
			<div class="search-result-text">
				<p class="result-search">Meklēšanas rezultāti "<?php echo $query; ?>"</p>
				<p class="products-result">Atrasts <?php echo $posts; ?> preču </p>
			</div>
			<div class="my-separator"></div>
			
            <!--Список товаров-->
   			<div id="item-list" class="clearfix">
            	<ul>
                	<?php
					if (!empty($row['id'])) {
					do
					{
					?>
                        <li>
                            <a href="umarket_view.php?item=<?=$row['id'] ?>">
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
					echo '<div class="empty-product">Nav ieteikumu</div>';
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
			
            <?/*php
			if ($total>1) echo '<div class="nav_block nav-block-search"><div class="navigation navigation-search">'
			.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
			.$nextpage.'</div> </div>';
			 */?>

	 <!-- Кнопка загрузить еще -->
			 <div style="margin-bottom:10px">
			  <?php 
            
			if ( $posts > 25 && $_GET['page'] != $total) {
			
			  
			  if ($page != $total) {
				  
				echo '<a href="umarket_search_lv.php?q='.$query.'&page='. ($page + 1)  .'" class="btn btn-load-more" id="loadMore">Rādīt vēl</a>';
			  }
			}
			?>
			</div>
		</div> 
			<!-- Кнопки каталог и Главная -->
		<!-- <div id="item-bottom">
        	<a href="catalog.php?catid=1"><div class="button1">Перейти в Каталог</div></a>
            <a href="index.php"><div class="button1">На Главную</div></a>
        </div> -->
	
		
		<!-- Кнопка Назад в каталог -->
		<a href="umarket_lv" class="btn btn-back" id="back">Pāriet uz Katalogu </a>
		
    </div>
	<?php 
	if ($posts <=0)
	echo '<div style="height:72px"></div>'
	
	?>
    <!--Подвал--> 
    <?php include("blocks/umarket_footer_lv.php"); ?>

<!-- Программирование Соловьёв Евгений http://freelance.ru/users/belltone/ -->
</body>
</html>