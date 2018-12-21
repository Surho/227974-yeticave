<?php
require_once('init.php');
require_once('functions.php');

$sql_category = 'SELECT name, alias  FROM category';
$result_category = mysqli_query($con, $sql_category);
$categories = mysqli_fetch_all($result_category , MYSQLI_ASSOC);

// $sql_bids = 'SELECT lot_id, date, sum_price  FROM bid';
// $resut_sql_bids = mysqli_query($con, $sql_bids);
// $result_bids = mysqli_fetch_all($resut_sql_bids , MYSQLI_ASSOC);

$sql_bid = 'SELECT date, sum_price, user_id FROM bid WHERE lot_id =' . $_GET['lot_id'];
$result_sql_bid = mysqli_query($con, $sql_bid);
if($result_sql_bid) {
    $result_lot_bid = mysqli_fetch_all($result_sql_bid, MYSQLI_ASSOC);
}

$sql_users = 'SELECT id, name FROM users';
$result_sql_users = mysqli_query($con, $sql_users);
if($result_sql_users) {
    $result_users= mysqli_fetch_all($result_sql_users, MYSQLI_ASSOC);
}

if(!empty($_GET['lot_id'])) {
    $sql = 'SELECT lot.id, image, lot.name, description, lot.creation_date, lot.end_date, step, price, category.name AS category_name
    FROM lot
    LEFT JOIN category
    ON lot.category_id = category.id
    WHERE lot.id =' . intval($_GET['lot_id']);

    $result_sql = mysqli_query($con, $sql);
    $result_lot = mysqli_fetch_array($result_sql, MYSQLI_ASSOC);

    if(!$result_lot) {
        navigate_to('404.php');
    }
}

$page_content = include_template('lot.php',[
    'lot_name' => $result_lot['name'],
    'lot_pic' => $result_lot['image'],
    'lot_description' => $result_lot['description'],
    'lot_step' => $result_lot['step'],
    'lot_price' => $result_lot['price'],
    'lot_category' => $result_lot['category_name'],
    'lot_creation_date' => $result_lot['creation_date'],
    'lot_end_date' => $result_lot['end_date'],
    'is_auth' => $is_auth,
    'lot_id' => intval($_GET['lot_id']),
    'users' => $result_users,
    'bids' => $result_lot_bid ?? '',
]);

$layout_content = include_template('layout.php',[
    'page_name' => 'Yeti - лот',
    'user_name' => $user_name ?? '',
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
]);







