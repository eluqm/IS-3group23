<?php
require_once '../models/pregunta.php';
require_once '../models/curso.php';
require_once '../models/solicitud.php';

class AdminController {

    private $curso;
    private $solicitud;
    
    public function __construct(){
        $this->curso=new Curso();
        $this->solicitud=new Solicitud();
    }

    public function get_tipo_solicitud($TIPO_SOLICITUD){
        switch ($TIPO_SOLICITUD){
            case 'pendiente':
                $tipo_solicitud=0;
                break;
            case 'aceptada':
                $tipo_solicitud=1;
                break;
            case 'denegada':
                $tipo_solicitud=2;
                break;
            default:
                redirect("../views/login.php");
                break;
        }
        return $tipo_solicitud;
    }
    public function solicitud_registro($TIPO_SOLICITUD){
        $this->verificar_sesion();
        //procesar tipo de solicitud
        $tipo_solicitud = $this->get_tipo_solicitud($TIPO_SOLICITUD);
        // obtener los anios para la barra de navegacion
        $anios_registrados=$this->curso->get_anios();
        //obtener las solicitudes
        $solicitud_registro = $this->solicitud->getSolicitudedeRegistroPorEstado($tipo_solicitud);
        require_once("../views/admin__solicitudes-registro.php");
    }

    public function solicitud_revision_pregunta($TIPO_SOLICITUD){
        $this->verificar_sesion();
        //procesar tipo de solicitud
        $tipo_solicitud = $this->get_tipo_solicitud($TIPO_SOLICITUD);
        // obtener los anios para la barra de navegacion
        $anios_registrados=$this->curso->get_anios();
        //obtener las solicitudes
        $solicitud_registro =$this->solicitud->getSolicitudedeRevisionDePreguntaPorEstado($tipo_solicitud);
        require_once("../views/admin__solicitudes-preguntas.php");
    }

    public function verificar_sesion(){
        session_start();
        if(!isset($_SESSION['usersCUI']) || $_SESSION['admin']!=1){
            redirect("../views/login.php");
            return 0;
        }
        else{
            return 1;
        }
    }

}

$init = new AdminController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['action']){
        default:
            redirect("../views/login.php");
    }
} else 
{
    switch($_GET['action']){
        case 'solicitudRegistro':
            $init->solicitud_registro($_GET['solicitud']);
            break;
        case 'solicitudRevisionPregunta':
            $init->solicitud_revision_pregunta($_GET['solicitud']);
            break;
        case 'profile':
        default:
                redirect("../views/login.php");
    }
}

?>