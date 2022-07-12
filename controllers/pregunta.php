<?php

require_once '../models/pregunta.php';
require_once '../helpers/session_helper.php';

class PreguntaController {

    private $preguntaModel;
    
    public function __construct(){
        $this->preguntaModel = new Pregunta;
    }

    public function store()
	{
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion']),
            'curso' => trim($_POST['curso']),
            'tema' => trim($_POST['tema']),
            'fecha_publicacion' => date_default_timezone_get('America/Los_Angeles'),
            'fecha_limite' => trim($_POST['fechaLim']),
            'horDisp' => trim($_POST['horDisp'])
        ];

        if($this->preguntaModel->register($data))
        {
            redirect("../views/user__inicio.php");
        }
        else {
            die("Something went wrong");
        }
	}
    
	public function edit(){

		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$data = [
            'id' => trim($_POST['id']),
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion'])
        ];
        if($this->preguntaModel->findQuestionById($data['id'])){
        	
        	if ($this->preguntaModel->edit($data))
        	{
            	//redirect("../views/template.php");
                echo("se edito el registro existosamente");
        	}
        	else {
            	die("Something went wrong");
        }

        }else{
            echo("no se encontro pregunta");
            //redirect("../views/user__inicio.php");
        }

	}
    public function delete(){

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

$init = new PreguntaController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['action']){
        case 'store':
            $init->store();
        case 'edit_pregunta':
            $init->edit();
        case 'delete_pregunta':
            $init->delete();
        default:
            redirect("../views/publicar_pregunta.php");
    }
        
}
?>