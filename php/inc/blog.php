<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Blog princiopal'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="index.php"> Inicio </a></li>
                        <li class="active">Blog</li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default blog">
                    <div class="panel-body">
                        <h1 class="izquierda">Blog PhotoLazo</h1>
                        <h4 class="izquierda azul">Entradas más recientes</h4>
                        <hr>
                        <div class="row">
                            <?php $entradas = BD::ultimasEntradas(); ?>
                            <?php BD::muestraUltimasEntradas($entradas); ?>
                        </div>
                        <a href="productos.php"><input type="button" value="Productos" class="btn btn-primary btn-lg"></a>
                        <a href="cursos.php"><input type="button" value="Cursos" class="btn btn-primary btn-lg" ></a>
                    </div>
                </div>
            </div>

            <div class="iconos col-xs-12 col-sm-12 col-md-12">
                <h4>Siguinos en nuestras redes sociales</h4>
                <ul class="iconos-social-top">
                    <li>
                        <a id='' href='https://www.youtube.com/'><img src='../../imagenes/imgMaquetacion/youtube.png' alt=''></a>
                    </li>
                    <li>
                        <a id='' href='https://www.facebook.com/'><img src='../../imagenes/imgMaquetacion/facebook.png' alt=''></a>
                    </li>
                    <li>
                        <a id='' href='https://twitter.com/'><img src='../../imagenes/imgMaquetacion/twitter.png' alt=''></a>
                    </li>
                    <li>
                        <a id='' href='https://www.instagram.com/'><img src='../../imagenes/imgMaquetacion/instagram.png' alt=''></a>
                    </li>
                </ul>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default blog">
                    <div class="panel-body">
                        <h4 class="izquierda azul">Más entradas</h4>
                        <hr>
                        <div class="row">
                            <?php $entradas = BD::todasLasEntradas(); ?>
                            <?php BD::muestraTodasLasEntradas($entradas); ?>
                        </div>
                        <a href="recursos.php" ><input type="button" value="Material gratis" class="btn btn-primary btn-lg" ></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>