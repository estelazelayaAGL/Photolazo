<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Mis Pedidos'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php"> Inicio </a></li>
                <li class="active">Mis pedidos</li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>

    <?php
    $usuario = null;
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../../index.php");
    } else {
        $usuario = BD::obtieneUsuario($_SESSION['usuario']);
    }
    ?>


    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion sinPad">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Todos los productos y cursos comprados</h1>
                        <hr>
                        <?php
                        $productos = BD::obtieneProductosDeUsuario($usuario->getId_usuario());
                        funciones::muestraProductosValoraciones($productos, $usuario->getId_usuario());
                        $cursos = BD::obtieneCursosDeUsuario($usuario->getId_usuario());
                        funciones::muestraCursosValoraciones($cursos, $usuario->getId_usuario());
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a href="../../index.php" class="espacio"><button class="btn btn-primary btn-lg ">Ir al inicio</button></a>
                        </div>
                    </div>
                </div>
            </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>