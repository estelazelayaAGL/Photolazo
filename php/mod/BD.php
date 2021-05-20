<?php

require_once 'Producto.php';

class BD
{

    public static function obtieneProductos($ctg, $mrc) //Categoria y marca
    {
        $sql = "SELECT p.id_producto AS codigo, p.nombre, p.precio, p.descripcion, m.nombre AS marca, c.nombre AS categoria FROM productos p INNER JOIN marcas m ON p.id_marca = m.id_marca INNER JOIN categorias c ON p.id_categoria = c.id_categoria";
        $sql .= " WHERE c.nombre = '" . $ctg . "' AND m.nombre = '" . $mrc . "'";
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

    public static function obtieneProducto($codigo)
    {
        $sql = "SELECT p.id_producto AS codigo, p.nombre, p.precio, p.descripcion, m.nombre AS marca, c.nombre AS categoria FROM productos p INNER JOIN marcas m ON p.id_marca = m.id_marca INNER JOIN categorias c ON p.id_categoria = c.id_categoria";
        $sql .= " WHERE id_producto='" . $codigo . "'";
        $resultado = self::ejecutaConsulta($sql);
        $producto = null;
        if (isset($resultado)) {
            $row = $resultado->fetch();
            $producto = new Producto($row);
        }
        return $producto;
    }

    public static function muestraProductos($productos)
    {
        if (count($productos) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de productos vacía.</p></div>';
        } else {
            foreach ($productos as $producto) {
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro"> 
							<img class="img-fluid" src="../../imagenes/imgObjetivas/camara.jpeg">
							<div class="team-info">'
                    . '<form action="cesta.php" method="post">'
                    . '<input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>'
                    . '<input type="hidden" name="nombre" value="' . $producto->getNombre() . '"></input>'
                    . '<input type="hidden" name="marca" value="' . $producto->getMarca() . '"></input>'
                    . '<input type="hidden" name="descripcion" value="' . $producto->getDescripcion() . '"></input>'
                    . '<input type="hidden" name="precio" value="' . $producto->getPrecio() . '"></input>'
                    . '<a href=#><p>' . $producto->getNombre() . '</p></a>'
                    . '<p> Marca: ' . $producto->getMarca() . '</p>'
                    . '<p>' . $producto->getDescripcion() . '</p>'
                    . '<p>Precio: ' . $producto->getPrecio() . '€ (IVA incluido)</p>'
                    . '<input type="submit" name="aniadir" value="Añadir al carrito"></input>'
                    . '</form>'
                    . '</div>
						</div>
					</div>
                ';
            }
        }
    }

    public static function ejecutaConsulta($sql)
    {
        require 'conexion.php';

        $resultado = null;
        if (isset($dwes)) {
            $resultado = $dwes->query($sql);
        }
        return $resultado;
    }


    public static function obtieneMarca()
    {
        $sql = "SELECT id_marca FROM productos WHERE id_categoria='CAT001' ORDER BY id_marca";
        $resultado = self::ejecutaConsulta($sql);
        $marcas = array();
        if ($resultado) {
            // Añadimos un elemento por cada marca leida
            $row = $resultado->fetch();
            while ($row != null) {
                $marcas[] = $row;
                $row = $resultado->fetch();
            }
        }
        return $marcas;
    }


    public static function anadeProducto()
    {
        $sql = "INSERT INTO productos ";
        $resultado = self::ejecutaConsulta($sql);
    }
}
