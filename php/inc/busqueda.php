<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Búsqueda'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="index.php">Inicio </a></li>
                <li class="active">Búsqueda</li>
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
                        <h1>Búsqueda</h1><br>
                        <hr>

                        <?php
                        $vacio = true;
                        if (isset($_POST['buscar']) && $_POST['buscar'] != "") {
                            echo '<div class="col-xs-12 col-sm-12 col-md-12">';
                            echo '<h3>Resultado de la búsqueda: "' . $_POST['buscar'] . '"</h3>';
                            echo '</div>';
                            $productos = BD::obtieneProductosPorNombre($_POST['buscar']);
                            if (count($productos) > 0) {
                                echo '<h2>Productos</h2>';
                                echo '<div class="row">';
                                BD::muestraProductos($productos);
                                echo '</div>';
                                $vacio = false;
                            }
                            $cursos = BD::obtieneCursosPorNombre($_POST['buscar']);
                            if (count($cursos) > 0) {
                                echo '<h2>Cursos</h2>';
                                echo '<div class="row">';
                                BD::muestraCursos($cursos);
                                echo '</div>';
                                $vacio = false;
                            }
                        }
                        if ($vacio) {
                            echo '<div class="col-xs-12 col-sm-12 col-md-12">';
                            echo '<p>Lista vacía.</p>';
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