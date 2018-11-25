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
