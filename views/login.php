<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar Sesion</title>
</head>

    <body>
        <style>
            if(!isset($_SESSION['usersCUI'])){session_start();}
            <?php include $GLOBALS['BASE_DIR'].'/views/css/login.css';?>
        </style>
    <div class="login-container">
        <div class="image-container">
            <img src="https://github.com/eluqm/IS-3group3/blob/main/views/icons/logo.png?raw=true" width="300" height="150px">
            <img src="https://github.com/eluqm/IS-3group3/blob/main/views/icons/CsLogo.png?raw=true" width="170" height="150px">
            <p>Tasti es un intermediario para reunir a estudiantes de Ciencia de la Computación: si un estudiante tiene dificultades para aprender sobre un tema específico puede postearlo en nuestro foro y si otro estudiante tiene conocimientos de ese tema
                puede hacerle un reforzamiento por medio de una conferencia enlace meet, además de permitir a otros estudiantes con dudas similares permitir unirse a la presente explicación.</p>
        </div>
        <div class="login-info-container">
            <h1 class="title">Iniciar Sesión</h1>
            <?php flash('login') ?>
            <form class="inputs-container" method="POST" action="/TASTI/iniciando_sesion">
                <input class="input" name="email" type="text" placeholder="Ingresar correo institucional">
                <input class="input" type="password" name="usersPwd" placeholder="Ingresar contraseña">
                <button class="btn" type="submit" name="submit">Iniciar Sesión</button>
                <p>¿No tienes cuenta?<a class="a" href="<?php echo url('signup');?>">Registrate</a></p>
                <img src="https://raw.githubusercontent.com/eluqm/IS-3group3/539ee899794474359ad6b82576d329b57607cf82/views/icons/login.svg" width="300" height="400px">
            </form>
        </div>
    </div>

</body>

</html>