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

