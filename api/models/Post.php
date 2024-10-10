<?php
class Post
{
    private $conn;
    private $table_name = "post";

    public $id;
    public $id_account;
    public $content;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create a new post
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (id_account, content) VALUES (:id_account, :content)";

        $stmt = $this->conn->prepare($query);

        // clean data
        $this->id_account = htmlspecialchars(strip_tags($this->id_account));
        $this->content = htmlspecialchars(strip_tags($this->content));

        // bind data
        $stmt->bindParam(':id_account', $this->id_account);
        $stmt->bindParam(':content', $this->content);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
