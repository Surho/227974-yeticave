<?php
require_once('init.php');
require_once('functions.php');

$sql = 'SELECT id, name FROM category';
$result = mysqli_query($con, $sql);

if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else {
    $error = mysqli_error($link);
    show_error($content, $error);
}

$page_content = include_template('add.php', [
    'categories' => $categories
]);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST['lot'];

    $filename = uniqid() . '.png';
    $lot['path'] = $filename;

    move_uploaded_file($_FILES['lot-image']['tmp_name'], 'img/' . $filename);
    $lot['path'] = 'img/' . $filename;

    $sql = 'INSERT INTO lot (category_id, user_id_winner, user_id_author, name, creation_date, end_date, description, image, init_price, price, step)
    VALUES (?, 1, 1, ?, NOW(), ?, ?, ?, ?, ?, ?)';

    $stmt = db_get_prepare_stmt($con, $sql, [$lot['category'], $lot['lot-name'], $lot['end-date'], $lot['message'], $lot['path'], $lot['start-price'],$lot['start-price'], $lot['step']]);
    var_dump($stmt);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        $lot_id = mysqli_insert_id($con);

        header("Location: lot.php?lot_id=" . $lot_id);
    }
}

print($page_content);


