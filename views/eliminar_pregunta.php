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

<head>
    <title>Tasti | Mi Perfil > Eliminar pregunta</title>
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


    <h1> Borrar pregunta </h1>
    <br><br>

    <form action="../controllers/pregunta.php" method="POST">
        <h2> Va a eliminar su pregunta: <h2>
        <br>
        <div style="background-color: #F1F6FB;">
            <p><i><?php echo $datos->tema;?></i></p>
            <p><i><?php echo $datos->titulo;?></i></p>
            <p><i><?php echo $datos->descripcion;?></i></p>
        </div>
        <br>
        ¿Está seguro?<br><br>
        <input name="type" type="hidden" value="eliminar_pregunta"/>  
        <input name="id_pregunta" type="hidden" value="<?php echo $datos->id;?>"/>
        <input type="submit" value="Confirmar"/>
        <a href="../controllers/inicioController.php">Cancelar</a>
    </form>
      
</body>

</html>