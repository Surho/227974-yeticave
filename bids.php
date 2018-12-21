<?php
require_once('init.php');
require_once('functions.php');

if(($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $error;
    $lot_id = intval($_POST['lot_id']);

    $sql = 'SELECT init_price, price, step FROM lot WHERE id=' . $lot_id;
    $result = mysqli_query($con, $sql);
    $min_bid_price = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $bid_price = intval($_POST['cost']);

    if($bid_price > $min_bid_price['price'] + $min_bid_price['step']) {
        $now = date('Y-m-d H:i:s');
        $sql_bid = "INSERT INTO bid (lot_id, user_id, sum_price) VALUES (?, ?, ?);";
        $stmt = db_get_prepare_stmt($con, $sql_bid, [
            $lot_id,
            $_SESSION['user']['id'],
            $bid_price
        ]);
        $res = mysqli_stmt_execute($stmt);
        //maby update price in lot
    } else {
        $error = 'Ставка введена неверно';
    }

}

$sql_lot = 'SELECT lot.id, image, lot.name, description, lot.creation_date, lot.end_date, step, price, category.name AS category_name
FROM lot
LEFT JOIN category
ON lot.category_id = category.id
WHERE lot.id =' . $lot_id;

$result_sql = mysqli_query($con, $sql_lot);
$result_lot = mysqli_fetch_array($result_sql, MYSQLI_ASSOC);

// $time1 = strtotime($result_lot['creation_date']);
// $time2 = strtotime($result_lot['end_date']);

// $diff = (($time2-$time1)/3600);
// var_dump($diff);

$sql_category = 'SELECT name, alias  FROM category';
$result_category = mysqli_query($con, $sql_category);
$categories = mysqli_fetch_all($result_category , MYSQLI_ASSOC);

$sql_bid = 'SELECT date, sum_price FROM bid WHERE lot_id =' . $lot_id;
$result_sql_bid = mysqli_query($con, $sql_bid);

if($result_sql_bid) {
    $result_lot_bid = mysqli_fetch_all($result_sql_bid, MYSQLI_ASSOC);
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
    'lot_id' => $lot_id,
    'user' => $user_name,
    'bids' => $result_lot_bid ?? '',
    "date" => $result_lot_bid[0]['date'] ?? '',
    "bid_price" => $result_lot_bid[0]['sum_price'] ?? '',
    'error' => $error ?? null
]);

$layout_content = include_template('layout.php',[
    'page_name' => 'Yeti - лот',
    'user_name' => $user_name ?? '',
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
]);

print($layout_content);
