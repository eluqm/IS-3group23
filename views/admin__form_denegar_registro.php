<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administrador > Denegar registro</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <style>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/general_style.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/forms.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/components/nav_bar.css';?>
        </style>
        <header>
            <?php
            if(!isset($_SESSION['usersCUI'])){session_start();}
            include $GLOBALS['BASE_DIR'].'/views/components/nav_bar.php';
            ?>
        </header>
        <main class="main-usando-navbar">
            <div class="formulario">
            <h1>Denegar Registro</h1>
            <form method="POST" action="<?php echo url('post_procesar_reporte')?>">
                <input hidden name="estado" value=2>
                <input hidden name="id_solicitud" value="<?php echo $datos_registro->id?>">
                <div class="pregunta__info">
                    <p><span style="font-weight: bolder;">CUI:</span> <?php echo $datos_registro->cui;?></p>
                    <p><span style="font-weight: bolder;">Nombre:</span> <?php echo $datos_registro->nombre;?></p>
                    <p><span style="font-weight: bolder;">E-Mail:</span> <?php echo $datos_registro->correo_electronico;?></p>
                    <p><span style="font-weight: bolder;">DNI:</span> <?php echo $datos_registro->dni;?></p>
                </div>
                <hr>
                <textarea id="razon" name="razon" placeholder="Motivo para denegar registro"></textarea>
                <br/>
                <div class="button-box">
                    <button class="button button_aceptar" type="submit">Enviar</button>
                    <a class="button button_cancelar" href="../controllers/inicioController.php">Cancelar</a>
                </div>
            </form>
            </div>
        </main>
        <script src="" async defer></script>
    </body>
</html>