<?php

require_once '../models/Comment.php';
class CommentController
{
    private $conn;
    private $table_name = "comments";

    public function __construct($db)
    {
        $this->conn = new Comment($db);
    }

    public function create($data)
    {
        $this->conn->id_post = $data['id_post'];
        $this->conn->id_account = $data['id_account'];
        $this->conn->content = $data['content'];

        if ($this->conn->create()) {
            return true;
        }
        return false;
    }

    public function getCommentsByPost($id_post)
    {
        $comments = $this->conn->getCommentsByPost($id_post);

        if ($comments) {
            return json_encode($comments);
        } else {
            return json_encode(['error' => 'No comments found']);
        }
    }
}
