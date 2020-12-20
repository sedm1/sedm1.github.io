<div id="clear"></div></div>
<div id="footer">
  <div class="container">
        <div class="block-link">
            <div class="left-column">
                <div class="title">Каталог</div>
                <ul>
                	<?php
					require_once("config.php"); //Подключение к бд
					
					//Вывод категорий
					$category = mysql_query("SELECT * FROM `category` WHERE id NOT IN (7,8,9,10,11,12)");
					while ($cat = mysql_fetch_array($category)) {
					?>
					<li><?php if(isset($cat['id']) && $cat['id'] == 3){?>
						<a href="catalog.php?subid=25"><?=$cat['category'] ?></a>
						<?php }else{?>
						<a href="catalog.php?catid=<?=$cat['id'] ?>" <?php if ($cat['id'] == $item['cat_id']) { echo 'id="active"'; } ?>><?=$cat['category'] ?></a>
						<?php }?></li>
					<?php
					}
					?>
                </ul>
            </div>
            <div class="right-column">
                <div>Информация</div>
                    <ul>
                        <li><a href="pdf/How To Find US (NB Outlet) RUS.pdf" target="new">Как нас найти</a></li>
                        <li><a href="pdf/Payment and delivery RUS.pdf" target="new">Оплата и Доставка</a></li>
                    </ul>
            </div>
        </div>
        <div class="block-info" style="width: 620px;">
            <div class="logo"><a href="index.php"><img src="images/nboutlet1_logo.png" width="66" height="11" alt="nboutlet"></a></div>
			<div class="left-column" style="margin-left: 120px;">
                 <div class="contact">
                    <ul>
                        <li><img src="images/icon1.png" alt="icon-phone">Тел.: +371 26858674 (WhatsApp)</li>
                    </ul>
                </div>
            </div>
            <div class="right-column" style="margin-left: 389px;">
                <div class="contact">
                    <ul>
                        <li><img src="images/icon2.png" alt="icon-phone" style=" margin-top: 4px;">E-mail : <a href="mailto:info@nboutlet.eu">info@nboutlet.eu</a></li>
                        <li><img src="images/icon3.png" alt="icon-phone" style="margin-top: 0px;">Web : <a href="http://www.nboutlet.eu/" target="new">www.nboutlet.eu</a></li>
                    </ul>
					
                </div>
            </div>
			<div style="clear:both;"></div>
			
			<div class="subscribe" id="subs">
				<div class="subscribe-text">ПОДПИСАТЬСЯ НА РАССЫЛКУ</div>
				<form id="subs-form" action="http://<?php echo $_SERVER['HTTP_HOST'] . '/send_email.php';?>" method="POST">
					<input style="float: left;" onFocus="if (this.value == 'Ваш E-mail') this.value = '';" onBlur="if (this.value == '') this.value = 'Ваш E-mail';" type="text" name="email" value="Ваш E-mail" />
					<div style="background: #f9f9f9;color: #000;/* width: 130px; */float: left;margin-left: 10px;height: 30px;padding-top: 6px;/* margin-left: 5px; */">
					<img id="yes_captcha_podpis" src="images/yes_captcha.png" width="20px" height="20px" style="float: left; display: none; margin-left: 5px; cursor: pointer;">
					<div id="no_captcha_podpis" style="float: left;width: 20px;height: 20px;/* margin: 1.5px; */border: 2px solid #c1c1c1;cursor: pointer;background: #fff;margin-left: 5px; border-radius: 4px;"></div>
					<span style="margin-left: 10px; margin-right: 5px; /* font-size: 14px; */">I'm not a robot</span>
					</div>
					<button id="subs-button" type="submit"> ПОДПИСАТЬСЯ</button>
					<br />
					<div class="response"></div>
					<div id="content_get_trigger_captcha_podpis"></div>
				</form>
			</div>
        </div>
		<script defer type="text/javascript">
$('#no_captcha_podpis').click(function () {
	    $.ajax({
      url: "trigger_captcha_podpis.php",

        /**********GET_DATA**************/
    success: function(html){  
$("#content_get_trigger_captcha_podpis").html(html);  }
    
    });
// тут код выполняющийся при клике
});
</script>
		<script defer type="text/javascript">
$('#yes_captcha_podpis').click(function () {
	    $.ajax({
      url: "trigger_captcha_podpis.php",

        /**********GET_DATA**************/
    success: function(html){  
$("#content_get_trigger_captcha_podpis").html(html);  }
    
    });
// тут код выполняющийся при клике
});
</script>
<script defer type="text/javascript">
$(document).ready(function(){
	  $.ajax({
      url: "null_trigger_captcha_podpis.php"
    });
	});
</script>
<script defer type="text/javascript">
$('#subs-form').on('submit', function(){
	$('.response').empty();
	var element = $(this);
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
					$('.response').html(result);
					$('#subs-button').prop('disabled', false);
                } else {
                    alert('error');
                    return(false);
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
		
		
		
        <div class="copyright"><img src="images/copyright.png" width="15" height="15" alt="copyright"> NB OUTLET 2016 Все права защищены</div>
    </div>
</div>
<!-- Yandex.Metrika counter --> 
<script async type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter47106687 = new Ya.Metrika({ id:47106687, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47106687" style="position:absolute; left:-9999px;" alt="" /></div></noscript> 
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script defer src="https://www.googletagmanager.com/gtag/js?id=UA-111457407-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111457407-1');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->


<!-- http://rm-make.ru -->