<!DOCTYPE html>
<html lang="en">

<body>
    <script src="../../js/administracionCursos.js"></script>
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
        $id_curso = $_POST['id_curso'];
        $id_categoria = $_POST['id_categoria'];
        $lema = $_POST['lema'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $nivel = $_POST['nivel'];
        $resumen = $_POST['resumen'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $video_promocional = $_POST['video_promocional'];

        $mensaje = BD::insertarCurso($id_curso, $id_categoria, $lema, $titulo, $autor, $nivel, $resumen, $descripcion, $precio, $video_promocional);
    }

    if (isset($_POST['actualizar'])) {
        $idCurso_M = $_POST['id_curso_M'];
        $idCategoria_M = $_POST['id_categoria_M'];
        $lema_M = $_POST['lema_M'];
        $titulo_M = $_POST['titulo_M'];
        $autor_M = $_POST['autor_M'];
        $nivel_M = $_POST['nivel_M'];
        $resumen_M = $_POST['resumen_M'];
        $descripcion_M = $_POST['descripcion_M'];
        $precio_M = $_POST['precio_M'];
        $videoPromocional_M = $_POST['video_promocional_M'];

        $mensaje = BD::actualizarCurso($idCurso_M, $idCategoria_M, $lema_M, $titulo_M, $autor_M, $nivel_M, $resumen_M, $descripcion_M, $precio_M, $videoPromocional_M);
    }

    if (isset($_POST['modificar'])) {
        $disp = "block";
        $idCurso_M = $_POST['id_curso'];
        echo $idCurso_M;

        $cursoAModificar = BD::extraeCursoCod($idCurso_M);
    } else {
        $disp = "none";
    }

    
    if (isset($_POST['eliminar'])) {
        $idCurso = $_POST['id_curso'];
        $mensaje = BD::eliminarCurso($idCurso);
    }
    ?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">


            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Gestión de los cursos</h1>
                <hr>
                <div><?php
                        if (isset($mensaje)) {
                            echo $mensaje;
                        }
                        ?>
                </div>
                <fieldset>
                    <legend>Gestión de cursos</legend>
                    <input type="button" name="anadeCurso" id="anadeCurso" value="Añadir nuevo curso" />
                    <!-- <a href="datosproducto.php"> -->
                    <input type="button" name="obtieneLista" id="obtieneLista" value="Mostrar lista de cursos" />
                    <!-- </a> -->
                </fieldset>


                <div id="divAnadeCurso" class="tarjeta-div" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <h4>AÑADIR NUEVO CURSO</h4>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>ID CURSO</label>
                                        <input type="text" name="id_curso" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label> ID Categoria</label>
                                        <input type="text" name="id_categoria" class="form-control" placeholder="Titular" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                        <label>Precio</label>
                                        <input type="number" name="precio" class="form-control" placeholder="Titular" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Lema</label>
                                        <input type="text" name="lema" class="form-control" placeholder="Titular" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Titulo</label>
                                        <input type="text" name="titulo" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                        <label>Nivel</label>
                                        <input type="text" name="nivel" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                        <label>Autor</label>
                                        <input type="text" name="autor" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Resumen</label>
                                        <input type="text" name="resumen" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Descripcion</label>
                                        <input type="text" name="descripcion" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                        <label>Titulo con el que se ha guardado el video promocional</label>
                                        <input type="text" name="video_promocional" class="form-control" />
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


                <div id="divModificaCurso" class="tarjeta-div" style="display: <?php echo $disp; ?>;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                            if (isset($cursoAModificar)) {
                                $row = $cursoAModificar->fetch();
                                while ($row != null) {
                            ?>
                                    <h4>MODIFICAR CURSO <?php echo $row["id_curso"]; ?></h4>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label>ID CURSO</label>
                                                <input type="text" name="id_curso_M" class="form-control" value="<?php echo $row['id_curso']; ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label> ID Categoria</label>
                                                <input type="text" name="id_categoria_M" class="form-control" placeholder="" value="<?php echo $row['id_categoria']; ?>"/>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 pad-adjust">
                                                <label>Precio</label>
                                                <input type="number" name="precio_M" class="form-control" placeholder="" value="<?php echo $row['precio']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Lema</label>
                                                <input type="text" name="lema_M" class="form-control" placeholder="" value="<?php echo $row['lema']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Titulo</label>
                                                <input type="text" name="titulo_M" class="form-control" value="<?php echo $row['titulo']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                <label>Nivel</label>
                                                <input type="text" name="nivel_M" class="form-control" value="<?php echo $row['nivel']; ?>"/>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 pad-adjust">
                                                <label>Autor</label>
                                                <input type="text" name="autor_M" class="form-control" value="<?php echo $row['autor']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Resumen</label>
                                                <input type="text" name="resumen_M" class="form-control" value="<?php echo $row['resumen']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Descripcion</label>
                                                <input type="text" name="descripcion_M" class="form-control" value="<?php echo $row['descripcion']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <label>Titulo con el que se ha guardado el video promocional</label>
                                                <input type="text" name="video_promocional_M" class="form-control"  value="<?php echo $row['video_promocional']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12 pad-adjust">
                                                <input type="reset" name="limpiar" class="btn btn-info" value="Limpiar" />
                                                <input type='submit' name='actualizar' class='btn btn-primary' value='Modificar' />
                                            </div>
                                        </div>
                                <?php
                                    $row = $cursoAModificar->fetch();
                                }
                            }
                                ?>
                                    </form>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 pad-adjust" id="tablaMuestraCursos" style="display:none;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Curso</th>
                                <th scope="col">ID Categoria</th>
                                <!-- <th scope="col">Lema</th> -->
                                <th scope="col">Titulo</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Nivel</th>
                                <!-- <th scope="col">Resumen</th> -->
                                <th scope="col">Precio</th>
                                <!-- <th scope="col">Descripción</th> -->
                                <!-- <th scope="col">Video</th> -->
                                <th scope="col"></th>
                                <!-- <th scope="col"></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cursosObtenidos = BD::listarCursos();
                            if (isset($cursosObtenidos)) {
                                $row = $cursosObtenidos->fetch();
                                while ($row != null) {
                            ?>
                                    <tr>
                                        <td><?php echo $row["id_curso"]; ?></td>
                                        <td><?php echo $row["id_categoria"]; ?></td>
                                        <!-- <td><?php //echo $row["lema"]; ?></td> -->
                                        <td><?php echo $row["titulo"]; ?></td>
                                        <td><?php echo $row["autor"]; ?></td>
                                        <td><?php echo $row["nivel"]; ?></td>
                                        <!-- <td><?php // echo $row["resumen"]; ?></td> -->
                                        <!-- <td><?php //echo $row["descripcion"]; ?></td> -->
                                        <td><?php echo $row["precio"]; ?></td>
                                        <!-- <td><?php //echo $row["video_promocional"]; ?></td> -->
                                        <!-- <td><?php //echo $row["valoracion_media"]; 
                                                    ?></td> -->
                                        <td>
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="id_curso" value="<?php echo $row['id_curso'] ?>">
                                                <input type="submit" id="modificar" name="modificar" value="Modificar">
                                            </form>
                                            <!-- </td> -->
                                            <!-- <td> -->
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="id_curso" value="<?php echo $row['id_curso'] ?>">
                                                <input type="submit" id="eliminar" name="eliminar" value="Eliminar">

                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                    $row = $cursosObtenidos->fetch();
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