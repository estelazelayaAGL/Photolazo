<?php

include_once('../mod/clases/Producto.php');
include_once('../mod/clases/Curso.php');
session_start();

class CestaCompra
{

    protected $productosSeleccionados = array();
    protected $cursosSeleccionados = array();
    protected $todoslospedidosProductos = array();
    protected $todoslospedidosCursos = array();

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
               echo " <table class='table table-striped'>
                <thead>
                  <tr>
                    <th>Marca</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>";
                foreach ($this->productosSeleccionados as $producto) {
                    echo "<tr>
                    <td>" . $producto->getMarca()."</td>
                    <td>".$producto->getNombre()."</td>
                    <td>".$producto->getPrecio()."€</td>
                    <form action='cesta.php' method='post'>
                    <input type='hidden' name='codigo' value='" . $producto->getCodigo() . "'></input>
                        <input type='hidden' name='nombre' value='" . $producto->getNombre() . "'></input>
                        <input type='hidden' name='marca' value='" . $producto->getMarca() . "'></input>
                        <input type='hidden' name='descripcion' value='" . $producto->getDescripcion() . "'></input>
                        <input type='hidden' name='precio' value='" . $producto->getPrecio() . "'></input>
                    <td><input type='submit' name='quitar' value='Quitar' class='btn btn-primary btn-xs'></input></td>
                    </form>
                  </tr>";
                } 
                echo "</tbody>
                </table>";   
            }
            if(count($this->cursosSeleccionados) > 0) {
                echo " <table class='table table-striped'>
                <thead>
                  <tr>
                    <th>Título del curso</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>";
                foreach ($this->cursosSeleccionados as $curso) {
                    echo "<tr>
                    <td>" . $curso->getTitulo()."</td>
                    <td>".$curso->getAutor()."</td>
                    <td>".$curso->getPrecio()."€</td>
                    <form action='cesta.php' method='post'>
                    <input type='hidden' name='codigo' value='" . $curso->getCodigo() . "'></input>
                    <td><input type='submit' name='quitarCurso' value='Quitar' class='btn btn-primary btn-xs'></input></td>
                    </form>
                  </tr>";
                }
                echo "</tbody>
                </table>"; 
            }

            echo "<table class='rosa_tabla table table-striped col-xs-12 col-sm-12 col-md-12'>"
                . "<tr>"
                . "<td colspan='2' class='text-right'>TOTAL: </td>"
                . "<td>"
                . number_format($this->get_coste(),2)
                . "€</td>"
                ."</tr>"
                ."<tr>"
                ."<td colspan='2' class='text-right'>IVA: </td><td>"
                .number_format(($this->get_coste()*0.21),2)
                ."</td></tr><tr>"
                . "<td colspan='2' class='text-right'>Subtotal: </td><td>"
                . number_format((($this->get_coste()*0.21)+ $this->get_coste()),2)
                ."</td></tr>"
                ."</table>";
            echo  "<div class='col-xs-12 col-sm-12 col-md-12'>"
                . '<form action="cesta.php" method="post">'
                . '<input type="submit" name="vaciar" value="Vaciar cesta" class="btn btn-primary btn-lg gris"></input>'
                . '<input type="submit" name="tramitar" value="Tramitar pedido" class="btn btn-primary btn-lg separacion"></input>'
                . '</form>'
                . "</div>";
        }
    }

    //Función que muestra la lista de pizzas, pero sin el botón para eliminarla de la lista
    public function muestraSinBotonQuitar()
    {
        // Si la cesta está vacía, mostramos un mensaje
        if ((count($this->productosSeleccionados) == 0) && (count($this->cursosSeleccionados) == 0))
            print "<p>Cesta vacía</p>";
        //  y si no está vacía, mostramos su contenido
        else {
            if(count($this->productosSeleccionados) > 0) {
               echo " <table class='table table-striped table-condensed table-bordered'>
                <thead>
                  <tr>
                    <th>Marca</th>
                    <th>Producto</th>
                    <th>Precio</th>
                  </tr>
                </thead>
                <tbody>";
                foreach ($this->productosSeleccionados as $producto) {
                    echo "<tr>
                    <td>" . $producto->getMarca()."</td>
                    <td>".$producto->getNombre()."</td>
                    <td>".$producto->getPrecio()."€</td>
                  </tr>";
                } 
                echo "</tbody>
                </table>";   
            }
            if(count($this->cursosSeleccionados) > 0) {
                echo " <table class='table table-striped'>
                <thead>
                  <tr>
                    <th>Título del curso</th>
                    <th>Autor</th>
                    <th>Precio</th>
                  </tr>
                </thead>
                <tbody>";
                foreach ($this->cursosSeleccionados as $curso) {
                    echo "<tr>
                    <td>" . $curso->getTitulo()."</td>
                    <td>".$curso->getAutor()."</td>
                    <td>".$curso->getPrecio()."€</td>
                  </tr>";
                }
                echo "</tbody>
                </table>"; 
            }
            echo "<table class='rosa_tabla table table-striped derecha'>"
                . "<tr>"
                . "<td colspan='2' class='text-right'>TOTAL: </td>"
                . "<td>"
                . number_format($this->get_coste(),2)
                . "€</td>"
                ."</tr>"
                ."<tr>"
                . "<td colspan='2' class='text-right'>IVA: </td><td>"
                . number_format(($this->get_coste()*0.21),2)
                ."</td></tr><tr>"
                . "<td colspan='2' class='text-right'>Subtotal: </td><td>"
                . number_format((($this->get_coste()*0.21)+ $this->get_coste()),2)
                ."</td></tr>"
                ."</table>";
            print "</ul>";
            
        
    }
}


    // -------------------------------------------------------------------------- FUNCIONES PARA LOS CURSOS------------------------------------------------------------------
    // Introduce un nuevo artículo en la cesta de la compra
    public function nuevo_curso($codigo)
    {
        $curso = BD::obtieneCurso($codigo);
        $existe=false;
        foreach ($this->cursosSeleccionados as $c) {
            if($c->getCodigo()==$codigo){
                $existe=true;
            }
        }
        if(!$existe) {
            $this->cursosSeleccionados[] = $curso;
        }
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