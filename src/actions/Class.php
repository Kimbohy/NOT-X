<?php

include "../../config.php";

class User
{
    private $id = 0;
    private $firstName = '';
    private $lastName = '';
    private $email = '';
    private $profilePicture = '';
    protected $connection;

    public function __construct($connection, $id)
    {
        $this->connection = $connection;
        $this->loadUserData($id);
    }

    public function getUserId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function loadUserData($id)
    {
        $request = $this->connection->prepare('SELECT * FROM account WHERE id = ?');
        $request->bindParam(1, $id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();

        if ($result) {
            $this->id = $result['id'];
            $this->firstName = $result['first_name'];
            $this->lastName = $result['last_name'];
            $this->email = $result['email'];
            $this->profilePicture = $result['profile_picture'] ?? "./src/assets/images/1.webp";
        }
    }

    public function addPost($content)
    {
        $request = $this->connection->prepare('INSERT INTO post (id_account, content) VALUES (?, ?)');
        $request->bindParam(1, $this->id, PDO::PARAM_INT);
        $request->bindParam(2, $content, PDO::PARAM_STR);
        $request->execute();
    }

    public function addReaction($postId, $reaction)
    {
        $request = $this->connection->prepare('INSERT INTO post_reaction (id_post, id_account, type) VALUES (?, ?, ?)');
        $request->bindParam(1, $postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->bindParam(3, $reaction, PDO::PARAM_STR);
        $request->execute();
    }

    public function removeReaction($postId)
    {
        $request = $this->connection->prepare('DELETE FROM post_reaction WHERE id_post = ? AND id_account = ?');
        $request->bindParam(1, $postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->execute();
    }

    public function addComment($postId, $content)
    {
        $request = $this->connection->prepare('INSERT INTO comment (id_post, id_account, content) VALUES (?, ?, ?)');
        $request->bindParam(1, $postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->bindParam(3, $content, PDO::PARAM_STR);
        $request->execute();
    }

    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    public function getAllPosts()
    {
        $request = $this->connection->prepare('SELECT * FROM post');
        $request->execute();
        return $request->fetchAll();
    }

    public function removeCommentReaction($commentId)
    {
        $request = $this->connection->prepare('DELETE FROM comment_reaction WHERE id_comment = ? AND id_account = ?');
        $request->bindParam(1, $commentId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->execute();
    }

    public function addCommentReaction($commentId, $reaction)
    {
        $request = $this->connection->prepare('INSERT INTO comment_reaction (id_comment, id_account, type) VALUES (?, ?, ?)');
        $request->bindParam(1, $commentId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->bindParam(3, $reaction, PDO::PARAM_STR);
        $request->execute();
    }
}

class Post
{
    private $postId = 0;
    private $accountId = 0;
    private $content = '';
    private $date = '';
    private $reaction = [];
    private $user;
    private $connection;

    public function __construct($connection, $id)
    {
        $this->connection = $connection;
        $this->loadPostData($id);
    }

    private function loadPostData($id)
    {
        $request = $this->connection->prepare('SELECT * FROM post WHERE id = ?');
        $request->bindParam(1, $id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();

        if ($result) {
            $this->postId = $result['id'];
            $this->accountId = $result['id_account'];
            $this->content = $result['content'];
            $this->date = $result['created_at'];
            $this->user = new User($this->connection, $this->accountId);
            $this->reaction = $this->getReactionsList();
        }
    }

    private function postSince()
    {
        $date = new DateTime($this->date);
        $now = new DateTime();
        $interval = $now->diff($date);

        if ($interval->y > 0) return $interval->y . 'y';
        if ($interval->m > 0) return $interval->m . 'm';
        if ($interval->d > 0) return $interval->d . 'd';
        if ($interval->h > 0) return $interval->h . 'h';
        if ($interval->i > 0) return $interval->i . 'm';
        return $interval->s . 's';
    }

    private function getReactionsList()
    {
        $request = $this->connection->prepare('SELECT * FROM post_reaction WHERE id_post = ?');
        $request->bindParam(1, $this->postId, PDO::PARAM_INT);
        $request->execute();
        return $request->fetchAll();
    }

    public function getcommentsList()
    {
        $request = $this->connection->prepare('SELECT * FROM comment WHERE id_post = ?');
        $request->bindParam(1, $this->postId, PDO::PARAM_INT);
        $request->execute();
        return $request->fetchAll();
    }

    public function postData()
    {
        $response = [
            'user' => [
                'profilePicture' => $this->user->getProfilePicture(),
                'fullName' => $this->user->getFullName(),
                'id' => $this->user->getUserId()
            ],
            'postSince' => $this->postSince(),
            'content' => $this->content,
            'reaction' => array_column($this->reaction, 'id_account'),
            'accountId' => $this->accountId,
            'postId' => $this->postId
        ];
        return $response;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getIdAccount()
    {
        return $this->accountId;
    }
}

class Reaction
{
    private $postId;
    private $accountId;
    private $reaction;

    public function getReaction()
    {
        return $this->reaction;
    }
    private $connection;

    public function __construct($connection, $postId, $accountId)
    {
        $this->connection = $connection;
        $this->postId = $postId;
        $this->accountId = $accountId;
        $this->loadReaction();
    }

    private function loadReaction()
    {
        $request = $this->connection->prepare('SELECT * FROM post_reaction WHERE id_post = ? AND id_account = ?');
        $request->bindParam(1, $this->postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->accountId, PDO::PARAM_INT);
        $request->execute();
        $this->reaction = $request->fetch();
    }
}

class Comment
{
    private $postId;
    private $accountId;
    private $comment;
    private $connection;

    public function __construct($connection, $postId, $accountId)
    {
        $this->connection = $connection;
        $this->postId = $postId;
        $this->accountId = $accountId;
        $this->loadComment();
    }

    private function loadComment()
    {
        $request = $this->connection->prepare('SELECT * FROM comment WHERE id_post = ? AND id_account = ?');
        $request->bindParam(1, $this->postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->accountId, PDO::PARAM_INT);
        $request->execute();
        $this->comment = $request->fetch();
    }

    public function getContent()
    {
        return $this->comment['content'];
    }

    public function getFullName()
    {
        $request = $this->connection->prepare('SELECT first_name, last_name FROM account WHERE id = ?');
        $request->bindParam(1, $this->accountId, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return $result['first_name'] . ' ' . $result['last_name'];
    }

    public function getProfilePicture()
    {
        $request = $this->connection->prepare('SELECT profile_picture FROM account WHERE id = ?');
        $request->bindParam(1, $this->accountId, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return $result['profile_picture'] ?? "./src/assets/images/1.webp";
    }

    public function getIdAccount()
    {
        return $this->accountId;
    }

    public function getCommentSince()
    {
        $request = $this->connection->prepare('SELECT created_at FROM comment WHERE id_post = ? AND id_account = ?');
        $request->bindParam(1, $this->postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->accountId, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();

        $date = new DateTime($result['created_at']);
        $now = new DateTime();
        $interval = $now->diff($date);

        if ($interval->y > 0) return $interval->y . 'y';
        if ($interval->m > 0) return $interval->m . 'm';
        if ($interval->d > 0) return $interval->d . 'd';
        if ($interval->h > 0) return $interval->h . 'h';
        if ($interval->i > 0) return $interval->i . 'm';
        return $interval->s . 's';
    }

    public function getUserReacted($accountId)
    {
        $request = $this->connection->prepare('SELECT * FROM comment_reaction WHERE id_comment = ? AND id_account = ?');
        $request->bindParam(1, $this->comment['id'], PDO::PARAM_INT);
        $request->bindParam(2, $accountId, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return $result ? true : false;
    }
}

function getPostList($connection)
{
    $request = $connection->prepare('SELECT id FROM post ORDER BY created_at DESC');
    $request->execute();
    return $request->fetchAll();
}

// $postsId = getPostList($connection);

class UserPost extends User
{
    public function getPosts()
    {
        global $postsId;
        foreach ($postsId as $post) {
            $post = new Post($this->connection, $post['id']);
            $post->postData();
        }
    }
}
