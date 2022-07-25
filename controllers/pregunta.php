<?php

require_once '../models/pregunta.php';
require_once '../models/curso.php';
require_once '../helpers/session_helper.php';

class PreguntaController {

    private $preguntaModel;
    private $curso;
    
    public function __construct(){
        $this->preguntaModel = new Pregunta;
        $this->curso=new Curso();
    }

    public function store()
	{
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion']),
            'curso' => trim($_POST['curso']),
            'tema' => trim($_POST['tema']),
            'cui' => $_SESSION['usersCUI'],
            'fecha_limite' => $_POST['fecha_limite'],
            'disponibilidad' => $_POST['disponibilidad']
        ];
        if( empty($data['titulo'])
            || empty($data['descripcion'])
            || empty($data['curso'])
            || empty($data['tema'])
            || empty($data['fecha_limite'])
            || empty($data['disponibilidad'])){
            flash("publicar_pregunta", "Error Fill all the inputs");
            redirect("../views/publicar_pregunta.php");
        }
        
        $curso_=$this->curso->search_id_course_by_name($data['curso']);
        $data['curso']=$curso_[0]->idcurso;

        if($this->preguntaModel->register($data))
        {
            $id_=$this->preguntaModel->find_id_by_tittle($data['titulo']);
            if ($this->preguntaModel->register_in_non_rejected($id_[0]->id)) {
                redirect("../index.php");
            }
        }
        else {
            die("Something went wrong");
        }
	}

    public function search_by_tema(){
        if(!isset($_GET['tema']) || $_GET['tema']==''){
            redirect('./inicioController.php');    
        }
        else {
            //variables para la vista
            $tema_actual = $_GET['tema'];
            if(isset($_GET['estado'])){
                $estado_actual = $this->preguntaModel->get_estado_for_query($_GET['estado']);
            }
            else{
                $estado_actual = '-1';
            }
            //obtener preguntas para la vista
            if($estado_actual == '-1'){
                $preguntas_encontradas = $this->preguntaModel->get_all_by_tema($tema_actual);
            }
            else {
                $preguntas_encontradas = $this->preguntaModel->get_all_by_estado_and_tema($estado_actual,$tema_actual);
            }
            //anio registrados para el componente nav_bar
            $anios_registrados=$this->curso->get_anios();
            require_once("../views/pregunta__busqueda_by_tema.php");
        }

    }
    public function show_question($data_id)
    {
        if(!isset($data_id)){
            redirect('./inicioController.php');
        }
        else {
            $data = $this->preguntaModel->findQuestionById_2($data_id);
            if (!isset($data)) {
                flash("mostrar_pregunta", "Pregunta no encontrada");
                redirect('../index.php');
            }
            elseif($this->preguntaModel->is_rechazada($data_id)) {
                flash("mostrar_pregunta", "Pregunta no disponible");
                redirect('../index.php');
            }
            else {
                if($data->reunion_privada == 0){
                    $is_participante = $this->is_participante_reunion_publica($data_id,$_SESSION['usersCUI']);
                }
                require_once("../views/pregunta.php");
            }
        }
    }
    public function schedule_class()
    {
        //validar usuario
        //validar pregunta abierta
        $data = [
            'cui' => $_SESSION['usersCUI'],
            'id_pregunta' => trim($_POST['id_pregunta']),
            'fecha' => trim($_POST['fecha']),
            'meet' => trim($_POST['meet']),
            'priv' => trim($_POST['tipo_reunion']),
            'max' => trim($_POST['max_participantes'])
        ];
        
        if (empty($data['cui'])
            || empty($data['id_pregunta'])
            || empty($data['fecha'])
            || empty($data['meet'])){
            flash("programar_clase", "Error Fill all the inputs");
            redirect("../views/programar_clase.php");
        }
        if (empty($data['priv'])) {
            $data['priv']=0;
        }
        else {
            $data['priv']=1;
            $data['max']=1;
        }

        $pregunta_data = $this->preguntaModel->findQuestionById($_POST['id_pregunta']);
        if($this->preguntaModel->edit_for_schedule($data) && $this->preguntaModel->agregar_participacion_usuario($_POST['id_pregunta'],$pregunta_data->cui_usuario)) {
            redirect("./inicioController.php");
        }
        die("Something went wrong");
        redirect("./inicioController.php");
    }
    public function edit_question(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'id' => trim($_POST['id']),
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion']),
            'curso' => trim($_POST['curso']),
            'tema' => trim($_POST['tema']),
            'disponibilidad' => trim($_POST['disponibilidad']),
            'fecha_limite' => trim($_POST['fecha_limite'])
        ];

        $curso_=$this->curso->search_id_course_by_name($data['curso']);
        $data['curso']=$curso_[0]->idcurso;

        if($this->preguntaModel->findQuestionById_2($data['id'])){
            
            if ($this->preguntaModel->edit($data))
            {
                echo("se edito el registro existosamente");
                redirect("../index.php");
            }
            else {
                die("Something went wrong");
        }

        }else{
            echo("no se encontro pregunta");
            //redirect("../views/user__inicio.php");
        }

    }

    public function goTo_formulario_eliminar_pregunta() {
        if(!isset($_GET['id_pregunta'])){
            redirect("../index.php");  
        }
        $datos = $this->preguntaModel->findQuestionById_2($_GET['id_pregunta']);
        if(!$datos){
            echo("no se encontro pregunta");
            redirect("../index.php");
        }
        else if($datos->cui_usuario==$_SESSION['usersCUI']){
            require_once("../views/eliminar_pregunta.php");
        }
        else {
            redirect("../index.php");
        }
    }

    public function borrar_pregunta(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $id = trim($_POST['id_pregunta']);
    
        if($this->preguntaModel->delete($id)){
            echo "se eliminó el registro existosamente";
        }
        else{
            die("Something went wrong");
        }
        redirect("../index.php");          
    }
    public function go_to_edit_question(){
        $data=[
            'id_pregunta'=>$_GET['id'],
            'cui'=>$_SESSION['usersCUI']
        ];
        $data_cursos=$this->curso->get_all();
        $datos = $this->preguntaModel->findQuestionById_2($data['id_pregunta']);
        if(!$datos){
            echo("no se encontro pregunta");
            redirect("../index.php");
        }
        else if($datos->cui_usuario==$_SESSION['usersCUI']){
            require_once("../views/editar_pregunta.php");
        }
        else {
            redirect("../index.php");
        } 
    }

    public function confirmar_mentoria(){
        $data = [
            'id_pregunta' => trim($_POST['id_pregunta']),
            'option' => trim($_POST['confirmacion']),
        ];
        if($this->preguntaModel->procesar_solicitud_mentoria($data)){
            echo "Confirmacion de mentoria procesada";
        }
        else{
            die("Something went wrong");
        }
        redirect("../index.php");          
    }

    public function is_participante_reunion_publica($id_pregunta,$CUI_usuario){
        return $this->preguntaModel->is_participante_reunion_publica ($id_pregunta,$CUI_usuario);
    }

    public function participar_mentoria() {
        if(!isset($_POST['id_pregunta'])){
            redirect("../index.php");  
        }
        if(isset($_SESSION['usersCUI'])){
            //nota: verificar si hay cupos disponibles
            $salida = $this->preguntaModel->agregar_participacion_usuario($_POST['id_pregunta'],$_SESSION['usersCUI']);
            if($salida){
                $salida = $this->preguntaModel->reunion_publica_reducir_cupos($_POST['id_pregunta']);
            }
            if($salida){
               $this->show_question($_POST['id_pregunta']);
            }
        }
        die("Something went wrong"); 
        redirect("../index.php");
    }

    public function no_participar_mentoria() {
        if(!isset($_POST['id_pregunta'])){
            redirect("../index.php");  
        }
        if(isset($_SESSION['usersCUI'])){
            $salida = $this->preguntaModel->eliminar_participacion_usuario($_POST['id_pregunta'],$_SESSION['usersCUI']);
            if($salida){
                $salida = $this->preguntaModel->reunion_publica_aumentar_cupo($_POST['id_pregunta']);
            }
            if($salida){
               $this->show_question($_POST['id_pregunta']);
            }
        }
        die("Something went wrong"); 
        redirect("../index.php");
    }
}

$init = new PreguntaController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['type']){
        case 'store':
            $init->store();
            break;
        case 'schedule_class':
            $init->schedule_class();
            break;
        case 'edit_question':
            $init->edit_question();
            break;
        case 'eliminar_pregunta':
            $init->borrar_pregunta();
            break;
        case 'confirmar_mentoria':
            $init->confirmar_mentoria();
            break;
        case 'participar_mentoria':
            $init->participar_mentoria();
            break;
        case 'no_participar_mentoria':
            $init->no_participar_mentoria();
            break;
        default:
            redirect("../controllers/inicioController.php");
    }
}
else {
    switch($_GET['action']){
        case 'buscar_tema':
            $init->search_by_tema();
            break;
        case 'listar_cursos':
            $init->search_by_tema();
            break;
        case 'go_to_show_question':
            if(isset($_GET['id_pregunta'])){
                $init->show_question($_GET['id_pregunta']);
            }
            else{
                redirect("../index.php");
            }
            break;
        case 'go_to_edit_question':
            $init->go_to_edit_question();
            break;
        case 'go_to_formulario_borrar_pregunta':
            $init->goTo_formulario_eliminar_pregunta();
            break;
        default:
            redirect("../views/login.php");
    }
}


?>