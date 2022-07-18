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
        $borrar=trim($_POST["evento_borrar"]);
        $cancelar=trim($_POST["evento_cancelar"]);

        if($borrar!=null)
        {
            if($this->deleteModel->findQuestionById_2($id))
            {            
                if($this->deleteModel->delete($id))
                {
                    echo("se eliminó el registro existosamente");
                }
                else {
                    die("Something went wrong");
                }

            }
            else 
            {
                echo("no se encontró la pregunta");
            }
            redirect("../index.php");          
        }
        else if($cancelar!=null)
        {
            echo("se cancelo la operación");
            redirect("../index.php");
        }
        else
        {
            die("Something went wrong");
        }
    }
}

    $init = new eliminar_pregunta;
    $init->index();

?>