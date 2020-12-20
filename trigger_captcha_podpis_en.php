<?php

session_start();

if(empty($_SESSION['captcha_podpis_footer_en']) || ($_SESSION['captcha_podpis_footer_en'] != true)) {    //если капча не введена то делаем ее введеннной


$_SESSION['captcha_podpis_footer_en'] = true;


        echo "<script>document.getElementById('no_captcha_podpis_en').style.display='none'; document.getElementById('yes_captcha_podpis_en').style.display='block';</script>";

}
else{         //а если капча уже введена, то делаем ее невведеннной
	
	unset($_SESSION['captcha_podpis_footer_en']);
	
	        echo "<script>document.getElementById('no_captcha_podpis_en').style.display='block'; document.getElementById('yes_captcha_podpis_en').style.display='none';</script>";
	
}

?>