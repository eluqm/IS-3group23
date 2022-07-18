<!DOCTYPE html>
<html lang="es">

<head>

</head>

<body>
    <h1> Borrar pregunta </h1>
    <br><br>

        <form name="form_eliminar_pregunta" action="../controllers/pregunta.php" method="post">
        Va a eliminar su pregunta: <b><?php echo $_POST["titulo"];?></b><br><br>. 
        ¿Está seguro?<br><br>
        <input name="type" type="hidden" value="delete_question"/>  
        <!-- id -->
        <input name="id" type="hidden" value=<?php echo $_POST["id"];?> />

        <!--<input type="submit" value="Confirmar"/>-->
        <input type="submit" value="Cancelar" id="evento_cancelar" name="evento_cancelar" /> 
        <input type="submit" value="Confirmar" id="evento_borrar" name="evento_borrar" />
        </form>
    
    
</body>

</html>