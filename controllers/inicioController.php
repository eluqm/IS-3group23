<?php

require_once $GLOBALS['BASE_DIR'].'/models/pregunta.php';
require_once $GLOBALS['BASE_DIR'].'/models/curso.php';

class InicioController {
    private $pregunta;
    private $curso;
    
    public function __construct(){
        $this->pregunta = new Pregunta;
        $this->curso=new Curso();
    }

    public function index(){
        //lista de cursos por anio
        if(isset($_GET['anio'])){ 
            $q_anio=$_GET['anio'];
        }
        else {
            $q_anio=1;
        }
        $datos=$this->pregunta->get_all_by_anio($q_anio);
        $lista_curso=$this->curso->get_por_anio($q_anio);
        //variables de busqueda
        $curso_actual='all';
        $tema_actual='all';
        $estado_actual='all';
        //anio registrados
        $anios_registrados=$this->curso->get_anios();
        //verificar si se inicio inicio sesion
        if(isset($_SESSION['usersCUI'])){
            require_once($GLOBALS['BASE_DIR']."/views/user__inicio.php");
        }
        else{
            require_once($GLOBALS['BASE_DIR']."/views/index__unsigned.php");
        }
    }

    public function get_by_estado($ESTADO){
        $estado_query = $this->pregunta->get_estado_for_query($ESTADO);
        if($estado_query==-1){
            return $this->pregunta->get_all();
        }
        else{
            return $this->pregunta->get_all_by_estado($estado_query);
        }
    }

    public function get_by_estado_and_anio($ESTADO,$ANIO){
        $estado_query = $this->pregunta->get_estado_for_query($ESTADO);
        if($estado_query==-1){
            return $this->pregunta->get_all_by_anio($ANIO);
        }
        else{
            return $this->pregunta->get_all_by_estado_and_anio($estado_query,$ANIO);
        }
    }

    public function get_by_curso($ESTADO,$CURSO){
        $estado_query = $this->pregunta->get_estado_for_query($ESTADO);
        if($estado_query==-1){
            return $this->pregunta->get_all_by_curso($CURSO);
        }
        else{
            return $this->pregunta->get_all_by_estado_and_curso($estado_query,$CURSO);
        }
    }

    public function get_preguntas($ESTADO,$CURSO,$ANIO){
        //obtener preguntas para la vista
        if($CURSO == 'all'){
            $datos=$this->get_by_estado_and_anio($ESTADO,$ANIO);
        }
        else{
            $datos=$this->get_by_curso($ESTADO,$CURSO);
        }
        //lista de cursos por anio para el componente lista_cursos
        if(isset($ANIO)){ 
            $q_anio=$ANIO;
        }
        else{
            $q_anio=1; 
        }
        $lista_curso=$this->curso->get_por_anio($q_anio);
        //var para la vista
        $curso_actual=$CURSO;
        $tema_actual='all';
        $estado_actual=$ESTADO;
        //anio registrados para el componente nav_bar
        $anios_registrados=$this->curso->get_anios();
        //verificar si se inicio inicio sesion
        if(isset($_SESSION['usersCUI'])){
            require_once($GLOBALS['BASE_DIR']."/views/user__inicio.php");
        }
        else{
            require_once($GLOBALS['BASE_DIR']."/views/index__unsigned.php");
        }
    }
}