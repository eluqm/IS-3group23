<?php
require_once $GLOBALS['BASE_DIR'].'/models/pregunta.php';
require_once $GLOBALS['BASE_DIR'].'/models/curso.php';
require_once $GLOBALS['BASE_DIR'].'/models/solicitud.php';
class AdminController {

    private $curso;
    private $solicitud;
    private $pregunta;
    
    public function __construct(){
        $this->curso=new Curso();
        $this->solicitud=new Solicitud();
        $this->pregunta=new Pregunta();
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
                redirect(url('admin_ver_reporte_pregunta',['estado_reporte' => 'pendiente']));
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
        require_once($GLOBALS['BASE_DIR'].'/views/admin__solicitudes-registro.php');
    }

    public function solicitud_revision_pregunta($TIPO_SOLICITUD){
        $this->verificar_sesion();
        //procesar tipo de solicitud
        $tipo_solicitud = $this->get_tipo_solicitud($TIPO_SOLICITUD);
        // obtener los anios para la barra de navegacion
        $anios_registrados=$this->curso->get_anios();
        //obtener las solicitudes
        $solicitud_registro =$this->solicitud->getSolicitudedeRevisionDePreguntaPorEstado($tipo_solicitud);
        require_once($GLOBALS['BASE_DIR'].'/views/admin__solicitudes-preguntas.php');
    }

    public function go_to_formulario_eliminar(){
        $this->verificar_sesion();
        if(!isset($_POST['id_pregunta']) || !isset($_POST['modo'])){
            redirect(url('index'));
        }
        /*
        0 -> aceptar solicitud de eliminacion
        1 -> eliminar sin solicitud
        2 -> ignorar solicitud de eliminacion
        */
        $action_solicitud = $_POST['modo'];
        $datos_pregunta = $this->pregunta->findQuestionById($_POST['id_pregunta']);
        require_once($GLOBALS['BASE_DIR'].'/views/admin__form_borrar_pregunta.php');

    }

    public function go_to_formulario_denegar_registro(){
        $this->verificar_sesion();
        if(!isset($_POST['id_solicitud_registro'])){
            redirect(url('index'));
        }
        $datos_registro = $this->solicitud->search_SolicitudRegistro_by_ID($_POST['id_solicitud_registro']);
        require_once($GLOBALS['BASE_DIR'].'/views/admin__form_denegar_registro.php');

    }
    
    public function solicitud_pregunta_procesada(){
        $this->verificar_sesion();
        /*
        0 -> aceptar solicitud de eliminacion
        1 -> eliminar sin solicitud
        2 -> ignorar solicitud de eliminacion
        */
        $action = $_POST['action'];
        $data['id_pregunta']=$_POST['id_pregunta'];
        $data['cui_usuario']=$_SESSION['usersCUI'];
        $data['descripcion']=$_POST['razon'];
        date_default_timezone_set("America/Lima");
        $data['fecha_creacion']=date('Y-m-d H:i:s');
        if($action==0){
            $this->solicitud->solicitud_eliminacion_aceptar($data);
            redirect(url('admin_ver_reporte_pregunta',['estado_reporte' => 'aceptada']));
        }
        elseif($action ==1) {
            //verificar si no hay una solicitud con una misma pregunta
            if($this->solicitud->search_by_id_pregunta($data['id_pregunta'])==0){
                $this->solicitud->store_solicitud_revision_pregunta($data);
                $this->solicitud->solicitud_eliminacion_aceptar($data);
            }
            redirect(url('admin_ver_reporte_pregunta',['estado_reporte' => 'aceptada']));
        }
        elseif($action ==2){
            $this->solicitud->solicitud_eliminacion_denegada($data);
            redirect(url('admin_ver_reporte_pregunta',['estado_reporte' => 'denegada']));
        }
    }

    public function solicitud_registro_procesada(){
        $this->verificar_sesion();
        $data['estado']=$_POST['estado'];
        $data['cui_new_user']=$_POST['cui_new_user'];
        $data['id_solicitud']=$_POST['id_solicitud'];
        $data['cui_admin']=$_SESSION['usersCUI'];
        if($_POST['estado']==1){
            $data['razon']="Conforme";
        }else {
            $data['razon']=$_POST['razon'];
        }
        date_default_timezone_set("America/Lima");
        $data['fecha']=date('Y-m-d H:i:s');
        $this->solicitud->solicitud_registro_procesar($data);
        redirect(url('admin_ver_solicitud_registro',['estado_solicitud' => 'pendiente']));
    }

    public function verificar_sesion(){
        //session_start();
        if(!isset($_SESSION['usersCUI']) || $_SESSION['admin']!=1){
            redirect(url('login'));
            return 0;
        }
        else{
            return 1;
        }
    }

}
?>