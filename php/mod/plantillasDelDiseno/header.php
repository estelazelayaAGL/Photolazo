<?php
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $titulo;
            session_start(); ?></title>
    <!-- CSS PROPIO -->
    <link rel="stylesheet" href="../../css/estilos.css">

    <!-- JAVASCRIP PROPIO -->
    <script src="../../js/cookies.js"></script>
    <script src="../../js/validaFormularios.js"></script>

    <!-- BOOTSTRAP  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- PARA TABLAS DE ADMINISTRACION -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Versión compilada y minimizada del CSS de Bootstrap -->
    <link rel="stylesheet" href="../../../css/bootstrap/css/bootstrap.min.css">
</head>

<?php include("../mod/accesoDatos/conexion.php")  ?>
<?php include("../mod/accesoDatos/BD.php")  ?>

<!-- SECCION CABECERA -->
<header class="container-fluid">
    <div class="container menu">
        <!--Crea un barra top. Introduce el tlf, email a la izquierda e iconos sociales a la derecha(barra encima del menú, oculta para movil -->
        <nav class="navbar top row topBarra ">
            <div class="topBarradiv col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="iconos-social-top">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                        echo "<li>
                        <a id='registrarse' href='#'>Bienvenido/a, " . $_SESSION['usuario'] . "<img src='../../imagenes/imgMaquetacion/createaccount.png' alt=''></a>
                    </li>
                    <li>
                        <a id='login' href='logout.php'>Salir<img src='../../imagenes/imgMaquetacion/login.png' alt=''></a>
                    </li>
                    <li>
                        <a id='cesta' href='cesta.php'>Cesta<img src='../../imagenes/imgMaquetacion/cesta.png' alt=''></a>
                    </li>";
                        $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                        if ($usuario->getTipo_usuario() == 1) {
                            echo "<li>
                                <a id='administracion' href='panelDeAdministracion.php'>Administración<img src='../../imagenes/imgMaquetacion/createaccount.png' alt=''></a>
                            </li>";
                        }
                    } else {
                    ?>
                        <li>
                            <a id="registrarse" href="registro.php">Registrarse<img src="../../imagenes/imgMaquetacion/createaccount.png" alt=""></a>
                        </li>
                        <li>
                            <a id="login" href="login.php">Entrar<img src="../../imagenes/imgMaquetacion/login.png" alt=""></a>
                        </li>
                        <!-- <li>
                        <a id='cesta' href='../inc/cesta.php'>Cesta<img src='../../imagenes/imgMaquetacion/cesta.png' alt=''></a>
                    </li> -->

                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="row cabeceraBlanca">
            <nav class="navbar navbar-expand-md  navbar-light navLogo">
                <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6"><a class="" href="../inc/index.php">
                        <img src="../../imagenes/imgMaquetacion/logo.png" alt="Logo" class="img-fluid">
                    </a>
                </div>
                <div class="col-xs-2 col-sm-0 col-md-0 col-lg-0 boton"> <button class="navbar-toggler col-xs-12 col-sm-12 col-md-0 col-lg-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-xs-0 col-sm-12 col-md-6 col-lg-6">
                    <div class="cajabuscar col-xs-0 col-sm-12 col-md-12 col-lg-12 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-lg-none d-xl-block">
                        <form method="get" id="buscarform" class="">
                            <div class="input-group">
                                <input type="text" id="buscar" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>

            <nav class="navbar navbar-expand-md  col-xs-12 col-sm-12 col-md-12">
                <div class="collapse navbar-collapse barratema" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="../inc/index.php">Inicio <img src="../../imagenes/imgMaquetacion/inicio.png" alt=""></a>
                        </li>
                        <li class=" nav-item dropdown"><a class="nav-link " href="../inc/productos.php">Productos <img src="../../imagenes/imgMaquetacion/producto.png" alt=""></a>

                            <ul class="dropdown-menu">
                                <li><a href="../inc/camaras.php">Cámaras</a></li>
                                <li><a href="../inc/objetivos.php">Objetivos</a></li>
                                <li><a href="../inc/iluminacion.php">Iluminación</a></li>
                                <li><a href="../inc/libros.php">Libros</a></li>
                                <li><a href="../inc/mochilas.php">Mochilas</a></li>
                                <li><a href="../inc/accesorios.php">Otros accesorios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cursos.php">Cursos <img src="../../imagenes/imgMaquetacion/cursos.png" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blog <img src="../../imagenes/imgMaquetacion/blog.png" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recursos.php">Recursos <img src="../../imagenes/imgMaquetacion/recursos.png" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">Contacto <img src="../../imagenes/imgMaquetacion/contacto.png" alt=""></a>
                        </li>
                    </ul>
                    <!-- <form class="form-inline my-2 my-lg-0 d-block d-sm-none">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form> -->

                    <div class="cajabuscar form-inline my-2 my-lg-0 d-block d-sm-none">
                        <form method="get" id="buscarform">
                            <div class="input-group">
                                <input type="text" id="buscar" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </nav>



        </div>
        <!-- Termina el header -->

</header>