<div class="sidebars hide-scroll">
  <div class="sidebar right">
	<div class="top-column">
	  <a href="#" class="btn btn-danger" data-action="close" data-side="right"><img src="/images/close.jpg" alt="close"></a>
	  <div class="container">
		<div class="basket_title"><?php echo $language[$lang]['title'];?> (<span class="count"><?=( isset( $_SESSION['cart']['total'] ) ? $_SESSION['cart']['total']['qty']  : 0 );?></span>) </div>
		<div id="product-cart" class="list">
		  <?php if(isset($_SESSION['cart'])) : ?>
			<?php foreach($_SESSION['cart']['product'] as $product) : ?>
			  <?php foreach($product['options'] as $option ) : ?>
				<div id="product<?php echo $product['id']; ?>-<?php echo $option['js']; ?>" class="item">
				  <div class="container">
					<img src="../<?php echo $folder . $product['image'];?>" alt="<?php echo $product['name'][$lang]; ?>">
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
						  <img src="/images/trash_icon.png" alt="delete">
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
			  <div class="col"><span class="count"><?= isset( $_SESSION['cart']['total'] ) ? $_SESSION['cart']['total']['qty']  : 0; ?></span> <?php echo $language[$lang]['count'];?></div>
			</div>
			<div class="sum">
			  <div class="name"><?php echo $language[$lang]['total'];?></div>
			  <div class="col"><span class="total"><?= isset( $_SESSION['cart']['total']) ? $_SESSION['cart']['total']['sum']  : 0; ?></span></div>
			</div>
			<div class="buttons buttons__mobile">
				<div id="order-button" class="order-button__mobile">
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'mobile') !== false){;?>
                    <a href="cart-mobile.php"><?php echo $language[$lang]['checkout'];?></a>
                    <?php }else {;?>
                    <a href="checkout.php"><?php echo $language[$lang]['checkout'];?></a>
                    <?php };?>
				</div>
				<div id="continue-button" class="transparent transparent__mobile">
					<a class="btn btn__mobile" href="#"  data-action="close" data-side="right"><?php echo $language[$lang]['continue'];?></a>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>