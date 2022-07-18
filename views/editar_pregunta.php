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
        <input name="id" type="hidden" value=<?php echo $data['id_pregunta'];?> />  <!-- id -->
        Titulo: <input name="titulo" type="text"/>  <br/><br/>
        Descripcion:  <textarea name="descripcion"> </textarea> <br/><br/>

        <p>
            <label for="">Curso</label>
                <select name="curso">
                    <?php
                        $i=0;
                        while ($data_cursos[$i]->nombre!=$data_cursos[$i+1]->nombre) {
                            echo '<option value="'.$data_cursos[$i]->nombre.'">'.$data_cursos[$i]->nombre.'</option>';
                            $i++;
                        }
                    ?>
                </select>
            </p><br/>
        
        
        Tema: <input name="tema" type="text"/>  <br/><br/>
        Disponibilidad: <input name="disponibilidad" type="text"/>  <br/><br/>
        <p>
            <label for="">Fecha L&iacute;mite</label>
            <input type="datetime-local" name="fecha_limite">
        </p><br/>

        <input type="submit" value="Enviar ahora"/>
        <a href="../controllers/inicioController.php">Cancelar</a>
        </form>
</body>
</html>