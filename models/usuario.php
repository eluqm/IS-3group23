<?php
require_once '../config/conexion.php';

class User {

    private $db;

    public function __construct(){
        $this->db = new database;
    }

    public function register($data){
        $this->db->query('INSERT INTO `usuario` (`cui`, `nombre`, `correo_electronico`, `contrasenia`, `estado_cuenta`)
        VALUES (:usersCUI, :usersName, :usersEmail, :usersPwd, 0)');
        $this->db->bind(':usersCUI', $data['usersCUI']);
        $this->db->bind(':usersName', $data['usersName']);
        $this->db->bind(':usersEmail', $data['usersEmail']);
        $this->db->bind(':usersPwd', $data['usersPwd']);
        if($this->db->execute()){
            return true;
        }
        return false;
    }

    public function register_in_solicitud($data)
    {
        $this->db->query('INSERT INTO `solicitud_registro`
        (`fecha_creacion`, `user_cui`, `dni`, `estado`,
        `admin_encargado`, `fecha_atencion`, `admin_nota`)
        VALUES (NOW(), :cui, :dni, 0, NULL, NULL, NULL)');
        $this->db->bind(':cui', $data['usersCUI']);
        $this->db->bind(':dni', $data['usersDNI']);
        if($this->db->execute()){
            return true;
        }
        return false;
    }
    public function add_description($data)
    {
        $this->db->query('INSERT INTO `perfil` (`descripcion`, `cui`)
        VALUES ("Remember update your description", :cui)');
        $this->db->bind(':cui', $data['usersCUI']);
        if($this->db->execute()){
            return true;
        }
        return false;
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

    public function isAdmin($CUI){
        $this->db->query('SELECT * FROM administrador WHERE cui = :CUI');
        $this->db->bind(':CUI', $CUI);
        
        $this->db->single();
        
        if($this->db->rowCount() > 0){
            return 1;
        }
        return 0;
    }

    public function login($email, $password){
        $row = $this->findUserByEmail($email);

        if($row == false)
        {
            return false;
        }
        
        if($row->contrasenia==$password){
            $row->admin = $this->isAdmin($row->cui);
            return $row;
        }
        return false;   
    }

    public function getProfile($CUI){
        $this->db->query('SELECT perfil.descripcion, usuario.nombre FROM perfil INNER JOIN usuario ON usuario.cui=perfil.cui WHERE usuario.cui=:CUI');
        $this->db->bind(':CUI', $CUI);
        
        $row = $this->db->single();
        
        if($this->db->rowCount() > 0){
            return $row;
        }
        return false;
    }

    public function getMisPreguntas($CUI){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' from pregunta INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE pregunta.cui_usuario=:CUI");
        $this->db->bind(':CUI', $CUI);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

    public function getMisMentorias($CUI){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' from pregunta INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE pregunta.cui_mentor=:CUI");
        $this->db->bind(':CUI', $CUI);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }
    
    public function update_perfil($data){
        $this->db->query("UPDATE perfil SET descripcion=:descripcion WHERE cui=:CUI");
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':CUI', $data['CUI']);
        if($this->db->execute()){
            return true;
        }
        return false;            
    }
}