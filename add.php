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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lot = $_POST['lot'];

    $required = ['lot-name', 'end-date', 'message', 'start-price', 'step'];
    $errors = [];

    foreach ($required as $field_name) {
        $check = check_field($_POST['lot'][$field_name]);
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
            step
        ) VALUES (?, 1, ?, NOW(), ?, ?, ?, ?, ?)';

        $stmt = db_get_prepare_stmt($con, $sql, [
            $lot['category'],
            $lot['lot-name'],
            $lot['end-date'],
            $lot['message'],
            $lot['path'],
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

print($page_content);








