<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tasti| Administrador > Formulario</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <style>
            <?php include __DIR__.'/css/general_style.css';?>
            <?php include __DIR__.'/css/forms.css';?>
            <?php include __DIR__.'/components/pregunta.css';?>
            <?php include __DIR__.'/components/nav_bar.css';?>
            .logo-icon {background-image: url('./../views/icons/logo.png');}
            .search-icon {background-image: url('./../views/icons/search.png');}
            .admin-icon {background-image: url('./../views/icons/admin.png');}
        </style>
        <header>
            <?php
            if(!isset($_SESSION['usersCUI'])){session_start();}
            include __DIR__.'../components/nav_bar.php';
            ?>
        </header>
        <main class="main-usando-navbar">
            <div class="formulario">
            <h1>Eliminar Pregunta</h1>
            <form method="POST" action="../controllers/adminController.php">
                <input hidden name="action" value="<?php if($action_solicitud==0): echo 'solicitud_eliminacion_aceptada'; elseif($action_solicitud==1): echo 'eliminar_pregunta'; elseif($action_solicitud==2): echo 'solicitud_eliminacion_denegada'; endif;?>">
                <input hidden name="id_pregunta" value="<?php echo $datos_pregunta->id?>">
                <p><?php echo $datos_pregunta->nombre_curso;?> > <?php echo $datos_pregunta->tema;?> | <?php echo $datos_pregunta->fecha_publicacion;?></p>
                <div class="pregunta__info">
                <h2><?php echo $datos_pregunta->titulo;?></h2>
                <p><?php echo $datos_pregunta->descripcion;?></p>
                </div>
                <hr>
                <textarea id="razon" name="razon" placeholder="Motivo de su denuncia"></textarea>
                <br/>
                <div class="button-box">
                    <button class="button button_aceptar" type="submit">Eliminar</button>
                    <a class="button button_cancelar" href="../controllers/inicioController.php">Cancelar</a>
                </div>
            </form>
            </div>
        </main>
        <script src="" async defer></script>
    </body>
</html>