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
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>    
    <style>
        <?php include _DIR_.'/css/general_style.css';?>
        <?php include _DIR_.'/css/inicio.css';?>
        <?php include _DIR_.'/components/pregunta.css';?>
        <?php include _DIR_.'/components/nav_bar.css';?>
        <?php include _DIR.'/css/user_form_revisar_pregunta.css';?>
    </style>
        <header>
            <?php
            if(!isset($_SESSION['usersCUI'])){session_start();}
            include 'components/nav_bar.php';
            ?>
        </header>

    <main class="main-usando-navbar ">
        <div class="revisar_pregunta">
        <h1>Solicitar revision de pregunta</h1>
        
        <form method="POST" action="../controllers/solicitudController.php">
            <input type="hidden" name="action" value="crear_solicitud_revision">
            <input type="hidden" name="id_pregunta" value="<?php echo $datos_pregunta->id?>">
            <p><?php echo $datos_pregunta->nombre_curso; ?>><?php echo $datos_pregunta->tema;?> | <?php echo $datos_pregunta->fecha_publicacion;?></p>
            <p> Estado: <?php if ($datos_pregunta->estado == 0): ?> 
                   Abierto
                <?php else: ?>
                    Cerrado
                <?php endif; ?></p><br/>
            <p>Titulo: <?php echo $datos_pregunta->titulo;?></p><br/>
            <p>Descripcion: <?php echo $datos_pregunta->descripcion;?></p><br/>
            <label id="razon" name="razon">Razon:</label>
            <textarea id="razon" name="razon" placeholder="Motivo de su denuncia"></textarea>
            <br/><br/>
            <button type="submit">Enviar</button>
            <div class="boton">
            <a href="../controllers/inicioController.php"> <p class="boton">Cancelar</p></a>
            </div>
            
        </form>

        </div>
    </main>
        
        <script src="" async defer></script>
    </body>
</html>
