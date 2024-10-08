var lugares = "";
var eventos = "";
var fechaOcupada = [];
var horarioOcupado = [];
const evento = {
    nombre: "",
    descripcion: "",
    nombre_responsable: "",
    contacto_responsable: "",
    fechaini: "",
    horai: "",
    fechafin: "",
    horaf: "",
    banner1: "",
    banner2: "",
    modalidad: "",
    categoria: "",
    responsable_alta: "",
    publico: { dirigido: "", divisiones: "", division: "" },
    presencial: {
      id_lugar: "",
      lugar_nombre: "",
      lugar_direccion: "",
      lugar_cupo_max: "",
    },
    online: { link: "", descripcion: "", plataformas: "" },
  },
  cooordinador = { id: "" },
  idselec = "";
//Primera funcion que se manda a llamar tras cargar crearEventos
function mostrarSeccion() {
    // Selección de elementos del DOM
    const botonCrear = document.querySelector("#crear");
    const botonVerEventos = document.querySelector("#vereventos");
    const botonRevision = document.querySelector("#revision");
    const paso1 = document.querySelector("#paso-1");
    const paso2 = document.querySelector("#paso-2");
    const paso3 = document.querySelector("#paso-3");
    const paso4 = document.querySelector("#paso-4");
    
    let pasoActual = paso1;
  
    // Evento para el botón "Crear"
    botonCrear.addEventListener("click", function () {
      pasoActual.classList.add("ocultar");
      pasoActual = paso2;
      pasoActual.classList.remove("ocultar");
  
      Swal.fire({
        title: "Un momento por favor!",
        icon: "info",
        timer: 300,
        showConfirmButton: false,
        timerProgressBar: true,
        customClass: { popup: "swal" },
        didOpen: () => {
          Form_crearEvento();
          apieventos();
          Swal.showLoading();
          Swal.close();
        },
      });
  
      const btnInfo2 = document.getElementById("btn_info2");
      const crear1 = document.getElementById("crear_1");
      const crear2 = document.getElementById("crear_2");
      const crearRegresar = document.getElementById("crear_regresar");
  
      btnInfo2.addEventListener("click", function () {
        if (btnInfo2.textContent !== "Continuar") {
          Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "Complete toda la información para continuar",
            customClass: { popup: "swal" },
          });
        } else {
          calcularfechas();
          crear1.classList.add("ocultar");
          crear2.classList.remove("ocultar");
          crearRegresar.classList.remove("ocultar");
  
          crearRegresar.addEventListener("click", function () {
            crear1.classList.remove("ocultar");
            crear2.classList.add("ocultar");
            crearRegresar.classList.add("ocultar");
          });
        }
      });
    });
  
    // Evento para el botón "Revisión"
    botonRevision.addEventListener("click", function () {
      pasoActual.classList.add("ocultar");
      pasoActual = paso3;
      pasoActual.classList.remove("ocultar");
  
      Swal.fire({
        title: "Cargando...",
        icon: "info",
        html: "Validando datos, por favor espere",
        allowOutsideClick: false,
        footer: '<p class="color-grisBajo no-margin">No cierre la página</p>',
        customClass: { popup: "swalalert" },
        didOpen: () => {
          Swal.showLoading();
          revisionEventos();
        },
      });
    });
  
    // Evento para el botón "Ver Eventos"
    botonVerEventos.addEventListener("click", function () {
      pasoActual.classList.add("ocultar");
      pasoActual = paso4;
      pasoActual.classList.remove("ocultar");
  
      Swal.fire({
        title: "Cargando...",
        icon: "info",
        html: "Validando datos, por favor espere",
        allowOutsideClick: false,
        footer: '<p class="color-grisBajo no-margin">No cierre la página</p>',
        customClass: { popup: "swalalert" },
        didOpen: () => {
          Swal.showLoading();
          verEventos();
        },
      });
    });
  }
  
function calcularfechas() {
  for (
    var e = new Date(evento.fechaini),
      o = new Date(evento.fechafin),
      n = [],
      t = Math.floor((o - e) / 864e5) + 1,
      i = e;
    i <= o;

  )
    n.push(i.toISOString().slice(0, 10)), i.setDate(i.getDate() + 1);
  var a = n.join(", ");
  (evento.dias = t), (evento.fechasduracion = a);
}
function Form_crearEvento() {
  const e = document.getElementById("div_virtual"),
    o = document.getElementById("div_presencial"),
    n = {
      nombre: document.getElementById("nombre"),
      descripcion: document.getElementById("descripcion"),
      nombre_responsable: document.getElementById("nombre_responsable"),
      contacto_responsable: document.getElementById("contacto_responsable"),
      seleccionModalidad: document.getElementById("modalidad"),
      categoria: document.getElementById("categoria"),
    };
  Object.keys(n).forEach((e) => {
    const o = n[e];
    o.addEventListener("change", function () {
      "modalidad" != o.id &&
        ((evento[e] = o.value), verificarObjetoLleno(evento));
    });
  });
  const t = {
      virtual_link: document.getElementById("virtual_link"),
      virtual_descripcion: document.getElementById("virtual_descripcion"),
      radio_fb: document.querySelectorAll('input[name="app_virtual"]'),
    },
    i = {
      horai: document.getElementById("horai"),
      fechaini: document.getElementById("fechaini"),
      fechafin: document.getElementById("fechafin"),
      horaf: document.getElementById("horaf"),
      banner1: document.getElementById("banner1"),
      banner2: document.getElementById("banner2"),
    };
  var a = new Date().toISOString().split("T")[0];
  i.fechaini.setAttribute("min", a),
    i.fechafin.setAttribute("min", a),
    n.seleccionModalidad.addEventListener("change", function () {
      if ((c(i), "Virtual" === n.seleccionModalidad.value)) {
        e.classList.remove("ocultar"), o.classList.add("ocultar");
        for (var a = 0; a < t.radio_fb.length; a++)
          t.radio_fb[a].addEventListener("change", function () {
            evento.online.plataformas = this.value;
          });
        t.virtual_descripcion.addEventListener("change", function () {
          evento.online.descripcion = t.virtual_descripcion.value;
        }),
          t.virtual_link.addEventListener("change", function () {
            evento.online.link = t.virtual_link.value;
          }),
          (evento.presencial.id_lugar = ""),
          (evento.presencial.lugar_cupo_max = ""),
          (evento.presencial.lugar_direccion = "");
      } else if ("Presencial" === n.seleccionModalidad.value) {
        e.classList.add("ocultar"), o.classList.remove("ocultar");
        for (a = 0; a < t.radio_fb.length; a++)
          t.radio_fb[a].addEventListener("change", function () {
            (evento.online.plataformas = ""), (a.checked = !1);
          });
        c(t),
          (evento.online.link = ""),
          (evento.online.descripcion = ""),
          (evento.online.plataformas = "");
      }
      evento.modalidad = n.seleccionModalidad.value;
      for (let e in i) evento["" + i[e].id] = "";
      verificarObjetoLleno(evento);
    });
  for (let e in i)
    i[e].addEventListener("change", () => {
      switch (n.seleccionModalidad.value) {
        case "Virtual":
          (evento["" + i[e].id] = i[e].value), verificarObjetoLleno(evento);
          break;
        case "Presencial":
          if ("0" == document.querySelector("#selecc_lugar").value)
            Swal.fire({
              icon: "warning",
              title: "Oops...",
              text: "Seleccione el lugar del evento",
              customClass: { popup: "swal" },
            }),
              (i[e].value = "");
          else {
            switch (i[e].id) {
              case "fechaini":
                fechaOcupada.includes(i.fechaini.value)
                  ? (Swal.fire({
                      icon: "warning",
                      title: "Oops...",
                      text: "Existe un evento en el dia seleccionado",
                      customClass: { popup: "swal" },
                    }),
                    i.fechaini.classList.add("warning"))
                  : i.fechaini.classList.remove("warning");
            }
            (evento["" + i[e].id] = i[e].value), verificarObjetoLleno(evento);
          }
          break;
        default:
          Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "Seleccione la modalidad del evento antes de continuar.",
            customClass: { popup: "swal" },
          }),
            (i[e].value = "");
      }
    });
  const c = (e) => {
      try {
        for (let o in e)
          (e[o].value = ""), "checkbox" === o.type && (e[o].checked = !1);
      } catch (e) {}
    },
    r = document.getElementById("btn_crearEvento");
  let s = !1;
  r.addEventListener("click", function () {
    s ||
      ((s = !0),
      Swal.fire({
        title: "Cargando...",
        icon: "info",
        html: "Validando datos, por favor espere",
        allowOutsideClick: !1,
        footer: '<p class="color-grisBajo no-margin">No cierre la pagina</p>',
        customClass: { popup: "swalalert" },
        didOpen: () => {
          Swal.showLoading(), crearEvento();
        },
      }),
      setTimeout(function () {
        s = !1;
      }, 2e3));
  });
}
async function crearEvento() {
    const bannerPrimario = document.querySelector("#banner1").files[0],
          bannerSecundario = document.querySelector("#banner2").files[0],
          formDataEvento = new FormData();
  
    formDataEvento.append("dias", evento.dias);
    formDataEvento.append("fechas", evento.fechasduracion);
    formDataEvento.append("banner1", bannerPrimario);
    formDataEvento.append("banner2", bannerSecundario);
    formDataEvento.append("contacto_responsable", evento.contacto_responsable);
    formDataEvento.append("descripcion", evento.descripcion);
  
    const fechaInicio = evento.fechaini,
          horaInicio = evento.horai,
          fechaFin = evento.fechafin,
          horaFin = evento.horaf,
          fechaHoraInicio = new Date(`${fechaInicio}T${horaInicio}:00`),
          fechaHoraFin = new Date(`${fechaFin}T${horaFin}:00`);
  
    formDataEvento.append("fechahoraini", fechaHoraInicio);
    formDataEvento.append("fechahorafin", fechaHoraFin);
    formDataEvento.append("nombre", evento.nombre);
    formDataEvento.append("categoria", evento.categoria);
    formDataEvento.append(
      "nombre_responsable",
      evento.nombre_responsable.charAt(0).toUpperCase() + evento.nombre_responsable.slice(1)
    );
    formDataEvento.append(
      "modalidad",
      evento.modalidad.charAt(0).toUpperCase() + evento.modalidad.slice(1)
    );
    formDataEvento.append("dirigido", evento.publico.dirigido);
    formDataEvento.append("divisiones", evento.publico.divisiones);
    formDataEvento.append("id_alta", evento.responsable_alta);
    formDataEvento.append("division", evento.publico.division);
  
    switch (evento.modalidad) {
      case "Presencial":
        evento.presencial.id === "nuevo"
          ? formDataEvento.append("lugar", "nuevo")
          : formDataEvento.append("lugar", evento.presencial.id_lugar);
        formDataEvento.append("lugar_cupo_max", evento.presencial.lugar_cupo_max);
        formDataEvento.append("lugar_direccion", evento.presencial.lugar_direccion);
        formDataEvento.append("lugar_nombre", evento.presencial.lugar_nombre);
        break;
      case "Virtual":
        formDataEvento.append("virtual_descripcion", evento.online.descripcion);
        formDataEvento.append("virtual_link", evento.online.link);
        formDataEvento.append("virtual_plataformas", evento.online.plataformas);
        break;
    }
        console.log(formDataEvento)
        const urlCrearEvento = baseurl + "crearevento",
        respuesta = await fetch(urlCrearEvento, { method: "POST", body: formDataEvento }),
        resultado = await respuesta.json();

        
    
  
    if (resultado.success) {
      Swal.fire({
        icon: "success",
        title: "Evento Creado",
        text: resultado.message,
        showConfirmButton: false,
        timer: 1500,
        customClass: { popup: "swal" },
      }).then(() => {
        // window.location.reload();
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Ocurrió Algo",
        text: resultado.message,
        customClass: { popup: "swal" },
        showConfirmButton: false,
        timer: 1500,
      });
    }
  }
  
function verificarObjetoLleno(e) {
  const o = document.getElementById("btn_info2");
  
  let n = Object.values(e).every(
    (e) => "string" == typeof e && "" !== e.trim()
  );
  console.log(Object.values(e));
  o.classList.toggle("verde", n),
    o.classList.toggle("rojo", !n),
    (o.textContent = n
      ? "Continuar"
      : "Complete la información para continuar");
}
function crear_paso1(e, o) {
  e.forEach((e) => {
    e.addEventListener("change", function () {
      switch (o.value) {
        case "":
          (e.value = ""),
            (evento["" + e.id] = ""),
            Swal.fire({
              icon: "warning",
              title: "Oops...",
              text: "Por favor, ingresa la fecha inicial del evento",
              customClass: { popup: "swal" },
            });
          break;
        default:
          (evento["" + e.id] = e.value), verificarObjetoLleno(evento);
      }
    });
  });
}
function verificarObjetoLleno(e) {
  const o = document.getElementById("btn_info2");
  let n = !0;
  for (let o in e) "string" == typeof e[o] && "" === e[o].trim() && (n = !1);
  n
    ? (o.classList.add("verde"),
      o.classList.remove("rojo"),
      (o.textContent = "Continuar"))
    : (o.classList.remove("verde"),
      o.classList.add("rojo"),
      (o.textContent = "Acomplete la informacion para continuar"));
}
function disponibilidad_fecha(e) {
  eventos.info.forEach((o) => {
    if (e == o.id && o.fecha_inicio) {
      var n = new Date(o.fecha_inicio),
        t = n.getFullYear(),
        i = n.getMonth() + 1,
        a = n.getDate(),
        c = t + "-" + (i < 10 ? "0" : "") + i + "-" + (a < 10 ? "0" : "") + a;
      fechaOcupada.push(c);
    }
  });
}
function seleccionlugar() {
  Swal.fire({
    title: "Un momento por favor!",
    customClass: { popup: "swal" },
    timer: 300,
    icon: "info",
    didOpen: () => {
      Swal.showLoading();
      const e = document.querySelector("#selecc_lugar"),
        o = document.querySelector("#interior"),
        n = document.querySelector("#otro");
      if ("nuevo" == e.value) {
        const e = document.getElementById("ext_nombre"),
          t = document.getElementById("ext_direccion"),
          i = document.getElementById("ext_max");
        o.classList.add("ocultar"),
          n.classList.remove("ocultar"),
          e.addEventListener("change", function () {
            (evento.presencial.lugar_nombre = e.value),
              (evento.presencial.id_lugar = "nuevo");
          }),
          t.addEventListener("change", function () {
            evento.presencial.lugar_direccion = t.value;
          }),
          i.addEventListener("change", function () {
            evento.presencial.lugar_cupo_max = i.value;
          });
      } else
        n.classList.add("ocultar"),
          obtenerlugares(),
          o.classList.remove("ocultar");
    },
  });
  const e = {
    nombre_ext: document.getElementById("ext_nombre"),
    direccion_ext: document.getElementById("ext_direccion"),
    max_ext: document.getElementById("ext_max"),
  };
  for (let o in e) e[o].value = "";
  const o = {
    horai: document.getElementById("horai"),
    fechaini: document.getElementById("fechaini"),
    fechafin: document.getElementById("fechafin"),
    horaf: document.getElementById("horaf"),
    banner1: document.getElementById("banner1"),
    banner2: document.getElementById("banner2"),
  };
  for (let e in o)
    (o[e].value = ""),
      (evento["" + o[e].id] = ""),
      o.fechaini.classList.remove("warning");
  verificarObjetoLleno(evento);
}
let divisiones;
async function apieventos() {
  let e = baseurl + "Coordinador/eventos",
    o = await fetch(e);
  eventos = await o.json();
}
async function obtenerlugares() {
  const e = baseurl + "Coordinador/obtenerlugares",
    o = await fetch(e),
    n = (await o.json()).info,
    t = document.querySelector("#selecc_lugar"),
    i = document.querySelector("#int_direccion"),
    a = document.querySelector("#int_max"),
    c = t.value,
    r = n.findIndex((e) => e.id === parseInt(c));
  if (-1 !== r) {
    const e = n[r];
    (i.textContent = e.lugar_direccion),
      (a.value = null === e.lugar_cupo_max ? 0 : parseInt(e.lugar_cupo_max)),
      (evento.presencial.lugar_nombre = e.lugar_nombre),
      (evento.presencial.lugar_direccion = e.lugar_direccion),
      (evento.presencial.lugar_cupo_max = a.value),
      (evento.presencial.id_lugar = e.id),
      disponibilidad_fecha(c);
  } else evento.presencial.id_lugar = c;
  verificarObjetoLleno(evento);
}
function publico_evento(e) {
  const o = document.getElementById("div_divisiones"),
    n = document.getElementById("div_crear_fin");
  switch (e.value) {
    case "general":
      o.classList.add("ocultar"),
        n.classList.remove("ocultar"),
        (evento.publico.dirigido = ["general"]),
        (evento.publico.divisiones = ["general"]),
        (evento.publico.division = "General");
      break;
    case "ambos":
      o.classList.remove("ocultar"),
        n.classList.add("ocultar"),
        (evento.publico.dirigido = ["P", "U"]),
        (evento.publico.division = "Universidad y Preparatoria");
      break;
    case "prepa":
      o.classList.remove("ocultar"),
        n.classList.add("ocultar"),
        (evento.publico.dirigido = ["P"]),
        (evento.publico.division = "Preparatoria");
      break;
    case "uni":
      o.classList.remove("ocultar"),
        n.classList.add("ocultar"),
        (evento.publico.dirigido = ["U"]),
        (evento.publico.division = "Universidad");
  }
  const t = document.querySelector('input[name="dirigido_divisiones"]:checked'),
    i = document.getElementById("div_semestres"),
    a = document.getElementById("divisiones_prepa"),
    c = document.getElementById("divisiones_uni");
  i.classList.add("ocultar"),
    a.classList.add("ocultar"),
    c.classList.add("ocultar"),
    t && (t.checked = !1);
}
function dirigido_divisiones(e) {
  const o = document.querySelector(
    'input[name="dirigido_nivelEstudios"]:checked'
  );
  if (null == o || "" === o)
    Swal.fire({
      icon: "warning",
      title: "Opps...",
      text: "Por favor conteste para que nivel de estudios va dirigido",
      showConfirmButton: !1,
      timer: 1500,
    }),
      (e.checked = !1);
  else {
    const i = document.getElementById("div_crear_fin"),
      a = document.getElementById("div_semestres"),
      c = document.getElementById("divisiones_prepa"),
      r = document.getElementById("divisiones_uni");
    var n = document.getElementsByName("dirigido_semestres");
    switch (e.value) {
      case "si":
        switch (
          (i.classList.remove("ocultar"),
          a.classList.add("ocultar"),
          c.classList.add("ocultar"),
          r.classList.add("ocultar"),
          o.value)
        ) {
          case "ambos":
            (evento.publico.divisiones = ["ambos"]),
              (evento.publico.dirigido = ["todos"]),
              (evento.publico.division = "Universidad y Preparatoria");
            break;
          case "uni":
            (evento.publico.divisiones = ["universidad"]),
              (evento.publico.dirigido = ["todos"]),
              (evento.publico.division = "Universidad");
            break;
          case "prepa":
            (evento.publico.divisiones = ["preparatoria"]),
              (evento.publico.dirigido = ["todos"]),
              (evento.publico.division = "Preparatoria");
            break;
          default:
            evento.publico.division = "General";
        }
        break;
      case "no":
        switch (
          (i.classList.add("ocultar"), a.classList.remove("ocultar"), o.value)
        ) {
          case "ambos":
            c.classList.remove("ocultar"), r.classList.remove("ocultar");
            break;
          case "prepa":
            r.classList.add("ocultar"), c.classList.remove("ocultar");
            break;
          case "uni":
            r.classList.remove("ocultar"), c.classList.add("ocultar");
        }
        for (var t = 0; t < n.length; t++) n[t].checked = !1;
        n = document.getElementsByName("semestres_prepa");
        for (t = 0; t < n.length; t++) n[t].checked = !1;
        n = document.getElementsByName("semestres_uni");
        for (t = 0; t < n.length; t++) n[t].checked = !1;
        (evento.publico.divisiones = []),
          (evento.publico.dirigido = []),
          i.classList.add("ocultar");
        break;
      default:
        (evento.publico.divisiones = []),
          (evento.publico.dirigido = []),
          i.classList.add("ocultar");
    }
  }
}
function agregarSemestre(e) {
  const o = document.getElementById("div_crear_fin"),
    n = e.value;
  evento.publico.dirigido.includes(n)
    ? evento.publico.dirigido.splice(evento.publico.dirigido.indexOf(n), 1)
    : evento.publico.dirigido.push(n),
    0 === evento.publico.dirigido.length ||
    0 === evento.publico.divisiones.length
      ? o.classList.add("ocultar")
      : o.classList.remove("ocultar");
}
function agegardivisiones(e) {
  const o = e.value,
    n = document.getElementById("div_crear_fin");
  evento.publico.divisiones.includes(o)
    ? evento.publico.divisiones.splice(evento.publico.divisiones.indexOf(o), 1)
    : evento.publico.divisiones.push(o),
    0 === evento.publico.dirigido.length ||
    0 === evento.publico.divisiones.length
      ? n.classList.add("ocultar")
      : n.classList.remove("ocultar");
}

// Cuando el documento ha sido completamente cargado y el DOM
document.addEventListener("DOMContentLoaded", function () {
  mostrarSeccion();  // Llama a la función `mostrarSeccion()`.
  var usuarioId = document.querySelector("#id_user").textContent;
  
  // Selecciona el elemento con el ID `id_user` y obtiene su contenido de texto.
  (evento.responsable_alta = usuarioId), (cooordinador.usuarioId = usuarioId);
  // Asigna el valor de `usuarioId` a las propiedades `responsableAlta` de `evento` y `usuarioId` de `coordinador`.
});