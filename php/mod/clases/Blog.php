<?php 

class Curso{
    private $codigo;
    private $categoria;
    private $autor;
    private $titulo;
    private $contenido;
    private $fechaPublicacion;
    
    function __construct($row){
        $this->codigo=$row['id_curso'];
        $this->categoria=$row['id_categoriaB'];
        $this->autor=$row['autor'];
        $this->titulo=$row['titulo'];
        $this->contenido=$row['contenido'];
        $this->fechaPublicacion=$row['fecha_publicacion'];
    }
    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of autor
     */ 
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     * @return  self
     */ 
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of contenido
     */ 
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set the value of contenido
     *
     * @return  self
     */ 
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get the value of fechaPublicacion
     */ 
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set the value of fechaPublicacion
     *
     * @return  self
     */ 
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }
    }