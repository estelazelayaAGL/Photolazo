<!DOCTYPE html>
<html lang="en">

<body>
    <script src="../../js/administracionBlog.js"></script>
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
        $id_categoria = $_POST['id_categoria'];
        $autor = $_POST['autor'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $fecha_publicacion = $_POST['fecha_publicacion'];

        $tamano = $_FILES["imagenEntrada"]['size'];
        $tipo = $_FILES["imagenEntrada"]['type'];
        $archivo = $_FILES["imagenEntrada"]['name'];

        $status = "";
        if (!empty($archivo)) {
            if (!BD::checkExtension($archivo))
                $status = "Tipo incorrecto";
            else {
                if ($tamano > 10000000000) {                  // ---------- tamaño en bytes --------------------------------
                    $status = "ERROR, demasiado grande";
                } else {
                    // guardamos el archivo a la carpeta física creada
                    $destino = "../../imagenes/imgObjetivas/entradas/" . $titulo . ".png";
                    if (move_uploaded_file($_FILES['imagenEntrada']['tmp_name'], $destino)) {
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
            $mensaje = BD::insertarEntrada($id_categoria, $autor, $titulo, $contenido, $fecha_publicacion);
        } else {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>La imagen no se ha procesado correctamente</div>";
        }
    }

    if (isset($_POST['actualizar'])) {
        $id_entradaM = $_POST['id_entrada_M'];
        $id_categoriaM = $_POST['id_categoria_M'];
        $autorM = $_POST['autor_M'];
        $tituloM = $_POST['titulo_M'];
        $contenidoM = $_POST['contenido_M'];
        $fecha_publicacionM = $_POST['fecha_publicacion_M'];

        if ($_FILES["imagenEntrada"]['size'] > 0) {
            $tamano = $_FILES["imagenEntrada"]['size'];
            $tipo = $_FILES["imagenEntrada"]['type'];
            $archivo = $_FILES["imagenEntrada"]['name'];

            $status = "";
            if (!empty($archivo)) {
                if (!BD::checkExtension($archivo))
                    $status = "Tipo incorrecto";
                else {
                    if ($tamano > 10000000) {                  // ---------- tamaño en bytes --------------------------------
                        $status = "ERROR, demasiado grande";
                    } else {
                        // guardamos el archivo a la carpeta física creada
                        $destino = "../../imagenes/imgObjetivas/entradas/" . $tituloM . ".png";
                        if (move_uploaded_file($_FILES['imagenEntrada']['tmp_name'], $destino)) {
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

        if ($_FILES["imagenEntrada"]['size'] > 0) {
            if ($status == ("Archivo subido: <b>" . $archivo . "</b>")) {
                $mensaje = BD::actualizarEntrada($id_entradaM, $id_categoriaM, $autorM, $tituloM, $contenidoM, $fecha_publicacionM);
            } else {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>La imagen no se ha procesado correctamente</div>";
            }
        } else {
            $mensaje = BD::actualizarEntrada($id_entradaM, $id_categoriaM, $autorM, $tituloM, $contenidoM, $fecha_publicacionM);
        }
    }

    if (isset($_POST['modificar'])) {
        $disp = "block";
        $idBlog_M = $_POST['id_blog'];
        $entradaAModificar = BD::extraeEntradaCod($idBlog_M);
    } else {
        $disp = "none";
    }


    if (isset($_POST['eliminar'])) {
        $idBlog = $_POST['id_blog'];
        $mensaje = BD::eliminarEntrada($idBlog);
    }
    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php"> Inicio </a></li>
                        <li><a href="panelDeadministracion.php"> Administración </a></li>
                        <li class="active">Gestión de Blog</li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Gestión del Blog</h1>
                <hr>
                <div><?php
                        if (isset($mensaje)) {
                            echo $mensaje;
                        }
                        ?>
                </div>
                <fieldset>
                    <legend>Gestión de Blog</legend>
                    <input type="button" name="anadeEntrada" id="anadeEntrada" value="Añadir nueva entrada" class="btn btn-primary btn-lg" />
                    <input type="button" name="obtieneLista" id="obtieneLista" value="Mostrar lista de Entradas" class="btn btn-primary btn-lg" />
                </fieldset>
                <div id="divAnadeEntrada" class="tarjeta-div" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>AÑADIR NUEVA ENTRADA</h4>
                            <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                        <label> ID Categoria</label>
                                        <input type="text" name="id_categoria" class="form-control" placeholder="" required />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                        <label>Autor</label>
                                        <input type="text" name="autor" class="form-control" placeholder="" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Titulo</label>
                                        <input type="text" name="titulo" class="form-control" placeholder="" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Contenido</label>
                                        <textarea name="contenido" class="form-control" rows="10" cols="20" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                        <label>Fecha de publicación</label>
                                        <input type="date" name="fecha_publicacion" class="form-control" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Imagen de la entrada</label>
                                        <input type="file" name="imagenEntrada" required />
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

                <div id="divModificaEntrada" class="tarjeta-div" style="display: <?php echo $disp; ?>;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                            if (isset($entradaAModificar)) {
                                $row = $entradaAModificar->fetch();
                                while ($row != null) {
                            ?>
                                    <h4>MODIFICAR ENTRADA <?php echo $row["id_blog"]; ?></h4>
                                    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                <label> ID Categoria</label>
                                                <input type="hidden" name="id_entrada_M" class="form-control" value="<?php echo $row['id_blog']; ?>" required />
                                                <input type="text" name="id_categoria_M" class="form-control" placeholder="" value="<?php echo $row['id_categoriaB']; ?>" required />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                <label>Autor</label>
                                                <input type="text" name="autor_M" class="form-control" placeholder="" value="<?php echo $row['autor']; ?>" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Titulo</label>
                                                <input type="text" name="titulo_M" class="form-control" placeholder="" value="<?php echo $row['titulo']; ?>" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Contenido</label>
                                                <textarea name="contenido_M" class="form-control" rows="10" cols="20" required><?php echo $row['contenido']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                <label>Fecha de publicacion</label>
                                                <input type="date" name="fecha_publicacion_M" class="form-control" value="<?php echo $row['fecha_publicacion']; ?>" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Imagen de la entrada</label>
                                                <input type="file" name="imagenEntrada" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <input type="reset" name="limpiar" class="btn btn-primary btn-lg gris" value="Limpiar" />
                                                <input type='submit' name='actualizar' class='btn btn-primary btn-lg' value='Modificar' />
                                            </div>
                                        </div>
                                <?php
                                    $row = $entradaAModificar->fetch();
                                }
                            }
                                ?>
                                    </form>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust" id="tablaMuestraEntradas" style="display:none;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Entrada</th>
                                <th scope="col">ID Categoria</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Contenido</th>
                                <th scope="col">Fecha de publicación</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $entradasObtenidas = BD::listarEntradas();
                            if (isset($entradasObtenidas)) {
                                $row = $entradasObtenidas->fetch();
                                while ($row != null) {
                            ?>
                                    <tr>
                                        <td><?php echo $row["id_blog"]; ?></td>
                                        <td><?php echo $row["id_categoriaB"]; ?></td>
                                        <td><?php echo $row["autor"]; ?></td>
                                        <td><?php echo $row["titulo"]; ?></td>
                                        <td><?php echo $row["contenido"]; ?></td>
                                        <td><?php echo $row["fecha_publicacion"]; ?></td>
                                        <td>
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="id_blog" value="<?php echo $row['id_blog'] ?>">
                                                <input type="submit" id="modificar" name="modificar" value="Modificar" class="btn btn-primary btn-lg">
                                            </form>
                                            <!-- </td> -->
                                            <!-- <td> -->
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="id_blog" value="<?php echo $row['id_blog'] ?>">
                                                <input type="submit" id="eliminar" name="eliminar" value="Eliminar" class="btn btn-primary btn-lg gris">

                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                    $row = $entradasObtenidas->fetch();
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