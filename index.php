<?php

require_once 'init.php';
require_once 'stat.php';

$uagent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$uagent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($uagent,0,4)))
{
  if( !$_COOKIE["full"] == 'ok')
    echo '<script>window.location = `http://www.nboutlet.eu/index-mobile.php`;</script>';
}

$page_title = 'Salemarket';

include_once 'blocks/html.header.php';

$count_prod_all = mysql_fetch_row( mysql_query("SELECT count(`id`) FROM `catalog` WHERE status<>2") );
$count_prod_buy = mysql_fetch_row( mysql_query("SELECT count(`id`) FROM `catalog` WHERE status=2") );

$rate_data = sql_fetch_query( "SELECT COUNT(`id`) AS count_review, SUM(`rate`) AS sum_rate FROM `reviews`" );
$rate_average = $rate_data['sum_rate'] / $rate_data['count_review'];

// Фото клиентов
$reviews = '';
$review_res = sql_result("SELECT c.name, c.description, c.text, c.article, r.id AS review_id, r.prod_id FROM `catalog` c,`reviews` r WHERE r.images<>0 AND c.id=r.prod_id ORDER BY r.id DESC LIMIT 0, 4" );
while( $review = sql_fetch_result( $review_res ) )
{
  $image = sql_fetch_query( "SELECT * FROM `reviews_images` WHERE review_id=".$review['review_id']." LIMIT 1" );
  $reviews .= '
            <div class="swiper-slide">
              <div class="clothes-box">
                <a href="/view.php?item='.$review['prod_id'].'">
                  <div class="clothes-img"><img src="/usersfiles/'.$image['file_name'].'" alt=""></div>
                  <div class="clothes-info">
                    <h4 class="clothes-heading">'.$review['name'].'</h4>
                    <div class="clothes-text">'.$review['description'].', '.$review['article'].'</div>
                  </div>
                </a>
              </div>
            </div>';
}
?>
<section class="hero">
  <div class="container">
    <div class="card-wrap">
      <div class="card">
        <a href="/catalog.php" style="display: block;position: relative;">
        <h1 class="main-heading--red">Все товары</h1>
        <img class="card-img" src="img/All things.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php" style="display: block;position: relative;">
        <h1 class="main-heading--red">Одежда</h1>
        <img class="card-img" src="img/clothes.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php?catid=4" style="display: block;position: relative;">
        <h1 class="main-heading--red">Обувь</h1>
        <img class="card-img" src="img/sneakers.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php?catid=5" style="display: block;position: relative;">
        <h1 class="main-heading--red">Аксессуары</h1>
        <img class="card-img" src="img/accessories.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php" style="display: block;position: relative;">
        <h1 class="main-heading--red">Электроника</h1>
        <img class="card-img" src="img/elec.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php?catid=6" style="display: block;position: relative;">
        <h1 class="main-heading--red">Другие товары</h1>
        <img class="card-img" src="img/others.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php" style="display: block;position: relative;">
        <h1 class="main-heading--red">Новинки</h1>
        <img  class="card-img" src="img/news.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
      <div class="card">
        <a href="/catalog.php" style="display: block;position: relative;">
        <h1 class="main-heading--red">Скидки</h1>
        <img class="card-img" src="img/sales.jpg" alt="">
        <div class="view">
          <span class="button-all btn-text">Смотреть все</span>
        </div>
        </a>
      </div>
      <!-- /card -->
    </div>
    <!-- /card-wrap -->
  </div>
  <!-- /container -->
</section>
<!-- /hero -->
<section class="about">
  <div class="container">
    <div class="about-head">
      <h1 class="regular-heading">О нас в цифрах</h1>
    </div>
    <!-- /about-head -->
    <div class="about-wrap">
      <div class="about-box">
        <img class="about-logo" src="img/box-close.svg" alt="box-close logo">
        <div class="about-info">
          <h3 class="about-heading--red"><?=number_format( $count_prod_all[0], 0, '', ' ' );?></h3>
          <div class="about-text">Товаров на сайте</div>
        </div>
        <!-- /about-info -->
      </div>
      <!-- /about-box -->
      <div class="about-box">
        <img class="about-logo" src="img/box-open.svg" alt="box-open logo">
        <div class="about-info">
          <h3 class="about-heading--red"><?=number_format( $count_prod_buy[0], 0, '', ' ' );?></h3>
          <div class="about-text">Проданных товаров</div>
        </div>
        <!-- /about-info -->
      </div>
      <!-- /about-box -->
      <div class="about-box">
        <img class="about-logo" src="img/star.svg" alt="star logo">
        <div class="about-info">
          <h3 class="about-heading--red"><?= number_format( $rate_average, 1 ); ?></h3>
          <div class="about-text">Средняя оценка</div>
        </div>
        <!-- /about-info -->
      </div>
      <!-- /about-box -->
    </div>
    <!-- /about-wrap -->
  </div>
  <!-- /container -->
</section>
<!-- /about -->
<section class="clothes">
  <div class="container">
    <div class="reg-head">
      <h1 class="regular-heading">Купленные у нас товары</h1>
    </div>
    <!-- /reg-head -->
    <div class="photos">Фото клиентов</div>
    <div>
      <div class="clothes-wrap">
        <!-- Slider main container -->
        <!-- If we need navigation buttons -->
        <img class="swiper-button-prev" src="img/prev.svg" alt="">
        <img class="swiper-button-next" src="img/next.svg" alt="">
        <div class="swiper-container clothes-slider">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <?= $reviews; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /clothes-wrap -->

  </div>
  <!-- /container -->
</section>
<!-- /clothes -->
<section class="partners">
  <div class="container">
    <div class="part-head">
      <h1 class="regular-heading">Сайты наших партнеров</h1>
    </div>
    <!-- /part-head -->
    <div class="partners-wrap">
      <div class="partners-box--long">
        <a class="link-block long-info" href="http://nboutlet.eu/">
          <div class="long-text">Ispace - IT решения для вашего бизнеса <br>Разработка веб-сайтов <br>Веб-дизайн <br>Программирование</div>
          <p class="button-all btn-text" id="btnLeft">Перейти</p>
        </a>
      </div>
      <!-- /partners-box-long -->
      <div class="partners-box--short">
        <a class="link-block short-info" href="http://bpauto.lv/">
          <div class="short-text">Продажа Автозапчастей <br>Ремонт авто <br> Подбор и проверка </div>
          <p class="button-all btn-text btn-left">Перейти</p>
        </a>
      </div>
      <!-- /partners-box-short -->
    </div>
    <!-- /partners-wrap -->
  </div>
  <!-- /container -->
</section>
<!-- /partners -->
<section class="delivery">
  <div class="container">
    <div class="del-head">
      <h1 class="regular-heading">Доставка</h1>
    </div>
    <!-- /deal-head -->
    <div class="delivery-wrap">
      <img class="omniva" src="img/omniva.jpg" alt="">
      <img class="work-img" src="img/work-are.jpg" alt="">
    </div>
    <!-- /delivery-wrap -->
  </div>
  <!-- /container -->
</section>
<!-- /delivery" -->
<section class="pay">
  <div class="container">
    <div class="pay-head">
      <h1 class="regular-heading">Cпособы оплаты</h1>
    </div>
    <!-- /pay-head -->
    <div class="pay-wrap">
      <img class="pay-img" src="img/master.png" alt="">
      <img class="pay-img" src="img/visa.png" alt="">
      <img class="pay-img" src="img/swed.png" alt="">
      <img class="pay-img" src="img/money.png" alt="">
    </div>
    <!-- /pay-wrap -->
  </div>
  <!-- /container -->
</section>
<!-- /pay -->
<?php
include_once 'blocks/html.footer.php';
?>