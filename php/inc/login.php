<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto'; ?>

    <?php include("../mod/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Bienvenido de nuevo</h1>
                <hr>
                <!-- INICIO FORMULARIO HTML -->
                <form method="POST" action="/index.php" class="needs-validation" novalidate>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="correo">Correo</label>
                            <input id="correo" name="correo" class="form-control" type="email" placeholder="Correo electrónico">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="palabraSecreta">Contraseña</label>
                            <input id="palabraSecreta" name="palabraSecreta" class="form-control" type="password" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                    <button type="submit" class="btn btn-primary mb-2">
                        Entrar
                    </button><br>
                    <a href="#">Contraseña olvidada</a></div></div>
                    
                   
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