<?php

require_once '../models/usuario.php';
require_once '../models/curso.php';
require_once '../helpers/session_helper.php';

class Users {

    private $userModel;
    
    public function __construct(){
        $this->userModel = new User;
    }

    public function register(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'usersName' => trim($_POST['usersName']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersCUI' => trim($_POST['usersCUI']),
            'usersDNI' => trim($_POST['usersDNI']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['usersPwd-repeat'])
        ];
        
        if( empty($data['usersName'])
            || empty($data['usersEmail'])
            || empty($data['usersCUI'])
            || empty($data['usersPwd'])
            || empty($data['usersDNI'])
            || empty($data['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../views/signup.php");
        }

        if(!preg_match("/^[0-9]{8}$/", $data['usersCUI'])){
            flash("register", "Invalid CUI");
            redirect("../views/signup.php");
        }
        if(!preg_match("/^[0-9]{8}$/", $data['usersDNI'])){
            flash("register", "Invalid DNI");
            redirect("../views/signup.php");
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email");
            redirect("../views/signup.php");
        }

        if(strlen($data['usersPwd']) < 6){
            flash("register", "Invalid password");
            redirect("../views/signup.php");
        } else if($data['usersPwd'] !== $data['pwdRepeat']){
            flash("register", "Passwords don't match");
            redirect("../views/signup.php");
        }

        if ($this->userModel->register($data)
            && $this->userModel->register_in_solicitud($data)
            && $this->userModel->add_description($data))
        {
            redirect("../controllers/inicioController.php");
        }
        else {
            die("Something went wrong");
        }
    }
    public function login(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data=[
            'email' => trim($_POST['email']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if(empty($data['email']) || empty($data['usersPwd'])){
            flash("login", "Please fill out all inputs");
            redirect("../views/login.php");
        }

        if($this->userModel->findUserByEmail($data['email'])){
            $loggedInUser = $this->userModel->login($data['email'], $data['usersPwd']);
            
            if($loggedInUser){
                if($loggedInUser->estado_cuenta == 0){
                    flash("login", "Cuenta no habilitada");
                    redirect("../views/login.php");                
                }
                else {
                    $this->createUserSession($loggedInUser);
                }
            }
            else{
                flash("login", "Password Incorrect");
                redirect("../views/login.php");
            }
        }
        else{
            flash("login", "No user found");
            redirect("../views/login.php");
        }
    }

    public function createUserSession($user){
        $_SESSION['usersCUI'] = $user->cui;
        $_SESSION['usersName'] = $user->nombre;
        $_SESSION['usersEmail'] = $user->correo_electronico;
        $_SESSION['admin']= $user->admin;
        redirect("../index.php");
    }

    public function logout(){
        unset($_SESSION['usersCUI']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        unset($_SESSION['admin']);
        session_destroy();
        redirect("../views/login.php");
    }

    public function getMiPerfil(){
        $datos_perfil = $this->userModel->getProfile($_SESSION['usersCUI']); 
        $datos_mi_pregunta = $this->userModel->getMisPreguntas($_SESSION['usersCUI']); 
        $datos_mi_mentoria = $this->userModel->getMisMentorias($_SESSION['usersCUI']); 
        $curso=new Curso();
        $anios_registrados=$curso->get_anios();
        require_once('../views/user__mi-perfil.php');
        exit();
    }

    public function getPerfil(){
        if(!isset($_GET['cui'])){
            $cui = $_SESSION['usersCUI'];
        }
        else {
            $cui = $_GET['cui'];
        }
        $datos_perfil = $this->userModel->getProfile($cui); 
        $datos_mi_pregunta = $this->userModel->getMisPreguntas($cui); 
        $datos_mi_mentoria = $this->userModel->getMisMentorias($cui); 
        $curso=new Curso();
        $anios_registrados=$curso->get_anios();
        require_once('../views/user__perfil.php');
        exit();
    }

    public function actualizar_perfil(){
        if(!isset($_SESSION['usersCUI'])){
            redirect("../views/login.php");
        }
        $data = [
            'descripcion' => $_POST['descripcion'],
            'CUI' => $_SESSION['usersCUI']
        ];
        $this->userModel->update_perfil($data);
        redirect("../controllers/usuario.php?q=profile");
    }

    public function subir_imagen(){
        if(!isset($_SESSION['usersCUI'])){
            redirect("../views/login.php");
        }
        $target_dir = "../views/user_profiles/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";

        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $data = [
                'img_name' => basename($_FILES["fileToUpload"]["name"]),
                'CUI' => $_SESSION['usersCUI']
            ];
            $this->userModel->update_perfil_image($data);
        } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
        redirect("../controllers/usuario.php?q=profile");
    }
}

    $init = new Users;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
            case 'actualizar_perfil':
                $init->actualizar_perfil();
                break;
            case 'subir_imagen':
                $init->subir_imagen();
                break;
            default:
                redirect("../views/login.php");
        }
        
    }else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            case 'profile':
                $init->getPerfil();
            default:
                redirect("../views/login.php");
        }
    }
?>