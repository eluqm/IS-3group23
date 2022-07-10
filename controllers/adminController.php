<?php
require_once '../models/pregunta.php';
require_once '../models/curso.php';
require_once '../models/solicitud.php';

class AdminController {
    public function solicitud_registro($TIPO_SOLICITUD){
        session_start();
        // obtener los anios para la barra de navegacion
        $curso=new Curso();
        $anios_registrados=$curso->get_anios();
        //obtener las solicitudes
        $solicitud=new Solicitud();
        switch ($TIPO_SOLICITUD){
            case 'pendiente':
                $tipo_solicitud=0;
                $solicitud_registro = $solicitud->getSolicitudedeRegistroPorEstado(0);
                break;
            case 'aceptada':
                $tipo_solicitud=1;
                $solicitud_registro = $solicitud->getSolicitudedeRegistroPorEstado(1);
                break;
            case 'denegada':
                $tipo_solicitud=2;
                $solicitud_registro = $solicitud->getSolicitudedeRegistroPorEstado(2);
                break;
            default:
                redirect("../views/login.php");
        }
        require_once("../views/admin__solicitudes-registro.php");
    }

    public function solicitud_revision_pregunta($SOLICITUD){
        session_start();
        // obtener los anios para la barra de navegacion
        $curso=new Curso();
        $anios_registrados=$curso->get_anios();
        //obtener las solicitudes
        $solicitud=new Solicitud();
        $solicitud_registro = $solicitud->getSolicitudedeRegistroPorEstado(0);
        require_once("../views/admin__solicitudes.php");
    }

}
$init = new AdminController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['action']){
        default:
            redirect("../views/login.php");
    }
}
else
{
switch($_GET['action']){
    case 'solicitudRegistro':
        $init->solicitud_registro($_GET['solicitud']);
        break;
    case 'profile':
    default:
            redirect("../views/login.php");
    }
}

?>