<?php

require_once '../models/Post.php';
class PostController
{
    private $post;

    public function __construct($db)
    {
        $this->post = new Post($db);
    }

    public function create($data)
    {
        if (empty($data['content']) || empty($data['id_account'])) {
            return array('error' => 'Please fill all input fields', 'status' => 400);
        }

        // create a new post
        $this->post->content = $data['content'];
        $this->post->id_account = $data['id_account'];

        if ($this->post->create()) {
            return array('message' => 'Post created successfully', 'status' => 200);
        } else {
            return array('error' => 'Post could not be created', 'status' => 400);
        }
    }

    public function getPosts()
    {
        $posts = $this->post->getAll();

        if ($posts) {
            return json_encode($posts);
        } else {
            return json_encode(['error' => 'Aucun post trouvé']);
        }
    }
}
