<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once("library/pagination_en.php"); //Подключение пагинацию


function addWhere($where, $add, $and = true)
{
	if ($where) {
		if ($and) $where .= " AND $add";
		else $where .= " OR $add";
	} else $where = $add;
	return $where;
}

$where = '';
$url = '';

if (isset($_GET['catid']) || !empty($_GET['catid'])) {
	$catid = (int)htmlspecialchars(trim($_GET['catid']));
	$where = addWhere($where, "`cat_id` = " . $catid);
}
if (isset($_GET['status']) || !empty($_GET['status'])) {
	$status = (int)htmlspecialchars(trim($_GET['status']));
	$where = addWhere($where, "`status` = " . $status);
} else {
	$status = '-1';
}
if (isset($_GET['subid']) || !empty($_GET['subid'])) {
	$subid = (int)htmlspecialchars(trim($_GET['subid']));
	$where = addWhere($where, "`sub_id` = " . $subid);
}

if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
	$url_min_price = (int)htmlspecialchars(trim($_GET['min_price']));
	$where = addWhere($where, "`price` >= " . $url_min_price);
}

if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
	$url_max_price = (int)htmlspecialchars(trim($_GET['max_price']));
	$where = addWhere($where, "`price` <= " . $url_max_price);
}

if (isset($_GET['age']) && !empty($_GET['age'])) {
	$url_age = (int)htmlspecialchars(trim($_GET['age']));
	$where = addWhere($where, "`age`= " . $url_age);
}

if (isset($_GET['size']) || !empty($_GET['size'])) {
	$size = $_GET['size'];
	$sql_or_sort = ' AND (';
	foreach ($size as $item) {
		$sql_or_sort .=  " `size` RLIKE '[[:<:]]" . $item . "[[:>:]]' OR ";
	}
	$sql_or_sort = rtrim($sql_or_sort, ' OR ');
	$sql_or_sort .= ' ) ';

	$where .= $sql_or_sort;
}


if (isset($_GET['page']) || !empty($_GET['page'])) {
	$page = (int)htmlspecialchars(trim($_GET['page']));
} else {
	$page = 1;
}

// Получаем настройки
$col_list = mysql_query("SELECT `col_list` FROM userlist");
$col = mysql_fetch_array($col_list);
$num = $col['col_list']; // Количество записей на странице


$query = "SELECT count(`id`) FROM `catalog` ";

if (!empty($url_max_price) || !empty($url_min_price) || isset($_GET['size']) || isset($_GET['age'])) {
	$where = addWhere($where, "`status` != 2");
}

if ($where) $query .= " WHERE {$where}";

$mysql_result = mysql_query($query);

if (mysql_num_rows($mysql_result) > 0) {
	$count = mysql_fetch_row($mysql_result);
	$total = $count[0];
}

$sql = '';

$sql = "SELECT * FROM `catalog` ";

if ($where) $sql .= " WHERE {$where} ";

if (!empty($url_max_price) || !empty($url_min_price) || isset($_GET['size'])) {
	$sql .= " ORDER BY `id` DESC ";
} else {
	$sql .= " ORDER BY FIELD(status,  '2') ASC, `id` DESC ";
}

$sql .= " LIMIT " . ($page - 1) * $num . ", {$num}";

$q = mysql_query($sql);

while ($data_rows = mysql_fetch_assoc($q)) {
	$rows[] = $data_rows;
}

$url = '';

if (isset($_GET['catid']) || !empty($_GET['catid'])) {
	$catid = (int)htmlspecialchars(trim($_GET['catid']));
	$url = '?catid=' . $catid;
}


if (isset($_GET['subid']) || !empty($_GET['subid'])) {
	$subid = (int)htmlspecialchars(trim($_GET['subid']));
	$url = '?subid=' . $subid;
}

if (isset($_GET['status']) || !empty($_GET['status'])) {
	$status = (int)htmlspecialchars(trim($_GET['status']));
	$where = addWhere($where, "`status` = " . $status);
	$url .= '&status=' . $status;
} else {
	$status = '-1';
}
if (isset($_GET['page']) || !empty($_GET['page'])) {
	$page = (int)htmlspecialchars(trim($_GET['page']));
	//$url .= '&page='.$page;
} else {
	$page = 1;
}

$where_price = '';

if (isset($catid)) {
	$where_price = addWhere($where_price, "`cat_id` = " . $catid);
} elseif (isset($subid)) {
	$where_price = addWhere($where_price, "`sub_id` = " . $subid);
} else {
	$where_price = 1;
}

if (!empty($url_max_price) || !empty($url_min_price)) {
	$where = addWhere($where_price, "`status` != 2");
}

$sql_min_price = mysql_query("SELECT MIN(`price`) as `min_price` FROM `catalog` WHERE {$where_price}");
$min_price = mysql_fetch_assoc($sql_min_price);

$sql_max_price = mysql_query("SELECT MAX(`price`) as `max_price` FROM `catalog` WHERE {$where_price}");
$max_price = mysql_fetch_assoc($sql_max_price);

if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
	$url_min_price = round(htmlspecialchars(trim($_GET['min_price'])));
	$url .= '&min_price=' . $url_min_price;
} else {
	$url_min_price = round($min_price['min_price']);
}

if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
	$url_max_price = (int)round(htmlspecialchars(trim($_GET['max_price'])));
	$url .= '&max_price=' . $url_max_price;
} else {
	$url_max_price = (int)round($max_price['max_price']);
}

if (isset($_GET['age']) && !empty($_GET['age'])) {
	$url .= '&age=' . $_GET['age'];
}

if (isset($_GET['size'])) {

	foreach ($_GET['size'] as $usize) {
		$url .= '&size[]=' . $usize;
	}
}

$pagination = new Pagination();
$pagination->total = $total;
$pagination->page = $page;
$pagination->limit = $num;
$pagination->url = 'catalog_en.php' . $url . '&page={page}';

$pagination_render = $pagination->render();

//Переадресация на страницу ошибки
$result = mysql_query("SELECT id FROM `category` WHERE id='" . $catid . "'");
$myrow = mysql_fetch_array($result);
if ($myrow['id'] == $catid) {
	$result1 = mysql_query("SELECT id FROM `subcategory` WHERE id='" . $subid . "'");
	$myrow1 = mysql_fetch_array($result1);
	if ($myrow1['id'] == $subid) {
		if (empty($catid) && empty($subid) && empty($page) && empty($status)) {
			header("Location:404.php");
		}
	} else {
		header("Location:404.php");
	}
} else {
	header("Location:404.php");
}


$arr1 = array();
$subcategory = mysql_query("SELECT * FROM `subcategory`");
while ($sub = mysql_fetch_array($subcategory)) {
	$arr1[] = $sub;
}
$arr2 = array();
$category = mysql_query("SELECT * FROM `category`");
while ($cat = mysql_fetch_array($category)) {
	$arr2[] = $cat;
}

//Название категории
foreach ($arr2 as $cat) {
	if ($cat['id'] == $catid) {
		if (isset($cat['category'])) {
			$_SESSION['category'] = $cat['category_en'];
		}
	}
}

if (isset($_GET['subid'])) {
	$sid = '?subid=' . $_GET['subid'];
} elseif (isset($_GET['catid'])) {
	$sid = '?catid=' . $_GET['catid'];
} else {
	$sid = '?_=_';
}



if (!empty($catid)) {
	$urlc = get_url('catalog_en.php' . $url);
}
if (!empty($subid)) {
	$urlc = get_url('catalog_en.php' . $url);
}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="keywords" content="">
  <title>NB Outlet - <?= $_SESSION['category'] ?></title>
  <link href="css/reset.min.css" rel="stylesheet" type="text/css">
  <link href="css/catalog.min.css" rel="stylesheet" type="text/css">
  <link href="css/main.min.css" rel="stylesheet" type="text/css">
  <link href="css/default.min.css" rel="stylesheet" type="text/css">
  <link href="css/fonts.min.css" rel="stylesheet" type="text/css">
  <link href="css/custom.min.css" type="text/css" rel="stylesheet">

  <link rel="stylesheet" href="css/main.css">
  <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
</head>

<body>

  <div id="wrapper">

    <!-- Шапка -->
    <?php include("blocks/header_en.php"); ?>
    <!-- Каталог -->
    <div id="catalog" style="position: relative;">

      <h2 class="catalog__title">Discount products</h2>
      <!-- Фильтр -->
      <div id="filter">
        <ul>
          <li><a href="<?php echo "?catid=1&status=3"?>" <?php if ($catid == 1) {
                                    echo 'id="active"';
                                  } ?>>women clothes</a></li>
          <!-- ?catid=1"> -->
          <li><a href="?catid=2&status=3"<?php if ($catid == 2) {
                                                        echo 'id="active"';
                                                      } ?>>men clothes</a></li>
          <!-- ?catid=1&status=1" id="active"> -->
          <li><a href="?subid=25&status=3"<?php if ($subid == 25 ) {
                                                        echo 'id="active"';
                                                      } ?>>children clothes</a></li>
          <!-- ?catid=1&status=3"> -->
          <li><a href="?catid=4&status=3"<?php if ($catid == 4) {
                                                        echo 'id="active"';
                                                      } ?>>shoes</a></li>
          <!-- ?catid=1&status=2"> -->
          <li><a href="?catid=5&status=3"<?php if ($catid == 5) {
                                                        echo 'id="active"';
                                                      } ?>>other goods</a></li>
          <!-- ?catid=1&status=2"> -->

        </ul>
      </div>
      <!--Список товаров-->
      <div>

        <div id="products-list">
          <div id="item-list">
            <ul>
              <?php
              //Запрос для вывода всех подкатегорий
              if (count($rows) > 0) {
                foreach ($rows as $row) {
                  ?>
                  <li>
                    <div <?php if ($row['status'] == 3) {
                            echo 'style="border: solid red; width: 192px; height: 347px;"';
                          } ?>>
                      <a href="view_en.php?item=<?= $row['id'] ?>">
                        <div class="view">
                          <div class="status 
																					    <?php
                                              if ($row['status'] == '0') { } elseif ($row['status'] == '1') {
                                                echo "new";
                                              } elseif ($row['status'] == '2') {
                                                echo "sold";
                                              }
                                              //else { echo "offer";}
                                              ?>
																					    ">
                          </div><?php if ($row['catalog_image']) {
                                  echo '<img src="../../uploads/catalog/' . $row['catalog_image'] . '" alt="' . $row['catalog_image'] . '">';
                                } ?>
                        </div>
                        <div class="title"><?= $row['name_en'] ?></div>
                        <div class="description"><?= $row['description_en'] ?></div>
                        <div class="article"><?= $row['article'] ?></div>
                        <?php if ($row['status'] != '2') {
                          ?>
                          <?php if ($row['status'] == 3) { ?>
                            <div class="price"><span style="color: red">&euro;<?= $row['price_stock'] ?></span> <span style="text-decoration:line-through; padding: 5px;">&euro;<?= $row['price'] ?></span> </div>
                          <?php } else { ?>
                            <div class="price">&euro;<?= $row['price'] ?></div>
                          <?php } ?>

                        <?php } ?>
                      </a>
                    </div>
                  </li>

                <?php
                }
              } else {
                echo '<div class="empty-product">No offer</div>';
              }
              ?>
            </ul>
          </div>
						<?php echo $pagination_render; ?>
        </div>
      </div>
    </div>
    <div id="clear"></div>
  </div>










  <?php include("blocks/footer_en.php"); ?>
    <?php include_once('blocks/rightcart.php') ?>
    <script src="js/jquery.sidebar.min.js"></script>
		<script src="js/mycart.min.js"></script>
</body>

</html>