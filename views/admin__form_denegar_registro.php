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
        <h2>Denegar Registro</h2>
        <form method="POST" action="../controllers/adminController.php">
            <input hidden name="action" value="solicitud_registro_procesada">
            <input hidden name="estado" value=2>
            <input hidden name="id_solicitud" value="<?php echo $datos_registro->id?>">
            <p>CUI:<?php echo $datos_registro->cui;?></p>
            <p>Nombre: <?php echo $datos_registro->nombre;?></p>
            <p>E-Mail:<?php echo $datos_registro->correo_electronico;?></p>
            <p>DNI: <?php echo $datos_registro->dni;?></p>
            <label id="razon" name="razon">Razon:</label>
            <textarea id="razon" name="razon" placeholder="Motivo"></textarea>
            <button type="submit">Eliminar</button>
            <a href="../controllers/inicioController.php">Cancelar</a>
        </form>
        
        <script src="" async defer></script>
    </body>
</html>