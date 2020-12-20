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
    $ru = '/index-mobile.php';
    $eng= '/index-mobile_en.php';
}
else
{
    $ru = $link_ru;
    $eng = $link_en;
}
if($_SERVER['REQUEST_URI'] == '/checkout-mobile.php')
{
    $cl = 'class="sl"';
}

?>

<!--Vietnes galvene-->
<header class="header">
    <div class="container">
        <nav class="navigation">
            <div class="navigation__menu" id="btnMenu">
                <img class="burger" src="/mobile/img/header/icon_menu_burger.png" alt="Burger"/>
                <img class="exit" src="/mobile/img/icon/exit.svg" alt="exit"/>
                <div class="menu-list" id="menu">
                    <ul>
                        <li><a href="catalog-mobile_lv.php?catid=1">Sieviešu Apģērbi</a></li>
                        <li><a href="catalog-mobile_lv.php?catid=2">Vīriešu Apģērbi</a></li>
                        <li><a href="catalog-mobile_lv.php?catid=3">Bērnu Apģērbi</a></li>
                        <li><a href="catalog-mobile_lv.php?catid=4">Apavi</a></li>
						<li><a href="catalog-mobile.php?catid=5">Aksesuāri</a></li>
						<li><a href="catalog-mobile_lv.php?catid=6">Citas Preces</a></li>
                        <li><a  pdf/NB Outlet Small Wholesale (RUS).pdf target="new">Vairumtirdzniecībā</a></li>
                        <li><a href="catalog-mobile_lv.php?catid=2&status=3">Akcijas Preces %</a></li>
                    </ul>
                    <div class="menu-footer">
                        <a class="adress" href="https://goo.gl/maps/65MPspUN5kwAAVAL7" target="blank">Slokas Iela 52 (LV-1007) Riga, Latvija</a>
                        <a class="phone" href="tel:+(371) 26885058">+(371) 26858674</a>
                    </div>
                </div>
            </div>
            <div class="navigation__logo"><a href="index-mobile_lv.php"><img src="/mobile/img/header/logo.png" alt="Logo"/></a></div>
            <div class="navigation__block">
                <div class="block-search">
                    <form action="../search-mobile_lv.php" name="search" method="GET">
                        <input type="text" name="q" value="<?php //echo $search_text; ?>" placeholder="Atrodiet produktus"/>
                        <button class="btn-search" type="button"></button>
                    </form>
                    <!--            <img src="/mobile/img/header/icon_finder.png" alt="Search"/> -->
                </div>
                <div class="block-lang">
                    <div class="dropdown">
                        <div class="dropbtn"><img src="/mobile/img/header/lang_lt.png" alt="LV"/></div>
                        <div class="dropdown-content">
                            <a <?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);' : $eng; ?>"
                                                 data-id="en" data-href="<?php echo $ru; ?>">
								<img src="/mobile/img/header/lang_eng.png" alt="ENG"/></a>
                            <a<?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);' : $ru; ?>"
                                                  data-id="ru" data-href="<?php echo $eng; ?>">
								<img src="/mobile/img/header/lang_rus.png" alt="RU"/></a>
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