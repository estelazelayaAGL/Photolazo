<?php

class Comentario {

    private $id_comentario;
    private $id_blog;
    private $autor;
    private $correo;
    private $contenido;
    private $fecha_publicacion;

    function __construct($row) {
        $this->id_comentario = $row['id_comentario'];
        $this->id_blog = $row['id_blog'];
        $this->autor = $row['autor'];
        $this->correo = $row['correo'];
        $this->contenido = $row['contenido'];
        $this->fecha_publicacion = $row['fecha_publicacion'];
    }

    /**
     * Get the value of id_comentario
     */ 
    public function getId_comentario()
    {
        return $this->id_comentario;
    }

    /**
     * Set the value of id_comentario
     *
     * @return  self
     */ 
    public function setId_comentario($id_comentario)
    {
        $this->id_comentario = $id_comentario;

        return $this;
    }

    /**
     * Get the value of id_blog
     */ 
    public function getId_blog()
    {
        return $this->id_blog;
    }

    /**
     * Set the value of id_blog
     *
     * @return  self
     */ 
    public function setId_blog($id_blog)
    {
        $this->id_blog = $id_blog;

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
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

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
     * Get the value of fecha_publicacion
     */ 
    public function getFecha_publicacion()
    {
        return $this->fecha_publicacion;
    }

    /**
     * Set the value of fecha_publicacion
     *
     * @return  self
     */ 
    public function setFecha_publicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }
}

?>