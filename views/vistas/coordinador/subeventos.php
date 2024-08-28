<div class="bg-grisBajo">
    <a class="" href="http://localhost/IESTEventos/Coordinador/" style="font-size:2rem;padding:1rem;margin:1rem;"><span>/Regresar al DashBoard</span></a>
</div>
<div class="dashboard-derecho bg-naranja">
    <h2 class=" ">Evento: <?php echo $nombreevento?></h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="">Evento Nombre</th>
                    <th class="">Fecha</th>
                    <th class="">Crear SubEventos</th>
                    <th class="">Ver SubEventos</th>
                </tr>
            </thead>
            <tbody id="celdas_revision" class="bg-blanco">
                <?php
          foreach ($eventos['info'] as $evento):?>
                <tr>
                    <td data-label="Nombre" class="color-negro"><?php echo $evento['nombre_eventodia'] ?></td>
                    <td data-label="Fecha" class="color-azulM"><?php echo $evento['fecha_eventodia'] ?></td>
                    <td data-label="Crear SubEvento">
                        <p onclick="crear_sub('<?php echo $evento['id']; ?>','','')" class="boton verde">Crear</p>
                    </td>
                    <td data-label="Ver SubEvento">
                        <p onclick="ver_subeventos('<?php echo $evento['id']; ?>')" class="boton verde">Ver</p>
                    </td>
                </tr>

                <?php  endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $script = "
    <script src='http://localhost/IESTEventos/build/js/vistas/coordinador/subevento.js'></script>
"; ?>