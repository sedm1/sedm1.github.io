<?php
session_start();
require_once("config.php"); //Подключение к бд
require_once("library/pagination_lv.php"); //Подключение пагинацию


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
$pagination->url = 'catalog_lv.php' . $url . '&page={page}';

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="">
	<title>NB Outlet - <?= $_SESSION['category'] ?></title>
	<link rel="preload" as="style" href="css/reset.min.css">
	<link href="css/reset.min.css" rel="stylesheet" type="text/css">
	<link rel="preload" as="style" href="css/main.min.css">
	<link href="css/main.min.css" rel="stylesheet" type="text/css">
	<link rel="preload" as="style" href="css/catalog.min.css">
	<link href="css/catalog.min.css" rel="stylesheet" type="text/css">
	<link rel="preload" as="style" href="css/default.min.css">
	<link href="css/default.min.css" rel="stylesheet" type="text/css">
	<link rel="preload" as="style" href="css/fonts.min.css">
	<link href="css/fonts.min.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="/favicon.ico" sizes="32x32">
	<link rel="preload" href="js/jquery-1.12.0.min.js" as="script">
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<link rel="preload" href="js/accordeon/accordeon.min.js" as="script">
	<script type="text/javascript" src="js/accordeon/accordeon.min.js"></script>
	<script async type="text/javascript" src="js/jquery.lazyload.min.js"></script>
	<script async type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<link rel="preload" as="style" href="js/accordeon/accordeon.min.css">
	<link rel="stylesheet" type="text/css" href="js/accordeon/accordeon.min.css" />
	<script async type="text/javascript" src="js/cufon-yui.js"></script>
	<script async type="text/javascript" src="fonts/circe-light.cufonfonts.min.js"></script>
	<script async type="text/javascript" src="fonts/circe.cufonfonts.min.js"></script>
	<script async type="text/javascript" src="fonts/circe-bold.cufonfonts.min.js"></script>
	<!--CART-->
	<link rel="preload" as="style" href="css/custom.min.css">
	<link href="css/custom.min.css" type="text/css" rel="stylesheet">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
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

	<script type="text/javascript">
		$(function() {
			'use strict';
			var $uniformed = $("input:checkbox").not(".skipThese");
			$uniformed.uniform();
		});
	</script>
	<!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->
</head>

<body>

	<div id="wrapper">
		<div id="bg_layer"></div>
		<!--Шапка-->
		<?php include("blocks/header_lv.php"); ?>

		<!--Каталог-->
		<div id="catalog">
			<div id="left-column">
				<form class="filter-form-cats" action="<?php echo $urlc; ?>" method="GET">
					<h1>Katalogs</h1>
					<!-- Аккордеон -->
					<ul class="menu" id="menu-accordion">
						<?php

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
						//Вывод категорий
						foreach ($arr2 as $cat) {
							if ($cat['id'] !=7 && $cat['id'] !=8 && $cat['id'] !=9 && $cat['id'] !=10 && $cat['id'] !=11 && $cat['id'] !=12){
							?>
							<li <?php if ($cat['id'] == $_SESSION['catid']) : ?> class="expand" <?php endif; ?>>
								<?php if (isset($cat['id']) && $cat['id'] == 3) { ?>
									<a href="?subid=25"><?= $cat['category_lv'] ?></a>
								<?php } else { ?>
									<a href="?catid=<?= $cat['id'] ?>"><?= $cat['category_lv'] ?></a>
								<?php } ?>
								<ul class="acitem">
									<?php

									//Вывод подкатегорий
									foreach ($arr1 as $sub) {
										if ($cat["id"] == $sub["cat_id"]) {
											?>
											<li><a href="?subid=<?= $sub['id'] ?>" <?php if ($sub['id'] == $subid) {
																						echo 'id="current"';
																					} ?>><?= $sub['subcategory_lv'] ?></a>
												<?php if (count($rows) > 0) { ?>
													<ul <?php if (isset($_GET['subid']) && $_GET['subid'] == $sub["id"]) : ?> style="display:block; top:8px;" class="clearfix" <?php else : ?> style="display:none;">
														<?php endif; ?>
														<?php

														$sort_size = array();
														$sort_age = array();


														if (isset($_GET['subid'])) {
															$where = '`sub_id`=' . $_GET['subid'];
														} elseif (isset($_GET['catid'])) {
															$where = '`cat_id`=' . $_GET['catid'];
														}

														$query_size = mysql_query("SELECT DISTINCT `cat_id`, `size`, `sub_id`, `age` FROM `catalog` WHERE `size` IS NOT NULL AND `size` <> ''  AND " . $where . " ORDER BY size");
														while ($xx = mysql_fetch_assoc($query_size)) {
															$sort_size[] = $xx;
														}
														// Возраст вытаскиваем вторым запросом. 
														$query_age = mysql_query("SELECT DISTINCT `cat_id`, `sub_id`, `age` FROM `catalog` WHERE " . $where . " AND `age` <> 0 ORDER BY `age` ASC");
														while ($age_age = mysql_fetch_assoc($query_age)) {
															$sort_age[] = $age_age;
														}

														?>

														<li class="filter-slider clearfix">
															<?php if (!empty($sort_age)) : ?>
																<?php
																$ages = array(
																	1 => 'no 0 līdz 12 mēnešiem',
																	2 => 'nav 1 līdz 5 gadiem',
																	3 => 'no 5 līdz 10 gadiem',
																	4 => 'no 10 līdz 15 gadiem',
																);
																ksort($ages);
																?>

																<?php $html = ''; ?>
																<h1>Vecums</h1>
																<?php $html .= '<ul class="filter-sort-age clearfix">'; ?>

																<?php foreach ($sort_age as $age_number) : ?>
																	<?php

																	if ($age_number['age'] == 0) {
																		continue;
																	}

																	$ch = '';
																	if (isset($_GET['age'])) {
																		if ($_GET['age'] == $age_number['age']) {
																			$ch = ' checked ';
																		}
																	}
																	?>


																	<?php $html .= '<li><label><input ' . $ch . ' style="display:none;" type="radio" name="age" value="' . $age_number['age'] . '"/> ' . $ages[$age_number['age']] . '</label></li>'; ?>
																<?php endforeach; ?>
																<?php $html .= '</ul>'; ?>
																<?php echo $html; ?>
															<?php endif; ?>


															<?php if (!empty($sort_size) && $_GET['subid'] != 25 &&  $_GET['subid'] != 26 &&  $_GET['catid'] != 3) : ?>
																<h1>Izmēri</h1>
																<?php $data_size = array(); ?>
																<?php foreach ($sort_size as $size) {


																	if (stristr($size['size'], ',') !== FALSE) {
																		$_size = explode(',',  $size['size']);

																		if (count($_size)) {
																			foreach ($_size as $item) {
																				if (!empty($item)) {
																					array_push($data_size, $item);
																				}
																			}
																		}
																	} else {
																		array_push($data_size, $size['size']);
																	}
																}

																$data_int = array();
																$data_string = array();

																if (!empty($data_size)) {
																	$html = '';
																	foreach (array_unique($data_size) as $size_xx) {
																		if (!intval($size_xx)) {
																			if (mb_strtoupper($size_xx) == 'XS') {
																				$data_string[1] = 'XS';
																			}
																			if (mb_strtoupper($size_xx) == 'S') {
																				$data_string[2] = 'S';
																			}
																			if (mb_strtoupper($size_xx) == 'M') {
																				$data_string[3] = 'M';
																			}
																			if (mb_strtoupper($size_xx) == 'L') {
																				$data_string[4] = 'L';
																			}
																			if (mb_strtoupper($size_xx) == 'XL') {
																				$data_string[5] = 'XL ';
																			}
																			if (mb_strtoupper($size_xx) == 'XXL') {
																				$data_string[6] = 'XXL';
																			}
																		}
																		if (intval($size_xx)) {
																			$data_int[] = $size_xx;
																		}
																	}


																	if (!empty($data_string)) {
																		ksort($data_string);
																		$html = '<ul class="filter-sort-size clearfix">';
																		foreach (array_unique($data_string) as $size_xx) {
																			if (!empty($size_xx)) {
																				$ch = '';
																				if (isset($_GET['size'])) {
																					if (in_array($size_xx, $_GET['size'])) {
																						$ch = 'checked';
																					}
																				}
																				$html .= '<li><label><input ' . $ch . ' type="checkbox" name="size[]" value="' . trim($size_xx) . '"/> ' . trim($size_xx) . '</label></li>';
																			}
																		}
																		$html .= '</ul>';
																	}

																	$html .= '<div class="clear"></div>';
																	if (!empty($data_string) && !empty($data_int)) {
																		$html .= '<hr class="hr sort-hr" />';
																	}

																	if (!empty($data_int)) {


																		sort($data_int);
																		$html .= '<ul class="filter-sort-size clearfix">';
																		foreach (array_unique($data_int) as $size_xx) {
																			if (!empty($size_xx)) {
																				$ch = '';
																				if (isset($_GET['size'])) {
																					if (in_array($size_xx, $_GET['size'])) {
																						$ch = 'checked';
																					}
																				}


																				$html .= '<li><label><input ' . $ch . ' type="checkbox" name="size[]" value="' . trim($size_xx) . '"/> ' . trim($size_xx) . '</label></li>';
																			}
																		}
																		$html .= '</ul>';
																	}


																	//dd($data_string);

																	echo $html;
																}
																?>

															<?php endif; ?>
															<?php if (count($rows) > 0 && $url_min_price != $url_max_price) : ?>
																<?php if ($cat['id'] == $_SESSION['catid']) : ?>

																	<h1>Cena</h1>
																	<div class="price-slider">

																		<div class="price-range">
																			<div class="price-range-form">
																				<input name="min_price" class="min-price" type="text" placeholder="<?php echo round($url_min_price); ?>" />
																				<input name="max_price" class="max-price" type="text" placeholder="<?php echo round($url_max_price); ?>" />
																			</div>


																			<div class="clearfix">
																				<div class="slider-margin-value-min">€ <span><?php echo round($url_min_price); ?></span></div>
																				<div class="slider-margin-value-max">€ <span><?php echo round($url_max_price); ?></span></div>
																			</div>

																			<!-- <button class="btn-filter" type="submit">ПРИМЕНИТЬ</button> -->
																		</div>

																	</div>
																<?php endif; ?>
															<?php endif; ?>
														</li>
													</ul>
												<?php } ?>
											</li>
										<?php
									}
								}
								?>
									<?php if (isset($cat['id']) && $cat['id'] != 3) { ?>
										<li class="all-products-link"><a href="?catid=<?= $cat['id'] ?>">Visas preces</a></li>
									<?php } ?>
								</ul>
							</li>

						<?php
						}
					}
					?>
					</ul>
				</form>
			</div>
			<div id="right-column">
				<!--Фильтр-->
				<div id="filter">
					<ul>
						<li><a href="<?php echo $sid; ?>" <?php if ($status == '-1' || !$status) {
																echo 'id="active"';
															} ?>>Visi</a></li>
						<li><a href="<?php echo $sid; ?>&status=1" <?php if ($status == 1) {
																		echo 'id="active"';
																	} ?>>Jauni</a></li>
						<li><a href="<?php echo $sid; ?>&status=3" <?php if ($status == 3) {
																		echo 'id="active"';
																	} ?>>Akcijas Preces</a></li>
						<li><a href="<?php echo $sid; ?>&status=2" <?php if ($status == 2) {
																		echo 'id="active"';
																	} ?>>Izpārdots</a></li>

					</ul>
				</div>

				<!--Список товаров-->
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
											<a href="view_lv.php?item=<?= $row['id'] ?>">
												<div class="view">
													<div class="status 
													<?php
													if ($row['status'] == '0') { } elseif ($row['status'] == '1') {
														echo "new";
													} elseif ($row['status'] == '2') {
														echo "sold";
													}
													// else { echo "offer";}
													?>
													">
													</div><?php if ($row['catalog_image']) {
																echo '<img src="../../uploads/catalog/' . $row['catalog_image'] . '" alt="' . $row['catalog_image'] . '">';
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
														<div class="price">&euro;<?= $row['price'] ?></div>
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
					<?php echo $pagination_render; ?>
				</div>
			</div>
			<!--Доставка и оплата-->
			<div id="delivery_lv"></div>
			<div id="message">
				<div id="left-column"></div>
				<div id="right-column">
					Cienījamie pircēji. Diemžēl mums ne vienmēr ir laiks, lai sagatavotu un izliktu mājas lapā kvalitatīvu foto kontentu. Par visu, kas jums iepaticies no mūsu preču klāsta, jūs varat uzrakstīt uz e-pastu, un mēs atsūtīsim vairāk foto un informācijas par precēm.
				</div>
			</div>
		</div>
        <!--Кнопка вверх-->
        <div class="button-up-wrap" id="btnUp">
            <img src="images/btn-up2.png" alt="arrow up"/>
        </div>
        <!--    Стили кнопки вверх-->
        <style>
            .button-up-wrap {
                width: 45px;
                position: fixed;
                bottom: 40px;
                right: 15px;
                cursor: pointer;
            }
            .button-up-wrap img {
                width: 100%;
                height: auto;
            }
        </style>
        <script>
            // Кнопка вверх
            let buttonUp = $('#btnUp');
            buttonUp.on('click', function (event) {
                //  event.preventDefault();
                $('html, body').animate({
                    scrollTop: $('body').offset().top
                }, 800);
            });
        </script>
		<!--Подвал-->
		<?php include("blocks/footer_lv.php"); ?>
		<?php include_once('blocks/rightcart.php') ?>
		<script async src="js/jquery.sidebar.min.js"></script>
		<script async src="js/mycart.min.js"></script>
		<!-- Программирование Соловьёв Евгений http://freelance.ru/users/belltone/ -->
		<!-- Update -->
		<!-- Программирование Гурьев Валентин  http://freelance.ru/users/fabrigas201/ -->
		<!-- Интеграция корзины Коморин Роман  https://freelance.ru/Ktulchu -->


</body>

</html>