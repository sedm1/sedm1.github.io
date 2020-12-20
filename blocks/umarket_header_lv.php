<?php

if(!empty($_GET['q'])){
	$search_text = $_GET['q'];
}else{
	$search_text = '';
}

if(!$_SESSION['language'] || $_SESSION['language'] != 'lv') 
	$_SESSION['language'] = 'lv';

$lang = 'lv';

// Обрабатывает сначала \r\n для избежания их повторной замены.
$link_ru = str_replace("_lv", '', $_SERVER['REQUEST_URI']);
$link_en = str_replace("_lv", '_en', $_SERVER['REQUEST_URI']);
if ($link_ru==$_SERVER['REQUEST_URI'] || $link_en==$_SERVER['REQUEST_URI'])
{
    $ru = '/umarket';
    $eng= '/umarket_en.php';
}
    else 
    {
    $ru = $link_ru;
        $eng = $link_en;
    }
if($_SERVER['REQUEST_URI'] == '/umarket')
{
	$cl = 'class="sl"';
}
?>

<div id="top-header">
    <div class="container">
    <div id="logo"><a href="umarket_lv"><img src="/images/umarket-logo.png" id="nboutlet" alt="umarket"></a>
		</div> 
        <div class="lang-bar">
			<a <?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);': $ru;?>" data-id="ru" data-href="<?php echo $ru; ?>"><img src="images/rus.png" alt="Russian" style="opacity:.40"></a>
			<img src="images/lv_l.png" >
			<!-- <a <?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);': $eng;?>" data-id="en" data-href="<?php echo $eng; ?>"><img src="images/eng.png" alt="ENG" style="opacity:.40"></a> -->
		</div>	
		<div class="phone">
				<p>+(371) 26858674</p>
			</div>
			<div class="h-cart">
			  <a href="javascript:void(0)"><img src="/images/umarket_cart.png" alt="Корзина"/></a>
			  <span class="round"><span class="count"><?php echo ($_SESSION['umarket_cart']['total']) ? $_SESSION['umarket_cart']['total']['qty']  : 0; ?></span></span>
			</div>
		<div class="search-block">
			<form action="umarket_search_lv.php" name="search" method="GET">
				<input type="text" name="q" value="<?php //echo $search_text; ?>" />
				<button class="btn-search" type="button"></button>
			</form>
		</div>
		<div class="info-bar">
            
			<!-- <div class="phone">
				<img src="/images/phone_info.png" alt="phone-info">
			</div> -->
            <div class="social">
                <!-- <a href="#"><img src="/images/vk.png" width="29" height="27" alt="vk"></a> -->
                <!-- <a href="#"><img src="/images/twitter.png" width="29" height="27" alt="twitter"></a> -->
                <a href="https://www.facebook.com/nboutletshop/" target="_blank"><img src="/images/facebook.png" width="29" height="27" alt="facebook"></a>
                <a href="https://www.instagram.com/nboutletshop/" target="_blank"><img src="/images/instagram.png" width="29" height="27" alt="instagram"></a>
			</div>
			

			<!-- <div class="search-block">
				<form action="search.php" name="search" method="GET">
					<input type="text" name="q" value="<?php //echo $search_text; ?>" placeholder="Найти товары"/>
					<button class="btn-search" type="button"></button>
				</form>
			</div> -->
        </div>
    </div>
</div>

 <!-- <script type="text/javascript">
$(function(){
	$('.btn-search').on('click', function(){
		$(this).siblings('input[name="q"]').slideToggle().focus();
		return false;
	})
})
</script>  -->