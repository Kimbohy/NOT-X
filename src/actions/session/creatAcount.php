<?php
header('Content-Type: application/json');
include '../../../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../../config.php";
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $request = $connection->prepare('INSERT INTO account (first_name, last_name, email, password) VALUES (?, ?, ?, ?)');
        $request->bindParam(1, $firstName, PDO::PARAM_STR);
        $request->bindParam(2, $lastName, PDO::PARAM_STR);
        $request->bindParam(3, $email, PDO::PARAM_STR);
        $request->bindParam(4, $password, PDO::PARAM_STR);
        $request->execute();
        session_start();
        $_SESSION['userId'] = $connection->lastInsertId();
        header('Location: ../../../index.php');
        exit();
    } else {
        echo json_encode(['error' => 'First name, last name, email or password is missing']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
