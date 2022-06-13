SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `proyectoss` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyectoss`;

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `turnoPorDia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `agenda` (`id_agenda`, `id_taller`, `fecha_inicio`, `fecha_fin`, `estado`, `hora_inicio`, `hora_fin`, `turnoPorDia`) VALUES
(1, 1, '2021-01-01', '2021-12-31', 'disponible', '08:00:00', '20:00:00', NULL),
(7, 2, '2021-11-01', '2021-11-30', 'disponible', '08:00:00', '20:00:00', NULL),
(8, 8, '2021-11-01', '2021-11-30', 'disponible', '08:00:00', '21:00:00', NULL),
(10, 9, '2021-11-01', '2021-11-30', 'disponible', '08:10:00', '21:10:00', NULL),
(11, 8, '2021-11-01', '2021-11-30', 'disponible', '08:00:00', '20:00:00', NULL),
(17, 10, '2021-11-01', '2021-11-30', 'disponible', '00:00:00', '23:59:00', NULL),
(27, 11, '2021-11-01', '2021-11-30', 'disponible', '08:00:00', '20:00:00', NULL);

CREATE TABLE `barrio` (
  `id_barrio` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `id_localidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `barrio` (`id_barrio`, `descripcion`, `id_localidad`) VALUES
(1, 'Fontana', 3),
(2, 'Illia', 3),
(3, 'Guadalupe', 3),
(4, 'Vivienda', 5);

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `tipo_cliente` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cliente` (`id_cliente`, `fecha_alta`, `id_persona`, `tipo_cliente`) VALUES
(26, '2000-03-02', 75, 1),
(27, '2021-10-06', 78, 1),
(28, '2021-10-11', 80, 2),
(29, '2021-10-21', 81, 1),
(30, '2021-10-27', 82, 1),
(31, '0000-00-00', 84, 1),
(32, '2021-10-26', 85, 1),
(33, '2021-09-30', 86, 1),
(34, '2021-10-28', 87, 1),
(35, '2021-10-07', 88, 1),
(56, '2021-10-07', 105, 1),
(57, '2021-10-12', 106, 1),
(68, '2021-10-26', 118, 1),
(72, '2021-11-18', 121, 1);

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `color` (`id_color`, `descripcion`) VALUES
(1, 'rojo'),
(2, 'azul'),
(3, 'negro'),
(4, 'Blanco'),
(5, 'Gris');

CREATE TABLE `contacto_persona` (
  `id_contacto_persona` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_contacto` int(11) DEFAULT NULL,
  `valor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `contacto_taller` (
  `id_contacto_taller` int(11) NOT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `id_tipo_contacto` int(11) DEFAULT NULL,
  `valor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contacto_taller` (`id_contacto_taller`, `id_taller`, `id_tipo_contacto`, `valor`) VALUES
(2, 1, 1, 'taller@ejemplo.com'),
(3, 2, 1, 'miTaller@gmail.com'),
(5, 10, 1, 'Ejemplo@gmail.com');

CREATE TABLE `dias` (
  `id_dia` int(11) NOT NULL,
  `lunes` tinyint(1) DEFAULT NULL,
  `martes` tinyint(1) DEFAULT NULL,
  `miercoles` tinyint(1) DEFAULT NULL,
  `jueves` tinyint(1) DEFAULT NULL,
  `viernes` tinyint(1) DEFAULT NULL,
  `sabado` tinyint(1) DEFAULT NULL,
  `id_agenda` int(11) DEFAULT NULL,
  `domingo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dias` (`id_dia`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `id_agenda`, `domingo`) VALUES
(85, 1, 1, 1, 1, 1, 1, 10, 0),
(94, 1, 1, 1, 1, 1, 1, 7, 0),
(95, 1, 1, 1, 1, 1, 1, 17, 1),
(100, 1, 1, 1, 1, 1, 0, 1, 0),
(101, 1, 1, 1, 1, 1, 1, 27, 0);

CREATE TABLE `domicilio` (
  `id_domicilio` int(11) NOT NULL,
  `id_barrio` int(11) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `manzana` varchar(50) DEFAULT NULL,
  `torre` varchar(50) DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `num_casa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `domicilio` (`id_domicilio`, `id_barrio`, `calle`, `altura`, `manzana`, `torre`, `piso`, `num_casa`) VALUES
(1, 1, 'AAA', 111, '111', '111', 111, 111),
(2, 1, 'AAA', 111, '111', '111', 111, 111),
(3, 1, 'AAA', 111, '111', '111', 111, 111),
(4, 1, 'AAA', 111, '111', '111', 111, 111),
(5, 1, 'BBB', 222, '222', '222', 222, 222),
(6, 3, 'ccc', 333, '333', '333', 333, 333),
(7, 2, '444', 444, '444', '444', 444, 444),
(8, 2, 'LLL', 1, 'LLL', '1', 1, 1),
(9, 2, 'L1', 2, '2', '2', 2, 2),
(10, 3, 'MA', 5, '5', '5', 5, 5),
(11, 2, '1', 2, '33', '4', 4222, 6),
(12, 3, 'LLL', 1, 'LLL', '1', 1, 1),
(13, 1, 'LLL', 1, 'LLL', '1', 1, 12),
(14, 1, 'LLL', 1, 'LLL', '1', 1, 12),
(15, 1, '1234444', 12, 'LLL2', '12', 12, 12),
(16, 2, '1111', 1111, '1111', '1111', 1111, 1111),
(17, 2, '222', 222, '222', '222', 222, 222),
(18, 1, 'test223', 123, '123', '123', 123, 123),
(19, 3, 'tesxt', 1, '2', '3', 3, 5),
(20, 2, 'Tanto', 12, '12', '12', 12, 12),
(21, 1, 'Coronel Bogado', 4150, '41', '41', 41, 19),
(22, 2, '12312', 3123123, '123123', '32123', 32123, 123),
(24, 2, 'Coronel Bogado', 4150, '41', '41', 41, 19),
(25, 2, '123123', 12312312, '31231231', '2313', 2313, 1231),
(26, 2, '', 0, '', '', 0, 0),
(30, 2, '123', 123, '123', '123', 123, 123),
(31, 1, 'Coronel Bogado', 4150, '41', '1', 1, 19),
(32, 2, 'Coronel Bogado', 4150, '41', '1', 1, 19),
(33, 3, 'Av. Gutnizki', 0, '0000', '0000', 0, 1050),
(34, 1, 'Maipu', 3600, '32', '0', 0, 15);

CREATE TABLE `domicilio_persona` (
  `id_domicilio_persona` int(11) NOT NULL,
  `id_domicilio` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `domicilio_taller` (
  `id_domicilio_taller` int(11) NOT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `id_domicilio` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `domicilio_taller` (`id_domicilio_taller`, `id_taller`, `id_domicilio`, `estado`) VALUES
(1, 1, 16, 0),
(2, 1, 17, 0),
(3, 1, 18, 0),
(4, 2, 20, 1),
(5, 1, 32, 1),
(6, 1, 33, 0),
(7, 10, 34, 1);

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `numero_legajo` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_taller` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `empleado` (`id_empleado`, `fecha_alta`, `numero_legajo`, `id_persona`, `id_taller`) VALUES
(11, '2021-10-08', 3232, 77, 2),
(17, '2021-11-05', 123, 122, 2),
(18, '2021-11-21', 123, 125, 1),
(19, '2021-11-26', NULL, 126, NULL);

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `fecha_emision` date DEFAULT NULL,
  `numeracion` int(11) DEFAULT NULL,
  `id_tipo_factura` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `factura` (`id_factura`, `fecha_emision`, `numeracion`, `id_tipo_factura`, `estado`) VALUES
(61, '2021-11-09', 0, 1, -1),
(62, '2021-11-09', 1, 2, 1),
(63, '2021-11-10', 2, 1, -1),
(64, '2021-11-20', 3, 1, 1),
(65, '2021-11-22', 4, 1, -1),
(66, '2021-11-22', 5, 1, 1),
(67, '2021-11-22', 6, 0, 0),
(68, '2021-11-22', 7, 2, 1),
(69, '2021-11-23', 8, 1, 1),
(70, '2021-11-26', 9, 1, -1);

CREATE TABLE `factura_pago` (
  `id_factura_pago` int(11) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_tipo_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `factura_pago` (`id_factura_pago`, `id_factura`, `id_tipo_pago`) VALUES
(42, 61, 1),
(43, 62, 2),
(44, 63, 2),
(45, 64, 3),
(46, 65, 3),
(47, 66, 3),
(48, 67, 1),
(49, 68, 2),
(50, 69, 2),
(51, 70, 2);

CREATE TABLE `localidad` (
  `id_localidad` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `localidad` (`id_localidad`, `descripcion`, `id_provincia`) VALUES
(1, 'Colorado', 1),
(2, 'Pirane', 1),
(3, 'Formosa', 1),
(4, 'Corrientes', 2),
(5, 'Paso de la Patria', 2);

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `marca` (`id_marca`, `descripcion`) VALUES
(6, 'Castrol'),
(7, 'Roca'),
(8, 'K&G');

CREATE TABLE `marca_vehiculo` (
  `id_marca_vehiculo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `marca_vehiculo` (`id_marca_vehiculo`, `descripcion`) VALUES
(1, 'Ford'),
(2, 'Peugeot'),
(3, 'Renault'),
(4, 'Fiat'),
(5, 'Citroen'),
(6, 'Honda'),
(7, 'Toyota'),
(8, 'Volkswagen'),
(10, 'Ejemplo');

CREATE TABLE `modelo_vehiculo` (
  `id_modelo_vehiculo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `id_marca_vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `modelo_vehiculo` (`id_modelo_vehiculo`, `descripcion`, `id_marca_vehiculo`) VALUES
(1, 'Fiesta', 1),
(2, 'KA', 1),
(3, 'Ranger', 1),
(4, '207', 2),
(5, '208', 2),
(6, 'Clio', 3),
(7, 'Palio', 4),
(8, 'Trend', 8),
(9, 'C3', 5),
(11, 'C4 Picasso', 5),
(12, 'Grand C5 Picasso', 5),
(13, 'C4 Aircross', 5),
(14, 'Nemo', 5),
(15, 'Berlingo', 5),
(17, 'C4 Cactus', 5),
(18, 'C1', 5),
(19, 'C-Zero', 5),
(20, 'Spacetourer', 5),
(21, 'E-Mehari', 5),
(22, 'C3 Aircross', 5),
(23, 'Freemont', 4),
(25, 'Punto', 4),
(26, 'Panda', 4),
(27, '500', 4),
(28, '500L', 4),
(29, '500X', 4),
(30, 'Qubo', 4),
(31, 'Fiorino', 4),
(32, 'Bravo', 4),
(33, '500C', 4),
(45, 'C-Max', 1),
(46, 'Focus', 1),
(47, 'Mondeo', 1),
(48, 'S-Max', 1),
(49, 'Kuga', 1),
(50, 'EcoSport', 1),
(51, 'Edge', 1),
(52, 'Ka+', 1),
(53, 'Jazz', 6),
(54, 'Civic', 6),
(55, '308', 2),
(56, '807', 2),
(57, 'Bipper', 2),
(58, '508', 2),
(59, 'Partner', 2),
(60, '3008', 2),
(61, '2008', 2),
(62, 'RCZ', 2),
(63, '5008', 2),
(64, '4008', 2),
(65, '108', 2),
(66, 'Ion', 2),
(67, 'Fluence', 3),
(68, 'Latitude', 3),
(69, 'Kangoo Combi', 3),
(70, 'Megane', 3),
(71, 'Captur', 3),
(72, 'ZOE', 3),
(73, 'Koleos', 3),
(74, 'Twingo', 3),
(75, 'Yaris', 7),
(76, 'Auris', 7),
(77, 'Hilux', 7),
(78, 'Rav4', 7),
(79, 'Polo', 8),
(80, 'Jetta', 8),
(81, 'Golf', 8),
(82, 'Touran', 8),
(83, 'Multivan', 8),
(84, 'Up!', 8),
(85, 'CC', 8),
(86, 'Golf SPortsvan', 8),
(87, 'Amarok', 8),
(88, 'Scirocco', 8),
(89, 'Eos', 8),
(90, 'Gol Trend', 8),
(91, 'Gol Power', 8);

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `directorio` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `nivel` int(11) DEFAULT 0,
  `orden` int(11) DEFAULT 1,
  `hijoDe` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `modulo` (`id_modulo`, `descripcion`, `directorio`, `estado`, `nivel`, `orden`, `hijoDe`) VALUES
(1, 'Clientes', 'clientes', 1, 1, 2, 'personas'),
(2, 'Usuarios', 'usuarios', 1, 1, 1, 'personas'),
(3, 'Empleados', 'empleados', 1, 1, 3, 'personas'),
(4, 'Vehiculo', 'vehiculo', 1, 0, 4, NULL),
(5, 'Taller', 'taller', 1, 0, 1, NULL),
(6, 'Servicios', 'servicios', 1, 0, 2, NULL),
(7, 'Repuestos', 'repuestos', 1, 0, 3, NULL),
(8, 'Modulos', 'modulo', 1, 2, 2, 'permisos y modulos'),
(9, 'Perfil', 'perfil', 1, 2, 1, 'permisos y modulos'),
(13, 'proveedores', 'proveedor', 1, 0, 5, NULL),
(14, 'compras', 'compras', 1, 0, 6, NULL),
(15, 'facturas', 'facturacion', 1, 0, 7, NULL),
(16, 'gestion', '#', 1, 0, 9, NULL),
(17, 'personas', '#', 1, 0, 8, NULL),
(18, 'permisos y modulos', '#', 1, 1, 1, 'gestion'),
(19, 'Gestion-Domicilio', '#', 1, 1, 2, 'gestion'),
(20, 'pais', 'pais', 1, 2, 3, 'Gestion-Domicilio'),
(21, 'provincia', 'provincia', 1, 2, 2, 'Gestion-Domicilio'),
(22, 'localidad', 'localidad', 1, 2, 1, 'Gestion-Domicilio'),
(23, 'Gestion-Repuesto', '#', 1, 1, 3, 'gestion'),
(24, 'Gestion-Vehiculo', '#', 1, 1, 4, 'gestion'),
(25, 'marca-repuesto', 'repuestos/marca', 1, 2, 1, 'Gestion-Repuesto'),
(26, 'tipo-repuesto', 'repuestos/tipoRepuesto', 1, 2, 2, 'Gestion-Repuesto'),
(27, 'marca-vehiculo', 'vehiculo/marcaVehiculo', 1, 2, 1, 'Gestion-Vehiculo'),
(28, 'modelo-repuesto', 'vehiculo/modeloVehiculo', 1, 2, 2, 'Gestion-Vehiculo'),
(29, 'turno', 'turno', 1, 0, 2, NULL),
(30, 'reportes', 'reportes', 1, 0, 1, NULL);

CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL,
  `noticia` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `noticias` (`id_noticia`, `noticia`) VALUES
(1, 'El dia 28 podrÃ¡n asistir a la capacitaciÃ³n en motores hÃ­bridos .-');

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pais` (`id_pais`, `descripcion`) VALUES
(1, 'Argentina');

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `perfil` (`id_perfil`, `descripcion`, `estado`) VALUES
(1, 'admin', 1),
(2, 'Cliente', 1),
(52, 'Empleado', 1),
(53, 'gerente', 0);

CREATE TABLE `perfil_modulo` (
  `id_perfil_modulo` int(11) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `perfil_modulo` (`id_perfil_modulo`, `id_perfil`, `id_modulo`) VALUES
(322, 52, 5),
(323, 52, 7),
(324, 52, 29),
(325, 2, 4),
(326, 2, 29),
(327, 1, 1),
(328, 1, 2),
(329, 1, 3),
(330, 1, 4),
(331, 1, 5),
(332, 1, 6),
(333, 1, 7),
(334, 1, 8),
(335, 1, 9),
(336, 1, 13),
(337, 1, 14),
(338, 1, 15),
(339, 1, 16),
(340, 1, 17),
(341, 1, 18),
(342, 1, 19),
(343, 1, 20),
(344, 1, 21),
(345, 1, 22),
(346, 1, 23),
(347, 1, 24),
(348, 1, 25),
(349, 1, 26),
(350, 1, 27),
(351, 1, 28),
(352, 1, 30);

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `id_sexo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `persona` (`id_persona`, `dni`, `nombre`, `apellido`, `fecha_nacimiento`, `estado`, `id_sexo`) VALUES
(1, 40, 'admin', 'admin', '0000-00-00', 1, 3),
(75, 421322412, 'Florencia', 'Cañete', '2000-03-02', 1, 1),
(77, 40254132, 'Adriel', 'Irala', '1999-07-15', 1, 2),
(78, 22700876, 'Lilia', 'Santillan', '1974-07-26', 1, 1),
(79, 41231645, 'Maximiliano', 'Vidaurre', '1998-08-15', 1, 2),
(81, 41203415, 'Adriel', 'Irala', '1999-07-06', 1, 2),
(82, 41321721, 'Maxi', 'Vidaurre', '1999-10-25', 1, 2),
(121, 111222333, 'Prueba', 'De Usuario', '2021-11-19', 1, 2),
(122, 34571321, 'Jorge', 'Ramirez', '2000-01-22', 1, 2),
(123, 27423111, 'Fabian', 'Caceres', '2021-11-15', 1, 2),
(124, 27423111, 'Fabian', 'Caceres', '2021-11-15', 1, 2),
(125, 27423111, 'Fabian', 'Caceres', '2021-11-15', 1, 2),
(126, 2147483647, 'Jorgee', 'Ramirezz', '2021-11-04', 1, 1);

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `fecha_alta`) VALUES
(1, 'EjProveedor', '2021-11-01');

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `provincia` (`id_provincia`, `descripcion`, `id_pais`) VALUES
(1, 'Formosa', 1),
(2, 'Corrientes', 1);

CREATE TABLE `repuesto` (
  `id_repuesto` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `id_tipo_repuesto` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `repuesto` (`id_repuesto`, `descripcion`, `id_tipo_repuesto`, `estado`, `id_marca`) VALUES
(21, 'Refinado', 6, 0, 6),
(22, 'Liquido Refrigerante', 7, 0, 6),
(23, '12/7', 8, 0, 7),
(24, '2lt', 7, 0, 6),
(25, 'Distribución', 10, 1, 8);

CREATE TABLE `repuesto_proveedor` (
  `id_repuesto_proveedor` int(11) NOT NULL,
  `id_repuesto` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `repuesto_proveedor` (`id_repuesto_proveedor`, `id_repuesto`, `id_proveedor`, `cantidad`, `fecha`, `estado`) VALUES
(14, 21, 1, 30, '2021-11-21', 0),
(15, 22, 1, 20, '2021-11-21', 0),
(16, 23, 1, 10, '2021-11-21', 0),
(17, 22, 1, 10, '2021-11-23', 0);

CREATE TABLE `repuesto_taller` (
  `id_repuesto_taller` int(11) NOT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `id_repuesto` int(11) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `existencia_minima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `repuesto_taller` (`id_repuesto_taller`, `id_taller`, `id_repuesto`, `existencia`, `existencia_minima`) VALUES
(3, 1, 21, 15, 10),
(4, 2, 21, 25, 10),
(5, 1, 22, -2, 0),
(6, 2, 22, 20, 10),
(7, 1, 23, 0, 0),
(8, 2, 23, 11, 10),
(9, 1, 24, 10, 0),
(10, 2, 24, 10, 10),
(11, 10, 24, 10, 0),
(12, 11, 25, 100, 20);

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `precio_servicio` int(11) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_tipo_servicio` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `servicio` (`id_servicio`, `precio_servicio`, `duracion`, `descripcion`, `id_tipo_servicio`, `estado`) VALUES
(1, 5000, 30, 'Cambio Liquido Refrigerante', 1, 1),
(2, 1050, 30, 'Cambio de aceite', 3, 1),
(3, 700, 30, 'Cambio de luces', 2, 1),
(4, 3000, 60, 'Cambio de amortiguadores', 4, 0),
(5, 10000, 15, 'Cambio de bateria', 4, 0),
(6, 500, 30, 'cambio de aceite', 3, 0),
(7, 400, 30, 'ejemplo', 1, 1);

CREATE TABLE `servicio_repuesto` (
  `id_servicio_repuesto` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_repuesto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `servicio_repuesto` (`id_servicio_repuesto`, `id_servicio`, `id_repuesto`, `cantidad`) VALUES
(19, 1, 22, 2);

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `sexo` (`id_sexo`, `descripcion`) VALUES
(1, 'femenino'),
(2, 'masculino'),
(3, 'otro');

CREATE TABLE `taller` (
  `id_taller` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(11) DEFAULT 1,
  `maxTurno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `taller` (`id_taller`, `nombre`, `estado`, `maxTurno`) VALUES
(1, 'AutoPartes', 0, 16),
(2, 'NeoTaller', 0, 15),
(8, 'MiTaller', 0, 10),
(9, 'Taller2', 0, 15),
(10, 'EjemploTaller1', 0, 10),
(11, 'EJEMPLO', 1, 10),
(12, 'asd4', 0, 123);

CREATE TABLE `tipo_cliente` (
  `id_tipo_cliente` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_cliente` (`id_tipo_cliente`, `descripcion`) VALUES
(1, 'Consumidor Final'),
(2, 'Responsable Inscripto');

CREATE TABLE `tipo_contacto` (
  `id_tipo_contacto` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_contacto` (`id_tipo_contacto`, `descripcion`) VALUES
(1, 'Email'),
(2, 'Celular'),
(3, 'Tel. Fijo');

CREATE TABLE `tipo_factura` (
  `id_tipo_factura` int(11) NOT NULL,
  `descripcion` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_factura` (`id_tipo_factura`, `descripcion`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

CREATE TABLE `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL,
  `descripcion` varchar(25) DEFAULT NULL,
  `porcentaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_pago` (`id_tipo_pago`, `descripcion`, `porcentaje`) VALUES
(1, 'Efectivo', -10),
(2, 'Credito', 10),
(3, 'Debito', 0);

CREATE TABLE `tipo_repuesto` (
  `id_tipo_repuesto` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_repuesto` (`id_tipo_repuesto`, `descripcion`) VALUES
(6, 'Aceite'),
(7, 'Refrigerante'),
(8, 'Bateria'),
(9, 'Amortiguador'),
(10, 'Correa');

CREATE TABLE `tipo_servicio` (
  `id_tipo_servicio` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_servicio` (`id_tipo_servicio`, `descripcion`) VALUES
(1, 'Refrigeracion'),
(2, 'electrico'),
(3, 'Lubricantes'),
(4, 'Mecanica General'),
(5, 'lubricantes');

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `id_agenda` int(11) DEFAULT NULL,
  `fecha_turno` date DEFAULT NULL,
  `hora_turno` time DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `turno` (`id_turno`, `id_cliente`, `id_vehiculo`, `id_agenda`, `fecha_turno`, `hora_turno`, `estado`) VALUES
(191, 27, 22, 7, '2021-11-09', '18:00:00', 5),
(192, 29, 28, 7, '2021-11-10', '17:00:00', 5),
(193, 26, 29, 7, '2021-11-09', '12:00:00', 5),
(194, 30, 30, 7, '2021-11-09', '12:00:00', 4),
(195, 26, 31, 7, '2021-11-18', '18:44:00', 2),
(196, 29, 28, 7, '2021-11-19', '15:44:00', 4),
(197, 30, 30, 7, '2021-11-17', '15:45:00', 3),
(199, 29, 28, 1, '2021-10-20', '18:55:00', 4),
(200, 30, 30, 7, '2021-11-19', '19:12:00', 4),
(201, 72, 32, 7, '2021-11-22', '09:03:00', 5),
(202, 30, 30, 7, '2021-11-22', '17:15:00', 5),
(203, 30, 30, 7, '2021-11-22', '09:27:00', 1),
(204, 29, 28, 7, '2021-11-22', '09:28:00', 4),
(205, 27, 23, 7, '2021-11-23', '19:08:00', 1),
(206, 27, 23, 7, '2021-11-23', '08:31:00', 1),
(207, 27, 22, 7, '2021-11-23', '08:14:00', 1),
(208, 27, 22, 7, '2021-11-23', '08:14:00', 1),
(209, 27, 22, 7, '2021-11-23', '08:14:00', 1),
(210, 27, 0, 7, '2021-11-24', '08:20:00', 5),
(211, 27, 22, 7, '2021-11-24', '09:22:00', 1),
(212, 27, 23, 1, '2021-11-23', '08:39:00', 1),
(213, 27, 23, 7, '2021-11-24', '09:43:00', 1),
(214, 29, 28, 7, '2021-11-24', '09:43:00', 2),
(215, 27, 23, 7, '2021-11-24', '08:48:00', 1),
(216, 27, 22, 7, '2021-11-23', '09:08:00', 1),
(217, 27, 23, 7, '2021-11-23', '09:04:00', 1),
(218, 29, 28, 7, '2021-11-22', '10:30:00', 2),
(219, 29, 28, 7, '2021-11-09', '08:47:00', 2),
(220, 30, 33, 7, '2021-11-09', '08:47:00', 1),
(221, 29, 28, 7, '2021-11-09', '08:47:00', 2),
(222, 27, 23, 7, '2021-11-09', '08:47:00', 1),
(223, 26, 29, 7, '2021-11-24', '08:47:00', 1),
(224, 29, 28, 7, '2021-11-30', '17:40:00', 2),
(225, 27, 23, 7, '2021-11-23', '09:54:00', 1),
(226, 27, 22, 17, '2021-11-30', '10:05:00', 1),
(227, 27, 23, 7, '2021-11-24', '14:18:00', 1),
(228, 72, 32, 7, '2021-11-24', '12:20:00', 1),
(229, 26, 29, 17, '2021-11-23', '13:22:00', 1),
(230, 72, 32, 27, '2021-11-27', '12:30:00', 3);

CREATE TABLE `turno_servicio` (
  `id_turno_servicio` int(11) NOT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `turno_servicio` (`id_turno_servicio`, `id_turno`, `id_servicio`, `costo`, `id_factura`, `cantidad`) VALUES
(235, 191, 1, 5000, 61, NULL),
(236, 192, 1, 5000, 62, NULL),
(237, 192, 2, 1050, 62, NULL),
(238, 193, 1, 5000, 63, NULL),
(239, 194, 3, 700, 65, NULL),
(240, 195, 1, 5000, NULL, NULL),
(241, 196, 3, 700, 64, NULL),
(242, 197, 1, 5000, 66, NULL),
(245, 199, 1, 5000, 68, NULL),
(246, 200, 2, 1050, 67, NULL),
(247, 201, 1, 5000, NULL, NULL),
(248, 202, 1, 5000, NULL, NULL),
(249, 203, 1, 5000, NULL, NULL),
(250, 204, 3, 700, 69, NULL),
(251, 205, 1, 5000, NULL, NULL),
(252, 205, 2, 1050, NULL, NULL),
(253, 205, 3, 700, NULL, NULL),
(254, 206, 1, 5000, NULL, NULL),
(255, 206, 2, 1050, NULL, NULL),
(256, 207, 1, 5000, NULL, NULL),
(257, 208, 1, 5000, NULL, NULL),
(258, 209, 1, 5000, NULL, NULL),
(259, 0, 1, 5000, NULL, NULL),
(260, 210, 2, 1050, NULL, NULL),
(261, 211, 1, 5000, NULL, NULL),
(262, 212, 1, 5000, NULL, NULL),
(263, 213, 1, 5000, NULL, NULL),
(264, 214, 1, 5000, NULL, NULL),
(265, 215, 2, 1050, NULL, NULL),
(266, 0, 2, 1050, NULL, NULL),
(267, 0, 2, 1050, NULL, NULL),
(268, 216, 2, 1050, NULL, NULL),
(269, 217, 2, 1050, NULL, NULL),
(270, 218, 3, 700, NULL, NULL),
(271, 0, 3, 700, NULL, NULL),
(272, 219, 1, 5000, NULL, NULL),
(273, 220, 1, 5000, NULL, NULL),
(274, 220, 3, 700, NULL, NULL),
(275, 220, 7, 400, NULL, NULL),
(276, 221, 1, 5000, NULL, NULL),
(277, 221, 3, 700, NULL, NULL),
(278, 221, 7, 400, NULL, NULL),
(279, 222, 1, 5000, NULL, NULL),
(280, 222, 3, 700, NULL, NULL),
(281, 222, 7, 400, NULL, NULL),
(282, 223, 1, 5000, NULL, NULL),
(283, 223, 3, 700, NULL, NULL),
(284, 223, 7, 400, NULL, NULL),
(285, 224, 1, 5000, NULL, NULL),
(286, 224, 3, 700, NULL, NULL),
(287, 224, 7, 400, NULL, NULL),
(288, 225, 1, 5000, NULL, NULL),
(289, 226, 1, 5000, NULL, NULL),
(290, 226, 2, 1050, NULL, NULL),
(291, 226, 3, 700, NULL, NULL),
(292, 226, 7, 400, NULL, NULL),
(293, 227, 1, 5000, NULL, NULL),
(294, 227, 2, 1050, NULL, NULL),
(295, 228, 1, 5000, NULL, NULL),
(296, 228, 2, 1050, NULL, NULL),
(297, 228, 3, 700, NULL, NULL),
(298, 228, 7, 400, NULL, NULL),
(299, 229, 2, 1050, NULL, NULL),
(300, 230, 1, 5000, 70, NULL),
(301, 230, 2, 1050, 70, NULL),
(302, 230, 3, 700, 70, NULL);

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuario` (`id_usuario`, `username`, `password`, `id_persona`, `id_perfil`) VALUES
(1, 'Admin', 'admin', 1, 1),
(28, 'CFlorencia', '1234', 75, 52),
(30, 'Iadriel', '1234', 77, 52),
(31, 'SLilia', '1234', 78, 2),
(32, 'VMaxi', '1234', 79, 53),
(33, 'Ejemplo', '1234', 80, 2),
(35, 'Uusuario', '1234', 121, 2),
(36, 'USER', '1234', 126, 2);

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_modelo_vehiculo` int(11) DEFAULT NULL,
  `anio` varchar(5) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vehiculo` (`id_vehiculo`, `matricula`, `color`, `id_cliente`, `id_modelo_vehiculo`, `anio`, `estado`) VALUES
(18, 'AB-231-43', 'negro', 26, 50, '2021', 0),
(19, 'AF-203-BC', 'rojo', 26, 22, '2021', 0),
(20, 'JCE-211', 'negro', 27, 4, '2010', 0),
(21, 'AA-111-AA', 'negro', 27, 1, '2016', 0),
(22, 'JCE-211', 'negro', 27, 4, '2010', 1),
(23, 'AE-231-BC', 'negro', 27, 77, '2021', 1),
(24, 'AA-222-AA', 'azul', 27, 68, '2017', 1),
(26, 'aaa-222', 'rojo', 27, 53, '2002', 1),
(27, 'ABC-123', 'rojo', 26, 6, '2001', 0),
(28, 'AE-203-CA', 'negro', 29, 11, '2021', 1),
(29, 'CC-123-CC', 'rojo', 26, 1, '2018', 1),
(30, 'icb-230', 'negro', 30, 54, '2009', 1),
(31, 'AA-999-CC', 'azul', 26, 67, '2019', 1),
(32, 'CC-111-CC', 'azul', 72, 67, '2021', 1),
(33, 'AF-251-BC', 'rojo', 30, 52, '2021', 1),
(34, 'AE-982-EC', 'azul', 0, 6, '2020', 1),
(35, 'AE-267-CB', 'azul', 27, 2, '2021', 0),
(36, 'AE-267-CE', 'azul', 27, 6, '2021', 0),
(37, 'AE-267-CE', 'azul', 27, 6, '2021', 0),
(38, 'cc-221-vc', 'negro', 27, 7, '2020', 0),
(39, '', 'NULL', 0, 0, '2021', 1),
(40, 'CD-132-PQ', 'azul', 72, 1, '2020', 1);


ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `id_taller` (`id_taller`);

ALTER TABLE `barrio`
  ADD PRIMARY KEY (`id_barrio`),
  ADD KEY `id_localidad` (`id_localidad`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_persona` (`id_persona`);

ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

ALTER TABLE `contacto_persona`
  ADD PRIMARY KEY (`id_contacto_persona`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_tipo_contacto` (`id_tipo_contacto`);

ALTER TABLE `contacto_taller`
  ADD PRIMARY KEY (`id_contacto_taller`),
  ADD KEY `id_taller` (`id_taller`),
  ADD KEY `id_tipo_contacto` (`id_tipo_contacto`);

ALTER TABLE `dias`
  ADD PRIMARY KEY (`id_dia`),
  ADD KEY `id_agenda` (`id_agenda`);

ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`id_domicilio`),
  ADD KEY `id_barrio` (`id_barrio`);

ALTER TABLE `domicilio_persona`
  ADD PRIMARY KEY (`id_domicilio_persona`),
  ADD KEY `id_domicilio` (`id_domicilio`),
  ADD KEY `id_persona` (`id_persona`);

ALTER TABLE `domicilio_taller`
  ADD PRIMARY KEY (`id_domicilio_taller`),
  ADD KEY `id_taller` (`id_taller`),
  ADD KEY `id_domicilio` (`id_domicilio`);

ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_taller` (`id_taller`);

ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_tipo_factura` (`id_tipo_factura`);

ALTER TABLE `factura_pago`
  ADD PRIMARY KEY (`id_factura_pago`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_tipo_pago` (`id_tipo_pago`);

ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`),
  ADD KEY `id_provincia` (`id_provincia`);

ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

ALTER TABLE `marca_vehiculo`
  ADD PRIMARY KEY (`id_marca_vehiculo`);

ALTER TABLE `modelo_vehiculo`
  ADD PRIMARY KEY (`id_modelo_vehiculo`),
  ADD KEY `id_marca_vehiculo` (`id_marca_vehiculo`);

ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

ALTER TABLE `perfil_modulo`
  ADD PRIMARY KEY (`id_perfil_modulo`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_modulo` (`id_modulo`);

ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `id_sexo` (`id_sexo`);

ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `id_pais` (`id_pais`);

ALTER TABLE `repuesto`
  ADD PRIMARY KEY (`id_repuesto`),
  ADD KEY `id_tipo_repuesto` (`id_tipo_repuesto`),
  ADD KEY `id_marca` (`id_marca`);

ALTER TABLE `repuesto_proveedor`
  ADD PRIMARY KEY (`id_repuesto_proveedor`),
  ADD KEY `id_repuesto` (`id_repuesto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

ALTER TABLE `repuesto_taller`
  ADD PRIMARY KEY (`id_repuesto_taller`),
  ADD KEY `id_taller` (`id_taller`),
  ADD KEY `id_repuesto` (`id_repuesto`);

ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_tipo_servicio` (`id_tipo_servicio`);

ALTER TABLE `servicio_repuesto`
  ADD PRIMARY KEY (`id_servicio_repuesto`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_repuesto` (`id_repuesto`);

ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_sexo`);

ALTER TABLE `taller`
  ADD PRIMARY KEY (`id_taller`);

ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`id_tipo_cliente`);

ALTER TABLE `tipo_contacto`
  ADD PRIMARY KEY (`id_tipo_contacto`);

ALTER TABLE `tipo_factura`
  ADD PRIMARY KEY (`id_tipo_factura`);

ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tipo_pago`);

ALTER TABLE `tipo_repuesto`
  ADD PRIMARY KEY (`id_tipo_repuesto`);

ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id_tipo_servicio`);

ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_vehiculo` (`id_vehiculo`),
  ADD KEY `id_agenda` (`id_agenda`);

ALTER TABLE `turno_servicio`
  ADD PRIMARY KEY (`id_turno_servicio`),
  ADD KEY `id_turno` (`id_turno`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_factura` (`id_factura`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_perfil` (`id_perfil`);

ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_modelo_vehiculo` (`id_modelo_vehiculo`);


ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `barrio`
  MODIFY `id_barrio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `contacto_persona`
  MODIFY `id_contacto_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `contacto_taller`
  MODIFY `id_contacto_taller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `dias`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

ALTER TABLE `domicilio`
  MODIFY `id_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

ALTER TABLE `domicilio_persona`
  MODIFY `id_domicilio_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `domicilio_taller`
  MODIFY `id_domicilio_taller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

ALTER TABLE `factura_pago`
  MODIFY `id_factura_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `marca_vehiculo`
  MODIFY `id_marca_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `modelo_vehiculo`
  MODIFY `id_modelo_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

ALTER TABLE `modulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

ALTER TABLE `perfil_modulo`
  MODIFY `id_perfil_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `repuesto`
  MODIFY `id_repuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `repuesto_proveedor`
  MODIFY `id_repuesto_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `repuesto_taller`
  MODIFY `id_repuesto_taller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `servicio_repuesto`
  MODIFY `id_servicio_repuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `taller`
  MODIFY `id_taller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `tipo_cliente`
  MODIFY `id_tipo_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tipo_contacto`
  MODIFY `id_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tipo_factura`
  MODIFY `id_tipo_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tipo_pago`
  MODIFY `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tipo_repuesto`
  MODIFY `id_tipo_repuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `tipo_servicio`
  MODIFY `id_tipo_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

ALTER TABLE `turno_servicio`
  MODIFY `id_turno_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;


ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`);

ALTER TABLE `repuesto`
  ADD CONSTRAINT `repuesto_ibfk_1` FOREIGN KEY (`id_tipo_repuesto`) REFERENCES `tipo_repuesto` (`id_tipo_repuesto`),
  ADD CONSTRAINT `repuesto_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

ALTER TABLE `repuesto_taller`
  ADD CONSTRAINT `repuesto_taller_ibfk_1` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`),
  ADD CONSTRAINT `repuesto_taller_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuesto` (`id_repuesto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
