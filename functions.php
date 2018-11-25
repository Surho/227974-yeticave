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


