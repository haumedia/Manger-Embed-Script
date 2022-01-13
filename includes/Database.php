<?php
error_reporting(0);
ini_set('display_errors', 0);
// Config
$domain = 'http://localhost/'; //Don't Remove the Mark / At the End of the Url
class Database {
    private $dbServer = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbName = 'getlink';
    protected $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->dbServer}; dbname={$this->dbName}; charset=utf8";
            $options = array(PDO::ATTR_PERSISTENT);
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
	 public function getDb() {
       if ($this->conn instanceof PDO) {
            return $this->conn;
       }
 }
}
