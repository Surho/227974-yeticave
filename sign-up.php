<?php
require_once('init.php');
require_once('functions.php');

$tpl_data = [];

$page_content = include_template('sign-up.php', []);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $errors = [];

    $req_fields = ['email', 'password', 'name', 'message'];

    foreach ($req_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = "Не заполнено поле " . $field;
        }
        if($field === 'email') {
            $filtered = filter_var($form[$field], FILTER_VALIDATE_EMAIL);
            if(!$filtered) {
                $errors[$field] = 'Введите корректный email';
            }
        }
    }

    if($_FILES['avatar_image']) {
        $tmp_name = $_FILES['avatar_image']['tmp_name'];
        $path = $_FILES['avatar_image']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        var_dump($file_type);

    }

    if (empty($errors)) {
        $email = mysqli_real_escape_string($con, $form['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $sql);


        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        } else {
            $password = password_hash($form['password'], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users (
                registration_date,
                email,
                name,
                password,
                avatar,
                contacts
            )
            VALUES (NOW(), ?, ?, ?, ?, ?)';

            $stmt = db_get_prepare_stmt($con, $sql, [
                $form['email'],
                $form['name'],
                $password,
                "sdaadsda",
                $form['message'],
            ]);
            $res = mysqli_stmt_execute($stmt);

            if ($res && empty($errors)) {
                $page_content =  include_template('login.php', []);
                print($page_content);

                header("Location: /login.php");
                exit();
            }
        }
    } else {
        $page_content = include_template('sign-up.php', [
            'errors' => $errors
        ]);
    }
}

print($page_content);

