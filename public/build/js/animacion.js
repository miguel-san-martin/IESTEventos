let intro=document.querySelector(".intro"),overlay=document.querySelector(".img-overlay"),logoSpan=document.querySelectorAll(".logo-parts"),logo=document.querySelector(".logo");window.addEventListener("DOMContentLoaded",()=>{setTimeout(()=>{logoSpan.forEach((e,o)=>{setTimeout(()=>{e.classList.add("active")},100*(o+1))}),setTimeout(()=>{logoSpan.forEach((e,o)=>{setTimeout(()=>{e.classList.remove("active"),e.classList.add("fade")},50*(e+1))})},2e3),setTimeout(()=>{intro.style.top="-100vh"},2300),setTimeout(()=>{overlay.classList.remove("ocultar")},2500)})});