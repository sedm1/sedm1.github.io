<?php $folder = 'uploads/'; //Папка с изображениями ?>
<?php include_once('LanguageCart.php'); ?>
<div class="sidebars hide-scroll">
  <div class="sidebar right">
	<div class="top-column">
	  <a href="#" class="btn btn-danger" data-action="close" data-side="right"><img src="images/close.jpg" alt="close"></a>
	  <div class="container">
		<div class="basket_title"><?php echo $language[$lang]['title'];?> (<span class="count"><?php echo ($_SESSION['umarket_cart']['total']) ? $_SESSION['umarket_cart']['total']['qty']  : 0; ?></span>) </div>
		<div id="product-cart" class="list">
		  <?php if(isset($_SESSION['umarket_cart'])) : ?>
			<?php foreach($_SESSION['umarket_cart']['product'] as $product) : ?>
			  <?php foreach($product['options'] as $option ) : ?>
				<div id="product<?php echo $product['id']; ?>-<?php echo $option['js']; ?>" class="item">
				  <div class="container">
					<img src="<?php echo $folder . $product['image'];?>" alt="<?php echo $product['name'][$lang]; ?>">
					<div class="content">
					  <div class="name"><?php echo $product['name'][$lang]; ?> (<?php echo $product['description'][$lang] ?>)</div>
					  <div class="description">
						<div class="col"><?php echo $product['model']; ?></div>
						<div class="col"><?php echo $option['size']; ?></div>
						<div class="col quantity<?php echo $product['id']; ?>-<?php echo $option['js']; ?>"><?php echo $option['quantity']; ?> <?php echo $language[$lang]['count'];?></div>
					  </div>
					  <div class="price"><?php echo $product['price']; ?></div>
					  <div class="delete">
						<a class="delincart" href="#" data-id="<?php echo $product['id']; ?>" data-size="<?php echo $option['size']; ?>" data-js="<?php echo $option['js']; ?>">
						  <img src="images/trash_icon.png" alt="delete">
						</a>
					  </div>
					</div>
				  </div>
				</div>
			  <?php endforeach; ?>
			<?php endforeach; ?>
		  <?php endif; ?>
		</div>
		<div class="total-cart">
		  <div class="container">
			<div class="sum">
			  <div class="name"><?php echo $language[$lang]['amount'];?></div>
			  <div class="col"><span class="count"><?php echo ($_SESSION['umarket_cart']['total']) ? $_SESSION['umarket_cart']['total']['qty']  : 0; ?></span> <?php echo $language[$lang]['count'];?></div>
			</div>
			<div class="sum">
			  <div class="name"><?php echo $language[$lang]['total'];?></div>
			  <div class="col"><span class="total"><?php echo ($_SESSION['umarket_cart']['total']) ? $_SESSION['umarket_cart']['total']['sum']  : 0; ?></span></div>
			</div>
			<div class="buttons">
				<div id="order-button">
					<a href="umarket_checkout.php"><?php echo $language[$lang]['checkout'];?></a>
				</div>
				<div id="continue-button" class="transparent">
					<a class="btn" href="#"  data-action="close" data-side="right"><?php echo $language[$lang]['continue'];?></a>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>