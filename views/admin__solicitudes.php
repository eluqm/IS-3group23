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
    </head>
    <body>
        <style>
            <?php include __DIR__.'/css/general_style.css';?>
            <?php include __DIR__.'/css/admin__solicitudes.css';?>
            <?php include __DIR__.'/components/pregunta.css';?>
            <?php include __DIR__.'/components/nav_bar.css';?>
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

        <main class="main-usando-navbar">

            <section class="main__contenido">
                <div class="main__contenido__header">
                    <div class="main__contenido__header__row-1">
                        <button>SOLICITUD DE REGISTRO</button>
                        <button>REPORTES</button>
                    </div>
                    <div class="main__contenido__header__row-2">
                        <button autofocus>PENDIENTES</button>
                        <button>ACEPTADAS</button>
                        <button>DENEGADAS</button>
                    </div>
                </div>

                <div class="main__contenido__q-list">

                <!-- Traer de la base de datos -->
                <?php if (isset($solicitud_registro) && $solicitud_registro!=0): ?>
                <?php foreach ($solicitud_registro as $dato) { ?>
                        <div class="pregunta">
                            <div class="pregunta__contenido">
                                <div class="pregunta__contenido__info">
                                    <p><?php echo $dato->fecha_creacion;?></p>
                                </div>
                                <h2><?php echo $dato->nombre;?></h2>
                                <h2><?php echo $dato->dni;?></h2>
                                <p><?php echo $dato->correo_electronico;?></p>
                            </div>
                            <div class="pregunta__actions">                                  
                                <a href="#"><span class="pregunta-icon checkmark-icon"></span></a>
                                <div><span class="pregunta-icon"></span></div>
                                <div><span class="pregunta-icon"></span></div>
                                <div><span class="pregunta-icon"></span></div>
                            </div>
                        </div>                    
                <?php } ?>
                <?php else: ?>
                    <p>No hay solicitudes pendientes :)</p>
                <?php endif; ?>
                </div>
            </section>
        </main>
    </body>
</html>