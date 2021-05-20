<?php require_once("../mod/CestaCompra.php")  ?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Cesta'; ?>
    <?php include("../mod/header.php")  ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Inicio </a></li>
                        <li><a href="cesta.php">Cesta </a></li>
                        <li class="active">Pago </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Finalizar pago</h1>
                <hr/>
                
            </div>

        </div>


    </section>

    <?php include("../mod/footer.php")  ?>
</body>

</html>