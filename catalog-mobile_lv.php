<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once("library/pagination_mob_lv.php"); //Подключение пагинацию


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

$sql = "SELECT * FROM `catalog`";
$where = addWhere($where, "`cat_id` NOT IN (7,8,9,10,11,12) AND `status` !=2");

if ($where) $sql .= " WHERE {$where} ";

if (!empty($url_max_price) || !empty($url_min_price) || isset($_GET['size'])) {
    $sql .= " ORDER BY `id` DESC ";
} else {
    $sql .= " ORDER BY FIELD(status,  '2') ASC, `id` DESC ";
}

$sql .= " LIMIT " . ($page - 1) * $num . ", {$num} ";

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
    $url .= '&page='.$page;
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

//$pagination = new Pagination_mob_lv();
//$pagination->total = $total;
//$pagination->page = $page;
//$pagination->limit = $num;
//$pagination->url = 'catalog-mobile_lv.php' . $url . '&page={page}';
//$pagination_render = $pagination->render();


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
            $_SESSION['category'] = $cat['category_lv'];
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
    $urlc = get_url('catalog.php' . $url);
}
if (!empty($subid)) {
    $urlc = get_url('catalog.php' . $url);
}

?>
<!DOCTYPE html>
<html lang="lv">
  <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <meta name="description" content=""/>
      <meta name="keywords" content=""/><!-- Adaptive -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
      <!-- <link rel="stylesheet" href="css/print.css" type="text/css" media="print"> -->
      <!--        Ссылки в соцсетях-->
      <meta property="og:title" content="NB OUTLET">
      <meta property="og:site_name" content="">
      <meta property="og:url" content="NB OUTLET">
      <meta property="og:description" content="NB Outlet - интернет магазин одежды для всей семьи. Низкие цены, широкий ассортимент, доставка.">
      <meta property="og:image" content="/images/NB.png">
      <link rel="icon" type="image/png" href="http://www.nboutlet.eu/favicon.ico" sizes="32x32">
      <link rel="stylesheet" href="/mobile/libs/normalize.css"/>
      <link href="css/custom.min.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="/mobile/css/main.css"/>
      <link rel="stylesheet" href="css/fonts.min.css"/>
      <link rel="icon" href="#" type="image/x-icon"/>
      <link rel="shortcut icon" href="#" type="image/x-icon"/>
      <link rel="apple-touch-icon" href="#"/>
      <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
      <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
      <title>NB OUTLET</title>
  </head>
  <body>
    <!-- [if lt IE 8]>
	<div class="browserupgrade">Jūs izmantojat <strong>novecojušu </strong> pārlūka versiju.Lūdzu,
		<a href="http://browsehappy.com/">atjauniniet savu pārlūkprogrammu</a>.</div>
    <![endif]-->

    <?php include("mobile/module/header_lv.php"); ?>
    <main>
        <div id="bg_layer"></div>
        <!--Секция каталог-->
      <section class="catalog">
                <div class="container">
                  <!--Блок Назад-->
                  <div class="block-return"><img src="/mobile/img/icon/arrow_back.svg" alt="Back"/>
                      <a class="return" href="#" onclick="window.history.back(); return false;">atpakaļ</a>
                  </div>
                </div>
                <!--Блок поиск по категории-->
          <?php if ( isset($_GET['status']) !=3){?>
                <div class="container">
                  <div class="block-filter">
                      <a class="search-filter" href="filter-mobile_lv.php?<?php if(isset($_GET['catid'])){
                          echo 'catid='.$catid.'';
                      }elseif (isset($_GET['subid']) == 25) {
                          echo 'subid='.$subid.'';
                      }?> ">Meklēšana pēc kategorijas</a>
                  </div>
                </div>
          <?php } ?>
          <div class="container">
              <div class="products-list" id="products-list">
                  <div class="item-list" id="item-list">
                      <ul class="catalog-list">
                          <?php
                          //Запрос для вывода всех подкатегорий
                          if (count($rows) > 0) {
                          foreach ($rows as $row) {
                          ?>
                              <li>
                                  <div <?php if ($row['status'] == 3) {
                                          echo 'style="border: solid red;"';
                                      } ?>>
                                      <a href="product-mobile_lv.php?catid=<?=$row['cat_id'];?>&item=<?= $row['id'] ?>">
                                          <div class="view">
                                              <div class="status
                                                <?php
                                                  if ($row['status'] == '0') {
                                                  } elseif ($row['status'] == '1') {
                                                      echo "new";
                                                  } elseif ($row['status'] == '2') {
                                                      echo "sold";
                                                  }
                                                  //else { echo "offer";}
                                                  ?>">
                                              </div>
                                                  <?php if ($row['catalog_image']) {
                                                      echo '<img class="lazy" data-src="../../uploads/catalog/' . $row['catalog_image'] . '" alt="' . $row['description_lv'] . '">';
                                                  } ?>
                                          </div>
                                          <div class="title"><?= $row['name_lv'] ?></div>
                                          <div class="description"><?= $row['description_lv'] ?></div>
                                          <div class="article"><?= $row['article'] ?></div>
                                          <?php if ($row['status'] != '2') {
                                          ?>
                                          <?php if ($row['status'] == 3) { ?>
                                              <div class="price"><span style="color: red">&euro;<?= $row['price_stock'] ?></span> <span style="text-decoration:line-through; padding: 5px;">&euro;<?= $row['price'] ?></span> </div>
                                          <?php } else { ?>
                                          <div class="price">€<?= $row['price'] ?></div>
                                              <?php } ?>

                                              <?php } ?>
                                      </a>
                                  </div>
                              </li>
                          <?php
                          }
                          } else {
                              echo '<div class="empty-product">Nav ieteikumu</div>';
                          }
                          ?>

                      </ul>
                  </div>
                <?/*php echo $pagination_render; */?>
              </div>
              <!--Блок кнопки и доставки-->
              <div class="block-sticky">
                  <!--Кнопка вверх-->
                  <div class="button-up-wrap" id="btnUp"><img src="/mobile/img/icon/arrow_up.svg" alt="arrow up"/></div>
                  <!--Блок Бесплатная доставка-->
                  <div class="block-delivery">
                      <p class="delivery-title">Bezmaksas piegāde no € 100</p>
                      <img class="close-delivery" src="/mobile/img/icon/button_close.svg" alt="Close" id="CloseDelivery"/>
                  </div>
              </div>
          </div>
          </div>

      </section>
    </main>
    <?php include("mobile/module/footer_lv.php"); ?>
  </body>
</html>