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
                <input type="hidden" name="id_pregunta" value=<?php echo $_GET["id_pregunta"];?> />
                <p>
                <label for="fecha">Fecha de Reunion</label>
                <input type="datetime-local" name="fecha" id="fecha">
                </p><br/>

                <p>
                <label for="meet">Meet</label>
                <input type="url" id="meet" name="meet">
                </p>

                <div class="fila">                   
                    <input onchange="toggle_max_participantes()" id="tipo_reunion" name="tipo_reunion" type="checkbox">
                    <label name="privacidad" for="tipo_reunion">Sesi&oacute;n Privada</label>

                    <div>
                        <label for="">Max. Estudiantes</label>
                        <input id="max_participantes" name="max_participantes" type="number">
                    </div>
                </div>
                
                <p class="boton">
                <button class="btn" type="submit" name="submit">PROGRAMAR</button>
                </p>

            </form>
            </div>
    </main>
        <script>
            function toggle_max_participantes(){
                let input_number = document.getElementById("max_participantes");
                let hidden = input_number.getAttribute("disabled");
                if (hidden) {
                    input_number.removeAttribute("disabled");
                }
                else {
                    input_number.value="";
                    input_number.setAttribute("disabled", "disabled");
                }
            }
        </script>
    </body>

</html>