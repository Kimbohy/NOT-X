<?php

class Reaction
{
    private $conn;
    private $table = [
        'post' => 'post_reaction',
        'comment' => 'comment_reaction'
    ];

    public function __construct()
    {
        // Connection to the database
        $this->conn = (new Database())->getConnection();
    }

    // get all reactions for a post or a comment
    public function getReactions($id, $type = 'post')
    {
        // check if the reaction type is valid
        if (!array_key_exists($type, $this->table)) {
            throw new Exception('Invalid reaction type');
        }

        $sql = "SELECT * FROM " . $this->table[$type] . " WHERE " . ($type == 'post' ? 'id_post' : 'id_comment') . " = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // create a reaction for a post or a comment
    public function createReaction($id, $author_id, $type, $reactionType = 'post')
    {
        if (!array_key_exists($reactionType, $this->table)) {
            throw new Exception('Invalid reaction type');
        }

        $sql = "INSERT INTO " . $this->table[$reactionType] . " (" . ($reactionType == 'post' ? 'id_post' : 'id_comment') . ", id_account, type) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $author_id, $type]);
    }

    // delete a reaction for a post or a comment
    public function deleteReaction($id, $author_id, $reactionType = 'post')
    {
        if (!array_key_exists($reactionType, $this->table)) {
            throw new Exception('Invalid reaction type');
        }

        $sql = "DELETE FROM " . $this->table[$reactionType] . " WHERE " . ($reactionType == 'post' ? 'id_post' : 'id_comment') . " = ? AND id_account = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $author_id]);
    }
}
