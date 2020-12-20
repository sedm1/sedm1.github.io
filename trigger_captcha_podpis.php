<?php

session_start();

if(empty($_SESSION['captcha_podpis_footer']) || ($_SESSION['captcha_podpis_footer'] != true)) {    //если капча не введена то делаем ее введеннной

$_SESSION['captcha_podpis_footer'] = true;


        echo "<script>document.getElementById('no_captcha_podpis').style.display='none'; document.getElementById('yes_captcha_podpis').style.display='block';</script>";

}
else{    //а если капча уже введена, то делаем ее невведеннной
	
	unset($_SESSION['captcha_podpis_footer']);
	
	        echo "<script>document.getElementById('yes_captcha_podpis').style.display='none'; document.getElementById('no_captcha_podpis').style.display='block';</script>";
	
}

?>