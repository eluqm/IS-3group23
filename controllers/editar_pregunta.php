<?php
require_once '../models/pregunta.php';
require_once '../helpers/session_helper.php';

class editar_pregunta{
    private $editModel;
    
    public function __construct(){
        $this->editModel = new Pregunta;
    }
    public function index(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'id' => trim($_POST['id']),
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion'])
        ];

        if($this->editModel->findQuestionById_2($data['id'])){
            
            if ($this->editModel->edit($data))
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
}

    $init = new editar_pregunta;
    $init->index();

?>