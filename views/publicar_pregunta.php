<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Publicar pregunta</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Overlock SC' rel='stylesheet'>
        <link rel="stylesheet" href="css/general_style.css">
        <link rel="stylesheet" href="components/nav_bar.css">
        <link rel="stylesheet" href="css/publicar_pregunta.css">
    </head>
    <body>
        <header>
            <?php
            if(!isset($_SESSION['usersCUI'])){session_start();}
            include 'components/nav_bar.php';
            ?>
        </header>
    <main class="main-usando-navbar ">
            <div class="publicar_pregunta">
            <h1>Publicar Pregunta</h1>
            <br/>
            <form class="inputs-container" method="post" action="../controllers/pregunta.php">
                <input type="hidden" name="type" value="store">
                <div id="lateral">
                    <p>
                    <label for="titulo">T&iacute;tulo</label>
                    <input type="text" name="titulo" id="titulo" required placeholder="Ingresar título" oninvalid="setCustomValidity('Su pregunta debe tener un título')" oninput="setCustomValidity('')">
                    </p><br/>

                    <p>
                    <label for="tema_">Tema</label>
                    <input type="text" name="tema" id="tema_" required placeholder="Ingresar tema" oninvalid="setCustomValidity('Su pregunta debe tener un tema')" oninput="setCustomValidity('')"/>
                    </p><br/>

                    <p>
                    <label for="disponibilidad">Disponibilidad</label>
                    <input type="text" name="disponibilidad" id="disponibilidad" required placeholder="Ingresar disponibilidad" oninvalid="setCustomValidity('Su pregunta debe incluir su disponibilidad')" oninput="setCustomValidity('')"/>
                    </p><br/>

                    <p>
                    <label for="fecha_limite">Fecha L&iacute;mite</label>
                    <input type="datetime-local" name="fecha_limite" id="fecha_limite" required oninvalid="setCustomValidity('Su pregunta debe tener una fecha limite para ser tomada')" oninput="setCustomValidity('')"/>
                    </p><br/>
                </div>
                    
                <div id="principal">
                    <p>
                    <label for="curso">Curso</label>
                        <select name="curso" id="curso">
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

                    <p class="input-file-wrapper">
                    <label class="descp" for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="7" required placeholder="Incluya toda la información que alguien necesitaría para responder a su pregunta" oninvalid="setCustomValidity('Su pregunta debe tener una descripción')" oninput="setCustomValidity('')"></textarea>
                    </p><br/>
                    <p class="boton">
                    <button type="submit" name="submit">Preguntar</button>
                    </p>
                </div>
            </form>
            </div>
    </main>
        <script src="" async defer></script>
    </body>
</html>
