<?php
require_once '../models/pregunta.php';
require_once '../models/curso.php';

class InicioController {

    public function index(){
        $per=new Pregunta();
        $curso=new Curso();
        $datos=$per->get_all();        
        if(isset($_GET['anio'])){ 
            $lista_curso=$curso->get_por_anio($_GET['anio']);
            $q_anio=$_GET['anio'];
        }
        else {
            $lista_curso=$curso->get_por_anio(1);
            $q_anio=1;
        }
        $anios_registrados=$curso->get_anios();
        require_once("../views/user__inicio.php");
    }

}
$init = new InicioController;
$init->index();

?>