<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Perfil</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Overlock SC' rel='stylesheet'>
        <link rel="stylesheet" href="css/general_style.css">
        <link rel="stylesheet" href="components/nav_bar.css">
        <link rel="stylesheet" href="css/programar_clase.css">
    </head>
    <body>
        <header>
            <?php
            if(!isset($_SESSION['usersCUI'])){session_start();}
            include 'components/nav_bar.php';
            ?>
        </header>
    <main class="main-usando-navbar ">
            <div class="programar_clase">
            <h1>Programar Clase</h1>
            <br/><br/><br/><br/>
            <form class="inputs-container" method="post" action="../controllers/pregunta.php">
                <input type="hidden" name="type" value="schedule_class">
                <input name="id" type="hidden" value=<?php echo $_GET["id_pregunta"];?> />  <!-- id -->
                <p>
                    <label for="">Curso</label>
                    <select name="curso">
                    <?php
                        include '../models/curso.php';
                        $curso_display=new Curso;
                        $data_cursos=$curso_display->get_all();
                        $i=0;
                        while ($data_cursos[$i]->nombre!=$data_cursos[$i+1]->nombre) {
                            echo '<option value="'.$data_cursos[$i]->nombre.'">'.$data_cursos[$i]->nombre.'</option>';
                            $i++;
                        }
                    ?>
                </select>
                </p><br/>


                <p>
                <label for="">Fecha de Reunion</label>
                <input type="datetime-local" name="fecha">
                </p><br/>

                <p>
                <label for="">Meet</label>
                <input type="url" name="meet">
                </p><br/>

                <div class="fila">
                <p class="bloque1">
                <input name="privacidad_" type="checkbox">
                </p>

                <p class="bloque1">
                <label name="privacidad" for="">Sesi&oacute;n Privada</label>
                </p>

                <p class="bloque2">
                <label for="">Max. Estudiantes</label>
                <input name="max_estudiantes" type="number">
                </p>
                </div><br/><br/>
                
                
                <p class="boton">
                <button class="btn" type="submit" name="submit">PROGRAMAR</button>
                </p>
                    
         
            </form>
            </div>
    </main>


        <script src="" async defer></script>
    </body>

</html>