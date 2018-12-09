<?php
$con = mysqli_connect("localhost", "root", "sidrrdis12", "yeticave");
mysqli_set_charset($con, "utf-8");

if(!$con) {
    $error =  mysqli_error($con);
    print('ошибка MySQL' . $error);
}
