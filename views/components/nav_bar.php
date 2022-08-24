<nav class="nav-bar">
    <h1><a href="/TASTI/"><span class="logo-title logo-icon"></span></a></h1>
    <div>
        <form class="nav-bar__barra_busqueda" onsubmit="return handleSubmit()"> 
            <input hidden name="action" value="buscar_tema">
            <input required name="tema" id="tema" placeholder="Buscar tema">
            <button type="button" onclick="return handleSubmit()"><span class="span-icon search-icon"></span></button>
        </form>
    </div>
    <a href="/TASTI/publicar" class="nav-bar__publicar-pregunta">+ Publicar Pregunta</a>
    <div class="nav-bar__perfil">
        <?php if($_SESSION['admin']==1) : ?>
            <a href="<?php echo url('admin_ver_solicitud_registro',['estado_solicitud' => 'pendiente']); ?>" class="nav-bar__administrador"><span class="admin-icon"></span></a>
        <?php endif; ?>
        <a href="/TASTI/perfil/<?php echo $_SESSION['usersCUI'];?>" class="nav-bar__perfil__user-name">
            <span class="user-image"></span> 
            <p> <?php echo $_SESSION['usersEmail'];?></p>
        </a>
        <a href="/TASTI/logout">Logout</a>
    </div>
</nav>

<script>
    function handleSubmit(){
        var tema_input = document.getElementById("tema");  
        if(tema_input.checkValidity()){
            location.href = "/TASTI/buscar/" + tema_input.value;
        } 
        else {
            tema_input.reportValidity();
        }
    }
</script>