<!DOCTYPE html>
<html lang="en">

<body>
    <script src="../../js/administracionProductos.js"></script>
    <?php $titulo = 'Administración'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    

    <!-- Impide el acceso a esta página a menos que se haya iniciado sesión como usuario administrador (campo tipo_usuario = 1) -->
    <?php
    if (isset($_SESSION['usuario'])) {
        $usuario = BD::obtieneUsuario($_SESSION['usuario']);
        if ($usuario->getTipo_usuario() == 0) {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
    ?>


    <?php
    if (isset($_POST['anadir'])) {
        $idProductoA = $_POST['idProducto_A'];
        $idCategoriaA = $_POST['idCategoriaProd_A'];
        $idMarcaA = $_POST['idMarcaProd_A'];
        $nombreA = $_POST['nombreProducto_A'];
        $unidadesA = $_POST['unidadesProducto_A'];
        $precioA = $_POST['precioProducto_A'];
        $descripcionA = $_POST['descripcionProducto_A'];

        $mensaje = BD::insertarProducto($idProductoA, $idCategoriaA, $idMarcaA, $nombreA, $unidadesA, $precioA, $descripcionA);
    }

    if (isset($_POST['actualizar'])) {
        $idProductoM = $_POST['idProducto_M'];
        $idCategoriaM = $_POST['idCategoriaProd_M'];
        $idMarcaM = $_POST['idMarcaProd_M'];
        $nombreM = $_POST['nombreProducto_M'];
        $unidadesM = $_POST['unidadesProducto_M'];
        $precioM = $_POST['precioProducto_M'];
        $descripcionM = $_POST['descripcionProducto_M'];
        echo "LLEGO";

        $mensaje = BD::actualizarProducto($idProductoM, $idCategoriaM, $idMarcaM, $nombreM, $unidadesM, $precioM, $descripcionM);
    }

    if (isset($_POST['modificar'])) {
        $disp = "block";
        $idProductoM = $_POST['idProducto'];

        $productoAModificar = BD::extraeProductosCod($idProductoM);
    } else {
        $disp = "none";
    }

    
    if (isset($_POST['eliminar'])) {
        $idProducto = $_POST['idProducto'];
        $mensaje = BD::eliminarProducto($idProducto);
    }


    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">


            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Gestión de productos</h1>
                <hr>
                <div><?php
                        if (isset($mensaje)) {
                            echo $mensaje;
                        }
                        ?>
                </div>
                <fieldset>
                    <legend>Gestión productos</legend>
                    <input type="button" name="anadeProducto" id="anadeProducto" value="Añadir producto" />
                    <!-- <a href="datosproducto.php"> -->
                    <input type="button" name="obtieneLista" id="obtieneLista" value="Mostrar lista de productos" />
                    <!-- </a> -->
                </fieldset>


                <div id="divAnadeProducto" class="tarjeta-div" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <h4>AÑADIR PRODUCTO</h4>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>ID Producto</label>
                                        <input type="text" name="idProducto_A" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>ID Categoria</label>
                                        <input type="text" name="idCategoriaProd_A" class="form-control" placeholder="Titular" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>ID Marca</label>
                                        <input type="text" name="idMarcaProd_A" class="form-control" placeholder="Titular" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 pad-adjust">
                                        <label>Nombre del producto</label>
                                        <input type="text" name="nombreProducto_A" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                        <label>Unidades</label>
                                        <input type="text" name="unidadesProducto_A" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                        <label>Precio</label>
                                        <input type="text" name="precioProducto_A" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Descripción</label>
                                        <input type="text" name="descripcionProducto_A" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <input type="reset" name="limpiar" class="btn btn-info" value="Limpiar" />
                                        <input type='submit' name='anadir' class='btn btn-primary' value='Añadir' />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div id="divModificaProducto" class="tarjeta-div" style="display: <?php echo $disp; ?>;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                            if (isset($productoAModificar)) {
                                $row = $productoAModificar->fetch();
                                while ($row != null) {
                            ?>
                                    <h4>MODIFICAR PRODUCTO <?php echo $row["id_producto"]; ?></h4>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label>ID Categoria</label>
                                                <input type="hidden" name="idProducto_M" class="form-control" placeholder="" value="<?php echo $row["id_producto"]; ?>" />
                                                <input type="text" name="idCategoriaProd_M" class="form-control" placeholder="" value="<?php echo $row["id_categoria"]; ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label>ID Marca</label>
                                                <input type="text" name="idMarcaProd_M" class="form-control" placeholder="" value="<?php echo $row["id_marca"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-8 pad-adjust">
                                                <label>Nombre del producto</label>
                                                <input type="text" name="nombreProducto_M" class="form-control" value="<?php echo $row["nombre"]; ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                                <label>Unidades</label>
                                                <input type="text" name="unidadesProducto_M" class="form-control" value="<?php echo $row["unidades"]; ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                                <label>Precio</label>
                                                <input type="text" name="precioProducto_M" class="form-control" value="<?php echo $row["precio"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Descripción</label>
                                                <input type="text" name="descripcionProducto_M" class="form-control" value="<?php echo $row["descripcion"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <input type="reset" name="limpiar" class="btn btn-info" value="Limpiar" />
                                                <input type='submit' name='actualizar' class='btn btn-primary' value='Modificar' />
                                            </div>
                                        </div>
                                <?php
                                    $row = $productoAModificar->fetch();
                                }
                            }
                                ?>
                                    </form>
                        </div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust" id="tablaMuestraProductos" style="display:none;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID Producto</th>
                                    <th scope="col">ID Categoria</th>
                                    <th scope="col">ID Marca</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Unidades</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col"></th>
                                    <!-- <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $productosObtenidos = BD::listarProductos();
                                if (isset($productosObtenidos)) {
                                    $row = $productosObtenidos->fetch();
                                    while ($row != null) {
                                ?>
                                        <tr>
                                            <td><?php echo $row["id_producto"]; ?></td>
                                            <td><?php echo $row["id_categoria"]; ?></td>
                                            <td><?php echo $row["id_marca"]; ?></td>
                                            <td><?php echo $row["nombre"]; ?></td>
                                            <td><?php echo $row["unidades"]; ?></td>
                                            <td><?php echo $row["precio"]; ?></td>
                                            <td><?php echo $row["descripcion"]; ?></td>
                                            <!-- <td><?php //echo $row["valoracion_media"]; 
                                                        ?></td> -->
                                            <td>
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="idProducto" value="<?php echo $row['id_producto'] ?>">
                                                    <input type="submit" id="modificar" name="modificar" value="Modificar">
                                                </form>
                                            <!-- </td> -->
                                            <!-- <td> -->
                                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="idProducto" value="<?php echo $row['id_producto'] ?>">
                                                    <input type="submit" id="eliminar" name="eliminar" value="Eliminar">

                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                        $row = $productosObtenidos->fetch();
                                    }
                                }
                                ?>
                            <tbody>
                        </table>
                    </div>

            </div>
        </div>
    </section>
    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>