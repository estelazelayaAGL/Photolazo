<?php

include_once('../mod/clases/Producto.php');
include_once('../mod/clases/Curso.php');
session_start();

class CestaCompra
{

    protected $productosSeleccionados = array();
    protected $cursosSeleccionados = array();

    // Introduce un nuevo artículo en la cesta de la compra
    public function nuevo_articulo($codigo)
    {
        $producto = BD::obtieneProducto($codigo);
        $this->productosSeleccionados[] = $producto;
    }

    // Obtiene los artículos en la cesta
    public function get_productos()
    {
        return $this->productosSeleccionados;
    }


    // Obtiene el coste total de los artículos en la cesta
    public function get_coste()
    {
        $coste = 0;
        foreach ($this->productosSeleccionados as $p){
            $coste += $p->getPrecio();
        }
        foreach ($this->cursosSeleccionados as $c){
            $coste += $c->getPrecio();
        }   
        return $coste;
    }

    // Devuelve true si la cesta está vacía
    public function vacia()
    {
        if (count($this->productosSeleccionados) == 0)
            return true;
        return false;
    }

    // Guarda la cesta de la compra en la sesión del usuario
    public function guarda_cesta()
    {
        $_SESSION['cesta'] = $this;
    }

    // Recupera la cesta de la compra almacenada en la sesión del usuario
    public static function carga_cesta()
    {
        if (!isset($_SESSION['cesta']))
            return new CestaCompra();
        else
            return ($_SESSION['cesta']);
    }



    //Función que elimina un producto de la lista de selección, pasándole su código como parámetro
    function eliminaProducto($codigo)
    {
        $producto = BD::obtieneProducto($codigo);
        $pos = array_search($producto, $this->productosSeleccionados);
        unset($this->productosSeleccionados[$pos]);
    }

    // Muestra el HTML de la cesta de la compra, con todos los productos
    public function muestra()
    {
        // Si la cesta está vacía, mostramos un mensaje
        if ((count($this->productosSeleccionados) == 0) && (count($this->cursosSeleccionados) == 0))
            print "<p>Cesta vacía</p>";
        //  y si no está vacía, mostramos su contenido
        else {
            if(count($this->productosSeleccionados) > 0) {
                foreach ($this->productosSeleccionados as $producto) {
                    echo "<div class='col-xs-12 col-sm-12 col-md-12'>"
                        // . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        // . $producto->getCodigo()
                        // . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'>"
                        . $producto->getNombre()
                        . "</div>"
                        . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        . $producto->getPrecio()
                        . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'> "
                        . '<form action="cesta.php" method="post">'
                        . '<input type="hidden" name="codigo" value="' . $producto->getCodigo() . '"></input>'
                        . '<input type="hidden" name="nombre" value="' . $producto->getNombre() . '"></input>'
                        . '<input type="hidden" name="marca" value="' . $producto->getMarca() . '"></input>'
                        . '<input type="hidden" name="descripcion" value="' . $producto->getDescripcion() . '"></input>'
                        . '<input type="hidden" name="precio" value="' . $producto->getPrecio() . '"></input>'
                        . '<input type="submit" name="quitar" value="Quitar"></input>'
                        . '</form>'
                        . "</div>"
                        . "</div>";
                }    
            }
            if(count($this->cursosSeleccionados) > 0) {
                foreach ($this->cursosSeleccionados as $curso) {
                    echo "<div class='col-xs-12 col-sm-12 col-md-12'>"
                        // . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        // . $curso->getCodigo()
                        // . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'>"
                        . $curso->getTitulo()
                        . "</div>"
                        . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        . $curso->getPrecio()
                        . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'> "
                        . '<form action="cesta.php" method="post">'
                        . '<input type="hidden" name="codigo" value="' . $curso->getCodigo() . '"></input>'
                        . '<input type="submit" name="quitarCurso" value="Quitar"></input>'
                        . '</form>'
                        . "</div>"
                        . "</div>";
                }
            }

            echo "<div class='col-xs-12 col-sm-12 col-md-12'>"
                . "<div  class='col-xs-6 col-sm-6 col-md-6>'"
                . "<label>TOTAL: </label></div>"
                . "<div  class='col-xs-6 col-sm-6 col-md-6'>"
                . $this->get_coste()
                . "</div></div>";
            echo  "<div class='col-xs-12 col-sm-12 col-md-12'>"
                . '<form action="cesta.php" method="post">'
                . '<input type="submit" name="vaciar" value="Vaciar cesta"></input>'
                . '<input type="submit" name="tramitar" value="Tramitar pedido"></input>'
                . '</form>'
                . "</div>";
        }
    }


    //Función que muestra la lista de pizzas, pero sin el botón para eliminarla de la lista
    public function muestraSinBotonQuitar()
    {
        // Si la cesta está vacía, mostramos un mensaje
        if ((count($this->productosSeleccionados) == 0) && (count($this->cursosSeleccionados) == 0))
            print "<p>Selección vacía</p>";
        //  y si no está vacía, mostramos su contenido
        else {
            print "<ul>";
            if(count($this->productosSeleccionados) > 0) {
                foreach ($this->productosSeleccionados as $producto) {
                    echo "<div class='col-xs-12 col-sm-12 col-md-12'>"
                        // . "<div class='col-xs-2 col-sm-2 col-md-6'>"
                        // . $producto->getCodigo()
                        // . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'>"
                        . $producto->getNombre()
                        . "</div>"
                        . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        . $producto->getPrecio()
                        . "</div>"
                        . "</div>";
                }    
            }
            if(count($this->cursosSeleccionados) > 0) {
                foreach ($this->cursosSeleccionados as $curso) {
                    echo "<div class='col-xs-12 col-sm-12 col-md-12'>"
                        // . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        // . $curso->getTitulo()
                        // . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'>"
                        . $curso->getTitulo()
                        . "</div>"
                        . "<div class='col-xs-2 col-sm-2 col-md-2'>"
                        . $curso->getPrecio()
                        . "</div>"
                        . "<div class='col-xs-4 col-sm-4 col-md-4'> "
                        . '<form action="cesta.php" method="post">'
                        . '<input type="hidden" name="codigo" value="' . $curso->getTitulo() . '"></input>'
                        . '<input type="hidden" name="nombre" value="' . $curso->getTitulo() . '"></input>'
                        . '<input type="hidden" name="marca" value="' . $curso->getTitulo() . '"></input>'
                        . '<input type="hidden" name="descripcion" value="' . $curso->getTitulo() . '"></input>'
                        . '<input type="hidden" name="precio" value="' . $curso->getPrecio() . '"></input>'
                        . '</form>'
                        . "</div>"
                        . "</div>";
                }
            }
            echo "<div class='col-xs-12 col-sm-12 col-md-12'>"
                . "<div  class='col-xs-8 col-sm-8 col-md-6>'"
                . "<label>TOTAL: </label></div>"
                . "<div  class='col-xs-4 col-sm-4 col-md-6'>"
                . $this->get_coste()
                . "</div></div>";
            print "</ul>";
        }
    }


    // -------------------------------------------------------------------------- FUNCIONES PARA LOS CURSOS------------------------------------------------------------------
    // Introduce un nuevo artículo en la cesta de la compra
    public function nuevo_curso($codigo)
    {
        $curso = BD::obtieneCurso($codigo);
        $this->cursosSeleccionados[] = $curso;
    }

    // Obtiene los artículos en la cesta
    public function get_Cursos()
    {
        return $this->cursosSeleccionados;
    }

    // Obtiene el coste total de los artículos en la cesta
    public function get_costeCurso()
    {
        $coste = 0;
        foreach ($this->cursosSeleccionados as $c)
            $coste += $c->getPrecio();
        return $coste;
    }

    // Devuelve true si la cesta está vacía
    public function cestaVacia()
    {
        if (count($this->cursosSeleccionados) == 0)
            return true;
        return false;
    }

    // Guarda la cesta de la compra en la sesión del usuario
    public function guarda_cestaCurso()
    {
        $_SESSION['cesta'] = $this;
    }

    // Recupera la cesta de la compra almacenada en la sesión del usuario
    public static function carga_cestaCesta()
    {
        if (!isset($_SESSION['cesta']))
            return new CestaCompra();
        else
            return ($_SESSION['cesta']);
    }



    //Función que elimina un Curso de la lista de selección, pasándole su código como parámetro
    function eliminaCurso($codigo)
    {
        $Curso = BD::obtieneCurso($codigo);
        $pos = array_search($Curso, $this->cursosSeleccionados);
        unset($this->cursosSeleccionados[$pos]);
    }
   
}