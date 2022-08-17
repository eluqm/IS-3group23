<?php
namespace IS3group3\Tests\Pregunta;

use IS3group3\Config\Database;

abstract class DatabaseTestCase extends \PHPUnit_Extensions_Database_TestCase
{
    static private $adapter = null;
    static private $pdo = null;
    private $conn = null;

    final public function getAdapter()
    {
        if (self::$adapter == null) {
            self::$adapter = new Database;
        }

        return self::$adapter;
    }

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                $dbAdapter = $this->getAdapter();
                self::$pdo = $dbAdapter->getConn();
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo);
        }
        return $this->conn;
    }
}
