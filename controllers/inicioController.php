<?php
require_once '../models/pregunta.php';
class InicioController {

    public function index(){
        $per=new Pregunta();
        $datos=$per->get_all();        
		require_once("../views/user__inicio.php");
    }

}
$init = new InicioController;
$init->index();

?>