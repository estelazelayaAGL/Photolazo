window.addEventListener("load", principal);

var expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,60}$/, // Letras y espacios, pueden llevar acentos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\+\d{2,3}\s\d{9}/, //	Prefijo internacional ( + seguido de 2 o 3 cifras) espacio en blanco y 9 cifras consecutivas
    mensaje: /^[a-zA-ZÀ-ÿ0-9\,\s\.]+$/
}

var campos = {
    validarNombre: false,
    validarTelefono: false,
    validarEmail: false,
    validarMensaje: false
}

var formulario;
var TodosLosInputs;
var submt;
var textareaMensaje;

function principal(e) {
    formulario = document.getElementById('contactoForm');
    TodosLosInputs = document.querySelectorAll('#contactoForm input');
    formulario.addEventListener('submit', enviarFormulario);

    TodosLosInputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });

    textareaMensaje = document.getElementById('validarMensaje');
    textareaMensaje.addEventListener('keyup', validarFormulario);
    textareaMensaje.addEventListener('blur', validarFormulario);
}

function validarFormulario(e) {
    switch (e.target.name) {
        case "validarNombre":
            validarCampo(expresiones.nombre, e.target, 'validarNombre');
            break;
        case "validarTelefono":
            validarCampo(expresiones.telefono, e.target, 'validarTelefono');
            break;
        case "validarEmail":
            validarCampo(expresiones.correo, e.target, 'validarEmail');
            break;
        case "validarMensaje":
            validarCampo(expresiones.mensaje, e.target, 'validarMensaje');
            break;
    }
}

function validarCampo(expresion, input, campo) {
    if (expresion.test(input.value) && input.value !== "") {
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo_${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo_${campo} .formulario_input-error`).classList.remove('formulario_input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo_${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo_${campo} .formulario_input-error`).classList.add('formulario_input-error-activo');
        campos[campo] = false;
    }
}

function enviarFormulario(e) {
    e.preventDefault();
    submt = document.getElementById('enviar');

    if (campos.validarNombre && campos.validarTelefono && campos.validarEmail && campos.validarMensaje) { // && terminos.checked
        console.log("ENTRA TODO BIEN");
        submt.setAttribute("disabled", "");
        
        var fd = new FormData(formulario);
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'contacto.php');

        ajax.onload = function () {
            if (ajax.status==200) {
                submt.removeAttribute("disabled");
                document.getElementById('formulario_mensaje-exito').classList.add('formulario_mensaje-exito-activo');

                formulario.reset();
                setTimeout(() => {
                    document.getElementById('formulario_mensaje-exito').classList.remove('formulario_mensaje-exito-activo');
                }, 10000);

                document.querySelectorAll('.formulario_grupo-correcto').forEach((icono) => {
                    icono.classList.remove('formulario_grupo-correcto');
                });
            }

        }
        ajax.send(fd);
    } else {
        document.getElementById('formulario_mensaje').classList.add('formulario_mensaje-activo');
        setTimeout(() => {
            document.getElementById('formulario_mensaje').classList.remove('formulario_mensaje-activo');
        }, 3000);
    }
}