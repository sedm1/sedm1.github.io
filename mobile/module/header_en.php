<?php

if(!empty($_GET['q'])){
    $search_text = $_GET['q'];
}else{
    $search_text = '';
}

if(!$_SESSION['language'] || $_SESSION['language'] != 'en')
    $_SESSION['language'] = 'en';

$lang = 'en';

// Обрабатывает сначала \r\n для избежания их повторной замены.
$link_ru = str_replace("_en", '', $_SERVER['REQUEST_URI']);
$link_lv = str_replace("_en", '_lv', $_SERVER['REQUEST_URI']);
if ($link_ru==$_SERVER['REQUEST_URI'] || $link_en==$_SERVER['REQUEST_URI'])
{
    $ru = '/index-mobile.php';
    $lv= '/index-mobile_lv.php';
}else{
    $ru = $link_ru;
    $lv = $link_lv;
}
if($_SERVER['REQUEST_URI'] == '/checkout-mobile.php')
{
    $cl = 'class="sl"';
}
?>

<!--HEADER-->
<header class="header">
    <div class="container">
        <nav class="navigation">
            <div class="navigation__menu" id="btnMenu">
                <img class="burger" src="/mobile/img/header/icon_menu_burger.png" alt="Burger"/>
                <img class="exit" src="/mobile/img/icon/exit.svg" alt="exit"/>
                <div class="menu-list" id="menu">
                    <ul>
                        <li><a href="catalog-mobile_en.php?catid=1">Women Clothes</a></li>
                        <li><a href="catalog-mobile_en.php?catid=2">Men Clothes</a></li>
                        <li><a href="catalog-mobile_en.php?catid=3">Children Clothes</a></li>
                        <li><a href="catalog-mobile_en.php?catid=4">Shoes</a></li>
						<li><a href="catalog-mobile.php?catid=5">Accessories</a></li>
						<li><a href="catalog-mobile_en.php?catid=6">Other Goods</a></li>
                        <li><a pdf/NB Outlet Small Wholesale (RUS).pdf target="new">Small wholesale</a></li>
                        <li><a href="catalog-mobile_en.php?catid=2&status=3">Discount %</a></li>
                    </ul>
                    <div class="menu-footer">
                        <a class="adress" href="https://goo.gl/maps/65MPspUN5kwAAVAL7" target="blank">Slokas  52 (LV-1007) Riga, Latvia</a>
                        <a class="phone" href="tel:+(371) 26885058">+(371) 26858674</a>
                    </div>
                </div>
            </div>
            <div class="navigation__logo"><a href="index-mobile_en.php"><img src="/mobile/img/header/logo.png" alt="Logo"/></a></div>
            <div class="navigation__block">
                <div class="block-search">
                    <form action="../search-mobile_en.php" name="search" method="GET">
                        <input type="text" name="q" value="<?php //echo $search_text; ?>" placeholder="Find products"/>
                        <button class="btn-search" type="button"></button>
                    </form>
                    <!--            <img src="/mobile/img/header/icon_finder.png" alt="Search"/> -->
                </div>
                <div class="block-lang">
                    <div class="dropdown">
                        <div class="dropbtn"><img src="/mobile/img/header/lang_eng.png" alt="ENG"/></div>
                        <div class="dropdown-content">
                            <a <?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);' : $ru; ?>"
                                                data-id="ru" data-href="<?php echo $ru; ?>">
								<img src="/mobile/img/header/lang_rus.png" alt="RU"/></a>
                            <a<?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);' : $lv; ?>"
                                                data-id="lv" data-href="<?php echo $lv; ?>">
								<img src="/mobile/img/header/lang_lt.png" alt="LV"/></a>
                        </div>
                    </div>
                </div>
                <div class="block-cart h-cart">
                    <a href="javascript:void(0)"><img src="/mobile/img/header/icon_cart.png" alt="Cart"/></a>
                    <span class="count"><?php echo ($_SESSION['cart']['total']) ? $_SESSION['cart']['total']['qty'] : 0; ?></span>
                </div>
            </div>
        </nav>
    </div>
</header>

<script type="text/javascript" async>
    $(function(){
        $('.btn-search').on('click', function(){
            $(this).siblings('input[name="q"]').slideToggle().focus();
            return false;
        })
    })
</script>
