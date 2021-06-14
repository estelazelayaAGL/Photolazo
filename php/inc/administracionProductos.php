<!DOCTYPE html>
<html lang="en">

<body>
    <script src="../../js/administracionProductos.js"></script>
    <?php $titulo = 'Administración'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php"> Inicio </a></li>
                <li><a href="panelDeAdministracion.php"> Administración </a></li>
                <li class="active">Gestión de productos</li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>

    <!-- Impide el acceso a esta página a menos que se haya iniciado sesión como usuario administrador (campo tipo_usuario = 1) -->
    <?php
    if (isset($_SESSION['usuario'])) {
        $usuario = BD::obtieneUsuario($_SESSION['usuario']);
        if ($usuario->getTipo_usuario() == 0) {
            header("Location:../../index.php");
        }
    } else {
        header("Location:../../index.php");
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

        $tamano = $_FILES["imagenProducto"]['size'];
        $tipo = $_FILES["imagenProducto"]['type'];
        $archivo = $_FILES["imagenProducto"]['name'];

        $status = "";
        if (!empty($archivo)) {
            if (!BD::checkExtension($archivo))
                $status = "tipo incorrecto";
            else {
                if ($tamano > 10000000000) {                  // ---------- tamaño en bytes --------------------------------
                    $status = "ERROR, demasiado grande";
                } else {
                    // guardamos el archivo a la carpeta física creada
                    $destino = "../../imagenes/imgObjetivas/productos/" . $idProductoA . ".png";
                    if (move_uploaded_file($_FILES['imagenProducto']['tmp_name'], $destino)) {
                        $status = "Archivo subido: <b>" . $archivo . "</b>";
                    } else {
                        $status = "Error al subir el archivo";
                    }
                }
            }
        } else {
            $status = "Error falta fichero";
        }

        // echo $status . "<br>";

        if ($status == ("Archivo subido: <b>" . $archivo . "</b>")) {
            $mensaje = BD::insertarProducto($idProductoA, $idCategoriaA, $idMarcaA, $nombreA, $unidadesA, $precioA, $descripcionA);
        } else {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>La imagen no se ha procesado correctamente</div>";
        }
    }

    if (isset($_POST['actualizar'])) {
        $idProductoM = $_POST['idProducto_M'];
        $idCategoriaM = $_POST['idCategoriaProd_M'];
        $idMarcaM = $_POST['idMarcaProd_M'];
        $nombreM = $_POST['nombreProducto_M'];
        $unidadesM = $_POST['unidadesProducto_M'];
        $precioM = $_POST['precioProducto_M'];
        $descripcionM = $_POST['descripcionProducto_M'];

        if ($_FILES["imagenProducto"]['size'] > 0) {
            $tamano = $_FILES["imagenProducto"]['size'];
            $tipo = $_FILES["imagenProducto"]['type'];
            $archivo = $_FILES["imagenProducto"]['name'];

            $status = "";
            if (!empty($archivo)) {
                if (!BD::checkExtension($archivo))
                    $status = "Tipo incorrecto";
                else {
                    if ($tamano > 10000000) {                  // ---------- tamaño en bytes --------------------------------
                        $status = "ERROR, demasiado grande";
                    } else {
                        // guardamos el archivo a la carpeta física creada
                        $destino = "../../imagenes/imgObjetivas/productos/" . $idProductoM . ".png";
                        if (move_uploaded_file($_FILES['imagenProducto']['tmp_name'], $destino)) {
                            $status = "Archivo subido: <b>" . $archivo . "</b>";
                        } else {
                            $status = "Error al subir el archivo";
                        }
                    }
                }
            } else {
                $status = "Error falta fichero";
            }
        }

        if ($_FILES["imagenProducto"]['size'] > 0) {
            if ($status == ("Archivo subido: <b>" . $archivo . "</b>")) {
                $mensaje = BD::actualizarProducto($idProductoM, $idCategoriaM, $idMarcaM, $nombreM, $unidadesM, $precioM, $descripcionM);
            } else {
                $mensaje = "La imagen no se ha procesado correctamente";
            }
        } else {
            $mensaje = BD::actualizarProducto($idProductoM, $idCategoriaM, $idMarcaM, $nombreM, $unidadesM, $precioM, $descripcionM);
        }
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

    // ESTRAE LAS CATEFGORIAS DE PRODUCTO Y CURSO
    $categorias = BD::categoriasProductoCurso();
    $marcas = BD::marcasProductoCurso();

    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">
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
                    <input type="button" name="anadeProducto" id="anadeProducto" value="Añadir producto" class="btn btn-primary btn-lg" />
                    <input type="button" name="obtieneLista" id="obtieneLista" value="Mostrar lista de productos" class="btn btn-primary btn-lg " />
                </fieldset>

                <div id="divAnadeProducto" class="tarjeta-div col-xs-12 col-sm-12 col-md-12" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>AÑADIR NUEVO PRODUCTO</h4>
                            <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>ID Producto</label>
                                        <input type="text" name="idProducto_A" class="form-control" required />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>Categoría</label>
                                        <!-- <input type="text" name="idCategoriaProd_A" class="form-control" placeholder="" required />
                                     -->
                                        <select name="idCategoriaProd_A" id="idCategoriaProd_A" required>
                                            <?php foreach ($categorias as $categoria) {
                                                echo  "<option value=" . $categoria['id_categoria'] . ">" . $categoria['nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>Marca</label>
                                        <!-- <input type="text" name="idMarcaProd_A" class="form-control" placeholder="" required /> -->
                                        <select name="idMarcaProd_A" id="idMarcaProd_A" required>
                                            <?php foreach ($marcas as $marca) {
                                                echo  "<option value=" . $marca['id_marca'] . ">" . $marca['nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 pad-adjust">
                                        <label>Nombre del producto</label>
                                        <input type="text" name="nombreProducto_A" class="form-control" required />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                        <label>Unidades</label>
                                        <input type="text" name="unidadesProducto_A" class="form-control" required />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                        <label>Precio</label>
                                        <input type="text" name="precioProducto_A" class="form-control" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Descripción</label>
                                        <input type="text" name="descripcionProducto_A" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Imagen del producto</label>
                                        <input type="file" name="imagenProducto" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <input type="reset" name="limpiar" class="btn btn-primary btn-lg gris" value="Limpiar" />
                                        <input type='submit' name='anadir' class='btn btn-primary btn-lg' value='Añadir' />
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
                                    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
                                        <input type="hidden" name="idProducto_M" class="form-control" placeholder="" value="<?php echo $row['id_producto']; ?>" />
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label>Categoría</label>
                                                <select name="idCategoriaProd_M" id="idCategoriaProd_M" required>
                                                    <?php
                                                    $categorias = BD::categoriasProductoCurso();
                                                    foreach ($categorias as $categoria) {
                                                        echo $categoria['nombre'];
                                                        if ($categoria['id_categoria'] == $row['id_categoria']) {
                                                            echo  "<option selected value=" . $categoria['id_categoria'] . ">" . $categoria['nombre'] . "</option>";
                                                        } else {
                                                            echo  "<option value=" . $categoria['id_categoria'] . ">" . $categoria['nombre'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label>Marca</label>
                                                <!-- <input type="text" name="idMarcaProd_M" class="form-control" placeholder="" value="<?php //echo $row["id_marca"]; 
                                                                                                                                        ?>" required /> -->
                                                <select name="idMarcaProd_M" id="idMarcaProd_M" required>
                                                    <?php
                                                    $marcas = BD::marcasProductoCurso();
                                                    foreach ($marcas as $marca) {
                                                        if ($marca['id_marca'] == $row['id_marca']) {
                                                            echo  "<option selected value=" . $marca['id_marca'] . ">" . $marca['nombre'] . "</option>";
                                                        } else {
                                                            echo  "<option value=" . $marca['id_marca'] . ">" . $marca['nombre'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-8 pad-adjust">
                                                <label>Nombre del producto</label>
                                                <input type="text" name="nombreProducto_M" class="form-control" value="<?php echo $row['nombre']; ?>" required />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                                <label>Unidades</label>
                                                <input type="text" name="unidadesProducto_M" class="form-control" value="<?php echo $row['unidades']; ?>" required />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-2 pad-adjust">
                                                <label>Precio</label>
                                                <input type="text" name="precioProducto_M" class="form-control" value="<?php echo $row['precio']; ?>" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Descripción</label>
                                                <input type="text" name="descripcionProducto_M" class="form-control" value="<?php echo $row['descripcion']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Imagen</label>
                                                <input type="file" name="imagenProducto" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <input type="reset" name="limpiar" class="btn btn-primary btn-lg gris" value="Limpiar" />
                                                <input type='submit' name='actualizar' class='btn btn-primary btn-lg' value='Modificar' />
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

                <div class="col-xs-10 col-sm-12 col-md-12 pad-adjust" id="tablaMuestraProductos" style="display:none;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Producto</th>
                                <th scope="col">Nombre</th>
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
                                    <tr scope="row">
                                        <td><?php echo $row["id_producto"]; ?></td>
                                        <td><?php echo $row["nombre"]; ?></td>
                                        <td><?php echo $row["precio"]; ?></td>
                                        <td><?php echo $row["descripcion"]; ?></td>
                                        <td>
                                            <div class="espacio">
                                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="idProducto" value="<?php echo $row['id_producto'] ?>">
                                                    <input type="submit" id="modificar" name="modificar" value="Modificar" class="btn btn-primary btn-lg">
                                                </form>
                                            </div>
                                            <!-- </td> -->
                                            <!-- <td> -->
                                            <div>
                                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="idProducto" value="<?php echo $row['id_producto'] ?>">
                                                    <input type="submit" id="eliminar" name="eliminar" value="Eliminar" class="btn btn-primary btn-lg gris">
                                                </form>
                                            </div>
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