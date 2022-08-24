<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administrador > Borrar pregunta</title>
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
            <?php if($action_solicitud==2):?>
                <h1>Descartar reporte</h1>     
            <?php else:?>
                <h1>Eliminar Pregunta</h1>
            <?php endif;?>
            <form method="POST" action="<?php echo url('post_procesar_solicitud_pregunta') ?>">
                <input hidden name="action" value="<?php echo $action_solicitud; ?>">
                <input hidden name="id_pregunta" value="<?php echo $datos_pregunta->id?>">
                <div class="pregunta__info">
                    <p><?php echo $datos_pregunta->nombre_curso;?> > <?php echo $datos_pregunta->tema;?> | <?php echo $datos_pregunta->fecha_publicacion;?></p>
                    <h2><?php echo $datos_pregunta->titulo;?></h2>
                    <p><?php echo $datos_pregunta->descripcion;?></p>
                </div>
                <hr>
                <textarea id="razon" name="razon" placeholder="Proporcione más información de la decisión"></textarea>
                <br/>
                <div class="button-box">
                    <button class="button button_aceptar" type="submit">Enviar</button>
                    <a class="button button_cancelar" href="<?php echo url('admin_ver_reporte_pregunta',['estado_reporte' => 'pendiente']);?>">Cancelar</a>
                </div>
            </form>
            </div>
        </main>
        <script src="" async defer></script>
    </body>
</html>