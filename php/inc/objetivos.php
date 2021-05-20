<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Objetivos'; ?>

    <?php include("../mod/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Inicio </a></li>
                        <li><a href="productos.php">Productos </a></li>
                        <li class="active">Objetivos </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Objetivos</h1>
                <hr>

                <h4>Canon</h4>
                <div class="row">
                    <?php
                    $productos = BD::obtieneProductos('objetivos', 'canon');
                    BD::muestraProductos($productos);
                    ?>
                </div>

                <h4>Nikon</h4>
                <div class="row">
                    <?php
                    $productos = BD::obtieneProductos('objetivos', 'nikon');
                    BD::muestraProductos($productos);
                    ?>
                </div>

                <h4>Sigma</h4>
                <div class="row">
                    <?php
                    $productos = BD::obtieneProductos('objetivos', 'SIGMA');
                    BD::muestraProductos($productos);
                    ?>
                </div>

                
                
                <h4>Sony</h4>
                <div class="row">
                    <?php
                    $productos = BD::obtieneProductos('objetivos', 'Sony');
                    BD::muestraProductos($productos);
                    ?>
                </div>

                
                <h4>Tamron</h4>
                <div class="row">
                    <?php
                    $productos = BD::obtieneProductos('objetivos', 'TAMRON');
                    BD::muestraProductos($productos);
                    ?>
                </div>

                

            </div>
        </div>



    </section>

    <?php include("../mod/footer.php")  ?>
</body>

</html>