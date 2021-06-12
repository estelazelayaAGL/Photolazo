window.addEventListener("load", principal);

function principal() {
    document.getElementById("myInput").addEventListener("keyup", filtrar, false);
}

function filtrar() {
    var valor = document.getElementById("myInput").value.toLowerCase();
    $("#myList #lbl").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1)
    });
}