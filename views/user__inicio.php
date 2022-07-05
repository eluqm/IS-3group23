<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="components/pregunta.css">
        <link rel="stylesheet" href="css/general_style.css">
        <link rel="stylesheet" href="components/nav_bar.css">
        <link rel="stylesheet" href="css/admin__inicio.css">
        <link rel="stylesheet" href="components/lista_cursos.css">
    </head>
    <body>
        <header>
            <?php
            include './components/nav_bar.php';
            ?>
        </header>

        <main class="main-usando-navbar">
           
            <?php
            include './components/lista_cursos.php';
            ?>

            <section class="main__contenido">
                <div class="main__contenido__header">
                    <button>TODO</button>
                    <button>ABIERTAS</button>
                    <button>CERRADAS</button>
                </div>

                <div class="main__contenido__q-list">

                <!-- Traer de la base de datos -->

                    <!-- Modelo pregunta abierta -->
                    <div class="pregunta">
                        <div class="pregunta__contenido">
                            <div class="pregunta__contenido__info">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta abierta</p>
                        </div class="main__contenido__q-list">
                        <div class="pregunta__actions">
                            <a href="#"><span class="pregunta-icon eye-icon"></span></a>
                            <a href="#"><span class="pregunta-icon checkmark-icon"></span></a>
                            <a href="#"><span class="pregunta-icon x-mark-icon"></span></a>
                            <a href="#"><span class="pregunta-icon flag-icon"></span></a>
                        </div>
                    </div>
                    
                    <!-- Modelo pregunta cerrada -->
                    <div class="pregunta">
                        <div class="pregunta__contenido">
                            <div class="pregunta__contenido__info">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status">Estado: Cerrado</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta cerrada</p>
                        </div>
                        <div class="pregunta__actions">
                            <a href="#"><span class="pregunta-icon eye-icon"></span></a>
                            <a href="#"><span class="pregunta-icon"></span></a>
                            <a href="#"><span class="pregunta-icon x-mark-icon"></span></a>
                            <a href="#"><span class="pregunta-icon flag-icon"></span></a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>