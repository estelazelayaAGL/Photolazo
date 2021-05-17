<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Registro';
    ?>
    

    <?php include("../mod/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Crea una cuenta</h1>
                <h4>Es fácil y rápido</h4>
                <hr>
                <!-- INICIO FORMULARIO HTML -->
                <form method="POST" action="/index.php" class="needs-validation" novalidate>
                    <!-- DATOS DEL CLIENTE -->
                    <div class="form-row ">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarNombre">Nombre:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarNombre" name="validarNombre" required>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarApellido">Apellidos:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarApellido" name="validarApellido" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarTelefono">Teléfono:</label>
                            <input type="number" class="form-control" id="validarTelefono" name="validarTelefono" max="999999999">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarEmail">Correo electronico:<span class="rojo">*</span></label>
                            <input type="email" class="form-control" id="validarEmail" name="validarEmail" required>
                        </div>
                    </div>
                    <!-- DATOS NECESARIOS PARA ENVIOS DE LOS PEDIDOS -->

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarDireccion">Dirección:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarDireccion" name="validarDireccion" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarCPostal">Codigo postal:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarCPostal" name="validarCPostal" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarCiudad">Ciudad:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarCiudad" name="validarCiudad" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarProvincia">Provincia:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarProvincia" name="validarProvincia" required>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="validarPais">Pais:<span class="rojo">*</span></label>
                            <input type="text" class="form-control" id="validarPais" name="validarPais" required>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <button class="btn btn-primary" type="submit" name="submit">Enviar</button>
                            <button class="btn btn-success" type="reset" name="reset">Limpiar</button>
                        </div>
                    </div>

                </form>
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

    <?php include("../mod/footer.php")  ?>
</body>

</html>