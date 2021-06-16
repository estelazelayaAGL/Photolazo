<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Detalle entrada'; ?>
    <script src="../../js/imagenAleatoria.js"></script>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <?php
    $codigo = "";
    if (isset($_POST['codigo'])) {
        $codigo = $_POST['codigo'];
        $_SESSION['blog'] = $codigo;
    } else {
        $codigo = $_SESSION['blog'];
    }

    $blog = BD::obtieneEntrada($codigo);
    ?>

    <?php

    if (isset($_POST['enviar'])) {
        $nombreC = $_POST['nombreC'];
        $correoC = $_POST['correoC'];
        $mensajeC = $_POST['mensajeC'];
        BD::crearComentario($nombreC, $correoC, $mensajeC, $codigo);
    }

    ?>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php">Inicio </a></li>
                <li><a href="cursos.php"> Blog </a></li>
                <li class="active"><?php echo $blog->getTitulo(); ?> </li>
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
                        <h1 class="espacio"><?php echo $blog->getTitulo() ?></h1>
                        <hr>
                        <div class="col-xs-12 col-sm-12 col-md-12 sinPad ">
                            <div class="col-xs-12 col-sm-12 col-md-2 float-left  sticky sinPad order-sm-1">
                                <div class="col-xs-2 col-sm-4 col-md-12 sinPad">
                                    <img src="../../imagenes/imgMaquetacion/avartar.png" alt="" class="imagenAutor img-fluid">
                                </div>
                                <div class="izquierda col-xs-10 col-sm-8 col-md-12">
                                    <div class="izquierda col-xs-12 col-sm-12 col-md-12">
                                        Autor:
                                        <label class="letraGrisPequena"><?php echo $blog->getAutor(); ?></label>
                                    </div>
                                    <div class="izquierda col-xs-12 col-sm-12 col-md-12 ">
                                        Publicación:
                                        <label class="separado letraGrisPequena"><?php echo $blog->getFechaPublicacion(); ?></label>
                                    </div>
                                    <div class="izquierda col-xs-12 col-sm-12 col-md-12">
                                        Categoría:
                                        <label class="separado letraGrisPequena"><?php echo BD::obtieneNombreCategoriaBlog($blog->getCategoria()); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-8 order-sm-0">
                                <div class="contenedor col-xs-12 col-sm-12 col-md-12">
                                    <img src="../../imagenes/imgObjetivas/entradas/<?php echo $blog->getTitulo(); ?>.png" alt="" class="img-fluid opaca">
                                </div>
                                <div class="">
                                    <ul class="iconos-social-top">
                                        <li>
                                            <a id='' href='https://www.youtube.com/'><img src='../../imagenes/imgMaquetacion/youtube.png' alt='' class="youtube"></a>
                                        </li>
                                        <li>
                                            <a id='' href='https://www.facebook.com/'><img src='../../imagenes/imgMaquetacion/facebook.png' alt='' class="facebook"></a>
                                        </li>
                                        <li>
                                            <a id='' href='https://twitter.com/'><img src='../../imagenes/imgMaquetacion/twitter.png' alt='' class="twitter"></a>
                                        </li>
                                        <li>
                                            <a id='' href='https://www.instagram.com/'><img src='../../imagenes/imgMaquetacion/instagram.png' alt='' class="instagram"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="texto col-xs-12 col-sm-12 col-md-12 text-justify espacio">
                                    <?php echo $blog->getContenido(); ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 float-right sticky order-sm-0">

                                <?php
                                $anterior = BD::anteriorEntrada($codigo);
                                if ($anterior != null) {
                                    echo '<div class="col-xs-6 col-sm-6 col-md-12">
            <form method="POST" action="' . $_SERVER['PHP_SELF'] . '">
            <input type="hidden" name="codigo" value="' . $anterior->getCodigo() . '"></input>
            <input  type="submit" name="anterior" value="Anterior" class="btn btn-info btn-lg espacio azul"></input>
            <div class="letraGrisPequena esp col-xs-12 col-sm-12 col-md-12 ">' . $anterior->getTitulo() . ' </div>
            </form></div>
            ';
                                }

                                $siguiente = BD::siguienteEntrada($codigo);
                                if ($siguiente != null) {
                                    echo '<div class="col-xs-6 col-sm-6 col-md-12">
            <form method="POST" action="' . $_SERVER['PHP_SELF'] . '">
            <input type="hidden" name="codigo" value="' . $siguiente->getCodigo() . '"></input>
            <input  type="submit" name="siguiente" value="Siguiente" class="btn btn-info btn-lg espacio azul"></input>
            <div class="letraGrisPequena  esp col-xs-12 col-sm-12 col-md-12">' . $siguiente->getTitulo() . ' </div>
            </form></div>
            ';
                                }

                                ?>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 espacio">
                            <?php
                            $comentarios = BD::obtenerComentarios($codigo);
                            funciones::mostrarComentarios($comentarios);
                            ?>
                        </div>



                        <div class="col-xs-12 col-sm-12 col-md-12 espacio">
                            <hr>
                            <h3>Deja una respuesta<br></h3>
                            <label class="font-italic small">Tu dirección de correo electrónico no será publicado. Los campos obligatorios están marcados con <span class="rojo">*</span></label>
                            <hr>
                        </div>

                        
                        <!-- INICIO FORMULARIO HTML -->
                        <div class="col-xs-12 col-sm-12 col-md-12 justify-content-center">
                        <div class="registro col-xs-12 col-sm-12 col-md-10">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label for="nombreC">Nombre:<span class="rojo">*</span></label>
                                    <input type="text" class="form-control" id="nombreC" name="nombreC" required>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label for="correoC">Correo electronico:<span class="rojo">*</span></label>
                                    <input type="email" class="form-control" id="correoC" name="correoC" required>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 espacio">
                                    <label for="mensajeC">Su mensaje:<span class="rojo">*</span></label>
                                    <textarea class="form-control" id="mensajeC" name="mensajeC" rows="5" min="25" required></textarea>
                                </div>



                                <div class="col-xs-12 col-sm-12 col-md-12 espacio " >
                                    <input value="Limpiar" class="btn btn-primary btn-lg gris" type="reset" name="reset" />
                                    <input value="Enviar" class="btn btn-primary btn-lg" type="submit" name="enviar" />
                                </div>
                            </form>
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