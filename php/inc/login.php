<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>


    <?php 
    
    //Para intentar dar de alta un registro
    if (isset($_POST['registroEnviado'])) {
        $nombre = $_POST['validarNombre'];
        $apellidos = $_POST['validarApellido'];
        $fechaNacimiento = $_POST['validarNacimiento'];
        $telefono = NULL;
        if (isset($_POST['validarTelefono'])) {
            $telefono = $_POST['validarTelefono'];
        }
        $email = $_POST['validarEmail'];
        $usuario = $_POST['validarUsuario'];
        $contrasena = $_POST['validarContrasena'];
        $direccion = $_POST['validarDireccion'];
        $ciudad = $_POST['validarCiudad'];
        $provincia = $_POST['validarProvincia'];
        $pais = $_POST['validarPais'];
        $codigoPostal = $_POST['validarCPostal'];

        BD::crearUsuario($nombre, $apellidos, $fechaNacimiento, $telefono, $email, $usuario, $contrasena, $direccion, $ciudad, $provincia, $pais, $codigoPostal);
    }

    //Para intentar iniciar sesión
    if (isset($_POST['intentoLogin'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        BD::verificaCliente($usuario, $contrasena);
    }
    
    ?>


    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class=" col-xs-12 col-sm-12 col-md-12">
                    <h1>Bienvenido de nuevo</h1>

                    <hr>
                </div>
                <div class="registro col-xs-12 col-sm-12 col-md-12">
                    <div><img src="../../imagenes/imgMaquetacion/formLogin.png" alt=""></div>
                    <!-- INICIO FORMULARIO HTML -->
                    <form method="POST" action="login.php" class="needs-validation" novalidate>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- <label for="usuario">Usuario</label> -->
                                <input id="usuario" name="usuario" class="form-control" type="usuario" placeholder="Ingresa tu usuario" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- <label for="palabraSecreta">Contraseña</label> -->
                                <input id="contrasena" name="contrasena" class="form-control" placeholder="Ingresa tu contraseña" type="password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary mb-2" name="intentoLogin">
                                    Entrar
                                </button><br>
                                <a class="passOlvidada" href="#">Contraseña olvidada</a>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

        </div>

        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    var forms = document.getElementsByClassName('needs-validation');
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>



