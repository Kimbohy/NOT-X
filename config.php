<?php
$loginMysql = 'admin';
$passwordMysql = 'Teny123!';
$dsn = 'mysql:host=localhost;dbname=NOT_X';
if (!isset($_SESSION['userId'])) {
    header('Location: ./src/pages/log.php');
} else {
$connection = new PDO($dsn, $loginMysql, $passwordMysql);
}