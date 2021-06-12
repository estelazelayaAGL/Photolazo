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
    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="index.php">Inicio </a></li>
                <li class="active">Cesta </li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>
    <!-- Impide el acceso a esta página a menos que se haya iniciado sesión -->
    <?php
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
    }
    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Cesta de compra</h1>
                        <hr />
                        <?php

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

                        // Para eliminar un curso de la seleccion
                        if (isset($_POST['quitarCurso'])) {
                            $cesta->eliminaCurso($_POST['codigo']);
                            $cesta->guarda_cesta();
                        }

                        // Si pulsamos el botón de pagar
                        if (isset($_POST['tramitar'])) {
                            header("Location:pago.php");
                        }

                        //// Para añadir un producto a la cesta - Si existe anadir en el formulario que llegó, se analiza que estén los demás campos recibidos.
                        echo "<div>";
                        if (isset($_POST['aniadir'])) {
                            if (isset($_POST['codigo'])) {
                                $codigo = $_POST['codigo'];
                                $cesta->nuevo_articulo($codigo);
                                $cesta->guarda_cesta();
                            } else {
                                echo "No has puesto código.";
                            }
                        } else if (isset($_POST['aniadirCurso'])) {
                            if (isset($_POST['codigo'])) {
                                $codigo = $_POST['codigo'];
                                $cesta->nuevo_curso($codigo);
                                $cesta->guarda_cesta();
                            }
                        }

                        $cesta = CestaCompra::carga_cesta();
                        $cesta->muestra();
                        //$cesta->muestraCurso();



                        ?>

                    </div>

                </div>
            </div>
        </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>

<?php
ob_end_flush();
?>