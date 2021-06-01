window.addEventListener("load", principal);

var divAnadeProducto;
var divModificaProducto;
var divEliminaProducto;
var divObtieneProducto;

function principal() {

    console.log("administracion");

   // SELECTOR PARA ELEGIR QUE FORMULARIO-MÉTODO DE PAGO USAR 
   document.getElementById("anadeProducto").addEventListener("click", anadeProducto, false);
    document.getElementById("obtieneLista").addEventListener("click", tablaMuestraProductos, false);

   divAnadeProducto = document.getElementById('divAnadeProducto');
   divModificaProducto = document.getElementById('divModificaProducto');
   tablaMuestraProductos=document.getElementById('tablaMuestraProductos');

}


function anadeProducto() {
    console.log("anadeProducto");
    
    if (divAnadeProducto.style.display === "none") {

        divAnadeProducto.style.display = "block";
    } else {
        divAnadeProducto.style.display = "none";
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

function tablaMuestraProductos(){
    console.log("muestraProductos");
     var tablaMuestraProductos = document.getElementById('tablaMuestraProductos');
     
     if (tablaMuestraProductos.style.display === "none") {
         tablaMuestraProductos.style.display = "block";
     }
 else {
   tablaMuestraProductos.style.display = "none";
 }
}

