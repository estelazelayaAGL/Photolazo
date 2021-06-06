<!DOCTYPE html>
<html lang="en">

<body>
    <?php $titulo = 'Cursos'; ?>
    <?php include("../mod/plantillasDelDiseno/header.php")  ?>
    <?php
$codigo=$_POST['codigo'];
$autor=$_POST['autor'];
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
$fecha_publicacion=$_POST['fechaPublicacion'];
?>

    <section class="container-fluid">
        <!-- ENCABEZADO -->
        <div class="container sinPad ">

            <div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
                <h1><?php echo $titulo?></h1>
                <hr>
                
            </div>
        </div>

    </section>

    <?php include("../mod/plantillasDelDiseno/footer.php")  ?>

</body>

</html>