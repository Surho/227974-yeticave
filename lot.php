<?php
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

    if(!$result_lot) {
        navigate_to('templates/404.php');
    }
} else {
    navigate_to('templates/404.php');
}

$page_content = include_template('lot.php',[
    'lot_name' => $result_lot['name'],
    'lot_pic' => $result_lot['image'],
    'lot_description' => $result_lot['description'],
    'lot_step' => $result_lot['step'],
    'lot_price' => $result_lot['price'],
    'lot_category' => $result_lot['category_name']
]);

print($page_content);
