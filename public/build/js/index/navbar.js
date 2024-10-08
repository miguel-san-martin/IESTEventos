const buttonMenuLPO = document.getElementById("buttonMenuLPO"),
    buttonMenuLPC = document.getElementById("buttonMenuLPC"), infoMenu = document.getElementById("infoMenu");
buttonMenuLPO.addEventListener("click", (function () {
    buttonMenuLPO.style.display = "none", buttonMenuLPC.style.display = "flex", infoMenu.style.display = "grid", infoMenu.style.animation = "slide 0.3s ease-in-out"
})), buttonMenuLPC.addEventListener("click", (function () {
    buttonMenuLPO.style.display = "flex", buttonMenuLPC.style.display = "none", infoMenu.style.animation = "slideOut 0.3s ease-in-out forwards", setTimeout((function () {
        infoMenu.style.display = "none", buttonMenuLPO.removeAttribute("style"), buttonMenuLPC.removeAttribute("style")
    }), 300)
})), window.addEventListener("resize", (function () {
    if(!infoMenu) return;
    window.innerWidth >= 650 && (buttonMenuLPO.style.display = "none", buttonMenuLPC.style.display = "none", infoMenu.style.animation = "slideOut 0.3s ease-in-out forwards", setTimeout((function () {
        infoMenu.style.display = "none", buttonMenuLPO.removeAttribute("style"), buttonMenuLPC.removeAttribute("style")
    }), 300))
}));
const infoMenuCalendar = document.getElementById("infoMenuCalendar");
buttonMenuLPO.addEventListener("click", (function () {
    buttonMenuLPO.style.display = "none", buttonMenuLPC.style.display = "flex", infoMenuCalendar.style.display = "grid", infoMenuCalendar.style.animation = "slideCalendar 0.3s ease-in-out"
})), buttonMenuLPC.addEventListener("click", (function () {
    buttonMenuLPO.style.display = "flex", buttonMenuLPC.style.display = "none", infoMenuCalendar.style.animation = "slideOutCalendar 0.3s ease-in-out forwards", setTimeout((function () {
        infoMenuCalendar.style.display = "none", buttonMenuLPO.removeAttribute("style"), buttonMenuLPC.removeAttribute("style")
    }), 300)
})), window.addEventListener("resize", (function () {
    if(!infoMenuCalendar) return;
    window.innerWidth >= 650 && (buttonMenuLPO.style.display = "none", buttonMenuLPC.style.display = "none", infoMenuCalendar.style.animation = "slideOutCalendar 0.3s ease-in-out forwards", setTimeout((function () {
        infoMenuCalendar.style.display = "none", buttonMenuLPO.removeAttribute("style"), buttonMenuLPC.removeAttribute("style")
    }), 300))
}));
const infoMenuGeneral = document.getElementById("infoMenuGeneral");
buttonMenuLPO.addEventListener("click", (function () {
    if(!infoMenuGeneral) return;
    buttonMenuLPO.style.display = "none", buttonMenuLPC.style.display = "flex", infoMenuGeneral.style.display = "grid", infoMenuGeneral.style.animation = "slideGenral 0.3s ease-in-out"
})), buttonMenuLPC.addEventListener("click", (function () {
    buttonMenuLPO.style.display = "flex", buttonMenuLPC.style.display = "none", infoMenuGeneral.style.animation = "slideOutGeneral 0.3s ease-in-out forwards", setTimeout((function () {
        infoMenuGeneral.style.display = "none", buttonMenuLPO.removeAttribute("style"), buttonMenuLPC.removeAttribute("style")
    }), 300)
})), window.addEventListener("resize", (function () {
    if(!infoMenu) return;
    window.innerWidth >= 650 && (buttonMenuLPO.style.display = "none", buttonMenuLPC.style.display = "none", infoMenuGeneral.style.animation = "slideOutGeneral 0.3s ease-in-out forwards", setTimeout((function () {
        infoMenuGeneral.style.display = "none", buttonMenuLPO.removeAttribute("style"), buttonMenuLPC.removeAttribute("style")
    }), 300))
}));