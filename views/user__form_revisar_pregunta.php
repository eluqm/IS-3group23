<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Crear solicitud de revisi&oacute;n</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>    
    <style>
        <?php include $GLOBALS['BASE_DIR'].'/views/css/general_style.css';?>
        <?php include $GLOBALS['BASE_DIR'].'/views/css/forms.css';?>
        <?php include $GLOBALS['BASE_DIR'].'/views/components/pregunta.css';?>
        <?php include $GLOBALS['BASE_DIR'].'/views/components/nav_bar.css';?>
    </style>
        <header>
            <?php
            if(!isset($_SESSION['usersCUI'])){session_start();}
            include $GLOBALS['BASE_DIR'].'/views/components/nav_bar.php';
            ?>
        </header>

    <main class="main-usando-navbar ">
        <div class="formulario">
        <h1>Solicitar revision de pregunta</h1>
        <form method="POST" action="<?php echo url('post_crear_reporte_pregunta')?>">
            <input type="hidden" name="id_pregunta" value="<?php echo $datos_pregunta->id?>">
            <div class="pregunta__info">
                <p><?php echo $datos_pregunta->nombre_curso; ?>><?php echo $datos_pregunta->tema;?> | <?php echo $datos_pregunta->fecha_publicacion;?></p>
                <h2><?php echo $datos_pregunta->titulo;?></h2><br/>
                <p><?php echo $datos_pregunta->descripcion;?></p><br/>
            </div>
            <hr>
            <textarea id="razon" name="razon" placeholder="Motivo de su denuncia"></textarea>
            <br/>
            <div class="button-box">
                <button class="button button_aceptar" type="submit">Enviar</button>
                <a class="button button_cancelar" href="<?php echo url('index')?>">Cancelar</a>
            </div>
        </form>
        </div>
    </main>
        <script src="" async defer></script>
    </body>
</html>
