<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Libros'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php
    
    if(isset($_POST['codigo'])) {
        $curso = BD::obtieneCurso($_POST['codigo']);
    }
    
    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Inicio </a></li>
                        <li><a href="cursos.php">Cursos </a></li>
                        <li class="active">Detalle de curso </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1><?php echo $curso->getTitulo()?></h1><br>
                <hr>
                


            </div>
        </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>