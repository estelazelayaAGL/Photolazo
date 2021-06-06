<!DOCTYPE html>
<html lang="en">


<body>
    <script src="../../js/borrado.js"></script>
    <?php $titulo = 'Datos del producto'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>

    <?php
    if (isset($_POST['obtener'])) {
        // if ($_POST['codigo_O']) {
        //     $codigoO = $_POST['codigo_O'];
        //     $productosObtenidos = BD::extraeProductosCod($codigoO);
        // }

        // if ($_POST['nombre_O']) {
        //     $nombreO = $_POST['nombre_O'];
        //     $productosObtenidos = BD::extraeProductosNm($nombreO);
        // }

        // if ($_POST['listar']) {
        // $idProducto = $_POST['idProducto'];
        // }

    }

    if (isset($_POST['eliminar'])) {
        $idProducto = $_POST['idProducto'];
        $mensaje = BD::eliminarProducto($idProducto);
    }
    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">


            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Datos del producto</h1>
                <hr>
                <a href="administracionProductos.php"><input type="button" name="regresar" id="regresar" value="Regresar" /></a>
            </div>
            <div><?php
                    if (isset($mensaje)) {
                        echo $mensaje;
                    }
                    ?>
            </div>

            <div class="row" id="tablaMuestraProductos" style="display:block;">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Producto</th>
                                <th>ID Categoria</th>
                                <th>ID Marca</th>
                                <th>Nombre</th>
                                <th>Unidades</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                                <th></th>
                                <th></th>
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
                                        <!-- <td><?php //echo $row["valoracion_media"]; ?></td> -->
                                        <td>
                                            <form method="POST" action="administracion.php">
                                                <input type="hidden" name="idProducto" value="<?php echo $row['id_producto'] ?>">
                                                <input type="submit" id="modificar" name="modificar" value="Modificar"></form>
                                        </td>
                                        <td>
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