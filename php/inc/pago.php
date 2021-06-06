<?php require_once("../mod/clases/CestaCompra.php")  ?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Pago'; ?>

    <script src="../../js/funciones.js"></script>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Inicio </a></li>
                        <li><a href="cesta.php">Cesta </a></li>
                        <li class="active">Pago </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Tramitar pedido</h1>
                <hr />

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
                }
                if (isset($_POST['actualizarReceptor'])) {
                    $receptor = $_POST['nombreUsuario'];
                    $_SESSION['receptor'] = $receptor;
                    $usuarioString = (string) ($usuario->getUser_login());
                    $resulReceptor = BD::actualizarReceptor($usuarioString, $receptor);
                }

                ?>


                <!-- RECORDAR PONER EL DISPLAY -->
                <div class="form-group">
                    <span>Persona que recibirá el pedido:</span>
                    <div><strong><?php
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
                                            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                            <button class="btn btn-primary btn-lg" type="submit" name="actualizarReceptor">Actualizar nombre</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="form-group">
                        <span>Dirección donde se hará el envío:</span>
                        <div><strong><?php echo $direccion . ", " . $ciudad . ", " . $provincia . ", " . $pais . ", " . $codigoPostal ?></strong> | <input type="checkbox" id="modificarDireccion" value="modificarDireccion"> <label for="modificarDireccion">Modificar</label></div>
                    </div>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div id="div-direccion" class="tarjeta-div" style="display: none;">
                            <div class=" panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12   col-md-12">
                                            <input type="text" class="form-control" id="validarDireccion" name="validarDireccion" placeholder="Dirección">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12   col-md-6">
                                            <input type="text" class="form-control" id="validarCiudad" name="validarCiudad" placeholder="Ciudad">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-6">
                                            <input type="text" class="form-control" id="validarProvincia" name="validarProvincia" placeholder="Provincia">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-6">
                                            <input type="text" class="form-control" id="validarPais" name="validarPais" placeholder="Pais">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-6">
                                            <input type="text" class="form-control" id="validarCPostal" name="validarCPostal" placeholder="Codigo postal">
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

                    <!-- <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12"> -->
                    <!-- <form action="<?php //echo $_SERVER['PHP_SELF']; 
                                        ?>" method="POST"> -->
                    <div class="form-group">
                        <span>Metódo de pago:</span>
                        <input type="button" id="cuenta" name="cuenta" value="Cuenta bancaria" class='btn btn-primary btn-lg' />
                        <input type="button" id="tarjeta" name="tarjeta" value="Tarjeta de crédito/debito" class='btn btn-primary btn-lg' />
                    </div>
                    <!-- </form> -->


                    <form action="resumen.php" method="post">
                        <div id="cuentaform" class="tarjeta-div" style="display: none;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                            <input type="hidden" name="cuentaH" class="form-control" value="Cuenta bancaria" required />
                                            <input type="text" name="titular" class="form-control" placeholder="Titular" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                            <input type="text" name="iban" class="form-control" placeholder="IBAN" required />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                            <input type="text" name="bic" class="form-control" placeholder="BIC" required />
                                        </div>
                                    </div>
                                    <div class="row">
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
                                            <input type="hidden" name="tarjetaH" class="form-control" value="Tarjeta de crédito/débito" />
                                            <input type="text" name="titular" class="form-control" placeholder="Titular" required />
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                            <input type="text" name="numTarjeta" class="form-control" placeholder="Número tarjeta" required />
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <span class="help-block text-muted letra-peq">Mes caducidad</span>
                                            <input type="text" name="mesCaducidad" class="form-control" placeholder="Mes caducidad" required />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <span class="help-block text-muted letra-peq">Año caducidad</span>
                                            <input type="text" name="annoCaducidad" class="form-control" placeholder="Año caducidad" required />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <span class="help-block text-muted letra-peq">CVC</span>
                                            <input type="text" name="cvc" class="form-control" placeholder="CVC" required />
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 hidden-xs ">
                                            <img src="../../imagenes/imgMaquetacion/tarjetaPago.png" class="" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                            <input type="reset" name="limpiar" class="btn btn-primary btn-lg gris" value="Limpiar" />
                                            <!-- <a href='cesta.php'><input type='button' value='Modificar' class='btn btn-info' /></a> -->
                                            <input type='submit' name='pagar' class='btn btn-primary btn-lg' value='Finalizar pago' />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>