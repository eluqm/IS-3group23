<?php
require_once __DIR__.'/../config/conexion.php';

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
        $this->db->bind(':fecha_publicacion', $data['fecha_publicacion']);
        $this->db->bind(':fecha_limite', $data['fecha_limite']);
        $this->db->bind(':disponibilidad', $data['horDisp']);

        if($this->db->execute())
            return true;
            
        return false;
    }

    public function get_all(){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id INNER JOIN curso ON curso.idcurso=pregunta.curso");
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

    public function get_all_by_tema($TEMA){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id  INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE tema=:tema");
        $this->db->bind(':tema', $TEMA);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }
  
    public function get_all_by_curso($CURSO){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id  INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE curso=:curso");
        $this->db->bind(':curso', $CURSO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }
    
    public function get_all_by_curso_and_tema($CURSO,$TEMA){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id  INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE pregunta.tema=:tema AND pregunta.curso=:curso");
        $this->db->bind(':tema', $TEMA);
        $this->db->bind(':curso', $CURSO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

    public function get_all_by_anio($ANIO){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE curso.anio=:anio");
        $this->db->bind(':anio', $ANIO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

    /*
        0 => abierta
        1 => cerrada
    */
    public function get_all_by_estado_and_curso($ESTADO,$CURSO){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id  INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE pregunta.curso=:curso AND pregunta.estado=:estado");
        $this->db->bind(':curso', $CURSO);
        $this->db->bind(':estado', $ESTADO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

    public function get_all_by_estado($ESTADO){
        $this->db->query("SELECT pregunta.*, curso.nombre 'nombre_curso' FROM pregunta_no_rechazada INNER JOIN pregunta on pregunta_no_rechazada.id=pregunta.id  INNER JOIN curso ON curso.idcurso=pregunta.curso WHERE pregunta.estado=:estado");
        $this->db->bind(':estado', $ESTADO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

    public function findQuestionById($id) {
        $this->db->query('SELECT * FROM pregunta WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    // editar pregunta
    public function edit($data) {
        $this->db->query('UPDATE pregunta SET titulo=:titulo, descripcion=:descripcion WHERE id=:id');
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':id', $data['id']);

        if($this->db->execute())
            return true;
            
        return false;
    }

}