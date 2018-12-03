<?php
require_once('functions.php');
require_once('data.php');

$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots
]);

$layout = include_template('layout.php', [
    'page_name' => 'Yeti - главная',
    'user_name' => $user_name,
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
]);

print($layout);

$con = mysqli_connect("localhost", "root", "sidrrdis12", "yeticave");

if (!$con) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Соединение с MySQL установлено!" . PHP_EOL;
echo "Информация о сервере: " . mysqli_get_host_info($con) . PHP_EOL;

mysqli_close($con);
