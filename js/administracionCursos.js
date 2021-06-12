window.addEventListener("load", principal);

var divAnadeCurso;
var divModificaCurso;
var tablaMuestraCursos;

function principal() {

    document.getElementById("anadeCurso").addEventListener("click", anadeCurso, false);
    document.getElementById("obtieneLista").addEventListener("click", tablaMuestraCursos, false);

    divAnadeCurso = document.getElementById('divAnadeCurso');
    divModificaCurso = document.getElementById('divModificaCurso');
    tablaMuestraCursos = document.getElementById('tablaMuestraCursos');

}


function anadeCurso() {
    if (divAnadeCurso.style.display === "none") {
        divAnadeCurso.style.display = "block";
        divModificaCurso.style.display = "none";
        tablaMuestraCursos.style.display = "none";
    } else {
        divAnadeCurso.style.display = "none";
    }

}

function modificaProducto() {

    if (divModificaCurso.style.display === "none") {
        divModificaCurso.style.display = "block";
        divAnadeCurso.style.display = "none";
        tablaMuestraCursos.style.display = "none";
    } else {
        divModificaCurso.style.display = "none";
    }
}


function tablaMuestraCursos() {

    if (tablaMuestraCursos.style.display === "none") {
        tablaMuestraCursos.style.display = "block";
        divModificaCurso.style.display = "none";
        divAnadeCurso.style.display = "none";
    } else {
        tablaMuestraCursos.style.display = "none";
    }
}