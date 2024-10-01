<?php
include "./Class.php";

session_start(); // Ensure session is started
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['postId']) && isset($input['content'])) {
        $postId = $input['postId'];
        $content = $input['content'];
        $user = new User($connection, $_SESSION['userId']);
        $user->addComment($postId, $content);
        echo json_encode(['success' => 'Comment added successfully']);
    } else {
        echo json_encode(['error' => 'Post ID or content is missing']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
