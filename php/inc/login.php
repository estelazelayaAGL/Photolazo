<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Contacto'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php">Inicio </a></li>
                <li class="active">Iniciar sesión</li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>

    <?php

    //Para intentar iniciar sesión
    if (isset($_POST['intentoLogin'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $existe = BD::verificaCliente($usuario, $contrasena);

        if ($existe) {
            // $fila = $resultado->fetch();
            // if ($fila !== false) {
            $_SESSION['usuario'] = $usuario;
            header("Location: ../../index.php");
        } else {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>Usuario no registrado</div>";
        }
        // }
    }

    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h1>Bienvenido de nuevo</h1>
                    <hr>
                    <div><?php
                            if (isset($mensaje)) {
                                echo $mensaje;
                            }
                            ?>
                    </div>
                </div>
                <div class="registro col-xs-12 col-sm-12 col-md-12">
                    <div><img src="../../imagenes/imgMaquetacion/formLogin.png" alt=""></div>
                    <!-- INICIO FORMULARIO HTML -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input id="usuario" name="usuario" class="form-control" type="usuario" placeholder="Ingresa tu usuario" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input id="contrasena" name="contrasena" class="form-control" type="password" placeholder="Ingresa tu contraseña" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary mb-2" name="intentoLogin"> Entrar</button><br>
                                <a class="passOlvidada" href="#">Contraseña olvidada</a>
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