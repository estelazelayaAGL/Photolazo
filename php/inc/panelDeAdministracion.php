<!DOCTYPE html>
<html lang="en">

<body>
	<?php $titulo = 'Productos'; ?>

	<?php include("../mod/plantillasDelDiseno/header.php")  ?>

	<section class="container-fluid">
		<!-- ENCABEZADO -->
		<div class="container seccion ">

			<!---	Incluye un breadcrumb que indique la sección actual-->
			<div class="breadcrumbDiv col-xs-12 col-sm-12 col-md-12">
				<div class="">
					<ol class="breadcrumb">
						<li><a href="index.php"> Inicio </a></li>
						<li class="active">Productos</li>
					</ol>
				</div>
			</div>

			<div class="cabecera-seccion col-xs-12 col-sm-12 col-md-12">
				<h1>Panel de administración</h1>
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="panel-padre">
							<a href="../inc/administracionProductos.php"><img class="img-fluid opaca" src="../../imagenes/imgMaquetacion/administracion.png">
								<div class="panel-titulo">
									Gestión de productos
								</div>
							</a>
						</div>
					</div>

					<!-- Miembro -->
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="panel-padre">
							<a href="../inc/administracionCursos.php"><img class="img-fluid opaca" src="../../imagenes/imgMaquetacion/administracion.png">
							<div class="panel-titulo">
								Gestión de cursos
							</div>
						</a>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="panel-padre">
							<a href="../inc/administracionBlog.php"><img class="img-fluid opaca" src="../../imagenes/imgMaquetacion/administracion.png">
							<div class="panel-titulo">
								Gestión de Blog
							</div>
						</a>
						</div>
					</div>

				
	</section>

	<?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>