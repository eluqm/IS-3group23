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
        <h2>Eliminar Pregunta</h2>
        <form class="admin__form__delete_pregunta" method="POST" action="../controllers/adminController.php">
            <input name="action" value="eliminar_pregunta">
            <input name="id_pregunta" value="<?php echo $datos_pregunta->id?>">
            <?php echo $datos_pregunta->id?>
            
            <label id="razon" name="razon">Razon:</label>
            <textarea id="razon" name="razon"></textarea>

            <button>Eliminar</button>
            <button>Cancelar</button>
        </form>
        
        <script src="" async defer></script>
    </body>
</html>