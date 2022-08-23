<?php

require_once $GLOBALS['BASE_DIR'].'/models/usuario.php';
require_once $GLOBALS['BASE_DIR'].'/models/curso.php';

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
            redirect(url('signup'));
        }

        if(!preg_match("/^[0-9]{8}$/", $data['usersCUI'])){
            flash("register", "Invalid CUI");
            redirect(url('signup'));
        }
        if(!preg_match("/^[0-9]{8}$/", $data['usersDNI'])){
            flash("register", "Invalid DNI");
            redirect(url('signup'));
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email");
            redirect(url('signup'));
        }

        if(strlen($data['usersPwd']) < 6){
            flash("register", "Invalid password");
            redirect(url('signup'));
        } else if($data['usersPwd'] !== $data['pwdRepeat']){
            flash("register", "Passwords don't match");
            redirect(url('signup'));
        }

        if ($this->userModel->register($data)
            && $this->userModel->register_in_solicitud($data)
            && $this->userModel->add_description($data))
        {
            redirect(url('index'));
        }
        else {
            flash("register", "Ups, algo salió mal. Regístrese de nuevo");
            die("Something went wrong");
            redirect(url('signup'));
        }
    }
    public function login(){
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data=[
            'email' => trim($_POST['email']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if(empty($data['email']) || empty($data['usersPwd'])){
            flash("login", "Por favor llena todos los campos");
            redirect('/TASTI/login');
        }
        if($this->userModel->findUserByEmail($data['email'])){
            $loggedInUser = $this->userModel->login($data['email'], $data['usersPwd']);
            if($loggedInUser){
                if($loggedInUser->estado_cuenta == 0){
                    flash("login", "Cuenta no habilitada");
                    redirect('/TASTI/login');         
                }
                else {
                    $this->createUserSession($loggedInUser);
                }
            }
            else{
                flash("login", "Contraseña incorrecta");
                redirect('/TASTI/login');
            }
        }
        else{
            flash("login", "El usuario no existe");
            redirect('/TASTI/login');
        }
    }

    public function createUserSession($user){
        $_SESSION['usersCUI'] = $user->cui;
        $_SESSION['usersName'] = $user->nombre;
        $_SESSION['usersEmail'] = $user->correo_electronico;
        $_SESSION['admin']= $user->admin;
        redirect('/TASTI/');
    }

    public function logout(){
        unset($_SESSION['usersCUI']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        unset($_SESSION['admin']);
        session_destroy();
        redirect(url('login'));
    }

    public function goTo_login(){
        require_once($GLOBALS['BASE_DIR'].'/views/login.php');
    }

    public function goTo_registro(){
        require_once($GLOBALS['BASE_DIR'].'/views/signup.php');
    }

    public function getPerfil($CUI = NULL){
        if(!$CUI) {
            $cui = $_SESSION['usersCUI'];
        }
        else {
            $cui = $CUI;
        }
        $datos_perfil = $this->userModel->getProfile($cui); 
        $datos_mi_pregunta = $this->userModel->getMisPreguntas($cui); 
        $datos_mi_mentoria = $this->userModel->getMisMentorias($cui); 
        $curso=new Curso();
        $anios_registrados=$curso->get_anios();
        require_once($GLOBALS['BASE_DIR'].'/views/user__perfil.php');
        exit();
    }

    public function actualizar_perfil(){
        if(!isset($_SESSION['usersCUI'])){
            redirect(url('login'));
        }
        $data = [
            'descripcion' => $_POST['descripcion'],
            'CUI' => $_SESSION['usersCUI']
        ];
        $this->userModel->update_perfil($data);
        redirect(url('perfil'));
    }

    public function subir_imagen(){
        if(!isset($_SESSION['usersCUI'])){
            redirect(url('login'));
        }
        $error = "none";
        $target_dir = $GLOBALS['BASE_DIR'].'/views/user_profiles/';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if ($_FILES["fileToUpload"]["size"] == 0){
            flash("mensaje", "No se subió un archivo.");
            redirect("/TASTI/perfil/");
        }

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            $error = "El archivo debe ser una imagen.";
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $error = "Cambie el nombre del archivo.";
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $error = "El tamaño del archivo es muy grande. Max 500kb.";
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error = "Formato no admitido, solo JPG, JPEG, PNG & GIF.";
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          flash("mensaje", $error);
        } 
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                $data = [
                    'img_name' => basename($_FILES["fileToUpload"]["name"]),
                    'CUI' => $_SESSION['usersCUI']
                ];
                $this->userModel->update_perfil_image($data);
            } else {
                flash("mensaje", "Disculpe, hubo un error al subir su imagen, inténtelo de nuevo.");
                echo "Sorry, there was an error uploading your file.";
            }
        }
        redirect("/TASTI/perfil/");
    }
}
?>
