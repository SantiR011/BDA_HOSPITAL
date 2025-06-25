-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2025 a las 18:40:40
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `tipo_id` varchar(50) NOT NULL,
  `nombres` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` longtext NOT NULL,
  `correo` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `municipio` longtext NOT NULL,
  `telefonos` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nac` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`admin_id`, `tipo_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio`, `telefonos`, `fecha_nac`) VALUES
(1, '', 'Liam Moore', '', 'admin@mail.com', 'Password@123', '117 Blecker Street', '', '7410696969', '0000-00-00'),
(2, '', 'Santiago Rincon', '', 'santirinconh@gmail.com', '12345', 'Calle 35', '', '23121', '0000-00-00');

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
-- Estructura de tabla para la tabla `categoria_medicina`
--

CREATE TABLE `categoria_medicina` (
  `medicine_category_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `categoria_medicina`
--

INSERT INTO `categoria_medicina` (`medicine_category_id`, `name`, `description`) VALUES
(1, 'Líquidos antialérgicos', 'Medicamentos antialérgicos'),
(2, 'Vitaminas Pastillas', 'Sólo pastillas de vitaminas'),
(3, 'Líquido', 'Un líquido también puede denominarse «mezcla», «solución» o «jarabe». Hoy en día, muchos de los líquidos más comunes se pueden adquirir sin colorantes ni azúcares añadidos.'),
(4, 'Tableta', 'El principio activo se combina con otra sustancia y se prensa en una forma sólida redonda u ovalada. Existen distintos tipos de comprimidos. Los comprimidos solubles o dispersables pueden disolverse con seguridad en agua.'),
(5, 'Cápsulas', 'La parte activa del medicamento está contenida en una cápsula de plástico que se disuelve lentamente en el estómago. Puede separar algunas cápsulas y mezclar el contenido con la comida favorita de su hijo. '),
(6, 'Medicamentos tópicos', 'Son cremas, lociones o pomadas que se aplican directamente sobre la piel. Se presentan en tarrinas, frascos o tubos, según el tipo de medicamento. '),
(7, 'Gotas', 'Suelen utilizarse cuando la parte activa del medicamento actúa mejor si llega directamente a la zona afectada. Suelen utilizarse para los ojos, los oídos o la nariz.'),
(8, 'Inhaladores', 'La parte activa del medicamento se libera a presión directamente en los pulmones. Los niños pequeños pueden necesitar un dispositivo espaciador para tomar el medicamento correctamente.'),
(9, 'Inyecciones', 'Hay distintos tipos de inyección, en cuanto a cómo y dónde se inyectan. Las inyecciones subcutáneas o SC se administran justo debajo de la superficie de la piel.'),
(10, 'Implantes o parches', 'Estos medicamentos se absorben a través de la piel, como los parches de nicotina para ayudar a dejar de fumar o los implantes anticonceptivos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `codigo_cita` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `lugar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `medico_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `especialidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`codigo_cita`, `fecha_hora`, `lugar`, `medico_id`, `paciente_id`, `especialidad`) VALUES
(7, '0000-00-00 00:00:00', '0', 8, 8, ''),
(6, '0000-00-00 00:00:00', '0', 11, 6, ''),
(5, '0000-00-00 00:00:00', '0', 8, 5, ''),
(8, '0000-00-00 00:00:00', '0', 1, 1, ''),
(9, '0000-00-00 00:00:00', '0', 2, 3, ''),
(10, '0000-00-00 00:00:00', '0', 3, 4, ''),
(11, '0000-00-00 00:00:00', '0', 4, 5, ''),
(12, '0000-00-00 00:00:00', '0', 5, 6, ''),
(13, '0000-00-00 00:00:00', '0', 6, 7, ''),
(14, '0000-00-00 00:00:00', '0', 7, 8, ''),
(15, '0000-00-00 00:00:00', '0', 8, 9, ''),
(16, '0000-00-00 00:00:00', '0', 9, 10, ''),
(17, '0000-00-00 00:00:00', '0', 10, 11, ''),
(18, '0000-00-00 00:00:00', '0', 11, 12, ''),
(19, '0000-00-00 00:00:00', '0', 12, 13, ''),
(20, '0000-00-00 00:00:00', '0', 13, 14, ''),
(21, '0000-00-00 00:00:00', '0', 1, 15, ''),
(22, '0000-00-00 00:00:00', '0', 2, 16, ''),
(23, '0000-00-00 00:00:00', '0', 3, 1, ''),
(24, '0000-00-00 00:00:00', '0', 4, 3, ''),
(25, '0000-00-00 00:00:00', '0', 5, 4, ''),
(26, '0000-00-00 00:00:00', '0', 6, 5, ''),
(27, '0000-00-00 00:00:00', '0', 7, 6, ''),
(28, '0000-00-00 00:00:00', '0', 8, 7, ''),
(29, '0000-00-00 00:00:00', '0', 9, 8, ''),
(30, '0000-00-00 00:00:00', '0', 10, 9, ''),
(31, '0000-00-00 00:00:00', '0', 11, 10, ''),
(32, '0000-00-00 00:00:00', '0', 12, 11, ''),
(33, '0000-00-00 00:00:00', '0', 13, 12, ''),
(34, '0000-00-00 00:00:00', '0', 1, 13, ''),
(35, '0000-00-00 00:00:00', '0', 2, 14, ''),
(36, '0000-00-00 00:00:00', '0', 3, 15, ''),
(37, '0000-00-00 00:00:00', '0', 4, 16, ''),
(38, '0000-00-00 00:00:00', '0', 5, 1, ''),
(39, '0000-00-00 00:00:00', '0', 6, 3, ''),
(40, '0000-00-00 00:00:00', '0', 7, 4, ''),
(41, '0000-00-00 00:00:00', '0', 8, 5, ''),
(42, '0000-00-00 00:00:00', '0', 9, 6, ''),
(43, '0000-00-00 00:00:00', '0', 10, 7, ''),
(44, '0000-00-00 00:00:00', '0', 11, 8, ''),
(45, '0000-00-00 00:00:00', '0', 12, 9, ''),
(46, '0000-00-00 00:00:00', '0', 13, 10, ''),
(47, '0000-00-00 00:00:00', '0', 1, 11, ''),
(48, '0000-00-00 00:00:00', '0', 2, 12, ''),
(49, '0000-00-00 00:00:00', '0', 3, 13, ''),
(50, '0000-00-00 00:00:00', '0', 4, 14, ''),
(51, '0000-00-00 00:00:00', '0', 5, 15, ''),
(52, '0000-00-00 00:00:00', '0', 6, 16, ''),
(53, '0000-00-00 00:00:00', '0', 7, 1, ''),
(54, '0000-00-00 00:00:00', '0', 8, 3, ''),
(55, '0000-00-00 00:00:00', '0', 9, 4, ''),
(56, '0000-00-00 00:00:00', '0', 10, 5, ''),
(57, '0000-00-00 00:00:00', '0', 11, 6, ''),
(58, '0000-00-00 00:00:00', '0', 12, 7, ''),
(59, '0000-00-00 00:00:00', '0', 13, 8, ''),
(60, '0000-00-00 00:00:00', '0', 1, 9, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `especialidad_id` int(11) NOT NULL,
  `nombre` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`especialidad_id`, `nombre`, `descripcion`) VALUES
(1, 'Anestesiología', 'Departamento de Anestesiología'),
(2, 'Laboratorio de bacteriología', 'Departamento de Laboratorio de bacteriología'),
(3, 'Fisioterapia', 'Departamento de Fisioterapia'),
(4, 'Cirugía plástica', 'Departamento de Cirugía plástica'),
(5, 'Médicos especialistas en enfermedades infecciosas', 'Los médicos especialistas en enfermedades infecciosas se especializan en enfermedades y afecciones contagiosas. Incluye: gripe, problemas estomacales, vih, neumonía, tuberculosis'),
(6, 'Dermatólogos', 'Los dermatólogos se centran en las enfermedades y afecciones de la piel, las uñas y el cabello. Tratan afecciones como el eccema, el cáncer de piel, el acné y la psoriasis.'),
(7, 'Alergólogos', 'Un alergólogo o inmunólogo se dedica a prevenir y tratar enfermedades y afecciones alérgicas. Entre ellas suelen figurar varios tipos de alergias y el asma.'),
(8, 'Oftalmólogos', 'Los oftalmólogos están especializados en el cuidado de los ojos y la vista. Tratan enfermedades y afecciones de los ojos y pueden realizar cirugía ocular.'),
(9, 'Obstetras/ginecólogos', 'Para afecciones femeninas: salud reproductiva femenina, prevención y diagnóstico del cáncer en los órganos reproductores femeninos, cuidado de la mama, embarazo, trabajo de parto y parto, infertilidad, menopausia.'),
(10, 'Cardiólogos', 'Los cardiólogos se centran en el sistema cardiovascular, que incluye el corazón y los vasos sanguíneos. presión arterial alta, colesterol alto, infarto de miocardio y accidente cerebrovascular.'),
(11, 'Endocrinólogos', 'Los endocrinólogos tratan afecciones relacionadas con las hormonas como: diabetes, afecciones tiroideas, desequilibrios hormonales, infertilidad, problemas de crecimiento en niños...'),
(12, 'Gastroenterólogos', 'Los gastroenterólogos se centran en el aparato digestivo. Esto incluye el esófago, el páncreas, el estómago, el hígado, el intestino delgado, el colon y la vesícula biliar.'),
(13, 'Nefrólogos', 'El nefrólogo se centra en el cuidado de los riñones y las afecciones renales.'),
(14, 'Urólogos', 'Los urólogos tratan las afecciones de las vías urinarias de hombres y mujeres.'),
(15, 'Neumólogos', 'Los neumólogos se centran en los órganos que intervienen en la respiración. Entre ellos se encuentran los pulmones y el corazón.'),
(16, 'Otorrinolaringólogos', 'Un otorrinolaringólogo puede tratar problemas de senos paranasales, garganta, amígdalas, oídos, boca, cabeza y cuello.'),
(17, 'Neurólogos', 'El neurólogo trata las afecciones de los nervios, la columna vertebral y el cerebro.'),
(18, 'Psiquiatras', 'Un psiquiatra es un médico que trata enfermedades mentales. Puede recurrir al asesoramiento, la medicación o la hospitalización como parte del tratamiento.'),
(19, 'Oncólogos', 'Los oncólogos tratan el cáncer y sus síntomas. Durante el tratamiento del cáncer, una persona puede contar con varios tipos de profesionales sanitarios en su equipo asistencial.'),
(20, 'Radiólogos', 'El radiólogo está especializado en el diagnóstico y tratamiento de enfermedades mediante pruebas médicas de imagen. Pueden leer e interpretar exploraciones como radiografías, resonancias magnéticas, mamografías, ecografías y tomografías computarizadas.'),
(21, 'Cirujanos generales', 'Los cirujanos generales realizan intervenciones quirúrgicas en muchos órganos y sistemas corporales. '),
(22, 'Cirujanos ortopédicos', 'Un cirujano ortopédico se especializa en enfermedades y afecciones de los huesos, músculos, ligamentos, tendones y articulaciones.'),
(23, 'Cirujanos cardiacos', 'Los cirujanos cardiacos realizan operaciones de corazón y pueden colaborar con un cardiólogo para determinar qué necesita una persona.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_diagnostico`
--

CREATE TABLE `informe_diagnostico` (
  `diagnosis_report_id` int(11) NOT NULL,
  `report_type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'xray,blood test',
  `document_type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'text,photo',
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `laboratorist_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `informe_diagnostico`
--

INSERT INTO `informe_diagnostico` (`diagnosis_report_id`, `report_type`, `document_type`, `file_name`, `prescription_id`, `description`, `timestamp`, `laboratorist_id`) VALUES
(3, 'Test Report', 'image', 'sample_image.jpg', 4, 'This is a demo test', 1651168181, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `medicine_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medicine_category_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `manufacturing_company` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`medicine_id`, `name`, `medicine_category_id`, `description`, `price`, `manufacturing_company`, `status`) VALUES
(1, 'Aber C 500', 2, 'Vitamina C 500gm', '25', 'Empresa Cipla', '50'),
(2, 'Benzonatato', 5, 'El benzonatato es un medicamento no narcótico para la tos.  El benzonatato actúa adormeciendo la garganta y los pulmones, haciendo que el reflejo de la tos sea menos activo.', '44', 'TESSALON', '112'),
(3, 'Cefalexina', 5, 'La cefalexina es un antibiótico de cefalosporina. Actúa combatiendo las bacterias del organismo.', '27', 'Productos farmacéuticos Lupin', '68'),
(4, 'Lisinopril', 4, 'Lisinopril se utiliza para tratar la presión arterial alta (hipertensión) en adultos y niños mayores de 6 años.', '30', 'Apotex', '110'),
(5, 'Metotrexato', 4, 'El metotrexato se utiliza para tratar la leucemia y ciertos tipos de cáncer de mama, piel, cabeza y cuello, pulmón o útero.', '9', 'Bristol Myers Squibb', '80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `medico_id` int(11) NOT NULL,
  `tipo_id` varchar(50) NOT NULL,
  `nombres` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `telefonos` longtext NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `profile` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`medico_id`, `tipo_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio`, `telefonos`, `especialidad_id`, `profile`) VALUES
(1, '', 'David', '', 'davidmur@mail.com', 'password123', '52 Kelly Drive', '', '31231', 4, 'none'),
(2, '', 'William Dcruz', '', 'williamd@mail.com', 'password', '65 Bloomfield Way', '', '2147483647', 3, 'none'),
(3, '', 'Ethel M. Drake', '', 'etheld@mail.com', 'password', '15 C Street', '', '2147483647', 18, 'Test'),
(4, '', 'Peter N. Cundiff', '', 'peterc@mail.com', 'password', '17 Wayback Lane', '', '2147483647', 5, 'Test'),
(5, '', 'Anne K. Alden', '', 'annek@mail.com', 'password', '23 Allison Avenue', '', '2147483647', 6, 'Test'),
(6, '', 'Gary B. Bartz', '', 'garybb@mail.com', 'password', '24 James Martin Circle', '', '1458745877', 8, 'Test'),
(7, '', 'Benjamin M. Moran', '', 'benjamin@mail.com', 'password', '19 Ritter Avenue', '', '2147483647', 9, 'Test'),
(8, '', 'Sandra T. Carter', '', 'carter@mail.com', 'password123', '61 Mudlick Road', '', '2147483647', 10, 'Test'),
(9, '', 'Alberto J. Merritt', '', 'albertoj@mail.com', 'password', '15 Tator Patch Road', '', '2147483647', 11, 'Test'),
(10, '', 'Sarah R. Culbertson', '', 'sarahrr@mail.com', 'password', '28 Harry Place', '', '2147483647', 12, 'Test'),
(11, '', 'Zoila C. Vicini', '', 'zoilac@mail.com', 'password', '79 Wildwood Street', '', '2147483647', 13, 'Test'),
(12, '', 'Deanne C. Johnson', '', 'deannec@mail.com', 'password', '34 Johnson Street', '', '2147483647', 14, 'Test'),
(13, '', 'Pauline J. Chambers', '', 'pauline@mail.com', 'password', '19 Layman Avenue', '', '2147483647', 20, 'Test'),
(16, '', 'Santiago Montanez', '', 'santiago@gmail.com', '23242', '52 Kelly Drive', '', '34242', 15, 'none');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `paciente_id` int(11) NOT NULL,
  `tipo_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` longtext COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` longtext COLLATE utf8_unicode_ci NOT NULL,
  `direccion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefonos` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sexo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `edad` int(11) NOT NULL,
  `creacion_cuenta` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`paciente_id`, `tipo_id`, `nombres`, `apellidos`, `correo`, `contrasena`, `direccion`, `municipio`, `telefonos`, `sexo`, `fecha_nac`, `edad`, `creacion_cuenta`) VALUES
(1, '', 'Marc Jones', '', 'marc@mail.com', 'patient13309', '44 Burton Avenue', '', '2354547878', 'male', '0000-00-00', 34, 1448984171),
(3, '', 'Thomas', '', 'thomasw@mail.com', 'password', '7775 Alac Avenue', '', '7450002650', 'masculino', '0000-00-00', 32, 1620900518),
(4, '', 'Elon Depp', '', 'elondp@mail.com', 'password', '114 Test', '', '7774441144', 'masculino', '0000-00-00', 27, 1651060241),
(5, '', 'Kyle E. Moore', '', 'kyle@mail.com', 'password123', '33 Williams Avenue', '', '2365554500', 'masculino', '0000-00-00', 28, 1651084360),
(6, '', 'Chester H. Smith', '', 'chesterm@mail.com', 'password', '54 West Drive', '', '3332221450', 'masculino', '0000-00-00', 23, 1651084418),
(7, '', 'Sherie A. Phipps', '', 'sherie@mail.com', 'password', '54 Tori Lane', '', '4521216996', 'femenino', '0000-00-00', 32, 1651084465),
(8, '', 'Julie J. Gentry', '', 'juliee@mail.com', 'password', '2 Webster Street', '', '3214569999', 'femenino', '0000-00-00', 32, 1651084514),
(9, '', 'Robert L. Thompson', '', 'thompson@mail.com', 'password', '94 Stewart Street', '', '3458887777', 'masculino', '0000-00-00', 31, 1651084570),
(10, '', 'Yesenia J. Denby', '', 'yesenia@mail.com', 'password', '10 Twin Oaks Drive', '', '7850002222', 'femenino', '0000-00-00', 24, 1651084621),
(11, '', 'Matthew J. Davis', '', 'matthw@mail.com', 'password', '74 Ruckman Road', '', '3560001450', 'masculino', '0000-00-00', 21, 1651084682),
(12, '', 'Christian R. Bergstrom', '', 'christianb@mail.com', 'pass', '25 Locust Court', '', '3450001010', 'masculino', '0000-00-00', 24, 1651084731),
(13, '', 'Roy J. Woods', '', 'royw@mail.com', 'password', '73 Eagles Nest Drive', '', '7850012457', 'masculino', '0000-00-00', 42, 1651084783),
(14, '', 'Misty A. Brennen', '', 'mistya@mail.com', 'pass', '55 Lyndon Street', '', '32566666660', 'femenino', '0000-00-00', 46, 1651084901),
(15, '', 'Francis Thomason', '', 'francis@mail.com', 'password', '21 Spinnaker Lane', '', '4445550012', 'masculino', '0000-00-00', 54, 1651084953),
(16, '', 'Mary Rockwell', '', 'maryrr@mail.com', 'password', '709 Froe Street', '', '7896547800', 'femenino', '0000-00-00', 35, 1651085014),
(17, '', 'Laura', '', 'lauraaswe@gmail.com', 'santiago231', '117 Blecker Street', '', '313224', 'female', '0000-00-00', 25, 1734405053);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prescripcion`
--

CREATE TABLE `prescripcion` (
  `prescription_id` int(11) NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `case_history` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medication` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medication_from_pharmacist` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `prescripcion`
--

INSERT INTO `prescripcion` (`prescription_id`, `creation_timestamp`, `doctor_id`, `patient_id`, `case_history`, `medication`, `medication_from_pharmacist`, `description`) VALUES
(6, 1651170030, 11, 6, 'Test. Test Test. Test Test. Test Test. Test', 'Test. Test Test. Test Test. Test Test. Test', 'Test. Test Test. Test Test. Test', 'Test. Test Test. Test Test. Test'),
(4, 1651161041, 8, 5, 'This is a demo case history for testing purpose!', 'This is a sample medication for testing purpose!', 'This is a sample medication&nbsp;for testing purpose!', 'This is a demo description for testing purpose!'),
(7, 1734130692, 3, 3, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `report_id` int(11) NOT NULL,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'operation,birth,death',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`report_id`, `type`, `description`, `timestamp`, `doctor_id`, `patient_id`) VALUES
(3, 'other', 'This is a sample report.', 1887681137, 8, 1),
(4, 'operation', 'Op104', 1887690081, 11, 1),
(47, 'birth', 'Birth report for patient 22', 1780635600, 9, 1),
(46, 'birth', 'Birth report for patient 21', 1848891600, 8, 1),
(45, 'birth', 'Birth report for patient 20', 1852952400, 7, 3),
(44, 'birth', 'Birth report for patient 19', 1984021200, 6, 3),
(43, 'birth', 'Birth report for patient 18', 1996635600, 5, 3),
(42, 'birth', 'Birth report for patient 17', 1981688400, 4, 3),
(41, 'birth', 'Birth report for patient 16', 1869109200, 3, 4),
(40, 'birth', 'Birth report for patient 15', 1981602000, 2, 4),
(39, 'birth', 'Birth report for patient 14', 1935896400, 1, 4),
(38, 'birth', 'Birth report for patient 13', 2000523600, 13, 4),
(37, 'birth', 'Birth report for patient 12', 1830315600, 12, 5),
(36, 'birth', 'Birth report for patient 11', 2046574800, 11, 5),
(35, 'birth', 'Birth report for patient 10', 1746421200, 10, 5),
(34, 'birth', 'Birth report for patient 9', 1804309200, 9, 5),
(33, 'birth', 'Birth report for patient 8', 2048389200, 8, 6),
(32, 'birth', 'Birth report for patient 7', 1833253200, 7, 6),
(31, 'birth', 'Birth report for patient 6', 1918011600, 6, 6),
(30, 'birth', 'Birth report for patient 5', 2040872400, 5, 6),
(29, 'birth', 'Birth report for patient 4', 1770267600, 4, 7),
(28, 'birth', 'Birth report for patient 3', 1940562000, 3, 7),
(27, 'birth', 'Birth report for patient 2', 2027221200, 2, 7),
(26, 'birth', 'Birth report for patient 1', 1949634000, 1, 7),
(48, 'birth', 'Birth report for patient 23', 1932354000, 10, 8),
(49, 'birth', 'Birth report for patient 24', 1763701200, 11, 8),
(50, 'birth', 'Birth report for patient 25', 1917925200, 12, 8),
(51, 'birth', 'Birth report for patient 26', 1933650000, 13, 8),
(52, 'birth', 'Birth report for patient 27', 1865048400, 1, 9),
(53, 'birth', 'Birth report for patient 28', 1790139600, 2, 9),
(54, 'birth', 'Birth report for patient 29', 1936933200, 3, 9),
(55, 'birth', 'Birth report for patient 30', 1949547600, 4, 9),
(56, 'birth', 'Birth report for patient 31', 1887598800, 5, 10),
(57, 'birth', 'Birth report for patient 32', 1855112400, 6, 10),
(58, 'birth', 'Birth report for patient 33', 1878699600, 7, 10),
(59, 'birth', 'Birth report for patient 34', 1778734800, 8, 10),
(60, 'birth', 'Birth report for patient 35', 1838782800, 9, 11),
(61, 'birth', 'Birth report for patient 36', 1808456400, 10, 11),
(62, 'birth', 'Birth report for patient 37', 1791954000, 11, 11),
(63, 'birth', 'Birth report for patient 38', 1800162000, 12, 11),
(64, 'birth', 'Birth report for patient 39', 1890795600, 13, 12),
(65, 'birth', 'Birth report for patient 40', 2004325200, 1, 12),
(66, 'birth', 'Birth report for patient 41', 1984366800, 2, 12),
(67, 'birth', 'Birth report for patient 42', 1859518800, 3, 12),
(68, 'birth', 'Birth report for patient 43', 1925528400, 4, 13),
(69, 'birth', 'Birth report for patient 44', 1999918800, 5, 13),
(70, 'birth', 'Birth report for patient 45', 1858050000, 6, 13),
(71, 'birth', 'Birth report for patient 46', 1871787600, 7, 13),
(72, 'birth', 'Birth report for patient 47', 1735534800, 8, 14),
(73, 'birth', 'Birth report for patient 48', 1958878800, 9, 14),
(74, 'birth', 'Birth report for patient 49', 1907643600, 10, 9),
(75, 'birth', 'Birth report for patient 50', 1927429200, 11, 10),
(76, 'operation', 'Operation report for patient 1', 1837746000, 1, 1),
(77, 'operation', 'Operation report for patient 3', 2016075600, 1, 3),
(78, 'operation', 'Operation report for patient 4', 1887080400, 2, 4),
(79, 'operation', 'Operation report for patient 5', 1968296400, 3, 5),
(80, 'operation', 'Operation report for patient 6', 1815541200, 4, 6),
(81, 'operation', 'Operation report for patient 7', 1754110800, 5, 7),
(82, 'operation', 'Operation report for patient 8', 1905310800, 6, 8),
(83, 'operation', 'Operation report for patient 9', 1899435600, 7, 9),
(84, 'operation', 'Operation report for patient 10', 2047179600, 8, 10),
(85, 'operation', 'Operation report for patient 11', 1857445200, 9, 11),
(86, 'operation', 'Operation report for patient 12', 2042254800, 10, 12),
(87, 'operation', 'Operation report for patient 13', 1958706000, 11, 13),
(88, 'operation', 'Operation report for patient 14', 1932872400, 12, 14),
(89, 'operation', 'Operation report for patient 15', 1738645200, 13, 15),
(90, 'operation', 'Operation report for patient 16', 1791262800, 1, 16),
(91, 'operation', 'Operation report for patient 1', 2006312400, 2, 1),
(92, 'operation', 'Operation report for patient 3', 1977886800, 3, 3),
(93, 'operation', 'Operation report for patient 4', 1820725200, 4, 4),
(94, 'operation', 'Operation report for patient 5', 1751518800, 5, 5),
(95, 'operation', 'Operation report for patient 6', 1876712400, 6, 6),
(96, 'operation', 'Operation report for patient 7', 1764133200, 7, 7),
(97, 'operation', 'Operation report for patient 8', 1771909200, 8, 8),
(98, 'operation', 'Operation report for patient 9', 1832907600, 9, 9),
(99, 'operation', 'Operation report for patient 10', 1799557200, 10, 10),
(100, 'operation', 'Operation report for patient 11', 1764997200, 11, 11),
(101, 'operation', 'Operation report for patient 12', 2007694800, 12, 12),
(102, 'operation', 'Operation report for patient 13', 1747976400, 13, 13),
(103, 'operation', 'Operation report for patient 14', 1928638800, 1, 14),
(104, 'operation', 'Operation report for patient 15', 2034478800, 2, 15),
(105, 'operation', 'Operation report for patient 16', 2021864400, 3, 16),
(106, 'operation', 'Operation report for patient 1', 1956200400, 4, 1),
(107, 'operation', 'Operation report for patient 3', 1981602000, 5, 3),
(108, 'operation', 'Operation report for patient 4', 1990069200, 6, 4),
(109, 'operation', 'Operation report for patient 5', 1955941200, 7, 5),
(110, 'operation', 'Operation report for patient 6', 1759899600, 8, 6),
(111, 'operation', 'Operation report for patient 7', 1828674000, 9, 7),
(112, 'operation', 'Operation report for patient 8', 1813986000, 10, 8),
(113, 'operation', 'Operation report for patient 9', 1849842000, 11, 9),
(114, 'operation', 'Operation report for patient 10', 1757912400, 12, 10),
(115, 'operation', 'Operation report for patient 11', 1821157200, 13, 11),
(116, 'operation', 'Operation report for patient 12', 1782882000, 1, 12),
(117, 'operation', 'Operation report for patient 13', 2032059600, 2, 13),
(118, 'death', 'Death report for patient 1', 1976763600, 1, 1),
(119, 'death', 'Death report for patient 3', 1967950800, 2, 3),
(120, 'death', 'Death report for patient 4', 1860037200, 3, 4),
(121, 'death', 'Death report for patient 5', 1977714000, 4, 5),
(122, 'death', 'Death report for patient 6', 1943758800, 5, 6),
(123, 'death', 'Death report for patient 7', 1736226000, 6, 7),
(124, 'death', 'Death report for patient 8', 1746421200, 7, 8),
(125, 'death', 'Death report for patient 9', 1789362000, 8, 9),
(126, 'death', 'Death report for patient 10', 1973394000, 9, 10),
(127, 'death', 'Death report for patient 11', 1818738000, 10, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`noticia_id`);

--
-- Indices de la tabla `categoria_medicina`
--
ALTER TABLE `categoria_medicina`
  ADD PRIMARY KEY (`medicine_category_id`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`codigo_cita`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`especialidad_id`);

--
-- Indices de la tabla `informe_diagnostico`
--
ALTER TABLE `informe_diagnostico`
  ADD PRIMARY KEY (`diagnosis_report_id`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`medico_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`paciente_id`);

--
-- Indices de la tabla `prescripcion`
--
ALTER TABLE `prescripcion`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`report_id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `noticia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `categoria_medicina`
--
ALTER TABLE `categoria_medicina`
  MODIFY `medicine_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `codigo_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `especialidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `informe_diagnostico`
--
ALTER TABLE `informe_diagnostico`
  MODIFY `diagnosis_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `prescripcion`
--
ALTER TABLE `prescripcion`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
