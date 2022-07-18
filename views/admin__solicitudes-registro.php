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
                        <a href="../controllers/adminController.php?action=solicitudRegistro&solicitud=pendiente" id="selected">SOLICITUD DE REGISTRO</a>
                        <a href="../controllers/adminController.php?action=solicitudRevisionPregunta&solicitud=pendiente">REPORTES</a>
                    </div>
                    <div class="main__contenido__header__row-2">
                        <a href="../controllers/adminController.php?action=solicitudRegistro&solicitud=pendiente" id="a_pendiente">PENDIENTES</a>
                        <a href="../controllers/adminController.php?action=solicitudRegistro&solicitud=aceptada" id="a_aceptada">ACEPTADAS</a>
                        <a href="../controllers/adminController.php?action=solicitudRegistro&solicitud=denegada" id="a_denegada">DENEGADAS</a>
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
                                        <p><?php echo $dato->fecha_creacion;?></p>
                                    </div>
                                    <p>CUI:<?php echo $dato->cui;?></p>
                                    <p>Nombre: <?php echo $dato->nombre;?></p>
                                    <p>E-Mail:<?php echo $dato->correo_electronico;?></p>
                                    <p>DNI: <?php echo $dato->dni;?></p>
                                </div>
                                <div class="pregunta__actions">              
                                    <form action="../controllers/adminController.php" method="POST">
                                        <input hidden name="action" value="solicitud_registro_procesada">
                                        <input hidden name="id_solicitud" value="<?php echo $dato->id?>">
                                        <input hidden name="estado" value=1>
                                        <input hidden name="cui_new_user" value="<?php echo $dato->cui;?>">
                                        <button type="submit"><span class="pregunta-icon checkmark-icon"></span></button>   
                                    </form>
                                    <div><span class="pregunta-icon"></span></div>
                                    <div><span class="pregunta-icon"></span></div>
                                    <form action="../controllers/adminController.php" method="POST">
                                        <input hidden name="action" value="goTo_formulario_denegar_registro">
                                        <input hidden name="id_solicitud_registro" value="<?php echo $dato->id;?>">
                                        <button type="submit"><span class="pregunta-icon trash-icon"></span></button>   
                                    </form>
                                </div>
                            </div>                    
                        <?php } ?>
                    <?php elseif ($tipo_solicitud == 1): ?> 
                        <?php foreach ($solicitud_registro as $dato) { ?>
                            <div class="pregunta">
                                <div class="pregunta__contenido">
                                    <div class="pregunta__contenido__info">
                                        <p><?php echo $dato->fecha_creacion;?></p>
                                    </div>
                                    <p>CUI:<?php echo $dato->cui;?></p>
                                    <p>Nombre: <?php echo $dato->nombre;?></p>
                                    <p>E-Mail:<?php echo $dato->correo_electronico;?></p>
                                    <p>DNI: <?php echo $dato->dni;?></p>
                                    <hr>
                                    <p><?php echo $dato->fecha_atencion;?></p>
                                    <p>Administrador: <?php echo $dato->admin_nombre;?></p>
                                </div>
                                <div class="pregunta__actions" style="background-color:#8AD091;"> 
                                    <div><span class="pregunta-icon"></span></div> 
                                </div>                 
                            </div>   
                        <?php } ?>
                    <?php elseif ($tipo_solicitud == 2): ?> 
                        <?php foreach ($solicitud_registro as $dato) { ?>
                            <div class="pregunta">
                                <div class="pregunta__contenido">
                                    <div class="pregunta__contenido__info">
                                        <p><?php echo $dato->fecha_creacion;?></p>
                                    </div>
                                    <p>CUI:<?php echo $dato->cui;?></p>
                                    <p>Nombre: <?php echo $dato->nombre;?></p>
                                    <p>E-Mail:<?php echo $dato->correo_electronico;?></p>
                                    <p>DNI: <?php echo $dato->dni;?></p>
                                    <hr>
                                    <p><?php echo $dato->fecha_atencion;?></p>
                                    <p>Administrador: <?php echo $dato->admin_nombre;?></p>
                                    <p>Nota: <?php echo $dato->admin_nota;?></p>
                                </div>
                                <div class="pregunta__actions" style="background-color:#CB7165;"> 
                                    <div><span class="pregunta-icon"></span></div> 
                                </div>                 
                            </div>   
                        <?php } ?>
                    <?php endif;?>
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