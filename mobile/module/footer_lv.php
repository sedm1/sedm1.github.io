
<!--Pagrabs-->
<footer class="footer">
    <div class="container">
        <div class="footer-flex">
            <div class="flex-left"><a class="adress" href="https://goo.gl/maps/65MPspUN5kwAAVAL7" target="blank">Slokas Iela 52 (LV-1007) Riga, Latvija</a></div>
            <div class="flex-center">
                <div class="social-media"><a href="https://m.facebook.com/login/?locale2=ru_RU" target="blank"><img src="/mobile/img/footer/facebook.svg" alt="facebook"/></a></div>
                <div class="social-media"><a href="https://www.instagram.com/accounts/login/?hl=ru" target="blank"><img src="/mobile/img/footer/instagram.svg" alt="instagram"/></a></div>
            </div>
            <div class="flex-right">
                <div class="contact"> <span><img src="/mobile/img/footer/whatsapp.svg" alt="whatsapp"/></span><span><img src="/mobile/img/footer/viber.svg" alt="viber"/></span><a class="phone" href="tel: +(371) 26858674"> +(371) 26858674</a></div>
                <p class="email"><span> <img src="/mobile/img/footer/email.svg" alt="email"/></span><a href="mailto:info@nboutlet.eu">info@nboutlet.eu</a></p>
            </div>
        </div>
    </div>
</footer>

<?php include_once('blocks/rightcart.php'); ?>
<script async src="js/jquery.sidebar.min.js"></script>
<script async src="/mobile/js/mobile_mycart.js"></script>

<script  src="/mobile/js/jquery.lazy-master/jquery.lazy.min.js"></script>
<script  src="/mobile/js/jquery.lazy-master/jquery.lazy.plugins.min.js"></script>

<script>
    jQuery(document).ready(function ($) {
        $('.lazy').Lazy({
            // your configuration goes here
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onError: function (element) {
                console.log('error loading ' + element.data('src'));
            }
        });
    });
</script>
<!-- [if lt IE 9]>
<script src="libs/html5shiv/es5-shim.min.js"></script>
<script src="libs/html5shiv/html5shiv.min.js"></script>
<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="libs/html5shiv/respond.min.js"></script>
[endif]
-->
<!--Scripts-->
<script type="text/javascript" src="/mobile/js/main.js"></script>