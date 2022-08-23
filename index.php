<?php
use function foo\func;
    session_start();
    $GLOBALS['BASE_DIR'] = __DIR__;
    require_once './vendor/autoload.php';
    require_once './helpers/session_helper.php';
    require_once './helpers/routing_helpers.php';
    use Pecee\SimpleRouter\SimpleRouter;
    require_once './controllers/inicioController.php';
    require_once './controllers/usuario.php';
    require_once './controllers/adminController.php';
    require_once './controllers/pregunta.php';
    require_once './controllers/solicitudController.php';  

    SimpleRouter::get('/TASTI/', [InicioController::class, 'index'])->name('index');
    SimpleRouter::get('/TASTI/inicio/{ESTADO}/{CURSO}/{ANIO}', [InicioController::class, 'get_preguntas'])->name('Inicio');
    SimpleRouter::get('/TASTI/publicar', function() {
        require_once('./views/publicar_pregunta.php');
    });
    SimpleRouter::get('/TASTI/perfil/{cui?}', [Users::class, 'getPerfil'])->name('perfil');
    SimpleRouter::get('/TASTI/logout', [Users::class, 'logout'])->name('logout');
    SimpleRouter::get('/TASTI/login', [Users::class, 'goTo_login'])->name('login');
    SimpleRouter::get('/TASTI/registrarse', [Users::class, 'goTo_registro'])->name('signup');
    SimpleRouter::get('/TASTI/administrador/solicitudes/{estado_solicitud}', [AdminController::class, 'solicitud_registro'])->name('admin_ver_solicitud_registro');
    SimpleRouter::get('/TASTI/administrador/reportes/{estado_reporte}', [AdminController::class, 'solicitud_revision_pregunta'])->name('admin_ver_reporte_pregunta');
    SimpleRouter::get('/TASTI/buscar/{tema}/{estado?}', [PreguntaController::class, 'search_by_tema']);
    SimpleRouter::get('/TASTI/pregunta/{id_pregunta}', [PreguntaController::class, 'show_question'])->setName('pregunta_view');
    SimpleRouter::get('/TASTI/reporte/pregunta/{id_pregunta}', [SolicitudController::class, 'go_to_formulario_revision_pregunta'])->name('crear_reporte_pregunta');
    SimpleRouter::post('/TASTI/publicando', [PreguntaController::class, 'store'])->setName('post_store_pregunta');
    SimpleRouter::post('/TASTI/miPerfil/actualizando_descripcion', [Users::class, 'actualizar_perfil'])->setName('post_update_description');
    SimpleRouter::post('/TASTI/miPerfil/actualizando_img', [Users::class, 'subir_imagen'])->setName('post_update_img');
    SimpleRouter::post('/TASTI/iniciando_sesion', [Users::class, 'login'])->setName('post_login');
    SimpleRouter::post('/TASTI/registrado_usuario', [Users::class, 'register'])->setName('post_signup');
    SimpleRouter::post('/TASTI/reporte/pregunta/creando', [SolicitudController::class, 'crear_solicitud_revision'])->name('post_crear_reporte_pregunta');
    SimpleRouter::start();

?>