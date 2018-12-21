<?php
require_once('init.php');
require_once('functions.php');

if(!$is_auth) {
    $sql_category = 'SELECT name, alias  FROM category';
    $result_category = mysqli_query($con, $sql_category);
    $categories = mysqli_fetch_all($result_category , MYSQLI_ASSOC);

    header('HTTP/1.0 403 Forbidden');

    $page_content = include_template('403.php', []);
    $layout_content = include_template('layout.php', [
        'page_name' => 'Yeti - 403 Forbidden',
        'user_name' => $user_name ?? "",
        'is_auth' => $is_auth,
        'page_content' => $page_content,
        'categories' => $categories
    ]);

    print($layout_content);
    exit();
}

$sql = 'SELECT id, name FROM category';
$result = mysqli_query($con, $sql);

if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else {
    $error = mysqli_error($con);
    // show_error($content, $error);
}

$page_content = include_template('add.php', [
    'categories' => $categories
]);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lot = $_POST['lot'];

    $required = ['lot-name', 'end-date', 'message', 'start-price', 'step'];
    $errors = [];

    foreach ($required as $field_name) {
        $check = check_field($field_name, $_POST['lot']);
        if($check) {
            $errors[$field_name] = $check;
        }
    }

    if (!empty($_FILES['lot-image']['name'])) {
		$tmp_name = $_FILES['lot-image']['tmp_name'];
        $path = $_FILES['lot-image']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);

        if ($file_type === "image/jpeg" || $file_type === "image/jpg" || $file_type === "image/png") {
			$filename = uniqid() . '.jpeg';
            $lot['path'] = $filename;

            move_uploaded_file($_FILES['lot-image']['tmp_name'], 'img/' . $filename);
            $lot['path'] = 'img/' . $filename;
		} else {
            $errors['file'] = 'Загрузите картинку в формате png или jpeg';
            $lot['path'] = '';
        }
    }
    else {
        $lot['path'] = '';
		$errors['lot-image'] = 'Вы не загрузили файл';
    }

    if (count($errors)) {
		$page_content = include_template('add.php', [
            'errors' => $errors,
            'categories' => $categories,
        ]);
    } else {
        $sql = 'INSERT INTO lot (
            category_id,
            user_id_author,
            name,
            creation_date,
            end_date,
            description,
            image,
            init_price,
            price,
            step
        ) VALUES (?, 1, ?, NOW(), ?, ?, ?, ?, ?, ?)';

        $stmt = db_get_prepare_stmt($con, $sql, [
            $lot['category'],
            $lot['lot-name'],
            $lot['end-date'],
            $lot['message'],
            $lot['path'],
            $lot['start-price'],
            $lot['start-price'],
            $lot['step']
        ]);
        $res = mysqli_stmt_execute($stmt);
        if ($res) {
            $lot_id = mysqli_insert_id($con);
            header("Location: lot.php?lot_id=" . $lot_id);
        }
    }
}

$layout_content = include_template('layout.php', [
    'page_name' => 'Yeti - главная',
    'user_name' => $user_name ?? "",
    'is_auth' => $is_auth,
    'page_content' => $page_content,
    'categories' => $categories
]);

print($layout_content);








