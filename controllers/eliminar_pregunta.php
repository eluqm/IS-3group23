<?php
require_once '../models/pregunta.php';
require_once '../helpers/session_helper.php';

class eliminar_pregunta{
	private $deleteModel;
    
    public function __construct(){
        $this->deleteModel = new Pregunta;
    }
	public function index(){

		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $id = trim($_POST['id']);

        if($this->deleteModel->findQuestionById($id)){
        	
        	if($this->deleteModel->delete($id))
        	{
            	//redirect("../views/template.php");
                echo("se eliminó el registro existosamente");
        	}
        	else {
            	die("Something went wrong");
            }

        }else{
            echo("no se encontró la pregunta");
            //redirect("../views/user__inicio.php");
        }

	}
}

	$init = new eliminar_pregunta;
	$init->index();

?>