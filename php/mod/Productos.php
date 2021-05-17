<?php

class Producto{
    private $nombre;
    private $precio;
    private $descripcion;
    private $Marca;
    private $Categoria;
    
    function __construct($row) {
        $this->nombre = $row['nombre'];
        $this->precio = $row['precio'];
        $this->descripcion = $row['descripcion'];
        $this->Marca = $row['Marca'];
        $this->Categoria = $row['Categoria'];
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
        return $this->Marca;
    }

    function getCategoria() {
        return $this->Categoria;
    }

    function setCodigo($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setMarca($Marca) {
        $this->Marca = $Marca;
    }

    function setCategoria($Categoria) {
        $this->Categoria = $Categoria;
    }
    
}

?>