window.addEventListener("load", principal);

function principal() {
    var elementos = document.getElementsByClassName("eliminar");
    for(var i=0; i < elementos.length; i++) {
        elementos[i].addEventListener("click", asegurarBorrado, false);
    }    
}


function asegurarBorrado(e) {
    if (!confirm('¿Realmente desea eliminar este elemento?')) {
        e.preventDefault();
      }
}