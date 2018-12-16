<?php
require_once('data.php');
require_once('init.php');
require_once('functions.php');

$page_content = include_template('login.php', []);

print($page_content);
