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
				<h1>Nuestros productos</h1>
				<h4>Los mejores del mercado</h4>
				<hr>

				<div class="row">
					<!-- Miembro -->
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<a href="../inc/camaras.php"><img class="img-fluid opaca" src="../../imagenes/imgObjetivas/camara.jpeg">
								<div class="team-info">
									<span>Cámaras</span>
								</div>
							</a>
						</div>
					</div>

					<!-- Miembro -->
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<a href="../inc/objetivos.php"><img class="img-fluid opaca" src="../../imagenes/imgObjetivas/lente.jpg">
							<div class="team-info">
								<span>Objetivos</span>
							</div>
						</a>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<a href="../inc/iluminacion.php"><img class="img-fluid opaca" src="../../imagenes/imgObjetivas/ilumination.jpeg">
							<div class="team-info">
								<span>Iluminación</span>
							</div>
						</a>
						</div>
					</div>

					<!-- Miembro -->
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<a href="../inc/libros.php"><img class="img-fluid opaca" src="../../imagenes/imgObjetivas/libros (1).jpg">
							<div class="team-info">
								<span>Libros</span>
							</div>
						</a>
						</div>
					</div>

					<!-- Miembro -->
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<a href="../inc/mochilas.php"><img class="img-fluid opaca" src="../../imagenes/imgObjetivas/mochilas (1).jpeg">
							<div class="team-info">
								<span>Mochilas</span>
							</div>
						</a>
						</div>
					</div>


					<!-- Miembro -->
					<div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<a href="../inc/accesorios.php"><img class="img-fluid opaca" src="../../imagenes/imgObjetivas/otros.PNG">
							<div class="team-info">
								<span>Otros accesorios</span>
							</div>
						</a>
						</div>
					</div>

				</div>
			</div>
	</section>

	<?php include("../mod/plantillasDelDiseno/footer.php")  ?>
</body>

</html>