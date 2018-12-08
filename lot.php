<?php
require_once('lot.php');
require_once('functions.php');

$con = mysqli_connect("localhost", "root", "sidrrdis12", "yeticave");
$sql_length = 'SELECT id FROM lot';
$result_sql_length = mysqli_query($con, $sql_length);
$result_arr_length = mysqli_fetch_all($result_sql_length, MYSQLI_ASSOC);

if(isset($_GET['lot_id'])) {
    if(count($result_arr_length) < intval($_GET['lot_id'])) {
        navigate_to('pages/404.html');
    }
    $lot_id = intval($_GET['lot_id']);
} else {
    navigate_to('pages/404.html');
}

$sql = 'SELECT lot.id, image, lot.name, description, step, price, category.name AS category_name
FROM lot
LEFT JOIN category
ON lot.category_id = category.id
WHERE lot.id =' . $lot_id;

$result_sql = mysqli_query($con, $sql);
$result_arr = mysqli_fetch_all($result_sql, MYSQLI_ASSOC);

if(!$result_sql) {
    $error =  mysqli_error($con);
    print('ошибка MySQL' . $error);
}

$lot_name = $result_arr[0]['name'];
$lot_pic = $result_arr[0]['image'];
$lot_description = $result_arr[0]['description'];
$lot_step = $result_arr[0]['step'];
$lot_price = $result_arr[0]['price'];
$lot_category = $result_arr[0]['category_name'];

$page_content = include_template('lot.php', [
    'lot_name' => $lot_name,
    'lot_pic' => $lot_pic,
    'lot_description' => $lot_description,
    'lot_step' => $lot_step,
    'lot_price' => $lot_price,
    'lot_category' => $lot_category
]);

print($page_content);
