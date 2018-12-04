<?php
require_once('functions.php');
require_once('data.php');

$con = mysqli_connect("localhost", "root", "sidrrdis12", "yeticave");
mysqli_set_charset($con, "utf-8");

$sql_lots = "SELECT *, lot.name AS lot_name, category.name AS category_name FROM  lot
LEFT JOIN category
ON lot.category_id = category.id
ORDER BY creation_date DESC";

$sql_category = 'SELECT name, alias  FROM category';


$result_lots = mysqli_query($con, $sql_lots);
$result_category = mysqli_query($con, $sql_category);

if(!$result_lots && !$result_category) {
    $error = mysqli_error($con);
    print('Ошибка MySQL: ' . $error);
}

$lots = mysqli_fetch_all($result_lots, MYSQLI_ASSOC);


$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots
]);

$categories = mysqli_fetch_all($result_category , MYSQLI_ASSOC);

$layout = include_template('layout.php', [
    'page_name' => 'Yeti - главная',
    'user_name' => $user_name,
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
]);

print($layout);
