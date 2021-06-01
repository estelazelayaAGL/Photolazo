<!DOCTYPE html>
<html lang="en">
<?php require_once("../mod/clases/CestaCompra.php")  ?>
<body>
    <?php $titulo = 'Resumen del pedido'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">

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
                
                    if(isset($_POST['pagar'])) {
                        $tipoPago = $_POST['selector'];
                        $id_metodo = "";
                        //Crear el método de pago en función de si es cuenta o tarjeta
                        if ($tipoPago == 'cuenta') {
                            $id_metodo = BD::crearMetodoCuenta($_POST['titular'],$_POST['iban'],$_POST['bic']);
                        } else {
                            $id_metodo = BD::crearMetodoTarjeta($_POST['titular'],$_POST['numTarjeta'],$_POST['mesCaducidad'],$_POST['annoCaducidad'],$_POST['cvc']);
                        }
                        
                        //Creación del pedido
                        $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                        $id_usuario = $usuario->getId_usuario();
                        //$id_usuario, $id_metodo, $total, $personaRecepcion
                        $cesta = $_SESSION['cestaPago'];
                        // echo $cesta->get_coste();
                        $total = (double) $cesta->get_coste();
                        $id_pedido = BD::crearPedido($id_usuario, $id_metodo, $total, $_POST['recepcion']);

                        //Creación de las líneas de pedido
                        BD::crearLineasPedido($cesta, $id_pedido);

                    }

                ?>


            </div>
        </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>