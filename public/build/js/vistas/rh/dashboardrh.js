var usuarios=null;let op_ordi=!1;function validateEmail(e){return/\S+@\S+\.\S+/.test(e)}function generarContrasena(){const e="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";let o="";for(let i=0;i<7;i++){o+=e[Math.floor(Math.random()*e.length)]}return o}function buscador(e){const o=e.value.toLowerCase(),i=usuarios.filter((function(e){return-1!==e.nombre.toLowerCase().indexOf(o)}));0===i.length?Swal.fire({icon:"error",title:"Oops...",customClass:{popup:"swal"},text:"No hay ningun docente/administrador con ese nombre"}):i.forEach((function(e){const o=document.createElement("TR"),i=document.createElement("TD");i.setAttribute("data-label","Nombre"),"0"==e.confirmado?i.textContent=`🟠${e.nombre} ${e.apellidoP}`:i.textContent=`${e.nombre} ${e.apellidoP}`,o.appendChild(i);const t=document.createElement("TD");t.setAttribute("data-label","Jerarquia"),t.textContent=""+e.nombre_jerarquia,o.appendChild(t);const a=document.createElement("TD");a.setAttribute("data-label","Editar"),a.classList.add("centrar-texto");const n=document.createElement("P");n.setAttribute("id","editar-"+e.id),n.setAttribute("value",""+e.id),n.classList.add("boton"),n.classList.add("verde"),n.textContent="Editar",a.appendChild(n),o.appendChild(a);const l=document.createElement("TD");l.setAttribute("data-label","Eliminar"),l.classList.add("centrar-texto");const c=document.createElement("P");c.setAttribute("id","borrar-"+e.id),c.setAttribute("value",""+e.id),c.classList.add("boton"),c.classList.add("rojo"),c.textContent="Eliminar",l.appendChild(c),o.appendChild(l);document.querySelector("#celdas").appendChild(o),c.addEventListener("click",(function(){eliminar(""+e.correo)}))}))}function tablaact(){const e=document.querySelector("#celdas");for(;e.lastChild;)e.removeChild(e.lastChild);usuarios.forEach(e=>{const o=document.createElement("TR"),i=document.createElement("TD");i.setAttribute("data-label","Nombre"),"0"==e.confirmado?i.textContent=`🟠${e.nombre} ${e.apellidoP}`:i.textContent=`${e.nombre} ${e.apellidoP}`,o.appendChild(i);const t=document.createElement("TD");t.setAttribute("data-label","Jerarquia"),t.textContent=""+e.nombre_jerarquia,o.appendChild(t);const a=document.createElement("TD");a.setAttribute("data-label","Editar");const n=document.createElement("P");n.setAttribute("id","editar-"+e.id),n.setAttribute("value",""+e.id),n.classList.add("boton"),n.classList.add("verde"),n.textContent="Editar",n.classList.add("centrar-texto"),a.appendChild(n),o.appendChild(a);const l=document.createElement("TD");l.setAttribute("data-label","Eliminar"),l.classList.add("centrar-texto");const c=document.createElement("P");c.setAttribute("id","borrar-"+e.id),c.setAttribute("value",""+e.id),c.classList.add("boton"),c.classList.add("rojo"),c.textContent="Eliminar",l.appendChild(c),o.appendChild(l);document.querySelector("#celdas").appendChild(o),c.addEventListener("click",(function(){eliminar(""+e.correo)})),n.addEventListener("click",(function(){editar(e)}))})}function eliminar(e){Swal.fire({title:`¿Estas seguro de eliminar a ${e}?`,text:"No podras deshacer la accion!",icon:"warning",showCancelButton:!0,customClass:{popup:"swal"},confirmButtonText:"¡Borrar!"}).then(o=>{o.isConfirmed&&borrar(e)})}async function borrar(e){const o=new FormData;o.append("correo",""+e);const i=baseurl+"/rheliminar",t=await fetch(i,{method:"POST",body:o});(await t.json()).success?Swal.fire({icon:"success",title:"Usuario Eliminado",customClass:{popup:"swal"},showConfirmButton:!1,timer:1500}):Swal.fire({icon:"error",title:"Oops...",text:"Algo salio mal",customClass:{popup:"swal"},showConfirmButton:!1,timer:1500}),api()}async function api(){try{const e=baseurl+"/api/rhusuarios",o=await fetch(e);usuarios=await o.json(),tablaact()}catch(e){}}async function checkEmailExists(e){const o=new FormData;o.append("email",e);const i=await fetch("/verificarCorreo",{method:"POST",body:o});return(await i.json()).success}async function checkId(e){const o=new FormData;o.append("idiest",e);const i=await fetch("/checkidexist",{method:"POST",body:o});return(await i.json()).success}async function agregar(){const{value:e}=await Swal.fire({title:"Registro de Admin",html:'<div class="campo"><input id="name"placeholder="Nombre"></div><div class="campo"><input id="apellidoP" placeholder="Apellido Paterno"></div><div class="campo"><input id="apellidoM" class="" placeholder="Apellido Materno"></div><div class="campo"><input id="email" class="" placeholder="Correo electrónico"></div><div class="campo"><input id="idiest" class="" placeholder="ID IEST 18823" maxlength="5" pattern="[0-9]{5}" required></div><fieldset><legend>Tipo de usuario</legend><div class="formulariogral"><div class="columnas "><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo1" name="tipo" value="3" checked><label for="tipo1">Administrador de Usuarios</label></div><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo2" name="tipo" value="4" ><label for="tipo2">Docente</label></div><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi(true)"type="radio" id="tipo3" name="tipo" value="5"><label for="tipo3">Coordinador</label></div></div><div class="columnas"><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo4" name="tipo" value="6"><label for="tipo4">Verificador</label></div><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo5" name="tipo" value="7"><label for="tipo5">Administrador de Eventos</label></div></div></div></fieldset><br><div id="selecc_cordi"class="ocultar"><div class="campo"><select id="option_coordi" class="" ><option value="0"disabled selected>Division del coordinador</option><option value="AD">Univ. Administración y Dirección de Empresas</option><option value="AR">Univ. Arquitectura</option><option value="CT">Univ. Ciencias Teológicas</option><option value="DE">Univ. Derecho</option><option value="DG">Univ. Diseño Gráfico</option><option value="FI">Univ. Filosofía</option><option value="FC">Univ. Finanzas y Contaduría Pública</option><option value="GA">Univ. Gastronomía</option><option value="ID">Univ. Idiomas</option><option value="IS">Univ. Ingeniería en Sistemas y Negocios Digitales</option><option value="II">Univ. Ingeniería Industrial </option><option value="IM">Univ. Ingeniería Mecatrónica</option><option value="IQ">Univ. Ingeniería Química</option><option value="MC">Univ. Médico Cirujano</option><option value="ME">Univ. Mercadotecnia Estratégica</option><option value="NI">Univ. Negocios Internacionales</option><option value="PS">Univ. Psicología</option><option value="QB">Prepa. Quimico-Biologica</option><option value="FM">Prepa. Fisico-Matematicas</option><option value="EA">Prepa. Economico-Administrativas</option><option value="HH">Prepa. Humanidades</option></select></div></div>',focusConfirm:!1,showCloseButton:!0,confirmButtonText:"Registrar",customClass:{popup:"swal"},confirmButtonColor:"#0ac223f3",preConfirm:async()=>{const e=document.getElementById("name").value,o=document.getElementById("apellidoP").value,i=document.getElementById("apellidoM").value,t=document.getElementById("email").value,a=document.getElementById("idiest").value,n=document.querySelector('input[name="tipo"]:checked').value,l=document.getElementById("option_coordi");if(e&&o&&i&&t&&a)if(validateEmail(t)){const c=await checkEmailExists(t),r=await checkId(a);if(c)Swal.showValidationMessage("Este correo electrónico ya está registrado");else{if(!r){Swal.showValidationMessage("Validando...");const c=new FormData;return c.append("nombre",e),c.append("apellidoP",o),c.append("apellidoM",i),c.append("correo",t),c.append("idiest",a),c.append("password",null),c.append("username",t.split("@")[0]),c.append("jerarquia",n),c.append("coordinador",l.value),fetch("/register",{method:"POST",body:c}).then(e=>{if(!e.ok)throw new Error(e.statusText);return e.json()}).then(e=>{if(e.error)throw new Error(e.message);Swal.fire({icon:"success",title:"Registro exitoso",text:"Se mando un correo con toda la informacion al docente",showConfirmButton:!1,timer:1500})}).catch(e=>{Swal.showValidationMessage("Registro fallido: El usuario ya existe")})}Swal.showValidationMessage("Este id ya esta ocupado")}}else Swal.showValidationMessage("Correo electrónico inválido");else Swal.showValidationMessage("Por favor completa todos los campos")}});e&&Swal.fire({icon:"success",title:"Registro exitoso",text:"Se mando un correo con toda la informacion al docente",showConfirmButton:!1,timer:1500}),api()}function selecc_cordi(e){const o=document.getElementById("selecc_cordi");e?(op_ordi=!0,o.classList.remove("ocultar")):(op_ordi=!1,o.classList.add("ocultar"))}async function editar(e){console.log(e);const{value:o}=await Swal.fire({title:"Editar  Docente/Admin",html:`<div class="campo"><input value="${e.nombre}" id="name"placeholder="Nombre"></div><div class="campo"><input value="${e.apellidoP}"id="apellidoP" placeholder="Apellido Paterno"> </div><div class="campo"><input value="${e.apellidoM}"id="apellidoM" class="" placeholder="Apellido Materno"></div><div class="campo"><input value="${e.correo}"disabled id="email" class="" placeholder="Correo electrónico" ></div><div class="campo"><input value="${e.id}" disabled id="idiest" class="" placeholder="IDIEST 18823"></div><fieldset><legend>Tipo de usuario</legend><div class="formulariogral"><div class="columnas "><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()" type="radio" id="tipo1" name="tipo" value="3" `+(3==e.jerarquia?"checked":"")+'><label for="tipo1">Administrador de Usuarios</label></div><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo2" name="tipo" value="4" '+(4===e.jerarquia?"checked":"")+'><label for="tipo2">Docente</label></div><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi(true)"type="radio" id="tipo3" name="tipo" value="5" '+(5===e.jerarquia?"checked":"")+'><label for="tipo3">Coordinador</label></div></div><div class="columnas"><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo4" name="tipo" value="6" '+(6===e.jerarquia?"checked":"")+'><label for="tipo4">Verificador</label></div><div class="flex-div-vert-nocenter"><input onclick="selecc_cordi()"type="radio" id="tipo5" name="tipo" value="7" '+(7===e.jerarquia?"checked":"")+'><label for="tipo5">Administrador de Eventos</label></div></div></div></fieldset><br><div id="selecc_cordi"class="ocultar"><div class="campo"><select id="option_coordi" class="" ><option value="0"disabled selected>Division del coordinador</option><option value="AD">Univ. Administración y Dirección de Empresas</option><option value="AR">Univ. Arquitectura</option><option value="CT">Univ. Ciencias Teológicas</option><option value="DE">Univ. Derecho</option><option value="DG">Univ. Diseño Gráfico</option><option value="FI">Univ. Filosofía</option><option value="FC">Univ. Finanzas y Contaduría Pública</option><option value="GA">Univ. Gastronomía</option><option value="ID">Univ. Idiomas</option><option value="IS">Univ. Ingeniería en Sistemas y Negocios Digitales</option><option value="II">Univ. Ingeniería Industrial </option><option value="IM">Univ. Ingeniería Mecatrónica</option><option value="IQ">Univ. Ingeniería Química</option><option value="MC">Univ. Médico Cirujano</option><option value="ME">Univ. Mercadotecnia Estratégica</option><option value="NI">Univ. Negocios Internacionales</option><option value="PS">Univ. Psicología</option><option value="QB">Prepa. Quimico-Biologica</option><option value="FM">Prepa. Fisico-Matematicas</option><option value="EA">Prepa. Economico-Administrativas</option><option value="HH">Prepa. Humanidades</option></select></div></div>',focusConfirm:!1,showCloseButton:!0,confirmButtonText:"Actualizar",customClass:{popup:"swal"},preConfirm:async()=>{const o=document.getElementById("name").value,i=document.getElementById("apellidoP").value,t=document.getElementById("apellidoM").value,a=document.getElementById("email").value,n=(document.getElementById("idiest").value,document.querySelector('input[name="tipo"]:checked').value),l=document.getElementById("option_coordi");if(o&&i&&t&&a)if(n){if(validateEmail(a)){Swal.showValidationMessage("Validando...");const a=new FormData;return a.append("nombre",o),a.append("apellidoP",i),a.append("apellidoM",t),a.append("tipo",n),a.append("id",e.id),a.append("coordinador",l.value),fetch("/rhactualizar",{method:"POST",body:a}).then(e=>{if(!e.ok)throw new Error(e.statusText);return e.json()}).then(e=>{if(e.error)throw new Error(e.message);Swal.fire({icon:"success",title:"actualizacion realizada",text:"Se actualizo correctamente",showConfirmButton:!1,timer:1500})}).catch(e=>{Swal.showValidationMessage("Actualizacion fallida: Contacte Soporte")})}Swal.showValidationMessage("Correo electrónico inválido")}else Swal.showValidationMessage("Por favor selecciona el tipo");else Swal.showValidationMessage("Por favor completa todos los campos")}});o&&Swal.fire({icon:"success",title:"actualizacion realizada",text:"Se actualizo correctamente",showConfirmButton:!1,timer:1500}),api()}document.addEventListener("DOMContentLoaded",(function(){api();document.querySelector("#agregar").addEventListener("click",(function(){agregar()}));const e=document.querySelector("#buscador");e.addEventListener("input",(function(){const o=document.querySelector("#celdas");for(;o.lastChild;)o.removeChild(o.lastChild);buscador(e)}))}));