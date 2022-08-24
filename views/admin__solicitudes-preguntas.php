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
            <?php include __DIR__.'/css/admin__solicitudes.css'?>
            <?php include __DIR__.'/components/pregunta.css';?>
            <?php include __DIR__.'/components/nav_bar.css';?>
            .logo-icon {background-image: url('./icons/logo.png');}
            .eye-icon {background-image: url('./views/icons/eye.png');}
            .edit-icon {background-image: url('./views/icons/edit.png');}
            .flag-icon {background-image: url('./../views/icons/flag.png');}
            .checkmark-icon {background-image: url('./../views/icons/checkmark.png');}
            .trash-icon {background-image: url('./../views/icons/delete.png');}
            .x-mark-icon {background-image: url('./../views/icons/x-mark.png');}
            .search-icon {background-image: url('./../views/icons/search.png');}
            .admin-icon {background-image: url('./icons/admin.png');}
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
                        <a href="/TASTI/administrador/solicitudes/pendiente">SOLICITUD DE REGISTRO</a>
                        <a href="/TASTI/administrador/reportes/pendiente" id="selected">REPORTES</a>
                    </div>
                    <div class="main__contenido__header__row-2">
                        <a href="/TASTI/administrador/reportes/pendiente" id="a_pendiente">PENDIENTES</a>
                        <a href="/TASTI/administrador/reportes/aceptada" id="a_aceptada">ACEPTADAS</a>
                        <a href="/TASTI/administrador/reportes/denegada" id="a_denegada">DENEGADAS</a>
                    </div>
                </div>
                <div class="main__contenido__q-list">
                <!-- Traer de la base de datos -->
                <?php if (isset($solicitud_registro) && $solicitud_registro!=0): ?>
                    <?php if ($tipo_solicitud == 0): ?>    
                        <?php foreach ($solicitud_registro as $dato) { ?>
                            <div class="pregunta">
                            <div class="pregunta__contenido">
                                    <div class="pregunta__contenido__info">
                                        <p><?php echo $dato->nombre;?> > <?php echo $dato->tema;?> | <?php echo $dato->fecha_publicacion;?></p>
                                    </div>
                                    <h2><?php echo $dato->titulo;?></h2>
                                    <p><?php echo $dato->descripcion;?></p>
                                    <hr>
                                    <p><span>Fecha: </span><?php echo $dato->fecha_creacion;?></p>
                                    <p><span>Razon: </span> <?php echo $dato->razon;?></p>
                                </div>
                                <div class="pregunta__actions">                        
                                    <a href="<?php echo url('pregunta_view',['id_pregunta' => $dato->id_pregunta]); ?>"><span class="pregunta-icon eye-icon"></span></a> 
                                    <form action="<?php echo url('procesar_reporte_formulario')?>" method="POST">
                                        <input hidden name="modo" value="0">
                                        <input hidden name="id_pregunta" value="<?php echo $dato->id_pregunta;?>">
                                        <button><span class="pregunta-icon checkmark-icon"></span></button>
                                    </form>
                                    <form action="<?php echo url('procesar_reporte_formulario')?>" method="POST">
                                        <input hidden name="modo" value="2">
                                        <input hidden name="id_pregunta" value="<?php echo $dato->id_pregunta;?>">
                                        <button><span class="pregunta-icon trash-icon"></span></button>
                                    </form>
                                </div>
                            </div>                    
                        <?php } ?>
                    <?php elseif ($tipo_solicitud == 1): ?> 
                        <?php foreach ($solicitud_registro as $dato) { ?>
                            <div class="pregunta">
                                <div class="pregunta__contenido">
                                    <div class="pregunta__contenido__info">
                                        <p><?php echo $dato->nombre;?> > <?php echo $dato->tema;?> | <?php echo $dato->fecha_publicacion;?></p>
                                    </div>
                                    <h2><?php echo $dato->titulo;?></h2>
                                    <p><?php echo $dato->descripcion;?></p>
                                    <hr>
                                    <p><span>Fecha: </span><?php echo $dato->fecha_creacion;?></p>
                                    <p><span>Razon: </span> <?php echo $dato->razon;?></p>
                                    <hr>
                                    <p><span>Fecha: </span><?php echo $dato->fecha_solucion;?></p>
                                    <p><span>Administrador: </span><?php echo $dato->cui_admin;?></p>
                                    <p><span>Nota: </span><?php echo $dato->admin_nota;?></p>
                                </div>
                            </div>                    
                        <?php } ?>
                    <?php elseif ($tipo_solicitud == 2): ?> 
                        <?php foreach ($solicitud_registro as $dato) { ?>
                            <div class="pregunta">
                                <div class="pregunta__contenido">
                                    <div class="pregunta__contenido__info">
                                        <p><?php echo $dato->nombre;?> > <?php echo $dato->tema;?> | <?php echo $dato->fecha_publicacion;?></p>
                                    </div>
                                    <h2><?php echo $dato->titulo;?></h2>
                                    <p><?php echo $dato->descripcion;?></p>
                                    <hr>
                                    <p><span>Fecha: </span><?php echo $dato->fecha_creacion;?></p>
                                    <p><span>Razon: </span> <?php echo $dato->razon;?></p>
                                    <hr>
                                    <p><span>Fecha: </span><?php echo $dato->fecha_solucion;?></p>
                                    <p><span>Administrador: </span><?php echo $dato->cui_admin;?></p>
                                    <p><span>Nota: </span><?php echo $dato->admin_nota;?></p>
                                </div>
                                <div class="pregunta__actions">
                                        <a href="#"><span class="pregunta-icon eye-icon"></span></a> 
                                        <div><span class="pregunta-icon"></span></div>
                                        <div><span class="pregunta-icon"></span></div>
                                        <div><span class="pregunta-icon"></span></div>
                                </div>
                            </div>                    
                        <?php } ?>
                    <?php endif; ?>
                <?php else: ?>
                    <p>No hay solicitudes</p>
                <?php endif; ?>
                </div>
            </section>
        </main>
        <script>
            function toggledisplay_preguntas(){
                //var preguntas = document.getElementById("a_pendiente");
                if(<?php echo $tipo_solicitud?> == 0)
                    document.getElementById("a_pendiente").style.backgroundColor = 'var(--color_principal)';
                else if(<?php echo $tipo_solicitud?> == 1)
                    document.getElementById("a_aceptada").style.backgroundColor = 'var(--color_principal)';
                    else if(<?php echo $tipo_solicitud?> == 2)
                    document.getElementById("a_denegada").style.backgroundColor = 'var(--color_principal)';
            }
            window.addEventListener("load",function() { toggledisplay_preguntas() });
        </script>
    </body>
</html>