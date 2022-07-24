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
    public function show_question()
    {
        $data_id=$_GET['id_pregunta'];
        if(!isset($data_id)){
            redirect('./inicioController.php');
        }
        else {
            $data = $this->preguntaModel->findQuestionById($data_id);
            if (!isset($data)) {
                redirect('../index.php');
            }
            else {
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

        if ($this->preguntaModel->edit_for_schedule($data)) {
            redirect("./inicioController.php");
        }
        else {
            die("Something went wrong");
        }
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
            $init->show_question();
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