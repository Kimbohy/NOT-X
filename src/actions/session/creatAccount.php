<?php
session_start();

include '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profilePicture = $_FILES['profilePicture'];

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        header("Location: ../../pages/signUp.php?error=All fields are required");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../pages/signUp.php?error=Invalid email format");
        exit();
    }

    // Check if the email is already registered
    $checkEmail = $connection->prepare("SELECT * FROM account WHERE email = ?");
    $checkEmail->execute([$email]);
    if ($checkEmail->rowCount() > 0) {
        header("Location: ../../pages/signUp.php?error=Email is already in use");
        exit();
    }

    // Handle file upload
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($profilePicture["name"], PATHINFO_EXTENSION));
    $targetDir = "../../../../uploads/";
    $targetFile = $targetDir . uniqid() . "." . $fileExtension;

    if (!in_array($fileExtension, $allowedExtensions)) {
        header("Location: ../../pages/signUp.php?error=Invalid file type");
        exit();
    }

    if (!move_uploaded_file($profilePicture["tmp_name"], $targetFile)) {
        header("Location: ../../pages/signUp.php?error=Failed to upload profile picture");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Save user data
    try {
        $request = $connection->prepare('INSERT INTO account (first_name, last_name, email, password, profile_picture) VALUES (?, ?, ?, ?, ?)');
        $request->execute([$firstName, $lastName, $email, $hashedPassword, $targetFile]);

        // Redirect to success page
        header("Location: ../../pages/index.php?success=Account created successfully");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        header("Location: ../../pages/signUp.php?error=Database error: " . $e->getMessage());
        exit();
    }
}
