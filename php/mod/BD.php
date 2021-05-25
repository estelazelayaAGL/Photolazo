<?php

require_once 'Producto.php';
require_once 'Usuario.php';

class BD
{

    public static function obtieneUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE user_login = '" . $usuario . "'";
        $resultado = self::ejecutaConsulta($sql);
        $usuario = null;
        if ($resultado) {
            $row = $resultado->fetch();
            $usuario = new Usuario($row);
        }
        return $usuario;
    }

    public static function verificaCliente($usuario, $contrasena) {
        $sql = "SELECT user_login FROM usuarios ";
        $sql .= "WHERE user_login='$usuario' ";
        $sql .= "AND contrasena='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta($sql);
        if (isset($resultado)) {
            $fila = $resultado->fetch();
            if ($fila !== false) {
                $_SESSION['usuario'] = $usuario;
                header("Location: index.php");
            } else {
                echo "Usuario no registrado.";
            }
        }
    }

    public static function crearUsuario($nombre, $apellidos, $fechaNacimiento, $telefono, $email, $usuario, $contrasena, $direccion, $ciudad, $provincia, $pais, $codigopostal) {
        
        $sql = "INSERT INTO usuarios(tipo_usuario, nombre, apellidos, user_login, contrasena, fecha_nacimiento, correo, telefono, direccion, codigo_postal, ciudad, provincia, pais) VALUES (0, ";
        $sql .= "'".$nombre ."', ";
        $sql .= "'".$apellidos ."', ";
        $sql .= "'".$usuario ."', ";
        $sql .= "'".md5($contrasena) ."', ";
        $sql .= "'".$fechaNacimiento ."', ";
        $sql .= "'".$email ."', ";
        $sql .= "".$telefono .", ";
        $sql .= "'".$direccion ."', ";
        $sql .= "".$codigopostal .", ";
        $sql .= "'".$ciudad ."', ";
        $sql .= "'".$provincia ."', ";
        $sql .= "'".$pais ."')";

        $resultado = self::ejecutaConsulta($sql);
        if ($resultado) {
            echo "¡Se ha creado el usuario " . $usuario . " correctamente!";
        } else {
            header("Location: registro.php");
        }
    }

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
                    . '<p>Precio: ' . $producto->getPrecio() . '€ (IVA incluido)</p>';
                    if (isset($_SESSION['usuario'])) {
                        echo '<input type="submit" name="aniadir" value="Añadir al carrito"></input>';
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
