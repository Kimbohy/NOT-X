<?php

header('Content-Type: application/json');

include "./Class.php";
include "../../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['commentId'])) {
        $commentId = $_GET['commentId'];
        $comment = new Comment($connection, $commentId, $_SESSION['userId']);
        $reacted = $comment->getUserReacted($accountId);
        
        echo json_encode($reacted);
    } else {
        echo json_encode(['error' => 'Comment ID is missing']);
    }
}
