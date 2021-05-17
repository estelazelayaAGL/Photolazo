<?php

require_once 'Productos.php';

Class BD {

    public static function obtieneProductos($categoria, $marca) {
        $sql = "select p.nombre, p.precio, p.descripcion, m.nombre as Marca, c.nombre as Categoria FROM productos p
        inner join marcas m on p.id_marca = m.id_marca
        inner join categorias c on p.id_categoria = c.id_categoria";
        $sql .= " WHERE c.nombre = '" . $categoria . "' AND m.nombre = '".$marca."'";
        $resultado = self::ejecutaConsulta($sql);
        $productos = array();
        if ($resultado) {
            // Añadimos un elemento por cada pizza leida
            $row = $resultado->fetch();
            while ($row != null) {
                $productos[] = new Producto($row);
                $row = $resultado->fetch();
            }
        }
        return $productos;
    }

    public static function muestraProductos($productos) {
        if (count($productos) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de productos vacía.</p></div>';
        } else {
            foreach($productos as $producto) {
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro">
							<img class="img-fluid" src="../../imagenes/imgObjetivas/camara.jpeg">
							<div class="team-info">'
								// .'<p>'.$producto->getMarca().'</p>'  
                                .'<a href=#><p>'.$producto->getNombre().'</p></a>'
                                .'<p>Precio: '.$producto->getPrecio().'€</p>'
							.'</div>
						</div>
					</div>
                ';
            }
        }
    }

    public static function ejecutaConsulta($sql) {
		require'conexion.php';
		
		$resultado = null;
		if (isset($dwes)) {
			$resultado = $dwes->query($sql);
		}
		return $resultado;

    
    }
}

?>