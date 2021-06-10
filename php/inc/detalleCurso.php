<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Detalle de curso'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php

    if (isset($_POST['detalleCurso'])) {
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
                        <li class="active"><?php $curso->getTitulo(); ?></li>
                    </ol>
                </div>
            </div>


            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h1><?php echo $curso->getTitulo(); ?></h1><br>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 izquierda">
                            <hr>
                            <h2><?php echo $curso->getLema(); ?></h2>
                            <h3><label class="class=" negrita""> Creado por:</label> <?php echo $curso->getAutor(); ?></h3>
                            <h3><label class="negrita">Nivel:</label> <?php echo $curso->getNivel(); ?></h3>
                            <h3><label class="negrita">Categoria:</label> <?php echo $curso->getCategoria(); ?></h3>

                            <div class="panelCentral">
                                <h1>¿Que aprenderás?</h1>
                                <p><?php echo $curso->getResumen(); ?></p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <h3>Vista previa del curso:</h3>
                            <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 sinPad">
                            <div class="col-xs-12 col-sm-12 col-md-10 espacio">
                                <h2 class="letraAzul">Descripción</h2>
                                <p class=""><?php echo $curso->getDescripcion(); ?></p>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-2 float-right border sticky order-sm-0">
                                <p class="negrita">Precio: </p>
                                <p class=""><label class="negrita precioDetalle"> <?php echo $curso->getPrecio() ?> €</label> (IVA no incluido)</p>
                                <?php
                                if (isset($_SESSION['usuario'])) {
                                    $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                                    $codigo = $usuario->getId_usuario();
                                    $comprado = BD::verificaCompraCurso($codigo, $_POST['codigo']);
                                    if (!$comprado) {
                                ?>
                                        <form action="../inc/cesta.php" method="post">
                                            <input type="hidden" name="codigo" value="<?php echo $_POST['codigo'] ?>"></input>
                                            <input id="botoncurso" type="submit" name="aniadirCurso" class="hidden"></input>
                                            <label for="botoncurso" class="btn btn-info btn-lg">Añadir al carrito <i class="fas fa-shopping-cart"></i></label>
                                        </form>

                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>