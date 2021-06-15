<?php
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="imagenes/imgMaquetacion/favicon.png" />

    <title><?php echo $titulo;
            session_start(); ?></title>
    <!-- CSS PROPIO -->
    <link rel="stylesheet" href="css/estilos.css">


    <!-- JAVASCRIP PROPIO -->
    <script src="js/cookies.js"></script>
    <script src="js/validaFormularios.js"></script>

    <!-- BOOTSTRAP  -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <!-- PARA TABLAS DE ADMINISTRACION -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- BORRAR -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<?php include("php/mod/accesoDatos/conexion.php")  ?>
<?php include("php/mod/accesoDatos/BD2.php")  ?>
<?php //include("php/mod/accesoDatos/funciones.php")  ?>

<!-- SECCION CABECERA -->
<header class="container-fluid">
    <div class="container menu">
        <!--Crea un barra top. Introduce el tlf, email a la izquierda e iconos sociales a la derecha(barra encima del menú, oculta para movil -->
        <nav class="navbar top row topBarra">
            <div class="topBarradiv col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="iconos-social-top">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                        echo "<li>
                        <a id='registrarse' href='#'>Bienvenido/a, " . $_SESSION['usuario'] . "<img src='imagenes/imgMaquetacion/createaccount.png' alt=''></a>
                    </li>
                    <li>
                        <a id='login' href='php/inc/logout.php'>Salir<img src='imagenes/imgMaquetacion/login.png' alt=''></a>
                    </li>
                    <li>
                        <a id='cesta' href='php/inc/cesta.php'>Cesta<img src='imagenes/imgMaquetacion/cesta.png' alt=''></a>
                    </li>";
                        $usuario = BD2::obtieneUsuario($_SESSION['usuario']);
                        if ($usuario->getTipo_usuario() == 1) {
                            echo "<li>
                                <a id='administracion' href='php/inc/panelDeAdministracion.php'>Administración<img src='imagenes/imgMaquetacion/createaccount.png' alt=''></a>
                            </li>";
                        }
                    } else {
                    ?>
                        <li>
                            <a id="registrarse" href="php/inc/registro.php">Registrarse<img src="imagenes/imgMaquetacion/createaccount.png" alt=""></a>
                        </li>
                        <li>
                            <a id="login" href="php/inc/login.php">Entrar<img src="imagenes/imgMaquetacion/login.png" alt=""></a>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="row cabeceraBlanca">
            <nav class="navbar navbar-expand-md  navbar-light col-xs-12 col-sm-12 col-md-12 ">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"><a class="" href="index.php">
                        <img src="imagenes/imgMaquetacion/logo.png" alt="Logo" class="img-fluid">
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-xs-2 col-sm-12 col-md-4 col-lg-4 espacio">
                    <form action="php/inc/busqueda.php" method="post" id="buscarform" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Buscar">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-md  col-xs-12 col-sm-12 col-md-12 sinPad">
                <div class="collapse navbar-collapse barratema" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio <img src="imagenes/imgMaquetacion/inicio.png" alt=""></a>
                        </li>
                        <li class=" nav-item dropdown"><a class="nav-link " href="php/inc/productos.php">Productos <img src="imagenes/imgMaquetacion/producto.png" alt=""></a>

                            <ul class="dropdown-menu">
                                <li><a href="php/inc/camaras.php">Cámaras</a></li>
                                <li><a href="php/inc/objetivos.php">Objetivos</a></li>
                                <li><a href="php/inc/iluminacion.php">Iluminación</a></li>
                                <li><a href="php/inc/libros.php">Libros</a></li>
                                <li><a href="php/inc/mochilas.php">Mochilas</a></li>
                                <li><a href="php/inc/accesorios.php">Otros accesorios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/inc/cursos.php">Cursos <img src="imagenes/imgMaquetacion/cursos.png" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/inc/entradas.php">Blog <img src="imagenes/imgMaquetacion/blog.png" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/inc/recursos.php">Recursos <img src="imagenes/imgMaquetacion/recursos.png" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/inc/contacto.php">Contacto <img src="imagenes/imgMaquetacion/contacto.png" alt=""></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Slider - Carrusel-->
            <div class="container sinPad" id="titulo" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12" id="slider">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" id="item-1">
                                <div class="item active">
                                    <img src="imagenes/imgMaquetacion/banner1.png" alt="" style="width:100%;">
                                </div>

                                <div class="item" id="item-2">
                                    <img src="imagenes/imgMaquetacion/banner2.PNG" alt="" style="width:100%;">
                                    <div class="carousel-caption">
                                    </div>
                                </div>

                                <div class="item" id="item-3">
                                    <img src="imagenes/imgMaquetacion/banner3.png" alt="" style="width:100%;">
                                    <div class="carousel-caption">
                                    </div>
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
            </div>
            <nav class="navbar navbar-expand-md col-xs-12 col-sm-12 col-md-12 sinPad">