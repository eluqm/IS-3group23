<!DOCTYPE html>
<html lang="es">

<head>

</head>

<body>
    <h1> Borrar pregunta </h1>
    <br><br>

        <form name="form_eliminar_pregunta" action="../controllers/eliminar_pregunta.php" method="post">
        <input type="hidden" name="type" value="delete_pregunta">
        Id: <input name="id" type="text"/>  <br/><br/>

        <input type="submit" value="Borrar"/>
      
        </form>
    
    
</body>

</html>