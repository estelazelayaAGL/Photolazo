<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Registro';
    ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php
    //Para intentar dar de alta un registro
    if (isset($_POST['enviar'])) {
        $nombre = $_POST['validarNombre'];
        $apellidos = $_POST['validarApellidos'];
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

        $existe = BD::verificaExistenciaCliente($usuario);
        if (!$existe) {
            $resultado = BD::crearUsuario($nombre, $apellidos, $fechaNacimiento, $telefono, $email, $usuario, $contrasena, $direccion, $ciudad, $provincia, $pais, $codigoPostal);
            if ($resultado) {
                $mensaje = "<div class ='alert alert-success'>
                <a class='close' data-dismiss='alert'> × </a>¡Se ha creado el usuario " . $usuario . " correctamente!</div>";
                header('Refresh: 10; URL=login.php');
            } else {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>¡No se ha podido registrar el $usuario </div>";
                // header("Location: registro.php");
                header('Refresh: 10; URL=registro.php');
            }
        } else {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>¡El usuario ya existe!</div>";
        }
    }
    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div>
                    <h1>Crea una cuenta</h1>
                    <h4>Es fácil y rápido</h4>
                    <hr>
                    <div id="mensaje">
                        <div class="formulario_mensaje" id="formulario_mensaje">
                            <p><i class="fas fa-exclamation-triangle"></i><b> Error </b>Por favor rellene el formulario correctamente</p>
                        </div>
                    </div>

                </div>

                <div class="registro col-xs-12 col-sm-12 col-md-10 ">
                    <!-- INICIO FORMULARIO HTML -->

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="registroForm" class="needs-validation" autocomplete="off">
                        <!-- DATOS DEL CLIENTE -->
                        <!-- GRUPO: Nombre -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarNombre" class="formulario_grupo">
                            <label for="validarNombre" class="formulario_label">Nombre:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarNombre" name="validarNombre" placeholder="Estela Rosinda" required>
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">El nombre solo puede contener letras, espacios y acentos. <strong>(Max. 35 caracteres)</strong></p>
                        </div>
                        <!-- GRUPO: Apellidos -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarApellidos" class="formulario_grupo">
                            <label for="validarApellidos" class="formulario_label">Apellidos:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarApellidos" name="validarApellidos" placeholder="Zelaya Lazo" required>
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">El nombre solo puede contener letras, espacios y acentos. <strong>(Max. 50 caracteres)</strong></p>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarNacimiento">Fecha de nacimiento:<span class="rojo">*</span></label>
                            <input type="date" class="form-control" id="validarNacimiento" name="validarNacimiento" required>
                        </div>

                        <!-- GRUPO: Telefono -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarTelefono" class="formulario_grupo">
                            <label for="validarTelefono" class="formulario_label">Teléfono:</label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarTelefono" name="validarTelefono" placeholder="661908318">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Prefijo ( + seguido de 2 o 3 cifras) espacio en blanco y 9 cifras consecutivas.</p>
                        </div>

                        <!-- GRUPO: Email -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarEmail" class="formulario_grupo">
                            <label for="validarEmail" class="formulario_label">Email:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarEmail" name="validarEmail" placeholder="tucorreo@tucorreo.com">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.(Máx. 40 caracteres)</p>
                        </div>


                        <!-- GRUPO: Usuario -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarUsuario" class="formulario_grupo">
                            <label for="validarUsuario" class="formulario_label">Usuario:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarUsuario" name="validarUsuario" placeholder="estelaz_97">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">El Usuario solo puede contener letras, numeros, guion y guion_bajo (Máx. 35 caracteres)</p>
                        </div>

                        <!-- GRUPO: Contrasena -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarContrasena" class="formulario_grupo">
                            <label for="validarContrasena" class="formulario_label">Contraseña:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="password" class="formulario_input form-control" id="validarContrasena" name="validarContrasena">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                        </div>

                        <!-- GRUPO: Contrasena2 -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarContrasena2" class="formulario_grupo">
                            <label for="validarContrasena2" class="formulario_label">Repita contraseña:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="password" class="formulario_input form-control" id="validarContrasena2" name="validarContrasena2">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Ambas contraseñas deben ser iguales</p>
                        </div>

                        <!-- DATOS NECESARIOS PARA ENVIOS DE LOS PEDIDOS -->
                        <div class="form-group col-xs-12 col-sm-12   col-md-12">
                            <h4>Esta dirección será donde se enviarán futuros pedidos (puedes modificarla luego)</h4>
                        </div>


                        <!-- GRUPO: Direccion -->
                        <div class="formulario_grupo form-group col-xs-12 col-sm-12 col-md-12" id="grupo_validarDireccion" class="formulario_grupo">
                            <label for="validarDireccion" class="formulario_label">Direccion:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarDireccion" name="validarDireccion" >
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Solo puedes ingresar letras, numeros, espacios, comas y acentos (Máx. 35 caracteres )</p>
                        </div>

                        <!-- GRUPO: Ciudad -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarCiudad" class="formulario_grupo">
                            <label for="validarCiudad" class="formulario_label">Ciudad:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarCiudad" name="validarCiudad">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Solo puedes ingresar letras, numeros, espacios, comas y acentos (Máx. 20 caracteres )</p>
                        </div>

                        <!-- GRUPO: Provincia -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarProvincia" class="formulario_grupo">
                            <label for="validarProvincia" class="formulario_label">Provincia:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarProvincia" name="validarProvincia">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Solo puedes ingresar letras, numeros, espacios, comas y acentos (Máx. 20 caracteres )</p>
                        </div>

                        <!-- GRUPO: Pais -->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarPais" class="formulario_grupo">
                            <label for="validarPais" class="formulario_label">Pais:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="text" class="formulario_input form-control" id="validarPais" name="validarPais">
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Solo puedes ingresar letras, numeros, espacios, comas y acentos (Máx. 35 caracteres )</p>
                        </div>
                        <!-- GRUPO: Codigo postal-->
                        <div class="formulario_grupo form-group col-xs-6 col-sm-6 col-md-6" id="grupo_validarCPostal" class="formulario_grupo" >
                            <label for="validarCPostal" class="formulario_label">Codigo postal:<span class="rojo">*</span></label>
                            <div class="formulario_grupo-input">
                                <input type="number" class="formulario_input form-control" id="validarCPostal" name="validarCPostal" max="6" >
                                <i class="formulario_validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario_input-error">Solo puedes ingresar numeros (Máx. 6 )</p>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 formulario_grupo formulario_grupo-btn-enviar">
                            <div>
                                <button class="btn btn-info" type="reset" name="reset">Limpiar</button>
                                <button class="btn btn-primary" type="submit" name="enviar">Enviar</button>
                            </div>

                            <p class="formulario_mensaje-exito" id="formulario_mensaje-exito">Formulario enviado exitosamente!</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../../js/validaFormRegistro.js"></script>
    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>