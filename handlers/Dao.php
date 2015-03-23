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
}