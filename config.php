<?php
$loginMysql = 'admin';
$passwordMysql = 'Teny123!';
$dsn = 'mysql:host=localhost;dbname=NOT_X';
$connection = new PDO($dsn, $loginMysql, $passwordMysql);
