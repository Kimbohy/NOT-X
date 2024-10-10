<?php
class Account
{
    private $conn;
    private $table_name = "account";

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $profile_picture;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create a new user
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email, password, profile_picture) VALUES (:first_name, :last_name, :email, :password, :profile_picture)";

        $stmt = $this->conn->prepare($query);

        // clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->profile_picture = htmlspecialchars(strip_tags($this->profile_picture));

        // bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':profile_picture', $this->profile_picture);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // check if the email is unique
    public function emailExists($email)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // upload the profile picture
    public function uploadProfilePicture()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        // check file size
        if ($_FILES["profile_picture"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        // check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "";
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                return "";
            }
        }
    }

    public function getByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
