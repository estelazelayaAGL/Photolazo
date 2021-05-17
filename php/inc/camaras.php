<!DOCTYPE html>
<html lang="en">
<body>
    <?php $titulo = 'Cámaras'; ?>

    <?php include("../mod/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php"> Inicio </a></li>
                        <li><a href="productos.php"> Productos </a></li>
                        <li class="active">Cámaras</li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Cámaras</h1>
                <hr>

                <h4>Nikon</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('camaras', 'nikon');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
                <h4>Canon</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('camaras', 'Canon');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
                <h4>Fujifilm</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('camaras', 'Fujifilm');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
                <h4>Nikon</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('camaras', 'nikon');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
                <h4>Nikon</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('camaras', 'nikon');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
                <h4>Nikon</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('camaras', 'nikon');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>
            </div>
        </div>

    </section>

    <?php include("../mod/footer.php")  ?>
</body>

</html>