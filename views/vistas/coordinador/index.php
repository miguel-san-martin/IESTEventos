
<div class="dashboard animate__animated animate__fadeInDown">
  <div class="dashboard-izquierdo  ">
    <p id="crear" class="boton naranja animate__animated animate__fadeInLeftBig " value="paso-2">Crear Evento</p>
    <p id="revision" class="boton naranja animate__animated animate__fadeInLeftBig " value="paso-3">Revisión de Eventos</p>
    <p id="vereventos" class="boton naranja animate__animated animate__fadeInLeftBig " value="paso-4">Eventos Publicados</p>
  </div>

  <div class="dashboard-derecho">
    <div id="paso-1">
      <h2 class="color-azulM ">Bienvenido, <span class="color-naranja"><?php echo $_SESSION['nombre']; ?></span></h2>
    </div>
    <!--(Paso2)Formulario de crear evento-->
    <div id="paso-2" class="ocultar">
      <h4 id="crear_regresar" class="banner-naranja ocultar clickeable">Regresar</h4>
      <h3 class="color-azulM">Crear Evento</h3>
      <!--(Paso2)Contenido del formulario-->
      <div id="crear_1" class="formulariogral ">
        <div class="columnas">
          <div class="campo">
            <label for="nombre">Nombre:</label>
            <input id="nombre" type="text" placeholder="Nombre del Evento">
          </div>
          <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea name="" id="descripcion" placeholder="Descripción acerca del evento"></textarea>
          </div>
          <div class="campo">
            <label for="nombre_responsable">Responsable del Evento:</label>
            <input id="nombre_responsable" type="text" placeholder="Nombre completo del responsable">
          </div>
          <div class="campo">
            <label for="contacto_responsable">Contacto del Responsable:</label>
            <input id="contacto_responsable" type="tel" placeholder="Numero completo del responsable">
          </div>

          <div class="campo">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
              <option value=""selected disabled>Seleccionar Categoría</option>
              <option value="Deportivo">Deportivo</option>
              <option value="Artistico">Artistico</option>
              <option value="Extra Curricular">Extra Curricular</option>
              <option value="Conferencía">Conferencía</option>
              <option value="Congreso">Congreso</option>
              <option value="Voluntariado">Voluntariado</option>
              <option value="Deportes">Deportes</option>
              <option value="PLEAS">PLEAS</option>
              <option value="FESAL">FESAL</option>
              <option value="Pastoral">Pastoral</option>
            </select>
          </div>

          <div class="campo">
            <label for="fecha">Modalidad de Evento:</label>
            <select name="" id="modalidad">
              <option value="" selected disabled>Modalidad</option>
              <option value="Virtual">Online</option>
              <option value="Presencial">Presencial</option>
            </select>
          </div>
          
          <!--(Paso2)Inputs, para evento virtual-->
          <div id="div_virtual" class="ocultar">
            <p>¿Plataforma donde sera el evento?</p>
            <div id="" class="grid-column-3">
              <div>
                <label for="app_fb">FaceBook Live:</label>
                <input id="app_fb" type="radio" name="app_virtual" value="fb_live">
              </div>
              <div>
                <label for="app_meet">Google Meets</label>
                <input id="app_meet" type="radio" name="app_virtual" value="meets">
              </div>
              <div>
                <label for="app_teams">Teams</label>
                <input id="app_teams" type="radio" name="app_virtual" value="teams">
              </div>
            </div>
            <div id="" class="campo">
              <label for="virtual_link">Link:</label>
              <input id="virtual_link" type="text" placeholder="Link de la reunion">
            </div>
            <div id="" class="campo">
              <label for="virtual_descripcion">Infomacion de la plataforma</label>
              <textarea name="" id="virtual_descripcion" placeholder="Informacion acerca del link del evento virtual: contraseña, codigo de acceso etc"></textarea>
            </div>
          </div>
          <!--(Paso2)Inputs, para evento presencial-->
          <div id="div_presencial" class="ocultar">
            <div id="ubi_int" class="campo">
              <label for="nombreevento">Lugar:</label>
              <select onchange="seleccionlugar()" name="" id="selecc_lugar">
                <option value="0" disabled selected>Seleccionar Lugar</option>
                <option class="centrar-texto" value="" disabled>---Lugares Interiores---</option>
                <?php foreach ($lugares['info'] as $opcion) : ?>
                    <option value="<?php echo $opcion['id']; ?>"><?php echo mb_convert_encoding($opcion['lugar_nombre'], 'UTF-8'); ?></option>
                <?php endforeach; ?>
                <option class="" value="nuevo">Otro</option>
            </select>
            </div>
            <div id="interior" class="ocultar">
              <div class="campo">
                <label for="int_direccion">Dirección Lugar:</label>
                <textarea name="" id="int_direccion" disabled></textarea>
              </div>
              <div class="campo">
                <label for="int_max">Cupo Maximo:</label>
                <input type="number" id="int_max" disabled>
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
        </div>
        <!--(Paso2)Inputs generales para evento-->
        <div class="columnas">
          <div class="campo">
            <label for="fecha">Fecha Inicio:</label>
            <input type="date" id="fechaini">
          </div>
          <div id="div_horai" class="">
            <div class="campo">
              <label for="horai">Hora Inicio:</label>
              <input id="horai" type="time">
            </div>
          </div>
          <div class="campo">
            <label for="fecha">Fecha Finalización:</label>
            <input type="date" id="fechafin">
          </div>
          <div class="campo">
            <label for="horaf">Hora Final:</label>
            <input id="horaf" type="time">
          </div>
          <div class="campo">
            <label for="image_uploads">Banner Principal</label>
            <input type="file" id="banner1" name="image_uploads" accept=".jpg, .jpeg, .png" multiple id="img_1">
          </div>
          <div class="campo">
            <label for="image_uploads">Imagen Secundaria</label>
            <input type="file" id="banner2" name="image_uploads" accept=".jpg, .jpeg, .png" multiple id="img_2">
          </div>
          <div>
            <p id="btn_info2" class="boton rojo centrar-texto">Acomplete la informacion para continuar</p>
          </div>
        </div>
      </div>
      <!--(Paso2)parte 2-Inputs, para filtrar eventos division y semestres-->
      <div id="crear_2" class="ocultar ">
        <div class="formulariogral">
          <div class="columnas">
            <h4 class="color-negro">¿Para que nivel de estudios va dirigido?</legend><br>
              <div class="flex-div-vert-nocenter">
                <div class="campo flex-div-vert">
                  <input onchange="publico_evento(this)" type="radio" name="dirigido_nivelEstudios" value="general">
                  <label for="">General</label>
                </div>
                <div class="campo flex-div-vert">
                  <input type="radio" name="dirigido_nivelEstudios" value="prepa" onchange="publico_evento(this)">
                  <label for="">Preparatoria</label>
                </div>
                <div class="campo flex-div-vert">
                  <input type="radio" name="dirigido_nivelEstudios" value="uni" onchange="publico_evento(this)">
                  <label for="">Universidad</label>
                </div>
                <div class="campo flex-div-vert">
                  <input type="radio" name="dirigido_nivelEstudios" value="ambos" onchange="publico_evento(this)">
                  <label for="">Ambos</label>
                </div>
              </div>
              <div id="div_divisiones">
                <h4 class="color-negro">¿El evento es para todas las divisones y semestres?</h4><br>
                <div class="flex-div-vert-nocenter">
                  <div class="campo">
                    <label for="">Si</label>
                    <input value="si" type="radio" onchange="dirigido_divisiones(this)" name="dirigido_divisiones">
                  </div>
                  <div class="campo">
                    <label for="">No</label>
                    <input value="no" type="radio" name="dirigido_divisiones" onchange="dirigido_divisiones(this)">
                  </div>
                </div>
              </div>
              <div id="div_semestres" class="ocultar">
                <h4 class="color-negro">¿Para que semestre sera dirigido?</h4><br><br>
                <div class="formulariogral">
                  <div class="columnas flex-div-vert">
                    <div class="">
                      <label for="">1er</label>
                      <input value="01" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">2do</label>
                      <input value="02" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">3er</label>
                      <input value="03" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">4to</label>
                      <input value="04" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">5to</label>
                      <input value="05" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                  </div>
                  <div class="columnas flex-div-vert">
                    <div class="">
                      <label for="">6to</label>
                      <input value="06" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">7mo</label>
                      <input value="07" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">8vo</label>
                      <input value="08" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">9no</label>
                      <input value="09" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                    <div class="">
                      <label for="">10mo</label>
                      <input value="10" type="checkbox" onchange="agregarSemestre(this)" name="dirigido_semestres">
                    </div>
                  </div>
                </div>
              </div>

          </div>
          <div class="columas">
            <div id="divisiones">
              <div id="divisiones_prepa" class="ocultar">
                <h4 class="color-negro centrar-texto">Seleccione las divisiones a la cual va dirigido</h4><br>

                <fieldset>
                  <legend>Preparatoria</legend>
                  <?php for ($i = 0; $i < count($divisiones['info']); $i++) : ?>
                    <?php $division = $divisiones['info'][$i]; ?>
                    <?php if ($division['nivel_estudios'] == 'Preparatoria') : ?>
                        <div class="">
                            <label class="" for="<?php echo $division['id']; ?>"><?php echo $division['nombre_division']; ?></label>
                            <input name="semestres_prepa" onchange="agegardivisiones(this)" id="<?php echo $division['id']; ?>" type="checkbox" value="<?php echo $division['id']; ?>">
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
                </fieldset>
              </div>

              <div id="divisiones_uni" class="ocultar">
                <h4 class="color-negro centrar-texto">Seleccione las divisiones a la cual va dirigido</h4><br>
                <fieldset>
                  <legend>Universidad</legend>
                  <?php for ($i = 0; $i < count($estudiosu['info']); $i++) : ?>
                    <?php $division = $estudiosu['info'][$i]; ?>
                    <?php if ($division['nivel_estudios'] == 'Universidad') : ?>
                        <div class="">
                            <label class="" for="<?php echo $division['id']; ?>"><?php echo $division['nombre_division']; ?></label>
                            <input name="semestres_uni" onchange="agegardivisiones(this)" class="" title="Esto es un ejemplo" id="<?php echo $division['id']; ?>" type="checkbox" value="<?php echo $division['id']; ?>">
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
        <!--(Paso2)parte2- boton para terminar-->
        <div id="div_crear_fin" class="campo ocultar">
          <p id="btn_crearEvento" class="boton verde centrar-texto">Crear Evento</p>
        </div>
      </div>
    </div>
    <div id="paso-3" class="ocultar">
      <h3 class="color-azulM">Revision de eventos</h3>
      <div>
        <table>
          <thead>
            <tr>
              <th class="">Nombre</th>
              <th class="">Estatus</th>
              <th class="">Comentario VR</th>
              <th class="">Comentario AV</th>
              <th class="">Editar</th>
              <th class="">Eliminar</th>
            </tr>
          </thead>
          <tbody id="celdas_revision">

          </tbody>
        </table>
      </div>
    </div>
    <div id="paso-4" class="ocultar">
      <h3 class="color-azulM">Eventos</h3>
      <div>
        <table>
          <thead>
            <tr>
              <th class="">Nombre</th>
              <th class="">Fecha de inicio y final</th>
              <th class="">Modalidad</th>
              <th class="">SubEventos</th>
              <th class="">Staff</th>
              <th class="">Mas detalles</th>
            </tr>
          </thead>
          <tbody id="celdas_eventos">

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php $script = "
    <script src='http://localhost/IESTEventos/build/js/vistas/coordinador/crearEvento.js'></script>
    <script src='http://localhost/IESTEventos/build/js/vistas/coordinador/revisionEventos.js'></script>
    <script src='http://localhost/IESTEventos/build/js/vistas/coordinador/vereventos.js'></script>
"; ?>