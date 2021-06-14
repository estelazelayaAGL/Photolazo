-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2021 a las 20:40:13
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `photolazo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogs`
--

CREATE TABLE `blogs` (
  `id_blog` int(6) NOT NULL,
  `id_categoriaB` varchar(6) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha_publicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `blogs`
--

INSERT INTO `blogs` (`id_blog`, `id_categoriaB`, `autor`, `titulo`, `contenido`, `fecha_publicacion`) VALUES
(2, 'ENT002', 'María la del Barrio', '¡Ay María, qué puntería!', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n', '2021-06-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` varchar(6) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
('CAT001', 'Cámaras'),
('CAT002', 'Objetivos'),
('CAT003', 'Iluminación'),
('CAT004', 'Libros'),
('CAT005', 'Mochilas'),
('CAT100', 'Retrato'),
('CAT101', 'Naturaleza'),
('CAT212', 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriasblog`
--

CREATE TABLE `categoriasblog` (
  `id_categoriaB` varchar(6) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriasblog`
--

INSERT INTO `categoriasblog` (`id_categoriaB`, `nombre`) VALUES
('ENT001', 'Cursos'),
('ENT002', 'Accesorios'),
('ENT003', 'Materiales'),
('ENT004', 'Tips/Consejos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(6) NOT NULL,
  `id_blog` int(6) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha_publicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` varchar(6) NOT NULL,
  `id_categoria` varchar(6) NOT NULL,
  `lema` varchar(100) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `nivel` varchar(30) NOT NULL,
  `resumen` varchar(200) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` float NOT NULL,
  `video_promocional` varchar(100) NOT NULL,
  `valoracion_media` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `id_categoria`, `lema`, `titulo`, `autor`, `nivel`, `resumen`, `descripcion`, `precio`, `video_promocional`, `valoracion_media`) VALUES
('CUR001', 'CAT001', 'El mejor curso para aprender a manejar cámaras DSLR', 'Aprende a manejar tu cámara DSLR desde 0', 'Estela Rosinda Zelaya Lazo', 'Principiante', 'Curso compuesto por 3 módulos: Principios básicos, Manejo de la cámara, Manejo de accesorios', 'Curso compuesto por 3 módulos: Principios básicos (conceptos esenciales de fotografía), Manejo de la cámara (consejos prácticos para aprender a dominar la cámara), Manejo de accesorios (desde trípodes hasta flash profesional)', 50, 'aprendemanejofoto', 0),
('CUR235', 'CAT001', 'Vive la fotografía', 'El arte de fotografiar lo abstracto', 'Jaime Baires', 'Principiante', 'Es un curso dinerñado para que todos puedan tener una visión de la fotografía abstracta', 'Requerimientos: Es recomendable tener una cámara que permita el modo manual / análoga para aprovechar de forma óptima el curso.\r\n\r\nSi deseas realizarlo con tu smartphone, también es posible. Verifica que tenga modo manual para que puedas aprovechar mucho más los contenidos del curso. ', 40, 'video', 0),
('ETC998', 'CAT001', 'El futuro de la fotografía está en tus manos', 'Perfeccionamiento fotografía', 'Juan Calvino', 'Intermedio', 'Diseñado para fotógrafos que quieran reforzar y ampliar conocimientos sobre la técnica fotográfica y en el manejo tanto de la luz disponible como de la luz fotográfica.', 'Durante el curso abordaremos la realización de un proyecto fotográfico en el que trabajaremos en grupo, desde la primera idea hasta la publicación final del trabajo.\r\n\r\nEditaremos las imágenes obtenidas en las prácticas tutorizadas en el entorno Photoshop CC. Partiendo desde cero conoceremos Adobe Bridge como catálogo de imágenes, Adobe Camera Raw como revelador/conversor RAW y Photoshop para la producción final de las fotografías y maquetación del trabajo.', 150, 'hola', 0),
('NAT002', 'CAT101', 'Desarrolla tu propio estilo a la hora de capturar paisajes', 'Fotografía de paisaje y naturaleza', 'Mario Valiente', 'Intermedio', 'Según el fotógrafo y videógrafo Alvaro Valiente, no existe mayor obra de arte que la naturaleza. Si tú eres de la misma opinión y deseas capturar esa belleza con tu cámara, aquí encontrarás la sinergi', 'En este curso aprenderás el proceso creativo necesario para realizar fotografías de naturaleza y paisaje. Verás distintas maneras de retratar un mismo espacio, jugando con los puntos de vista y algunos trucos que te mostrará Alvaro. Al finalizar, tendrás tu mirada entrenada y las claves para desarrollar tu propio estilo.\r\nEmpezarás conociendo mejor a Alvaro y su trayectoria en la fotografía. Te mostrará quién le ha influenciado y de quién obtiene referencias a la hora de trabajar y editar. Además, te hará un pequeño recorrido sobre lo que verás en este curso.\r\n\r\nA continuación, verás los conceptos básicos de fotografía que tendrás que dominar para poder enfrentarte a cualquier situación. Una vez repasada la teoría, Alvaro te mostrará el equipo que usa y cómo sacarle el mayor partido al tuyo. Así, prepararás todo lo imprescindible antes de salir a la aventura.\r\n\r\nHa llegado el momento de poner en práctica todo lo aprendido: saldrás al lugar que hayas elegido y empezarás a tomar fotos. Aprenderás distintas aproximaciones a la hora de fotografiar un espacio, trucos muy simples para mejorar tus imágenes y cómo adaptarte a cada situación.', 110, 'elvideo', 0),
('NAT003', 'CAT101', 'Un viaje a través del espacio.', 'Fotografía astronómica y atmosférica', 'Esteban Quito', 'Experto', 'Con este curso de Fotografía astronómica y atmosférica con prácticas formativas de PhotoLazo podrás introducirte en el estudio de cuestiones como el proceso astrofotográfico, la fotoimpresión, los aca', 'Con este curso de Fotografía astronómica y atmosférica con prácticas formativas de PhotoLazo podrás introducirte en el estudio de cuestiones como el proceso astrofotográfico, la fotoimpresión, los acabados o la foto sin telescopio.\r\nTodo ello y mucho más con esta completa iniciativa formativa cuya teoría podrás hacer desde casa, sin horarios estrictos y con la ayuda de nuestros tutores.\r\nAsí, una vez apruebes la parte teórica que harás a distancia, contando con el apoyo de un tutor personal, podrás disfrutar de tu periodo de prácticas presenciales en un centro de trabajo para seguir completando lo aprendido.\r\nPhotoLazo te ayuda a distinguirte y a que destaques con un completo currículo. Pide información y no dejes pasar la oportunidad. ', 250, 'video', 0),
('NAT010', 'CAT101', 'Un viaje para retratar el territorio, su biodiversidad y cultura', 'Fotografía de Naturaleza', 'Elena Ramírez', 'Intermedio', 'Este curso está inspirado en un viaje por diversos ecosistemas naturales, su biodiversidad, sus habitantes, sus paisajes y su cultura a través de la fotografía.', 'La fotografía es una ventana expresiva de asombro, experimentación y relación con la naturaleza. Es una oportunidad para dar una mirada artística y reflexiva a nuestra cotidianidad y nuestros viajes, así como para reconocer el territorio y sus elementos naturales.\r\nEs una alternativa maravillosa de conexión con el entorno natural y todos los seres que lo habitan, y de generar una relación estrecha entre el fotógrafo y aquello que ve y retrata a través de su cámara. \r\nA través de este curso de 12 horas nos adentraremos en el aprendizaje práctico de la fotografía de naturaleza, la composición de imágenes, el trabajo fotográfico en campo, la fotografía de fauna, flora y paisajes, así como el revelado fotográfico.', 69, 'video', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id_etiqueta` varchar(6) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetasblog`
--

CREATE TABLE `etiquetasblog` (
  `id_blog` int(6) NOT NULL,
  `id_etiqueta` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedidos`
--

CREATE TABLE `lineaspedidos` (
  `id_lineafacturacion` int(6) NOT NULL,
  `id_pedido` int(6) NOT NULL,
  `id_producto` varchar(6) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` float NOT NULL,
  `porcentaje_descuento` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` varchar(6) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`) VALUES
('MRC001', 'Nikon'),
('MRC002', 'Canon'),
('MRC003', 'Fujifilm'),
('MRC004', 'Olympus'),
('MRC005', 'Sony'),
('MRC006', 'Tamron'),
('MRC007', 'Sigma'),
('MRC008', 'Godox'),
('MRC009', 'Yongnuo'),
('MRC010', 'Manfrotto'),
('MRC011', 'Sin marca'),
('MRC012', 'Peak'),
('MRC013', 'Lowepro'),
('MRC212', 'K&F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodospagos`
--

CREATE TABLE `metodospagos` (
  `id_metodo` int(6) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `iban` varchar(24) DEFAULT NULL,
  `bic` varchar(11) DEFAULT NULL,
  `numero_tarjeta` varchar(25) DEFAULT NULL,
  `mes_caducidad` int(11) DEFAULT NULL,
  `ano_caducidad` year(4) DEFAULT NULL,
  `cvc` int(11) DEFAULT NULL,
  `tipoMetodo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(6) NOT NULL,
  `id_usuario` int(6) NOT NULL,
  `id_metodo` int(6) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estado` varchar(50) NOT NULL CHECK (`estado` in ('Pendiente de pago','Pendiente de envío','En tránsito','Entregado')),
  `total` float NOT NULL,
  `comentario` varchar(50) DEFAULT NULL,
  `personaRecepcion` varchar(100) NOT NULL,
  `direccionEntrega` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` varchar(6) NOT NULL,
  `id_categoria` varchar(25) NOT NULL,
  `id_marca` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `unidades` int(11) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  `valoracion_media` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `id_marca`, `nombre`, `unidades`, `precio`, `descripcion`, `valoracion_media`) VALUES
('PRO002', 'CAT001', 'MRC002', 'CANON EOS 2000D', 15, 2560.3, 'Cuerpo / Kit: Solo cuerpo Pantalla móvil: No Wifi: Sí Microfono externo: No Video 4K: No Tamaño de sensor: APS-C', 5),
('PRO003', 'CAT001', 'MRC002', 'CANON EOS 5D-MARK-IV', 20, 5254.5, 'Cuerpo / Kit: Solo cuerpo Pantalla móvil: No Wifi: Sí Microfono externo: Sí Video 4K: Sí Tamaño de sensor: Sensor completo', 4),
('PRO004', 'CAT001', 'MRC001', 'NIKON D5600', 15, 5254.5, 'Cuerpo / Kit: Solo cuerpo Pantalla móvil: Sí Wifi: Sí Microfono externo: Sí Video 4K: No Tamaño de sensor: APS-C', 3),
('PRO005', 'CAT001', 'MRC003', 'FUJI FINEPIX X-E4 SILVER', 3, 890.9, 'Cuerpo / Kit: Sólo cuerpo Pantalla móvil: Sí Video 4K: Sí Wifi: Sí Sensor completo: No', 5),
('PRO006', 'CAT001', 'MRC001', 'NIKON Z7', 2, 500, 'Cuerpo / Kit: Sólo cuerpo Micrófono externo: Sí Pantalla móvil: Sí Video 4K: Sí Wifi: Sí Sensor completo: Sí', 5),
('PRO007', 'CAT001', 'MRC002', 'CANON EOS R', 6, 1760.6, 'Cuerpo / Kit: Sólo cuerpo\r\nMicrófono externo: Sí\r\nPantalla móvil: Sí\r\nVideo 4K: Sí\r\nWifi: Sí\r\nSensor completo: Sí', 4),
('PRO008', 'CAT002', 'MRC006', 'TAMRON AF 17-35', 2, 1349.5, 'Focal: Angular - Tele\r\nMacro: No\r\nDescentrable: No', 5),
('PRO009', 'CAT002', 'MRC006', 'TAMRON 18-400mm F3.5-6.3 ', 4, 555.55, 'Lente con montura F / formato DX Pasa de un gran angular a un ultratelefoto 18-400mm Ideal para paisaje, arquitectura, deportes, aves, macro... Motor de regulación de torsión HLD para autoenfoque Construcción externa resistente a la humedad El primer ultra teleobjetivo zoom todo en uno del mundo', 4),
('PRO010', 'CAT002', 'MRC002', 'CANON EF 100/2.8', 3, 950.5, 'Focal: Fijo Macro: Sí Descentrable: No', 5),
('PRO011', 'CAT002', 'MRC001', 'NIKON AFS 70-200mm f2.8E ', 1, 2763.53, 'F-Mount Lens / FX Format Rango de apertura: f / 2.8 a f / 22 Seis elementos de dispersión extra-baja Elementos de Fluorita e HRI Recubrimiento Nano Crystal & Super Integrated Elementos frontales y traseros revestidos de flúor Silent Wave Motor y MF Override Estabilización de imagen', 5),
('PRO013', 'CAT002', 'MRC005', 'SONY OBJETIVO 85MM F1.8 F', 4, 369.5, 'Lente con montura E / Formato de fotograma completo Rango de apertura: f / 1.8 a f / 22 Un elemento de dispersión extra baja Motor AF lineal doble Impresionante efecto bokeh para retratos Diseño compacto y ligero para una buena portabilidad Compatible con cámaras APS-C', 5),
('PRO014', 'CAT003', 'MRC008', 'GODOX KIT DE ALETAS/GELES', 15, 29, 'Se acoplan al frontal del AD400 Pro Las aletas orientables permiten controlar la luz Con los geles podemos cambiar el color de la escena Los accesorios se pueden usar en conjunto o separadamente', 3),
('PRO015', 'CAT003', 'MRC008', 'GODOX VENTANA SOFTBOX SB-', 5, 58, 'Interior plata reflectante granulado. Doble difusor y grid. Adaptador Bowens incluído.', 5),
('PRO016', 'CAT003', 'MRC009', 'YONGNUO YN600L 5500K LUZ ', 1, 99.2, 'Temperatura de color variable 3200-5500K Modos de atenuación áspera y fina Acepta baterías de la serie Sony NP-F Enfriado por ventilador Incluye control remoto IR de 3 canales Manija y trípode-Montable Dos placas de filtro incluidas Adaptador de CA opcional', 0),
('PRO017', 'CAT003', 'MRC010', 'LASTOLITE (DE MANFROTTO) ', 5, 144.9, 'Interior blanco. Difusor interior y exterior. Montura ajustable para adaptarse a flashes de diferente tamaño.', 5),
('PRO019', 'CAT002', 'MRC002', 'CANON EF 17-40/4', 2, 555.55, 'Focal: Angular - angular Macro: No Descentrable: No', 5),
('PRO020', 'CAT001', 'MRC001', 'NIKOND330', 10, 12, 'PRUEBA', 0),
('PRO022', 'CAT005', 'MRC012', 'PEAK DESIGN EVERY', 2, 89.1, '- Dimensiones externas: 30,5 x 19,5 x 11 cm.\r\n\r\n- Dimeniones internas: 19,8 x 8,9 x 6,4 cm.\r\n\r\n- Volumen máximo: 3 L\r\n\r\n- Peso: 450 gr.\r\n\r\n- Material: nylon.\r\n\r\n- Color: negro.', 5),
('PRO023', 'CAT005', 'MRC012', 'PEAK DESIGN EVERY', 10, 269, '- Dimensiones externas: 36 x 62 x 19.8 cm.\r\n\r\n- Dimeniones internas: 31 x 60 x 17 cm.\r\n\r\n- Volumen máximo: 30 L\r\n\r\n- Peso: 1.8 kg.\r\n\r\n- Material: nylon.\r\n\r\n- Color: azul.', 5),
('PRO024', 'CAT005', 'MRC013', 'LOWEPRO PROTACTIC', 7, 49, '- Dimensiones externas: 15 x 12,5 x 18,5 cm.\r\n\r\n- Dimensiones internas: 11 x 10,5 x 16 cm.\r\n\r\n- Peso: 380 gr.\r\n\r\n- Volumen máximo: 1.5L', 4),
('PRO025', 'CAT005', 'MRC013', 'LOWEPRO PRO TREKK', 2, 255, '- Dimensiones externas: 35 x 25 x 49 cm.\r\n\r\n- Dimensiones internas: 32 x 16 x 46 cm.\r\n\r\n- Dimensiones compartimento ordenador portátil: 32 x 3 x 34 cm.\r\n\r\n- Dimensiones compartimento táblet: 22 x 1,5 x 26 cm.\r\n\r\n- Volumen: 32 litros.\r\n\r\n- Peso: 2,7 kg.', 5),
('PRO777', 'CAT001', 'MRC003', 'FUJIFILM FinePix S6500-FD', 212, 120, 'Megapíxeles : 6.3 Conector : USB Color : Negro Tipo de cámara : Cámara compacta Modelo del objetivo / lente : Fujinon 28–300 mm f/2.8–4.9 Marca del objetivo : Fujifilm Estabilizador de imagen : No Distancia focal : 28–300 mm Sólo la carcasa : No Formato del sensor Touch : Otro Puerto HDMI : Ninguno Apertura máxima del objetivo : f/2.8–4.9 Objetivo incluido : Sí Marca : Fujifilm Peso : 700 g Altura : 98 cm Anchura : 131 cm Profundidad : 128 cm ', 0),
('PRO778', 'CAT001', 'MRC003', 'Fujifilm X-T4 Plata - Cue', 23, 1120, 'Estabilización de imagen IBIS integrada en el cuerpo de 6.5 pasos Cámara sin espejo APS-C perfecta para fotografía y vídeo Sensor de 4ª generación X-Trans CMOS 4 Nuevos modos de simulación de película ETERNA Bleach Bypass y Classic Neg Cuerpo estanco contra el clima, el polvo y la humedad Sistema de AF capaz de funcionar hasta -6.0EV (baja iluminación)', 0),
('PRO779', 'CAT002', 'MRC001', 'Nikon AF-S DX NIKKOR 18-2', 5, 370, '    Color : Negro     Modelo : Nikon AF-S DX Nikkor 18-200mm f/3.5-5.6G ED VR II     Distancia focal : 18-200mm     Estabilizador de imagen : Sí     Apertura máxima del objetivo : f/3.5-5.6     Tipo de montaje : Nikon F     Marca : Nikon     Peso : 565 g ', 0),
('PRO780', 'CAT002', 'MRC001', 'Nikon AF Nikkor 24-85mm f', 48, 299.85, '    Modelo : Nikon F 24-85mm f/2.8-4     Apertura máxima del objetivo : f/2.8-4     Color : Negro     Distancia focal : 24-85mm     Estabilizador de imagen : No     Tipo de montaje : F     Marca : Nikon     Peso : 545 g ', 0),
('PRO781', 'CAT002', 'MRC002', 'Canon EF 14mm 1:2.8', 8, 700, ' El color del producto negro Láminas de abertura 5 Número máximo de la apertura de la cámara (número f) 22 EAN 4960999213668 Color negro Estructura del objetivo 14/10 ', 0),
('PRO782', 'CAT002', 'MRC005', 'Sony 70-300mm 1:4.5-5.6', 20, 850, ' El color del producto negro Rango de longitudes focales 70 - 300 Compatibilidad con las marcas de cámaras Sony Estructura del objetivo 13/16 Número mínimo de parada 29 Número máximo de la apertura de la cámara (número f) 5,6 Peso 854.0 Gram Largo 14.3 Centimeter Estabilizador de imagen Sí Tipo de montaje bayoneta ', 0),
('PRO783', 'CAT002', 'MRC005', 'Sony E 18-105 mm F4.0 G O', 8, 400, 'EAN (principal) 4905524956672 Rango de la distancia focal 18 - 105 mm Año de publicación 2013 Montura Sony E-mount Número de modelo SELP18105G Peso 427 g Tipo de lente Standard-Zoom Tamaño del filtro 72 mm Diámetro de apertura mínimo 4.0000 Diámetro máximo de apertura 22.0000 Tamaño máximo 0.11 x Fecha de lanzamiento 16/10/2013 Distancia mínima de enfoque 0.45 m Longitud focal mínima 2.7 cm Distancia focal máxima 15.8 cm Enfoque manual sí ', 0),
('PRO784', 'CAT002', 'MRC006', 'Objetivo TAMRON 18-200/3.', 45, 400, 'Cobertura para sensores APS-C  Apertura variable 3.5-5.6  Distancia mínima de enfoque de 49 cm  Ratio máximo de ampliación 1:4  Parasol incluido ', 0),
('PRO800', 'CAT003', 'MRC008', 'Flash Strobo-Pro', 47, 59, 'Flash de Estudio Strobo-Pro XZ-200A Series, 200w/s Nº guía 45 ISO 100 1m., sistema 100% compatible de accesorios, robusta carcasa de alumínio, comprobado diseño electrónico por su confiabilidad y duración, controles análogos y componentes de primera calidad, potencia de salida consistente en cada disparo con un error de +-1%, control de potencia contínuo 1/1--1/32, tubo de flash intercambiable por el usuario, luz de modelado proporcional total con interruptor independiente de flash, ventilador frontal forzado para una mejor disipacíon del calor, señal auditiva y visual de reciclado completado, fotocélula incorporada con interruptor de desconexión, circuito protector de sobrecarga y calentamiento. ', 0),
('PRO801', 'CAT003', 'MRC009', 'ARRI Sky­Panel S30-C', 25, 999, '      L0.0007712     Apertura de luz: 355 x 300 mm     Temperatura de color ajustable continuamente de 2800ºK a 10000ºK     Comparable a una lámpara halógena de 2000 W y alcanza un valor de CRI superior a 95 y un valor de TLCI superior a 90     Ángulo del haz: 115º', 0),
('PRO802', 'CAT003', 'MRC009', 'YONGNUO YN200 Kit de flas', 78, 145, 'Modelo: YN200 Salida de flash: 200 W Guía No .: 60 a ISO100 (usando el reflector) Temperatura de color: 5600K Fuente de alimentación: batería de litio de 14.4V 2900mAh Tiempo de reciclaje: aproximadamente 0.01-2s Ajuste de potencia: 1/1 ~ 1/64 Destellos de potencia total: aproximadamente 500 veces Modo de disparo: modo esclavo de radio (YN560), modo de transmisión óptica (SC / SN), S1, S2, disparador de interfaz síncrona Modo de flash: TTL, M, Multi Interfaz de sincronización: 3.5 mm Interfaz de actualización: Micro-USB Tamaño del artículo: aproximadamente 20.5 * 7.8 * 5.3cm / 8.1 * 3.1 * 2.1 pulgadas (sin tubo de flash) Peso del artículo: 540 g / 19 oz (sin batería y tubo de flash) Tamaño del paquete: 26.2 * 16.7 * 10.3cm / 10.3 * 6.6 * 4.1inch Peso del paquete: 1400g / 49,4 oz', 0),
('PRO803', 'CAT003', 'MRC010', ' Man­frotto LBA­G110 Bag ', 56, 50, '      Para hasta 3 soportes de iluminación     Para, por ejemplo, 3 piezas 1004BAC o 1005BAC     Diseño de nylon duradero     Repelente al agua: Perfecta para condiciones climáticas impredecibles     Correa para el hombro cómoda y acolchada', 0),
('PRO804', 'CAT003', 'MRC010', ' Man­frotto 008CSU Steel ', 10, 140, '      Con 1 pata del trípode regulable para terrenos desnivelados     Altura máxima: 216 cm     Altura mínima: 132 cm     Longitud de transporte: 116 cm     Perno de conexión: 1 1/8\" (28mm) adaptador TV, perno de 5/8\" (16mm) con rosca de 3/8\"', 0),
('PRO805', 'CAT004', 'MRC011', 'El ojo del fotógrafo', 150, 25, 'El diseño es el factor más importante para crear una buena fotografía. La capacidad para intuir el potencial de una imagen potente y luego organizar los elementos gráficos en una composición efectiva y convincente ha sido siempre uno de los requerimientos más fundamentales de la fotografía. Desde su primera edición en 2007, El ojo del fotógrafo se ha posicionado como la obra esencial sobre este tema, y está considerado un libro clave para los fotógrafos contemporáneos. Explora todos los enfoques tradicionales con respecto a la composición y el diseño, y también, muy importante, cubre posibilidades creativas como las técnicas de unión de imágenes y HDR. La nueva reproducción digital, no disponible cuando se imprimió la primera edición, proporciona a la fotografía del autor un nuevo aspecto al tiempo que conserva el saber hacer que ha proporcionado objetivos innovadores a una generación de fotógrafos.', 0),
('PRO806', 'CAT004', 'MRC011', 'Fotografía de alta calida', 50, 59, 'Esta obra desvela desde las técnicas más básicas a las más sofisticadas, perfectamente integradas en un método de trabajo eficaz y de alta calidad que ha guiado ya a miles de fotógrafos, “el método Mellado”. El autor consigue depurar y perfeccionar su método de trabajo empleando las últimas herramientas que ofrece la tecnología.', 0),
('PRO807', 'CAT004', 'MRC011', 'Sobre la fotografía', 74, 40, 'Sobre la fotografía es un libro de Susan Sontag publicado en 1977 recopilando de forma ligeramente distinta una serie de ensayos aparecidos en la revista New York Review of Books entre 1973 y 1977​.', 0),
('PRO808', 'CAT005', 'MRC012', 'Peak Time City Día Mochil', 13, 46, 'Mochila con correas de goma y cierres magnéticos de Peak Time Material superior adherente, aspecto moteado, acolchado de moda en la tapa de la mochila Hebillas de metal de alta calidad en la tapa, los bolsillos laterales y el bolsillo delantero Elementos reflectantes en la correa de la tapa (visibilidad óptima) Forro interior de color de moda hasta el borde de la mochila con cordones (se puede cerrar como una bolsa) Espalda ergonómica con tejido de malla acolchado (transpirable y agradable para la espalda) Correa de pecho adicional: alivio de presión óptimo Correas de hombro acolchadas y ajustables con tejido de malla en el interior Bolsillo lateral acolchado en la parte posterior para una computadora portátil (hasta 15 pulgadas) / tableta 2 compartimentos interiores con tejido de malla y cremallera 2 prácticos bolsillos laterales en el exterior con hebillas y cierres magnéticos Gran bolsillo frontal con hebillas y cierres magnéticos Volumen: hasta 30 litros Dimensiones (plegado): ancho 30 cm x alto 44 cm x profundidad 13,5 cm Lavado a mano Nota: ¡El contenido de la mochila que se muestra no está incluido en el volumen de suministro! ', 0),
('PRO809', 'CAT005', 'MRC013', 'Lowepro Viewpoint', 52, 60, 'Almacenar, Proteger DJI Mavic Drone / 3 GoPros Capacidad para portátil de 15 \"y tableta de 10\" Divisores interiores acolchados táctiles Accesorio para trípode lateral Correa y bolsillo Medidas Internas: 28,8 x 11,5 x 18,5 Medidas Externas: 30,5 x 14,5 x 45,5 Peso 1.3 kg', 0),
('PRO810', 'CAT212', 'MRC212', 'Trípode de 60 grados', 57, 40, 'La columna descentrable te permitirá hacer fotografías y vídeos desde diferentes ángulos. Tomas panorámicas, puntos de vista cenitales perfectos para la fotografía de producto, gastronómica y tomas a ras de suelo ideales para macrofotografía. Con tan sólo 56cm cuando está plegado, su transporte es muy fácil. Una vez extendido puede llegar a 170cm, o bien, si lo conviertes en monopié hasta 176cm, lo que es perfecto para lugares donde no está permitido plantar el trípode. El peso total incluyendo la rótula de alta capacidad es de tan sólo 1.65 kg. Peso del artículo 2,3 kilogramos.', 0),
('PRO811', 'CAT212', 'MRC212', 'Kit Portafiltros ND', 2, 50, '     • Este es el kit ideal para dar rienda a tu imaginación en la fotografía de larga exposición. Conecta de manera sencilla y rápida el portafiltro al objetivo de tu cámara, ponle el anillo adaptador para el diámetro de tu lente y después desliza el filtro ND1000. ¡No necesitas nada más!     • El filtro de Densidad Neutra SN25T1 de 10 pasos (ND1000 ó 3.0) es de cristal fabricado en Alemania mediante un proceso de recubrimiento especial que resuelve el problema de las dominantes de color y el viñeteo de otros filtros. Consigue aguas sedosas y monumentos sin gente gracias a este Big Stopper.     • Gracias a sus 8 anillos adaptadores podrás usar la gran mayoría de lentes del mercado, incluso grandes angulares. Todo el kit está construido con materiales resistentes y metal de primera calidad.     • Los anillos adaptadores incluidos son para objetivos con los siguientes diámetros 49mm / 52mm / 58mm / 62mm / 67mm / 72mm / 77 mm / 82mm.     • El filtro es un filtro cuadrado de 100x100mm y el portafiltro puede ser utilizado con filtros de mayor tamaño como 100x150mm y tiene un recubimiento especial para evitar entradas de luz. Todo viene en un estuche protector y un packaging personalizado de K&F.', 0),
('PRO812', 'CAT212', 'MRC212', 'Adaptador de Lentes M42', 63, 15, '• Permitir objetivos M42 Screw utilizados en cámara Nikon. • Compatible con la cámara Nikon incluye: Nikon D3000, D300s, D3100, D3200, D3300, D3400, D3s, D3x, D4, D400, D4s, D5, D500, D5000, D5100, D5200, D5300, D5500, D5600, D5s, D6, D600, D610, D700, D7000, D7100, D7200, D750, D7500, D760, D800, D810, D810a, D850, D90 etc. • Hecho de latón y aluminio. Construcción estable, precisa y duradera. Operada manualmente. Enfoque infinito permitido. • Para lentes pesados de formato medio, sugerimos utilizar con un soporte de teleobjetivo y un trípode para equilibrar su peso cuando se dispara.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `id_usuario` int(6) NOT NULL,
  `id_producto` varchar(6) NOT NULL,
  `valoracion` int(11) NOT NULL CHECK (`valoracion` in (1,2,3,4,5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(6) NOT NULL,
  `tipo_usuario` tinyint(1) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `user_login` varchar(35) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(14) DEFAULT NULL,
  `direccion` varchar(35) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `pais` varchar(35) NOT NULL,
  `receptor` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `tipo_usuario`, `nombre`, `apellidos`, `user_login`, `contrasena`, `fecha_nacimiento`, `correo`, `telefono`, `direccion`, `codigo_postal`, `ciudad`, `provincia`, `pais`, `receptor`) VALUES
(7, 0, 'Carlos Adolfo', 'Zelaya Henández', 'carlos', 'dc599a9972fde3045dab59dbd1ae170b', '0000-00-00', 'carlos@gmail.com', '+34 661908618', 'Avenida Vicente Trueba 3, 38', 39011, 'Santander', 'Cantabria', 'España', NULL),
(54, 1, 'Estela Rosinda', 'Zelaya Lazo', 'estela', 'b95055ae09cf2d62b7e5e4d9c7b9b1da', '1997-08-16', 'estelazelaya1999@gmail.com', '+34 661908319', 'Avenida Vicente Trueba 3, 38', 39011, 'Santander', 'Cantabria', 'España', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioscursos`
--

CREATE TABLE `usuarioscursos` (
  `id_usuario` int(6) NOT NULL,
  `id_curso` varchar(6) NOT NULL,
  `precio` float NOT NULL,
  `fecha_compra` date NOT NULL,
  `valoracion` float NOT NULL,
  `id_metodo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `fkblogCategoria` (`id_categoriaB`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoriasblog`
--
ALTER TABLE `categoriasblog`
  ADD PRIMARY KEY (`id_categoriaB`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fkcomentBlog` (`id_blog`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fkCategoriaCurso` (`id_categoria`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `etiquetasblog`
--
ALTER TABLE `etiquetasblog`
  ADD PRIMARY KEY (`id_etiqueta`,`id_blog`),
  ADD KEY `fketiBlog` (`id_blog`);

--
-- Indices de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD PRIMARY KEY (`id_lineafacturacion`,`id_pedido`,`id_producto`),
  ADD KEY `fklfProducto` (`id_producto`),
  ADD KEY `fklfPedido` (`id_pedido`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `metodospagos`
--
ALTER TABLE `metodospagos`
  ADD PRIMARY KEY (`id_metodo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fkUsuario_Pedido` (`id_usuario`),
  ADD KEY `fkMP_Pedido` (`id_metodo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fkCategoriaProd` (`id_categoria`),
  ADD KEY `fkMarcaProd` (`id_marca`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id_usuario`,`id_producto`),
  ADD KEY `fkresenaProd` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarioscursos`
--
ALTER TABLE `usuarioscursos`
  ADD PRIMARY KEY (`id_usuario`,`id_curso`),
  ADD KEY `fkCursoUC` (`id_curso`),
  ADD KEY `fkMP_UC` (`id_metodo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id_blog` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  MODIFY `id_lineafacturacion` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `metodospagos`
--
ALTER TABLE `metodospagos`
  MODIFY `id_metodo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `fkblogCategoria` FOREIGN KEY (`id_categoriaB`) REFERENCES `categoriasblog` (`id_categoriaB`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fkcomentBlog` FOREIGN KEY (`id_blog`) REFERENCES `blogs` (`id_blog`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fkCategoriaCurso` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `etiquetasblog`
--
ALTER TABLE `etiquetasblog`
  ADD CONSTRAINT `fketiBlog` FOREIGN KEY (`id_blog`) REFERENCES `blogs` (`id_blog`),
  ADD CONSTRAINT `fketiqueta` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiquetas` (`id_etiqueta`);

--
-- Filtros para la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD CONSTRAINT `fklfPedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `fklfProducto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fkMP_Pedido` FOREIGN KEY (`id_metodo`) REFERENCES `metodospagos` (`id_metodo`),
  ADD CONSTRAINT `fkUsuario_Pedido` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fkCategoriaProd` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fkMarcaProd` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `fkResenaUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fkresenaProd` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `usuarioscursos`
--
ALTER TABLE `usuarioscursos`
  ADD CONSTRAINT `fkCursoUC` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `fkMP_UC` FOREIGN KEY (`id_metodo`) REFERENCES `metodospagos` (`id_metodo`),
  ADD CONSTRAINT `fkUsuarioUC` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
