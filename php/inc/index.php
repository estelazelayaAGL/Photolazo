<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Inicio';
    ?>

    <?php
    include("../mod/plantillasDelDiseno/header.php");
    ?>

    <!---	Incluye un breadcrumb que indique la sección actual-->
    <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
        <?php include("../mod/plantillasDelDiseno/slider.php"); ?>
        <div class="">
            <ol class="breadcrumb">
                <li class="active"><?php echo $titulo ?> </li>
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
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h1>¡Bienvenidos PhotoLazeros!</h1>
                            <p class="texto">Si estas aquí es porque seguro sabes de fotografía, o simplemente quieres
                                aprender y conocer un poco más este mundo. Si es así, déjame decirte que estás
                                en el lugar correcto.
                                Para PhotoLazo, los protagonistas son todas las personas que quieren ir un paso
                                más allá en sus vidas, apostar por sí mismas y realizarse a través de lo que
                                les apasiona: La fotografía.
                            </p>
                            <p class="texto"> Me gustaría ponerte en contexto para que entiendas un poco más de qué se
                                trata este proyecto.
                                Como ya habrás visto, tenemos muchos materiales fotográficos a la
                                venta, incluyendo cursos de fotografía en distintos niveles. ¡Pero todo
                                eso solo es la punta del Iceberg!
                            </p>

                            <p class="texto">Nuestro objetivo principal es que podamos ir creando cada vez más material gratis, para personas
                                que no tienen la oportunidad de pagar un curso completo pero que les apasiona
                                este mundo. Así que, cada vez que compras algo de nuestra tienda,
                                estás colaborando, no solo para
                                acceder a más recursos gratis tú mismo, si no que estás ayudando a que esos
                                recursos sigan creciendo, y el conocimiento llegue a más personas.</p>

                            <p class="texto">Así que ya sabes, nuestra misión es contribuir y mejorar la
                                vida de muchisimas personas, para que de esta manera puedan tener una puerta
                                abierta para conseguir dedicarse a lo que les apasiona.</p>

                            <p class="texto">Tú eres un pilar fundamental en este proyecto, sin ti nada de esto
                                tendría sentido, eres tú quien dicta el alcance de este proyecto. Así que recuerda,
                                nos ayudas mucho comprando y compartiendo con tus amigos el sitio web.</p>

                            <blockquote class="blockquote text-right">
                                <p class="mb-0">“Paso a paso por la dirección adecuada se llega a la meta.”.</p>
                                <cite class="blockquote-footer" title="Source Title">Estela Z. Lazo</cite>
                            </blockquote>
                        </div>

                        <a href="cursos.php"><button class="btn btn-primary btn-lg">Ver cursos</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>