<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Iluminación'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php">Inicio </a></li>
                <li><a href="productos.php">Productos </a></li>
                <li class="active">Iluminación </li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>


    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Iluminación</h1>
                        <hr>

                        <?php
                        $vacio = true;
                        $marcas = BD::obtieneTodasLasMarcas();
                        foreach ($marcas as $marca) {
                            $productos = BD::obtieneProductos('iluminacion', $marca['nombre']);
                            if (count($productos) > 0) {
                                echo '<h2>' . $marca['nombre'] . '</h2>';
                                echo '<div class="row">';
                                funciones::muestraProductos($productos);
                                echo '</div>';
                                $vacio = false;
                            }
                        }
                        if ($vacio) {
                            echo '<div class="col-xs-12 col-sm-12 col-md-12">';
                            echo '<h3>Lista vacía.</h3>';
                            echo '</div>';
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