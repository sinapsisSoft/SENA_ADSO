<?php
/**
 * Author:DIEGO CASALLAS
 * Date:08/11/2024
 * Descriptions: This is the connection class for MySQL
*/
namespace App\Config;

use Exception;
use PDO;
class ConnectDB
{
  private $host;
  private $user;
  private $password;
  private $db;
  private $charset;
  private $dsn;
  protected $pdo;

/**
 * The function sets up database connection parameters for a PHP application.
 */
  public function __construct()
  {
    $this->host = '127.0.0.1';
    $this->user = 'root';
    $this->password = '';
    $this->db = 'crud-php-app';
    $this->charset = 'utf8mb4';
    $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
  }

/**
 * The function `connect` establishes a connection to a database using PDO in PHP and sets error
 * handling mode to throw exceptions.
 * 
 * @return The `connect()` function is returning the PDO object after establishing a connection to the
 * database.
 */
  public function connect()
  {
    try {
      $this->pdo = new PDO($this->dsn, $this->user, $this->password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      echo ('Connection error: ' . $e->getMessage());
    }
    return $this->pdo;
  }
}

