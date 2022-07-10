<!-- CSS: <link rel="stylesheet" href="components/nav_bar.css"> -->

<nav class="nav-bar">
    <h1><a href="../index.php"><span class="logo-title logo-icon"></span></a></h1>
    <div>
        <form class="nav-bar__barra_busqueda" action="#" method="get"> 
            <select name="curso" id="curso">
                <option class="hidden_option" selected disabled> Año </option>
                <?php if (isset($anios_registrados) && $anios_registrados!=0): ?>
                <?php foreach ($anios_registrados as $dato) { ?>
                    <option value="<?php echo $dato->anio?>"><?php echo $dato->anio?><span> año</span></option>
                <?php } ?>
                <?php else: ?>
                    <option class="hidden_option" selected disabled> "No hay cursos agregados" </option>
                <?php endif; ?>
            </select>
            <input name="tema" id="tema" placeholder="Buscar tema">
            <button type="submit"><span class="span-icon search-icon"></span></button>
        </form>
    </div>
    <a href="../views/publicar_pregunta.php" class="nav-bar__publicar-pregunta">+ Publicar Pregunta</a>
    <div class="nav-bar__perfil">
        <?php if($_SESSION['admin']==1) : ?>
            <a href="../controllers/adminController.php?action=solicitudRegistro&solicitud=pendiente" class="nav-bar__administrador"><span class="admin-icon"></span></a>
        <?php endif; ?>
        <a href="../controllers/usuario.php?q=profile" class="nav-bar__perfil__user-name">
            <span class="user-image"></span> 
            <p> <?php echo $_SESSION['usersEmail'];?></p>
        </a>
    </div>
</nav>