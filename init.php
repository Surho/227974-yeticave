<?php

session_start();

date_default_timezone_set("Europe/Moscow");

if(!empty($_SESSION['user'])) {
    $is_auth = true;
    $user_name = $_SESSION['user']['name'];
} else {
    $is_auth = false;
}


$user_avatar = 'img/user.jpg';

$con = mysqli_connect("localhost", "root", "sidrrdis12", "yeticave");
mysqli_set_charset($con, "utf-8");

if (!$con) {
    $error =  mysqli_error($con);
    print('ошибка MySQL' . $error);
}
