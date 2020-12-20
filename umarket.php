<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once "stat.php"; //Статистика посищений
 require_once("library/pagination.php"); //Подключение пагинацию
include_once('blocks/LanguageCart.php');
$folder = 'uploads/'; //Папка с изображениями

$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
if ($lang == 'ru') $ext = '';
else $ext = '_' . $lang;

$link_lv = str_replace(".", '_lv.', $_SERVER['REQUEST_URI']);
$link_en = str_replace(".", '_en.', $_SERVER['REQUEST_URI']);


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
        $sql_or_sort .= " `size` RLIKE '[[:<:]]" . $item . "[[:>:]]' OR ";
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


//Получаем настройки
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


///////////////////////////////////////////////////////////////////////////////////////////////////////////

// Вывод б/у категорий

$sql = "SELECT * FROM `catalog`";

$where = addWhere($where, "`sub_id` between 40 and 51 ");

if ($where) $sql .= " WHERE {$where} ";
$sql .= " ORDER BY FIELD(status,  '2') ASC, `article` DESC ";
$sql .= " LIMIT  {$num}";
$q = mysql_query($sql);

$row_BU = array();
while ($data_rows_BU = mysql_fetch_assoc($q)) {
    $row_BU[] = $data_rows_BU;
}


// Количество записей
$sql = "SELECT count(*)  FROM `catalog` ";
$where = addWhere($where, "`sub_id` between 40 and 51");
if ($where) $sql .= " WHERE {$where} ";
$sql .= " LIMIT  {$num}";


$q = mysql_query($sql);
$count_bu = mysql_fetch_assoc($q);

$mysql_result = mysql_query($sql);

if (mysql_num_rows($mysql_result) > 0) {
    $count = mysql_fetch_row($mysql_result);
    $total = $count[0];
}

$num_pages = ceil($total / $num);
$cur_page = $_GET['page'] +1 ;

////////////////////////////////////////////////////////////////////
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
//    $url .= '&page=' . $page;
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
 $pagination->url = 'umarket.php' . $url . '&page={$page}';
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
            $_SESSION['category'] = $cat['category'];
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Umarket - малопользованные товары без дефектов. Низкие цены, доставка. " />
    <meta name="keywords" content="малопользованные товары,бу товары,Малопользованная техника,mazlietotas bērnu preces,
    mazlietotas preces,nocenotas preces,nocenoto preču veikals,mazlietotas mēbeles,jaunas mazlietotas,mazlietota elektrotehnika">
    <title>Umarket - Интернет магазин</title>
    <link href="css/reset.min.css" rel="stylesheet" type="text/css">

    <link href="css/catalog-umarket.css" rel="stylesheet" type="text/css">


    <link href="css/main-umarket.css" rel="stylesheet" type="text/css">
    <link href="css/default.min.css" rel="stylesheet" type="text/css">
    <link href="css/fonts.min.css" rel="stylesheet" type="text/css">

    <link href="css/custom-umarket.css" type="text/css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon_umarket/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_umarket/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_umarket/favicon-16x16.png">
    <link rel="manifest" href="images/favicon_umarket/site.webmanifest">
    <link rel="mask-icon" href="images/favicon_umarket/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>

<div id="wrapper">
    <div id="bg_layer"></div>
    <div class="layer"></div>
    <!-- Шапка -->
    <?php include("blocks/umarket_header.php"); ?>
    <!-- Баннер -->
    <div id="umarket-banner">
        <div class="umarket-banner-wrap">
            <h2>Малопользованные брендовые товары без дефектов.</h2>
            <p>Все в одном месте. Доставка по всей Латвии.</p>
        </div>
    </div>
    <!-- Каталог -->
    <div id="catalog" style="position: relative;">

        <h2 class="catalog__title">Каталог товаров</h2>
        <!-- Первый фильтр -->
        <div class="filter">
            <ul>
                <li><a href="<?php if (!empty($catid) || !empty($subid) || !empty($cur_page)){
                        echo 'umarket';
                    } ?>"<?php if (empty($_GET['catid'])) {
                        echo 'id="active"';
                    } ?>>Все</a></li>

                <li><a href="<?php echo "?catid=7 "?>"  <?php if ($catid == 7) {
                        echo 'id="active-first"';
                    } ?>>Одежда</a></li>
                <li><a href="<?php echo "?catid=8" ?>" <?php if ($catid == 8) {
                        echo 'id="active-first"';
                    } ?>>Обувь</a></li>
                <li><a href="<?php echo "?catid=9 " ?>" <?php if ($catid == 9) {
                        echo 'id="active-first"';
                    } ?>>Аксессуары</a></li>
                <li><a href="<?php echo "?catid=10 " ?>" <?php if ($catid == 10) {
                        echo 'id="active"';
                    } ?>>Электроника</a></li>
                <li><a href="<?php echo "?catid=11 " ?>" <?php if ($catid == 11) {
                        echo 'id="active"';
                    } ?>>Другие товары</a></li>
                <li><a href="<?php echo "?catid=12 " ?>" <?php if ($catid == 12) {
                        echo 'id="active"';
                    } ?>>Новые вещи</a></li>
            </ul>
        </div>
        <!-- Фильтр -->
        <?php if ($_GET['catid'] == '7' || $_GET['catid'] == '8' || $_GET['catid'] == '9' || isset($_GET['subid'])) {
        ; ?>
        <div id="filter" style="display:block;">
            <?php } else {
                echo "<div id='filter' style='display:none;'>";
            } ?>
            <ul>
                <li><a href="<?php if (!empty($catid) || !empty($subid) || !empty($cur_page)) {
                        echo 'umarket?catid='.$catid.' ';
                    } ?>"<?php if (empty($subid)) {
                        echo 'id="active"';
                    } ?>>Все</a>
                </li>
                <li><a href="<?php if ($catid == 7) {

                        echo "?catid=7&subid=40";

                    } elseif ($catid == 8) {

                        echo "?catid=8&subid=43";

                    } elseif($catid == 9) {

                     echo "?catid=9&subid=46";}?>"
                        <?php if ($catid == 7 && $subid == 40 || $catid == 8 && $subid == 43 || $catid == 9 && $subid == 46) {
                            echo 'id="active"';
                        } ?>>
                        <?php if ($_GET['catid'] == 9){

                            echo 'Женские</a>';
                        }else {
                            echo 'Женская</a>';
                        }?>

                </li>

                <li ><a href="<?php if ($catid == 7) {
                        echo "?catid=7&subid=41";
                    } elseif ($catid == 8) {
                        echo "?catid=8&subid=44";
                    }
                     elseif($catid == 9)
                     {echo "?catid=9&subid=47";}
                    // elseif($catid == 10)
                    // {echo "?catid=10&subid=49";}
                    // elseif($catid == 11)
                    // {echo "?catid=11&subid=50";} ?>"
                        <?php if ($catid == 7 && $subid == 41 || $catid == 8 && $subid == 44 || $catid == 9 && $subid == 47) {
                            echo 'id="active"';
                        } ?>>
                        <?php if ($_GET['catid'] == 9){

                        echo 'Мужские</a>';
                    }else {
                        echo 'Мужская</a>';
                    }?>
                </li>

                <li <?php if($catid == 9)
                {echo "style='display:none;'";}?>><a href="<?php if ($catid == 7) {
                        echo "?catid=7&subid=42";
                    } elseif ($catid == 8) {
                        echo "?catid=8&subid=45";
                    }
//                     elseif($catid == 9)
//                     {echo "?catid=9&subid=48";}
                    // elseif($catid == 10)
                    // {echo "?catid=10&subid=49";}
                    // elseif($catid == 11)
                    // {echo "?catid=11&subid=50";}?>"
                        <?php if ($catid == 7 && $subid == 42 || $catid == 8 && $subid == 45 || $catid == 9 && $subid == 48) {
                            echo 'id="active"';
                        } ?> >Детская</a>
                </li>
            </ul>

        </div>
        <!--Список товаров-->
        <div>

            <div id="products-list">
                <div id="item-list">
                    <?php

                    if (count($row_BU) <= 2) {
                        echo '<ul id="list" style="">';
                    } else {
                        echo '<ul id="list" style="">';
                    } ?>
                    <?php
                    //Запрос для вывода umarket
                    if (count($row_BU) > 0) {

                        foreach ($row_BU as $row) {
                            ?>

                            <li>
                                <div <?php if ($row['status'] == 3) {
                                    echo 'style="border: solid red; width:     192px; height: 347px;"';
                                } ?>>
                                    <a href="umarket_view.php?item=<?= $row['id'] ?>&page=<?php echo $page;?>" >
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
                                                echo '<img src="../../uploads/catalog/' . $row['catalog_image'] . '
                                                " alt="' . $row['catalog_image'] . '">';
                                            } ?>
                                        </div>
                                        <div class="title"><?= $row['name'] ?></div>
                                        <div class="description"><?= $row['description'] ?></div>
                                        <div class="size">Размер: <?= $row['size'] ?></div>
                                        <div class="article"><?= $row['article'] ?></div>
                                        <?php if ($row['status'] != 2) { ?>
                                            <?php if ($row['status'] == 3) { ?>
                                                <div class="price"><span
                                                            style="color: red">&euro;<?= $row['price_stock'] ?></span>
                                                    <span
                                                            style="text-decoration:line-through; padding: 5px;">&euro;<?= $row['price'] ?></span>
                                                </div>
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
                        echo '<div class="empty-product">Нет предложений</div>';

                    } ?>
                    </ul>

                </div>
                <?/*php echo $pagination_render; */?>
            </div>
        </div>
        <!-- Кнопка загрузить еще -->

        <?php
        if ($total > $num) {
            if (count($row) > 0)

 echo '<input href="" type="button"  name = " "  id="show_more"  class="btn btn-load-more"   count_show="'.$num.'" count_add="' . $num . '" page="' . $cur_page . '"cat_id="' . $catid . '" value="Загрузить еще"  >
  ';}

        ?>

    </div>


    <script type="text/javascript">

            $('#show_more').click(function (e) {
                e.preventDefault();
                let btn_more = $(this);
                let count_show = parseInt($(this).attr('count_show'));
                let count_add = $(this).attr('count_add');
                let page = parseInt($(this).attr('page'));
                let cat_id = '<?php echo $catid;?>';





                btn_more.val('Подождите...');

                 $.ajax({
                     url: "ajax.php", // куда отправляем
                     type: "get", // метод передачи
                     dataType: "json", // тип передачи данных
                     data: { // что отправляем
                         "count_show": count_show,
                         "count_add": count_add,
                         "page":"page=" + page,
                          cat_id,
                          page,
                     },
                     // после получения ответа сервера
                     success: function (data) {

                         if (data.result == "success") {
                             $('#list').append(data.html);
                             btn_more.val("Загрузить еще");
                             btn_more.attr('count_show', (count_show + 16));
                             btn_more.attr('page', (page + 1));
                             btn_more.attr('href','umarket?page='+ (page + 1));


                         } else {
                             btn_more.val("Товаров нет").fadeOut(1500);
                         }
                     }
                 });
             });

    </script>


    <!-- Баннер низ -->
    <div id="umarket-banner-under">
        <div class="umarket-banner-wrap">
            <p>Новые брендовые товары по низким ценам. Регулярные поставки с магазинов. Доставка по всей Латвии.</p>
        </div>
        <a href="http://nboutlet.eu/index.php" class="btn btn-cross" id="btnCross" target="blank">Перейти</a>
    </div>

    <!-- Боковая правая панель -->
    <aside class="rigth-aside">
        <p class="btn-up" id="btnUp"><img src="/images/umarket_arrow_up.png" alt="button-up"></p>
        <p class="btn-email" id="rightEmail"><img src="/images/umarket_mailing.png" alt="email"></p>
        <!--Форма боковая-->
        <div class="popup-container popup-container-email--rectangle" id="popup-email">
            <div class="popup-heading">
                <h5>Оставьте ваше сообщение</h5>
                <a class="close-modal-email" href="#"><img src="/images/umarket_close-modal.png" alt="close"/></a>
            </div>
            <div class="form-block">
                <form class="form" action="http://<?php echo $_SERVER['HTTP_HOST'] . '/umarket_send_mail.php'; ?>"
                      method="POST">
                    <input type="email" name="email" class="modal-email" placeholder="Email"
                           value="<?php echo $email; ?>" required/>
                    <textarea name="message" placeholder="Текст сообщения" cols="30" rows="10"
                              value="<?php echo $message; ?>" required></textarea>
                    <div class="captch-block">
                        <img src="umarket_captcha.php?color=#023BC7" alt="Img captcha"/>
                        <input type="number" name="kapcha" placeholder="Капча" required/>
                        <input type="hidden" name="captcha_key" value=""/>
                    </div>
                    <button class="btn-modal-right" type="submit" id="btn-email">Отправить</button>
                </form>
            </div>
        </div>
    </aside>

</div>
<?php include("blocks/umarket_footer.php"); ?>
<?php include_once('blocks/umarket_rightcart.php') ?>

<script src="js/jquery.sidebar.min.js"></script>
<script src="js/umarket.js"></script>
<script src="js/umarket_mycart.min.js"></script>
<!--<script src="js/pagination/ajax.js"></script>-->
<!--<script src="js/pagination/history.js"></script>-->

</body>

</html>