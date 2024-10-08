<?php
// get all user info

include "../Class.php";
include "../../../config.php";
header('Content-Type: application/json');

session_start(); // Ensure session is started

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['userId'])) {
        $user = new User($connection, $_SESSION['userId']);
        echo json_encode([
            'id' => $user->getUserId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'profilePicture' => $user->getProfilePicture(),
            'email' => $user->getEmail()
        ]);
    } else {
        echo json_encode(['error' => 'User not logged in']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
