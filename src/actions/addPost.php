<?php
include "./Class.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if content is set
    if (isset($data['content'])) {
        $user = new User($connection, $_SESSION['userId']);
        $user->addPost($data['content']);

        // Respond with a success message
        echo json_encode(['status' => 'success', 'message' => 'Post created successfully']);
    } else {
        // Respond with an error message if 'content' is missing
        echo json_encode(['status' => 'error', 'message' => 'Content is required']);
    }
}
