<?php

require_once $GLOBALS['BASE_DIR'].'/models/pregunta.php';
require_once $GLOBALS['BASE_DIR'].'/models/curso.php';
require_once $GLOBALS['BASE_DIR'].'/helpers/session_helper.php';

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
            redirect(url('publicar_pregunta'));
        }
        
        $curso_=$this->curso->search_id_course_by_name($data['curso']);
        $data['curso']=$curso_[0]->idcurso;

        if($this->preguntaModel->register($data))
        {
            $id_=$this->preguntaModel->find_id_by_tittle($data['titulo']);
            if ($this->preguntaModel->register_in_non_rejected($id_[0]->id)) {
                redirect(url('index'));
            }
        }
        else {
            die("Something went wrong");
        }
	}

    public function search_by_tema($tema_actual,$estado_actual = NULL){

        //variables para la vista
        if($estado_actual){
            $estado_actual = $this->preguntaModel->get_estado_for_query($estado_actual);
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
        require_once($GLOBALS['BASE_DIR'].'/views/pregunta__busqueda_by_tema.php');
    }

    public function show_question($data_id)
    {
        if(!isset($data_id)){
            redirect(url('index'));
        }
        else {
            $data = $this->preguntaModel->findQuestionById_2($data_id);
            if (!isset($data)) {
                flash("mostrar_pregunta", "Pregunta no encontrada");
                redirect(url('index'));
            }
            elseif($this->preguntaModel->is_rechazada($data_id)) {
                flash("mostrar_pregunta", "Pregunta no disponible");
                redirect(url('index'));
            }
            else {
                if($data->reunion_privada == 0){
                    $is_participante = $this->is_participante_reunion_publica($data_id,$_SESSION['usersCUI']);
                }
                require_once($GLOBALS['BASE_DIR'].'/views/pregunta.php');
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
            redirect(url('crear_mentoria'));
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
            redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
        }
        die("Something went wrong");
        redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
    }

    public function edit_question(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['titulo']) && !empty($_POST['titulo']) &&
            isset($_POST['descripcion']) && !empty($_POST['descripcion']) &&
            isset($_POST['curso']) && !empty($_POST['curso']) &&
            isset($_POST['tema']) && !empty($_POST['tema']) &&
            isset($_POST['disponibilidad']) && !empty($_POST['disponibilidad']) &&
            isset($_POST['fecha_limite']) && !empty($_POST['fecha_limite'])
        ){

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
                    redirect(url('pregunta_view',['id_pregunta' => $_POST['id']]));   
                }
                else {
                    die("Something went wrong");
            }

            }else{
                echo("no se encontro pregunta");
                redirect(url('index'));
            }
        } 
        else
        {
            $mensaje = "Debe llenar todos los campos del formulario";
            echo "<script languaje='Javascript'>";
            echo "alert('$mensaje');";
            echo "history.back();";
            echo "</script>";
        }

    }

    public function goTo_formulario_eliminar_pregunta($id_pregunta) {
        $data=[
            'id_pregunta'=>$id_pregunta,
            'cui'=>$_SESSION['usersCUI']
        ];
        $data_cursos=$this->curso->get_all();
        $datos = $this->preguntaModel->findQuestionById_2($data['id_pregunta']);
        if(!$datos){
            echo("no se encontro pregunta");
            redirect(url('index'));
        }
        //verificando que la pregunta corresponde al usuario actual
        else if($datos->cui_usuario==$_SESSION['usersCUI']){
            require_once($GLOBALS['BASE_DIR'].'/views/user__form_eliminar_pregunta.php');
        }
        else {
            redirect(url('index'));
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
        redirect(url('perfil'));     
    }
    public function go_to_edit_question($id_pregunta){
        $data=[
            'id_pregunta'=>$id_pregunta,
            'cui'=>$_SESSION['usersCUI']
        ];
        $data_cursos=$this->curso->get_all();
        $datos = $this->preguntaModel->findQuestionById_2($data['id_pregunta']);
        if(!$datos){
            echo("no se encontro pregunta");
            redirect(url('index'));
        }
        //verificando que la pregunta corresponde al usuario actual
        else if($datos->cui_usuario==$_SESSION['usersCUI']){
            require_once($GLOBALS['BASE_DIR'].'/views/user__form_editar_pregunta.php');
        }
        else {
            redirect(url('index'));
        } 
    }

    public function go_to_programar_clase($id_pregunta){
        //NOTA: comprobar que la pregunta no ha sido tomada
        require_once($GLOBALS['BASE_DIR'].'/views/programar_clase.php');
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
        redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));   
    }

    public function is_participante_reunion_publica($id_pregunta,$CUI_usuario){
        return $this->preguntaModel->is_participante_reunion_publica ($id_pregunta,$CUI_usuario);
    }

    public function participar_mentoria() {
        if(!isset($_POST['id_pregunta'])){
            redirect(url('index'));
        }
        if(isset($_SESSION['usersCUI'])){
            //nota: verificar si hay cupos disponibles
            $salida = $this->preguntaModel->agregar_participacion_usuario($_POST['id_pregunta'],$_SESSION['usersCUI']);
            if($salida){
                $salida = $this->preguntaModel->reunion_publica_reducir_cupos($_POST['id_pregunta']);
            }
            if($salida){
                redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
            }
        }
        die("Something went wrong"); 
        redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
    }

    public function no_participar_mentoria() {
        if(!isset($_POST['id_pregunta'])){
            redirect(url('index'));
        }
        if(isset($_SESSION['usersCUI'])){
            $salida = $this->preguntaModel->eliminar_participacion_usuario($_POST['id_pregunta'],$_SESSION['usersCUI']);
            if($salida){
                $salida = $this->preguntaModel->reunion_publica_aumentar_cupo($_POST['id_pregunta']);
            }
            if($salida){
                redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
            }
        }
        die("Something went wrong"); 
        redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
    }

    public function cancelar_mentoria() {
        if(!isset($_POST['id_pregunta'])){
            redirect(url('index'));  
        }
        $data = [
            'id_pregunta' => trim($_POST['id_pregunta']),
            'option' => 0
        ];
        if(isset($_SESSION['usersCUI'])){
            if($this->preguntaModel->procesar_solicitud_mentoria($data)){
                $pregunta_data = $this->preguntaModel->findQuestionById($_POST['id_pregunta']);
                $this->preguntaModel->eliminar_participacion_usuario($_POST['id_pregunta'],$pregunta_data->cui_usuario);
                redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
            }
        }
        redirect(url('pregunta_view',['id_pregunta' => $_POST['id_pregunta']]));
    }
}
?>