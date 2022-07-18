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
            include 'components/nav_bar.php';
            ?>
        </header>
    <main class="main-usando-navbar ">
            <div class="programar_clase">
            <h1>Programar Clase</h1>
            <br/><br/><br/><br/>
            <form action="">


                <p>
                    <label for="">Curso</label>
                    <select name="curso">
                    <?php
                        include '../models/curso.php';
                        $curso_display=new Curso;
                        $data_cursos=$curso_display->get_all();
                        while ($i<20) {
                            $i++;
                            echo '<option value="'.$data_cursos[$i]->nombre.'">'.$data_cursos[$i]->nombre.'</option>';
                        }
                    ?>
                </select>
                </p><br/>


                <p>
                    <label for="">Fecha L&iacute;mite</label>
                    <input type="datetime-local" value="2022-17-07T00:00:00" name="fecha">
                </p><br/>

                <p>
                <label for="">Meet</label>
                <input type="url" name="meet">
                </p><br/>

                <div class="fila">
                <p class="bloque1">
                <input type="checkbox">
                </p>

                <p class="bloque1">
                <label name="privacidad" for="">Sesi&oacute;n Privada</label>
                </p>

                <p class="bloque2">
                <label for="">Max. Estudiantes</label>
                <input name="max_estudiantes" type="url">
                </p>
                </div><br/><br/>
                
                <p class="boton">
                <button>PROGRAMAR</button>
                </p>
                    
         
            </form>
            </div>
    </main>


        <script src="" async defer></script>
    </body>

</html>