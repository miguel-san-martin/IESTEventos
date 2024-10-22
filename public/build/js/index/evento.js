async function registroFinal() {
  if (!subeventosSeleccionados) return;
  Swal.mixin({ customClass: { popup: "swalalert" } })
    .fire({
      title: "¿Estas seguro?",
      customClass: { popup: "swalalert" },
      showClass: { popup: "animate__animated animate__fadeInDown" },
      hideClass: { popup: "animate__animated animate__fadeOutUp" },
      text: "Una vez que te hayas registrado al evento, no será posible realizar modificaciones.",
      icon: "warning",
      confirmButtonText: "Registrarme",
      cancelButtonText: "Cancelar",
      showCancelButton: !0,
      customClass: { popup: "swalalert" },
    })
    .then((e) => {
      e.isConfirmed &&
        Swal.fire({
          allowOutsideClick: !1,
          allowEscapeKey: !1,
          title: "Cargando...",
          icon: "info",
          html: "Registrandote al evento",
          footer: '<p class="color-grisBajo">No cierre la pagina</p>',
          customClass: { popup: "swalalert" },
          didOpen: () => {
            Swal.showLoading(), registraraevento();
          },
        });
    });
}
async function registraraevento() {
  const e = new FormData();
  e.append("idevento", idEvento),
    e.append("eventosSeleccionados", JSON.stringify(eventosSeleccionados)),
    e.append(
      "subeventosSeleccionados",
      JSON.stringify(subeventosSeleccionados)
    );
  const a = baseurl + "/registraraevento",
    o = await fetch(a, { method: "POST", body: e }),
    s = await o.json();
  if ((console.log(s), s.success)) {
    new Audio("build/img/qrsuccess.mp3").play(),
      Swal.fire({
        icon: "success",
        customClass: { popup: "swalalert" },
        showClass: { popup: "animate__animated animate__fadeInDown" },
        hideClass: { popup: "animate__animated animate__fadeOutUp" },
        backdrop: "\n              rgba(0, 128, 0, 0.5)\n            ",
        title: "" + s.message,
        showConfirmButton: !1,
        timer: 2500,
        willClose: () => {
          location.reload();
        },
      });
  } else
    Swal.fire({
      icon: "error",
      customClass: { popup: "swalalert" },
      showClass: { popup: "animate__animated animate__fadeInDown" },
      hideClass: { popup: "animate__animated animate__fadeOutUp" },
      title: "" + s.message,
      showConfirmButton: !1,
      timer: 2500,
      backdrop: "\n              rgba(255, 0, 0, 0.5)\n            ",
    });
}
document.addEventListener("DOMContentLoaded", function () {
  try {
    for (
      var e = document.getElementsByClassName("yaregistrado"), a = 0;
      a < e.length;
      a++
    )
      e[a].addEventListener("click", function () {
        Swal.fire({
          icon: "error",
          customClass: { popup: "swalnormal" },
          showClass: { popup: "animate__animated animate__fadeInDown" },
          hideClass: { popup: "animate__animated animate__fadeOutUp" },
          title: "Ya estas registrado",
          showConfirmButton: !1,
          timer: 2500,
          backdrop:
            "\n                  rgba(255, 0, 0, 0.5)\n                ",
        });
      });
    document.getElementById("registro").addEventListener("click", function () {
      existeSubEventos ? mostrarSubeventos() : registroFinal();
    });
  } catch (e) {}
});
let todosSeleccionados = !1,
  eventosSeleccionados = [],
  subeventosSeleccionados = [];
async function mostrarSubeventos() {
  if (
    ((subeventosSeleccionados = []), (eventosSeleccionados = []), registrado)
  ) {
    new Audio("build/img/qryaescaneado.mp3").play(),
      Swal.fire({
        icon: "error",
        customClass: { popup: "swalnormal" },
        showClass: { popup: "animate__animated animate__fadeInDown" },
        hideClass: { popup: "animate__animated animate__fadeOutUp" },
        title: "Ya estas registrado",
        showConfirmButton: !1,
        timer: 2500,
        backdrop: "\n              rgba(255, 0, 0, 0.5)\n            ",
      });
  } else {
    const e = [],
      a = {};
    eventos.forEach((o) => {
      const {
        evento_id: s,
        evento_nombre: t,
        evento_fecha: n,
        subevento_id: i,
        subevento_nombre: r,
      } = o;
      a.hasOwnProperty(s) ||
        ((a[s] = { evento_nombre: t, evento_fecha: n, subeventos: [] }),
        e.push(t)),
        a[s].subeventos.push({ subevento_id: i, subevento_nombre: r });
    });
    const o = Swal.mixin({
      progressSteps: e.map((e, a) => a + 1),
      confirmButtonText: 'Siguiente <i class="fa-solid fa-arrow-right"></i>',
      allowOutsideClick: !1,
      allowEscapeKey: !1,
      customClass: { popup: "swal" },
      showClass: { popup: "animate__animated animate__fadeInDown" },
      hideClass: { popup: "animate__animated animate__fadeOutUp" },
      footer:
        '<p class="color-grisBajo letra-chica">Por favor, asegúrate de elegir al menos un subevento por día para poder completar tu registro para el evento</p',
    });
    let s = 0;
    const t = o.getProgressSteps();
    t &&
      (t.classList.add("animate__animated", "animate__fadeIn"),
      t.style.setProperty("--current-progress-step", s));
    for (const e in a) {
      const n = a[e],
        { evento_nombre: i, evento_fecha: r, subeventos: l } = n;
      let c = obtenerFechaFormateada(r, !1);
      const p = { none: "Ninguno" };
      l.forEach((e) => {
        const { subevento_id: a, subevento_nombre: o } = e;
        p[a] = o;
      });
      const d = await o.fire({
        title: `${i}\n${c}`,
        currentProgressStep: s,
        input: "radio",
        inputOptions: p,
        showCloseButton: !0,
        inputValue: "none",
        inputValidator: (e) =>
          "none" === e ? null : e ? void 0 : "Debes seleccionar un subevento",
      });
      if (d.isDismissed) {
        (subeventosSeleccionados = !1), o.close();
        break;
      }
      eventosSeleccionados.push(e),
        subeventosSeleccionados.push(d.value),
        s++,
        t && t.style.setProperty("--current-progress-step", s);
    }
    (todosSeleccionados = !0),
      console.log("Eventos seleccionados:", eventosSeleccionados),
      console.log("Subeventos seleccionados:", subeventosSeleccionados),
      registroFinal();
  }
}
