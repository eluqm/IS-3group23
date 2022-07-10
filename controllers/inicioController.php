<?php
require_once '../models/pregunta.php';
require_once '../models/curso.php';

class InicioController {
    public function index(){
        session_start();
        $pregunta=new Pregunta();
        $curso=new Curso();
        //lista de cursos por anio
        if(isset($_GET['anio'])){ 
            $q_anio=$_GET['anio'];
        }
        else {
            $q_anio=1;
        }
        $datos=$pregunta->get_all_by_anio($q_anio);
        $lista_curso=$curso->get_por_anio($q_anio);
        //variables de busqueda
        $curso_actual='all';
        $tema_actual='all';
        $estado_actual='all';
        //anio registrados
        $anios_registrados=$curso->get_anios();
        //verificar si se inicio inicio sesion
        if(isset($_SESSION['usersCUI'])){
            require_once("../views/user__inicio.php");
        }
        else{
            require_once("../views/index__unsigned.php");
        }
    }

    public function get_by_estado($ESTADO){
        $pregunta=new Pregunta();
        //preguntas por estado
        if($ESTADO=='all'){
            return $pregunta->get_all();
        }
        else if($ESTADO=='open'){
            return $pregunta->get_all_by_estado(0);
        } 
        else if($ESTADO=='close'){
            return $pregunta->get_all_by_estado(1);
        }  
    }

    public function get_by_curso($ESTADO,$CURSO){
        $pregunta=new Pregunta();
        //preguntas
        switch($ESTADO){
            case 'all':
                return $pregunta->get_all_by_curso($CURSO);
            case 'open':
                return $pregunta->get_all_by_estado_and_curso(0,$CURSO);
            case 'close':              
                return $pregunta->get_all_by_estado_and_curso(1,$CURSO);
            default:
                return $pregunta->get_all();
        } 
    }

    public function get_preguntas($ESTADO,$CURSO){
        session_start();
        $curso=new Curso();
        //obtener preguntas para la vista
        if($CURSO == 'all'){
            $datos=$this->get_by_estado($ESTADO);
        }
        else{
            $datos=$this->get_by_curso($ESTADO,$CURSO);
        }
        //lista de cursos por anio para el componente lista_cursos
        if(isset($_GET['anio'])){ 
            $lista_curso=$curso->get_por_anio($_GET['anio']);
            $q_anio=$_GET['anio'];
        }
        else {
            $lista_curso=$curso->get_por_anio(1);
            $q_anio=1;
        }
        //buscar by curso
         $curso_actual=$CURSO;
         $tema_actual='all';
         $estado_actual=$ESTADO;
        //anio registrados para el componente nav_bar
        $anios_registrados=$curso->get_anios();
        //verificar si se inicio inicio sesion
        if(isset($_SESSION['usersCUI'])){
            require_once("../views/user__inicio.php");
        }
        else{
            require_once("../views/index__unsigned.php");
        }
    }



}

$init = new InicioController;

if(!isset($_GET['action']) || !isset($_GET['estado']) || !isset($_GET['curso'])){
    $init->index();
}
else{
    switch($_GET['action']){
        case 'get_preguntas':
            $init->get_preguntas($_GET['estado'],$_GET['curso']);
            break;
        default:
            $init->index();
    }
}
?>