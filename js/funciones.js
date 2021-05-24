window.addEventListener("load", principal);

function principal() {

    console.log("principal");

    // SELECTOR PARA ELEGIR QUE FORMULARIO-MÉTODO DE PAGO USAR 
    // document.getElementById("selector").addEventListener("click", muestraMas, false);

    // document.getElementById("modificarDireccion").addEventListener("click", modificarDireccion, false);

    
    // COOKIES
    var close = document.getElementById("aceptarCookies");

    close.addEventListener("click",crearCookie, false);

    verificar();


}

//
function muestraMas() {
    var seleccion = document.getElementById('selector').value;
    var cuentaform = document.getElementById('cuentaform');
    var tarjetaform = document.getElementById('tarjetaform');

    switch (seleccion) {
        case "cuenta":
            cuentaform.style.display = "block";
            tarjetaform.style.display = "none";
            break;
        case "tarjeta":
            tarjetaform.style.display = "block";
            cuentaform.style.display = "none";
            break;
        default:
            cuentaform.style.display = "none";
            tarjetaform.style.display = "none";
            break;

    }
}

function modificarDireccion(){
    var esCheckeado = document.getElementById('modificarDireccion').checked;
    var actualizarDiv = document.getElementById('actualizarDiv');

    if(esCheckeado){
        actualizarDiv.style.display = "block";
    }else{
        actualizarDiv.style.display = "none";
    }

    
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



