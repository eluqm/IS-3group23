<?php
require_once '../config/conexion.php';

class User {

    public function register($data){
        $sql = "INSERT INTO users (usersName, usersUid,usersEmail, usersPwd) VALUES (:usersName,:usersEmail,:usersUid,:usersPwd)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usersName', $_POST['usersName']);
        $stmt->bindParam(':usersUid', $_POST['usersUid']);
        $stmt->bindParam(':usersEmail', $_POST['usersEmail']);
        $password = password_hash($_POST['usersPwd'], PASSWORD_BCRYPT);
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