<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Cursos'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <!-- <script src="../../js/verMas.js"></script> -->

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php"> Inicio </a></li>
                <li class="active">Cursos</li>
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
                        <h1>Los mejores cursos que podrás encontrar</h1>
                        <hr>
                        <?php
                        $vacio = true;
                        $categorias = BD::categoriasProductoCurso();
                        foreach ($categorias as $categoria) {
                            $cursos = BD::obtieneCursos($categoria['nombre']);
                            if (count($cursos) > 0) {
                                echo '<h2>' . $categoria['nombre'] . '</h2>';
                                echo '<div class="row">';
                                funciones::muestraCursos($cursos);
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