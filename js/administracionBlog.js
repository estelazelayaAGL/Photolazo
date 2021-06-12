window.addEventListener("load", principal);

var divAnadeEntrada;
var divModificaEntrada;
var tablaMuestraEntradas;

function principal() {

    document.getElementById("anadeEntrada").addEventListener("click", anadeEntrada, false);
    document.getElementById("obtieneLista").addEventListener("click", tablaMuestraEntrada, false);

    divAnadeEntrada = document.getElementById('divAnadeEntrada');
    divModificaEntrada = document.getElementById('divModificaEntrada');
    tablaMuestraEntradas = document.getElementById('tablaMuestraEntradas');

}


function anadeEntrada() {
    if (divAnadeEntrada.style.display === "none") {
        divAnadeEntrada.style.display = "block";
        divModificaEntrada.style.display = "none";
        tablaMuestraEntradas.style.display = "none";
    } else {
        divAnadeEntrada.style.display = "none";
    }

}

function divModificaEntrada() {
    if (divModificaEntrada.style.display === "none") {
        divModificaEntrada.style.display = "block";
        divAnadeEntrada.style.display = "none";
        tablaMuestraEntradas.style.display = "none";

    } else {
        divModificaEntrada.style.display = "none";
    }

}


function tablaMuestraEntrada() {
    var tablaMuestraEntradas = document.getElementById('tablaMuestraEntradas');

    if (tablaMuestraEntradas.style.display === "none") {
        tablaMuestraEntradas.style.display = "block";
        divAnadeEntrada.style.display = "none";
        divModificaEntrada.style.display = "none";
    } else {
        tablaMuestraEntradas.style.display = "none";
    }
}