<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Accesorios'; ?>

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
                        <li class="active">Mochilas </li>
                    </ol>
                </div>
            </div>
        </div>


        <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
            <h1>Accesorios</h1><br>
            <hr>
            <div class="row">
                <?php
                    // $Productos = BD::obtieneProductos('accesorios');
                    // BD::muestraProductos($Productos);
                ?>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>