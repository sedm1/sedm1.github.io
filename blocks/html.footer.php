<footer class="footer">
  <div class="container">
    <div class="footer-wrap">
      <div class="footer-group">
        <h5 class="light-heading">Каталог</h5>
        <a href="#" class="links">Все товары</a>
        <a href="#" class="links">Одежда</a>
        <a href="#" class="links">Обувь</a>
        <a href="#" class="links">Аксессуары</a>
        <a href="#" class="links">Электроника</a>
        <a href="#" class="links">Другие товары</a>
      </div>
      <!-- /footer-group -->
      <div class="footer-group">
        <h5 class="light-heading">Информация</h5>
        <a href="#" class="links">Как нас найти</a>
        <a href="#" class="links">Оплата и Доставка</a>
        <a href="#" class="links">Корзина</a>
      </div>
      <!-- /footer-group -->
      <div class="footer-group">
        <h5 class="light-heading">Контакты</h5>
        <a href="#" class="links">+371 26858674<br>(Whats app)</a>
        <a href="#" class="links">info@nboutlet.eu</a>
        <a href="#" class="links">Slokas 52 (LV-1007) Riga</a>
      </div>
      <!-- /footer-group -->
      <form id="subs-form" class="footer-group form-inputs" action="/send_email.php">
        <h5 class="light-heading">Подписаться на уведомления</h5>
        <input name="email" type="email" class="form form-text" placeholder="Ваш E-mail">

        <div class="form form-text" style="background: #f9f9f9;color: #000;height: 30px;padding-top: 6px;">
          <img id="yes_captcha_podpis" src="images/yes_captcha.png" width="20px" height="20px" style="float: left; display: none; margin-left: 5px; cursor: pointer;">
          <div id="no_captcha_podpis" style="float: left;width: 20px;height: 20px;/* margin: 1.5px; */border: 2px solid #c1c1c1;cursor: pointer;background: #fff;margin-left: 5px; border-radius: 4px;"></div>
          <span style="margin-left: 10px; margin-right: 5px; /* font-size: 14px; */">I'm not a robot</span>
        </div>
        <div id="content_get_trigger_captcha_podpis"></div>
        <button type="submit" class="red-btn">Подписаться</button>
        <div class="response"></div>
      </form>
    </div>
    <!-- /footer-wrap -->
    <!-- /footer-group -->
    <div class="tabs">
      <span class="mark">©Salemarket 2020. Все права защищены</span>
      <div class="footer-imgs">
        <img class="footer-logo" src="img/bl-face.svg" alt="facebook">
        <img class="footer-logo" src="img/bl-inst.svg" alt="instagram">
      </div>
      <!-- /footer-imgs -->
    </div>
    <!-- /tabs -->
  </div>
  <!-- /container -->
</footer>
<script defer>
  $('#no_captcha_podpis').click(function () {
    $.ajax({
      url: "trigger_captcha_podpis.php",
      success: function(html){
        $("#content_get_trigger_captcha_podpis").html(html);  }
    });
  });
  $('#yes_captcha_podpis').click(function () {
    $.ajax({
      url: "trigger_captcha_podpis.php",
      success: function(html){
        $("#content_get_trigger_captcha_podpis").html(html);  }
    });
  });
  $(document).ready(function(){
    $.ajax({
      url: "null_trigger_captcha_podpis.php"
    });
  });
  $('#subs-form').on('submit', function()
  {
    let element = $(this);
    let response = element.find(`.response`);
    response.empty();
    $.ajax({
      type: 'POST',
      url: $(element).attr('action'),
      data: $(element).serialize(),
      dataType: 'html',
      beforeSend:function(result){
        $('#subs-button').prop('disabled', true);
      },
      success: function (result) {
        if (result) {
          response.html(result);
          $('#subs-button').prop('disabled', false);
        } else {
          alert('error');
          return false;
        }
      },
      complite:function(){
        $('#subs-button').prop('disabled', false);
      },
      error:function(result){}
    });
    return false;
  })
</script>

</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script async src="js/jquery.sidebar.min.js"></script>
<script async src="js/mycart.min.js"></script>
<script src="js/main.2011.js"></script>
<?php
if( isset( $page_js ) )
{
  foreach( $page_js as $js )
    echo '<script src="'.$js.'"></script>';
}
include_once 'blocks/rightcart.php';
?>
</body>
</html>