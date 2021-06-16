<?php require_once("../mod/clases/CestaCompra.php")  ?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Pago'; ?>

    <script src="../../js/funciones.js"></script>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php">Inicio </a></li>
                <li><a href="cesta.php">Cesta </a></li>
                <li class="active">Pago </li>
            </ol>
        </div>
    </div>

    </nav>
    </div>
    <!-- Termina el header -->
    </header>



    <?php
    // OBTIENE LOS DATOS DE DIRECCION DEL USUARIO LOGUEADO, LUEGO ESTOS DATOS SE MUESTRAN EN UN DIV DEL HTML
    $usuario = BD::obtieneUsuario($_SESSION['usuario']);
    $direccion = $usuario->getDireccion();
    $codigoPostal = $usuario->getCodigo_postal();
    $ciudad = $usuario->getCiudad();
    $provincia = $usuario->getProvincia();
    $pais = $usuario->getPais();
    $nombre = $usuario->getNombre() . ' ' . $usuario->getApellidos();

    ?>


    <?php
    // SI EXISTE ACTUALIZAR SE ACTUALIZAN LOS CAMPOS DE DIRECCION DE ESTE USUARIO CONECTADO
    if (isset($_POST['actualizar'])) {
        $direccion = $_POST['validarDireccion'];
        $ciudad = $_POST['validarCiudad'];
        $provincia = $_POST['validarProvincia'];
        $pais = $_POST['validarPais'];
        $codigoPostal = $_POST['validarCPostal'];
        $usuarioString = (string) ($usuario->getUser_login());
        $resul = BD::actualizarDireccion($usuarioString, $direccion, $ciudad, $provincia, $pais, $codigoPostal);
    }

    // SI EXISTE ACTUALIZAR SE ACTUALIZAN LOS CAMPOS DE DIRECCION DE ESTE USUARIO CONECTADO
    // $usuarioString = (string) ($usuario->getUser_login());
    // $existe=BD::existeReceptor($usuarioString);
    $existe = false;
    if (isset($_SESSION['receptor'])) {
        $existe = true;
    } else {
        $_SESSION['receptor'] = $nombre;
    }
    if (isset($_POST['actualizarReceptor'])) {
        $receptor = $_POST['nombreUsuario'];
        $_SESSION['receptor'] = $receptor;
        $usuarioString = (string) ($usuario->getUser_login());
        $resulReceptor = BD::actualizarReceptor($usuarioString, $receptor);
    }

    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Tramitar pedido</h1>
                        <hr />
                        <!-- RECORDAR PONER EL DISPLAY -->
                        <div class="form-group">
                            <span>Persona que recibirá el pedido:</span>
                            <div class="izquierda"><strong><?php
                                                            if ($existe) {
                                                                echo $_SESSION['receptor'] . '</strong> | <input type="checkbox" id="modificarNombre" value="modificarNombre"> <label for="modificarNombre">Modificar</label></div>';
                                                            } else {
                                                                echo $nombre . '</strong> | <input type="checkbox" id="modificarNombre" value="modificarNombre"> <label for="modificarNombre">Modificar</label></div>';
                                                            }
                                                            ?>
                            </div>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div id="div-nombre" class="tarjeta-div" style="display: none;">
                                    <div class=" panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="form-group col-xs-12 col-sm-12   col-md-12">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" class="formulario_input" id="nombreUsuario" name="nombreUsuario" placeholder=" Nombre" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                    <div class="formulario_grupo-input">
                                                        <button class="btn btn-primary btn-lg" type="submit" name="actualizarReceptor">Actualizar nombre</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="form-group">
                                <span>Dirección donde se hará el envío:</span>
                                <div class="izquierda"><strong>
                                        <?php echo $direccion . ", " . $ciudad . ", " . $provincia . ", " . $pais . ", " . $codigoPostal ?></strong> | <input type="checkbox" id="modificarDireccion" value="modificarDireccion">
                                    <label class="float-rigth" for="modificarDireccion">Modificar</label>
                                </div>
                            </div>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div id="div-direccion" class="tarjeta-div" style="display: none;">
                                    <div class=" panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" class="formulario_input" id="validarDireccion" name="validarDireccion" placeholder=" Dirección" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-xs-12 col-sm-12   col-md-6">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" class="formulario_input" id="validarCiudad" name="validarCiudad" placeholder=" Ciudad" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-12 col-md-6">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" class="formulario_input" id="validarProvincia" name="validarProvincia" placeholder=" Provincia" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-6">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" class="formulario_input" id="validarPais" name="validarPais" placeholder=" Pais" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-12 col-md-6">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" class="formulario_input" id="validarCPostal" name="validarCPostal" placeholder=" Codigo postal" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                    <button class="btn btn-primary btn-lg" type="submit" name="actualizar">Actualizar dirección</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                            $cesta = $_SESSION['cesta'];
                            //Muestro los productos a pagar y le mando la cesta para que tambíen me muestre el resultado del total de los productos
                            echo $cesta->muestraSinBotonQuitar();
                            ?>

                            <div class="form-group izquierda espacio">
                                <span>Metódo de pago:</span>
                                <input type="button" id="cuenta" name="cuenta" value="Cuenta bancaria" class='btn btn-primary btn-lg' />
                                <input type="button" id="tarjeta" name="tarjeta" value="Tarjeta de crédito/debito" class='btn btn-primary btn-lg' />
                            </div>

                            <form action="resumen.php" method="post">
                                <div id="cuentaform" class="tarjeta-div" style="display: none;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                    <div class="formulario_grupo-input">
                                                        <input type="hidden" name="cuentaH" class="formulario_input" value="Cuenta bancaria" required />
                                                        <input type="text" name="titular" class="formulario_input" placeholder=" Titular" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" name="iban" class="formulario_input" placeholder=" IBAN" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" name="bic" class="formulario_input" placeholder=" BIC" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="espacio row">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                    <input type="reset" name="limpiar" class="btn btn-primary btn-lg gris" value="Limpiar" />
                                                    <input type='submit' name='pagar' class='btn btn-primary btn-lg' value='Finalizar pago' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form action="resumen.php" method="post">
                                <div id="tarjetaform" class="tarjeta-div" style="display: none;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                    <!-- <input type="hidden" name="receptor" class="formulario_input" value="<?php //echo $_SESSION['receptor']; 
                                                                                                                                ?>" /> -->
                                                    <input type="hidden" name="tarjetaH" class="formulario_input" value="Tarjeta de crédito/débito" />
                                                    <input type="text" name="titular" class="formulario_input" placeholder=" Titular" required />
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="formulario_grupo col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" name="numTarjeta" class="formulario_input" placeholder=" Número tarjeta" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="formulario_grupo col-xs-12 col-sm-4 col-md-3 pad-adjust">
                                                    <div class="formulario_grupo-input">
                                                        <span class="help-block text-muted letra-peq">Mes caducidad</span>
                                                        <input type="text" name="mesCaducidad" class="formulario_input" placeholder=" Mes caducidad" required />
                                                    </div>
                                                </div>
                                                <div class="formulario_grupo col-xs-12 col-sm-4 col-md-3 pad-adjust">
                                                    <span class="help-block text-muted letra-peq formulario_label">Año caducidad</span>
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" name="annoCaducidad" class="formulario_input" placeholder=" Año caducidad" required />
                                                    </div>
                                                </div>
                                                <div class="formulario_grupo col-xs-12 col-sm-4 col-md-3 pad-adjust">
                                                    <span class="help-block text-muted letra-peq formulario_label">CVC</span>
                                                    <div class="formulario_grupo-input">
                                                        <input type="text" name="cvc" class="formulario_input" placeholder=" CVC" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-0 col-sm-2 col-md-3 hidden-xs">
                                                    <img src="../../imagenes/imgMaquetacion/tarjetaPago.png" class="" />
                                                </div>

                                            </div>
                                            <div class="espacio row">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                    <input type="reset" name="limpiar" class="btn btn-primary btn-lg gris" value="Limpiar" />
                                                    <input type="submit" name="pagar" class="btn btn-primary btn-lg" value="Finalizar pago" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>