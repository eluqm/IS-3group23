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
    </head>
    <body>
        <style>
            <?php include __DIR__.'/css/general_style.css';?>
            <?php include __DIR__.'/components/nav_bar.css';?>
            <?php include __DIR__.'/css/main_pregunta.css';?>
            .logo-icon {background-image: url('./../views/icons/logo.png');}
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
            <section class="main__pregunta__contenido"> 
                <p class="fecha">Fecha Limite: <?php echo $data->fecha_limite;?></p>
                <h2><?php echo $data->titulo;?></h2>
                <br/><hr><br/>
                <p class="parrafo"><?php echo $data->descripcion;?></p>
            </section>
            <aside>
                <div class="main__pregunta__info">
                <div class="main__pregunta__info__actions">
                    <p>ID: <?php echo $data->id;?></p>
                    <div>
                        <?php if($data->cui_usuario==$_SESSION['usersCUI']):?>
                            <a href="../controllers/pregunta.php?action=go_to_edit_question&id=<?php echo $data->id;?>"><span class="main_pregunta-icon edit-icon"></span></a>
                            <a href="../controllers/pregunta.php?action=go_to_formulario_borrar_pregunta&id_pregunta=<?php echo $data->id;?>"><span class="main_pregunta-icon trash-icon"></span></a>
                        <?php else:?>
                            <?php if($_SESSION['admin']==1):?>
                                <form action="../controllers/adminController.php" method="POST">
                                    <input hidden name="action" value="goTo_formulario_eliminar">
                                    <input hidden name="modo" value="1">
                                    <input hidden name="id_pregunta" value="<?php echo $data->id;?>">
                                    <button><span class="main_pregunta-icon x-mark-icon"></span></button>
                                </form>
                            <?php endif?>
                            <a href="../controllers/solicitudController.php?action=go_to_formulario_revision&id_pregunta=<?php echo $data->id;?>"><span class="main_pregunta-icon flag-icon"></span></a>
                        <?php endif?>
                    </div>
                </div>
                <div class="main__pregunta__info__content">
                    <div class="main__pregunta__info__content__dato"> 
                        <p>Curso:</p>
                        <p><?php echo $data->nombre_curso;?></p>
                    </div>
                    <div class="main__pregunta__info__content__dato"> 
                        <p>Tema:</p>
                        <p><?php echo $data->tema;?></p>
                    </div>
                    <div class="main__pregunta__info__content__dato"> 
                        <p>Usuario:</p>
                        <p><a href="../controllers/usuario.php?q=profile&cui=<?php echo $data->cui_usuario;?>"><?php echo $data->cui_usuario;?></a></p>
                    </div>
                    <div class="main__pregunta__info__content__dato"> 
                        <p>Disponibilidad:</p>
                        <p><?php echo $data->disponibilidad;?></p>
                    </div>
                    <?php if($data->estado==1):?>
                        <hr>
                        <div class="main__pregunta__info__content__dato"> 
                            <p>Mentor:</p>
                            <p><a href="../controllers/usuario.php?q=profile&cui=<?php echo $data->cui_mentor;?>"><?php echo $data->cui_mentor;?></a></p>
                        </div>
                        <div class="main__pregunta__info__content__dato"> 
                            <p>Tipo de clase:</p>
                        <?php if($data->reunion_privada==1):?>
                            <p>Privada</p>
                            </div>
                            <?php if($data->cui_usuario==$_SESSION['usersCUI']):?>
                                <div class="main__pregunta__info__content__dato"> 
                                    <p>Fecha:</p>
                                    <p><?php echo $data->fecha_meet;?></p> 
                                </div> 
                                <div class="main__pregunta__info__content__dato">  
                                    <p>Link del meet:</p>
                                    <p><?php echo $data->link_meet;?></p>  
                                </div>   
                            <?php endif?>
                        <?php else:?>
                            <p>P&uacute;blica</p>
                            </div>
                            <div class="main__pregunta__info__content__dato"> 
                                <p>Cupos disponibles:</p>
                                <p><?php echo $data->cupos_disponibles;?></p> 
                            </div>    
                            <div class="main__pregunta__info__content__dato"> 
                                <p>Fecha:</p>
                                <p><?php echo $data->fecha_meet;?></p>     
                            </div>
                            <?php if($is_participante):?>
                                <div class="main__pregunta__info__content__dato"> 
                                    <p>Link del meet:</p>
                                    <p><?php echo $data->link_meet;?></p>
                                </div>
                                <?php if($data->cui_usuario!=$_SESSION['usersCUI']):?>
                                    <form action="../controllers/pregunta.php" method="POST">
                                        <input hidden name="type" value="no_participar_mentoria">
                                        <input hidden name="id_pregunta" value="<?php echo $data->id;?>">                                    
                                        <button class="button-blue">NO PARTICIPAR</button>
                                    </form>        
                                <?php endif?>                         
                            <?php elseif($data->cupos_disponibles>0):?>
                                 <form action="../controllers/pregunta.php" method="POST">
                                    <input hidden name="type" value="participar_mentoria">
                                    <input hidden name="id_pregunta" value="<?php echo $data->id;?>">                                    
                                    <button class="button-blue">PARTICIPAR</button>
                                 </form>
                            <?php endif?>                                                   
                        <?php endif?>   
                    <?php elseif($data->estado==0):?>
                        <?php if($data->cui_usuario!=$_SESSION['usersCUI']):?>
                            <!-- Nota:  Pasarlo a post -->
                            <a class="button-blue" href="../views/programar_clase.php?id_pregunta=<?php echo $data->id;?>">ENSE&Nacute;AR</a>  
                        <?php else:?>   
                            <p>Paciencia ... Su pregunta todavia no ha sido tomada.</p>
                        <?php endif?>     
                    <?php elseif($data->estado==2):?>
                            <hr>
                            <?php if($data->cui_usuario==$_SESSION['usersCUI']):?>
                                <div class="main__pregunta__info__content__dato"> 
                                    <p>Mentor:</p>
                                    <p><a href="../controllers/usuario.php?q=profile&cui=<?php echo $data->cui_mentor;?>"><?php echo $data->cui_mentor;?></a></p>
                                </div>
                                <div class="main__pregunta__info__content__dato"> 
                                    <p>Tipo de clase:</p>
                                <?php if($data->reunion_privada==1):?>
                                    <p>Privada</p>
                                    </div>
                                <?php else:?>
                                    <p>P&uacute;blica</p>
                                    </div>
                                    <div class="main__pregunta__info__content__dato"> 
                                        <p>Capacidad:</p>
                                        <p><?php echo $data->max_participantes;?></p>
                                    </div>
                                <?php endif?>   
                                <div class="main__pregunta__info__content__dato"> 
                                    <p>Fecha:</p>
                                    <p><?php echo $data->fecha_meet;?></p>   
                                </div>
                                <form action="../controllers/pregunta.php" method="POST">
                                    <input hidden name="type" value="confirmar_mentoria">
                                    <input hidden name="id_pregunta" value="<?php echo $data->id;?>">
                                    <label for="confirmacion">¿Aceptar mentor&iacute;a?</label>
                                    <select name="confirmacion" id="confirmacion">
                                        <option value="1">Aceptar</option>
                                        <option value="0">Denegar</option>
                                    </select>
                                    <button class="button-blue" type="submit">Confirmar</button>
                                </form>
                        <?php else:?>   
                            <p>En espera de la confirmacion de la reuni&oacute;n</p>
                        <?php endif?>             
                    <?php endif?>   
                    <?php if($data->cui_mentor==$_SESSION['usersCUI']):?>
                        <form action="../controllers/pregunta.php" method="POST">
                            <input hidden name="type" value="cancelar_mentoria">
                            <input hidden name="id_pregunta" value="<?php echo $data->id;?>">                                    
                            <button class="button-blue">CANCELAR MENTORIA</button>
                        </form>
                    <?php endif?>   
                </div>
                </div>
            </aside>
        </main>
        <script src="" async defer></script>
    </body>

</html>