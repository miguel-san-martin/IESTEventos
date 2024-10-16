<script>
    var url = new URL(window.location.href);
    var searchParams = new URLSearchParams(url.search);
    var idEvento = searchParams.get("id");
    var registrado=<?php echo json_encode($registrado)?>;
</script>
<?php if($existeSubEventos): ?>
    <script>
        var eventos = <?php echo json_encode($subeventos); ?>;
        var existeSubEventos = <?php echo $existeSubEventos ?>;
    </script>
<?php else: ?>
    <script>
        var existeSubEventos = false;
    </script>
<?php endif; ?>

<?php
foreach ($eventoselecc['info'] as $evento):
    ?>
<div id="rutaIndex" class="indexCalendar">
    <div onclick="window.location.href = ''">Inicio</div>
    &nbsp;<div>/</div>&nbsp;
    <div onclick="window.location.href = 'calendar'">Calendario de Eventos</div>
    &nbsp;<div>/</div>&nbsp;
    <div><?php echo ucwords($evento['nombre']);?></div>
</div>

<div class="title-main"> Información del Evento </div>

<div class="grid-container-mainEvento">
    <div class="cell-mainEvento cell1-mainEvento">
    <img src="<?php echo ($evento['banner_principalv2']);?>">
    </div>
    <div class="cell-mainEvento cell2-mainEvento">
        <?php echo ucwords($evento['nombre']);?>
    </div>
    <?php 
        $fecha_formateada_inicial=obtenerFechaFormateada($evento['fecha_inicio']);
        $fecha_formateada_final=obtenerFechaFormateada($evento['fecha_final']);
    ?> 
    <div class="cell-mainEvento cell3-mainEvento">
        <div class="info-mainEvento">
            <i class="fa-regular fa-calendar-days icon-color-orange"></i>&nbsp;
            <?php echo $fecha_formateada_inicial ;?>
        </div>
    </div>
    <div class="cell-mainEvento cell4-mainEvento">
        <div class="info-mainEvento">
            <i class="fa-regular fa-calendar-days icon-color-orange"></i>&nbsp;
            <?php echo $fecha_formateada_final ;?>
        </div>
    </div>
    <div class="cell-mainEvento cell5-mainEvento">
        <div class="info-mainEvento">
            <i class="fa-solid fa-circle-info icon-color-orange"></i>&nbsp;
            <?php echo ucfirst($evento['modalidad']);?>
        </div>
    </div>
    <div class="cell-mainEvento cell6-mainEvento">
        <div class="info-mainEvento">
            <i class="fa-solid fa-location-dot icon-color-orange"></i>&nbsp;
            <?php if($evento['modalidad']=='Presencial'):?>
            <?php echo ucfirst($evento['lugar_presencial']);?>
            <?php else:?>
            <?php echo ucfirst($evento['virtual_plataforma']);?>
            <?php endif ;?>
        </div>
    </div>
    <div class="cell-mainEvento cell7-mainEvento">
        <div class="info-mainEvento">
        </div>
    </div>
    <div class="cell-mainEvento cell11-mainEvento">
        <div class="info-categoria">
            <?php echo ucfirst($evento['categoria']);?>
        </div>
    </div>
    <div class="cell-mainEvento cell12-mainEvento">
        Descripción:
    </div>
    <div class="cell-mainEvento cell8-mainEvento">
        <?php echo ucfirst($evento['descripcion']);?>
    </div>
    <div class="cell-mainEvento cell9-mainEvento">
        <!-- <div class="btn-uno">
            <div>
                <i class="fa-solid fa-circle-plus"></i>&nbsp;
                Información:
                &nbsp;<i class="fa-regular fa-circle-user"></i>&nbsp;
                <?php echo ucwords($evento['creador_nombre'].' '.$evento['creador_apellidoP']);?>
            </div>
        </div> -->
    </div>
    <?php if($existeSubEventos AND $_SESSION['auth']??false):?>

    <?php endif; ?>
    <div class="cell-mainEvento cell10-mainEvento">
        <?php if($_SESSION['auth']??false):?>
        <?php if(!$registrado):?>
        <p id="registro" class="clickeable btn-dos">Registrarme &nbsp;<i class="fa-solid fa-bell fa-lg"></i></p>
        <?php else:?>
        <p id="yaregistrado" class="yaregistrado clickeable btn-dos">Registrado &nbsp;<i class="fa-solid fa-check fa-lg"
                style="color: #ff6f0f;"></i></p>
        <?php endif ;?>
        <?php else :?>
        <a href="login" class="btn-dos">Inicia Sesión &nbsp;<i class="fa-solid fa-right-to-bracket"></i></a>
        <?php endif ;?>
    </div>
</div>
<?php endforeach ;?>
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
<br><br>
<?php $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='https://sie.iest.edu.mx/IESTEventos/build/js/index/evento.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
"; ?>
