window.addEventListener("load", principal);

var cuentaformDiv;
var tarjetaformDiv;

function principal() {

    console.log("principal");

    // SELECTOR PARA ELEGIR QUE FORMULARIO-MÉTODO DE PAGO USAR 
    document.getElementById("cuenta").addEventListener("click", metodoPagoCuenta, false);
    document.getElementById("tarjeta").addEventListener("click", metodoPagoTarjeta, false);
    document.getElementById("modificarDireccion").addEventListener("click", modificarDireccion, false);
    document.getElementById("modificarNombre").addEventListener("click", modificarNombre, false);


}

function metodoPagoCuenta(event) {
    cuentaformDiv = document.getElementById('cuentaform');
    if (cuentaformDiv.style.display === "none") {
        cuentaformDiv.style.display = "block";
        tarjetaformDiv.style.display = "none";
    } else {
        cuentaformDiv.style.display = "none";
        tarjetaformDiv.style.display = "none";
    }
}


function metodoPagoTarjeta(event) {
    tarjetaformDiv = document.getElementById('tarjetaform');
    if (tarjetaformDiv.style.display === "none") {
        tarjetaformDiv.style.display = "block";
        cuentaformDiv.style.display = "none";
    } else {
        tarjetaformDiv.style.display = "none";
        cuentaformDiv.style.display = "none";
    }
}

    // function metodoPago() {
    //     var seleccion = document.getElementById('selector').value;
    //     var cuentaformDiv = document.getElementById('cuentaform');
    //     var tarjetaformDiv = document.getElementById('tarjetaform');

    //     switch (seleccion) {
    //         case "cuenta":
    //             cuentaformDiv.style.display = "block";
    //             tarjetaformDiv.style.display = "none";
    //             break;
    //         case "tarjeta":
    //             tarjetaformDiv.style.display = "block";
    //             cuentaformDiv.style.display = "none";
    //             break;
    //         default:
    //             cuentaformDiv.style.display = "none";
    //             tarjetaformDiv.style.display = "none";
    //             break;

    //     }
    // }

    function modificarDireccion() {
        var esCheckeado = document.getElementById('modificarDireccion').checked;
        var direccionDiv = document.getElementById('div-direccion');

        if (esCheckeado) {
            direccionDiv.style.display = "block";
        } else {
            direccionDiv.style.display = "none";
        }
    }

    function modificarNombre() {
        var esCheckeado = document.getElementById('modificarNombre').checked;
        var nombreDiv = document.getElementById('div-nombre');

        if (esCheckeado) {
            nombreDiv.style.display = "block";
        } else {
            nombreDiv.style.display = "none";
        }
    } 