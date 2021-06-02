<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto';
    ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php
    if (isset($_POST['enviar'])) {
        $nombre = $_POST['validarNombre'];
        $correo = $_POST['validarTelefono'];
        $email = $_POST['validarEmail'];
        $mensaje = $_POST['validarMensaje'];
        $para = "ezelayal01@educantabria.es";
        $titulo = "Consulta a Photolazo";
        $headers  = 'MIME-Version: 1.0' . "\r\n"
        .'Content-type: text/html; charset=utf-8' . "\r\n"
        .'From: ' . $email . "\r\n";
         
        if(mail($para, $titulo, $mensaje, $headers)) {
            echo "<p>Thank you for contacting us, $nombre. You will get a reply within 24 hours.</p>";
        } else {
            echo '<p>We are sorry but the email did not go through.</p>';
        }
         
    } else {
        
    }
    ?>


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
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
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
                            <textarea class="form-control" id="validarMensaje" name="validarMensaje" rows="5" min="25" required></textarea>
                        </div>


                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <input value="Limpiar" class="btn btn-success" type="reset" name="reset" />
                                <input value="Enviar" class="btn btn-primary" type="submit" name="enviar" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>