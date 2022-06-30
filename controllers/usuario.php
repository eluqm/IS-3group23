<?php

require_once '../models/usuario.php';
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
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['usersPwd-repeat'])
        ];

        if( empty($data['usersName'])
            || empty($data['usersEmail'])
            || empty($data['usersCUI'])
            || empty($data['usersPwd'])
            || empty($data['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../views/signup.php");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['usersUid'])){
            flash("register", "Invalid username");
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

        if ($this->userModel->register($data))
        {
            redirect("../views/template.php");
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
                $this->createUserSession($loggedInUser);
            }else{
                flash("login", "Password Incorrect");
                redirect("../views/login.php");
            }
        }else{
            flash("login", "No user found");
            redirect("../views/login.php");
        }
    }

    public function createUserSession($user){
        $_SESSION['usersCUI'] = $user->cui;
        $_SESSION['usersName'] = $user->nombre;
        $_SESSION['usersEmail'] = $user->correo_electronico;
        redirect("../views/template.php");
    }

    public function logout(){
        unset($_SESSION['usersCUI']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("../views/login.php");
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
            default:
            redirect("../views/login.php");
        }
    }
?>