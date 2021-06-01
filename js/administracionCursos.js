window.addEventListener("load", principal);

var divAnadeCurso;
var divModificaCurso;
var tablaMuestraCursos;

function principal() {
   // SELECTOR PARA ELEGIR QUE FORMULARIO-MÉTODO DE PAGO USAR 
   document.getElementById("anadeCurso").addEventListener("click", anadeCurso, false);
    document.getElementById("obtieneLista").addEventListener("click", tablaMuestraCursos, false);

    divAnadeCurso = document.getElementById('divAnadeCurso');
    divModificaCurso = document.getElementById('divModificaCurso');
    tablaMuestraCursos=document.getElementById('tablaMuestraCursos');

}


function anadeCurso() {
    if (divAnadeCurso.style.display === "none") {

        divAnadeCurso.style.display = "block";
    } else {
        divAnadeCurso.style.display = "none";
    }

}

// function modificaProducto() {
//     console.log("modificaProducto");
//     var divModificaProducto = document.getElementById('divModificaProducto');

//     if (divModificaProducto.style.display === "none") {
//         divAnadeProducto.style.display = "none";
//         divModificaProducto.style.display = "block";
//         divEliminaProducto.style.display = "none";
//         divObtieneProducto.style.display = "none";
//         tablaMuestraProductos.style.display = "none";
//     } else {
//         divModificaProducto.style.display = "none";
//     }
// }


// function eliminaProducto() {
//     console.log("eliminaProducto");
//     var divEliminaProducto = document.getElementById('divEliminaProducto');

//     if (divEliminaProducto.style.display === "none") {

//         divAnadeProducto.style.display = "none";
//         divModificaProducto.style.display = "none";
//         divEliminaProducto.style.display = "block";
//         divObtieneProducto.style.display = "none";
//         tablaMuestraProductos.style.display = "none";
//     } else {
//         divEliminaProducto.style.display = "none";
//     }
// }


// function obtieneLista() {
//     console.log("divObtieneProducto");
//     var divObtieneProducto = document.getElementById('divObtieneProducto');

//     if (divObtieneProducto.style.display === "none") {
//         // divAnadeProducto.style.display = "none";
//         // divModificaProducto.style.display = "none";
//         // divEliminaProducto.style.display = "none";
//         divObtieneProducto.style.display = "block";
//         // tablaMuestraProductos.style.display = "none";
//     } else {
//         divObtieneProducto.style.display = "none";
//     }
// }

function tablaMuestraCursos(){
    console.log("muestraProductos");
     var tablaMuestraCursos = document.getElementById('tablaMuestraCursos');
     
     if (tablaMuestraCursos.style.display === "none") {
        tablaMuestraCursos.style.display = "block";
     }
 else {
    tablaMuestraCursos.style.display = "none";
 }
}

