<?php

include "./Class.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reaction = new Reaction($connection, $_POST['postId'], $_SESSION['id']);
    if ($reaction->getReaction()) {
        $request = $connection->prepare('DELETE FROM post_reaction WHERE id_post = ? AND id_account = ?');
        $request->bindParam(1, $_POST['postId'], PDO::PARAM_INT);
        $request->bindParam(2, $_SESSION['id'], PDO::PARAM_INT);
        $request->execute();
    } else {
        $user = new User($connection, $_SESSION['id']);
        $user->addReaction($_POST['postId'], 'like');
    }
}
?>