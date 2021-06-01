window.addEventListener("load", principal);

function principal() {
    document.getElementById("eliminar").addEventListener("click", asegurarBorrado, false);
}


function asegurarBorrado() {
    console.log("ENTRA");
    respuesta = confirm("¿Seguro que desea Eliminar?");
    return respuesta;
}