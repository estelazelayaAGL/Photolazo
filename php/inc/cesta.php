<!-- //Con esto, se pueden enviar los headers en cualquier lugar del documento. -->
<?php
ob_start();
?>

<?php require_once("../mod/clases/CestaCompra.php")  ?>


<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Cesta'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

<!-- Impide el acceso a esta página a menos que se haya iniciado sesión -->
<?php 
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
}
?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Inicio </a></li>
                        <li class="active">Cesta </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Listado de productos:</h1>
                <hr />
                <?php

                // Cesta de la compra:

                // Recuperamos la cesta de la compra o creamos una nueva
                $cesta = CestaCompra::carga_cesta();

                // Para vaciar la cesta
                if (isset($_POST['vaciar'])) {
                    unset($_SESSION['cesta']);
                    $cesta = new CestaCompra();
                }

                // Para eliminar un producto de la seleccion
                if (isset($_POST['quitar'])) {
                    $cesta->eliminaProducto($_POST['codigo']);
                    $cesta->guarda_cesta();
                }


                // Si pulsamos el botón de pagar
                if (isset($_POST['tramitar'])) {
                    header("Location:pago.php");
                }
                // Mostramos el contenido en todo momento
                //

                //// Para añadir un producto a la cesta - Si existe anadir en el formulario que llegó, se analiza que estén los demás campos recibidos.
                echo "<div>";
                if (isset($_POST['aniadir'])) {
                    if (isset($_POST['codigo'])) {
                        if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['marca'])) {
                            $codigo = $_POST['codigo'];
                            $cesta->nuevo_articulo($codigo);
                            $cesta->guarda_cesta();
                            // $nombre = $_POST['nombre'];
                            // $marca = $_POST['marca'];
                            // $descripcion = $_POST['descripcion'];
                            // $precio  = $_POST['precio'];

                            //imprimir todo el artículo
                            //echo $codigo;
                        } else {
                            echo 'No has puesto alguno de los siguientes: nombre, descripción, nombre_corto, PVP.';
                        }
                    } else {
                        echo "No has puesto código.";
                    }
                }

                $_SESSION['cestaPago']=$cesta;

                $cesta->muestra();

                


                //Obtención del método de pago: a través de post
                //(si es la primera vez en la página), o a través de la sesión.
                // $pago = '';
                // if (isset($_POST['codigo'])) {
                //     $codigo = $_POST["codigo"];
                //     $_SESSION['codigo'] = $codigo;
                // } else {
                //     $codigo = $_SESSION['codigo'];
                // }

                // echo $codigo

                ?>

            </div>

        </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>

<?php
ob_end_flush();
?>