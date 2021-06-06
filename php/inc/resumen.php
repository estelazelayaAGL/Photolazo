<!DOCTYPE html>
<html lang="en">
<?php require_once("../mod/clases/CestaCompra.php")  ?>

<body>
    <?php $titulo = 'Resumen del pedido'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Inicio </a></li>
                        <li><a href="productos.php">Productos </a></li>
                        <li class="active">Resumen </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Resumen del pedido</h1>

                <?php

                if (isset($_POST['pagar'])) {
                    $metodoString = "";
                    $id_metodo = "";
                    if (isset($_POST['cuentaH'])) {
                        $tipoPago = $_POST['cuentaH'];
                        $id_metodo = BD::crearMetodoCuenta($_POST['titular'], $_POST['iban'], $_POST['bic']);
                        $metodoString = "Cuenta de ahorros";
                    }
                    if (isset($_POST['tarjetaH'])) {
                        $tipoPago = $_POST['tarjetaH'];
                        $id_metodo = BD::crearMetodoTarjeta($_POST['titular'], $_POST['numTarjeta'], $_POST['mesCaducidad'], $_POST['annoCaducidad'], $_POST['cvc']);
                        // echo $id_metodo;
                        $metodoString = "Tarjeta de débito/crédito";
                    }

                    //Creación del pedido
                    $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                    $id_usuario = $usuario->getId_usuario();
                    //$id_usuario, $id_metodo, $total, $personaRecepcion
                    $cesta = $_SESSION['cesta'];
                    // echo $cesta->get_coste();
                    $total = (float) $cesta->get_coste();
                    $direccion = "" . $usuario->getDireccion() . ", " . $usuario->getCodigo_postal() . " " . $usuario->getCiudad() . " " . $usuario->getProvincia() . " " . $usuario->getPais();
                    $id_pedido = BD::crearPedido($id_usuario, $id_metodo, $total, $_SESSION['receptor'], $direccion);

                    //Creación de las líneas de pedido
                    BD::crearLineasPedido($cesta, $id_pedido);
                    BD::crearCursosUsuario($cesta, $id_usuario, $id_metodo);
                    unset($_SESSION['cesta']);
                    // echo $id_usuario. " ". $id_metodo." ". $total. $_SESSION['receptor'] . " " . $direccion;
                }


                ?>
                <?php
                $fecha = date("Y-m-d");
                ?>
                <hr>
                <div class="row">
                    <div class="col-xs-10">
                    </div>
                    <div class="col-xs-2 text-center">
                        <strong>Fecha</strong>
                        <br>
                        <?php echo $fecha ?>
                        <br>
                        <strong>Factura No.</strong>
                        <br>
                        <?php echo $numero ?>
                    </div>
                </div>

                <div class="row text-center" style="margin-bottom: 2rem;">
                    <div class="col-xs-12">
                        <h3>Cliente: <strong><?php echo $usuario->getNombre() . " " . $usuario->getApellidos(); ?></strong></h3>
                        <h3>Receptor del pedido: <strong><?php echo  $_SESSION['receptor']; ?></strong></h3>
                        <h3>Dirección de envio: <strong><?php echo $usuario->getDireccion() . ", " . $usuario->getCodigo_postal() . " " . $usuario->getCiudad() . " " . $usuario->getProvincia() . " " . $usuario->getPais(); ?></strong></h3>
                        <h3>Método de pago: <strong><?php echo  $metodoString; ?></strong></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                    <?php $total=$cesta->muestraSinBotonQuitar();  echo $total;?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p class="h5"><?php echo $mensajePie ?></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>