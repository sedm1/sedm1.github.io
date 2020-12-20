<!--Модальное окно-->
<div class="modal modal_view" id="ex1" style="display:none;">
  <form action="mail.php" class="catalog" method="POST">
	<?php if(!empty($item['size'])) : ?>
	  <?php $_size = explode(',',  $item['size']); ?>
	  <input name="product_size" type="hidden" value="<?php echo $_size[0]?>" placeholder="Размер" required>
	<?php endif; ?>
	<div class="row">
<!--	  <input name="mail" type="text" placeholder="--><?php //echo $language[$lang]['email'];?><!--" required  pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>-->
	  <input name="mail" type="text" placeholder="<?php echo $language[$lang]['email'];?>" required/>
	</div>
	<div class="row">
	  <textarea name="message" class="textarea2" placeholder="<?php echo $language[$lang]['comment'];?>" cols="" required pattern="^[a-zA-Z]+$"></textarea>
	</div>
	<div class="row">
	  <div class="col-xs-3">
	    <?php echo $language[$lang]['shiping'];?>
	  </div>
	  <div class="col-xs-9">
	    <select name="shiping" required="required">
		  <option value=""><?php echo $language[$lang]['select'];?></option>
		  <option value="самовывоз"><?php echo $language[$lang]['pickup'];?></option>
		  <option value="Omniva"><?php echo $language[$lang]['omniva'];?></option>
		  <option value="Почта"><?php echo $language[$lang]['postmail'];?></option>
		 </select>
	  </div>
	  <div class="clearfix"></div>
	</div>
	<div class="row">
	  <input name="product" type="hidden" value="<?=$item['name'].' ('.$item['description'].')' ?>">
	  <input name="url" type="hidden" value="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
	  <div class="col-xs-3">
	    <?php echo $language[$lang]['captcha'];?>
	  </div>
	  <div class="col-xs-9">
	    <img class="purpur" src="captcha.php?color=#c79795" style="float:left;"/>
		<input type="text" name="kapcha" class="input" style="width:110px; float:left">
	  </div>
	  <div class="clearfix"></div>
	</div>
	<div class="row text-center">
	  <button type="submit" class="btn btn-primary" name="sale-button"><?php echo $language[$lang]['send'];?></button>
	  <div class="clearfix"></div>
	  <div class='catalog_result'></div>
	</div>
  </form>
</div>