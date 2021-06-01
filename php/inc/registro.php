<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Registro';
    ?>


    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div>
                    <h1>Crea una cuenta</h1>
                    <h4>Es fácil y rápido</h4>
                    <hr>
                </div>

                <div class="registro col-xs-12 col-sm-12 col-md-10 ">
                    <!-- INICIO FORMULARIO HTML -->
                    <form method="POST" action="login.php" class="needs-validation" novalidate>
                        <!-- DATOS DEL CLIENTE -->
                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarNombre">Nombre:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarNombre" name="validarNombre" required>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarApellido">Apellidos:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarApellido" name="validarApellido" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarNacimiento">Fecha de nacimiento:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarNacimiento" name="validarNacimiento" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarTelefono">Teléfono:</label>
                            <input type="number" class="form-control" id="validarTelefono" name="validarTelefono" max="999999999">
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarEmail">Email:<span class="rojo">*</span></label>
                            <input type="email" class="form-control" id="validarEmail" name="validarEmail" required>
                        </div>


                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarUsuario">Usuario:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarUsuario" name="validarUsuario" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarContrasena">Contraseña:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarContrasena" name="validarContrasena" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarRContrasena">Repita contraseña:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarRContrasena" name="validarRContrasena" required>
                        </div>

                        <!-- DATOS NECESARIOS PARA ENVIOS DE LOS PEDIDOS -->
                        <div class="form-group col-xs-12 col-sm-12   col-md-12">
                            <h4>Esta dirección será donde se enviarán futuros pedidos (puedes modificarla luego)</h4>
                        </div>


                        <div class="form-group col-xs-12 col-sm-12   col-md-12">
                            <label for="validarDireccion">Dirección:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarDireccion" name="validarDireccion" required>
                        </div>


                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarCiudad">Ciudad:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarCiudad" name="validarCiudad" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarProvincia">Provincia:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarProvincia" name="validarProvincia" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6   col-md-6">
                            <label for="validarPais">Pais:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarPais" name="validarPais" required>
                        </div>

                        <div class="form-group col-xs-6 col-sm-6 col-md-6">
                            <label for="validarCPostal">Codigo postal:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarCPostal" name="validarCPostal" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12">
                            <button class="btn btn-info" type="reset" name="reset">Limpiar</button>
                            <button class="btn btn-primary" type="submit" name="registroEnviado">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>

