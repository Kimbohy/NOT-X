<?php

include "./Class.php";
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if commentId and userId are set
    if (isset($data['commentId'], $_SESSION['userId'])) {
        $user = new User($connection, $_SESSION['userId']);

        // Check if the user has already reacted to the comment
        if (getReaction($data['commentId'], $_SESSION['userId'], $connection)) {
            // If a reaction exists, remove it (unlike)
            $user->removeCommentReaction($data['commentId']);
            echo json_encode(['status' => 'success', 'message' => 'Reaction removed', 'reacted' => false]);
        } else {
            // Otherwise, add a reaction (like)
            $user->addCommentReaction($data['commentId'], 'like');
            echo json_encode(['status' => 'success', 'message' => 'Reaction added', 'reacted' => true]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing commentId or userId']);
    }
}

// Function to check if the user has already reacted to the comment
function getReaction($commentId, $userId, $connection)
{
    $stmt = $connection->prepare("SELECT * FROM comment_reaction WHERE id_comment = ? AND id_account = ?");
    $stmt->bindParam(1, $commentId, PDO::PARAM_INT);
    $stmt->bindParam(2, $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return count($result) > 0;
}
