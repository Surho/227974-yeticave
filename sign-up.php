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

    if(!empty($_FILES['avatar']['name'])) {
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $path = $_FILES['avatar']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        $file_type = substr($file_type, 6);

        if ($file_type === "jpeg" || $file_type === "jpg" || $file_type === "png") {
            $filename = uniqid() ."." .$file_type;
            $path = $filename;

            move_uploaded_file($_FILES['avatar']['tmp_name'], 'img/' . $filename);
            $path = 'img/' . $filename;
        } else {
            $errors['file'] = 'Загрузите картинку в формате png,jpg,jpeg';
        }
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
                $path,
                $form['message'],
            ]);
            $res = mysqli_stmt_execute($stmt);

            if ($res && empty($errors)) {
                header("Location: /yeti/login.php");
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

