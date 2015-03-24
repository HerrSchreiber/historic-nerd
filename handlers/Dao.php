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

    public function getUsers () {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM users");
    }

    public function getSalt ($email) {
        $conn = $this->getConnection();
        $getQuery = "SELECT Salt FROM users WHERE Email = :email";
        $q = $conn->prepare($getQuery);
        $q->bindParam(':email', $email);
        $q->execute();
        return reset($q->fetchAll());
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
}