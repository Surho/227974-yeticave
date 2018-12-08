<?php
require_once('lot.php');
require_once('init.php');
require_once('functions.php');

if(!empty($_GET['lot_id'])) {
    $sql = 'SELECT lot.id, image, lot.name, description, step, price, category.name AS category_name
    FROM lot
    LEFT JOIN category
    ON lot.category_id = category.id
    WHERE lot.id =' . intval($_GET['lot_id']);
    $result_sql = mysqli_query($con, $sql);
    $result_lot = mysqli_fetch_array($result_sql, MYSQLI_ASSOC);
    var_dump($result_lot);

    if(!$result_lot) {
        navigate_to('pages/404.html');
    }
} else {
    navigate_to('pages/404.html');
}

if(!$result_sql) {
    $error =  mysqli_error($con);
    print('ошибка MySQL' . $error);
}

$lot_name = $result_lot['name'];
$lot_pic = $result_lot['image'];
$lot_description = $result_lot['description'];
$lot_step = $result_lot['step'];
$lot_price = $result_lot['price'];
$lot_category = $result_lot['category_name'];

$page_content = include_template('lot.php',[
    'lot_name' => $result_lot['name'],
    'lot_pic' => $result_lot['image'],
    'lot_description' => $result_lot['description'],
    'lot_step' => $result_lot['step'],
    'lot_price' => $result_lot['price'],
    'lot_category' => $result_lot['category_name']
]);

print($page_content);
