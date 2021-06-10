<?php
// echo getcwd ();
require_once '../mod/clases/Producto.php';
require_once '../mod/clases/Curso.php';
require_once '../mod/clases/Usuario.php';
require_once '../mod/clases/Blog.php';
require_once '../mod/clases/Comentario.php';
include_once 'conexion.php';

class BD
{


    public static function obtenerComentarios($blog)
    {
        $sql = "SELECT * FROM comentarios WHERE id_blog = " . $blog . "";
        $resultado = self::ejecutaConsulta($sql);
        $comentarios = null;
        $row = $resultado->fetch();
        if ($resultado->rowCount() > 0) {
            while ($row != null) {
                $comentarios[] = new Comentario($row);
                $row = $resultado->fetch();
            }
        }
        return $comentarios;
    }

    public static function crearComentario($nombre, $correo, $contenido, $blog)
    {
        $sql = "INSERT INTO comentarios(id_blog, autor, correo, contenido, fecha_publicacion) VALUES (";
        $sql .= "" . $blog . ", ";
        $sql .= "'" . $nombre . "', ";
        $sql .= "'" . $correo . "', ";
        $sql .= "'" . $contenido . "', ";
        $sql .= "NOW())";
        $id_metodo = "";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado) {
            $select = "SELECT * FROM metodospagos ORDER BY id_metodo DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if ($resultadoSelect) {
                $row = $resultadoSelect->fetch();
                $id_metodo = $row['id_metodo'];
            }
        }
        return $id_metodo;
    }

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
        $existe = false;
        $sql = "SELECT user_login FROM usuarios ";
        $sql .= "WHERE user_login='$usuario' ";
        $sql .= "AND contrasena='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado->rowCount() > 0) {
            $existe = true;
        }
        return $existe;
    }

    public static function verificaCompraCurso($id_usuario, $id_curso)
    {
        $comprado = false;
        $sql = "SELECT * FROM usuarioscursos ";
        $sql .= "WHERE id_usuario=$id_usuario AND id_curso='$id_curso' ";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado->rowCount() > 0) {
            $comprado = true;
        }
        return $comprado;
    }

    public static function verificaExistenciaCliente($usuario)
    {
        $existe = false;
        $sql = "SELECT user_login FROM usuarios ";
        $sql .= "WHERE user_login='$usuario' ";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado->rowCount() > 0) {
            $existe = true;
        }
        return $existe;
    }

    public static function existeReceptor($usuario)
    {
        $existe = false;
        $sql = "SELECT * FROM usuarios ";
        $sql .= "WHERE user_login='$usuario' AND receptor IS NOT  NULL ";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado->rowCount() > 0) {
            $existe = true;
        }
        return $existe;
    }



    public static function crearCursosUsuario($cesta, $id_usuario, $id_metodo)
    {
        foreach ($cesta->get_Cursos() as $curso) {
            $sql = "INSERT INTO usuarioscursos (id_usuario, id_curso, precio, fecha_compra, valoracion, id_metodo) VALUES (";
            $sql .= "" . $id_usuario . ", ";
            $sql .= "'" . $curso->getCodigo() . "', ";
            $sql .= "" . $curso->getPrecio() . ", ";
            $sql .= "NOW(), ";
            $sql .= "0, ";
            $sql .= "" . $id_metodo . ")";
            self::ejecutaConsulta($sql);
        }
    }

    public static function crearLineasPedido($cesta, $id_pedido)
    {
        foreach ($cesta->get_productos() as $producto) {
            $sql = "INSERT INTO lineaspedidos (id_pedido, id_producto, cantidad, precio_venta, porcentaje_descuento, total) VALUES (";
            $sql .= "" . intval($id_pedido) . ", ";
            $sql .= "'" . $producto->getCodigo() . "', ";
            $sql .= "1, ";
            $sql .= "" . $producto->getPrecio() . ", ";
            $sql .= "0, ";
            $sql .= "" . $producto->getPrecio() . ")";
            self::ejecutaConsulta($sql);
        }
    }

    public static function crearPedido($id_usuario, $id_metodo, $total, $personaRecepcion, $direccion)
    {

        $sql = "INSERT INTO pedidos(id_usuario, id_metodo, fecha_pedido, fecha_entrega, estado, total, personaRecepcion, direccionEntrega) VALUES (";
        $sql .= "" . $id_usuario . ", ";
        $sql .= "" . $id_metodo . ", ";
        $sql .= "NOW(), ";
        $sql .= "DATE_ADD(NOW(), INTERVAL 10 DAY), ";
        $sql .= "'Pendiente de pago', ";
        $sql .= "" . $total . ", ";
        $sql .= "'" . $personaRecepcion . "',";
        $sql .= "'" . $direccion . "')";
        $id_pedido = "";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado) {
            $select = "SELECT * FROM pedidos ORDER BY id_pedido DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if ($resultadoSelect) {
                $row = $resultadoSelect->fetch();
                $id_pedido = $row['id_pedido'];
            }
        }
        return $id_pedido;
    }

    public static function crearMetodoCuenta($titular, $iban, $bic)
    {
        $sql = "INSERT INTO metodospagos(titular, iban, bic, tipoMetodo) VALUES (";
        $sql .= "'" . $titular . "', ";
        $sql .= "'" . $iban . "', ";
        $sql .= "'" . $bic . "', 0)";
        $id_metodo = "";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado) {
            $select = "SELECT * FROM metodospagos ORDER BY id_metodo DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if ($resultadoSelect) {
                $row = $resultadoSelect->fetch();
                $id_metodo = $row['id_metodo'];
            }
        }
        return $id_metodo;
    }

    public static function crearMetodoTarjeta($titular, $numero, $mes, $anio, $cvc)
    {
        $sql = "INSERT INTO metodospagos(titular, numero_tarjeta, mes_caducidad, ano_caducidad, cvc, tipoMetodo) VALUES (";
        $sql .= "'" . $titular . "', ";
        $sql .= "'" . $numero . "', ";
        $sql .= "" . $mes . ", ";
        $sql .= "" . $anio . ", ";
        $sql .= "" . $cvc . ", 1)";
        $id_metodo = "";
        $resultado = self::ejecutaConsulta($sql);
        if ($resultado) {
            $select = "SELECT * FROM metodospagos ORDER BY id_metodo DESC LIMIT 1";
            $resultadoSelect = self::ejecutaConsulta($select);
            if ($resultadoSelect) {
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
        $sql .= "'" . $telefono . "', ";
        $sql .= "'" . $direccion . "', ";
        $sql .= "" . $codigopostal . ", ";
        $sql .= "'" . $ciudad . "', ";
        $sql .= "'" . $provincia . "', ";
        $sql .= "'" . $pais . "')";

        $resultado = self::ejecutaConsulta($sql);
        return $resultado;
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

    public static function verificaExisteEntrada($codigo)
    {
        $existe = false;
        $sql = "SELECT * FROM blogs WHERE id_blog='$codigo'";
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


    public static function extraeEntradaCod($codigo)
    {
        $sql = "SELECT * FROM blogs WHERE id_blog='$codigo'";
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
						<div class="cuadro"> 
                        <form method="post" action="../inc/detalleProducto.php">
                        <input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>
						<img class="img-fluid" src="../../imagenes/imgObjetivas/productos/' . $producto->getCodigo() . '.png">
                    <input id="detalleProducto" name="detalleProducto" type="submit" class="hidden"></input>
                    <label for="detalleProducto" class="btn btn-primary textoEnlace">' .  $producto->getNombre() . '</label>
					</form>	
                    <div class="detalles">'
                    . '<form method="post" action="../inc/cesta.php">'
                    . '<input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>'
                    . '<p class="negrita "> Descripción: </p>'
                    . '<p class="separado">' . $producto->getDescripcion() . '</p>'
                    . '<p class="negrita derecha">Precio:</p>'
                    . '<p class="derecha iva"><label class="negrita precio">' . $producto->getPrecio() . ' €</label> (IVA no incluido)</p>';
                if (isset($_SESSION['usuario'])) {
                    echo '<input id="botonProductos" type="submit" name="aniadir" class="hidden"></input>';
                    echo '<label for="botonProductos" class="btn btn-info btn-lg">Añadir al carrito <i class="fas fa-shopping-cart"></i></label>';
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
                <div class="col-xs-12 col-sm-6 col-md-4">
						<div class="cuadro "> 
                        <form method="post" action="../inc/detalleCurso.php">
                            <input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>
                            <img class="img-fluid" src="../../imagenes/imgObjetivas/cursos/' . $curso->getCodigo() . '.png">
                            <input id="detalleCurso" type="submit" name="detalleCurso" class="hidden"></input>
                            <label for="detalleCurso" class="btn btn-primary textoEnlace">' . $curso->getTitulo() . '</label>
                        </form>
							<div class="detalles">'
                    . '<form action="../inc/cesta.php" method="post">'
                    . '<input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>'
                    . '<p class="letrapequena">' . $curso->getAutor() . '</p>'
                    . '<p>' . $curso->getLema() . '</p>'
                    . '<p>Nivel: ' . $curso->getNivel() . '</p>'
                    . '<p class="negrita derecha">Precio: </p>'
                    . '<p class="derecha iva"><label class="negrita precio">' . $curso->getPrecio() . ' €</label> (IVA no incluido)</p>';


                // print_r($comprado);
                if (isset($_SESSION['usuario'])) {
                    $usuario = self::obtieneUsuario($_SESSION['usuario']);
                    $codigo = $usuario->getId_usuario();
                    $comprado = self::verificaCompraCurso($codigo, $curso->getCodigo());
                    if (!$comprado) {
                        echo '<input id="botoncurso" type="submit" name="aniadirCurso" class="hidden"></input>';
                        echo '<label for="botoncurso" class="btn btn-info btn-lg">Añadir al carrito <i class="fas fa-shopping-cart"></i></label>';
                    } else {
                        echo '';
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

    public static function ejecutaConsulta($sql)
    {
        require 'conexion.php';

        $resultado = null;
        if (isset($dwes)) {
            $resultado = $dwes->query($sql);
        }
        return $resultado;
    }

    public static function obtieneTodasLasMarcas()
    {
        $sql = "SELECT nombre FROM marcas";
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

    public static function actualizarReceptor($usuario, $receptor)
    {
        $sql = "UPDATE usuarios SET receptor='$receptor' WHERE user_login='$usuario'";
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
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>El producto ya existe en la base de datos</div>";
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
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha creado el añadido el producto " . $nombre . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido añadir el producto</div>";
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
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>El producto no existe en la Base de Datos</div>";
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
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha modificado el producto " . $idProducto . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido modificar el producto " . $e->getMessage() . "</div>";
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
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>El producto no existe en la Base de Datos</div>";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "DELETE FROM productos WHERE id_producto=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $idProducto);

                    $consulta->execute();
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha borrado el producto " . $idProducto . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido borrar el producto " . $e->getMessage() . "</div>";
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
    public static function insertarCurso($id_curso, $id_categoria, $lema, $titulo, $autor, $nivel, $resumen, $descripcion, $precio, $video_promocional)
    {
        $mensaje = "";
        $valoracion = 0.0;

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteCurso($id_curso);

        if ($existe) {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>El curso ya existe en la Base de Datos</div>";
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
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha creado el curso " . $titulo . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido añadir el curso</div>";
            }
        }
        return $mensaje;
    }

    public static function actualizarCurso($id_curso, $id_categoria, $lema, $titulo, $autor, $nivel, $resumen, $descripcion, $precio, $video_promocional)
    {
        $mensaje = "";
        $valoracion = 0.0;

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteCurso($id_curso);

        if (!$existe) {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>El curso no existe en la Base de Datos</div>";
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
                    $consulta->bindParam(10, $valoracion_media);
                    $consulta->bindParam(11, $id_curso);


                    $consulta->execute();
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha modificado el curso " . $titulo . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido modificar el curso " . $e->getMessage() . "</div>";
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
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>El curso no existe en la Base de Datos</div>";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "DELETE FROM cursos WHERE id_curso=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $id_curso);

                    $consulta->execute();
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha borrado el curso " . $id_curso . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido borrar el curso " . $e->getMessage() . "</div>";
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

    public static function categoriasProductoCurso()
    {
        $sql = "SELECT * FROM categorias";
        $resultado = self::ejecutaConsulta($sql);
        return $resultado;
    }

    public static function marcasProductoCurso()
    {
        $sql = "SELECT * FROM marcas";
        $resultado = self::ejecutaConsulta($sql);
        return $resultado;
    }

    public static function nivelesCurso()
    {
        $sql = "SELECT nivel FROM cursos";
        $resultado = self::ejecutaConsulta($sql);
        return $resultado;
    }

    public static function categoriasBlog()
    {
        $sql = "SELECT * FROM categoriasBlog";
        $resultado = self::ejecutaConsulta($sql);
        return $resultado;
    }

    // --------------------------------------------------------CRUD------------------------------------------------------------------------------------------------------
    // CREACION DE ENTRADAs - PARTE ADMINISTRADOR- CRUD -ANADIR -ELIMINAR -ACTUALIZAR - 
    public static function insertarEntrada($id_categoria, $autor, $titulo, $contenido, $fecha_publicacion)
    {
        $mensaje = "";

        require 'conexion.php';
        try {
            //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
            if (isset($dwes)) {
                $sql = "INSERT INTO blogs (id_categoriaB,autor,titulo,contenido,fecha_publicacion) VALUES(?,?,?,?,?)";
                $consulta = $dwes->prepare($sql);
                $consulta->bindParam(1, $id_categoria);
                $consulta->bindParam(2, $autor);
                $consulta->bindParam(3, $titulo);
                $consulta->bindParam(4, $contenido);
                $consulta->bindParam(5, $fecha_publicacion);

                $consulta->execute();

                $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha añadido la nueva entrada '" . $titulo . "' correctamente!</div>";
            }
        } catch (Exception $e) {
            $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido añadir la entrada</div>";
        }
        return $mensaje;
    }

    public static function actualizarEntrada($id_blog, $id_categoria, $autor, $titulo, $contenido, $fecha_publicacion)
    {
        $mensaje = "";

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteEntrada($id_blog);

        if (!$existe) {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>La entrada no existe en la base de datos</div>";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "UPDATE blogs SET id_categoriaB=?,
                    autor=?,
                    titulo=?,
                    contenido=?,
                    fecha_publicacion=?
                    WHERE id_blog=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $id_categoria);
                    $consulta->bindParam(2, $autor);
                    $consulta->bindParam(3, $titulo);
                    $consulta->bindParam(4, $contenido);
                    $consulta->bindParam(5, $fecha_publicacion);
                    $consulta->bindParam(6, $id_blog);

                    $consulta->execute();
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha modificado la entrada " . $titulo . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido modificar la entrada" . $e->getMessage() . "</div>";
            }
        }
        return $mensaje;
    }


    public static function eliminarEntrada($id_blog)
    {
        $mensaje = "";

        //llamar a getProducto con el id, y si no devuelve nada, proseguir con esto.
        $existe = self::verificaExisteEntrada($id_blog);

        if (!$existe) {
            $mensaje = "<div class ='alert alert-danger'>
            <a class='close' data-dismiss='alert'> × </a>La entrada no existe en la base de datos</div>";
        } else {
            require 'conexion.php';
            try {
                //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
                if (isset($dwes)) {
                    $sql = "DELETE FROM blogs WHERE id_blog=?";

                    $consulta = $dwes->prepare($sql);
                    $consulta->bindParam(1, $id_blog);

                    $consulta->execute();
                    $mensaje = "<div class ='alert alert-success'>
                    <a class='close' data-dismiss='alert'> × </a>¡Se ha borrado la entrada " . $id_blog . " correctamente!</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class ='alert alert-danger'>
                <a class='close' data-dismiss='alert'> × </a>No se ha podido borrar la entrada " . $e->getMessage() . "</div>";
            }
        }
        return $mensaje;
    }



    public static function listarEntradas()
    {
        $mensaje = "";
        require 'conexion.php';

        try {
            //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
            if (isset($dwes)) {
                $sql = "SELECT * FROM blogs";

                $consulta = $dwes->prepare($sql);
                $consulta->execute();
                return $consulta;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // BLOG 
    public static function  ultimasEntradas()
    {
        require 'conexion.php';
        try {
            //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
            if (isset($dwes)) {
                $sql = "SELECT * FROM blogs ORDER BY id_blog DESC LIMIT 3";

                $consulta = $dwes->prepare($sql);
                $consulta->execute();
                $entradas = array();
                if ($consulta) {
                    // Añadimos un elemento por cada pizza leida
                    $row = $consulta->fetch();
                    while ($row != null) {
                        $entradas[] = new Blog($row);
                        $row = $consulta->fetch();
                    }
                }
                return $entradas;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function muestraUltimasEntradas($entradas)
    {
        if (count($entradas) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>No hay entradas</p></div>';
        } else {
            foreach ($entradas as $entrada) {
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4 ">
                                <div class=" cuadro panel-padre"> 
                                <img class="img-fluid opaca" src="../../imagenes/imgObjetivas/entradas/Administración.png">
                                        <div class="panel-titulo"> 
                <label for="">' . $entrada->getTitulo() . '</label>
                <label class="fecha">' . $entrada->getFechaPublicacion() . '</label>
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

    public static function  todasLasEntradas()
    {
        require 'conexion.php';
        try {
            //Verifica que la variable de conexión exista, ya que se encuentra en otro fichero
            if (isset($dwes)) {
                $sql = "SELECT * FROM blogs ORDER BY titulo";

                $consulta = $dwes->prepare($sql);
                $consulta->execute();
                $entradas = array();
                if ($consulta) {
                    // Añadimos un elemento por cada pizza leida
                    $row = $consulta->fetch();
                    while ($row != null) {
                        $entradas[] = new Blog($row);
                        $row = $consulta->fetch();
                    }
                }
                return $entradas;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function muestraTodasLasEntradas($entradas)
    {
        if (count($entradas) == 0) {
            echo '<div class="col-xs-12 col-sm-12 col-md-12"><p>No hay entradas</p></div>';
        } else {
            foreach ($entradas as $entrada) {
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4 ">
                                <div class="">
                                <img class="img-fluid opaca" src="../../imagenes/imgObjetivas/entradas/Administración.png">
                                        <div class="">
                                        <label for="">' . $entrada->getTitulo() . '</label>
                                        <label class="fecha">' . $entrada->getFechaPublicacion() . '</label>
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

    public static function obtieneEntrada($codigo)
    {
        $sql = "SELECT * FROM blogs WHERE id_blog = " . $codigo . "";
        $resultado = self::ejecutaConsulta($sql);
        $blog = null;
        if ($resultado) {
            $row = $resultado->fetch();
            $blog = new Blog($row);
        }
        return $blog;
    }

    public static function siguienteEntrada($codigo)
    {
        $codigo = $codigo - 1;
        $sql = "SELECT * FROM blogs WHERE id_blog = " . $codigo . "";
        $resultado = self::ejecutaConsulta($sql);
        $blog = null;
        if ($resultado->rowCount() > 0) {
            $row = $resultado->fetch();
            $blog = new Blog($row);
        }
        return $blog;
    }

    public static function anteriorEntrada($codigo)
    {
        $codigo = $codigo + 1;
        $sql = "SELECT * FROM blogs WHERE id_blog = " . $codigo . "";
        $resultado = self::ejecutaConsulta($sql);
        $blog = null;
        if ($resultado->rowCount() > 0) {
            $row = $resultado->fetch();
            $blog = new Blog($row);
        }
        return $blog;
    }

    // VERIFICAR EL TIPO DE EXTENSIÓN DE LA IMAGEN
    public static function checkExtension($nombre)
    {
        //obtenemos la extension
        /*
        End requiere una referencia, porque modifica la representación interna de la matriz
        (es decir, hace que el puntero del elemento actual apunte al último elemento).
        El resultado de explode('.', $file_name)no se puede convertir en una referencia. Esta es una restricción
        en el lenguaje PHP, que probablemente existe por razones de simplicidad.
        */
        $extensionE = explode(".", $nombre);
        $extension = end($extensionE);
        // echo "extension obtenida: " . $extension;
        //aqui podemos añadir las extensiones que deseemos permitir
        $extensiones = array("png", "PNG");
        if (in_array(strtolower($extension), $extensiones))
            return true;
        else
            return false;
    }
}
