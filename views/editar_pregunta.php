<!DOCTYPE html>
<html lang="es">

<head>

</head>

<body>
    <h1> Editar pregunta </h1>
    <br><br>
        <form name="form_editar_pregunta" action="../controllers/pregunta.php" method="POST">
        <!-- <input type="hidden" name="type" value="edit"> -->
        <input name="type" type="hidden" value="edit_question"/>  <!-- id -->
        <input name="id" type="hidden" value=<?php echo $_POST["id"];?> />  <!-- id -->
        Titulo: <input name="titulo" type="text"/>  <br/><br/>
        Descripcion:  <textarea name="descripcion"> </textarea> <br/><br/>
        <input type="submit" value="Enviar ahora"/>
        </form>
</body>
</html>