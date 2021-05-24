<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto'; ?>

    <?php include("../mod/header.php")  ?>

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
                    <form method="POST" action="/index.php" class="needs-validation" novalidate>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- <label for="usuario">Usuario</label> -->
                                <input id="usuario" name="usuario" class="form-control" type="usuario" placeholder="Ingresa tu usuario" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- <label for="palabraSecreta">Contraseña</label> -->
                                <input id="palabraSecreta" name="palabraSecreta" class="form-control" placeholder="Ingresa tu contraseña" type="password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary mb-2">
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

    <?php include("../mod/footer.php")  ?>
</body>

</html>



