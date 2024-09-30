<?php

include "./Class.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($connection, $_SESSION['id']);
    $user->addPost($_POST['content']);
}
?>