<?php

require_once '../models/Account.php';
class AccountController
{
    private $account;

    public function __construct($db)
    {
        session_start();
        $this->account = new Account($db);
    }

    public function register($data)
    {
        // check if all input is filled
        if (!isset($data['first_name']) || !isset($data['last_name']) || !isset($data['email']) || !isset($data['password']) || !isset($data['profile_picture'])) {
            return array('message' => 'Please fill all input fields', 'status' => 400);
        }

        // check if the email is unique
        if ($this->account->emailExists($data['email'])) {
            return array('message' => 'Email already exists', 'status' => 400);
        }

        // create a new user
        $this->account->first_name = $data['first_name'];
        $this->account->last_name = $data['last_name'];
        $this->account->email = $data['email'];
        $this->account->password = $data['password'];

        // upload the profile picture
        $this->account->profile_picture = $data['profile_picture'];
        $this->account->profile_picture = $this->account->uploadProfilePicture();

        if ($this->account->create()) {
            return array('message' => 'User created successfully', 'status' => 200);
        } else {
            return array('error' => 'User could not be created', 'status' => 400);
        }
    }
    public function login($data)
    {
        // check if the input is valid
        if (!isset($data['email']) || !isset($data['password'])) {
            return array('error' => 'Please fill all input fields', 'status' => 400);
        }

        // check if the user exists
        $account = $this->account->getByEmail($data['email']);

        if ($account && ($data['password'] == $account['password'])) {
            // start the session
            $_SESSION['id'] = $account['id'];
            return array('message' => 'User authenticated', 'status' => 200);
        } else {
            return array('error' => 'User could not be authenticated', 'status' => 400);
        }
    }

    public function logout()
    {
        session_destroy();
        return array('message' => 'User logged out', 'status' => 200);
    }
}
