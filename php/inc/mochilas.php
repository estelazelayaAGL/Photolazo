<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Mochilas'; ?>

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
                        <li class="active">Mochilas </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Mochilas</h1>
                <hr>

                <h4>Peak</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('mochilas', 'PEAK');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>


                <h4>Lowepro</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('mochilas', 'LOWEPRO');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
            </div>
        </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>