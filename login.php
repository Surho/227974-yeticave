<?php
require_once('data.php');
require_once('init.php');
require_once('functions.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $required = ['email', 'password'];

    foreach ($required as $field) {
	    if (empty($form[$field])) {
	        $errors[$field] = 'Это поле надо заполнить';
        }
    }
    $email = mysqli_real_escape_string($con, $form['email']);
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$res = mysqli_query($con, $sql);

	$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

	if ($user) {
		if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit();
		} else {
            $errors['password'] = 'Неверный пароль';
        }
    } else {
		$errors['email'] = 'Такой пользователь не найден';
    }
}

$sql_category = 'SELECT name, alias  FROM category';
$result_category = mysqli_query($con, $sql_category);
$categories = mysqli_fetch_all($result_category , MYSQLI_ASSOC);


var_dump($errors);
$page_content = include_template('login.php', [
    'errors' => $errors,
    'email' => $form['email'] ?? ''
]);

$layout_content = include_template('layout.php', [
    'page_name' => 'Yeti - вход',
    'user_name' => $user_name,
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
]);

print($layout_content);
