<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasti</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <style>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/general_style.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/components/nav_bar.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/admin__inicio.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/components/pregunta.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/components/lista_cursos.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/index.css';?>
    </style>
    <header class="index">
        <nav>
            <img src="../views/icons/CsLogo.png" width="100" height="80px" alt="Logo de la escuela de ciencia de la computación">
            <img src="../views/icons/logo.png" width="120" height="80px" alt="Logo de TASTI">
            <a class="a" href="../views/login.php"><button class="btn" type="submit" name="submit">Iniciar Sesión</button></a>
            <a class="a" href="../views/signup.php"><button class="btn" type="submit" name="submit">Registrarse</button></a>
        </nav>
    </header>

    <main class="main-usando-navbar">
        <?php
        include __DIR__.'../components/lista_cursos.php';
        ?>
            <section class="main__contenido">
                <form class=" nav-bar__barra_busqueda " action="# " method="get ">
                    <input name="tema " id="tema " placeholder="Buscar tema ">
                    <button type="submit "><span class="span-icon search-icon "></span></button>
                </form>
                <br />
                <div class="main__contenido__q-list ">
                <?php if (isset($datos) && $datos!=0): ?>
                <?php foreach ($datos as $dato) { ?>
                    <div class="pregunta">
                        <div class="pregunta__contenido ">
                            <div class="pregunta__contenido__info">
                            <p><?php echo $dato->nombre_curso;?> > <?php echo $dato->tema;?> | <?php echo $dato->fecha_publicacion;?></p>
                            <p class="pregunta__contenido__status"> Estado: 
                            <?php if ($dato->estado == 0): ?> 
                                Abierto
                            <?php else: ?>
                                Cerrado
                            <?php endif; ?>
                            </p>
                            </div>
                            <h2><?php echo $dato->titulo;?></h2>
                            <p><?php echo $dato->descripcion;?></p>
                        </div>
                    </div>
                <?php } ?>
                <?php else: ?>
                    <p>No hay preguntas :)</p>
                <?php endif; ?>
                </div>
            </section>
    </main>
</body>

</html>