<div class="dashboard animate__animated animate__fadeInDown">
  <div class="dashboard-izquierdo  ">
    <p id="btn_revisar" class="boton naranja" value="paso-2">Eventos a revisar</p>
  </div>

  <div class="dashboard-derecho">
    <div id="paso-1">
      <h2 class="color-azulM ">Bienvenido, <span class="color-naranja"><?php echo $_SESSION['nombre']; ?></span></h2>
    </div>
    <!--(Paso2)Formulario de crear evento-->
    <div id="paso-2" class="ocultar">
      <h3 class="color-azulM ">Revision de eventos</h3>
      <div>
        <table border="1">
          <thead>
            <tr>
              <th class="centrar-texto">Evento</th>
              <th class="centrar-texto">Estatus</th>
              <th class="centrar-texto">Lugar o plataforma</th>
              <th class="centrar-texto">Comentario AV</th>
              <th class="centrar-texto">Mas detalles</th>
            </tr>
          </thead>
          <tbody id="celdas">

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php $script = "
    <script src='https://sie.iest.edu.mx/IESTEventos/build/js/general/dashboard.js'></script>
    <script src='https://sie.iest.edu.mx/IESTEventos/build/js/vistas/vicerector/index.js'></script>
"; ?>