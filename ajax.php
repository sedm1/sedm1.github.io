<?php
session_start();

require("config.php"); //Подключение к бд

$countView = (int)$_GET['count_add'];    // количество записей, получаемых за один раз
$startIndex = (int)$_GET['count_show']; // с какой записи начать выборку
$catId = (int)$_GET['cat_id']; // какую категорию выводить


$page= (int)$_GET['page'];



// запрос к бд
if (!empty ($catId) ) {
    $sql = mysql_query("SELECT * FROM `catalog` WHERE  cat_id in ('" . $catId . "')ORDER BY FIELD(status,  '2') ASC, `article` DESC
                               LIMIT " . $startIndex . " , " . $countView . " ") or die(mysql_error());
}else {

    $sql = mysql_query("SELECT * FROM `catalog` WHERE  cat_id in (7,8,9,10,11,12) ORDER BY FIELD(status,  '2') ASC, `article` DESC
                               LIMIT " . $startIndex . " , " . $countView . " ") or die(mysql_error());
}


$row_BU = array();
while ($result = mysql_fetch_array($sql, MYSQL_ASSOC)) {
    $row_BU[] = $result;

}


if (empty($row_BU)) {
    // если новостей нет
    echo json_encode(array(
        'result' => 'finish'
    ));
} else {
    // если новости получили из базы, то свормируем html элементы
    // и отдадим их клиенту

    $html = "";
    foreach ($row_BU as $row) {

        if ($row['status'] == 3)
            $a1 = ' style="border: solid red; width:192px; height: 347px;" ';
        else
            $a1 = '';

        if ($row['status'] == 0)
            $a2 = '';
        elseif ($row['status'] == 1)
            $a2 = 'new';
        else
            $a2 = 'sold';

        if ($row['price'] == 0)
            $a3 = '';
        else
            $a3 = '&euro;'.$row['price'];


        $html .= '<li>';
        $html .= '<div ' . $a1 . ' >';
        $html .= '<a href="umarket_view.php?item=' . $row['id'] . '&page='.$page.' ">';
        $html .= '<div class="view">';
        $html .= '<div class="status ' . $a2 . ' "></div>';
        $html .= '<img src="../../uploads/catalog/' . $row['catalog_image'] . '" alt="' . $row['catalog_image'] . '">';
        $html .= '</div>';
        $html .= '<div class="title">' . $row['name'] . '</div>';
        $html .= '<div class="description">' . $row['description'] . '</div>';
        $html .= '<div class="size">Размер: ' . $row['size'] . '</div>';
        $html .= '<div class="article">' . $row['article'] . '</div>';
        $html .= '<div class="price">' . $a3 . '</div>';
        $html .= '</a>';
        $html .= '</div>';
        $html .= '</li>';

    }
    echo json_encode(array(
        'result' => 'success',
        'html' => $html,
    ));

}

