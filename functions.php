<?php
function include_template($name, $data) {
    $name = 'templates/' . $name;

    if (!is_readable($name)) {
        return '';
    }

    ob_start();
    extract($data);
    require $name;

    return ob_get_clean();
}

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}

/**
 * formating price
 * @param integer $number - initial price
 * @return string - formated price
 */
function format_number($number) {
    $number = number_format($number, 0, '.', ' ');
    return $number . ' ₽';
};

/**
 * counting and printing time to midnight
 */
function time_to_midnight() {
    date_default_timezone_set('Europe/Moscow');

    $now = date_create('now');
    $midnight = date_create('tomorrow midnight');
    $diff = date_diff($now, $midnight);

    $time_remaining = date_interval_format($diff, '%H : %I');
    print($time_remaining);
}

/**
 * filtrating user input
 * @param string $str - string from user
 * @return string $text - filtrated string
 */
function esc($str) {
	$text = htmlspecialchars($str);

	return $text;
};

/**
 * filtrating user input
 * @param $url - navigate to url
 */
function navigate_to($url) {
    header("Location: " . $url);
    exit;
}
