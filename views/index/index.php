<br>
<div class="grid-contenedor-barCont">
    <div class="cell_barCont cell1_barCont">
        <a class="a-noEffect" href="calendar">Próximos Eventos</a>
    </div>
    <div class="cell_barCont cell2_barCont">
        <a class="a-barCont" href="calendar">Calendario de Eventos&nbsp;&nbsp;<i
                class="fa-regular fa-calendar-days"></i></a>
    </div>
    <div class="cell_barCont cell3_barCont">
        <a class="a-noEffect" href="calendar">Próximos Eventos&nbsp;&nbsp;&nbsp;<i
                class="fa-regular fa-calendar-days"></i></a>
    </div>
</div>
<div class="grid-contenedor-eventosLP">
    <?php
	//$totalEventos = count($eventos); // Contar los elementos en el array
    //echo "<p>Total de eventos: $totalEventos</p>"; // Mostrar el total de eventos
    //Si eventos llega vacio, ni entra al forech
    $i = 1;
    foreach ($eventos as $evento) {
        if ($i > 3) break;
        $token = $evento['token'];
        $banner = $evento['banner_principal'];
    ?>
        <div class="cell_eventosLP cell<?php echo $i; ?>_eventosLP">
            <img onclick="location.href='evento?id=<?php echo $token ?>';" src="<?php echo $banner ?>" alt="">
        </div>
    <?php
        $i++;
    }

    if ($i < 3) {
        for ($j = $i; $j < 4; $j++) {
    ?>
            <div class="cell_eventosLP cell<?php echo $j; ?>_eventosLP">
                <img onclick="location.href='calendar';" src="https://sie.iest.edu.mx/IESTEventos/build/img/CalendarioDefault.png" alt="">
            </div>
    <?php
        }
    }
    ?>
    <div class="cell_eventosLP cell4_eventosLP">
        <img onclick="location.href='calendar';" src="https://sie.iest.edu.mx/IESTEventos/build/img/CalendarioDefault.png" alt="">
    </div>
</div>
