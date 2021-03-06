CREATE DATABASE photolazo DEFAULT CHARACTER SET utf8mb4 ;
USE photolazo;

-- Creación de las tablas
CREATE TABLE usuarios(
    id_usuario VARCHAR(6) NOT NULL,
    tipo_usuario BOOLEAN NOT NULL,
    nombre VARCHAR(35) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    user_login VARCHAR(35) NOT NULL,
    contrasena VARCHAR(60) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    correo VARCHAR(40) NOT NULL,
    telefono INT(12) NOT NULL,
    direccion VARCHAR(35) NOT NULL,
    codigo_postal INT NOT NULL,
    ciudad VARCHAR(20) NOT NULL,
    pais VARCHAR(35) NOT NULL,
    CONSTRAINT pk_usuarios PRIMARY KEY (id_usuario)
)ENGINE = INNODB;

CREATE TABLE categorias(
    id_categoria VARCHAR(6) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY (id_categoria)
)ENGINE = INNODB;
 

CREATE TABLE marcas(
    id_marca VARCHAR(6) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    CONSTRAINT pk_marca PRIMARY KEY (id_marca)
)ENGINE = INNODB;

CREATE TABLE metodoPago(
    id_metodo VARCHAR(6) NOT NULL,
    titular VARCHAR(100) NOT NULL,
    CONSTRAINT pk_mpt PRIMARY KEY (id_metodo)
)ENGINE = INNODB;


CREATE TABLE metodoPagoTarjeta(
    id_metodo VARCHAR(6) NOT NULL,
    numero_tarjeta VARCHAR(25) NOT NULL,
    mes_caducidad INT NOT NULL CHECK (mes_caducidad IN (1,2,3,4,5,6,7,8,9,10,11,12)),
    -- QUITAR
    ano_caducidad YEAR NOT NULL,
    cvc INT NOT NULL CHECK (cvc > 3),
    CONSTRAINT pk_mpt PRIMARY KEY (id_metodo),
CONSTRAINT fkmpt_MP FOREIGN KEY (id_metodo) REFERENCES metodoPago(id_metodo) 
)ENGINE = INNODB;

CREATE TABLE metodoPagoCuenta(
    id_metodo VARCHAR(6) NOT NULL,
    iban   VARCHAR(24) NOT NULL,
    bic    VARCHAR(11) NOT NULL,
    CONSTRAINT pk_mpc PRIMARY KEY (id_metodo),
CONSTRAINT fkmpc_MP FOREIGN KEY (id_metodo) REFERENCES metodoPago(id_metodo) 
)ENGINE = INNODB;


CREATE TABLE productos(
id_producto VARCHAR(6) NOT NULL,
id_categoria VARCHAR(6) NOT NULL,
id_marca VARCHAR(6) NOT NULL,
nombre VARCHAR(25) NOT NULL,
unidades INT NOT NULL,
precio FLOAT NOT NULL, 
descripcion VARCHAR(25) NULL,
valoracion_media FLOAT NOT NULL,
CONSTRAINT pk_productos PRIMARY KEY (id_producto),
CONSTRAINT fkCategoriaProd FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria),
CONSTRAINT fkMarcaProd FOREIGN KEY (id_marca) REFERENCES marcas(id_marca) 
)ENGINE = INNODB;


CREATE TABLE cursos(
id_curso VARCHAR(6) NOT NULL,
id_categoria VARCHAR(6) NOT NULL,
lema VARCHAR(100) NOT NULL,
titulo VARCHAR(60) NOT NULL,
autor VARCHAR(30) NOT NULL,
nivel VARCHAR(30) NOT NULL,
resumen VARCHAR(200) NOT NULL,
descripcion TEXT NOT NULL,
precio FLOAT NOT NULL, 
video_promocional VARCHAR(100) NOT NULL,
valoracion_media FLOAT NOT NULL,
CONSTRAINT pk_curso PRIMARY KEY (id_curso),
CONSTRAINT fkCategoriaCurso FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) 
)ENGINE = INNODB;


CREATE TABLE UsuarioCurso(
id_usuario VARCHAR(6) NOT NULL,
id_curso VARCHAR(6) NOT NULL,
precio FLOAT NOT NULL, 
fecha_compra DATE NOT NULL,
valoracion FLOAT NOT NULL,
id_metodo VARCHAR(6) NOT NULL,
CONSTRAINT pk_usuarioCurso PRIMARY KEY (id_usuario,id_curso),
CONSTRAINT fkCursoUC FOREIGN KEY (id_curso) REFERENCES cursos(id_curso), 
CONSTRAINT fkMP_UC FOREIGN KEY (id_metodo) REFERENCES metodoPago(id_metodo) 
)ENGINE = INNODB;


CREATE TABLE pedidos(
id_pedido VARCHAR(6) NOT NULL,
id_usuario VARCHAR(6) NOT NULL,
id_metodo VARCHAR(6) NOT NULL,
fecha_pedido DATE NOT NULL,
fecha_entrega DATE NOT NULL,
estado VARCHAR(50) NOT NULL CHECK (estado IN ('Pendiente de pago','Pendiente de envío','En tránsito','Entregado')),
total FLOAT NOT NULL,
comentario VARCHAR(50) NULL,
CONSTRAINT pk_pedido PRIMARY KEY (id_pedido),
CONSTRAINT fkUsuarioPedido FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
CONSTRAINT fkMP_Pedido FOREIGN KEY (id_metodo) REFERENCES metodoPago(id_metodo)  
)ENGINE = INNODB;


CREATE TABLE lineaFacturacion(
    id_lineafacturacion VARCHAR(6) NOT NULL,
    id_pedido VARCHAR(6) NOT NULL,
    id_producto VARCHAR(5) NOT NULL,
    cantidad INT NOT NULL,
    precio_venta FLOAT NOT NULL,
    porcentaje_descuento FLOAT NOT NULL,
    total FLOAT NOT NULL,
    CONSTRAINT pk_lfacturacion PRIMARY KEY (id_lineafacturacion,id_pedido,id_producto),
CONSTRAINT fklfPedido FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
CONSTRAINT fklfProducto FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
)ENGINE = INNODB;

CREATE TABLE resenas(
    
    id_producto VARCHAR(6) NOT NULL,
    valoracion INT NOT NULL CHECK (valoracion IN (1,2,3,4,5) ),
    CONSTRAINT pk_resena PRIMARY KEY (id_pedido,id_producto),
    CONSTRAINT fkresenaProd FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
    CONSTRAINT fkresenaPedido FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido)
)ENGINE = INNODB;


CREATE TABLE categoriasBlog(
    id_categoriaB VARCHAR(6) NOT NULL,
    CONSTRAINT pk_cBlog PRIMARY KEY (id_categoriaB),
    nombre VARCHAR(30) NOT NULL
)ENGINE = INNODB;
 
CREATE TABLE blogs(
    id_blog VARCHAR(6) NOT NULL,
    id_categoriaB VARCHAR(6) NOT NULL,
    autor VARCHAR(60) NOT NULL,
    titulo VARCHAR(60) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion DATE NOT NULL,
    CONSTRAINT pk_blog PRIMARY KEY (id_blog),
    CONSTRAINT fkblogCategoria FOREIGN KEY (id_categoriaB) REFERENCES categoriasBlog(id_categoriaB)
)ENGINE = INNODB;


CREATE TABLE comentarios(
    id_comentario VARCHAR(6) NOT NULL,
    id_blog VARCHAR(6) NOT NULL,
    autor VARCHAR(60) NOT NULL,
    correo VARCHAR(60) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion DATE NOT NULL,
    CONSTRAINT pk_comentarios PRIMARY KEY (id_comentario),
    CONSTRAINT fkcomentBlog FOREIGN KEY (id_blog) REFERENCES blogs(id_blog)
)ENGINE = INNODB;


CREATE TABLE etiquetas(
    id_etiqueta VARCHAR(6) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    CONSTRAINT pk_etiqueta PRIMARY KEY (id_etiqueta)
)ENGINE = INNODB;


CREATE TABLE etiquetaBlog(
    id_blog VARCHAR(6) NOT NULL,
    id_etiqueta VARCHAR(6) NOT NULL,
    CONSTRAINT pk_etiquetaBlog PRIMARY KEY (id_etiqueta,id_blog),
    CONSTRAINT fketiBlog FOREIGN KEY (id_blog) REFERENCES blogs(id_blog),
    CONSTRAINT fketiqueta FOREIGN KEY (id_etiqueta) REFERENCES etiquetas(id_etiqueta)
)ENGINE = INNODB;



