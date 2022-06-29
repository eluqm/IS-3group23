<aside class="lista-cursos">
            <form id="curso_por_anio" class="lista-cursos__header" action="#" method="get"> 
            <select onchange="onSelectChange();" name="anio" id="anio">
            <option class="hidden_option" selected disabled> "Curso actual" </option>
                <option value="1er_anio">Curso 1</option>
                <option value="2er_anio">Curso 2</option>
                <option value="3er_anio">Curso 3</option>
                <option value="4to_anio">Curso 4</option>
                <option value="5to_anio">Curso 5</option>
            </select>
            </form>

            <div class="lista-cursos__contenedor-cursos">
                <!-- Traer de la base de datos -->                    
                <a class="lista-cursos__curso" href="#">Curso 1</a>
                <a class="lista-cursos__curso" href="#">Curso 2</a>
                <a class="lista-cursos__curso" href="#">Curso 3 </a>
                <a class="lista-cursos__curso" href="#">Curso 4 </a>
                <a class="lista-cursos__curso" href="#">Curso 1</a>
                <a class="lista-cursos__curso" href="#">Curso 2</a>
                <a class="lista-cursos__curso" href="#">Curso 3 </a>
                <a class="lista-cursos__curso" href="#">Curso 4 </a>
                <a class="lista-cursos__curso" href="#">Curso 1</a>
                <a class="lista-cursos__curso" href="#">Curso 2</a>
                <a class="lista-cursos__curso" href="#">Curso 3 </a>
                <a class="lista-cursos__curso" href="#">Curso 4 </a>
                <a class="lista-cursos__curso" href="#">Curso 1</a>
                <a class="lista-cursos__curso" href="#">Curso 2</a>
                <a class="lista-cursos__curso" href="#">Curso 3 </a>
                <a class="lista-cursos__curso" href="#">Curso 4 </a>
            </div>

</aside>

<script>
        function onSelectChange(){
            document.getElementById('curso_por_anio').submit();
        }
</script>