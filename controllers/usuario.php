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