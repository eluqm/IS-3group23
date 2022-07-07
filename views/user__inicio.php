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
        <?php session_start(); ?>
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
                    <button autofocus>TODO</button>
                    <button>ABIERTAS</button>
                    <button>CERRADAS</button>
                </div>

                <div class="main__contenido__q-list">

                <!-- Traer de la base de datos -->
                <?php if (isset($datos) && $datos!=0): ?>
                <?php foreach ($datos as $dato) { ?>
                        <div class="pregunta">
                            <div class="pregunta__contenido">
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
                            </div class="main__contenido__q-list">
                            <div class="pregunta__actions">
                                <a href="#"><span class="pregunta-icon eye-icon"></span></a>

                                <?php if ($dato->estado == 0 && $dato->cui_usuario != $_SESSION['usersCUI']): ?> 
                                <a href="#"><span class="pregunta-icon checkmark-icon"></span></a>
                                <?php else: ?>
                                <div><span class="pregunta-icon"></span></div>
                                <?php endif;?>

                                <?php if ($dato->cui_usuario == $_SESSION['usersCUI']&& $dato->estado == 0): ?> 
                                <a href="#"><span class="pregunta-icon edit-icon"></span></a>
                                <?php elseif($_SESSION['admin']==1): ?>
                                <a href="#"><span class="pregunta-icon x-mark-icon"></span></a>
                                <?php else: ?>
                                <div><span class="pregunta-icon"></span></div>
                                <?php endif;?>

                                <?php if ($dato->cui_usuario == $_SESSION['usersCUI']): ?> 
                                <a href="#"><span class="pregunta-icon trash-icon"></span></a>
                                <?php else: ?>
                                <a href="#"><span class="pregunta-icon flag-icon"></span></a>
                                <?php endif;?>
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