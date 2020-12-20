<?php

//ini_set( 'display_errors', 1 );
//error_reporting( E_ALL );

session_start();

include_once 'config.php';
include_once 'func.db.php';
include_once 'func.php';
include_once 'func.html.php';


if( !isset( $_SESSION['language'] ) || $_SESSION['language'] != 'ru')
  $_SESSION['language'] = 'ru';

$lang = 'ru';

//Папка с изображениями
$folder = 'uploads/';

include_once 'blocks/LanguageCart.php';

?>