window.addEventListener("load", principal);

var contenido;
var array_contenido_resumido;
var longitud_info_resumida;

function principal() {
    contenido = document.getElementById('descripcion').textContent;
    boton = document.getElementById('detalleCurso');
    console.log(contenido);

    array_contenido_resumido = new Array();
    longitud_info_resumida = 100;
    var puntos = "";

    if (contenido.length > 100) {
        puntos = "...";
    }
    array_contenido_resumido = contenido;
    var nuevo = array_contenido_resumido.substring(0, longitud_info_resumida);

    document.getElementById('descripcion').textContent = (nuevo + puntos+""+ boton.innerHTML);
}