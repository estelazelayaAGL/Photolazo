window.onload= principal;

function principal(){
    var close = document.getElementById("aceptarCookies");

     // COOKIES
     close.addEventListener("click",crearCookie, false);

     verificar();
}


function setCookie(nombre,valor, dias){
    var expira = "";
    if (dias) {
        var fecha = new Date();
        fecha.setTime(fecha.getTime() + dias * 24 * 60 * 60 * 1000);
        expira = "; Expira=" + fecha.toUTCString();
    }
    document.cookie = nombre + "=" + (valor || "") + expira + "; path=/";
}


function getCookie(nombre){
    var nombreE = nombre + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
         while (c.charAt(0) === " ") c = c.substring(1, c.length);
        if (c.indexOf(nombreE) === 0) return c.substring(nombreE.length, c.length);
    }
    return null;
}


function crearCookie() {
    var divCookie = document.getElementById("cookies");

    //Creando cookie
    setCookie("NbCook", "true", 30);
    localStorage.NbCook = 'true';
    divCookie.style.display = "none";
}


function verificar(){
    var divCookie = document.getElementById("cookies");
    var NbCook = getCookie("NbCook");

    if (NbCook === null) {
        divCookie.style.display = "block";
    } else {
        divCookie.style.display = "none";
    }
}



