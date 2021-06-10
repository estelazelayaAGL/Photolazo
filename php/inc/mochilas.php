<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Mochilas'; ?>

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

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Mochilas</h1>
                        <hr>

                        <?php
                        $marcas = BD::obtieneTodasLasMarcas();
                        foreach ($marcas as $marca) {
                            $productos = BD::obtieneProductos('mochilas', $marca['nombre']);
                            if (count($productos) > 0) {
                                echo '<h2>' . $marca['nombre'] . '</h2>';
                                echo '<div class="row">';
                                BD::muestraProductos($productos);
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>