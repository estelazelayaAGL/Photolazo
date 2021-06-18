<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto';
    ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <script src="../../js/validaFormContacto.js"></script>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php"> Inicio </a></li>
                <li class="active">Contacto</li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>

    <?php
    $mensaje = "";
    if (isset($_POST['enviar'])) {
        $mensaje = "<div class ='col-xs-12 col-sm-12 col-md-12 alert alert-success'>
                <a class='close' data-dismiss='alert'> × </a>Muchas gracias por contactar con nosotros. Le responderemos con la mayor brevedad posible.</div>";
    }
    ?>


    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-body">
                        <div>
                            <h1>Contáctanos</h1>
                            <hr>
                        </div>
                        <div class="row">
                            <?php echo $mensaje; ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 formulario_mensaje" id="formulario_mensaje">
                                <div class='alert alert-danger'>
                                    <a class='close' data-dismiss='alert'> × </a>Error: Por favor rellene el formulario correctamente.
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 formulario_mensaje-exito" id="formulario_mensaje-exito">
                                <div class='alert alert-success'>
                                    <a class='close' data-dismiss='alert'> × </a>Muchas gracias por contactar con nosotros. Le responderemos con la mayor brevedad posible.
                                </div>
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <img class="img-fluid" src="../../imagenes/imgMaquetacion/img-contactanos.png" alt="">
                            </div>
                            <div class="registro col-xs-12 col-sm-12 col-md-6">
                                <!-- INICIO FORMULARIO HTML -->
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" id="contactoForm" novalidate autocomplete="off">
                                    <div class="formulario_grupo  col-xs-12 col-sm-12 col-md-12 col-lg-6" id="grupo_validarNombre">
                                        <label for="validarNombre" class="formulario_label">Nombre y apellidos:<span class="rojo">*</span></label>
                                        <div class="formulario_grupo-input">
                                            <input type="text" class="formulario_input" id="validarNombre" name="validarNombre" placeholder=" Estela Zelaya Lazo" required>
                                            <i class="formulario_validacion-estado fas fa-times-circle"></i>
                                        </div>
                                        <p class="formulario_input-error">El nombre solo puede contener letras, espacios y acentos. <strong>(Max. 60 caracteres)</strong></p>
                                    </div>

                                    <div class="formulario_grupo  col-xs-12 col-sm-12 col-md-12 col-lg-6" id="grupo_validarTelefono">
                                        <label for="validarTelefono" class="formulario_label">Teléfono:<span class="rojo">*</span></label>
                                        <div class="formulario_grupo-input">
                                            <input type="text" class="formulario_input" id="validarTelefono" name="validarTelefono" placeholder=" +34 661908318" required>
                                            <i class="formulario_validacion-estado fas fa-times-circle"></i>
                                        </div>
                                        <p class="formulario_input-error">Prefijo (+) seguido de 2 o 3 cifras, un espacio en blanco y 9 cifras consecutivas.</p>
                                    </div>

                                    <div class="formulario_grupo col-xs-12 col-sm-12 col-md-12" id="grupo_validarEmail">
                                        <label for="validarEmail" class="formulario_label">Correo electrónico:<span class="rojo">*</span></label>
                                        <div class="formulario_grupo-input">
                                            <input type="text" class="formulario_input " id="validarEmail" name="validarEmail" placeholder=" tucorreo@tucorreo.com" required>
                                            <i class="formulario_validacion-estado fas fa-times-circle"></i>
                                        </div>
                                        <p class="formulario_input-error">El correo solo puede contener letras, números, puntos, guiones o guión bajo.(Máx. 40 caracteres)</p>
                                    </div>

                                    <div class="formulario_grupo col-xs-12 col-sm-12 col-md-12" id="grupo_validarMensaje">
                                        <label for="validarMensaje" class="formulario_label">Su mensaje:<span class="rojo">*</span></label>
                                        <div class="formulario_grupo-input">
                                            <textarea class="form-control" id="validarMensaje" name="validarMensaje" rows="5" min="25" required></textarea>
                                            <i class="formulario_validacion-estado fas fa-times-circle"></i>
                                        </div>
                                        <p class="formulario_input-error">Debes escribir un mensaje.</p>
                                    </div>


                                    <div class="espacio col-xs-12 col-sm-12 col-md-12 formulario_grupo formulario_grupo-btn-enviar">
                                        <div>
                                            <input value="Limpiar" class="btn btn-primary btn-lg gris" type="reset" name="resetear" />
                                            <input value="Enviar" class="btn btn-primary btn-lg" type="submit" name="enviar" id="enviar" />
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>