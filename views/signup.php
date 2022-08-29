<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrarse</title>
</head>
<body>
    <style>
        <?php include $GLOBALS['BASE_DIR'].'/views/css/signup.css';?>
    </style>
    <div class="login-container">
        <div class="image-container">
            <h1 class="title">Registrarse</h1>
            <img src="https://raw.githubusercontent.com/eluqm/IS-3group3/539ee899794474359ad6b82576d329b57607cf82/views/icons/registro.svg" width="450" height="500px">
        </div>
        <div class="login-info-container">
            <?php flash('register') ?>
            <form class="inputs-container" method="post" action="<?php echo url('post_signup');?>">
                <input type="hidden" name="type" value="register">
                <label for="fname" >Nombre:</label>
                <input class="input" name="usersName" type="text" placeholder="Ingresar nombre completo" required>
                <label for="fname">Correo Institucional:</label>
                <input class="input" name="usersEmail" type="email" placeholder="Ingresar correo institucional" required> 
                <label for="fname">CUI:</label>
                <input class="input" name="usersCUI" type="text" placeholder="Ingresar CUI" required>
                <label for="fname">DNI:</label>
                <input class="input" name="usersDNI" type="text" placeholder="Ingresar DNI" required>
                <label for="fname">Contraseña:</label>
                <input class="input" name="usersPwd" type="password" placeholder="Ingresar contraseña" required>
                <label for="fname">Repetir contraseña:</label>
                <input class="input" name="usersPwd-repeat" type="password" placeholder="Ingresar contraseña" required>
                <button class="btn">Registrarse</button>
                <p>¿Ya tienes cuenta?<a class="a" href="<?php echo url('login');?>">Iniciar Sesión</a></p>
            </form>
        </div>
    </div>

</body>

</html>
