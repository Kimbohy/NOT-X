<?php
session_start();
// get the username and password from the form using the POST method and store them in variables
$email = $_POST['email'];
$password = $_POST['password'];

// check if the username and password are empty
if (empty($email) || empty($password)) {
    // send to the log.php page that the email or password is empty
    header('Location: ../../pages/log.php?error=Email%20or%20password%20is%20empty');
}

$loginMysql = 'admin';
$passwordMysql = 'Teny123!';

// open a connection to the database
$connection = new PDO('mysql:host=localhost;dbname=NOT_X', $loginMysql, $passwordMysql);
$request = $connection->prepare('SELECT * FROM account WHERE email = ? AND password = ?');
$request->execute([$email, $password]);
$result = $request->fetch();
// check if the user exists in the database
if ($request->rowCount() > 0) {
    $_SESSION['userId'] = $result['id'];
    header('Location: ../../../index.php');
} else {
    // send to the log.php page that the user does not exist
    header('Location: ../../pages/log.php?error=Email%20or%20password%20is%20incorrect');
}
