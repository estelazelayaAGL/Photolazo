<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Administración'; ?>
    <?php include("../mod/header.php")  ?>

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

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container seccion ">


            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>Panel de administración</h1>
                <hr>
                <fieldset>
                    <legend>Gestión productos</legend>
                    <input type="button" value="Añadir producto" />
                    <input type="button" value="Modificar producto" />
                    <input type="button" value="Eliminar producto" />
                </fieldset>

                <fieldset>
                    <legend>Gestión cursos</legend>
                    <input type="button" value="Añadir curso" />
                    <input type="button" value="Modificar curso" />
                    <input type="button" value="Eliminar curso" />
                </fieldset>

            </div>

        </div>
    </section>

    <?php include("../mod/footer.php")  ?>
</body>

</html>