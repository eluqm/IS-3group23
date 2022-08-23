<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Perfil</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Overlock SC' rel='stylesheet'>
</head>
<body>
    <style>
        <?php include __DIR__.'/css/general_style.css';?>
        <?php include __DIR__.'/components/nav_bar.css';?>
        <?php include __DIR__.'/css/publicar_pregunta.css';?>
        <?php include __DIR__.'/components/pregunta.css';?>
        
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

    <main class="main-usando-navbar ">

        <div class = "publicar_pregunta">
            <h1> Editar pregunta </h1>
            <br/>
            <form class="inputs-container" action="<?php echo url('post_editar_pregunta')?>" method="POST">
            <input name="type" type="hidden" value="edit_question"/>  <!-- id -->
            <input name="id" type="hidden" value=<?php echo $data['id_pregunta'];?> />  <!-- id -->
            <div id="lateral">
                <p>
                <label for="">T&iacute;tulo</label>
                <input name="titulo" type="text"/> 
                </p><br/>

                <p>
                <label for="">Tema</label>
                <input name="tema" type="text"/>
                </p><br/>

                <p>
                <label for="">Disponibilidad</label>
                <input name="disponibilidad" type="text"/>
                </p><br/>

                <p>
                    <label for="">Fecha L&iacute;mite </label>
                    <input type="datetime-local" name="fecha_limite">
                </p><br/>
        </div>

        <div id="principal">
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
                </p>

                <br/>
            
            <p class="input-file-wrapper">
            <label class="descp" for="">Descripcion</label>
            <textarea name="descripcion"> </textarea> <br/>
            </p>

            <p class="boton">
            <button type="submit" value="Editar">Editar</button>

            <p class="boton">
            <a href="<?php echo url('pregunta_view',['id_pregunta' => $data['id_pregunta']]);?>">Cancelar</a>
        </div>
        </form>
    </div>    
    </main>
</body>
</html>