<?php
require_once '../config/conexion.php';

class User {

    public function register($data){
        $sql = "INSERT INTO users (usersName, usersUid,usersEmail, usersPwd) VALUES (:usersName,:usersEmail,:usersUid,:usersPwd)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usersName', $data['usersName']);
        $stmt->bindParam(':usersUid', $data['usersUid']);
        $stmt->bindParam(':usersEmail', $data['usersEmail']);
        $password = password_hash($data['usersPwd'], PASSWORD_BCRYPT);
        $stmt->bindParam(':usersPwd', $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($nameOrEmail, $password){
    }

}