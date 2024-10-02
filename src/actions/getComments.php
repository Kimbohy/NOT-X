<?php

include "./Class.php";
session_start(); // Ensure session is started
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        $user = new User($connection, $_SESSION['userId']);
        $post = new Post($connection, $postId);
        $comments = $post->getCommentsList();

        // Prepare response
        $response = [];
        if ($comments) {
            foreach ($comments as $comment) {
                $comment = new Comment($connection, $comment['id_post'], $comment['id_account']);
                $response[] = [
                    'id' => $comment->getIdAccount(),
                    'content' => $comment->getContent(),
                    'fullName' => $comment->getFullName(),
                    'profilePicture' => $comment->getProfilePicture(),
                    'commentSince' => $comment->getCommentSince(),
                ];
            }
        }

        // If $response is empty, we return a valid empty array in JSON
        echo json_encode($response);
    } else {
        // If 'postId' is not provided, return an error message
        echo json_encode(['error' => 'Post ID is missing']);
    }
} else {
    // If the request method is not GET, return an error message
    echo json_encode(['error' => 'Invalid request method']);
}
