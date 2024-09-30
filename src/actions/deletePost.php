<?php

include "./Class.php";
session_start(); // Ensure session is started

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if postId is set
    if (isset($data['postId'])) {
        $user = new User($connection, $_SESSION['userId']); // Logged-in user
        $post = new Post($connection, $data['postId']); // Post to delete

        // Check if the post belongs to the logged-in user
        if ($post->getIdAccount() === $user->getUserId()) {
            try {
                // Start a transaction to ensure data integrity
                $connection->beginTransaction();

                // First, delete all related reactions
                $request1 = $connection->prepare('DELETE FROM post_reaction WHERE id_post = ?');
                $request1->bindParam(1, $data['postId'], PDO::PARAM_INT);
                $request1->execute();

                // Second, delete all related comments (if any)
                $request2 = $connection->prepare('DELETE FROM comment WHERE id_post = ?');
                $request2->bindParam(1, $data['postId'], PDO::PARAM_INT);
                $request2->execute();

                // Now, delete the post itself
                $request3 = $connection->prepare('DELETE FROM post WHERE id = ?');
                $request3->bindParam(1, $data['postId'], PDO::PARAM_INT);
                $request3->execute();

                // Commit the transaction
                $connection->commit();

                // Respond with a success message
                echo json_encode(['status' => 'success', 'message' => 'Post removed successfully']);
            } catch (Exception $e) {
                // Rollback the transaction in case of an error
                $connection->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'Error removing post: ' . $e->getMessage()]);
            }
        } else {
            // Respond with an error message if the post does not belong to the user
            echo json_encode(['status' => 'error', 'message' => 'You are not authorized to remove this post']);
        }
    } else {
        // Respond with an error message if 'postId' is missing
        echo json_encode(['status' => 'error', 'message' => 'Post ID is required']);
    }
}
