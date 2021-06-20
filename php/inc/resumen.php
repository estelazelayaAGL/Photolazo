<!DOCTYPE html>
<html lang="en">
<?php require_once("../mod/clases/CestaCompra.php")  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

<body>
    <?php $titulo = 'Resumen del pedido'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php">Inicio </a></li>
                <li><a href="productos.php">Productos</a></li>
                <li class="active">Resumen </li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>
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
    $fechaPedido = date("d-m-Y");
    $fecha = BD::obtieneFechaEntrega($id_pedido);
    ?>


    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Resumen del pedido</h1>
                        <hr>
                        <div class="row text-left">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <h3 class="sinMargin">PhotoLazo</h3>
                                <label>http://photolazo.es</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                <strong>Fecha de pedido</strong>
                                <br>
                                <?php echo $fechaPedido ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-left">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong> Cliente:</strong> <?php echo $usuario->getNombre() . " " . $usuario->getApellidos(); ?><br>
                                <strong> Receptor del pedido:</strong> <?php echo  $_SESSION['receptor']; ?><br>
                                <strong> Dirección de envio: </strong><?php echo $usuario->getDireccion() . ", " . $usuario->getCodigo_postal() . " " . $usuario->getCiudad() . " " . $usuario->getProvincia() . " " . $usuario->getPais(); ?><br>
                                <strong> Método de pago: </strong><?php echo  $metodoString; ?><br>
                                <strong>Fecha prevista de entrega: </strong><?php echo $fecha[0] . "-" . $fecha[1] . "-" . $fecha[2]; ?><br>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <?php $total = $cesta->muestraSinBotonQuitar();
                                echo $total; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="pedidos.php"><button class="btn btn-primary btn-lg espacio">Ir a mis productos pedidos</button></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center espacio">
                                *************Gracias por tu compra*************
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