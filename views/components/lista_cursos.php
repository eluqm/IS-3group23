<aside class="lista-cursos">
    <form id="curso_por_anio" class="lista-cursos__header" action="#" method="get"> 
        <select onchange="onSelectChange();" name="anio" id="anio">
            <?php if (isset($anios_registrados) && $anios_registrados!=0): ?>
            <option class="hidden_option" selected disabled><?php echo $q_anio ?><span> año</span></option>
            <?php foreach ($anios_registrados as $dato) { ?>
            <option value="<?php echo $dato->anio?>"><?php echo $dato->anio?><span> año</span></option>
            <?php } ?>
                <?php else: ?>
            <option class="hidden_option" selected disabled> "No hay cursos agregados" </option>
            <?php endif; ?>
        </select>
    </form>
                
    <div class="lista-cursos__contenedor-cursos">
                    <!-- Traer de la base de datos -->      
        <?php if (isset($lista_curso) && $lista_curso!=0): ?>
        <?php foreach ($lista_curso as $dato) { ?>
            <a class="lista-cursos__curso" href="#"><?php echo $dato->nombre ?></a>
        <?php } ?>
        <?php else: ?>
            <p>No hay cursos agregados :)</p>
        <?php endif; ?>
    </div>                            
</aside>

<script>
        function onSelectChange(){
            document.getElementById('curso_por_anio').submit();
        }
</script>