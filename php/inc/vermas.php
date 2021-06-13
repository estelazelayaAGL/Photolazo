<?php

/*
	* Carga tu info de la base de datos
	* En éste caso yo uso un array para demostrar.
	*/

$Informacion = array(
	'Buenas.. Alguna idea de como hacer el "Ver mas" en una lista en donde muestro varias columnas y en la columna mensaje, quiero que solo me muestre un determinado numero de palabras y que me bote un link que diga "Ver mas" y haciendo clic ahi que recien me muestre todo el mensaje.. Sin hacer uso de Ajax solo PHP',
	'Una vez cargada la página cambia el innerHTML de cada contenedor por el del substring. Por último nada más queda hacer un toggle Para programar el Ver más bastaría crear un contador PHP que maneje los índices desde 0, luego creas los botones con la etiqueta que más se te apetezca y le agregas un atributo como data-Indice="<?php echo $Indice; ?>". Luego crea un onclick en botón que llame a una función javascript, así: onclick="TogglearInfo(this);". Y en la función manejas los Arrays a través de la referencia:',
	'Waoo.. men soy un novato en javascript :( pense que se podia solo con puro PHP La verdad no entendi bien lo que quizo decir, el pedazo de mi codigo es este: Jalo esos datos de la db y en el campo mensaje quiero que me muestre una cantidad de texto determinada y un link "Ver mas".'
);

$i = 0; // Este contador llevará el índice para cada contenedor;

?>
<!Doctype html>
<html>

<head>
	<title>Ejemplo Ver más</title>
	<script type="text/javascript">
		var Contenedores;
		var Informacion;

		var ObtenerInfo = function() {
			// Una vez cargada la página se llamará a ésta función.

			var LongitudInformacionResumida = 40;
			var i = 0;

			// Cargas los contenedores.

			Contenedores = document.getElementsByName('Contenedor');
			Informacion = new Array();

			while (Contenedores[i] != null) {
				/*
				 * Almacenas la info de cada contenedor en un array aparte
				 * Luego asignale a cada contenedor su substring;
				 */

				Informacion[i] = Contenedores[i].innerHTML;
				Contenedores[i].innerHTML = Informacion[i].substring(0, LongitudInformacionResumida);
				i++;
			}
		}

		var VerMas = function(Boton) {
			// Aquí asignas la info completa a través de cada botón "Ver más".

			var Indice = parseInt(Boton.getAttribute('data-Indice'));

			Contenedores[Indice].innerHTML = Informacion[Indice];
		}

		window.addEventListener('load', ObtenerInfo, false);
	</script>
</head>

<body>
	<?php

	// Muestra tu información de la base de datos a través de un bucle:

	foreach ($Informacion as $Info) {
	?>
		<div name="Contenedor"><?php echo $Info; ?></div>
		<div>
			<button data-Indice="<?php echo $i; ?>" onclick="VerMas(this);">Ver más</button>
		</div>
	<?php

		$i++; // Incrementa el índice.
	}

	?>
</body>

</html>


<div class="cuadro">
	<form method="post" action="../inc/detalleProducto.php">
		<input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>
		<p class="separado">' . $producto->getNombre() . '</p>
		<img class="img-fluid" src="../../imagenes/imgObjetivas/productos/' . $producto->getCodigo() . '.png">

		<p class="separado" id="descripcion">' . substr($producto->getDescripcion(), 0, 100) . $puntos . '<input id="detalleProducto" name="detalleProducto" type="submit" value="Ver más" class="btn btn-primary"></input></p>


		<h3 class="separado">' . $curso->getTitulo() . '</h3>
		<img class="img-fluid" src="../../imagenes/imgObjetivas/cursos/' . $curso->getCodigo() . '.png">
		<p class="letraGrisPequena espacio derecha">' . $curso->getAutor() . '</p>