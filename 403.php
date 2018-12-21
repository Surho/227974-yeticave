<?php
require_once('init.php');
require_once('functions.php');

$page_content = include_template('403.php', []);

$sql_category = 'SELECT name, alias  FROM category';
$result_category = mysqli_query($con, $sql_category);
$categories = mysqli_fetch_all($result_category , MYSQLI_ASSOC);

$layout_content = include_template ('layout.php', [
    'page_name' => 'Yeti - 403',
    'user_name' => $user_name ?? "",
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
    ]
);

print($layout_content);
