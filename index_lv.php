<?php session_start(); ?>
<?php require_once("config.php"); ?>
<?php require_once "stat.php"; 
?>
<?php
$uagent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$uagent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($uagent,0,4))) if ( !$_COOKIE["full"]=='ok') {
    ?>
    <script type="text/javascript">
      window.location = "http://www.nboutlet.eu/index-mobile_lv.php";
    </script>
<?php
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Interneta Veikals NB Outlet</title>
    <meta name="description" content="NB Outlet - apģērbu interneta veikals visai ģimenei. Lētas cenas, liela izvēle, piegāde visā Latvijā.">
    <meta name="keywords" content="sieviešu apģērbi internetā,vīriešu apģērbi,bērnu apģērbi,apģērbi internetā,apģērbu veikali internetā,apavi internetā,sieviešu apavi,bērnu apavi,vīriešu apavi,somas interneta veikals">
    <meta name="yandex-verification" content="37c062766ecc2e20" />
    <div style="height:40px; overflow: auto; display: none;">
        <style>
            .texcol {
                color: transparent;
            }
        </style>
        <font class="texcol">
            apģērbu veikali internetā,apavi internetā,sieviešu apģērbi,apģērbu interneta veikals NB Outlet
        </font>
    </div>
    <link rel="preload" as="style" type="text/css" href="css/reset.min.css">
    <link href="css/reset.min.css" rel="stylesheet" type="text/css">
    <link rel="preload" as="style" type="text/css" href="css/main.min.css">
    <link href="css/main.min.css" rel="stylesheet" type="text/css">
    <link rel="preload" as="style" type="text/css" href="css/index.min.css">
    <link href="css/index.min.css" rel="stylesheet" type="text/css">
    <link rel="preload" as="style" type="text/css" href="css/custom.min.css">
    <link href="css/custom.min.css" type="text/css" rel="stylesheet">
    <link rel="preload" as="style" type="text/css" href="css/fonts.min.css">
    <link href="css/fonts.min.css" rel="stylesheet" type="text/css">
    <link href="js/brand-slider/brand-slider.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="/favicon.ico" sizes="32x32">
    <link rel="prefetch" href="js/jquery-1.12.0.min.js" as="script">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="fonts/circe-light.cufonfonts.min.js"></script>
    <script type="text/javascript" src="fonts/circe.cufonfonts.min.js"></script>
    <script type="text/javascript" src="fonts/circe-bold.cufonfonts.min.js"></script>
    <!--CART-->
    <link href="css/custom.min.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    <!--[if lte IE 10]>
	<script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script>
<![endif]-->

    <!--Cufon-->
    <script>
        Cufon.replace('#about .text, #map .info-block', {
            fontFamily: 'Circe Light'
        });
        Cufon.replace('#header p, #top-header .phone strong, #top-header .phone small', {
            fontFamily: 'Circe Regular',
            hover: true
        })
        Cufon.replace('#header strong, h1, .button1, .subscribe button , .subscribe-text', {
            fontFamily: 'Circe Bold',
            hover: true
        });
    </script>

    <!--Слайдер-->
    <script type="text/javascript" src="js/brand-slider/jquery.cycle.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#slideshowCont").css("overflow", "hidden");
            $("#last").css("display", "block");
            $("#next").css("display", "block");
            $('#slideShow ul').cycle({

                pause: 1,
                next: '#next',
                prev: '#last',
                timeout: 0
            });
        });
    </script>
</head>

<body>

    <div id="wrapper">
        <div id="bg_layer"></div>
        <!--Шапка-->
        <?php include("blocks/header_lv.php"); ?>

        <div id="header">
            <p><strong>Zīmolu preces mazumtirdzniecībā</strong><br>
                zemas cenas, piegāde visā pasaulē</p>
            <div id="ellipse"><img src="images/ellipse.png" alt="ellipse"></div>
        </div>

        <!--Каталог-->
        <div id="catalog">
            <h1>Preču Katalogs</h1>
            <div class="flex-container">
                <ul>
                    <li><a href="catalog_lv.php?catid=1">
                            <div class="mask">
                                <div class="button1">Sieviešu Apģērbi</div>
                            </div>
                        </a></li>
                    <li><a href="catalog_lv.php?catid=2">
                            <div class="mask">
                                <div class="button1">Vīriešu Apģērbi</div>
                            </div>
                        </a></li>
                    <li><a href="catalog_lv.php?subid=25">
                            <div class="mask">
                                <div class="button1">Bērnu Apģērbi</div>
                            </div>
                        </a></a></li>
                    <li><a href="catalog_lv.php?catid=4">
                            <div class="mask">
                                <div class="button1">Apavi</div>
                            </div>
                        </a></li>
                        <li><a href="catalog_lv.php?catid=5">
                            <div class="mask">
                                <div class="button1">Aksesuāri</div>
                            </div>
                        </a></li>
                    <li><a href="catalog_lv.php?catid=6">
                            <div class="mask">
                                <div class="button1">Citas Preces</div>
                            </div>
                        </a></li>
                    <li><a href="pdf/NB Outlet Small Wholesale (LV).pdf" target="new">
                        <div style="opacity: 1;" class="mask">
                            <div class="button1">Vairumtirdzniecībā</div>
                        </div>
                    </a></li>
                </ul>
            </div>
            <!-- <div class="catalog-bottom">
                <a href="catalog_lv.php?catid=1">
                    <div class="button1">Pāriet uz Katalogu</div>
                </a>
            </div> -->
        </div>

        <!--О Нас-->
        <div id="about">
            <div class="block-bg"></div>
            <div class="container">
                <h1>NB Outlet</h1>
                <div class="text">
                    NB Outlet ir mūsdienīgs interneta veikals, kurš nodarbojas ar dažādu preču mazumtirdzniecību un vairumtirdzniecību nelielos apjomos.
                    Mūsu piedāvājums sastāv no apģērbiem, aksesuāriem, kā arī elektronikas un citām precēm. Mūsu cenas vienmēr ir konkurētspējīgas un ar
                    atlaidi līdz 80% no cenas, kura norādīta uz preces birkas. Mūsu galvenā priekšrocība ir preču klāsts, kurš pastāvīgi atjaunojas, visas preces var
                    apskatīt klātienē un iegādāties uz vietas, piegāde notiek visā Baltijā, arī Eiropā un NVS valstīs. Preču apmaksa iespējama caur PayPal, var apmaksāt
                    caur rēķinu vai uz vietas veikalā. Pastāvīgiem klientiem mēs vienmēr piedāvājam atlaides.
                    <div class="small-container">
                        <div class="separate"></div>
                        Patīkamus pirkumus!<br>
                        Ar vislabākajiem novēlējumiem - NB Outlet.<br>
                        Klientu apkalpošana +37126858674
                    </div>
                </div>
            </div>
        </div>

        <!--Бренды-->
        <div id="brands">
            <div class="container">
                <div id="slideshowCont">
                    <img src="js/brand-slider/up_arrow_icon_left.png" alt="next" id="next" />
                    <div id="slideShow">
                        <ul>
                            <li><img src="images/brands.jpg" alt="brands" /></li>
                            <li><img src="images/brands.jpg" alt="brands" /></li>
                        </ul>
                    </div>
                    <img src="js/brand-slider/up_arrow_icon_right.png" alt="last" id="last" />
                </div>
            </div>
        </div>

        <!--Карта-->
        <div id="map">
            <div class="block-bg"></div>
            <div id="layer">
                <div class="container">
                    <div class="info-block">
                        <div class="adress">
                            Interneta Veikals "NB Outlet"<br>
                            Slokas Iela 52 (LV-1007) '<br>
                            Riga, Latvija
                            <div class="contact">
                                <ul>
                                    <li><img src="images/icon1.png" alt="icon-phone">Talr: +(371) 26858674 (WhatsApp)</li>
                                    <p>
                                        <li><img src="images/icon2.png" alt="icon-phone" style=" margin-top: 2px;">E-mail : <a href="mailto:info@nboutlet.eu">info@nboutlet.eu</a></li>
                                        <li><img src="images/icon3.png" alt="icon-phone" style="margin-top: -1px;">Web : <a href="http://www.nboutlet.eu/">www.nboutlet.eu</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
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
        <!-- Интеграция корзины Коморин Роман  https://freelance.ru/Ktulchu -->
</body>

</html>