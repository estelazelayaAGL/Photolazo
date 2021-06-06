<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Iluminación'; ?>

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
                        <li class="active">Iluminación </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
            <h1>Iluminación</h1>
            <hr>

            <h4>Godox</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('iluminacion', 'GODOX');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>

                <h4>Manfrotto</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('iluminacion', 'MANFROTTO');
                    BD::muestraProductos($productos);
                    ?>
                    <!-- </span> -->
                </div>

                <h4>Yongnuo</h4>
                <div class="row">
                    <!-- <span> -->
                    <?php
                    $productos = BD::obtieneProductos('iluminacion', 'YONGNUO');
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