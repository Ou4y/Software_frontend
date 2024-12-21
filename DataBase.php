<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'X'; // Your database name
    private $username = 'root';
    private $password = ''; // Your database password (empty for local development)

    public function getConnection()
    {
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
