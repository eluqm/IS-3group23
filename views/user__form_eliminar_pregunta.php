<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi perfil > Eliminar pregunta</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            <h1>Eliminar pregunta</h1>
            <form action="<?php echo url('post_borrar_pregunta');?>" method="POST">
                <input name="id_pregunta" type="hidden" value="<?php echo $datos->id;?>"/>
                <h3> Va a eliminar su pregunta:</h3>
                <br/>
                <div class="pregunta__info">
                    <p><?php echo $datos->nombre_curso;?> > <?php echo $datos->tema;?> | <?php echo $datos->fecha_publicacion;?></p>
                    <h2><?php echo $datos->titulo;?></h2>
                    <p><?php echo $datos->descripcion;?></p>
                </div>
                <br/>
                <div class="button-box">
                    <input class="button button_aceptar" type="submit" value="Confirmar"/>
                    <a class="button button_cancelar" href="<?php echo url('pregunta_view',['id_pregunta' => $datos->id]);?>">Cancelar</a>
                </div>
            </form>
            </div>
        </main>     
    </body>
</html>