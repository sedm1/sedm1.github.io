<?php 

require_once 'init.php';

include_once('blocks/LanguageCart.php');

$folder = 'uploads/'; //Папка с изображениями
$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
if($lang == 'ru')
  $ext = '';
else $ext = '_'.$lang;

$link_lv = str_replace(".", '_lv.', $_SERVER['REQUEST_URI']);
$link_en = str_replace(".", '_en.', $_SERVER['REQUEST_URI']);

//Объявляем переменные
$query = htmlspecialchars(trim($_GET['q']));
$page = $_GET['page'];

$page_title = 'NB Outlet - Результаты поиска "'.$query.'"';
include_once 'blocks/html.header.php';

?>
<!--Каталог-->
    <div id="catalog">
        <div class="search-column" id="right-column ">
        
			<?php
			$page = intval($page); 
					
			//$col_list = mysql_query("SELECT `col_list` FROM userlist");    
			//$col = mysql_fetch_array($col_list);
			$num = 25;
			
			if ($page==0) $page=1;
				
			$query_count = "SELECT count(`sub_id`) FROM `catalog` WHERE (`name` LIKE '%".$query."%' OR `description` LIKE '%".$query."%' OR `article` LIKE '%".$query."%' OR `price` LIKE '%".$query."%') AND `sub_id` NOT BETWEEN 40 AND 51 ";
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
			 
			if ($page != 1) $pervpage = '<a href="search.php?q='.$query.'&page=-1">'.$language[$lang]['first'].'</a>
			<div class="nav_arrow_left"><a href="search.php?q='.$query.'&page='. ($page - 1).'"></a></div> ';

			if ($page != $total) $nextpage = '  <div class="nav_arrow_right"><a href="search.php?q='.$query.'&page='. ($page + 1).'"></a></div>
			<a href="search.php?q='.$query.'&page='.$total.'">Последняя</a> ';

			if($page - 2 > 0) $page2left = ' <a href="search.php?q='.$query.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
			if($page - 1 > 0) $page1left = '<a href="search.php?q='.$query.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
			if($page + 2 <= $total) $page2right = '  <a href="search.php?q='.$query.'&page='. ($page + 2).'">'. ($page + 2) .'</a>';
			if($page + 1 <= $total) $page1right = '  <a href="search.php?q='.$query.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';
			
			
			$sql = mysql_query("SELECT * FROM `catalog` WHERE (`name` LIKE '%".$query."%' OR `description` LIKE '%".$query."%' OR `article` LIKE '%".$query."%' OR `price` LIKE '%".$query."%') AND (status!=2) AND  `sub_id`  NOT BETWEEN 40 AND 51 ORDER BY `id` DESC LIMIT $start, $num");
			
			$row = mysql_fetch_array($sql);
			?>
        	
			<div class="search-result-text">
				<p class="result-search">Результаты поиска "<?php echo $query; ?>"</p>
				<p class="products-result">Найдено <?php echo $posts; ?> товаров </p>
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
                </ul>
            </div>
            <?php
			if ($total>1) echo '<div class="nav_block nav-block-search"><div class="navigation navigation-search">'
			.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
			.$nextpage.'</div> </div>';
			 ?>
		</div> 
		
		<div id="item-bottom">
        	<a href="catalog.php?catid=1"><div class="button1">Перейти в Каталог</div></a>
            <a href="index.php"><div class="button1">На Главную</div></a>
        </div>
		
    </div>
<?php
include_once 'blocks/html.footer.php';