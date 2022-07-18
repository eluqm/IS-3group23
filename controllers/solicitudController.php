<?php
require_once '../helpers/session_helper.php';

require_once '../models/pregunta.php';
require_once '../models/solicitud.php';

class SolicitudController {
    private $solicitud;
    private $pregunta;
    
    public function __construct(){
        $this->solicitud=new Solicitud();
        $this->pregunta=new Pregunta();
    }

    public function go_to_formulario_revision_pregunta(){
        $this->verificar_sesion();
        if(!isset($_GET['id_pregunta'])){
            redirect("../views/login.php");
        }
        $datos_pregunta = $this->pregunta->findQuestionById($_GET['id_pregunta']);
        require_once("../views/user__form_revisar_pregunta.php");
    }

    public function crear_solicitud_revision(){
        $this->verificar_sesion();
        $data['id_pregunta']=$_POST['id_pregunta'];
        $data['cui_usuario']=$_SESSION['usersCUI'];
        $data['descripcion']=$_POST['razon'];
        date_default_timezone_set("America/Lima");
        $data['fecha_creacion']=date('Y-m-d H:i:s');

        //verificar si no hay una solicitud con una misma pregunta
        if($this->solicitud->search_by_id_pregunta($data['id_pregunta'])==0){
            $this->solicitud->store_solicitud_revision_pregunta($data);
        }
        redirect("../index.php");        
    }

    public function verificar_sesion(){
        //session_start();
        if(!isset($_SESSION['usersCUI'])){
            redirect("../views/login.php");
            return 0;
        }
        else{
            return 1;
        }
    }

}

$init = new SolicitudController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['action']){
        case 'crear_solicitud_revision':
            $init->crear_solicitud_revision();
            break;
        default:
            redirect("../views/login.php");
    }
} else 
{
    switch($_GET['action']){
        case 'go_to_formulario_revision':
            $init->go_to_formulario_revision_pregunta();
            break;
        default:
                redirect("../views/login.php");
    }
}

?>