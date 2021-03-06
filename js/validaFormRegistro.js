window.addEventListener("load", principal);

var expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ]+[a-zA-ZÀ-ÿ\s]{0,34}$/, // Letras y espacios, pueden llevar acentos.
    apellidos: /^[a-zA-ZÀ-ÿ]+[a-zA-ZÀ-ÿ\s]{0,49}$/, // Letras y espacios, pueden llevar acentos.
    usuario: /^[a-zA-Z0-9\_\-]{1,35}$/, // Letras, numeros, guion y guion_bajo
    password: /^.{4,12}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    fecha: /^\d{4}\-\d{2}\-\d{2}$/,
    telefono: /^\+\d{2,3}\s\d{9}$/, //	Prefijo internacional ( + seguido de 2 o 3 cifras) espacio en blanco y 9 cifras consecutivas
    direccion: /^[a-zA-ZÀ-ÿ0-9\,]+[a-zA-ZÀ-ÿ0-9\,\s]{0,34}$/, // Letras, numeros, espacios, comas y acentos
    codigoPostal: /^\d{1,6}$/,
    ciudad: /^[a-zA-ZÀ-ÿ\,]+[a-zA-ZÀ-ÿ\,\s]{0,19}$/, // Letras, espacios, comas y acentos
    provincia: /^[a-zA-ZÀ-ÿ\,]+[a-zA-ZÀ-ÿ\,\s]{0,19}$/, // Letras, espacios, comas y acentos
    pais: /^[a-zA-ZÀ-ÿ\,]+[a-zA-ZÀ-ÿ\,\s]{0,34}$/ // Letras, espacios, comas y acentos
}

var campos = {
    validarNombre: false,
    validarApellidos: false,
    validarNacimiento: false,
    validarTelefono: false,
    validarEmail: false,
    validarUsuario: false,
    validarContrasena: false,
    validarDireccion: false,
    validarCiudad: false,
    validarProvincia: false,
    validarPais: false,
    validarCPostal: false
}
var formulario;
var TodosLosInputs;
var submt;

function principal(e) {
    formulario = document.getElementById('registroForm');
    TodosLosInputs = document.querySelectorAll('#registroForm input');
    formulario.addEventListener('submit', enviarFormulario);

    TodosLosInputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });
}


function validarFormulario(e) {
    switch (e.target.name) {
        case "validarNombre":
            validarCampo(expresiones.nombre, e.target, 'validarNombre');
            break;
        case "validarApellidos":
            validarCampo(expresiones.apellidos, e.target, 'validarApellidos');
            break;
        case "validarNacimiento":
            validarCampo(expresiones.fecha, e.target, 'validarNacimiento');
            break;
        case "validarTelefono":
            validarCampo(expresiones.telefono, e.target, 'validarTelefono');
            break;
        case "validarEmail":
            validarCampo(expresiones.correo, e.target, 'validarEmail');
            break;
        case "validarUsuario":
            validarCampo(expresiones.usuario, e.target, 'validarUsuario');
            break;
        case "validarContrasena":
            validarCampo(expresiones.password, e.target, 'validarContrasena');
            validaContrasena2();
            break;
        case "validarContrasena2":
            validaContrasena2();
            break;
        case "validarDireccion":
            validarCampo(expresiones.direccion, e.target, 'validarDireccion');
            break;
        case "validarCiudad":
            validarCampo(expresiones.ciudad, e.target, 'validarCiudad');
            break;
        case "validarProvincia":
            validarCampo(expresiones.provincia, e.target, 'validarProvincia');
            break;
        case "validarPais":
            validarCampo(expresiones.pais, e.target, 'validarPais');
            break;
        case "validarCPostal":
            validarCampo(expresiones.codigoPostal, e.target, 'validarCPostal');
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

function validaContrasena2() {
    var inputContrasena1 = document.getElementById('validarContrasena');
    var inputContrasena2 = document.getElementById('validarContrasena2');

    if (inputContrasena1.value !== inputContrasena2.value) {
        document.getElementById(`grupo_validarContrasena2`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_validarContrasena2`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_validarContrasena2 i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo_validarContrasena2 i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo_validarContrasena2 .formulario_input-error`).classList.add('formulario_input-error-activo');
        campos['validarContrasena'] = false;
    } else {
        document.getElementById(`grupo_validarContrasena2`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_validarContrasena2`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_validarContrasena2 i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo_validarContrasena2 i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo_validarContrasena2 .formulario_input-error`).classList.remove('formulario_input-error-activo');
        campos['validarContrasena'] = true;
    }
}


function enviarFormulario(e) {
    e.preventDefault();
    submt = document.getElementById('enviar');

    if (campos.validarNombre && campos.validarApellidos && campos.validarNacimiento && campos.validarTelefono && campos.validarEmail && campos.validarUsuario && campos.validarContrasena && campos.validarDireccion &&
        campos.validarCiudad && campos.validarProvincia && campos.validarPais && campos.validarCPostal) { // && terminos.checked
        submt.setAttribute("disabled", "");

        var fd = new FormData(formulario);
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'registro.php');

        ajax.onload = function () {
            if (ajax.status==200) {
                submt.removeAttribute("disabled");
                var parser = new DOMParser();
                var doc = parser.parseFromString(ajax.responseText, "text/html");
                var elem = doc.getElementById("respuesta").innerHTML; 
                document.getElementById("mensaje").innerHTML =elem;
                if(elem.includes("correctamente")) {
                    formulario.reset();
                    document.querySelectorAll('.formulario_grupo-correcto').forEach((icono) => {
                        icono.classList.remove('formulario_grupo-correcto');
                    });
                }
            }
           
           

        }
        ajax.send(fd);

    } else {
        document.getElementById('formulario_mensaje').classList.add('formulario_mensaje-activo');
    }
}