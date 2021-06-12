<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Detalle del producto'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php

    if (isset($_POST['detalleProducto'])) {
        $producto = BD::obtieneProducto($_POST['codigo']);
    }

    if (isset($_POST['valorar'])) {
        $producto = BD::obtieneProducto($_POST['codigo']);
        $id_usuario = $_POST['id_usuario'];
        $valoracion = $_POST['estrellas'];
        BD::anhadeResena($id_usuario, $_POST['codigo'], $valoracion);
        $mensaje = "Se ha valorado el producto correctamente";
    }

    ?>
    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="index.php">Inicio </a></li>
                <li><a href="productos.php">Productos </a></li>
                <!-- <li><a href="cursos.php">Productos </a></li> PONER EL ENLACE ANTERIOR -->
                <li class="active"><?php echo $producto->getNombre(); ?></li>
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
                            <h1><?php echo $producto->getNombre(); ?></h1><br>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 izquierda">
                            <hr>
                            <h2><?php echo $producto->getMarca(); ?></h2>
                            <h3><label class="negrita"> Categoria:</label> <?php echo $producto->getCategoria(); ?></h3>
                            <div class="col-xs-12 col-sm-12 col-md-6 espacio">
                                <h2 class="letraAzul">Descripción</h2>
                                <p class=""><?php echo $producto->getDescripcion(); ?></p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <img class="img-fluid" src="../../imagenes/imgObjetivas/productos/<?php echo $producto->getCodigo() ?>.png">
                            <div class="col-xs-12 col-sm-12 col-md-12 float-right border sticky order-sm-0">
                                <p class="negrita">Precio: </p>
                                <p class=""><label class="negrita precioDetalle"> <?php echo $producto->getPrecio() ?> €</label> (IVA no incluido)</p>

                                <form action="../inc/cesta.php" method="post">
                                    <input type="hidden" name="codigo" value="<?php echo $_POST['codigo'] ?>"></input>
                                    <input id="botoncurso" type="submit" name="aniadir" class="hidden"></input>
                                    <label for="botoncurso" class="btn btn-info btn-lg">Añadir al carrito <i class="fas fa-shopping-cart"></i></label>
                                </form>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <?php
                            if (isset($_SESSION['usuario'])) {
                                $comprado = BD::verificaCompraProducto($_SESSION['usuario'], $_POST['codigo']);
                                if ($comprado) {

                                    $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                                    $id_usuario = $usuario->getId_usuario();
                                    $valorado = BD::verificarResena($id_usuario, $_POST['codigo']);
                                    if (!$valorado) {
                            ?>
                                        <form method="post" action="detalleProducto.php">
                                            <input type="hidden" name="codigo" value="<?php echo $_POST['codigo']; ?>">
                                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
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
                                    } else {
                                        if (isset($mensaje)) {
                                            echo $mensaje;
                                        }
                                    }
                                }
                            }
                            $media = BD::mediaResenas($_POST['codigo']);
                            echo "Valoración media de los usuarios: $media";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>