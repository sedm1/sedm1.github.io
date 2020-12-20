<div id="footer">
  <div class="container">
        <div class="block-link">
            <div class="left-column">
                <div class="title">Katalogs</div>
               <ul>
                   <li><a href="umarket.php">Visi</a></li>

                   <?php
					require_once("config.php"); //Подключение к бд
					
					//Вывод категорий
					$category = mysql_query("SELECT * FROM `category` WHERE id  BETWEEN 7 AND 12 ");
					while ($cat = mysql_fetch_array($category)) {
					?>
					<li><?php if(isset($cat['id']) && $cat['id'] == 3){?>
						<a href="umarket_lv.php?subid=25"><?=$cat['category_lv'] ?></a>
						<?php }else{?>
						<a href="umarket_lv.php?catid=<?=$cat['id'] ?>" <?php if ($cat['id'] == $item['cat_id']) { echo 'id="active"'; } ?>><?=substr($cat['category_lv'],0,-9)?></a>
						<?php }?></li>
					<?php
					}
					?>
                </ul>
                <!-- <ul>
          <li><a href="<?/*php echo "?catid=1"?>" <?php if ($catid == 1) {
                                    echo 'id="active-first"';
                                  } */?>>Apģērbi</a></li>
          <li><a href="<?/*php echo "?subid=27"?>" <?php if ($subid == 27) {
                                    echo 'id="active-first"';
                                  } */?>>Apavi</a></li>
          <li><a href="<?/*php echo "?catid=5"?>" <?php if ($catid == 5) {
                                    echo 'id="active-first"';
                                  } */?>>Aksesuāri</a></li>
          <li><a href="<?/*php echo "?subid=33"?>" <?php if ($subid == 33) {
                                    echo 'id="active-first"';
                                  } */?>>Elektropreces</a></li>
          <li><a href="<?/*php echo "?catid=6"?>" <?php if ($catid == 6) {
                                    echo 'id="active-first"';
                                  } */?>>Citas Preces</a></li>
        </ul> -->
            </div>
            <div class="right-column">
                <div class="title">Informācija</div>
                    <ul>
                        <li><a href="pdf/How To Find US (NB Outlet) RUS.pdf" target="new">Kā mums atrast</a></li>
                        <li><a href="pdf/Payment and Delivery (NB Outlet).pdf" target="new">Apmaksa un Piegāde</a></li>
                    </ul>
            </div>
            <div class="flex-right">
                <div class="title">Kontakti</div>
                <div class="contact"> 
                    <span><img src="images/umarket_whatsapp.svg" alt="whatsapp"/></span>
                    <span><img src="images/umarket_viber.svg" alt="viber"/></span>
                    <a class="phone" href="tel:+(371) 26885058">+(371) 26858674</a>
                </div>
                <p class="email"><span>
                    <img src="images/umarket_email.svg" alt="email"/></span>
                    <a href="mailto:info@nboutlet.eu">info@nboutlet.eu</a>
                </p>
          </div>
          <div class="logo">
              <a href="index.php">
                  <img src="images/umarket_logo_footer.png" width="100" height="15" alt="umarket">
                </a>
         </div>
        </div>
        <div class="block-info" >
            <div class="copyright">@ UMARKET 2019 <p>Visas tiesibas aizsargatas</p></div>
			
			<div class="subscribe" id="subs">
				<div class="subscribe-text">Pierakstisanas jaunumiem</div>
				<form id="subs-form" action="http://<?php echo $_SERVER['HTTP_HOST'] . '/umarket_send_email_lv.php';?>" method="POST">
					<input style="float: left;" onFocus="if (this.value == 'Jusu e-pasta adrese') this.value = '';" onBlur="if (this.value == '') this.value = 'Jusu e-pasta adrese';" type="text" name="email" value="Jusu e-pasta adrese" />
					<div style="background: #f9f9f9;color: #000;/* width: 130px; */float: left;margin-left: 10px;height: 33px;padding-top: 9px;/* margin-left: 5px; */">
					<img id="yes_captcha_podpis" src="images/yes_captcha.png" width="20px" height="20px" style="float: left; display: none; margin-left: 5px; cursor: pointer;">
					<div id="no_captcha_podpis" style="float: left;width: 20px;height: 20px;/* margin: 1.5px; */border: 2px solid #c1c1c1;cursor: pointer;background: #fff;margin-left: 5px; border-radius: 4px;"></div>
					<span style="margin-left: 10px; margin-right: 5px; font-size: 14px; line-height:23px;">I'm not a robot</span>
					</div>
					<button id="subs-button" type="submit"> Pierakstities</button>
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