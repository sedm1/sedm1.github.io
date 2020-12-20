<!--Список товаров-->
<div id="random">

<div id="item-list" style="margin-top:37px">
  <?php if($lang == 'ru') {echo "<h2>Другие Предложения</h2>";}
  elseif($lang == 'lv') {echo "<h2>Citi piedāvājumi</h2>";}
  else{echo "<h2>Other Offers</h2>";};?>
  <ul>
  <?php
	$rand_product = mysql_query("SELECT * FROM `catalog` WHERE `cat_id` BETWEEN 7 AND 11 AND `status` NOT IN (2) ORDER BY RAND() LIMIT 5");
	while($offer = mysql_fetch_array($rand_product)) {
	//Разбиение строки для имени товара
	$name = explode("(", $offer['name']);
	$name=str_replace(array(')'),array('',''),$name);
  ?>
  <li>
    <div <?php if($offer['status'] == 3){ echo 'style="border: solid red; width: 192px; height: 347px;"'; }?> >
	<a href="umarket_view<?php echo $ext; ?>.php?item=<?=$offer['id'] ?>">
	<div class="view">
	  <div class="status 
	  <?php 
		if ($offer['status'] == '0') {
		} elseif ($offer['status'] == '1') { echo "new";}
		elseif ($offer['status'] == '2') { echo "sold";}
	  ?>">
	</div><?php if ($offer['catalog_image']) { echo '<img src="'.$folder.'catalog/'.$offer['catalog_image'].'" alt="'.$offer['catalog_image'].'">'; } ?></div>
	<div class="title"><?=$offer['name'] ?></div>
	<div class="description"><?=$offer['description'.$ext] ?></div>
	<div class="article"><?=$offer['article'] ?></div>
	<?php if ($offer['status'] != '2') { ?>
	  <div class="price">
		<?php if ($offer['price_stock'] > 0): ?>
	      <span style="color: red">&euro;<?=$offer['price_stock'] ?></span> <span style="text-decoration:line-through; padding: 5px;">&euro;<?=$offer['price'] ?></span>
		<?php else : ?>
			<span>&euro;<?=$offer['price'] ?></span>
		<?php endif; ?>
    </div>
	<?php } ?>
	</a>
	</div>
  </li>
  <?php } ?> 
  </ul>
</div>

</div>
<div class="clearfix"></div>