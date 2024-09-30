<?php

header('Content-Type: application/json'); // Set header before any output

include "./Class.php";

$user = new User($connection, 1);
$allPost = $user->getAllPosts();
$allPostData = [];

foreach ($allPost as $post) {
    $postInstance = new Post($connection, $post['id']);
    // Append post data to $allPostData
    $allPostData[] = $postInstance->postData();
}

// print_r($allPostData);

// Return all post data as JSON
echo json_encode($allPostData);
