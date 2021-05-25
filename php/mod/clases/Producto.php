<?php

class Producto{
    private $codigo;
    private $nombre;
    private $precio;
    private $descripcion;
    private $marca;
    private $categoria;
    
    function __construct($row) {
        $this->codigo = $row['codigo'];
        $this->nombre = $row['nombre'];
        $this->precio = $row['precio'];
        $this->descripcion = $row['descripcion'];
        $this->marca = $row['marca'];
        $this->categoria = $row['categoria'];
    }
  
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getMarca() {
        return $this->marca;
    }

    function getCategoria() {
        return $this->categoria;
    }


    
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
}

?>