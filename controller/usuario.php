<?php

require_once '../models/usuario.php';
require_once '../helpers/session_helper.php';

class Users {

    private $userModel;
    
    public function __construct(){
        $this->userModel = new User;
    }

    public function register(){
        $data = [
            'usersName' => trim($_POST['usersName']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersUid' => trim($_POST['usersUid']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat'])
        ];

        if( empty($data['usersName'])
            || empty($data['usersEmail'])
            || empty($data['usersUid'])
            || empty($data['usersPwd'])
            || empty($data['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../signup.php");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        if ($this->userModel->register($data)) {
            redirect("../views/login.php")
        }else {
            die("Something went wrong")
        }

    }
    public function login(){
    }

    public function createUserSession($user){
        $_SESSION['usersId'] = $user->usersId;
        $_SESSION['usersName'] = $user->usersName;
        $_SESSION['usersEmail'] = $user->usersEmail;
        redirect("../views/index.php");
    }

    public function logout(){
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("../views/index.php");
    }
    }

    $init = new Users;

    //Ensure that user is sending a post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
            default:
            redirect("../views/index.php");
        }
        
    }else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            default:
            redirect("../index.php");
        }
    }