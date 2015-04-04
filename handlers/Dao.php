<?php
// Dao.php
// class for saving and getting comments from MySQL
class Dao {

    private $host = "localhost";
    private $db = "rschreib";
    private $user = "rschreib";
    private $pass = "ILoveAshley"; // Not used for anything other than this project, sorry

    public function getConnection () {
        return
            new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
                $this->pass);
    }

    public function getUsersByName ($name) {
        $conn = $this->getConnection();
        $getQuery = "SELECT * FROM users WHERE UserName = :name";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":name", $name);
        $q->execute();
        return $q->fetch(PDO::FETCH_ASSOC);
    }


    public function createUser ($email, $userName, $password) {
        $salt = base64_encode(openssl_random_pseudo_bytes(12));
        $saltedPassword = hash('sha256', $password . $salt);
        $conn = $this->getConnection();
        $createQuery = "INSERT INTO users (Email, UserName, SaltedPassword, Salt, DateJoined, Admin) VALUES(:email, :userName, :saltedPassword, :salt, NOW(), 0)";
        $q = $conn->prepare($createQuery);
        $q->bindParam(':email', $email);
        $q->bindParam(':userName', $userName);
        $q->bindParam(':saltedPassword', $saltedPassword);
        $q->bindParam(':salt', $salt);
        $q->execute();
    }

    public function getUser ($email) {
        $conn = $this->getConnection();
        $getQuery = "SELECT UserName, Admin from users WHERE email = :email";
        $q = $conn->prepare($getQuery);
        $q->bindParam(':email', $email);
        $q->execute();
        return $q->fetch();
    }

    public function checkPassword ($email, $password) {
        $conn = $this->getConnection();
        $getQuery = "SELECT Salt, SaltedPassword from users WHERE email = :email";
        $q = $conn->prepare($getQuery);
        $q->bindParam(':email', $email);
        $q->execute();
        $dbResults = $q->fetch();
        $saltedPassword = hash('sha256', $password . $dbResults['Salt']);
        return $saltedPassword === $dbResults['SaltedPassword'];
    }

    public function createVideo ($title, $ytid, $tags) {
        $conn = $this->getConnection();
        $createQuery = "INSERT INTO videos (Title, YouTubeVideoID, DateAdded, Tags) VALUES(:title, :ytid, NOW(), :tags)";
        $q = $conn->prepare($createQuery);
        $q->bindParam(':title', $title);
        $q->bindParam(':ytid', $ytid);
        $q->bindParam(':tags', $tags);
        $q->execute();
    }

    public function createPost ($title, $tags, $post) {
        $conn = $this->getConnection();
        $createQuery = "INSERT INTO blogposts (Title, Post, DateAdded, Tags) VALUES(:title, :post, NOW(), :tags)";
        $q = $conn->prepare($createQuery);
        $q->bindParam(':title', $title);
        $q->bindParam(':post', $post);
        $q->bindParam(':tags', $tags);
        $q->execute();
    }

    public function getRecentVideos () {
        $conn = $this->getConnection();
        $getQuery = "SELECT Title, ID FROM videos ORDER BY DateAdded";
        $q = $conn->prepare($getQuery);
        $q->execute();
        $dbResults = $q->fetchAll();
        return $dbResults;
    }

    public function getRecentPosts () {
        $conn = $this->getConnection();
        $getQuery = "SELECT Title, ID FROM blogposts ORDER BY DateAdded";
        $q = $conn->prepare($getQuery);
        $q->execute();
        $dbResults = $q->fetchAll();
        return $dbResults;
    }

}