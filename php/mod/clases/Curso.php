<?php 

class Curso{
    private $codigo;
    private $categoria;
    private $lema;
    private $titulo;
    private $autor;
    private $nivel;
    private $resumen;
    private $descripcion;
    private $precio;
    private $video;
    private $valoracion;


    function __construct($row){
        $this->codigo=$row['id_curso'];
        $this->categoria=$row['id_categoria'];
        $this->lema=$row['lema'];
        $this->titulo=$row['titulo'];
        $this->autor=$row['autor'];
        $this->nivel=$row['nivel'];
        $this->resumen=$row['resumen'];
        $this->descripcion=$row['descripcion'];
        $this->precio=$row['precio'];
        $this->video=$row['video_promocional'];
        $this->valoracion=$row['valoracion_media'];
        
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
     * Get the value of lema
     */ 
    public function getLema()
    {
        return $this->lema;
    }

    /**
     * Set the value of lema
     *
     * @return  self
     */ 
    public function setLema($lema)
    {
        $this->lema = $lema;

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
     * Get the value of nivel
     */ 
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set the value of nivel
     *
     * @return  self
     */ 
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get the value of resumen
     */ 
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set the value of resumen
     *
     * @return  self
     */ 
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of video
     */ 
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set the value of video
     *
     * @return  self
     */ 
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get the value of valoracion
     */ 
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * Set the value of valoracion
     *
     * @return  self
     */ 
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;

        return $this;
    }
}
