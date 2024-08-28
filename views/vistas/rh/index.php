
<div class="contenedor">
    <H1 class="color-azulM centrar-texto">Hola, <?php echo $_SESSION['nombre'] ;?></H1>
    <div class="flex-div-hz  centrar-texto">
        <div class="campo no-margin">
            <input id="buscador" type="text" placeholder="Buscar Usuario" class="buscador">
        </div>
        <svg id="agregar"class="icono"viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"width="30px" height="30px" stroke="#1ae000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 12H12M12 12H9M12 12V9M12 12V15M17 21H7C4.79086 21 3 19.2091 3 17V7C3 4.79086 4.79086 3 7 3H17C19.2091 3 21 4.79086 21 7V17C21 19.2091 19.2091 21 17 21Z" stroke="#18e109" stroke-width="2" stroke-linecap="round"></path> </g></svg>
    </div>
    <table >
    <thead>
        <tr>
            <th class="centrar-texto">Nombre</th>
            <th class="centrar-texto">Jerarquia</th>
            <th class="centrar-texto">Borrar</th>
            <th class="centrar-texto">Modificar</th>
        </tr>
    </thead>
    <tbody id="celdas">
   
    </tbody>
    </table>
</div>
<?php $script="
    <script src='http://localhost/IESTEventos/build/js/vistas/rh/dashboardrh.js'></script>
    <script src='http://localhost/IESTEventos/build/js/general/variables.js'></script>
" ;?>