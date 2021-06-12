window.addEventListener("load", principal);

var divAnadeProducto;
var divModificaProducto;
var divEliminaProducto;
var divObtieneProducto;

function principal() {

    document.getElementById("anadeProducto").addEventListener("click", anadeProducto, false);
    document.getElementById("obtieneLista").addEventListener("click", tablaMuestraProductos, false);

    divAnadeProducto = document.getElementById('divAnadeProducto');
    divModificaProducto = document.getElementById('divModificaProducto');
    tablaMuestraProductos = document.getElementById('tablaMuestraProductos');

}


function anadeProducto() {

    if (divAnadeProducto.style.display === "none") {

        divAnadeProducto.style.display = "block";
        tablaMuestraProductos.style.display = "none";
        divModificaProducto.style.display = "none";
    } else {
        divAnadeProducto.style.display = "none";
    }

}

function modificaProducto() {

    if (divModificaProducto.style.display === "none") {
        divModificaProducto.style.display = "block";
        divAnadeProducto.style.display = "none";
        tablaMuestraProductos.style.display = "none";
    } else {
        divModificaProducto.style.display = "none";
    }
}


function tablaMuestraProductos() {

    if (tablaMuestraProductos.style.display === "none") {
        tablaMuestraProductos.style.display = "block";
        divAnadeProducto.style.display = "none";
        divModificaProducto.style.display = "none";
    } else {
        tablaMuestraProductos.style.display = "none";
    }
}