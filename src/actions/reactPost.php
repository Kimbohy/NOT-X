<?php

include "./Class.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if postId and accountId are set
    if (isset($data['postId'], $_SESSION['userId'])) {
        $user = new User($connection, $_SESSION['userId']);
        $reaction = new Reaction($connection, $data['postId'], $_SESSION['userId']);

        if ($reaction->getReaction()) {
            // If a reaction exists, remove it (unlike)
            $user->removeReaction($data['postId']);
            echo json_encode(['status' => 'success', 'message' => 'Reaction removed', 'reacted' => false]);
        } else {
            // Otherwise, add a reaction (like)
            $user->addReaction($data['postId'], 'like');
            echo json_encode(['status' => 'success', 'message' => 'Reaction added', 'reacted' => true]);
        }
    } else {
        // Respond with an error if data is missing
        echo json_encode(['status' => 'error', 'message' => 'Missing postId or accountId']);
    }
}
