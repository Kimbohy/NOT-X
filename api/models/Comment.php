<?php

class Comment
{
    private $conn;
    private $table_name = "comment";

    public $id;
    public $id_post;
    public $id_account;
    public $content;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (id_post, id_account, content) VALUES (:id_post, :id_account, :content)";

        $stmt = $this->conn->prepare($query);

        $this->id_post = htmlspecialchars(strip_tags($this->id_post));
        $this->id_account = htmlspecialchars(strip_tags($this->id_account));
        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(':id_post', $this->id_post);
        $stmt->bindParam(':id_account', $this->id_account);
        $stmt->bindParam(':content', $this->content);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getCommentsByPost($id_post)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_post = :id_post ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_post', $id_post);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
