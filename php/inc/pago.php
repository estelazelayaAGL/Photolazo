<?php require_once("../mod/CestaCompra.php")  ?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Pago'; ?>

    <?php include("../mod/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">

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

                $cesta = $_SESSION['cestaPago'];
                //Muestro los productos a pagar
                echo $cesta->muestraSinBotonQuitar(); ?>



                <!-- RECORDAR PONER EL DISPLAY -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <span>Dirección donde se hará el envio:</span>
                        <span>DIRECONJSNDFJNSJDNGJDSNJN</span>
                        <br>
                        <input type="checkbox" id="modificarDireccion" value="modificarDireccion"> <label for="modificarDireccion">Quiero modificar la dirección</label>
                    </div>

                    <div id="actualizarDiv" class="tarjeta-div" style="display: none;">
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
                                    <button class="btn btn-primary" type="submit" name="actualizar">Actualizar dirección</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>


            <!-- <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12"> -->
            <form action="index.php" method="post">
                <div class="form-group">
                    <span>Metódo de pago:</span>
                    <select id="selector">
                        <option value="" selected disabled hidden>Elige una</option>
                        <option value="cuenta">Cuenta</option>
                        <option value="tarjeta">Tarjeta crédito/débido</option>
                    </select>
                </div>

                <div id="cuentaform" class="tarjeta-div" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                    <input type="text" name="titular" class="form-control" placeholder="Titular" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                    <input type="text" name="iban" class="form-control" placeholder="IBAN" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                    <input type="text" name="bic" class="form-control" placeholder="BIC" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                    <input type="reset" name="limpiar" class="btn btn-info" value="Limpiar" />
                                    <a href='cesta.php'><input type='button' value='Modificar' class='btn btn-info' /></a>
                                    <input type='submit' name='pagar' class='btn btn-primary' value='Finalizar pago' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tarjetaform" class="tarjeta-div" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                    <input type="text" name="titular" class="form-control" placeholder="Titular" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                    <input type="text" name="numTarjeta" class="form-control" placeholder="Número tarjeta" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <span class="help-block text-muted letra-peq">Mes caducidad</span>
                                    <input type="text" name="mesCaducidad" class="form-control" placeholder="Mes caducidad" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <span class="help-block text-muted letra-peq">Año caducidad</span>
                                    <input type="text" name="annoCaducidad" class="form-control" placeholder="Año caducidad" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <span class="help-block text-muted letra-peq">CVC</span>
                                    <input type="text" name="cvc" class="form-control" placeholder="CVC" />
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 hidden-xs ">
                                    <img src="../../imagenes/imgMaquetacion/tarjetaPago.png" class="" />
                                </div>

                            </div>
                            <!-- <div class="row">
                                        <div class="col-md-12 pad-adjust">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked class="text-muted"> Gurdar para próximos pagos <a href="#">¿Saber cómo?</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <input type="reset" name="limpiar" class="btn btn-info" value="Limpiar" />
                                    <a href='cesta.php'><input type='button' value='Modificar' class='btn btn-info' /></a>
                                    <input type='submit' name='pagar' class='btn btn-primary' value='Finalizar pago' />
                                </div>
                            </div>
                            <!-- <div class="row ">
                                        <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                                            <input type="submit" class="btn btn-danger" value="CANCEL" />
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                                            <input type="submit" class="btn btn-warning btn-block" value="PAY NOW" />
                                        </div>
                                    </div> -->
                            <!-- <input type="submit" name="enviar" value="Enviar" /> -->
                        </div>
                    </div>
                </div>
            </form>


            <!-- </div> -->




            <?php
            /*if (!isset($_POST['pagar'])) {
                    //Si no se ha pulsado en pagar, mostrar los botones de navegación
                    echo 
                    "<form action='pago.php' method='post' >".
                    "<div class='row form-group'>".
                    "<div class='col-xs-12 col-sm-12 col-md-6'>"
                        // . "<form action='pago.php' method='post' >"
                        . "<a href='cesta.php'><input type='button' value='Modificar' class='btn btn-info'/></a>"
                        . "<input type='submit' name='pagar' class='btn btn-primary' value='Finalizar pago'></input>"
                        // . "</form>"
                        . "</div>"
                    ."</div>"
                    ."</form>";
                }*/
            ?>

        </div>

        </div>


    </section>

    <?php include("../mod/footer.php")  ?>
</body>

</html>