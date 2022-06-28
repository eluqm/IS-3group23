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
        <link rel="stylesheet" href="css/general_style.css">
        <link rel="stylesheet" href="components/nav_bar.css">
        <link rel="stylesheet" href="css/user__mi-perfil.css">
        <link rel="stylesheet" href="components/pregunta.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <?php
            include './components/nav_bar.php';
            ?>
        </header>
        <main class="main-usando-navbar">
            <aside>
                <div class="aside__user-info__profile-img">
                    <div id="dummy"></div>
                    <span>
                    </span>
                </div>
                <h2>Nombre del usuario</h2>
                <textarea class="aside__user-info__description" placeholder="Mi descripci&oacute;n"></textarea>
                <button class="aside__button-log-out">
                    Cerrar Sesi&oacute;n
                </button>
            </aside>
            <section class="main__contenido">
                <div class="main__contenido__header">
                    <button>MIS PREGUNTAS</button>
                    <button>MIS MENTORIAS</button>
                </div>
                <div class="main__contenido__q-list">
                    <div class="pregunta">
                        <div class="pregunta__contenido">
                            <div class="pregunta__contenido__info">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status">Estado: XXXXXXXX</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                        </div>
                        <div class="pregunta__actions">
                            <a href="#"><span class="pregunta-icon eye-icon"></span></a>
                            <a href="#"><span class="pregunta-icon checkmark-icon"></span></a>
                            <a href="#"><span class="pregunta-icon x-mark-icon"></span></a>
                            <a href="#"><span class="pregunta-icon flag-icon"></span></a>
                        </div>
                    </div>
                    <div class="pregunta">
                        <div class="pregunta__contenido">
                            <div class="pregunta__contenido__info">
                                <p>Curso > Tema | Fecha</p>
                                <p class="pregunta__contenido__status">Estado: XXXXXXXX</p>
                            </div>
                            <h2>Titulo de la pregunta?</h2>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                            </p>
                        </div>
                        <div class="pregunta__actions">
                            <a href="#"><span class="pregunta-icon eye-icon"></span></a>
                            <a href="#"><span class="pregunta-icon"></span></a>
                            <a href="#"><span class="pregunta-icon edit-icon"></span></a>
                            <a href="#"><span class="pregunta-icon trash-icon"></span></a>
                        </div>
                    </div>

                </div>
            </section>
        </main>
        <script src="" async defer></script>
    </body>
</html>