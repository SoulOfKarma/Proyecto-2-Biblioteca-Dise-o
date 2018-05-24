-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-05-2018 a las 20:53:50
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

DROP TABLE IF EXISTS `autor`;
CREATE TABLE IF NOT EXISTS `autor` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_autor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id_autor`, `nombre_autor`) VALUES
(1, 'Pancito'),
(2, 'Gansito'),
(3, 'Palta'),
(4, 'Talco'),
(5, 'Alex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disp_libros`
--

DROP TABLE IF EXISTS `disp_libros`;
CREATE TABLE IF NOT EXISTS `disp_libros` (
  `id_disp_libros` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_disp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_disp_libros`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disp_libros`
--

INSERT INTO `disp_libros` (`id_disp_libros`, `descripcion_disp`) VALUES
(1, 'Disponible'),
(2, 'No Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

DROP TABLE IF EXISTS `editorial`;
CREATE TABLE IF NOT EXISTS `editorial` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(50) NOT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id_editorial`, `nombre_editorial`) VALUES
(1, 'Ercilla'),
(2, 'Queso'),
(3, 'Cuak');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_libro` varchar(50) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_editorial` int(11) NOT NULL,
  `id_tipomaterial` int(11) NOT NULL,
  `id_disp_libros` int(11) NOT NULL,
  `codigo_isbn` varchar(50) NOT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `nombre_libro`, `id_autor`, `id_editorial`, `id_tipomaterial`, `id_disp_libros`, `codigo_isbn`) VALUES
(1, 'The Legend Of Zelda History', 1, 1, 1, 1, 'BTN-5656-NN'),
(2, 'Alex', 1, 1, 1, 1, 'asdada'),
(4, 'MiloBook', 1, 1, 1, 1, 'BTN-548-AD6'),
(5, 'The Legend Of Avatar Aang', 1, 1, 1, 1, 'BTN-5656-55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(50) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `nombre_perfil`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prestado` varchar(50) NOT NULL,
  `apellido_prestado` varchar(50) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `cantidad_prestamo` int(11) NOT NULL,
  `idlibroprestado` int(11) NOT NULL,
  `nombre_libroprestado` varchar(50) NOT NULL,
  `rut_prestamo` varchar(20) NOT NULL,
  `id_disp_pres` int(11) NOT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `nombre_prestado`, `apellido_prestado`, `fecha_prestamo`, `fecha_devolucion`, `cantidad_prestamo`, `idlibroprestado`, `nombre_libroprestado`, `rut_prestamo`, `id_disp_pres`) VALUES
(1, 'Ricardo', 'Soto', '2018-05-24', '2018-05-28', 0, 1, 'The Legend Of Zelda History', '18499714-2', 1),
(2, 'Ricardo', 'Soto', '2018-05-24', '2018-05-28', 0, 2, 'Alex', '18499714-2', 1),
(3, 'Ricardo', 'Soto', '2018-05-24', '2018-05-28', 0, 1, 'The Legend Of Zelda History', '18499714-2', 1),
(4, 'Ricardo', 'Soto', '2018-05-24', '2018-05-30', 0, 2, 'Alex', '18499714-2', 1),
(5, 'Ricardo', 'Soto', '2018-05-24', '2018-05-28', 0, 1, 'The Legend Of Zelda History', '18499714-2', 1),
(6, 'Ricardo', 'Soto', '2018-05-24', '2018-05-30', 0, 1, 'The Legend Of Zelda History', '18499714-2', 1),
(7, 'Ricardo', 'Soto', '2018-05-24', '2018-05-29', 0, 2, 'Alex', '18499714-2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomaterial`
--

DROP TABLE IF EXISTS `tipomaterial`;
CREATE TABLE IF NOT EXISTS `tipomaterial` (
  `id_tipomaterial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipomat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipomaterial`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipomaterial`
--

INSERT INTO `tipomaterial` (`id_tipomaterial`, `nombre_tipomat`) VALUES
(1, 'Mangas'),
(2, 'Comics');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `rut_usuario` varchar(50) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `user`, `pass`, `nombre_usuario`, `apellido_usuario`, `rut_usuario`, `id_perfil`) VALUES
(1, 'Admin', '123456', 'Ricardo', 'Soto', '18499714-2', 1),
(2, 'cliente', '123', 'Ricardo', 'Soto', '18499714-2', 2),
(3, 'alumno', '123', 'Ricardo', 'Soto', '18499714-2', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
