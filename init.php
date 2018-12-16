<?php

$is_auth = rand(0, 1);

$user_name = 'Surkho';
$user_avatar = 'img/user.jpg';

$con = mysqli_connect("localhost", "root", "sidrrdis12", "yeticave");
mysqli_set_charset($con, "utf-8");

if (!$con) {
    $error =  mysqli_error($con);
    print('ошибка MySQL' . $error);
}
