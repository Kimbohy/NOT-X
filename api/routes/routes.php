<?php

// routes to map to controllers

// Include necessary files
require_once '../controllers/PostController.php';
require_once '../controllers/CommentController.php';
require_once '../controllers/ReactionController.php';
require_once '../controllers/AccountController.php';
require_once '../config/Database.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize controllers
$postController = new PostController($db);
$commentController = new CommentController($db);
$reactionController = new ReactionController();
$accountController = new AccountController($db);


// Check if user is authenticated or creating an account
session_start();
/*
if (!isset($_SESSION['id']) && $_GET['createAccount'] !== 1) {
    echo json_encode(['error' => 'User not authenticated']);
    exit();
} elseif ($_GET['createAccount'] === 1) {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($accountController->register($data));
    exit();
}
*/

// Define routes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_GET['route'] === 'createPost') {                              // request format: /api/routes/routes.php?route=createPost
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($postController->create($data));
    } elseif ($_GET['route'] === 'createComment') {                     // request format: /api/routes/routes.php?route=createComment
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($commentController->create($data));
    } elseif ($_GET['route'] === 'createReaction') {                    // request format: /api/routes/routes.php?route=createReaction
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($reactionController->createReaction($data['post_id'], $data['author_id'], $data['type']));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['route'] === 'getPosts') {                                // request format: /api/routes/routes.php?route=getPosts
        echo $postController->getPosts();
    } elseif ($_GET['route'] === 'getComments') {                       // request format: /api/routes/routes.php?route=getComments&post_id=1
        echo $commentController->getCommentsByPost($_GET['post_id']);
    } elseif ($_GET['route'] === 'getReactions') {                      // request format: /api/routes/routes.php?route=getReactions&post_id=1
        echo $reactionController->getReactions($_GET['post_id']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if ($_GET['route'] === 'deleteReaction') {                          // request format: /api/routes/routes.php?route=deleteReaction
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($reactionController->deleteReaction($data['post_id'], $data['author_id']));
    }
}
