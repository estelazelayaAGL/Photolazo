<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Detalle de curso'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <?php
    if (isset($_POST['detalleCurso'])) {
        $curso = BD::obtieneCurso($_POST['codigo']);
    }

    if (isset($_POST['valorar'])) {
        $curso = BD::obtieneCurso($_POST['codigo']);
        $id_usuario = $_POST['id_usuario'];
        $valoracion = $_POST['estrellas'];
        BD::anhadeResenaCurso($id_usuario, $_POST['codigo'], $valoracion);
        $mensaje = "Se ha valorado el curso correctamente";
    }
    ?>

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
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h1><?php echo $curso->getTitulo(); ?></h1><br>
                            <hr>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 izquierda">
                            <h3 style="text-align:center;"><i><?php echo $curso->getLema(); ?></i></h3>
                            <hr>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                                <small><i>Vista previa del curso:</i></small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 espacio">
                            <h3 class="izquierda espacio"><label class="negrita"> Creado por:</label> <?php echo $curso->getAutor(); ?></h3>
                            <h3 class="izquierda espacio"><label class="negrita">Nivel:</label> <?php echo $curso->getNivel(); ?></h3>
                            <h3 class="izquierda espacio"><label class="negrita">Categoría:</label> <?php echo BD::obtieneNombreCategoria($curso->getCategoria()); ?></h3>
                            <div class="col-xs-12 col-sm-12 col-md-12 sinPad">
                                <?php
                                if (isset($_SESSION['usuario'])) {
                                    $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                                    $codigo = $usuario->getId_usuario();
                                    $comprado = BD::verificaCompraCurso($codigo, $_POST['codigo']);
                                    if ($comprado) {
                                        $valorado = BD::verificarResenaCurso($codigo, $_POST['codigo']);
                                        if (!$valorado) {
                                ?>
                                            <form method="post" action="detalleCurso.php">
                                                <input type="hidden" name="codigo" value="<?php echo $_POST['codigo']; ?>">
                                                <input type="hidden" name="id_usuario" value="<?php echo $codigo; ?>">
                                                <p class="clasificacion">
                                                    <input id="radio1" type="radio" name="estrellas" value="5">
                                                    <label class="estrella" for="radio1">★</label>
                                                    <input id="radio2" type="radio" name="estrellas" value="4">
                                                    <label class="estrella" for="radio2">★</label>
                                                    <input id="radio3" type="radio" name="estrellas" value="3">
                                                    <label class="estrella" for="radio3">★</label>
                                                    <input id="radio4" type="radio" name="estrellas" value="2">
                                                    <label class="estrella" for="radio4">★</label>
                                                    <input id="radio5" type="radio" name="estrellas" value="1">
                                                    <label class="estrella" for="radio5">★</label>
                                                </p>
                                                <input id="botoncurso" type="submit" name="valorar" value="Valorar" />
                                            </form>
                                <?php
                                        }
                                    }
                                }
                                $media = BD::mediaResenasCurso($_POST['codigo']);
                                echo "Valoración media de los usuarios: " . number_format($media, 2);
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 sinPad">
                            <hr>
                            <div class="panelCentral blanco">
                                <h2 class="blanconegrita">¿Que aprenderás?</h2>
                                <p class="blanco"><?php echo $curso->getResumen(); ?></p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 sinPad">
                        <hr>
                            <div class="col-xs-12 col-sm-12 col-md-10 espacio">
                                <h2 class="letraAzul">Descripción</h2>
                                <p class=""><?php echo $curso->getDescripcion(); ?></p>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-2 float-right border sticky order-sm-0 espacio">
                                <p class="negrita">Precio: </p>
                                <p class=""><label class="negrita precioDetalle"> <?php echo $curso->getPrecio() ?> €</label> (IVA no incluido)</p>
                                <?php
                                if (isset($_SESSION['usuario'])) {
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