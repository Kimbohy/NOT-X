<?php

include "../../config.php";

class User
{
    private $id = 0;
    private $firstName = '';
    private $lastName = '';
    private $email = '';
    private $profilePicture = '';
    private $connection;

    public function __construct($connection, $id)
    {
        $this->connection = $connection;
        $this->loadUserData($id);
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

    public function publishComponent()
    {
?>
        <div class="flex flex-col gap-3 p-2">
            <div class="p-3 bg-post rounded-xl">
                <form action="" method="post">
                    <textarea name="content" id="content" cols="30" rows="5" class="w-full p-2 rounded-xl" placeholder="What's on your mind?"></textarea>
                    <button type="submit" class="w-full p-2 bg-casse rounded-xl">Publish</button>
                </form>
            </div>
        </div>
    <?php
    }

    public function addReaction($postId, $reaction)
    {
        $request = $this->connection->prepare('INSERT INTO post_reaction (id_post, id_account, reaction) VALUES (?, ?, ?)');
        $request->bindParam(1, $postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->bindParam(3, $reaction, PDO::PARAM_STR);
        $request->execute();
    }

    public function addComment($postId, $content)
    {
        $request = $this->connection->prepare('INSERT INTO post_comment (id_post, id_account, content) VALUES (?, ?, ?)');
        $request->bindParam(1, $postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->id, PDO::PARAM_INT);
        $request->bindParam(3, $content, PDO::PARAM_STR);
        $request->execute();
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
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

    public function PostComponent()
    {
    ?>
        <div class="p-3 bg-post rounded-xl">
            <div class="flex items-end gap-2">
                <img src='<?php echo $this->user->getProfilePicture(); ?>' alt="profilPicture" class="h-10 rounded-full">
                <h2 class="text-xl text-maron"><?php echo $this->user->getFullName(); ?></h2>
                <p class="text-lg text-gris "><?php echo $this->postSince(); ?></p>
            </div>
            <p class="p-5"><?php echo $this->content; ?></p>
            <div class="flex gap-2">
                <?php
                echo in_array($this->accountId, array_column($this->reaction, 'id_account')) ?
                    '<img src="./src/assets/icons/Heart.svg" alt="heart" class="h-6">' :
                    '<img src="./src/assets/icons/Heart2.svg" alt="heart2" class="h-6">';
                ?>
                <img src="./src/assets/icons/Message square.svg" alt="message" class="h-6">
            </div>
        </div>
<?php
    }
}

class Reaction
{
    private $postId;
    private $accountId;
    private $reaction;
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
        $request = $this->connection->prepare('SELECT * FROM post_comment WHERE id_post = ? AND id_account = ?');
        $request->bindParam(1, $this->postId, PDO::PARAM_INT);
        $request->bindParam(2, $this->accountId, PDO::PARAM_INT);
        $request->execute();
        $this->comment = $request->fetch();
    }
}

function getPostList($connection)
{
    $request = $connection->prepare('SELECT id FROM post ORDER BY created_at DESC');
    $request->execute();
    return $request->fetchAll();
}

$postsId = getPostList($connection);
