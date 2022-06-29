<?php
require '../config/conexion.php';

class User {

    public function register($data){
        $sql = "INSERT INTO users (cui, nombre, correo_electronico, contrasenia) VALUES (:usersCUI,:usersName,:usersEmail,:usersPwd)";
        $stmt = $conn->prepare("INSERT INTO users (cui, nombre, correo_electronico, contrasenia) VALUES (:usersCUI,:usersName,:usersEmail,:usersPwd)");
        $stmt->bindParam(':usersCUI', $data['usersCUI']);
        $stmt->bindParam(':usersName', $data['usersName']);
        $stmt->bindParam(':usersEmail', $data['usersEmail']);
        $stmt->bindParam(':usersPwd', $data['usersPwd']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($nameOrEmail, $password){
    }

}