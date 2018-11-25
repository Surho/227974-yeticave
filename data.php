<?php
$is_auth = rand(0, 1);

$user_name = 'Surkho';
$user_avatar = 'img/user.jpg';

$categories = [
    'boards' => 'Доски и лыжи',
    'attachment' => 'Крепления',
    'boots' => 'Ботинки',
    'clothing' => 'Одежда',
    'tools' => 'Инструменты',
    'other' => 'Разное'
];


$lots = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'categorie' => $categories['boards'],
        'price' => 10999,
        'url' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'categorie' => $categories['boards'],
        'price' => 159999,
        'url' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'categorie' => $categories['attachment'],
        'price' => 8000,
        'url' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'categorie' => $categories['boots'],
        'price' => 10999,
        'url' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'categorie' => $categories['clothing'],
        'price' => 7500,
        'url' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'categorie' => $categories['other'],
        'price' => 5400,
        'url' => 'img/lot-6.jpg'
    ]
];
