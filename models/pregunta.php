<?php
require '../config/conexion.php';

class Pregunta {

    private $db;

    public function __construct(){
        $this->db = new database;
    }

    public function register($data){
        $this->db->query('INSERT INTO pregunta (id, titulo, descripcion, curso, tema, fecha_publicacion,cui_usuario,disponibilidad,estado,fecha_limite)
        VALUES (0,:titulo, :descripcion, :curso, :tema, :fecha_publicacion, 20008080 , :disponibilidad, 0 , :fecha_limite)');
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':curso', $data['curso']);
        $this->db->bind(':tema', $data['tema']);
        $this->db->bind(':fecha_publicacion', $data['fecha_limite']);
        $this->db->bind(':fecha_limite', $data['fecha_limite']);
        $this->db->bind(':disponibilidad', $data['disponibilidad']);

        if($this->db->execute())
            return true;
            
        return false;
    }

}