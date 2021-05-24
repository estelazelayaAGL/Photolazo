<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto';
    ?>

    <?php include("../mod/header.php")  ?>


    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">
            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php"> Inicio </a></li>
                        <li class="active">Contacto</li>
                    </ol>
                </div>
            </div>

            
                <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                    <div>
                        <h1>Contáctanos</h1>
                        <hr>
                    </div>

                    <div class="registro col-xs-12 col-sm-12 col-md-8">
                    <!-- INICIO FORMULARIO HTML -->
                    <form method="POST" action="#" class="needs-validation" novalidate>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="validarNombre">Nombre y apellidos:<span class="rojo">*</span></label>
                                <input type="text" class="form-control" id="validarNombre" name="validarNombre" required>
                            </div>
                    
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <label for="validarTelefono">Teléfono:</label>
                                <input type="number" class="form-control" id="validarTelefono" name="validarTelefono" max="999999999">
                            </div>
                    
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <label for="validarEmail">Correo electronico:<span class="rojo">*</span></label>
                                <input type="email" class="form-control" id="validarEmail" name="validarEmail" required>
                            </div>
                    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="validationMensaje">Su mensaje:<span class="rojo">*</span></label>
                                <textarea class="form-control" id="validationMensaje" name="validationMensaje" rows="5" min="25" required></textarea>
                            </div>
                    

                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <input value="Enviar" class="btn btn-primary" type="submit" name="submit" />
                                <input value="Limpiar" class="btn btn-success" type="reset" name="reset" />
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