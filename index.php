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
    SimpleRouter::get('/TASTI/inicio/{ESTADO}/{CURSO}/{ANIO}', [InicioController::class, 'get_preguntas'])->name('inicio');
    SimpleRouter::get('/TASTI/publicar', function() {
        require_once('./views/publicar_pregunta.php');
    })->name('publicar_pregunta');
    SimpleRouter::get('/TASTI/perfil/{cui?}', [Users::class, 'getPerfil'])->name('perfil');
    SimpleRouter::get('/TASTI/logout', [Users::class, 'logout'])->name('logout');
    SimpleRouter::get('/TASTI/login', [Users::class, 'goTo_login'])->name('login');
    SimpleRouter::get('/TASTI/registrarse', [Users::class, 'goTo_registro'])->name('signup');
    SimpleRouter::get('/TASTI/administrador/solicitudes/{estado_solicitud}', [AdminController::class, 'solicitud_registro'])->name('admin_ver_solicitud_registro');
    SimpleRouter::get('/TASTI/administrador/reportes/{estado_reporte}', [AdminController::class, 'solicitud_revision_pregunta'])->name('admin_ver_reporte_pregunta');
    SimpleRouter::get('/TASTI/buscar/{tema}/{estado?}', [PreguntaController::class, 'search_by_tema']);
    SimpleRouter::get('/TASTI/pregunta/{id_pregunta}', [PreguntaController::class, 'show_question'])->setName('pregunta_view');
    SimpleRouter::get('/TASTI/reporte/pregunta/{id_pregunta}', [SolicitudController::class, 'go_to_formulario_revision_pregunta'])->name('crear_reporte_pregunta');
    SimpleRouter::get('/TASTI/pregunta/{id_pregunta}/crear_mentoria', [PreguntaController::class, 'go_to_programar_clase'])->name('crear_mentoria');
    SimpleRouter::get('/TASTI/pregunta/{id_pregunta}/eliminar', [PreguntaController::class, 'goTo_formulario_eliminar_pregunta'])->name('borrar_pregunta');
    SimpleRouter::get('/TASTI/pregunta/{id_pregunta}/editar', [PreguntaController::class, 'go_to_edit_question'])->name('editar_pregunta');
    SimpleRouter::post('/TASTI/publicando', [PreguntaController::class, 'store'])->setName('post_store_pregunta');
    SimpleRouter::post('/TASTI/miPerfil/actualizando_descripcion', [Users::class, 'actualizar_perfil'])->setName('post_update_description');
    SimpleRouter::post('/TASTI/miPerfil/actualizando_img', [Users::class, 'subir_imagen'])->setName('post_update_img');
    SimpleRouter::post('/TASTI/iniciando_sesion', [Users::class, 'login'])->setName('post_login');
    SimpleRouter::post('/TASTI/registrado_usuario', [Users::class, 'register'])->setName('post_signup');
    SimpleRouter::post('/TASTI/reporte/pregunta/creando', [SolicitudController::class, 'crear_solicitud_revision'])->name('post_crear_reporte_pregunta');
    SimpleRouter::post('/TASTI/pregunta/creando_mentoria', [PreguntaController::class, 'schedule_class'])->name('post_crear_mentoria');
    SimpleRouter::post('/TASTI/pregunta/cancelando_mentoria', [PreguntaController::class, 'cancelar_mentoria'])->name('post_cancelar_mentoria');
    SimpleRouter::post('/TASTI/pregunta/cancelando_participacion', [PreguntaController::class, 'no_participar_mentoria'])->name('post_no_participar_mentoria');
    SimpleRouter::post('/TASTI/pregunta/registrando_participacion', [PreguntaController::class, 'participar_mentoria'])->name('post_participar_mentoria');
    SimpleRouter::post('/TASTI/pregunta/confirmando_mentoria', [PreguntaController::class, 'confirmar_mentoria'])->name('post_confirmar_mentoria');
    SimpleRouter::post('/TASTI/pregunta/borrando', [PreguntaController::class, 'borrar_pregunta'])->name('post_borrar_pregunta');
    SimpleRouter::post('/TASTI/pregunta/editando', [PreguntaController::class, 'edit_question'])->name('post_editar_pregunta');
    SimpleRouter::post('/TASTI/administrador/reporte/procesar', [AdminController::class, 'go_to_formulario_eliminar'])->name('procesar_reporte_formulario');
    SimpleRouter::post('/TASTI/administrador/reporte/procesando', [AdminController::class, 'solicitud_pregunta_procesada'])->name('post_procesar_solicitud_pregunta');
    SimpleRouter::post('/TASTI/administrador/solicitud/procesar', [AdminController::class, 'go_to_formulario_denegar_registro'])->name('denegar_reporte_formulario');
    SimpleRouter::post('/TASTI/administrador/solicitud/procesando', [AdminController::class, 'solicitud_registro_procesada'])->name('post_procesar_reporte');

    SimpleRouter::start();

?>