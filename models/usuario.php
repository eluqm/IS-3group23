<?php
require '../config/conexion.php';

class User {

    private $db;

    public function __construct(){
        $this->db = new database;
    }

    public function register($data){
        $this->db->query('INSERT INTO usuario (cui, nombre, correo_electronico, contrasenia)
        VALUES (:usersCUI, :usersName, :usersEmail, :usersPwd)');
        $this->db->bind(':usersCUI', $data['usersCUI']);
        $this->db->bind(':usersName', $data['usersName']);
        $this->db->bind(':usersEmail', $data['usersEmail']);
        $this->db->bind(':usersPwd', $data['usersPwd']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM usuario WHERE correo_electronico = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function login($email, $password){
        $row = $this->findUserByEmail($email);

        if($row == false)
        {
            return false;
        }
        
        if($row->contrasenia==$password){
            return $row;
        }else{
            return false;
        }

        return $row;
    }
}