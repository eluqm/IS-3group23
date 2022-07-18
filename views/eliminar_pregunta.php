<!DOCTYPE html>
<html lang="es">

<head>

</head>

<body>
    <h1> Borrar pregunta </h1>
    <br><br>

    <form action="../controllers/pregunta.php" method="POST">
        Va a eliminar su pregunta:
        <h2><?php echo $datos->titulo;?></h2>
        <p><?php echo $datos->tema;?></p>
        <p><?php echo $datos->descripcion;?></p>
        ¿Está seguro?<br><br>
        <input name="type" type="hidden" value="eliminar_pregunta"/>  
        <input name="id_pregunta" type="hidden" value="<?php echo $datos->id;?>"/>
        <input type="submit" value="Confirmar"/>
        <a href="../controllers/inicioController.php">Cancelar</a>
    </form>
      
</body>

</html>