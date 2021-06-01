<?php
// echo getcwd ();
require_once '../mod/clases/Producto.php';
require_once '../mod/clases/Curso.php';
require_once '../mod/clases/Usuario.php';
include_once 'conexion.php';

class BD
{

    public static function obtieneUsuario($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE user_login = '" . $usuario . "'";
        $resultado = self::ejecutaConsulta($sql);
        $usuario = null;
        if ($resultado) {
            $row = $resultado->fetch();
            $usuario = new Usuario($row);
        }
        return $usuario;
    }

    public static function verificaCliente($usuario, $contrasena)
    {
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

    public static function crearLineasPedido($cesta, $id_pedido) {
        foreach($cesta->get_productos() as $producto) {
            $sql = "INSERT INTO lineaspedidos (id_pedido, id_producto, cantidad, precio_venta, porcentaje_descuento, total) VALUES (";
            $sql .= "" . intval($id_pedido) . ", ";
            $sql .= "'" . $producto->getCodigo() . "', ";
            $sql .= "1, ";
            $sql .= "" . $producto->getPrecio() . ", ";
            $sql .= "0, ";
            $sql .= "" . $producto->getPrecio() . ")";
            self::ejecutaConsulta($sql);
        }
        unset($_SESSION['cesta']);
    }

    public static function crearPedido($id_usuario, $id_metodo, $total, $personaRecepcion) {

        $sql = "INSERT INTO pedidos(id_usuario, id_metodo, fecha_pedido, fecha_entrega, estado, total, personaRecepcion) VALUES (";
        $sql .= "" . $id_usuario . ", ";
        $sql .= "" . $id_metodo . ", ";
        $sql .= "NOW(), ";
        $sql .= "DATE_ADD(NOW(), INTERVAL 10 DAY), ";
        $sql .= "'Pendiente de pago', ";
        $sql .= "" . $total . ", ";
        $sql .= "'" . $personaRecepcion . "')";
        $id_pedido = "";
        $resultado = self::ejecutaConsulta($sql);
        if($resultado) {
            $select = "SELECT * FROM pedidos ORDER BY id_pedido DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if($resultadoSelect) {
                $row = $resultadoSelect->fetch();
                $id_pedido = $row['id_pedido'];
            }
        }
        return $id_pedido;
    }

    public static function crearMetodoCuenta($titular, $iban, $bic) {
        $sql = "INSERT INTO metodospagos(titular, iban, bic, tipoMetodo) VALUES (";
        $sql .= "'" . $titular . "', ";
        $sql .= "'" . $iban . "', ";
        $sql .= "'" . $bic . "', 0)";
        $id_metodo = "";
        $resultado = self::ejecutaConsulta($sql);
        if($resultado) {
            $select = "SELECT * FROM metodospagos ORDER BY id_metodo DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if($resultadoSelect) {
                $row = $resultadoSelect->fetch();
                $id_metodo = $row['id_metodo'];
            }
        }
        return $id_metodo;
    }

    public static function crearMetodoTarjeta($titular, $numero, $mes, $anio, $cvc) {
        $sql = "INSERT INTO metodospagos(titular, numero_tarjeta, mes_caducidad, ano_caducidad, cvc, tipoMetodo) VALUES (";
        $sql .= "'" . $titular . "', ";
        $sql .= "'" . $numero . "', ";
        $sql .= "" . $mes . ", ";
        $sql .= "" . $anio . ", ";
        $sql .= "" . $cvc . ", 1)";
        $id_metodo = "";
        $resultado = self::ejecutaConsulta($sql);
        if($resultado) {
            $select = "SELECT * FROM metodospagos ORDER BY id_metodo DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if($resultadoSelect) {
                $row = $resultadoSelect->fetch();
                $id_metodo = $row['id_metodo'];
            }
        }
        return $id_metodo;
    }

    public static function crearUsuario($nombre, $apellidos, $fechaNacimiento, $telefono, $email, $usuario, $contrasena, $direccion, $ciudad, $provincia, $pais, $codigopostal)
    {

        $sql = "INSERT INTO usuarios(tipo_usuario, nombre, apellidos, user_login, contrasena, fecha_nacimiento, correo, telefono, direccion, codigo_postal, ciudad, provincia, pais) VALUES (0, ";
        $sql .= "'" . $nombre . "', ";
        $sql .= "'" . $apellidos . "', ";
        $sql .= "'" . $usuario . "', ";
        $sql .= "'" . md5($contrasena) . "', ";
        $sql .= "'" . $fechaNacimiento . "', ";
        $sql .= "'" . $email . "', ";
        $sql .= "" . $telefono . ", ";
        $sql .= "'" . $direccion . "', ";
        $sql .= "" . $codigopostal . ", ";
        $sql .= "'" . $ciudad . "', ";
        $sql .= "'" . $provincia . "', ";
        $sql .= "'" . $pais . "')";

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


    public static function obtieneCursos($ctg) //Categoria
    {
        $sql = "SELECT c.* FROM cursos c INNER JOIN categorias categ ON c.id_categoria = categ.id_categoria";
        $sql .= " WHERE categ.nombre = '" . $ctg . "'";
        //echo $sql;
        $resultado = self::ejecutaConsulta($sql);
        $cursos = array();
        if ($resultado) {
            // Añadimos un elemento por cada pizza leida
            $row = $resultado->fetch();
            while ($row != null) {
                $cursos[] = new Curso($row);
                $row = $resultado->fetch();
            }
        }
        return $cursos;
    }

    //Este no vale para el CRUD
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

    public static function obtieneCurso($codigo)
    {
        $sql = "SELECT * FROM cursos c INNER JOIN categorias categ ON c.id_categoria = categ.id_categoria";
        $sql .= " WHERE id_curso='" . $codigo . "'";
        $resultado = self::ejecutaConsulta($sql);
        $curso = null;
        if (isset($resultado)) {
            $row = $resultado->fetch();
            $curso = new Curso($row);
        }
        return $curso;
    }

    // PARA EL CRUD
    public static function verificaExisteProducto($codigo)
    {
        $existe = false;
        $sql = "SELECT * FROM productos WHERE id_producto='$codigo'";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado->rowCount() > 0) {
            $existe = true;
        }
        return $existe;
    }

    public static function verificaExisteCurso($codigo)
    {
        $existe = false;
        $sql = "SELECT * FROM cursos WHERE id_curso='$codigo'";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado->rowCount() > 0) {
            $existe = true;
        }
        return $existe;
    }


    public static function extraeProductosCod($codigo)
    {
        $sql = "SELECT * FROM productos WHERE id_producto='$codigo'";
        $resultado = self::ejecutaConsulta($sql);

        return $resultado;
    }

    public static function extraeCursoCod($codigo)
    {
        $sql = "SELECT * FROM cursos WHERE id_curso='$codigo'";
        $resultado = self::ejecutaConsulta($sql);

        return $resultado;
    }



    public static function extraeProductosNm($nombre)
    {
        $sql = "SELECT * FROM productos WHERE nombre='$nombre'";
        $resultado = self::ejecutaConsulta($sql);

        return $resultado;
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
                    . '<form action="../inc/cesta.php" method="post">'
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


    public static function muestraCursos($cursos)
    {
        if (count($cursos) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>Lista de cursos vacía.</p></div>';
        } else {
            foreach ($cursos as $curso) {
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4 ">
						<div class="miembro-equipo cuadro"> 
							<img class="img-fluid" src="../../imagenes/imgObjetivas/camara.jpeg">
							<div class="team-info">'
                    . '<form action="../inc/cesta.php" method="post">'
                    . '<input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>'
                    // . '<input type="hidden" name="categoria" value="' . $curso->getCategoria() . '"></input>'
                    // . '<input type="hidden" name="lema" value="' . $curso->getLema() . '"></input>'
                    // . '<input type="hidden" name="titulo" value="' . $curso->getTitulo() . '"></input>'
                    // . '<input type="hidden" name="autor" value="' . $curso->getAutor() . '"></input>'
                    . '<a href=#><p>' . $curso->getTitulo() . '</p></a>'
                    . '<p> Autor: ' . $curso->getAutor() . '</p>'
                    . '<p>Nivel:' . $curso->getNivel() . '</p>'
                    . '<p>Resumen: ' . $curso->getResumen() .'</p>'
                    . '<p>Precio: ' . $curso->getPrecio() . '€ (IVA incluido)</p>';
                if (isset($_SESSION['usuario'])) {
                    echo '<input type="submit" name="aniadirCurso" value="Añadir al carrito"></input>';
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


    public static function actualizarDireccion($usuario, $direccion, $ciudad, $provincia, $pais, $codigoPostal)
    {
        $sql = "UPDATE usuarios SET direccion='$direccion' ,codigo_postal=$codigoPostal, ciudad='$ciudad',provincia='$provincia',pais='$pais'  WHERE user_login='$usuario'";
        $resultado = self::ejecutaConsulta($sql);

        return $resultado;
    }

    // --------------------------------------------------------CRUD------------------------------------------------------------------------------------------------------
    // CREACION DE PRODUCTOS - PARTE ADMINISTRADOR- CRUD -ANADIR -ELIMINAR -ACTUALIZAR - 
    public static function insertarProducto($idProducto, $idCategoria, $idMarca, $nombre, $unidades, $precio, $descripcion)
    {
        $mensaje = "";
        $valoracion = 0.0;

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteProducto($idProducto);

        if ($existe) {
            $mensaje = "El producto ya existe en la Base de Datos";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "INSERT INTO productos (id_producto,id_categoria,id_marca,nombre,unidades,precio,descripcion,valoracion_media) VALUES(?,?,?,?,?,?,?,?)";
                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $idProducto);
                    $consulta->bindParam(2, $idCategoria);
                    $consulta->bindParam(3, $idMarca);
                    $consulta->bindParam(4, $nombre);
                    $consulta->bindParam(5, $unidades);
                    $consulta->bindParam(6, $precio);
                    $consulta->bindParam(7, $descripcion);
                    $consulta->bindParam(8, $valoracion);

                    $consulta->execute();
                    $mensaje = "¡Se ha creado el añadido el producto " . $nombre . " correctamente!";
                }
            } catch (Exception $e) {
                $mensaje = "No se ha podido añadir el producto";
            }
        }
        return $mensaje;
    }

    public static function actualizarProducto($idProducto, $idCategoria, $idMarca, $nombre, $unidades, $precio, $descripcion)
    {
        $mensaje = "";

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteProducto($idProducto);

        if (!$existe) {
            $mensaje = "El producto no existe en la Base de Datos";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "UPDATE productos SET id_categoria=?,
                    id_marca=?,
                    nombre=?,
                    unidades=?,
                    precio=?,
                    descripcion=? 
                    WHERE id_producto=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $idCategoria);
                    $consulta->bindParam(2, $idMarca);
                    $consulta->bindParam(3, $nombre);
                    $consulta->bindParam(4, $unidades);
                    $consulta->bindParam(5, $precio);
                    $consulta->bindParam(6, $descripcion);
                    $consulta->bindParam(7, $idProducto);

                    $consulta->execute();
                    $mensaje = "¡Se ha modificado el producto " . $idProducto . " correctamente!";
                }
            } catch (Exception $e) {
                $mensaje = "No se ha podido modificar el producto " . $e->getMessage();
            }
        }
        return $mensaje;
    }


    public static function eliminarProducto($idProducto)
    {
        $mensaje = "";

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteProducto($idProducto);


        if (!$existe) {
            $mensaje = "El producto no existe en la Base de Datos";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "DELETE FROM productos WHERE id_producto=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $idProducto);

                    $consulta->execute();
                    $mensaje = "¡Se ha borrado el producto " . $idProducto . " correctamente!";
                }
            } catch (Exception $e) {
                $mensaje = "No se ha podido borrar el producto " . $e->getMessage();
            }
        }
        return $mensaje;
    }



    public static function listarProductos()
    {
        $mensaje = "";
            require 'conexion.php';

            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "SELECT * FROM productos";

                    $consulta = $dwes->prepare($sql);
                    $consulta->execute();
                    return $consulta;
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

    
        // CRUD DE CURSOS
           // CREACION DE CURSOS - PARTE ADMINISTRADOR- CRUD -ANADIR -ELIMINAR -ACTUALIZAR - 
    public static function insertarCurso($id_curso,$id_categoria,$lema,$titulo,$autor,$nivel,$resumen,$descripcion,$precio,$video_promocional)
    {
        $mensaje = "";
        $valoracion = 0.0;

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteCurso($id_curso);

        if ($existe) {
            $mensaje = "El curso ya existe en la Base de Datos";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "INSERT INTO cursos (id_curso,id_categoria,lema,titulo,autor,nivel,resumen,descripcion,precio,video_promocional,valoracion_media) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $id_curso);
                    $consulta->bindParam(2, $id_categoria);
                    $consulta->bindParam(3, $lema);
                    $consulta->bindParam(4, $titulo);
                    $consulta->bindParam(5, $autor);
                    $consulta->bindParam(6, $nivel);
                    $consulta->bindParam(7, $resumen);
                    $consulta->bindParam(8, $descripcion);
                    $consulta->bindParam(9, $precio);
                    $consulta->bindParam(10, $video_promocional);
                    $consulta->bindParam(11, $valoracion);
                    
                    $consulta->execute();
                    $mensaje = "¡Se ha creado el curso " . $titulo . " correctamente!";
                }
            } catch (Exception $e) {
                $mensaje = "No se ha podido añadir el curso";
            }
        }
        return $mensaje;
    }

    public static function actualizarCurso($id_curso,$id_categoria,$lema,$titulo,$autor,$nivel,$resumen,$descripcion,$precio,$video_promocional)
    {
        $mensaje = "";
        $valoracion=0.0;

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteCurso($id_curso);

        if (!$existe) {
            $mensaje = "El curso no existe en la Base de Datos";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "UPDATE cursos SET id_categoria=?,
                    lema=?,
                    titulo=?,
                    autor=?,
                    nivel=?,
                    resumen=?,
                    descripcion=?,
                    precio=? ,
                    video_promocional=?,
                    valoracion_media=?
                    WHERE id_curso=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $id_categoria);
                    $consulta->bindParam(2, $lema);
                    $consulta->bindParam(3, $titulo);
                    $consulta->bindParam(4, $autor);
                    $consulta->bindParam(5, $nivel);
                    $consulta->bindParam(6, $resumen);
                    $consulta->bindParam(7, $descripcion);
                    $consulta->bindParam(8, $precio);
                    $consulta->bindParam(9, $video_promocional);
                    $consulta->bindParam(10,$valoracion_media);
                    $consulta->bindParam(11,$id_curso);
                    

                    $consulta->execute();
                    $mensaje = "¡Se ha modificado el curso " . $titulo . " correctamente!";
                }
            } catch (Exception $e) {
                $mensaje = "No se ha podido modificar el curso " . $e->getMessage();
            }
        }
        return $mensaje;
    }


    public static function eliminarCurso($id_curso)
    {
        $mensaje = "";

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteCurso($id_curso);


        if (!$existe) {
            $mensaje = "El curso no existe en la Base de Datos";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "DELETE FROM cursos WHERE id_curso=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $id_curso);

                    $consulta->execute();
                    $mensaje = "¡Se ha borrado el curso " . $id_curso . " correctamente!";
                }
            } catch (Exception $e) {
                $mensaje = "No se ha podido borrar el curso " . $e->getMessage();
            }
        }
        return $mensaje;
    }



    public static function listarCursos()
    {
        $mensaje = "";
            require 'conexion.php';

            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "SELECT * FROM cursos";

                    $consulta = $dwes->prepare($sql);
                    $consulta->execute();
                    return $consulta;
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    
}
