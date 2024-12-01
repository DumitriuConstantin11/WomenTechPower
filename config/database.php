<?php
class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "women_tech_power";
    private $conn;
    function __construct() {
        try {

            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user,
                $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
        } catch (PDOException $e) {
                die("Eroare la conectare: " . $e->getMessage());
        }
    }
    public function getDBResult($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Eroare: " . $e->getMessage();
            throw new Exception("Eroare la executarea interogării: " . $e->getMessage());
        }
    }
    public function updateDB($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Eroare la executarea interogării: " . $e->getMessage());
        }
    }
    public function getConnection() {
        return $this->conn;
    }
}
?>