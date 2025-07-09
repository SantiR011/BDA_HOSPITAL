-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2025 a las 02:13:00
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `reactivar_medico` (IN `p_numero_id` INT)  BEGIN
        IF EXISTS (SELECT 1 FROM medico_desactivado WHERE numero_id = p_numero_id) THEN

                INSERT INTO medico (
            tipo_id,
            numero_id,
            nombres,
            apellidos,
            correo,
            contrasena,
            direccion,
            municipio_id,
            telefono_principal,
            especialidad_id,
            fecha_nac
        )
        SELECT
            tipo_id,
            numero_id,
            nombres,
            apellidos,
            correo,
            contrasena,
            direccion,
            municipio_id,
            telefono_principal,
            especialidad_id,
            fecha_nac
        FROM medico_desactivado
        WHERE numero_id = p_numero_id;

                DELETE FROM medico_desactivado WHERE numero_id = p_numero_id;

    ELSE
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El médico no existe en medico_desactivado';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reactivar_paciente` (IN `p_numero_id` INT)  BEGIN
        IF EXISTS (SELECT 1 FROM paciente_desactivado WHERE numero_id = p_numero_id) THEN

                INSERT INTO paciente (
            tipo_id,
            numero_id,
            nombres,
            apellidos,
            correo,
            contrasena,
            direccion,
            municipio_id,
            telefono_principal,
            fecha_nac
        )
        SELECT
            tipo_id,
            numero_id,
            nombres,
            apellidos,
            correo,
            contrasena,
            direccion,
            municipio_id,
            telefono_principal,
            fecha_nac
        FROM paciente_desactivado
        WHERE numero_id = p_numero_id;

                DELETE FROM paciente_desactivado WHERE numero_id = p_numero_id;

    ELSE
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El paciente no existe en paciente_desactivado';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `tipo_id` varchar(10) NOT NULL,
  `numero_id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `telefono_principal` varchar(20) NOT NULL,
  `fecha_nac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`tipo_id`, `numero_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio_id`, `telefono_principal`, `fecha_nac`) VALUES
('CC', 1000000001, 'Ana', 'García', 'ana.garcia@hospital.com', 'pass123', 'Av. Siempre Viva 123', 1, '3001112233', '1980-01-01'),
('CC', 1000000008, 'Andrés', 'Ruiz', 'andres.ruiz@hospital.com', 'pass123', 'Carrera Libertad 505', 8, '3008889900', '1994-08-08'),
('CC', 1000000011, 'Camila', 'Vargas', 'camila.vargas@hospital.com', 'pass123', 'Av. Unión 808', 1, '3001122334', '2000-11-11'),
('CC', 1000000004, 'Carlos', 'Rodríguez', 'carlos.rodriguez@hospital.com', 'pass123', 'Diagonal Cielo 101', 4, '3004445566', '1986-04-04'),
('CC', 1000000017, 'Daniela', 'Aguilar', 'daniela.aguilar@hospital.com', 'pass123', 'Calle Lealtad 1414', 7, '3007788990', '1989-05-17'),
('CC', 1000000010, 'Diego', 'Torres', 'diego.torres@hospital.com', 'pass123', 'Transversal Esperanza 707', 10, '3000001122', '1998-10-10'),
('CC', 1000000023, 'Elena', 'Salazar', 'elena.salazar@hospital.com', 'pass123', 'Carrera Éxito 2020', 3, '3003344557', '1980-11-23'),
('CC', 1000000018, 'Felipe', 'Cruz', 'felipe.cruz@hospital.com', 'pass123', 'Carrera Honestidad 1515', 8, '3008899001', '1991-06-18'),
('CC', 1000000012, 'Gabriel', 'Castro', 'gabriel.castro@hospital.com', 'pass123', 'Calle Armonía 909', 2, '3002233445', '1979-12-12'),
('CC', 1000000009, 'Isabella', 'Hernández', 'isabella.hernandez@hospital.com', 'pass123', 'Diagonal Futuro 606', 9, '3009990011', '1996-09-09'),
('CC', 1000000020, 'Joaquín', 'Ramírez', 'joaquin.ramirez@hospital.com', 'pass123', 'Transversal Paz 1717', 10, '3000011223', '1995-08-20'),
('CC', 1000000005, 'Laura', 'Fernández', 'laura.fernandez@hospital.com', 'pass123', 'Transversal Tierra 202', 5, '3005556677', '1988-05-05'),
('CC', 1000000013, 'Luciana', 'Mora', 'luciana.mora@hospital.com', 'pass123', 'Carrera Felicidad 1010', 3, '3003344556', '1981-01-13'),
('CC', 1000000019, 'Mariana', 'Delgado', 'mariana.delgado@hospital.com', 'pass123', 'Diagonal Justicia 1616', 9, '3009900112', '1993-07-19'),
('CC', 1000000014, 'Mateo', 'Soto', 'mateo.soto@hospital.com', 'pass123', 'Diagonal Bienestar 1111', 4, '3004455667', '1983-02-14'),
('CC', 1000000006, 'Miguel', 'Gómez', 'miguel.gomez@hospital.com', 'pass123', 'Avenida Paz 303', 6, '3006667788', '1990-06-06'),
('CC', 1000000024, 'Pablo', 'Mendoza', 'pablo.mendoza@hospital.com', 'pass123', 'Diagonal Triunfo 2121', 4, '3004455668', '1982-12-24'),
('CC', 1000000015, 'Paula', 'Herrera', 'paula.herrera@hospital.com', 'pass123', 'Transversal Progreso 1212', 5, '3005566778', '1985-03-15'),
('CC', 1000000002, 'Pedro', 'Martínez', 'pedro.martinez@hospital.com', 'pass123', 'Calle Luna 456', 2, '3002223344', '1982-02-02'),
('CC', 1000000022, 'Ricardo', 'Guerra', 'ricardo.guerra@hospital.com', 'pass123', 'Calle Virtud 1919', 2, '3002233446', '1999-10-22'),
('CC', 1011085814, 'David Santiago', 'Rincon Hernandez', 'santirinconh@gmail.com', '12345', 'Calle 61 sur #20D 60', 5, '3223696999', '2005-07-02'),
('CC', 1000000021, 'Sara', 'Núñez', 'sara.nunez@hospital.com', 'pass123', 'Av. Gloria 1818', 1, '3001122335', '1997-09-21'),
('CC', 1000000016, 'Sebastián', 'Silva', 'sebastian.silva@hospital.com', 'pass123', 'Av. Concordia 1313', 6, '3006677889', '1987-04-16'),
('CC', 1000000003, 'Sofía', 'López', 'sofia.lopez@hospital.com', 'pass123', 'Carrera Sol 789', 3, '3003334455', '1984-03-03'),
('CC', 1000000007, 'Valeria', 'Díaz', 'valeria.diaz@hospital.com', 'pass123', 'Calle Progreso 404', 7, '3007778899', '1992-07-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_telefono`
--

CREATE TABLE `admin_telefono` (
  `numero_id` int(11) NOT NULL,
  `numero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin_telefono`
--

INSERT INTO `admin_telefono` (`numero_id`, `numero`) VALUES
(1000000001, '3001112233'),
(1000000002, '3002223344'),
(1000000003, '3003334455'),
(1000000004, '3004445566'),
(1000000005, '3005556677'),
(1000000006, '3006667788'),
(1000000007, '3007778899'),
(1000000008, '3008889900'),
(1000000009, '3009990011'),
(1000000010, '3000001122'),
(1000000011, '3001122334'),
(1000000012, '3002233445'),
(1000000013, '3003344556'),
(1000000014, '3004455667'),
(1000000015, '3005566778'),
(1000000016, '3006677889'),
(1000000017, '3007788990'),
(1000000018, '3008899001'),
(1000000019, '3009900112'),
(1000000020, '3000011223'),
(1000000021, '3001122335'),
(1000000022, '3002233446'),
(1000000023, '3003344557'),
(1000000024, '3004455668'),
(1011085814, '3223696999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `noticia_id` int(11) NOT NULL,
  `noticia_titulo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `noticia` longtext COLLATE utf8_unicode_ci NOT NULL,
  `crear_timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`noticia_id`, `noticia_titulo`, `noticia`, `crear_timestamp`) VALUES
(1, 'Navidad', 'Llega la navidad al hospital!', 1734994800),
(2, 'Noche Buena', 'Llega la noche buena al hospital!', 1735081200),
(3, 'Fin de Año', 'Se acaba un año más de servicio', 1735599600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `cita_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `lugar_id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`cita_id`, `fecha_hora`, `lugar_id`, `medico_id`, `paciente_id`, `especialidad_id`, `estado_id`, `fecha_registro`, `fecha_actualizacion`) VALUES
(1, '2025-06-02 15:20:00', 3, 12345, 123, 1, 2, '2025-06-30 23:29:35', '2025-07-05 19:14:03'),
(2, '2025-06-28 14:00:00', 5, 12345, 123, 1, 3, '2025-07-05 02:40:37', '2025-07-05 04:43:13'),
(3, '2025-07-15 10:00:00', 5, 12345, 123, 1, 4, '2025-07-05 02:40:40', '2025-07-09 05:52:09'),
(4, '2025-05-17 10:00:00', 4, 12345, 123, 1, 4, '2025-07-05 02:49:01', '2025-07-05 04:43:03'),
(6, '2025-05-25 12:00:00', 4, 12345, 123, 1, 4, '2025-07-05 02:49:01', '2025-07-05 04:42:59'),
(17, '2025-07-10 10:38:00', 15, 12345, 123, 1, 3, '2025-07-05 22:38:15', '2025-07-05 22:52:04'),
(18, '2025-07-05 11:00:00', 15, 12345, 123, 1, 1, '2025-07-05 22:52:23', '2025-07-05 22:52:23'),
(19, '2025-07-11 07:03:00', 1, 12345, 123, 1, 1, '2025-07-09 04:03:25', '2025-07-09 04:03:25'),
(20, '2025-07-09 15:00:00', 8, 123456789, 1234567890, 1, 1, '2025-07-08 21:49:21', '2025-07-08 21:49:21'),
(21, '2025-07-09 09:30:00', 15, 123456789, 123, 1, 1, '2025-07-09 05:21:04', '2025-07-09 05:21:04'),
(23, '2025-07-14 12:00:00', 12, 12345, 1234567890, 1, 1, '2025-07-09 05:41:17', '2025-07-09 05:41:17'),
(24, '2025-07-15 10:00:00', 11, 123456789, 1011085814, 1, 1, '2025-07-09 05:47:36', '2025-07-09 05:47:36'),
(25, '2025-07-29 12:00:00', 10, 12345, 123, 2, 1, '2025-07-09 05:56:57', '2025-07-09 05:56:57'),
(26, '2025-07-14 15:00:00', 9, 123456789, 123, 2, 1, '2025-07-09 05:57:37', '2025-07-09 05:57:37'),
(27, '2025-08-19 09:30:00', 14, 12345, 123, 2, 1, '2025-07-09 05:58:05', '2025-07-09 05:58:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `especialidad_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`especialidad_id`, `nombre`, `descripcion`) VALUES
(1, 'Medicina General', 'Atención primaria de salud'),
(2, 'Nutrición', 'Estudio de la alimentación y su impacto en la salud.'),
(3, 'Pediatría', 'Atención médica a niños y adolescentes.'),
(4, 'Cardiología', 'Enfermedades del corazón y sistema circulatorio.'),
(5, 'Dermatología', 'Enfermedades de la piel, cabello y uñas.'),
(6, 'Ginecología', 'Salud del sistema reproductor femenino y obstetricia.'),
(7, 'Oftalmología', 'Enfermedades y trastornos de los ojos.'),
(8, 'Ortopedia', 'Lesiones y enfermedades del sistema musculoesquelético.'),
(9, 'Neurología', 'Trastornos del sistema nervioso.'),
(10, 'Psiquiatría', 'Trastornos mentales y emocionales.'),
(11, 'Oncología', 'Diagnóstico y tratamiento del cáncer.'),
(12, 'Endocrinología', 'Trastornos de las glándulas endocrinas y hormonas.'),
(13, 'Gastroenterología', 'Enfermedades del sistema digestivo.'),
(14, 'Urología', 'Enfermedades del sistema urinario y reproductor masculino.'),
(15, 'Nefrología', 'Enfermedades de los riñones.'),
(16, 'Reumatología', 'Enfermedades del sistema musculoesquelético y tejido conectivo.'),
(17, 'Infectología', 'Enfermedades infecciosas.'),
(18, 'Neumología', 'Enfermedades del sistema respiratorio.'),
(19, 'Hematología', 'Enfermedades de la sangre y órganos hematopoyéticos.'),
(20, 'Anestesiología', 'Administración de anestesia y manejo del dolor.'),
(21, 'Radiología', 'Diagnóstico por imágenes.'),
(22, 'Cirugía General', 'Procedimientos quirúrgicos generales.'),
(23, 'Fisioterapia', 'Rehabilitación física.'),
(24, 'Odontología', 'Salud bucodental.'),
(25, 'Geriatría', 'Atención médica a personas mayores.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cita`
--

CREATE TABLE `estado_cita` (
  `estado_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_cita`
--

INSERT INTO `estado_cita` (`estado_id`, `nombre`, `descripcion`) VALUES
(1, 'Programada', 'Cita agendada pero no atendida'),
(2, 'Completada', 'Cita atendida satisfactoriamente'),
(3, 'Cancelada', 'Cita cancelada por el paciente o médico'),
(4, 'No asistió', 'Paciente no se presentó a la cita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `lugar_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`lugar_id`, `nombre`) VALUES
(1, 'Clínica Colsubsidio'),
(2, 'Clínica del Country'),
(3, 'Hospital San Ignacio'),
(4, 'Fundación Santa Fe de Bogotá'),
(5, 'Hospital Militar Central'),
(6, 'Clínica Shaio'),
(7, 'Hospital Universitario San José'),
(8, 'Clínica Reina Sofía'),
(9, 'Clínica Marly'),
(10, 'Hospital Simón Bolívar'),
(11, 'Clínica Palermo'),
(12, 'Hospital de Engativá'),
(13, 'Clínica El Rosario'),
(14, 'Hospital Meissen'),
(15, 'Clínica La Sabana'),
(16, 'Clínica Occidente'),
(17, 'Hospital de Kennedy'),
(18, 'Clínica San Rafael'),
(19, 'Hospital La Samaritana'),
(20, 'Clínica de Occidente'),
(21, 'Clínica del Niño'),
(22, 'Hospital Infantil Universitario de San José'),
(23, 'Clínica Santa María del Lago'),
(24, 'Hospital Fontibón'),
(25, 'Clínica del Bosque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `tipo_id` varchar(10) NOT NULL,
  `numero_id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `telefono_principal` varchar(20) NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`tipo_id`, `numero_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio_id`, `telefono_principal`, `especialidad_id`, `fecha_nac`, `fecha_registro`) VALUES
('CC', 12345, 'Salomon', 'Villada', 'salomon@gmail.com', '123', 'Calle 62 suyr #2D 60', 7, '56789', 1, '1998-09-24', '2025-07-08 20:28:08'),
('CC', 10000001, 'María', 'Gómez', 'maria.gomez@hospital.com', 'med123', 'Carrera 10 #20-30', 2, '3109876543', 2, '1975-03-10', '2025-07-08 23:48:40'),
('CC', 10000002, 'Pedro', 'Ramírez', 'pedro.ramirez@hospital.com', 'med123', 'Avenida 5 #15-25', 3, '3112345678', 3, '1980-07-20', '2025-07-08 23:48:40'),
('CC', 10000003, 'Ana', 'López', 'ana.lopez@hospital.com', 'med123', 'Calle 40 #5-10', 4, '3128765432', 4, '1970-11-05', '2025-07-08 23:48:40'),
('CC', 10000004, 'Luis', 'Hernández', 'luis.hernandez@hospital.com', 'med123', 'Diagonal 70 #8-12', 5, '3134567890', 5, '1988-01-25', '2025-07-08 23:48:40'),
('CC', 10000005, 'Sofía', 'Díaz', 'sofia.diaz@hospital.com', 'med123', 'Transversal 3 #6-9', 6, '3145678901', 6, '1992-04-30', '2025-07-08 23:48:40'),
('CC', 10000006, 'Carlos', 'Martínez', 'carlos.martinez@hospital.com', 'med123', 'Calle 25 #1-5', 7, '3156789012', 7, '1965-09-15', '2025-07-08 23:48:40'),
('CC', 10000007, 'Laura', 'Sánchez', 'laura.sanchez@hospital.com', 'med123', 'Carrera 80 #10-20', 8, '3167890123', 8, '1978-02-18', '2025-07-08 23:48:40'),
('CC', 10000008, 'Roberto', 'Pérez', 'roberto.perez@hospital.com', 'med123', 'Avenida 9 #30-40', 9, '3178901234', 9, '1983-06-22', '2025-07-08 23:48:40'),
('CC', 10000009, 'Elena', 'Torres', 'elena.torres@hospital.com', 'med123', 'Calle 50 #12-15', 10, '3189012345', 10, '1972-10-01', '2025-07-08 23:48:40'),
('CC', 10000010, 'Jorge', 'Flores', 'jorge.flores@hospital.com', 'med123', 'Diagonal 60 #2-4', 1, '3190123456', 11, '1981-05-11', '2025-07-08 23:48:40'),
('CC', 10000011, 'Andrea', 'Castro', 'andrea.castro@hospital.com', 'med123', 'Transversal 1 #1-1', 2, '3201234567', 12, '1990-08-03', '2025-07-08 23:48:40'),
('CC', 10000012, 'Fernando', 'Ruiz', 'fernando.ruiz@hospital.com', 'med123', 'Calle 70 #3-7', 3, '3212345678', 13, '1968-12-09', '2025-07-08 23:48:40'),
('CC', 10000013, 'Marta', 'Vargas', 'marta.vargas@hospital.com', 'med123', 'Carrera 4 #18-22', 4, '3223456789', 14, '1977-01-14', '2025-07-08 23:48:40'),
('CC', 10000014, 'Gabriel', 'Morales', 'gabriel.morales@hospital.com', 'med123', 'Avenida 11 #22-33', 5, '3234567890', 15, '1984-04-29', '2025-07-08 23:48:40'),
('CC', 10000015, 'Paola', 'Gil', 'paola.gil@hospital.com', 'med123', 'Calle 65 #7-11', 6, '3245678901', 16, '1995-07-07', '2025-07-08 23:48:40'),
('CC', 10000016, 'Sergio', 'Rojas', 'sergio.rojas@hospital.com', 'med123', 'Diagonal 55 #1-3', 7, '3256789012', 17, '1962-09-01', '2025-07-08 23:48:40'),
('CC', 10000017, 'Diana', 'Blanco', 'diana.blanco@hospital.com', 'med123', 'Transversal 15 #14-16', 8, '3267890123', 18, '1973-11-20', '2025-07-08 23:48:40'),
('CC', 10000018, 'Ricardo', 'Castillo', 'ricardo.castillo@hospital.com', 'med123', 'Calle 80 #20-25', 9, '3278901234', 19, '1989-03-08', '2025-07-08 23:48:40'),
('CC', 10000019, 'Carolina', 'Mendoza', 'carolina.mendoza@hospital.com', 'med123', 'Carrera 90 #5-5', 10, '3289012345', 20, '1993-12-12', '2025-07-08 23:48:40'),
('CC', 10000020, 'Esteban', 'Guerrero', 'esteban.guerrero@hospital.com', 'med123', 'Avenida 20 #1-1', 1, '3290123456', 21, '1976-06-16', '2025-07-08 23:48:40'),
('CC', 10000021, 'Jimena', 'Valencia', 'jimena.valencia@hospital.com', 'med123', 'Calle 95 #10-10', 2, '3301234567', 22, '1986-02-04', '2025-07-08 23:48:40'),
('CC', 10000022, 'Alejandro', 'Franco', 'alejandro.franco@hospital.com', 'med123', 'Diagonal 30 #30-30', 3, '3312345678', 23, '1991-10-28', '2025-07-08 23:48:40'),
('CC', 10000023, 'Natalia', 'Ortiz', 'natalia.ortiz@hospital.com', 'med123', 'Transversal 25 #25-25', 4, '3323456789', 24, '1971-04-02', '2025-07-08 23:48:40'),
('CC', 123456789, 'Juan', 'Pérez', 'juan.perez@ejemplo.com', '1234', 'Calle 123 #45-67', 1, '3001234567', 1, '1985-08-15', '2025-07-08 20:28:08');

--
-- Disparadores `medico`
--
DELIMITER $$
CREATE TRIGGER `trg_medico_desactivado` BEFORE DELETE ON `medico` FOR EACH ROW BEGIN
        INSERT INTO medico_desactivado (
        tipo_id,
        numero_id,
        nombres,
        apellidos,
        correo,
        contrasena,
        direccion,
        municipio_id,
        telefono_principal,
        especialidad_id,
        fecha_nac,
        fecha_desactivacion,
        usuario_desactivador
    ) VALUES (
        OLD.tipo_id,
        OLD.numero_id,
        OLD.nombres,
        OLD.apellidos,
        OLD.correo,
        OLD.contrasena,
        OLD.direccion,
        OLD.municipio_id,
        OLD.telefono_principal,
        OLD.especialidad_id,
        OLD.fecha_nac,
        NOW(),
        CURRENT_USER()
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_desactivado`
--

CREATE TABLE `medico_desactivado` (
  `tipo_id` varchar(10) NOT NULL,
  `numero_id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `telefono_principal` varchar(20) NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `fecha_desactivacion` datetime NOT NULL,
  `usuario_desactivador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medico_desactivado`
--

INSERT INTO `medico_desactivado` (`tipo_id`, `numero_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio_id`, `telefono_principal`, `especialidad_id`, `fecha_nac`, `fecha_desactivacion`, `usuario_desactivador`) VALUES
('CC', 2002, 'Carlos', 'Pérez', 'carlos.perez@example.com', '12345', 'Calle 123 #45-67', 1, '3201234567', 1, '1985-04-10', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2003, 'Laura', 'Mendez', 'laura.mendez@example.com', 'pass123', 'Av. Siempre Viva 10', 2, '3010000001', 2, '1990-01-01', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2004, 'Roberto', 'García', 'roberto.garcia@example.com', 'pass123', 'Calle Falsa 123', 3, '3020000002', 3, '1985-02-02', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2005, 'Sofía', 'Rodríguez', 'sofia.rodriguez@example.com', 'pass123', 'Carrera 7 #1-1', 4, '3030000003', 4, '1978-03-03', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2006, 'Andrés', 'Silva', 'andres.silva@example.com', 'pass123', 'Diagonal 100 #20-20', 5, '3040000004', 5, '1992-04-04', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2007, 'Valeria', 'Castro', 'valeria.castro@example.com', 'pass123', 'Transversal 50 #5-5', 6, '3050000005', 6, '1981-05-05', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2008, 'Juan', 'Cruz', 'juan.cruz@example.com', 'pass123', 'Calle 2 #10-10', 7, '3060000006', 7, '1970-06-06', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2009, 'Mariana', 'Vargas', 'mariana.vargas@example.com', 'pass123', 'Carrera 3 #15-15', 8, '3070000007', 8, '1995-07-07', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2010, 'Felipe', 'Navarro', 'felipe.navarro@example.com', 'pass123', 'Avenida 4 #20-20', 9, '3080000008', 9, '1983-08-08', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2011, 'Daniela', 'Soto', 'daniela.soto@example.com', 'pass123', 'Diagonal 5 #25-25', 10, '3090000009', 10, '1976-09-09', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2012, 'Oscar', 'Herrera', 'oscar.herrera@example.com', 'pass123', 'Transversal 6 #30-30', 1, '3100000010', 11, '1998-10-10', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2013, 'Alejandra', 'Mora', 'alejandra.mora@example.com', 'pass123', 'Calle 7 #35-35', 2, '3110000011', 12, '1987-11-11', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2014, 'Pablo', 'Márquez', 'pablo.marquez@example.com', 'pass123', 'Carrera 8 #40-40', 3, '3120000012', 13, '1979-12-12', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2015, 'Gabriela', 'Prieto', 'gabriela.prieto@example.com', 'pass123', 'Avenida 9 #45-45', 4, '3130000013', 14, '1991-01-13', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2016, 'Cristian', 'Reyes', 'cristian.reyes@example.com', 'pass123', 'Diagonal 10 #50-50', 5, '3140000014', 15, '1982-02-14', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2017, 'Laura', 'Jiménez', 'laura.jimenez@example.com', 'pass123', 'Transversal 11 #55-55', 6, '3150000015', 16, '1975-03-15', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2018, 'Diego', 'Osorio', 'diego.osorio@example.com', 'pass123', 'Calle 12 #60-60', 7, '3160000016', 17, '1994-04-16', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2019, 'Sara', 'Castro', 'sara.castro@example.com', 'pass123', 'Carrera 13 #65-65', 8, '3170000017', 18, '1980-05-17', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2020, 'Julián', 'Patiño', 'julian.patino@example.com', 'pass123', 'Avenida 14 #70-70', 9, '3180000018', 19, '1973-06-18', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2021, 'Camila', 'Vázquez', 'camila.vazquez@example.com', 'pass123', 'Diagonal 15 #75-75', 10, '3190000019', 20, '1997-07-19', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2022, 'Martín', 'Solano', 'martin.solano@example.com', 'pass123', 'Transversal 16 #80-80', 1, '3200000020', 21, '1988-08-20', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2023, 'Sofía', 'Fuentes', 'sofia.fuentes@example.com', 'pass123', 'Calle 17 #85-85', 2, '3210000021', 22, '1977-09-21', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2024, 'Manuel', 'Rincón', 'manuel.rincon@example.com', 'pass123', 'Carrera 18 #90-90', 3, '3220000022', 23, '1990-10-22', '2025-07-05 12:27:13', 'root@localhost'),
('CC', 2025, 'Valeria', 'Montoya', 'valeria.montoya@example.com', 'pass123', 'Avenida 19 #95-95', 4, '3230000023', 24, '1983-11-23', '2025-07-05 12:27:13', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_telefono`
--

CREATE TABLE `medico_telefono` (
  `numero` varchar(20) NOT NULL,
  `numero_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medico_telefono`
--

INSERT INTO `medico_telefono` (`numero`, `numero_id`) VALUES
('56789', 12345),
('3109876543', 10000001),
('3112345678', 10000002),
('3128765432', 10000003),
('3134567890', 10000004),
('3145678901', 10000005),
('3156789012', 10000006),
('3167890123', 10000007),
('3178901234', 10000008),
('3189012345', 10000009),
('3190123456', 10000010),
('3201234567', 10000011),
('3212345678', 10000012),
('3223456789', 10000013),
('3234567890', 10000014),
('3245678901', 10000015),
('3256789012', 10000016),
('3267890123', 10000017),
('3278901234', 10000018),
('3289012345', 10000019),
('3290123456', 10000020),
('3301234567', 10000021),
('3312345678', 10000022),
('3323456789', 10000023),
('3001234567', 123456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `municipio_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`municipio_id`, `nombre`) VALUES
(1, 'Bogota'),
(2, 'Medellín'),
(3, 'Cali'),
(4, 'Barranquilla'),
(5, 'Cartagena'),
(6, 'Bucaramanga'),
(7, 'Cúcuta'),
(8, 'Soacha'),
(9, 'Ibagué'),
(10, 'Villavicencio'),
(11, 'Pereira'),
(12, 'Manizales'),
(13, 'Armenia'),
(14, 'Pasto'),
(15, 'Popayán'),
(16, 'Santa Marta'),
(17, 'Neiva'),
(18, 'Tunja'),
(19, 'Riohacha'),
(20, 'Montería'),
(21, 'Valledupar'),
(22, 'Sincelejo'),
(23, 'Quibdó'),
(24, 'Yopal'),
(25, 'Florencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `tipo_id` varchar(10) NOT NULL,
  `numero_id` int(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `telefono_principal` varchar(20) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`tipo_id`, `numero_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio_id`, `telefono_principal`, `fecha_nac`, `fecha_registro`) VALUES
('CC', 123, 'Andres', 'Gomez', 'andres@gmail.com', '123456789', 'Calle 64 sur #20D 60', 1, '3223696999', '0000-00-00', '2025-06-30 21:53:31'),
('CC', 1000000000, 'Juan', 'Pérez', 'juan.perez@example.com', 'pass123', 'Calle 10 #20-30', 1, '3001234567', '1990-01-01', '2025-07-05 23:07:35'),
('CC', 1000000001, 'Ana', 'García', 'ana.garcia@example.com', 'pass123', 'Avenida 20 #30-40', 2, '3012345678', '1985-02-02', '2025-07-05 23:07:35'),
('CC', 1000000002, 'Carlos', 'López', 'carlos.lopez@example.com', 'pass123', 'Carrera 30 #40-50', 3, '3023456789', '1992-03-03', '2025-07-05 23:07:35'),
('CC', 1000000003, 'Sofía', 'Rodríguez', 'sofia.rodriguez@example.com', 'pass123', 'Diagonal 40 #50-60', 4, '3034567890', '1978-04-04', '2025-07-05 23:07:35'),
('CC', 1000000004, 'Miguel', 'Fernández', 'miguel.fernandez@example.com', 'pass123', 'Transversal 50 #60-70', 5, '3045678901', '2000-05-05', '2025-07-05 23:07:35'),
('CC', 1000000005, 'Valeria', 'Gómez', 'valeria.gomez@example.com', 'pass123', 'Calle 60 #70-80', 6, '3056789012', '1997-06-06', '2025-07-05 23:07:35'),
('CC', 1000000006, 'Andrés', 'Díaz', 'andres.diaz@example.com', 'pass123', 'Avenida 70 #80-90', 7, '3067890123', '1982-07-07', '2025-07-05 23:07:35'),
('CC', 1000000007, 'Isabella', 'Ruiz', 'isabella.ruiz@example.com', 'pass123', 'Carrera 80 #90-100', 8, '3078901234', '1994-08-08', '2025-07-05 23:07:35'),
('CC', 1000000008, 'Diego', 'Hernández', 'diego.hernandez@example.com', 'pass123', 'Diagonal 90 #100-110', 9, '3089012345', '1975-09-09', '2025-07-05 23:07:35'),
('CC', 1000000009, 'Camila', 'Torres', 'camila.torres@example.com', 'pass123', 'Transversal 100 #110-120', 10, '3090123456', '1999-10-10', '2025-07-05 23:07:35'),
('CC', 1000000010, 'Gabriel', 'Vargas', 'gabriel.vargas@example.com', 'pass123', 'Calle 110 #120-130', 1, '3101234567', '1980-11-11', '2025-07-05 23:07:35'),
('CC', 1000000011, 'Luciana', 'Castro', 'luciana.castro@example.com', 'pass123', 'Avenida 120 #130-140', 2, '3112345678', '1993-12-12', '2025-07-05 23:07:35'),
('CC', 1000000012, 'Mateo', 'Mora', 'mateo.mora@example.com', 'pass123', 'Carrera 130 #140-150', 3, '3123456789', '1970-01-13', '2025-07-05 23:07:35'),
('CC', 1000000013, 'Paula', 'Soto', 'paula.soto@example.com', 'pass123', 'Diagonal 140 #150-160', 4, '3134567890', '1996-02-14', '2025-07-05 23:07:35'),
('CC', 1000000014, 'Sebastián', 'Herrera', 'sebastian.herrera@example.com', 'pass123', 'Transversal 150 #160-170', 5, '3145678901', '1981-03-15', '2025-07-05 23:07:35'),
('CC', 1000000015, 'Daniela', 'Silva', 'daniela.silva@example.com', 'pass123', 'Calle 160 #170-180', 6, '3156789012', '1998-04-16', '2025-07-05 23:07:35'),
('CC', 1000000016, 'Felipe', 'Aguilar', 'felipe.aguilar@example.com', 'pass123', 'Avenida 170 #180-190', 7, '3167890123', '1983-05-17', '2025-07-05 23:07:35'),
('CC', 1000000017, 'Mariana', 'Cruz', 'mariana.cruz@example.com', 'pass123', 'Carrera 180 #190-200', 8, '3178901234', '1991-06-18', '2025-07-05 23:07:35'),
('CC', 1000000018, 'Joaquín', 'Delgado', 'joaquin.delgado@example.com', 'pass123', 'Diagonal 190 #200-210', 9, '3189012345', '1976-07-19', '2025-07-05 23:07:35'),
('CC', 1000000019, 'Sara', 'Ramírez', 'sara.ramirez@example.com', 'pass123', 'Transversal 200 #210-220', 10, '3190123456', '1995-08-20', '2025-07-05 23:07:35'),
('CC', 1000000020, 'Ricardo', 'Núñez', 'ricardo.nunez@example.com', 'pass123', 'Calle 210 #220-230', 1, '3201234567', '1987-09-21', '2025-07-05 23:07:35'),
('CC', 1000000021, 'Elena', 'Guerra', 'elena.guerra@example.com', 'pass123', 'Avenida 220 #230-240', 2, '3212345678', '1990-10-22', '2025-07-05 23:07:35'),
('CC', 1011085814, 'David', 'Hernandez', 'david@gmail.com', '1011085814', 'Calle 61 sur #20D 60', 1, '3223696999', '2005-07-02', '2025-07-05 20:50:59'),
('CC', 1234567890, 'Laura María', 'Ramírez Gómez', 'laura.ramirez@example.com', 'laura123', 'Calle 15 #45-67', 2, '3104567890', '1995-08-20', '2025-07-05 18:07:35');

--
-- Disparadores `paciente`
--
DELIMITER $$
CREATE TRIGGER `trg_paciente_desactivado` BEFORE DELETE ON `paciente` FOR EACH ROW BEGIN
        INSERT INTO paciente_desactivado (
        tipo_id,
        numero_id,
        nombres,
        apellidos,
        correo,
        contrasena,
        direccion,
        municipio_id,
        telefono_principal,
        fecha_nac,
        fecha_desactivacion,
        usuario_desactivador
    ) VALUES (
        OLD.tipo_id,
        OLD.numero_id,
        OLD.nombres,
        OLD.apellidos,
        OLD.correo,
        OLD.contrasena,
        OLD.direccion,
        OLD.municipio_id,
        OLD.telefono_principal,
        OLD.fecha_nac,
        NOW(),
        CURRENT_USER()
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_desactivado`
--

CREATE TABLE `paciente_desactivado` (
  `tipo_id` varchar(10) NOT NULL,
  `numero_id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `telefono_principal` varchar(20) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `fecha_desactivacion` datetime NOT NULL,
  `usuario_desactivador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente_desactivado`
--

INSERT INTO `paciente_desactivado` (`tipo_id`, `numero_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio_id`, `telefono_principal`, `fecha_nac`, `fecha_desactivacion`, `usuario_desactivador`) VALUES
('CC', 2001, 'Laura', 'Gómez Martínez', 'laura.gomez@example.com', '123456', 'Calle 45B #12-34', 1, '3117894561', '2000-08-15', '2025-07-05 13:06:05', 'root@localhost'),
('CC', 1011085814, 'David', 'Hernandez', 'david@gmail.com', '123456', 'Calle 61 sur #20D 60', 1, '3223696999', '2005-07-02', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000000, 'Sofía', 'Pérez', 'sofia.perez@example.com', 'pass123', 'Calle 100 #10-10', 2, '3000000001', '1990-01-01', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000001, 'Martín', 'García', 'martin.garcia@example.com', 'pass123', 'Avenida 200 #20-20', 3, '3000000002', '1985-02-02', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000002, 'Daniela', 'López', 'daniela.lopez@example.com', 'pass123', 'Carrera 300 #30-30', 4, '3000000003', '1992-03-03', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000003, 'Jorge', 'Rodríguez', 'jorge.rodriguez@example.com', 'pass123', 'Diagonal 400 #40-40', 5, '3000000004', '1978-04-04', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000004, 'Lucía', 'Fernández', 'lucia.fernandez@example.com', 'pass123', 'Transversal 500 #50-50', 6, '3000000005', '2000-05-05', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000005, 'Alejandro', 'Gómez', 'alejandro.gomez@example.com', 'pass123', 'Calle 600 #60-60', 7, '3000000006', '1997-06-06', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000006, 'Andrea', 'Díaz', 'andrea.diaz@example.com', 'pass123', 'Avenida 700 #70-70', 8, '3000000007', '1982-07-07', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000007, 'Fernando', 'Ruiz', 'fernando.ruiz@example.com', 'pass123', 'Carrera 800 #80-80', 9, '3000000008', '1994-08-08', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000008, 'Valeria', 'Hernández', 'valeria.hernandez@example.com', 'pass123', 'Diagonal 900 #90-90', 10, '3000000009', '1975-09-09', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000009, 'Ricardo', 'Torres', 'ricardo.torres@example.com', 'pass123', 'Transversal 1000 #100-100', 1, '3000000010', '1999-10-10', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000010, 'Paula', 'Vargas', 'paula.vargas@example.com', 'pass123', 'Calle 1100 #110-110', 2, '3000000011', '1980-11-11', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000011, 'José', 'Castro', 'jose.castro@example.com', 'pass123', 'Avenida 1200 #120-120', 3, '3000000012', '1993-12-12', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000012, 'Carolina', 'Mora', 'carolina.mora@example.com', 'pass123', 'Carrera 1300 #130-130', 4, '3000000013', '1970-01-13', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000013, 'Esteban', 'Soto', 'esteban.soto@example.com', 'pass123', 'Diagonal 1400 #140-140', 5, '3000000014', '1996-02-14', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000014, 'Jimena', 'Herrera', 'jimena.herrera@example.com', 'pass123', 'Transversal 1500 #150-150', 6, '3000000015', '1981-03-15', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000015, 'Manuel', 'Silva', 'manuel.silva@example.com', 'pass123', 'Calle 1600 #160-160', 7, '3000000016', '1998-04-16', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000016, 'Natalia', 'Aguilar', 'natalia.aguilar@example.com', 'pass123', 'Avenida 1700 #170-170', 8, '3000000017', '1983-05-17', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000017, 'Juan Pablo', 'Cruz', 'juanpablo.cruz@example.com', 'pass123', 'Carrera 1800 #180-180', 9, '3000000018', '1991-06-18', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000018, 'Luisa', 'Delgado', 'luisa.delgado@example.com', 'pass123', 'Diagonal 1900 #190-190', 10, '3000000019', '1976-07-19', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000019, 'Santiago', 'Ramírez', 'santiago.ramirez@example.com', 'pass123', 'Transversal 2000 #200-200', 1, '3000000020', '1995-08-20', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000020, 'Valentina', 'Núñez', 'valentina.nunez@example.com', 'pass123', 'Calle 2100 #210-210', 2, '3000000021', '1987-09-21', '2025-07-05 15:50:20', 'root@localhost'),
('CC', 2000000021, 'Sebastián', 'Guerra', 'sebastian.guerra@example.com', 'pass123', 'Avenida 2200 #220-220', 3, '3000000022', '1990-10-22', '2025-07-05 15:50:20', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_telefono`
--

CREATE TABLE `paciente_telefono` (
  `numero_id` int(11) NOT NULL,
  `numero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente_telefono`
--

INSERT INTO `paciente_telefono` (`numero_id`, `numero`) VALUES
(123, '3223696999'),
(1000000000, '3001234567'),
(1000000001, '3012345678'),
(1000000002, '3023456789'),
(1000000003, '3034567890'),
(1000000004, '3045678901'),
(1000000005, '3056789012'),
(1000000006, '3067890123'),
(1000000007, '3078901234'),
(1000000008, '3089012345'),
(1000000009, '3090123456'),
(1000000010, '3101234567'),
(1000000011, '3112345678'),
(1000000012, '3123456789'),
(1000000013, '3134567890'),
(1000000014, '3145678901'),
(1000000015, '3156789012'),
(1000000016, '3167890123'),
(1000000017, '3178901234'),
(1000000018, '3189012345'),
(1000000019, '3190123456'),
(1000000020, '3201234567'),
(1000000021, '3212345678'),
(1011085814, '3223696999'),
(1234567890, '3104567890');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `reporte_id` int(11) NOT NULL,
  `tipo` longtext NOT NULL COMMENT 'medico,paciente,ausentes',
  `mes` int(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `parametro_id` int(11) DEFAULT NULL,
  `fecha_generacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`reporte_id`, `tipo`, `mes`, `ano`, `parametro_id`, `fecha_generacion`) VALUES
(1, 'medico', 2025, 2025, 123456789, '2025-07-09 06:11:33'),
(2, 'medico', 2025, 2025, 123456789, '2025-07-09 06:11:43'),
(3, 'medico', 2025, 2025, 12345, '2025-07-09 06:11:47'),
(4, 'paciente', 2025, 2025, 1234567890, '2025-07-09 06:13:38'),
(5, 'paciente', 2025, 2025, 123, '2025-07-09 06:13:44'),
(6, 'paciente', 6, 2025, 123, '2025-07-09 06:15:39'),
(7, 'medico', 6, 2025, 12345, '2025-07-09 06:16:33'),
(8, 'ausentes', 6, 2025, NULL, '2025-07-09 06:21:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Sistema de gestión hospitalaria'),
(7, 'system_email', 'hmsciproject@mail.com'),
(2, 'system_title', 'Hospital Management System'),
(3, 'address', '177 Blecker Street'),
(4, 'phone', '36977785444'),
(5, 'paypal_email', 'paypal@paypol.com'),
(6, 'currency', 'USD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacion`
--

CREATE TABLE `tipo_identificacion` (
  `tipo_id` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_identificacion`
--

INSERT INTO `tipo_identificacion` (`tipo_id`, `nombre`) VALUES
('CC', 'Cédula de Ciudadanía'),
('CE', 'Cédula de Extranjería'),
('PA', 'Pasaporte'),
('RC', 'Registro Civil'),
('TI', 'Tarjeta de Identidad');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_citas_ausentes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_citas_ausentes` (
`cita_id` int(11)
,`fecha_hora` datetime
,`paciente_id` int(11)
,`medico_id` int(11)
,`paciente_nombres` varchar(100)
,`paciente_apellidos` varchar(100)
,`medico_nombres` varchar(100)
,`medico_apellidos` varchar(100)
,`estado` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_citas_medico_atendidas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_citas_medico_atendidas` (
`cita_id` int(11)
,`fecha_hora` datetime
,`medico_id` int(11)
,`paciente_id` int(11)
,`paciente_nombres` varchar(100)
,`paciente_apellidos` varchar(100)
,`medico_nombres` varchar(100)
,`medico_apellidos` varchar(100)
,`estado` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_citas_paciente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_citas_paciente` (
`cita_id` int(11)
,`fecha_hora` datetime
,`medico_id` int(11)
,`paciente_id` int(11)
,`paciente_nombres` varchar(100)
,`paciente_apellidos` varchar(100)
,`medico_nombres` varchar(100)
,`medico_apellidos` varchar(100)
,`estado` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_citas_ausentes`
--
DROP TABLE IF EXISTS `vista_citas_ausentes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_citas_ausentes`  AS  select `c`.`cita_id` AS `cita_id`,`c`.`fecha_hora` AS `fecha_hora`,`c`.`paciente_id` AS `paciente_id`,`c`.`medico_id` AS `medico_id`,`p`.`nombres` AS `paciente_nombres`,`p`.`apellidos` AS `paciente_apellidos`,`m`.`nombres` AS `medico_nombres`,`m`.`apellidos` AS `medico_apellidos`,`ec`.`nombre` AS `estado` from (((`cita` `c` join `paciente` `p` on((`p`.`numero_id` = `c`.`paciente_id`))) join `medico` `m` on((`m`.`numero_id` = `c`.`medico_id`))) join `estado_cita` `ec` on((`ec`.`estado_id` = `c`.`estado_id`))) where (`c`.`estado_id` = 4) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_citas_medico_atendidas`
--
DROP TABLE IF EXISTS `vista_citas_medico_atendidas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_citas_medico_atendidas`  AS  select `c`.`cita_id` AS `cita_id`,`c`.`fecha_hora` AS `fecha_hora`,`c`.`medico_id` AS `medico_id`,`c`.`paciente_id` AS `paciente_id`,`p`.`nombres` AS `paciente_nombres`,`p`.`apellidos` AS `paciente_apellidos`,`m`.`nombres` AS `medico_nombres`,`m`.`apellidos` AS `medico_apellidos`,`ec`.`nombre` AS `estado` from (((`cita` `c` join `paciente` `p` on((`p`.`numero_id` = `c`.`paciente_id`))) join `medico` `m` on((`m`.`numero_id` = `c`.`medico_id`))) join `estado_cita` `ec` on((`ec`.`estado_id` = `c`.`estado_id`))) where (`c`.`estado_id` = 2) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_citas_paciente`
--
DROP TABLE IF EXISTS `vista_citas_paciente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_citas_paciente`  AS  select `c`.`cita_id` AS `cita_id`,`c`.`fecha_hora` AS `fecha_hora`,`c`.`medico_id` AS `medico_id`,`c`.`paciente_id` AS `paciente_id`,`p`.`nombres` AS `paciente_nombres`,`p`.`apellidos` AS `paciente_apellidos`,`m`.`nombres` AS `medico_nombres`,`m`.`apellidos` AS `medico_apellidos`,`ec`.`nombre` AS `estado` from (((`cita` `c` join `paciente` `p` on((`p`.`numero_id` = `c`.`paciente_id`))) join `medico` `m` on((`m`.`numero_id` = `c`.`medico_id`))) join `estado_cita` `ec` on((`ec`.`estado_id` = `c`.`estado_id`))) where (`c`.`estado_id` = 2) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `identificacion_admin` (`tipo_id`,`numero_id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`),
  ADD KEY `municipio_id` (`municipio_id`);

--
-- Indices de la tabla `admin_telefono`
--
ALTER TABLE `admin_telefono`
  ADD PRIMARY KEY (`numero_id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`cita_id`),
  ADD KEY `lugar_id` (`lugar_id`),
  ADD KEY `especialidad_id` (`especialidad_id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `idx_fecha_hora` (`fecha_hora`),
  ADD KEY `idx_paciente_especialidad` (`paciente_id`,`especialidad_id`),
  ADD KEY `idx_medico_fecha` (`medico_id`,`fecha_hora`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`especialidad_id`);

--
-- Indices de la tabla `estado_cita`
--
ALTER TABLE `estado_cita`
  ADD PRIMARY KEY (`estado_id`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`lugar_id`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`numero_id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `identificacion_medico` (`tipo_id`,`numero_id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`),
  ADD UNIQUE KEY `numero_id_2` (`numero_id`),
  ADD KEY `municipio_id` (`municipio_id`),
  ADD KEY `especialidad_id` (`especialidad_id`);

--
-- Indices de la tabla `medico_desactivado`
--
ALTER TABLE `medico_desactivado`
  ADD PRIMARY KEY (`numero_id`),
  ADD KEY `especialidad_id` (`especialidad_id`),
  ADD KEY `municipio_id` (`municipio_id`);

--
-- Indices de la tabla `medico_telefono`
--
ALTER TABLE `medico_telefono`
  ADD PRIMARY KEY (`numero_id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`municipio_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`numero_id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `identificacion_paciente` (`tipo_id`,`numero_id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`),
  ADD KEY `municipio_id` (`municipio_id`);

--
-- Indices de la tabla `paciente_desactivado`
--
ALTER TABLE `paciente_desactivado`
  ADD PRIMARY KEY (`numero_id`),
  ADD KEY `municipio_id` (`municipio_id`);

--
-- Indices de la tabla `paciente_telefono`
--
ALTER TABLE `paciente_telefono`
  ADD PRIMARY KEY (`numero_id`),
  ADD UNIQUE KEY `paciente_id` (`numero_id`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`reporte_id`),
  ADD KEY `idx_reporte_mes_ano` (`mes`,`ano`);

--
-- Indices de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  ADD PRIMARY KEY (`tipo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `cita_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `especialidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `estado_cita`
--
ALTER TABLE `estado_cita`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `lugar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `municipio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `reporte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_identificacion` (`tipo_id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`municipio_id`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`lugar_id`) REFERENCES `lugar` (`lugar_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`estado_id`) REFERENCES `estado_cita` (`estado_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cita_medico_numero_id` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`numero_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cita_paciente_numero_id` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`numero_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_identificacion` (`tipo_id`),
  ADD CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`municipio_id`),
  ADD CONSTRAINT `medico_ibfk_3` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`);

--
-- Filtros para la tabla `medico_desactivado`
--
ALTER TABLE `medico_desactivado`
  ADD CONSTRAINT `medico_desactivado_ibfk_1` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`),
  ADD CONSTRAINT `medico_desactivado_ibfk_2` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`municipio_id`);

--
-- Filtros para la tabla `medico_telefono`
--
ALTER TABLE `medico_telefono`
  ADD CONSTRAINT `fk_medico_telefono_numero_id` FOREIGN KEY (`numero_id`) REFERENCES `medico` (`numero_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_identificacion` (`tipo_id`),
  ADD CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`municipio_id`);

--
-- Filtros para la tabla `paciente_desactivado`
--
ALTER TABLE `paciente_desactivado`
  ADD CONSTRAINT `paciente_desactivado_ibfk_1` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`municipio_id`);

--
-- Filtros para la tabla `paciente_telefono`
--
ALTER TABLE `paciente_telefono`
  ADD CONSTRAINT `fk_paciente_telefono_numero_id` FOREIGN KEY (`numero_id`) REFERENCES `paciente` (`numero_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
