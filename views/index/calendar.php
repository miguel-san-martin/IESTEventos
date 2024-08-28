

<?php $script = "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js' integrity='sha512-egJ/Y+22P9NQ9aIyVCh0VCOsfydyn8eNmqBy+y2CnJG+fpRIxXMS6jbWP8tVKp0jp+NO5n8WtMUAnNnGoJKi4w==' crossorigin='anonymous' referrerpolicy='no-referrer'></script>    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='http://localhost/IESTEventos/build/js/index/calendar.js'></script>

"; ?>
<!--<div class="indexCalendar">
    <div onclick="window.location.href = '/'">Inicio</div>&nbsp;
        <div>/</div>&nbsp;
    <div onclick="window.location.href = '/calendar'">Calendario de Eventos</div>
</div>
<div class="grid-contenedor-indexFilter">
    <div class="cell_indexFilter cell1_indexFilter">
        Próximos Eventos
    </div>
    <div class="cell_indexFilter cell2_indexFilter">
        Filtrar por:
    </div>
    <div class="cell_indexFilter cell3_indexFilter">
        <select name="sources" id="categorias" class="custom-select sources" placeholder="Categorías">                        
            <option value="emprendimiento-innovavion">Emprendimiento e Innovación</option>
            <option value="marketing-comunicacion">Marketing y Comunicación</option>
            <option value="economia-negocios">Economía y Negocios</option>
            <option value="all">Todas las categorías</option>
        </select>
    </div>
    <div class="cell_indexFilter cell4_indexFilter">
        <select name="sources" id="modalidad" class="custom-select sources" placeholder="Modalidad">
            <option value="emprendimiento-innovavion">Presencial</option>
            <option value="marketing-comunicacion">En Línea</option>
            <option value="all">Todas las modalidades</option>
        </select>
    </div>
</div>-->
<br>
<?php foreach ($eventos as $evento): ?>
<div id="fadeInEvento" class="animatable fadeInDown" style="padding: 1rem">
    <div class="grid-contenedor-eventoCalendar" onclick="location.href='evento?id=<?php echo $evento['token']?>';">
        <div class="cell_eventoCalendar cell1_eventoCalendar">
            <img class="img-eventoCalendar" src="http://localhost/IESTEventos/build/img/eventos/<?php echo ($evento['token']);?>/<?php echo ($evento['banner_principal']);?>">
        </div>
        <div class="cell_eventoCalendar cell2_eventoCalendar eventoCalendarFH">
            <?php echo ucfirst($evento['modalidad']); ?>
        </div>
        <?php
        $fecha_formateada_inicial=obtenerFechaFormateada($evento['fecha_inicio']);
        $fecha_formateada_final=obtenerFechaFormateada($evento['fecha_final']);
        ?>
        <div class="cell_eventoCalendar cell3_eventoCalendar eventoCalendarFH">
            <?php echo $fecha_formateada_inicial; ?>
            &nbsp;-&nbsp;
            <?php echo $fecha_formateada_final; ?>
        </div>

        <div class="cell_eventoCalendar cell5_eventoCalendar">
            <div class="eventoCalendarTipo">
                <?php echo ucwords($evento['categoria'])?>
            </div>
        </div>
        <div class="cell_eventoCalendar cell6_eventoCalendar">
            <?php echo ucwords($evento['nombre'])?>
        </div>
        <div class="cell_eventoCalendar cell7_eventoCalendar">
            <?php echo ucfirst($evento['descripcion'])?>
        </div>
        <div class="cell_eventoCalendar cell8_eventoCalendar">
            <div class="detBtnEC" onclick="location.href='evento?id=<?php echo $evento['token']?>';"> Más detalles... </div>
        </div>
    </div>
</div>
<div class="desplegar-miniEventos">
  <div class="box-miniEventos">
        <div class="grid-contenedor-miniEvento">
            <div class="cell_miniEvento cell1_miniEvento">
                <img src="http://localhost/IESTEventos/build/img/eventos/<?php echo ($evento['token']);?>/<?php echo ($evento['banner_principal']);?>">
            </div>
            <div class="cell_miniEvento cell2_miniEvento">
                <?php echo ucwords($evento['nombre'])?>
            </div>
            <div class="cell_miniEvento cell3_miniEvento miniEventoFH">
                <?php echo ucfirst($evento['modalidad']); ?>
            </div>
            <div class="cell_miniEvento cell4_miniEvento miniEventoFH">
                <?php echo ucwords($evento['categoria'])?>
            </div>
            <div class="cell_miniEvento cell5_miniEvento miniEventoFH">
                <?php echo $fecha_formateada_inicial; ?>
            </div>
            <div class="cell_miniEvento cell6_miniEvento miniEventoFH">
                <?php echo $fecha_formateada_final; ?>
            </div>
            <div class="cell_miniEvento cell7_miniEvento">
                <?php echo ucfirst($evento['descripcion'])?>
            </div>
            <div class="cell_miniEvento cell8_miniEvento">
                <div class="detBtnEC" onclick="location.href='evento?id=<?php echo $evento['token']?>';"> Más detalles... </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>


<?php 
function obtenerFechaFormateada($date) {
  // Convertir la fecha en formato 'Y-m-d H:i:s' a un objeto DateTime
  $fechaInicio = new DateTime($date);

  // Días de la semana en español
  $diasSemana = array('domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado');

  // Meses en español
  $meses = array(
    'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
    'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
  );

  // Formatear el nombre del día de la semana en español
  $diaSemanaFormateado = $diasSemana[$fechaInicio->format('w')];

  // Obtener el día del mes, el mes y el año
  $diaMes = $fechaInicio->format('j');
  $mes = $meses[$fechaInicio->format('n') - 1];
  $anio = $fechaInicio->format('Y');

  // Formatear la hora
  $hora = $fechaInicio->format('H:i');

  // Construir la fecha y hora formateada
  $fechaFormateada = "{$diaSemanaFormateado}, {$diaMes} de {$mes} de {$anio}";
  $horaFormateada = "a las {$hora} hrs";

  return "{$fechaFormateada}, {$horaFormateada}";
}
 ?>