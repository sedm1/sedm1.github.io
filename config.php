<?php  
//$db = mysql_connect ("localhost","OutletBnew","RixStock45esn") or die("Не могу соединиться");
$db = @mysql_connect("localhost","mysql","mysql") or die("Не могу соединиться");
//$db = mysql_connect ("localhost","cl8103_nboutlet","VUXLe78s") or die("Не могу соединиться");

//$db = mysql_connect ("localhost","root","") or die("Не могу соединиться");
mysql_select_db ("nboutnew", $db);
//mysql_select_db ("cl8103_nboutlet", $db);
mysql_query("SET NAMES 'utf8'");


define('PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('BASE_URL', 'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']) .'/');

// Функции дебага
if(!function_exists('dd')){
	function dd($dump){
		
		echo '<pre style="color:#00ff00; background:#000; padding:10px;">';
		if(isset($dump)){
			print_r($dump);
		}else{
			echo 'Empty';
		}
		echo '</pre>';
		
	}
}



function get_url() {
    $args = func_get_args();

    if (count($args) === 1) return BASE_URL . trim($args[0], '/');

    $url = '';
    foreach ($args as $param) {
        if (strlen($param)) {
            $url .= $param{0} == '#' ? $param: '/'. $param;
        }
    }
    return BASE_URL . preg_replace('/^\/(.*)$/', '$1', $url);
}







require_once PATH.'vendor/autoload.php';
