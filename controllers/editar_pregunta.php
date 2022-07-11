<?php
require_once '../models/pregunta.php';
require_once '../helpers/session_helper.php';
/*
function db_query($query) {
    $connection = mysqli_connect("localhost","root","root","tasti");
    $result = mysqli_query($connection,$query);

    return $result;
}

        $sql = "select * from pregunta";
        $result = db_query($sql);
        while($row = mysqli_fetch_object($result)) 
        {
            echo $row->titulo;
        }
*/
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
        if($this->editModel->findQuestionById($data['id'])){
        	
        	if ($this->editModel->edit($data))
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
}

	$init = new editar_pregunta;
	$init->index();

?>