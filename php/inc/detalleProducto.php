<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Detalle del producto'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php

    if (isset($_POST['detalleProducto'])) {
        $producto = BD::obtieneProducto($_POST['codigo']);
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
                        <li><a href="productos.php">Productos </a></li>
                        <!-- <li><a href="cursos.php">Productos </a></li> PONER EL ENLACE ANTERIOR -->
                        <li class="active"><?php echo $producto->getNombre(); ?></li>
                    </ol>
                </div>
            </div>


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

                        <div class="col-xs-12 col-sm-12 col-md-12 sinPad">

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>