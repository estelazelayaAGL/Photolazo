window.addEventListener("load", principal);

var formulario;

function principal() {

    formulario = document.getElementById("registroForm").addEventListener('submit', validarFormulario, false);

}

function validarFormulario(evento) {
    evento.preventDefault();
    var todoCorrecto = true;
    var expresion = new RegExp('^[A-Z]+$', 'i'); //El valor de input sólo debe contener caracteres del alfabeto (letra 'A' hasta la 'Z', en mayúsculas y/o minúsculas. El resto de caracteres no serán válidos.
    var nombre = document.getElementById("validarNombre");
    // Se valida que el input no este vacío
    // Que no supere el máximo de caracteres permitidos
    // Que no contenga caracteres diferentes a los permitidos
    todoCorrecto = nombre.value;

    if (todoCorrecto) {

        todoCorrecto = nombre.length <= 35;

        if (todoCorrecto) {

            todoCorrecto = expresion.test(nombre);

            if (todoCorrecto) {

            } else {
                nombre.classList.add('was-validated');
                document.getElementById('mensaje').innerHTML = "<p>Has ingresado caracteres invalidos. Recuerda: solo letras.</p>";
                
            }
        } else {
            nombre.classList.add('was-validated');
            document.getElementById('mensaje').innerHTML = "<p>El máximo de caracteres permitidos es 35</p>";
        }
    } else {
        // document.getElementById('mensaje').className = "rojo";
        nombre.classList.add('was-validated');
        document.getElementById('mensaje').innerHTML = "<p>No puedes dejar vacío el campo de Nombre</p>";
        

    }

    


    if (todoCorrecto === true) {
        formulario.submit();
    }
}