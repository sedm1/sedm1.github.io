<?
if($_POST['name'] == 'holod'){
    setcookie('user_holod',1);
    header('location: /');
}else{
    header('Content-Type: text/html; charset=utf-8');
    echo 'Неверный логин';
}