<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasti</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="views/components/pregunta.css">
    <link rel="stylesheet" href="views/css/general_style.css">
    <link rel="stylesheet" href="views/css/admin__inicio.css">
    <link rel="stylesheet" href="views/components/lista_cursos.css">
    <link rel="stylesheet" href="views/css/index.css">
</head>

<body>
    <header class="index">
        <img src="views/icons/CsLogo.png" width="100" height="80px">
        <img src="views/icons/logo.png" width="120" height="80px">
        <a class="a" href="views/login.php"><button class="btn" type="submit" name="submit">Iniciar Sesión</button></a>
        <a class="a" href="views/signup.php"><button class="btn" type="submit" name="submit">Registrarse</button></a>
    </header>

    <main class="main">
        <?php
            include './views/components/lista_cursos.php';
        ?>

            <section class="main__contenido">
                <form class=" nav-bar__barra_busqueda " action="# " method="get ">
                    <input name="tema " id="tema " placeholder="Buscar tema ">
                    <button type="submit "><span class="span-icon search-icon "></span></button>
                </form>
                <br />
                <div class="main__contenido__q-list ">
                    <div class="pregunta ">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info ">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status ">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta </p>
                        </div class="main__contenido__q-list ">
                    </div>

                    <div class="pregunta ">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info ">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status ">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta </p>
                        </div class="main__contenido__q-list ">
                    </div>

                    <div class="pregunta ">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info ">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status ">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta </p>
                        </div class="main__contenido__q-list ">
                    </div>

                    <div class="pregunta ">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info ">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status ">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta </p>
                        </div class="main__contenido__q-list ">
                    </div>

                    <div class="pregunta ">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info ">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status ">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta </p>
                        </div class="main__contenido__q-list ">
                    </div>

                    <div class="pregunta ">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info ">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status ">Estado: Abierto</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>Esta es una pregunta </p>
                        </div class="main__contenido__q-list ">
                    </div>
                </div>
                </div>
            </section>
    </main>
</body>

</html>