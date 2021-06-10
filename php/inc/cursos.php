<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Cursos'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php"> Inicio </a></li>
                        <li class="active">Cursos</li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Los mejores cursos que podrás encontrar</h1>
                <hr>
                <?php
                $categorias = BD::categoriasProductoCurso();
                foreach ($categorias as $categoria) {
                    $cursos = BD::obtieneCursos($categoria['nombre']);
                    if (count($cursos) > 0) {
                        echo '<h2>' . $categoria['nombre'] . '</h2>';
                        echo '<div class="row">';
                        BD::muestraCursos($cursos);
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>

</body>

</html>