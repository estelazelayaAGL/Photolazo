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
        <div class="container seccion ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div>
                    <h1>Crea una cuenta</h1>
                    <h4>Es fácil y rápido</h4>
                    <hr>
                    <div><?php
                            if (isset($mensaje)) {
                                echo $mensaje;
                            }
                            ?>
                    </div>
                </div>
                <div class="registro col-xs-12 col-sm-12 col-md-10 ">
                    <!-- INICIO FORMULARIO HTML -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
                        <!-- DATOS DEL CLIENTE -->
                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarNombre">Nombre:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarNombre" name="validarNombre" placeholder="Estela Rosinda" required>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarApellido">Apellidos:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarApellido" name="validarApellido" placeholder="Zelaya Lazo" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarNacimiento">Fecha de nacimiento:<span class="rojo">*</span></label>
                            <input type="date" class="form-control" id="validarNacimiento" name="validarNacimiento" placeholder="año-mes-dia" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarTelefono">Teléfono:</label>
                            <input type="number" class="form-control" id="validarTelefono" name="validarTelefono" max="999999999" placeholder="661908318">
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarEmail">Email:<span class="rojo">*</span></label>
                            <input type="email" class="form-control" id="validarEmail" name="validarEmail" placeholder="tucorreo@tucorreo.com" required>
                        </div>


                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarUsuario">Usuario:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarUsuario" name="validarUsuario" placeholder="estelaz97" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarContrasena">Contraseña:<span class="rojo">*</span></label>
                            <input type="password" class="form-control" id="validarContrasena" name="validarContrasena" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarRContrasena">Repita contraseña:<span class="rojo">*</span></label>
                            <input type="password" class="form-control" id="validarRContrasena" name="validarRContrasena" required>
                        </div>

                        <!-- DATOS NECESARIOS PARA ENVIOS DE LOS PEDIDOS -->
                        <div class="form-group col-xs-12 col-sm-12   col-md-12">
                            <h4>Esta dirección será donde se enviarán futuros pedidos (puedes modificarla luego)</h4>
                        </div>


                        <div class="form-group col-xs-12 col-sm-12   col-md-12">
                            <label for="validarDireccion">Dirección:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarDireccion" name="validarDireccion" placeholder="Ej: Avenida Vicente Trueba 3,38" required>
                        </div>


                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarCiudad">Ciudad:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarCiudad" name="validarCiudad" placeholder="Santander" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarProvincia">Provincia:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarProvincia" name="validarProvincia" placeholder="Cantabria" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarPais">Pais:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarPais" name="validarPais" placeholder="España" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarCPostal">Codigo postal:<span class="rojo">*</span></label>
                            <input type="number" class="form-control" id="validarCPostal" name="validarCPostal" placeholder="39011" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12">
                            <button class="btn btn-info" type="reset" name="reset">Limpiar</button>
                            <button class="btn btn-primary" type="submit" name="enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>