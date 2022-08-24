<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Perfil</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <style>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/general_style.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/css/user__perfil.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/components/pregunta.css';?>
            <?php include $GLOBALS['BASE_DIR'].'/views/components/nav_bar.css';?>
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
            <?php include  __DIR__.'/components/nav_bar.php';?>
        </header>
        <main class="main-usando-navbar">
            <aside>
                <span class="mensaje"><?php flash('mensaje')?></span>
                <div class="aside__user-info__profile-img">
                    <div id="dummy"></div>
                    <span style="background-image: url('./../views/user_profiles/<?php echo $datos_perfil->name_img;?>');">
                    </span>
                    <button onclick="toggledisplay_uploadimg()"><span class="pregunta-icon edit-icon"></span></button>
                </div>
                <form id="form__subir_img" hidden method="POST" action="/TASTI/miPerfil/actualizando_img" enctype="multipart/form-data">
                    <input hidden name="type" value="subir_imagen">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <button type="submit" class="button-form" name="submit">Subir</button>
                </form>
                <h2><?php echo $datos_perfil->nombre;?></h2>
                <?php if($cui==$_SESSION['usersCUI']):?>
                    <form action="/TASTI/miPerfil/actualizando_descripcion" method="POST" enctype="multipart/form-data">
                        <input hidden name="type" value="actualizar_perfil">
                        <textarea onchange="perfil_guardar_cambios()" class="aside__user-info__description" name="descripcion"><?php echo $datos_perfil->descripcion;?></textarea>
                        <button type="submit" hidden class="button-form" id="button__guardar_cambios">Guardar cambios</button>
                    </form>
                    <a href="/TASTI/logout" class="aside__button-log-out">
                        Cerrar Sesi&oacute;n
                    </a>
                <?php else:?>
                    <p class="aside__user-info__description"><?php echo $datos_perfil->descripcion;?></p>
                <?php endif?>
            </aside>
            <section class="main__contenido">
                <div class="main__contenido__header">
                    <button autofocus style="background-color: var(--color_principal);" id="button__mis_preguntas" onclick="toggledisplay_preguntas()">MIS PREGUNTAS</button>
                    <button id="button__mis_mentorias" onclick="toggledisplay_mentorias()">MIS MENTORIAS</button>
                </div>
                <div id="lista__mis_preguntas" class="main__contenido__q-list">
                <?php if ($datos_mi_pregunta!=0): ?>
                <?php foreach ($datos_mi_pregunta as $dato) { ?>
                    <div class="pregunta">
                            <div class="pregunta__contenido">
                                <div class="pregunta__contenido__info">
                                    <p><?php echo $dato->nombre_curso;?> > <?php echo $dato->tema;?> | <?php echo $dato->fecha_publicacion;?></p>
                                    <p class="pregunta__contenido__status"> Estado: 
                                        <?php if ($dato->estado == 0): ?> 
                                            Abierto
                                        <?php elseif ($dato->estado == 2): ?>
                                            En espera de confirmación
                                        <?php else: ?>
                                            Cerrado
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <h2><?php echo $dato->titulo;?></h2>
                                <p><?php echo $dato->descripcion;?></p>
                            </div class="main__contenido__q-list">
                            <div class="pregunta__actions">
                                <a href="/TASTI/pregunta/<?php echo $dato->id;?>"><span class="pregunta-icon eye-icon"></span></a>
                                <div><span class="pregunta-icon"></span></div>      

                                <!-- editar pregunta -->
                                <?php $id_ = $dato->id;?>
                                <a href="<?php echo url('editar_pregunta',['id_pregunta' => $dato->id]);?>"><span class="pregunta-icon edit-icon"></span></a>
                                <!-- eliminar pregunta -->
                                <a href="<?php echo url('borrar_pregunta',['id_pregunta' => $dato->id]);?>"><span class="pregunta-icon trash-icon"></span></a>

                            </div>
                        </div>          
                <?php } ?>
                <?php else: ?>
                    <p>No has preguntado todav&iacute;a. An&iacute;mate a preguntar!</p>
                <?php endif; ?>
                </div>

                <div id="lista__mis_mentorias" class="main__contenido__q-list" style="display: none;">
                <?php if ($datos_mi_mentoria!=0): ?>
                <?php foreach ($datos_mi_mentoria as $dato) { ?>
                    <div class="pregunta">
                            <div class="pregunta__contenido">
                                <div class="pregunta__contenido__info">
                                    <p><?php echo $dato->nombre_curso;?> > <?php echo $dato->tema;?> | <?php echo $dato->fecha_publicacion;?></p>
                                    <p class="pregunta__contenido__status"> Estado: 
                                        <?php if ($dato->estado == 0): ?> 
                                            Abierto
                                        <?php elseif ($dato->estado == 2): ?>
                                            En espera de confirmación
                                        <?php else: ?>
                                            Cerrado
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <h2><?php echo $dato->titulo;?></h2>
                                <p><?php echo $dato->descripcion;?></p>
                            </div class="main__contenido__q-list">
                            <div class="pregunta__actions">
                                <a href="/TASTI/pregunta/<?php echo $dato->id;?>"><span class="pregunta-icon eye-icon"></span></a>
                                <div><span class="pregunta-icon"></span></div>
                                <div><span class="pregunta-icon"></span></div>
                                <div><span class="pregunta-icon"></span></div>
                            </div>
                        </div>          
                <?php } ?>
                <?php else: ?>
                    <p>No tiene alguna mentoria. An&iacute;mate a apoyar a un usuario!</p>
                <?php endif; ?>
                </div>


            </section>
        </main>
        <script>            
            function toggledisplay_preguntas() {
                var preguntas = document.getElementById("lista__mis_preguntas");
                var mentorias = document.getElementById("lista__mis_mentorias");
                if (preguntas.style.display === "none") {
                    preguntas.style.display = "flex";
                    mentorias.style.display = "none";
                }
                document.getElementById("button__mis_preguntas").style.backgroundColor = 'var(--color_principal)';
                document.getElementById("button__mis_mentorias").style.backgroundColor = 'var(--color_light_gray)';
            }

            function toggledisplay_mentorias() {
                var preguntas = document.getElementById("lista__mis_preguntas");
                var mentorias = document.getElementById("lista__mis_mentorias");
                if (mentorias.style.display === "none") {
                    mentorias.style.display = "flex";
                    preguntas.style.display = "none";
                }
                document.getElementById("button__mis_mentorias").style.backgroundColor = 'var(--color_principal)';
                document.getElementById("button__mis_preguntas").style.backgroundColor = 'var(--color_light_gray)';
            }

            function toggledisplay_uploadimg(){
                document.getElementById("form__subir_img").removeAttribute("hidden");
            }

            function perfil_guardar_cambios(){
                document.getElementById("button__guardar_cambios").removeAttribute("hidden");
            }
        </script>
    </body>
</html>