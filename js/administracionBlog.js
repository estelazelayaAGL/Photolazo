window.addEventListener("load", principal);

var divAnadeEntrada;
var divModificaEntrada;
var tablaMuestraEntradas;
function principal() {

    console.log("Blog");

   document.getElementById("anadeEntrada").addEventListener("click", anadeEntrada, false);
    document.getElementById("obtieneLista").addEventListener("click", tablaMuestraEntrada, false);

    divAnadeEntrada = document.getElementById('divAnadeEntrada');
    divModificaEntrada = document.getElementById('divModificaEntrada');
    tablaMuestraEntradas=document.getElementById('tablaMuestraEntradas');

}


function anadeEntrada() {
    console.log("anadeEntradas");
    
    if (divAnadeEntrada.style.display === "none") {

        divAnadeEntrada.style.display = "block";
    } else {
        divAnadeEntrada.style.display = "none";
    }

}

function tablaMuestraEntrada(){
    console.log("muestra entrada");
     var tablaMuestraEntradas = document.getElementById('tablaMuestraEntradas');
     
     if (tablaMuestraEntradas.style.display === "none") {
        console.log("HOLAmuestra entrada");
        tablaMuestraEntradas.style.display = "block";
     }
 else {
    tablaMuestraEntradas.style.display = "none";
 }
}

