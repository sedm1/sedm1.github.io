<?php

if (!empty($_GET['q'])) {
    $search_text = $_GET['q'];
} else {
    $search_text = '';
}

if (!$_SESSION['language'] || $_SESSION['language'] != 'ru')
    $_SESSION['language'] = 'ru';

$lang = 'ru';

// Обрабатывает сначала \r\n для избежания их повторной замены.
$link_lv = str_replace(".", '_lv.', $_SERVER['REQUEST_URI']);
$link_en = str_replace(".", '_en.', $_SERVER['REQUEST_URI']);

if ($link_lv == $_SERVER['REQUEST_URI'] || $link_en == $_SERVER['REQUEST_URI']) {
    $lv = '../index-mobile_lv.php';
    $eng = '../index-mobile_en.php';
} else {
    $lv = $link_lv;
    $eng = $link_en;
}
if ($_SERVER['REQUEST_URI'] == '/checkout-mobile.php') {
    $cl = 'class="sl"';
}
?>

<!--Шапка-->
<header class="header">
    <div class="container">
        <nav class="navigation">
            <div class="navigation__menu" id="btnMenu">
                <img class="burger" src="/mobile/img/header/icon_menu_burger.png" alt="Burger"/>
                <img class="exit" src="/mobile/img/icon/exit.svg" alt="exit"/>
                <div class="menu-list" id="menu">
                    <ul>
                        <li><a href="catalog-mobile.php?catid=1">Женская одежда</a></li>
                        <li><a href="catalog-mobile.php?catid=2">Mужская одежда</a></li>
                        <li><a href="catalog-mobile.php?catid=3">Детская одежда</a></li>
                        <li><a href="catalog-mobile.php?catid=4">Обувь</a></li>
                        <li><a href="catalog-mobile.php?catid=5">Акссесуары</a></li>
                        <li><a href="catalog-mobile.php?catid=6">Другие товары</a></li>
                        <li><a href="pdf/NB Outlet Small Wholesale (RUS).pdf" target="new">Малый опт</a></li>
                        <li><a href="catalog-mobile.php?catid=2&status=3">Скидки %</a></li>
                    </ul>
                    <div class="menu-footer">
                        <a class="adress" href="https://goo.gl/maps/65MPspUN5kwAAVAL7" target="blank">ул. Слокас 52 (LV-1007) Рига, Латвия</a>
                        <a class="phone" href="tel:+(371) 26885058">+(371) 26858674</a>
                    </div>
                </div>
            </div>
            <div class="navigation__logo"><a href="index-mobile.php">
					<img src="/mobile/img/header/logo.png" alt="Logo"/></a></div>
            <div class="navigation__block">
                <div class="block-search">
                    <form action="../search-mobile.php" name="search" method="GET" id="search-form">
                        <input type="text" name="q" value="<?/*php echo $search_text; */?>" placeholder="Найти товары"/>
                        <button class="btn-search" type="button"></button>
                    </form>
                    <!--            <img src="/mobile/img/header/icon_finder.png" alt="Search"/> -->
                </div>
                <div class="block-lang">
                    <div class="dropdown">
                        <div class="dropbtn"><img src="/mobile/img/header/lang_rus.png" alt="RU"/></div>
                        <div class="dropdown-content">
                            <a <?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);' : $lv; ?>"
                                                 data-id="lv" data-href="<?php echo $eng; ?>">
								<img src="/mobile/img/header/lang_lt.png" alt="LV"/></a>
                            <a<?php echo $cl ?> href="<?php echo (isset($cl)) ? 'javascript:void(0);' : $eng; ?>"
                                                data-id="en" data-href="<?php echo $lv; ?>">
								<img src="/mobile/img/header/lang_eng.png" alt="ENG"/></a>
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
