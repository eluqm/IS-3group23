<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'IS3';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
      } catch (PDOException $e) {
        die('Connection Failed: ' . $e->getMessage());
      }
}