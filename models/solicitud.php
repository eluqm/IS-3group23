<?php
require_once __DIR__.'/../config/conexion.php';

class Solicitud {

    private $db;

    public function __construct(){
        $this->db = new database;
    }

    /*
        0 => Pendiente
        1 => Aceptada
        2 => Denegada
    */
    public function getSolicitudedeRegistroPorEstado($ESTADO){
        $this->db->query("SELECT r.fecha_creacion,u.cui,u.nombre,u.correo_electronico,r.dni FROM SOLICITUD_REGISTRO r INNER JOIN USUARIO u ON u.cui = r.user_cui WHERE r.estado=:estado");
        $this->db->bind(':estado', $ESTADO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }
    /*
        0 => Pendiente
        1 => Aceptada
        2 => Denegada
    */
    public function getSolicitudedeRevisionDePreguntaPorEstado($ESTADO){
        $this->db->query("SELECT r.* , p.titulo , p.descripcion FROM solicitud_revision_pregunta r INNER JOIN pregunta p ON r.id_pregunta = p.id WHERE r.estado=:estado");
        $this->db->bind(':estado', $ESTADO);
        $row = $this->db->resultSet();
        if($this->db->rowCount() > 0){
            return $row; 
        }
        return 0;
    }

}