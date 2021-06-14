<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Recursos'; ?>

    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="../../index.php"> Inicio </a></li>
                <li class="active">Recursos</li>
            </ol>
        </div>
    </div>
    </nav>
    </div>
    <!-- Termina el header -->
    </header>
    
    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">
            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Nuestros recursos gratis</h1><br>
                        <hr>
                        <a href="../../pdf-recursos/recursos/1. Introducción a la fotografía digital.pdf" download="1. Introducción a la fotografía digital">
                            Introducción a la fotografía digital <img src="../../imagenes/imgObjetivas/pdf.png" alt="">
                        </a><br>

                        <a href="../../pdf-recursos/recursos/2. Curso de retoque fotográfico (Photoshop).pdf" download="2. Curso de retoque fotográfico (Photoshop)">
                            Curso de retoque fotográfico (Photoshop) <img src="../../imagenes/imgObjetivas/pdf.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>