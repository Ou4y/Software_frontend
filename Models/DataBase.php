<?php
class Database
{
    private static $instance = null;
    private $connection;
    private $host = 'localhost';
    private $dbname = 'X'; // Replace with your database name
    private $username = 'root';
    private $password = ''; // Replace with your database password

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Use native prepared statements
            $this->connection->exec("SET sql_mode = '';"); // Disable strict SQL mode if needed
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

?>
