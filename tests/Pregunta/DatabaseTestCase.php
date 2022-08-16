<?php
namespace IS3group3\Tests\Pregunta;

use Config\conexionDatabase;


abstract class DatabaseTestCase extends \PHPUnit_Extensions_Database_TestCase
{
    static private $adapter = null;
    static private $pdo = null;
    private $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$adapter = new conexionDatabase;
                self::$pdo = self::$adapter;
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo);
        }
        return $this->conn;
    }
}
?>