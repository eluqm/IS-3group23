<?php
require_once $GLOBALS['BASE_DIR'].'/models/pregunta.php';
require_once $GLOBALS['BASE_DIR'].'/models/solicitud.php';

class SolicitudController {
    private $solicitud;
    private $pregunta;
    
    public function __construct(){
        $this->solicitud=new Solicitud();
        $this->pregunta=new Pregunta();
    }

    public function go_to_formulario_revision_pregunta($id_pregunta){
        $this->verificar_sesion();
        //NOTA: VERIFICAR QUE LA PREGUNTA EXISTE
        $datos_pregunta = $this->pregunta->findQuestionById($id_pregunta);
        require_once($GLOBALS['BASE_DIR'].'/views/user__form_revisar_pregunta.php');
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
        redirect(url('index'));        
    }

    public function verificar_sesion(){
        //session_start();
        if(!isset($_SESSION['usersCUI'])){
            redirect(url('login'));
            return 0;
        }
        else{
            return 1;
        }
    }

}
?>