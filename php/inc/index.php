<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Inicio';
    ?>

    <?php 
    include("../mod/header.php");
    include("../mod/slider.php");
    ?>

    <section class="container-fluid">


        <!-- ENCABEZADO -->
        <div class="container seccion ">

            <!---	Incluye un breadcrumb que indique la sección actual-->
            <div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li class="active"><?php echo $titulo ?> </li>
                    </ol>
                </div>
            </div>

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1>¡Bienvenidos PhotoLazeros!</h1>
                <p>Si estas aquí es porque seguro sabes de fotografía, o simplemente quieres
                    aprender y conocer un poco más este mundo. Si es así, déjame decirte que estás
                    en el lugar correcto.
                    Para PhotoLazo, los protagonistas son todas las personas que quieren ir un paso
                    más allá en sus vidas, apostar por sí mismas y realizarse a través de lo que
                    les apasiona: La fotografía.

                    Me gustaría ponerte en contexto para que entiendas un poco más de qué se
                    trata este proyecto.

                    Como ya habrás visto, tenemos muchos materiales fotográficos a la
                    venta, incluyendo cursos de fotografía en distintos niveles. ¡Pero todo
                    eso solo es la punta del Iceberg! Nuestro objetivo principal es
                    que podamos ir creando cada vez más material gratis, para personas
                    que no tienen la oportunidad de pagar un curso completo pero que les apasiona
                    este mundo. Así que, cada vez que compras algo de nuestra tienda,
                    estás colaborando, no solo para
                    acceder a más recursos gratis tú mismo, si no que estás ayudando a que esos
                    recursos sigan creciendo, y el conocimiento llegue a más personas.
                    Así que ya sabes, nuestra misión es contribuir y mejorar la
                    vida de muchisimas personas, para que de esta manera puedan tener una puerta
                    abierta para conseguir dedicarse a lo que les apasiona.

                    Recuerda, tú eres un pilar fundamental en este proyecto, sin ti nada de esto
                    tendría sentido, eres tú quien dicta el alcance de este proyecto. Así que recuerda,
                    nos ayudas mucho comprando y compartiendo con tus amigos el sitio web.

                    Recuenda “pasito a pasito por la dirección adecuada se llega a la meta.”
                </p>

                <span><a class="btn btn-primary btn-lg col-xs-6 col-sm-6 col-md-2" href="#slider">Ver cursos</a></span>
            </div>
        </div>
    </section>

    <?php include("../mod/footer.php")  ?>
</body>

</html>