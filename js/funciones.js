window.addEventListener("load", principal);

function principal() {

    console.log("principal");

    // SELECTOR PARA ELEGIR QUE FORMULARIO-MÉTODO DE PAGO USAR 
    document.getElementById("selector").addEventListener("click",metodoPago, false);

    document.getElementById("modificarDireccion").addEventListener("click", modificarDireccion, false);

}

//
function metodoPago() {
    var seleccion = document.getElementById('selector').value;
    var cuentaformDiv = document.getElementById('cuentaform');
    var tarjetaformDiv = document.getElementById('tarjetaform');

    switch (seleccion) {
        case "cuenta":
            cuentaformDiv.style.display = "block";
            tarjetaformDiv.style.display = "none";
            break;
        case "tarjeta":
            tarjetaformDiv.style.display = "block";
            cuentaformDiv.style.display = "none";
            break;
        default:
            cuentaformDiv.style.display = "none";
            tarjetaformDiv.style.display = "none";
            break;

    }
}

function modificarDireccion(){
    var esCheckeado = document.getElementById('modificarDireccion').checked;
    var direccionDiv = document.getElementById('div-direccion');

    if(esCheckeado){
        direccionDiv.style.display = "block";
    }else{
        direccionDiv.style.display = "none";
    }   
}

