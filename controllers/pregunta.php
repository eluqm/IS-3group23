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
};

$init = new PreguntaController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['action']){
        case 'store':
            $init->store();
        default:
            redirect("../views/publicar_pregunta.php");
    }
        
}
?>