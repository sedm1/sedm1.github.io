<?php

require_once 'init.php';
require_once 'stat.php';

//Подключение пагинацию
require_once 'library/pagination.php';


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
  //echo 'size<br>';
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

//echo $total.'<br>';
//echo sizeof( $rows ).' '.$total;
$pagination = new Pagination();
$pagination->total = $total;
$pagination->page = $page;
$pagination->limit = $num;
$pagination->url = 'catalog.php'.$url.( strpos( $url, '?' ) === false ? '?' : '&' ).'page={page}';
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

$page_title = 'Salemarket';
//$page_meta_desc = $item['meta_d'];
//$page_meta_keyw = $item['meta_k'];


$page_js = array
(
  'js/main.catalog.js',
);
$page_js_head = array
(
  'js/jquery.lazyload.min.js',
  'js/jquery.uniform.min.js',
  'js/cufon-yui.js',
  'fonts/circe-light.cufonfonts.min.js',
  'fonts/circe.cufonfonts.min.js',
  'fonts/circe-bold.cufonfonts.min.js',
  'js/accordeon/accordeon.min.js',
  '//code.jquery.com/ui/1.12.1/jquery-ui.min.js" ',
);
$page_css = array
(
  'css/main.catalog.css?'.filemtime( __DIR__.'/css/main.catalog.css' ),
  'js/accordeon/accordeon.min.css',
  'css/custom.min.css?'.filemtime( __DIR__.'/css/custom.min.css' ),
  'css/catalog.min.css',
  '//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css',
  'js/jquery-ui-1.12.0.custom/jquery-ui.theme.css',

);

include_once 'blocks/html.header.php';

//Определяем в какой категории находится продукт
if (isset($catid)) {
  $_SESSION['catid'] = $catid;
  $_SESSION['subid'] = '';
} else {
  //Дополнительные параметры для категории
  foreach ($arr1 as $sub) {
    if ($sub['id'] == $subid) $_SESSION['catid'] = $sub['cat_id'];
  }
}

?>
<script>
  $(function() {

    // $('.filter-form-cats input:checkbox').prop('checked', false);

    //var f = $('form.price-range-form');
    $('.filter-form-cats').on('change', function() {

      var f = $(this);
      var fields = f.serializeArray();

      var params = [];
      for (var i = 0; i < fields.length; i++) {
        if (fields[i].value !== '') {
          params.push(fields[i].name + '=' + fields[i].value);
        }
      }

      <?php
      if (isset($_GET['catid'])) {
        $catsub = 'catid=' . $_GET['catid'] . '&';
      } elseif (isset($_GET['subid'])) {
        $catsub = 'subid=' . $_GET['subid'] . '&';
      } else {
        $catsub = '';
      }
      ?>


      var url = '?<?php echo $catsub; ?>' + params.join('&');

      $('#products-list').html('<div class="products-loading"><img src="<?php echo get_url('images/spin.gif'); ?>"></div>');
      $.get(url, function(html) {

        console.log(url);
        var tmp = $('<div></div>').html(html);
        $('#products-list').html(tmp.find('#products-list').html());
      });

      return false;
    });


    $('.price-range .price-range-form').each(function() {
      if (!$(this).find('.price-range .price-range-form').length) {
        $(this).append('<div class="price-range"><div class="price-range-form"></div></div>');
      } else {
        return;
      }
      var min = $(this).find('.min-price');
      var max = $(this).find('.max-price');

      var min_value = parseFloat(min.attr('placeholder'));
      var max_value = parseFloat(max.attr('placeholder'));

      var slider = $(this).parent('.price-range');

      slider.slider({
        range: true,
        min: parseFloat(min.attr('placeholder')),
        max: parseFloat(max.attr('placeholder')),
        values: [
          parseFloat(min.val().length ? min.val() : min.attr('placeholder')),
          parseFloat(max.val().length ? max.val() : max.attr('placeholder'))
        ],
        slide: function(event, ui) {
          $(".slider-margin-value-min").html("€ <span>" + ui.values[0] + "</span>");
          $(".slider-margin-value-max").html("€ <span>" + ui.values[1] + "</span>");
          var v = ui.values[0] == $(this).slider('option', 'min') ? '' : ui.values[0];
          min.val(v);
          v = ui.values[1] == $(this).slider('option', 'max') ? '' : ui.values[1];
          max.val(v);
        },
        stop: function(event, ui) {
          min.change();
        }
      });
      min.add(max).change(function() {
        var v_min = min.val() === '' ? slider.slider('option', 'min') : parseFloat(min.val());
        var v_max = max.val() === '' ? slider.slider('option', 'max') : parseFloat(max.val());
        if (v_max >= v_min) {
          slider.slider('option', 'values', [v_min, v_max]);
        }
      });
    });
  });
</script>
<script async type="text/javascript">
  $(function() {
    'use strict';
    var $uniformed = $("input:checkbox").not(".skipThese");
    $uniformed.uniform();
  });
</script>
<script>
  $(document).ready(function() {
    $('ul#menu-accordion > li > a').on('click', function() {

      if ($(this).attr('href') == '?subid=25') {
        return true;
      }


      if (!$(this).parent().hasClass('expand')) {
        $('ul#menu-accordion > li > a').removeClass('active').next('ul').slideUp().parent().removeClass('expand');

        $(this).parent().toggleClass('expand');
        $(this).toggleClass('active');
        $(this).siblings('ul').slideToggle(200);

      } else {
        $(this).removeClass('active').next('ul').slideUp().parent().removeClass('expand');
      }
      return false;
    });
  });
</script>

<!--[if lte IE 10]>
<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->
<section class="catalog">
  <div class="container container-flex catalog-container">
    <div class="left-column">
      <form class="filter-form-cats" action="<?php echo $urlc; ?>" method="GET">
      <div class="left-column__menu">
        <h2 class="left-column__tittle">Каталог</h2>
        <ul class="left-column__nav">
          <li class="left-column__items">
            <a href="catalog.php" class="left-column__links  <?= $_SESSION['catid'] == 0 ? 'active' : '' ?> all">Все товары</a>
          </li>
          <li class="left-column__items one">
            <a href="##" class="left-column__links accordeon <?= in_array( $_SESSION['catid'], array( 1, 2, 3 ) ) ? 'active' : '' ?>">Одежда</a>
            <ul class="acitem" <?= in_array( $_SESSION['catid'], array( 1, 2, 3 ) ) ? ' style="display:block;"' : '' ?>>
              <li class="acitem-items two">
                <!-- catid=1 -->
                <a href="##" class="left-column__links accordeon2 accordeon__links <?= $_SESSION['catid'] == 1 ? 'active' : '' ?>">Женская</a>
                <ul class="acitem2" <?= $_SESSION['catid'] == 1 ? ' style="display:block;"' : '' ?>>
                  <?= htmlCatSuv( $arr1, 1 );?>
                </ul>
              </li>
              <li>
                <!-- catid=2 -->
                <a href="##" class="left-column__links accordeon2 accordeon__links <?= $_SESSION['catid'] == 2 ? 'active' : '' ?>">Мужская</a>
                <ul class="acitem2" <?= $_SESSION['catid'] == 2 ? ' style="display:block;"' : '' ?>>
                  <?= htmlCatSuv( $arr1, 2 );?>
                </ul>
              </li>
              <li>
                <!-- catid=3 -->
                <a href="##" class="left-column__links accordeon2 accordeon__links <?= $_SESSION['catid'] == 3 ? 'active' : '' ?>">Детская</a>
                <ul class="acitem2" <?= $_SESSION['catid'] == 3 ? ' style="display:block;"' : '' ?>>
                  <li class="age">ВОЗРАСТ</li>
                  <li><a href="##" class="accordeon__links">от 0 до 12 месяцев</a></li>
                  <li><a href="##" class="accordeon__links">от 1 года до 5 лет</a></li>
                  <li><a href="##" class="accordeon__links">от 5 до 10 лет</a></li>
                  <li><a href="##" class="accordeon__links">от 10 до 15 лет</a></li>
                  <li><a href="?catid=3" class="accordeon__links btn-all-products">Все товары</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="left-column__items">
            <!-- catid=4 -->
            <a href="##" class="left-column__links accordeon <?= $_SESSION['catid'] == 4 ? 'active' : '' ?>">Обувь</a>
            <ul class="acitem" <?= $_SESSION['catid'] == 4 ? ' style="display:block;"' : '' ?>>
              <?= htmlCatSuv( $arr1, 4 );?>
            </ul>
          </li>
          <li class="left-column__items">
            <!-- catid=5 -->
            <a href="##" class="left-column__links accordeon <?= $_SESSION['catid'] == 5 ? 'active' : '' ?>">Акессуары</a>
            <ul class="acitem" <?= $_SESSION['catid'] == 5 ? ' style="display:block;"' : '' ?>>
              <?= htmlCatSuv( $arr1, 5 );?>
            </ul>
          </li>
          <li class="left-column__items">
            <!-- catid= ?? -->
            <a href="##" class="left-column__links accordeon">Электроника</a>
            <ul class="acitem">
              <li><a href="##" class="accordeon__links">Компьютеры</a></li>
              <li><a href="##" class="accordeon__links">Телефоны</a></li>
              <li><a href="##" class="accordeon__links">Телевизоры</a></li>
              <li><a href="##" class="accordeon__links">Игры</a></li>
              <li><a href="##" class="accordeon__links">Другое</a></li>
            </ul>
          </li>
          <li class="left-column__items">
            <!-- catid=6 -->
            <a href="##" class="left-column__links accordeon <?= $_SESSION['catid'] == 6 ? 'active' : '' ?>">Другие товары</a>
            <ul class="acitem" <?= $_SESSION['catid'] == 6 ? ' style="display:block;"' : '' ?>>
              <?= htmlCatSuv( $arr1, 6 );?>
            </ul>
          </li>
        </ul>
      </div>
      </form>
    </div>
    <div class="right-column">
      <ul class="right-column__filter">
        <li class="right-column__items"><a href="<?php echo $sid; ?>" class="right-column__links <?= ( ( $status == '-1' || !$status ) ? 'right-column__active' : '' );?>">Все</a></li>
        <li class="right-column__items"><a href="<?php echo $sid; ?>&status=1" class="right-column__links <?= ( ( $status == 1 ) ? 'right-column__active' : '' );?>">Новинки</a></li>
        <li class="right-column__items <?= ( ( $status == 3 ) ? 'right-column__active' : '' );?>"><a href="<?php echo $sid; ?>&status=3" class="right-column__links">Скидки</a></li>
        <li class="right-column__items <?= ( ( $status == 2 ) ? 'right-column__active' : '' );?>"><a href="<?php echo $sid; ?>&status=2" class="right-column__links">Продано</a></li>
      </ul>
      <div id="products-list" class="product-list">
          <?php
          //Запрос для вывода всех подкатегорий
          if(count($rows) > 0)
          {
            echo '<ul class="product-list__ul">';
            foreach( $rows as $row )
              echo htmlCatItem( $row );
            echo '</ul>';
          }
          else
          {
            echo '<div class="empty-product">Нет предложений</div>';
          }
          ?>
          <?php echo $pagination_render; ?>
      </div>

    </div>
  </div>
</section>
<section class="sending">
  <div class="container container-flex">
    <img src="img/truck.svg" alt="">
    <p class="sending__text">Отправляем товары по всей Латвии</p>
    <img src="img/omnivia.svg" alt="">
    <img class="pasts" src="img/pasts.svg" alt="">
  </div>
</section>
<section class="warning">
  <div class="container container-flex">
    <img src="img/warning.svg" alt="">
    <p class="warning__text">Мерки товара, дополнтельные фото, состав тканей можно получить по запросу написав нам на почту.</p>
  </div>
</section>

<?php
include_once 'blocks/quickcheckout.php';
include_once 'blocks/html.footer.php';


// Вывод подкатегорий
function htmlCatSuv( $arr, $cat_id )
{
  global $subid, $rows, $url_max_price, $url_min_price;
  $o = '';
  foreach( $arr as $sub )
  {
    if( $cat_id != $sub["cat_id"] )
      continue;
    $o .= '
    <li><a class="accordeon__links '.( $sub['id'] == $subid ? '' : '' ).'" href="?subid='.$sub['id'].'"'.( $sub['id'] == $subid ? ' id="current"' : '' ).'>'.$sub['subcategory'].'</a>';
    if( count( $rows ) > 0 )
    {
      $o .= '<ul '.( ( isset( $_GET['subid'] ) && $_GET['subid'] == $sub["id"] ) ? 'style="display:block; top:8px;" class="clearfix"': 'style="display:none;"' ).'>';

    $sort_size = array();
    $sort_age = array();
    $where = '';
    if (isset($_GET['subid'])) {
      $where = '`sub_id`=' . $_GET['subid'];
    } elseif (isset($_GET['catid'])) {
      $where = '`cat_id`=' . $_GET['catid'];
    }

    $query_size = mysql_query("SELECT DISTINCT `cat_id`, `size`, `sub_id`, `age` FROM `catalog` WHERE `size` IS NOT NULL AND `size` <> '' ".( $where == '' ? '' : " AND ".$where ). " ORDER BY size");
    while ($xx = mysql_fetch_assoc($query_size)) {
        $sort_size[] = $xx;
      }
    // Возраст вытаскиваем вторым запросом.
    $query_age = mysql_query("SELECT DISTINCT `cat_id`, `sub_id`, `age` FROM `catalog` WHERE ".( $where == '' ? '' : $where." AND" )." `age` <> 0 ORDER BY `age`");
    while ($age_age = mysql_fetch_assoc($query_age)) {
      $sort_age[] = $age_age;
    }
    $o .= '<li class="filter-slider clearfix">';
      if( !empty( $sort_age ) )
      {
        $ages = array(
          1 => 'от 0 до 12 месяцев', 2 => 'от 1 года до 5 лет', 3 => 'от 5 до 10 лет', 4 => 'от 10 до 15 лет',
        );
        ksort( $ages );
        $html = '';
        $o .= '<h1>Возраст</h1>';
        $html .= '<ul class="filter-sort-age clearfix">';
        foreach( $sort_age as $age_number )
        {
          if( $age_number['age'] == 0 )
          {
            continue;
          }

          $ch = '';
          if( isset( $_GET['age'] ) )
          {
            if( $_GET['age'] == $age_number['age'] )
            {
              $ch = ' checked ';
            }
          }
          $html .= '<li><label><input '.$ch.' style="display:none;" type="radio" name="age" value="'.$age_number['age'].'"/> '.$ages[$age_number['age']].'</label></li>';
        }
        $html .= '</ul>';
        $o .= $html;
      }
      if (!empty($sort_size) && $_GET['subid'] != 25 &&  $_GET['subid'] != 26 &&  $_GET['catid'] != 3)
      {
        $o .= '<h1>Размеры</h1>';
        $data_size = array();
        foreach( $sort_size as $size )
        {
          if( stristr( $size['size'], ',' ) !== false )
          {
            $_size = explode( ',', $size['size'] );
            if( count( $_size ) )
            {
              foreach( $_size as $item )
              {
                if( !empty( $item ) )
                {
                  array_push( $data_size, $item );
                }
              }
            }
          }
          else
          {
            array_push( $data_size, $size['size'] );
          }
        }

        $data_int = array();
        $data_string = array();

        if( !empty( $data_size ) )
        {
          $html = '';
          foreach( array_unique( $data_size ) as $size_xx )
          {
            if( !intval( $size_xx ) )
            {
              if( mb_strtoupper( $size_xx ) == 'XS' )
              {
                $data_string[1] = 'XS';
              }
              if( mb_strtoupper( $size_xx ) == 'S' )
              {
                $data_string[2] = 'S';
              }
              if( mb_strtoupper( $size_xx ) == 'M' )
              {
                $data_string[3] = 'M';
              }
              if( mb_strtoupper( $size_xx ) == 'L' )
              {
                $data_string[4] = 'L';
              }
              if( mb_strtoupper( $size_xx ) == 'XL' )
              {
                $data_string[5] = 'XL ';
              }
              if( mb_strtoupper( $size_xx ) == 'XXL' )
              {
                $data_string[6] = 'XXL';
              }
            }
            if( intval( $size_xx ) )
            {
              $data_int[] = $size_xx;
            }
          }


          if( !empty( $data_string ) )
          {
            ksort( $data_string );
            $html = '<ul class="filter-sort-size clearfix">';
            foreach( array_unique( $data_string ) as $size_xx )
            {
              if( !empty( $size_xx ) )
              {
                $ch = '';
                if( isset( $_GET['size'] ) )
                {
                  if( in_array( $size_xx, $_GET['size'] ) )
                  {
                    $ch = 'checked';
                  }
                }
                $html .= '<li><label><input '.$ch.' type="checkbox" name="size[]" value="'.trim( $size_xx ).'"/> '.trim( $size_xx ).'</label></li>';
              }
            }
            $html .= '</ul>';
          }

          $html .= '<div class="clear"></div>';
          if( !empty( $data_string ) && !empty( $data_int ) )
          {
            $html .= '<hr class="hr sort-hr" />';
          }

          if( !empty( $data_int ) )
          {
            sort( $data_int );
            $html .= '<ul class="filter-sort-size clearfix">';
            foreach( array_unique( $data_int ) as $size_xx )
            {
              if( !empty( $size_xx ) )
              {
                $ch = '';
                if( isset( $_GET['size'] ) )
                {
                  if( in_array( $size_xx, $_GET['size'] ) )
                  {
                    $ch = 'checked';
                  }
                }
                $html .= '<li><label><input '.$ch.' type="checkbox" name="size[]" value="'.trim( $size_xx ).'"/> '.trim( $size_xx ).'</label></li>';
              }
            }
            $html .= '</ul>';
          }
          $o .= $html;
        }
      }
      if (count($rows) > 0 && $url_min_price != $url_max_price)
      {
        if( $cat_id == $_SESSION['catid'] )
        {
          $o .= '
                <h1>Цена</h1>
                <div class="price-slider">

                  <div class="price-range">
                    <div class="price-range-form">
                      <input name="min_price" class="min-price" type="text" placeholder="'.round( $url_min_price ).'" />
                      <input name="max_price" class="max-price" type="text" placeholder="'.round( $url_max_price ).'" />
                    </div>
                    <div class="clearfix">
                      <div class="slider-margin-value-min">€ <span>'.round( $url_min_price ).'</span></div>
                      <div class="slider-margin-value-max">€ <span>'.round( $url_max_price ).'</span></div>
                    </div>

                    <!-- <button class="btn-filter" type="submit">ПРИМЕНИТЬ</button> -->
                  </div>

                </div>';
        }
      }
      $o .= '          </li>
        </ul>';
      }
    $o .= '
    </li>';
  }
  $o .= '<li><a href="?catid='.$cat_id.'" class="accordeon__links btn-all-products">Все товары</a></li>';
  return $o;
}
?>

