<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <style>
            <?php include __DIR__.'/css/general_style.css';?>
            <?php include __DIR__.'/css/inicio.css';?>
            <?php include __DIR__.'/components/pregunta.css';?>
            <?php include __DIR__.'/components/nav_bar.css';?>
            <?php include __DIR__.'/components/lista_cursos.css';?>
            .logo-icon {background-image: url('./../views/icons/logo.png');}
            .eye-icon {background-image: url('./../views/icons/eye.png');}
            .edit-icon {background-image: url('./../views/icons/edit.png');}
            .flag-icon {background-image: url('./../views/icons/flag.png');}
            .checkmark-icon {background-image: url('./../views/icons/checkmark.png');}
            .trash-icon {background-image: url('./../views/icons/delete.png');}
            .x-mark-icon {background-image: url('./../views/icons/x-mark.png');}
            .search-icon {background-image: url('./../views/icons/search.png');}
            .admin-icon {background-image: url('./../views/icons/admin.png');}

    </style>
    <header>
            <?php
            include __DIR__.'../components/nav_bar.php';
            ?>
    </header>

    <div >
    <h1> Editar pregunta </h1>

    <br><br>

        <form name="form_editar_pregunta" action="../controllers/pregunta.php" method="POST">

        <input name="type" type="hidden" value="edit_question"/>  <!-- id -->
        <input name="id" type="hidden" value=<?php echo $data['id_pregunta'];?> />  <!-- id -->
        <h2>Titulo:</h2> <input name="titulo" type="text" size="40"/>  <br/><br/>
        <h2>Descripcion:</h2>  <textarea name="descripcion" cols="40"/> </textarea> <br/><br/>

        <p>
            <label for=""><h2>Curso</h2></label>
                <select name="curso">
                    <?php
                        $i=0;
                        while ($data_cursos[$i]->nombre!=$data_cursos[$i+1]->nombre) {
                            echo '<option value="'.$data_cursos[$i]->nombre.'">'.$data_cursos[$i]->nombre.'</option>';
                            $i++;
                        }
                    ?>
                </select>
            </p>

            <br/>
        
        
        <h2>Tema:</h2> <input name="tema" type="text" size="40"/>  <br/><br/>
        <h2>Disponibilidad:</h2> <input name="disponibilidad" type="text" size="40"/>  <br/><br/>
        <p>
            <label for=""><h2>Fecha L&iacute;mite</h2> </label>
            <input type="datetime-local" name="fecha_limite">
        </p><br/>

        <input type="submit" value="Enviar ahora"/>
        <a href="../controllers/inicioController.php">Cancelar</a>
        </form>
    </div>    
</body>
</html>