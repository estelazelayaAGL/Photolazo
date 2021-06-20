<?php
require_once '../mod/clases/Comentario.php';

class funciones
{

    public static function mostrarComentarios($comentarios)
    {
        if (is_array($comentarios) || is_object($comentarios)) {
            echo "<h2 class='espacio'>" . sizeof($comentarios) . " comentarios</h2>";
            foreach ($comentarios as $comentario) {
                echo '
                <div class="row col-xs-12 col-sm-12 col-md-12 comentarios centrado">
                <div class="col-xs-4 col-sm-2 col-md-2 izquierda">
                <img src="../../imagenes/imgMaquetacion/avartar.png" alt="" class="imagenComentario">
                </div>
                <div class="col-xs-6 col-sm-8 col-md-8  sinPad">
                <div class="izquierda negrita"><h3>' . $comentario->getAutor() . '</h3></div>
                <p class="izquierda">' . $comentario->getContenido() . '</p>
                 </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="izquierda"><small><i>Posteado el ' . $comentario->getFecha_publicacion() . '</i></small></div>
                    </div>
            </div> ';
            }
        }
    }

    public static function muestraProductos($productos)
    {
        if (count($productos) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de productos vacía.</p></div>';
        } else {
            foreach ($productos as $producto) {
                $puntos = "";
                if (strlen($producto->getDescripcion()) > 100) {
                    $puntos = "...";
                }
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4">
						<div class="cuadro"> 
                        <form method="post" action="../inc/detalleProducto.php">
                        <input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>
                        <h3 class="separado">' . $producto->getNombre() . '</h3>
						<img class="img-fluid" src="../../imagenes/imgObjetivas/productos/' . $producto->getCodigo() . '.png">
                    <p class="separado espacio" id="descripcion">' . substr($producto->getDescripcion(), 0, 100) . $puntos . '<input id="detalleProducto" name="detalleProducto" type="submit" value="Ver más" class="btn btn-primary"></input></p>
                    
                    </form>	
                    <div class="detalles">'
                    . '<form method="post" action="../inc/cesta.php">'
                    . '<input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>'
                    // . '<p class="negrita derecha">Precio:</p>'
                    . '<p class="derecha iva"><label class="negrita precio">' . $producto->getPrecio() . ' €</label> (IVA no incluido)</p>'
                    . '<p class="separado">Valoración media: ' . number_format(BD::mediaResenas($producto->getCodigo()), 2) . ' / 5.00</p>';
                if (isset($_SESSION['usuario'])) {
                    echo '<input id="botonProductos" type="submit" name="aniadir" value="Añadir al carrito" class="btn btn-info btn-lg espacio"></input>';
                }
                echo ""
                    . '</form>'
                    . '</div>
						</div>
					</div>
                ';
            }
        }
    }

    public static function muestraProductosValoraciones($productos, $usuario)
    {
        if (count($productos) == 0) {
            //echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de productos vacía.</p></div>';
        } else {
            foreach ($productos as $producto) {
                $puntos = "";
                if (strlen($producto->getDescripcion()) > 100) {
                    $puntos = "...";
                }
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4">
						<div class="cuadro"> 
                        <form method="post" action="../inc/detalleProducto.php">
                        <input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>
                        <h3 class="separado">' . $producto->getNombre() . '</h3>
						<img class="img-fluid" src="../../imagenes/imgObjetivas/productos/' . $producto->getCodigo() . '.png">
                    <p class="separado espacio" id="descripcion">' . substr($producto->getDescripcion(), 0, 100) . $puntos . '<input id="detalleProducto" name="detalleProducto" type="submit" value="Ver más" class="btn btn-primary"></input></p>
                    
                    </form>	
                    <div class="detalles">'
                    . '<form method="post" action="../inc/detalleProducto.php">'
                    . '<input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>'
                    // . '<p class="negrita derecha">Precio:</p>'
                    . '<p class="derecha iva"><label class="negrita precio">' . $producto->getPrecio() . ' €</label> (IVA no incluido)</p>'
                    . '<p class="separado">Valoración media: ' . number_format(BD::mediaResenas($producto->getCodigo()), 2) . ' / 5.00</p>';
                if (!BD::verificarResena($usuario, $producto->getCodigo())) {
                    echo '<input id="detalleProducto" name="detalleProducto" type="submit" value="Ir a valorar" class="btn btn-info"></input>';
                } else {
                    echo "<div class='alert alert-success' role='alert'>
                    Ya has valorado
                  </div>";
                }
                echo ""
                    . '</form>'
                    . '</div>
						</div>
					</div>
                ';
            }
        }
    }

    public static function muestraCursosValoraciones($cursos, $usuario)
    {
        if (count($cursos) == 0) {
            //echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de cursos vacía.</p></div>';
        } else {
            foreach ($cursos as $curso) {
                $puntos = "";
                if (strlen($curso->getDescripcion()) > 100) {
                    $puntos = "...";
                }
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4">
						<div class="cuadro "> 
                        <form method="post" action="../inc/detalleCurso.php">
                            <input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>
                            <h3 class="separado">' . $curso->getTitulo() . '</h3>
                            <img class="img-fluid" src="../../imagenes/imgObjetivas/cursos/' . $curso->getCodigo() . '.png">
                            <p class="letraGrisPequena espacio derecha">' . $curso->getAutor() . '</p>
                            <p class="separado" id="descripcion"> ' . substr($curso->getDescripcion(), 0, 100) . $puntos . '<input id="detalleCurso" type="submit" value="Ver más" name="detalleCurso" class="btn btn-primary"></input></p>
                            
                        </form>
							<div class="detalles">'
                    . '<form action="../inc/detalleCurso.php" method="post">'
                    . '<input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>'
                    . '<p class="letrapequena izquierda">' . $curso->getNivel() . '</p>'
                    // . '<p class="negrita derecha">Precio: </p>'
                    . '<p class="derecha iva"><label class="negrita precio">' . $curso->getPrecio() . ' €</label> (IVA no incluido)</p>'
                    . '<p class="separado">Valoración media: ' . number_format(BD::mediaResenasCurso($curso->getCodigo()), 2) . ' / 5.00</p>';;

                if (!BD::verificarResenaCurso($usuario, $curso->getCodigo())) {
                    echo '<input id="detalleCurso" type="submit" value="Ir a valorar" name="detalleCurso" class="btn btn-info"></input>';
                } else {
                    echo "<div class='alert alert-success' role='alert'>
                    Ya has valorado
                  </div>";
                }
                echo ""
                    . '</form>'
                    . '</div>
						</div>
					</div>
                ';
            }
        }
    }

    public static function muestraCursos($cursos)
    {
        if (count($cursos) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de cursos vacía.</p></div>';
        } else {
            foreach ($cursos as $curso) {
                $puntos = "";
                if (strlen($curso->getDescripcion()) > 100) {
                    $puntos = "...";
                }
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4">
						<div class="cuadro "> 
                        <form method="post" action="../inc/detalleCurso.php">
                            <input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>
                            <h3 class="separado">' . $curso->getTitulo() . '</h3>
                            <img class="img-fluid" src="../../imagenes/imgObjetivas/cursos/' . $curso->getCodigo() . '.png">
                            <p class="letraGrisPequena espacio derecha">' . $curso->getAutor() . '</p>
                            <p class="letrapequena izquierda">' . $curso->getNivel() . '</p>
                            <p class="separado" id="descripcion"> ' . substr($curso->getDescripcion(), 0, 100) . $puntos . '<input id="detalleCurso" type="submit" value="Ver más" name="detalleCurso" class="btn btn-primary"></input></p>
                            
                        </form>
							<div class="detalles">'
                    . '<form action="../inc/cesta.php" method="post">'
                    . '<input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>'
                    // . '<p class="negrita derecha">Precio: </p>'
                    . '<p class="derecha iva"><label class="negrita precio">' . $curso->getPrecio() . ' €</label> (IVA no incluido)</p>'
                    . '<p class="separado">Valoración media: ' . number_format(BD::mediaResenasCurso($curso->getCodigo()), 2) . ' / 5.00</p>';;


                // print_r($comprado);
                if (isset($_SESSION['usuario'])) {
                    $usuario = BD::obtieneUsuario($_SESSION['usuario']);
                    $codigo = $usuario->getId_usuario();
                    $comprado = BD::verificaCompraCurso($codigo, $curso->getCodigo());
                    if (!$comprado) {
                        echo '<input id="botoncurso" type="submit" name="aniadirCurso" value="Añadir al carrito" class="btn btn-info btn-lg espacio"></input>';
                    }
                }
                echo ""
                    . '</form>'
                    . '</div>
						</div>
					</div>
                ';
            }
        }
    }

    public static function muestraUltimasEntradas($entradas)
    {
        if (count($entradas) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>No hay entradas</p></div>';
        } else {
            foreach ($entradas as $entrada) {
                echo '
                <div id="lbl" class="col-xs-12 col-sm-6 col-md-4 blanco mini">
                                <div class=" cuadro panel-padre"> 
                                <img class="img-fluid" src="../../imagenes/imgObjetivas/entradas/' . $entrada->getTitulo() . '.png">
                                        <div class="panel-titulo"> 
                <label for="" class="list-group-item blanco">' . $entrada->getTitulo() . '</label>
                <label class="fecha">' . BD::obtieneFechaEntrada($entrada->getCodigo()) . '</label>
                <form action="../inc/detalleEntrada.php" method="post">
                <input type="hidden" name="codigo" value="' . $entrada->getCodigo() . '"></input>
                    <input type="submit" name="aniadir" value="Leer más" class="btn btn-info btn-lg espacio azul"></input>';
                echo ""
                    . '</form>';
                echo '</div>
                    </div>
                    </div>';
            }
        }
    }
    public static function muestraTodasLasEntradas($entradas)
    {
        if (count($entradas) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>No hay entradas</p></div>';
        } else {
            foreach ($entradas as $entrada) {
                echo '
                <div id="lbl" class="col-xs-12 col-sm-6 col-md-4 blanco mini">
                                <div class="cuadro panel-padre">
                                <img class="img-fluid" src="../../imagenes/imgObjetivas/entradas/' . $entrada->getTitulo() . '.png">
                                        <div class="panel-titulo">
                                        <label class="list-group-item blanco" for="">' . $entrada->getTitulo() . '</label>
                                        <label class="fecha">' . BD::obtieneFechaEntrada($entrada->getCodigo()) . '</label>
                <form action="../inc/detalleEntrada.php" method="post">
                <input type="hidden" name="codigo" value="' . $entrada->getCodigo() . '"></input>
                    <input  type="submit" name="aniadir" value="Leer más" class="btn btn-info btn-lg espacio azul"></input>';
                echo ""
                    . '</form>';
                echo '</div>
                    </a>
                    </div>
                    </div>';
            }
        }
    }
}
