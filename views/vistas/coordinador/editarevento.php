<?php foreach ($eventoselecc['info'] as $evento):?>

<?php
    // Supongamos que ya tienes las fechas como objetos DateTime
$fecha_inicio = new DateTime($evento['fecha_inicio']);
$fecha_final = new DateTime( $evento['fecha_final']);

// Obtener la fecha y la hora de la fecha de inicio
$fecha_inicio_str = $fecha_inicio->format('Y-m-d');
$hora_inicio = $fecha_inicio->format('H:i:s');

// Obtener la fecha y la hora de la fecha final
$fecha_final_str = $fecha_final->format('Y-m-d');
$hora_final = $fecha_final->format('H:i:s');

    //Se convierten las divisiones y publico dirigido a array
    $cadena = $evento['publico_dirigido'];
    $arraydirigido = explode(",", $cadena);
    $cadena = $evento['publico_divisiones'];
    $arraydivisiones = explode(",", $cadena);
  ?>
<script>
const evento = {
    //Se asigna los valores del evento al objeto
    banner1: '<?php echo $evento['banner_principal']; ?>',
    banner2: '<?php echo $evento['banner_secundario']; ?>',
    banner1viejo: '<?php echo $evento['banner_principal']; ?>',
    banner2viejo: '<?php echo $evento['banner_secundario']; ?>',
    idevento: '<?php echo $evento['id'] ?>',
    nombre: '<?php echo $evento['nombre']; ?>',
    descripcion: '<?php echo $evento['descripcion'];?>',
    nombre_responsable: '<?php echo $evento['nombre_responsable']; ?>',
    contacto_responsable: '<?php echo $evento['contacto_responsable']; ?>',
    categoria: '<?php echo $evento['categoria']; ?>',
    fechaini: '<?php echo $fecha_inicio_str; ?>',
    horai: '<?php echo $hora_inicio; ?>',
    fechafin: '<?php echo $fecha_final_str; ?>',
    horaf: '<?php echo $hora_final; ?>',
    token: '<?php echo $evento['token']; ?>',
    modalidad: '<?php echo $evento['modalidad']; ?>',
    responsable_alta: '<?php echo $evento['creador_evento']; ?>',
    publico: {
        dirigido: <?php echo json_encode($arraydirigido); ?>,
        divisiones: <?php echo json_encode($arraydivisiones); ?>,
        division: '<?php echo $evento['division']; ?>'
    },
    <?php if($evento['modalidad']=='Presencial'):?>
    presencial: {
        id_lugar: '<?php echo $evento['lugar_id']; ?>',
        lugar_nombre: '<?php echo $evento['lugar_presencial']; ?>',
        lugar_direccion: '<?php echo $evento['lugar_direccion']; ?>',
        lugar_cupo_max: '<?php echo $evento['lugar_cupo_max']??0; ?>',
    },
    <?php else:?>
    online: {
        id: '<?php echo $evento['virtual_id']; ?>',
        virtual_link: '<?php echo $evento['virtual_link']; ?>',
        virtual_descripcion: '<?php echo $evento['virtual_informacion']; ?>',
        plataformas: '<?php echo $evento['virtual_plataforma']; ?>'
    }
    <?php endif;?>

}
</script>
<div>
    <div class="bg-grisBajo">
        <a class=""href="https://sie.iest.edu.mx/IESTEventos/Coordinador" style="font-size:2rem;"><span>/Regresar al DashBoard</span></a>
    </div>
</div>
<div class="dashboard-derecho">
    <!--(Paso2)Formulario de actualizar evento-->
    <div id="paso-2" class="">
        <h4 id="crear_regresar" class="banner-naranja  clickeable">Regresar</h4>
        <h3 class="color-azulM">Editar Evento</h3>
        <!--(Paso2)Contenido del formulario-->
        <div id="crear_1" class="formulariogral ">
            <div class="columnas">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" type="text" placeholder="Nombre del Evento"
                        value="<?php echo $evento['nombre']?>" disabled>
                </div>
                <div class="campo">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="" id="descripcion"
                        placeholder="Descripción acerca del evento"><?php echo $evento['descripcion']?></textarea>
                </div>
                <div class="campo">
                    <label for="nombre_responsable">Responsable del Evento:</label>
                    <input id="nombre_responsable" value="<?php echo $evento['nombre_responsable']?>" type="text"
                        placeholder="Nombre completo del responsable">
                </div>
                <div class="campo">
                    <label for="contacto_responsable">Contacto del Responsable:</label>
                    <input id="contacto_responsable" value="<?php echo $evento['contacto_responsable']?>" type="tel"
                        placeholder="Numero completo del responsable">
                </div>

                <div class="campo">
                    <label for="categoria">Categoría:</label>
                    <select name="categoria" id="categoria">
                        <option value="" selected="" disabled="">Seleccionar Categoría</option>
                        <option <?php if ($evento['categoria'] == 'Deportivo') : ?> selected <?php endif; ?>
                            value="Deportivo">Deportivo</option>
                        <option <?php if ($evento['categoria'] == 'Artistico') : ?> selected <?php endif; ?>
                            value="Artistico">Artistico</option>
                        <option <?php if ($evento['categoria'] == 'Extra Curricular') : ?> selected <?php endif; ?>
                            value="Extra Curricular">Extra Curricular</option>
                        <option <?php if ($evento['categoria'] == 'Conferencía') : ?> selected <?php endif; ?>
                            value="Conferencía">Conferencía</option>
                        <option <?php if ($evento['categoria'] == 'Congreso') : ?> selected <?php endif; ?>
                            value="Congreso">Congreso</option>
                        <option <?php if ($evento['categoria'] == 'Voluntariado') : ?> selected <?php endif; ?>
                            value="Voluntariado">Voluntariado</option>
                        <option <?php if ($evento['categoria'] == 'Deportes') : ?> selected <?php endif; ?>
                            value="Deportes">Deportes</option>
                        <option <?php if ($evento['categoria'] == 'PLEAS') : ?> selected <?php endif; ?> value="PLEAS">
                            PLEAS</option>
                        <option <?php if ($evento['categoria'] == 'FESAL') : ?> selected <?php endif; ?> value="FESAL">
                            FESAL</option>
                        <option <?php if ($evento['categoria'] == 'Pastoral') : ?> selected <?php endif; ?>
                            value="Pastoral">Pastoral</option>
                    </select>
                </div>

                <div class="campo">
                    <label for="modalidad">Modalidad de Evento:</label>
                    <select name="modalidad" id="modalidad">
                        <option value="" selected="" disabled="">Modalidad</option>
                        <option value="<?php echo $evento['modalidad']; ?>" selected disabled>
                            <?php echo $evento['modalidad']; ?></option>
                    </select>
                </div>
                <?php if($evento['modalidad']=='Virtual'):?>
                <!--(Paso2)Inputs, para evento virtual-->
                <div id="div_virtual" class="">
                    <p>¿Plataforma donde sera el evento?</p>
                    <div id="" class="grid-column-3">
                        <div>
                            <label for="app_fb">FaceBook Live:</label>
                            <input <?php if($evento['virtual_plataforma'] == 'fb_live'): ?>checked<?php endif; ?>
                                id="app_fb" type="radio" name="app_virtual" value="fb_live">

                        </div>
                        <div>
                            <label for="app_meet">Google Meets</label>
                            <input <?php if($evento['virtual_plataforma']=='meets'):?>checked <?php endif?>id="app_meet"
                                type="radio" name="app_virtual" value="meets">
                        </div>
                        <div>
                            <label for="app_teams">Teams</label>
                            <input <?php if($evento['virtual_plataforma']=='teams'):?>checked
                                <?php endif?>id="app_teams" type="radio" name="app_virtual" value="teams">
                        </div>
                    </div>
                    <div id="" class="campo">
                        <label for="virtual_link">Link:</label>
                        <input value="<?php echo $evento['virtual_link'];?>" id="virtual_link" type="text"
                            placeholder="Link de la reunion">
                    </div>
                    <div id="" class="campo">
                        <label for="virtual_descripcion">Infomacion de la plataforma</label>
                        <textarea name="" id="virtual_descripcion"
                            placeholder="Informacion acerca del link del evento virtual: contraseña, codigo de acceso etc"><?php echo $evento['virtual_informacion']; ?></textarea>
                    </div>
                </div>
                <?php else:?>
                <!--(Paso2)Inputs, para evento presencial-->
                <div id="div_presencial" class="">
                    <div id="ubi_int" class="campo">
                        <label for="nombreevento">Lugar:</label>
                        <select onchange="seleccionlugar()" name="" id="selecc_lugar">
                            <option value="0" disabled="" selected="">Seleccionar Lugar</option>
                            <option class="centrar-texto" value="" disabled>---Lugares Interiores---</option>
                            <?php foreach ($lugares['info'] as $opcion) : ?>
                            <option <?php if($opcion['id']==$evento['lugar_id']):?>selected <?php endif;?>
                                value="<?php echo $opcion['id'] ?>">
                                <?php echo mb_convert_encoding($opcion['lugar_nombre'], 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="interior" class="">
                        <div class="campo">
                            <label for="int_direccion">Dirección Lugar:</label>
                            <textarea name="" id="int_direccion"
                                disabled=""><?php echo $evento['lugar_direccion']?></textarea>
                        </div>
                        <div class="campo">
                            <label for="int_max">Cupo Maximo:</label>
                            <input value="<?php echo $evento['lugar_cupo_max']??0?>" type="number" id="int_max"
                                disabled="">
                        </div>
                    </div>
                    <div id="otro" class="ocultar">
                        <div class="campo">
                            <label for="ext_nombre">Nombre Lugar:</label>
                            <input type="text" id="ext_nombre">
                        </div>
                        <div class="campo">
                            <label for="ext_direccion">Dirección Lugar:</label>
                            <textarea name="" id="ext_direccion"></textarea>
                        </div>
                        <div class="campo">
                            <label for="ext_max">Cupo Maximo:</label>
                            <input type="number" id="ext_max">
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <!--(Paso2)Inputs generales para evento-->
            <div class="columnas">
                <div class="campo">
                    <label for="fecha">Fecha Inicio:</label>
                    <input type="date" id="fechaini" value="<?php echo $fecha_inicio_str?>"disabled>
                </div>
                <div id="div_horai" class="">
                    <div class="campo">
                        <label for="horai">Hora Inicio:</label>
                        <input id="horai" type="time" value="<?php echo $hora_inicio?>">
                    </div>
                </div>
                <div class="campo">
                    <label for="fecha">Fecha Finalización:</label>
                    <input type="date" id="fechafin" value="<?php echo $fecha_final_str?>"disabled>
                </div>
                <div class="campo">
                    <label for="horaf">Hora Final:</label>
                    <input id="horaf" type="time" value="<?php echo $hora_final?>">
                </div>
                <div class="campo">
                    <label for="image_uploads">Banner Principal(No es necesario subir la foto de nuevo si no la deseas
                        cambiar)</label>
                    <input type="file" id="banner1" name="image_uploads" accept=".jpg, .jpeg, .png" multiple="">
                </div>
                <div class="campo">
                    <label for="image_uploads">Imagen Secundaria(No es necesario subir la foto de nuevo si no la deseas
                        cambiar)</label>
                    <input type="file" id="banner2" name="image_uploads" accept=".jpg, .jpeg, .png" multiple="">
                </div>
                <div>
                    <p id="btn_info2" class="boton verde centrar-texto">Seguir para editar</p>
                </div>
            </div>
        </div>
        <!--(Paso2)parte 2-Inputs, para filtrar eventos division y semestres-->
        <div id="crear_2" class="ocultar ">
            <h4 id="editar_regresar" class="banner-naranja  clickeable">Regresar</h4>
            <div class="formulariogral">
                <div class="columnas">
                    <h4 class="color-negro">¿Para que nivel de estudios va dirigido?<br>
                        <div class="flex-div-vert-nocenter">
                            <div class="campo flex-div-vert">
                                <input <?php if($evento['division']=='General'):?>checked <?php endif;?>
                                    onchange="publico_evento(this)" type="radio" name="dirigido_nivelEstudios"
                                    value="general">
                                <label for="">General</label>
                            </div>
                            <div class="campo flex-div-vert">
                                <input <?php if($evento['division']=='Preparatoria'):?>checked <?php endif;?>
                                    type="radio" name="dirigido_nivelEstudios" value="prepa"
                                    onchange="publico_evento(this)">
                                <label for="">Preparatoria</label>
                            </div>
                            <div class="campo flex-div-vert">
                                <input <?php if($evento['division']=='Universidad'):?>checked <?php endif;?>
                                    type="radio" name="dirigido_nivelEstudios" value="uni"
                                    onchange="publico_evento(this)">
                                <label for="">Universidad</label>
                            </div>
                            <div class="campo flex-div-vert">
                                <input <?php if($evento['division']=='Universidad y Preparatoria'):?>checked
                                    <?php endif;?> type="radio" name="dirigido_nivelEstudios" value="ambos"
                                    onchange="publico_evento(this)">
                                <label for="">Ambos</label>
                            </div>
                        </div>
                        <div id="div_divisiones">
                            <h4 class="color-negro">¿El evento es para todas las divisones y semestres?</h4><br>
                            <div class="flex-div-vert-nocenter">
                                <div class="campo">
                                    <label for="">Si</label>
                                    
                                    <input <?php if($evento['publico_dirigido']=='todos' || $evento['publico_dirigido']=='general'):?>checked <?php endif;?>
                                        value="si" type="radio" onchange="dirigido_divisiones(this)"
                                        name="dirigido_divisiones">
                                </div>
                                <div class="campo">
                                    <label for="">No</label>
                                    
                                    <input <?php if($evento['publico_dirigido']!='todos' && $evento['publico_dirigido']!='general'):?>checked <?php endif;?>
                                      value="no" type="radio" name="dirigido_divisiones"
                                      onchange="dirigido_divisiones(this)">
                                </div>
                            </div>
                        </div>
                        <div id="div_semestres" class="ocultar">
                            <h4 class="color-negro">¿Para que semestre sera dirigido?</h4><br><br>
                            <div class="formulariogral">
                                <div class="columnas flex-div-vert">
                                    <div class="">
                                        <label for="">1er</label>
                                        <input <?php if (in_array("01", $arraydirigido)):?>checked <?php endif;?>
                                            value="01" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">2do</label>
                                        <input <?php if (in_array('02', $arraydirigido)):?>checked
                                            <?php endif;?>value="02" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">3er</label>
                                        <input <?php if (in_array('03', $arraydirigido)):?>checked
                                            <?php endif;?>value="03" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">4to</label>
                                        <input <?php if (in_array('04', $arraydirigido)):?>checked
                                            <?php endif;?>value="04" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">5to</label>
                                        <input <?php if (in_array('05', $arraydirigido)):?>checked
                                            <?php endif;?>value="05" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                </div>
                                <div class="columnas flex-div-vert">
                                    <div class="">
                                        <label for="">6to</label>
                                        <input <?php if (in_array('06', $arraydirigido)):?>checked
                                            <?php endif;?>value="06" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">7mo</label>
                                        <input <?php if (in_array('07', $arraydirigido)):?>checked
                                            <?php endif;?>value="07" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">8vo</label>
                                        <input <?php if (in_array('08', $arraydirigido)):?>checked
                                            <?php endif;?>value="08" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">9no</label>
                                        <input <?php if (in_array('09', $arraydirigido)):?>checked
                                            <?php endif;?>value="09" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                    <div class="">
                                        <label for="">10mo</label>
                                        <input <?php if (in_array('10', $arraydirigido)):?>checked
                                            <?php endif;?>value="10" type="checkbox" onchange="agregarSemestre(this)"
                                            name="dirigido_semestres">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </h4>
                </div>
                <div class="columas">
                    <div id="divisiones">
                        <div id="divisiones_prepa" class="ocultar">
                            <h4 class="color-negro centrar-texto">Seleccione las divisiones a la cual va dirigido</h4>
                            <br>
                            <fieldset>
                                <legend>Preparatoria</legend>
                                <?php foreach ($divisiones['info'] as $division) : ?>
                                <?php if ($division['nivel_estudios'] == 'Preparatoria') : ?>
                                <div class="">
                                    <label class=""
                                        for="<?php echo $division['id']; ?>"><?php echo $division['nombre_division']; ?></label>
                                    <input <?php if (in_array($division['id'], $arraydivisiones)):?>checked
                                        <?php endif;?> name="semestres_prepa" onchange="agegardivisiones(this)"
                                        id="<?php echo $division['id']; ?>" type="checkbox"
                                        value="<?php echo $division['id']; ?>">
                                </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </fieldset>
                        </div>
                        <div id="divisiones_uni" class="ocultar">
                            <h4 class="color-negro centrar-texto">Seleccione las divisiones a la cual va dirigido</h4>
                            <br>
                            <fieldset>
                                <legend>Universidad</legend>
                                <?php foreach ($divisiones2['info']  as $division) : ?>
                                <?php if ($division['nivel_estudios'] == 'Universidad') : ?>
                                <div class="">
                                    <label class=""
                                        for="<?php echo $division['id']; ?>"><?php echo $division['nombre_division']; ?></label>
                                    <input <?php if (in_array($division['id'], $arraydivisiones)):?>checked
                                        <?php endif;?> name="semestres_uni" onchange="agegardivisiones(this)" class=""
                                        title="Esto es un ejemplo" id="<?php echo $division['id']; ?>" type="checkbox"
                                        value="<?php echo $division['id']; ?>">
                                </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div id="div_crear_fin" class="campo ocultar">
                <p id="btn_crearEvento" class="boton verde centrar-texto">Actualizar Evento</p>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php $script = "
    <script src='https://sie.iest.edu.mx/IESTEventos/build/js/vistas/coordinador/editarEvento.js'></script>

"; ?>