<?php
namespace App\Config;

use PDO;
use PDOException;

class ConnectDB {
    private $host;
    private $db;
    private $user;
    private $pass ;
    private $charset;
    private $dsn='';
    protected $pdo;

    public function __construct() {
     
         $this->host = '127.0.0.1';
         $this->db = 'crud-php-app';
         $this->user = 'root';
         $this->pass = '';
         $this->charset = 'utf8mb4';
         $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        
    }

    public function connect(){
      try {
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection error: ' . $e->getMessage();
    }
    return $this->pdo;
    }
}
