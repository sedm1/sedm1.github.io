<?php 
require_once('lock.php');

//Определение выбраного раздела
if ($_COOKIE['cat']) { $_COOKIE['cat']; } else { $_COOKIE['cat'] = '1'; }
$category = mysql_query("SELECT * FROM `subcategory` WHERE `id`='".$_COOKIE['cat']."'");
$cat = mysql_fetch_array($category);

if(!empty($_GET['item_article']))
{
	if (strpos($_GET['item_article'], 'NB-') !== false)
	{
		$article = $_GET['item_article'];
	} else {
	    $article = "UM-".$_GET['item_article'];
	}

	$copy_item_text = mysql_query("SELECT id, name, name_lv, name_en, description, description_lv, description_en, text, text_lv, text_en, article FROM `catalog` WHERE `article`='".$article."'");
	$copy = mysql_fetch_array($copy_item_text);
}






?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS NBOutlet | Добавление товара</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
<script src="js/jquery-1.12.0.min.js" type="text/javascript"></script>
<script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
<style>

/* TABS */
.tabs {
    position: relative;
    margin: 0 auto;
	width: 650px}
.tabs label {
	display: block;
	float: left;
	background: #ffffff;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjQlIiBzdG9wLWNvbG9yPSIjZWZmMGY0IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2RkZGVlMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
	background: -moz-linear-gradient(top,  #ffffff 0%, #eff0f4 4%, #dddee0 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(4%,#eff0f4), color-stop(100%,#dddee0));
	background: -webkit-linear-gradient(top,  #ffffff 0%,#eff0f4 4%,#dddee0 100%);
	background: -o-linear-gradient(top,  #ffffff 0%,#eff0f4 4%,#dddee0 100%);
	background: -ms-linear-gradient(top,  #ffffff 0%,#eff0f4 4%,#dddee0 100%);
	background: linear-gradient(to bottom,  #ffffff 0%,#eff0f4 4%,#dddee0 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#dddee0',GradientType=0 );
	-moz-border-radius: 6px 6px 0 0;
	-webkit-border-radius: 6px 6px 0 0;
	border-radius: 6px 6px 0 0;
	border-right: 1px solid #f3f3f3;
	border-left: 1px solid #ccc;
	color: #555;
	cursor: pointer;
	font-weight: bold;
	font-size: 15px;
	position: relative;
	top: 2px;
	width: 200px;
	height: 45px;
	line-height: 45px;
	text-align: center;
	text-transform: uppercase;
	text-shadow: #fff 0 1px 0;
	z-index: 1;}
.tab0 {
	position: absolute;
	left: -9999px;}
#tab_1:checked  ~ #tab_l1,
#tab_2:checked  ~ #tab_l2,
#tab_3:checked  ~ #tab_l3 {
	background: #fff;
	border-color: #fff;
	top: 0;
	z-index: 3;}

.tabs_cont {
	background: #fff;
	-moz-border-radius: 0 6px 6px 6px;
	-webkit-border-radius: 0 6px 6px 6px;
	border-radius: 0 6px 6px 6px;
	-moz-box-shadow: 0 -2px 3px -2px rgba(0,0,0,0.2), 2px 2px 2px rgba(0,0,0,0.1);
	-webkit-box-shadow: 0 -2px 3px -2px rgba(0,0,0,0.2), 2px 2px 2px rgba(0,0,0,0.1);
	box-shadow: 0 -2px 3px -2px rgba(0,0,0,0.2), 2px 2px 2px rgba(0,0,0,0.1);
	padding: 20px 25px;
	position: relative;
	z-index: 2;
	height: 650px;}
.tabs_cont > div {
	position: absolute;
	left: -9999px;
	top: 0;
	opacity: 0;
    -moz-transition: opacity .5s ease-in-out;
    -webkit-transition: opacity .5s ease-in-out;
	transition: opacity .5s ease-in-out;}

#tab_1:checked ~ .tabs_cont #tab_c1,
#tab_2:checked ~ .tabs_cont #tab_c2,
#tab_3:checked ~ .tabs_cont #tab_c3 {
 
	left: 0;
	padding:10px;
	opacity: 1;}
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
            <div class="title"><a href="catalog.php">Каталог</a> / Добавление товара<p></div>

			<!--НАЧАЛО ФОРМЫ-->
            <form method="POST" action="add_product.php" enctype="multipart/form-data">
			
			
			<section class="tabs">
	<input id="tab_1" type="radio" name="tab" checked="checked" class="tab0" />
	<input id="tab_2" type="radio" name="tab" class="tab0"/>
	<input id="tab_3" type="radio" name="tab" class="tab0"/>
	<label for="tab_1" id="tab_l1"><img src="http://nboutlet.eu/images/rus.png"> Русский </label>
	<label for="tab_2" id="tab_l2"><img src="http://nboutlet.eu/images/lv_l.png"> Латвийский</label>
	<label for="tab_3" id="tab_l3"><img src="http://nboutlet.eu/images/eng.png"> Английский</label>
	<div style="clear:both"></div>

	<div class="tabs_cont">
		<div id="tab_c1"> 
			 <table>
                      <tr>
                        <td style="width:150px;">Название: </td>
                        <td><input name="name" type="text" value="<?=$copy['name'];?>"></td>
                      </tr>
                       <tr>
                        <td>Краткое описание: </td>
                        <td><input name="description" type="text" value="<?=$copy['description'];?>"></td>
                      </tr>
                    </table>
					
                    <textarea name="text" rows="4"><?php echo trim($copy['text']);?></textarea>
                    <script type="text/javascript">CKEDITOR.replace( 'text' );</script>					
					<br/>
					<table>
					
					  <tr>
                        <td>Копировать текст у товара:</td>
                        <td>
						<input type="text" name="text_item" value="" style="width: 170px; top: 5px;  position:relative;" placeholder="Артикль">
						<input type="submit" name="text_copy" class="btn" style="top: 5px; right: 3px; position:relative; float:right;" value="Вставить"></td>
                      </tr>
		  
					  <tr><td><strong>Поисковые данные</strong></td><td><br/><br/><br/>
                      <tr>
                        <td>Описание товара:</td>
                        <td><input name="meta_d" type="text"></td>
                      </tr>
					    
					  <tr>
                        <td>Ключевые слова (через запятую):</td>
                        <td><textarea name="meta_k" type="text" rows="2" style="width:270px;"></textarea></td>
                      </tr>
					 
                    </table>
			</div>
		<div id="tab_c2">
			<table>
                      
					    <tr>
                        <td style="width:150px;">Название:</td>
                        <td><input name="name_lv" type="text" value="<?=$copy['name_lv'];?>"></td>
                      </tr>     
					  <tr>
                        <td>Краткое описание:</td>
                        <td><input name="description_lv" type="text" value="<?=$copy['description_lv'];?>"></td>
                      </tr>
                    </table>		
					<textarea name="text_lv" rows="4"><?=$copy['text_lv'];?></textarea> 
                    <script type="text/javascript">CKEDITOR.replace( 'text_lv' );</script>
					<br/>
					<table>
					  <tr><td><strong>Поисковые данные</strong></td><td><br/><br/>                     
					   <tr>
                        <td>Описание товара :</td>
                        <td><input name="meta_d_lv" type="text"></td>
                      </tr>
					 
					  <tr>
                        <td>Ключевые слова (через запятую):</td>
                        <td><textarea name="meta_k_lv" type="text" rows="2" style="width:270px;"></textarea></td>
                      </tr>
                    </table>
					</div>
						<div id="tab_c3">
			<table>
                      
					    <tr>
                        <td style="width:150px;">Название:</td>
                        <td><input name="name_en" type="text" value="<?=$copy['name_en'];?>"></td>
                      </tr>     
					  <tr>
                        <td>Краткое описание:</td>
                        <td><input name="description_en" type="text" value="<?=$copy['description_en'];?>"></td>
                      </tr>
                    </table>		
					<textarea name="text_en" rows="4"><?=$copy['text_en'];?></textarea> 
                    <script type="text/javascript">CKEDITOR.replace( 'text_en' );</script>
					<br/>
					<table>
					  <tr><td><strong>Поисковые данные</strong></td><td><br/><br/>                     
					   <tr>
                        <td>Описание товара :</td>
                        <td><input name="meta_d_en" type="text"></td>
                      </tr>
					 
					  <tr>
                        <td>Ключевые слова (через запятую):</td>
                        <td><textarea name="meta_k_en" type="text" rows="2" style="width:270px;"></textarea></td>
                      </tr>
                    </table>
					</div>	
		 
	</div>
</section>
<h2>Фотографии</h2>
                <div class="table-form">
					<table>
                      <tr>
						<td>Фотография для каталога:</td>
						<td><input type="file" name="catalog_image"></td>
					  </tr>
					  <tr>
						<td>1-я фотография:</td>
						<td><input type="file" name="image"></td>
					  </tr>
					  <tr>
						<td>2-я фотография:</td>
						<td><input type="file" name="image1"></td>
					  </tr>
					  <tr>
						<td>3-я фотография:</td>
						<td><input type="file" name="image2"></td>
					  </tr>
					</table>
					<br/><br/>
				<h2>Дополнительная информация</h2>
					<table>
					 
                      <tr>
                        <td>Артикль:</td>
                        <td><input name="article" type="text" ></td>
                      </tr>
					  <tr>
                        <td>Цена в евро:</td>
                        <td><input name="price" type="text" ></td>
                      </tr>
					  <tr>
                        <td>Цена со скидкой</td>
                         <td><input name="price_stock" type="text" ></td>
                      </tr>
					  <tr>
                        <td>Размеры:</td>
                        <td><input name="filter_size" type="text" ></td>
                      </tr>
					  <tr>
                        <td>Статус:</td>
                        <td>
						<select name="status" style="width:284px;">
							<option value="0">Нет</option>
							<option value="1">Новый</option>
							<option value="2">Продано</option>
							<option value="3">Со скидкой</option>
						</select>
						</td>
                      </tr>
					  <tr>
                        <td>Возраст:</td>
                        <td>
						<select name="age" style="width:284px;">
							<option value="0">Нет</option>
							<option value="1">от 0 до 12 месяцев </option>
							<option value="2">от 1 года до 5 лет </option>
							<option value="3">от 5 до 10 лет</option>
							<option value="4">от 10 до 15 лет</option>
						</select>
						</td>
                      </tr>
                    </table>
					<br/>
					<!--
					<textarea name="details" rows="4"><?=$row['details'] ?></textarea> 
                    <script type="text/javascript">CKEDITOR.replace( 'details' );</script>
					<br/>

                    <br/>
					-->
					
					
                    <div class="bar">
                    <input name="catid" type="hidden" value="<?=$cat['cat_id'] ?>">
                    <input name="subid" type="hidden" value="<?=$_COOKIE['cat'] ?>">
                    <input type="submit" class="btn" style="left:-15px; position:relative;" value="Добавить товар">
                    </form>
                    </div>
            </div>
                    
            <!--КОНЕЦ ФОРМЫ-->
            
            </div>
        </div>
</div>

<!--Подвал-->
<?php require_once('blocks/footer.php'); ?>


</body>
</html>