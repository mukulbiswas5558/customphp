<?php
class Database {
    private $host = 'localhost';
    private $dbName = 'pagemaker'; // Change this to your database name
    private $username = 'root'; // Change this to your database username
    private $password = ''; // Change this to your database password
    private $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>