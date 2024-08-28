<!--SECCION QUE MUESTRA LOS 3 ULTIMOS EVENTOS-->
<br>
<div class="grid-contenedor-barCont">
    <div class="cell_barCont cell1_barCont">
        <a class="a-noEffect">Próximos Eventos</a>
    </div>
    <div class="cell_barCont cell2_barCont">
        <a class="a-barCont" href="calendar">Calendario de Eventos&nbsp;&nbsp;<i
                class="fa-regular fa-calendar-days"></i></a>
    </div>

</div>
<div class="grid-contenedor-eventosLP">
    <?php
    $i = 1;
    foreach ($eventos as $evento) {
        if ($i > 3) break;

        $token = $evento['token'];
        $banner = $evento['banner_principal'];
    ?>
        <div class="cell_eventosLP cell<?php echo $i; ?>_eventosLP">
            <img onclick="location.href='evento?id=<?php echo $token ?>';" src="http://localhost/IESTEventos/build/img/eventos/<?php echo $token ?>/<?php echo $banner ?>" alt="">
        </div>
    <?php
        $i++;
    }

    if ($i < 3) {
        for ($j = $i; $j < 4; $j++) {
    ?>
            <div class="cell_eventosLP cell<?php echo $j; ?>_eventosLP">
                <img onclick="location.href='calendar';" src="http://localhost/IESTEventos/build/img/CalendarioDefault.png" alt="">
            </div>
    <?php
        }
    }
    ?>
<!--    IMAGEN POR DEFECTO LA NO.4-->
    <div class="cell_eventosLP cell4_eventosLP">
        <img onclick="location.href='calendar';" src="http://localhost/IESTEventos/build/img/CalendarioDefault.png" alt="">
    </div>
</div>
