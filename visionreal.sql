-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-01-2020 a las 20:06:50
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `visionreal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_type_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog_types`
--

DROP TABLE IF EXISTS `blog_types`;
CREATE TABLE IF NOT EXISTS `blog_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_types_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollment_path_threats`
--

DROP TABLE IF EXISTS `enrollment_path_threats`;
CREATE TABLE IF NOT EXISTS `enrollment_path_threats` (
  `treathment_id` int(11) NOT NULL,
  `pathology_id` int(11) NOT NULL,
  PRIMARY KEY (`pathology_id`,`treathment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `enrollment_path_threats`
--

INSERT INTO `enrollment_path_threats` (`treathment_id`, `pathology_id`) VALUES
(1, 1),
(2, 1),
(1, 3),
(2, 3),
(5, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_09_161740_create_pathologies_table', 1),
(4, '2020_01_09_161854_create_threatments_table', 1),
(5, '2020_01_09_161942_create_enrollment_path_threats_table', 1),
(6, '2020_01_09_162010_create_blogs_table', 1),
(7, '2020_01_09_162030_create_blog_types_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pathologies`
--

DROP TABLE IF EXISTS `pathologies`;
CREATE TABLE IF NOT EXISTS `pathologies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pathologies`
--

INSERT INTO `pathologies` (`id`, `name`, `resume`, `img`, `active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cataratas', 'Una catarata opaca o nubla el lente del ojo. Esto afecta la vista. Las cataratas son muy comunes en las personas mayores.', '1.jpg', 1, '<p>Una catarata opaca o nubla el lente del ojo. Esto afecta la vista. Las cataratas son muy comunes en las personas mayores. A los 80 a&ntilde;os de edad, m&aacute;s de la mitad de las personas que viven en los Estados Unidos tiene cataratas o se ha sometido a una cirug&iacute;a de cataratas.</p>\r\n\r\n<p>Las cataratas pueden afectar uno o los dos ojos pero no se contagia de uno a otro. Los s&iacute;ntomas m&aacute;s comunes son:</p>\r\n\r\n<ul>\r\n	<li>Vista borrosa</li>\r\n	<li>Colores que parecen deste&ntilde;idos</li>\r\n	<li>Resplandor alrededor de las luces: puede ser que las luces de los coches, l&aacute;mparas y del sol se vean demasiado brillantes</li>\r\n	<li>Dificultad para ver bien de noche</li>\r\n	<li>Ver doble</li>\r\n	<li>Cambios frecuentes en las recetas de sus lentes</li>\r\n</ul>\r\n\r\n<p>Las cataratas suelen aparecer lentamente. El uso de anteojos nuevos, la iluminaci&oacute;n m&aacute;s brillante, anteojos de sol antirreflejo o lentes de aumento puede ayudar al principio. La cirug&iacute;a tambi&eacute;n es una opci&oacute;n. Incluye la extirpaci&oacute;n del lente opacado y su reemplazo por un lente artificial. El uso de anteojos de sol y sombrero con visera que bloquee la luz ultravioleta pueden ayudar a demorar la aparici&oacute;n de cataratas.</p>\r\n\r\n<p>NIH: Instituto Nacional del Ojo</p>', '2020-01-11 20:23:06', '2020-01-11 20:26:21'),
(3, 'Degeneración macular', 'La degeneración macular o la degeneración macular relacionada con la edad (AMD, por sus siglas en inglés) es la principal causa de pérdida de visión en los estadounidenses mayores de 60 años', '3.jpg', 1, '<p>La degeneraci&oacute;n macular o la degeneraci&oacute;n macular relacionada con la edad (AMD, por sus siglas en ingl&eacute;s) es la principal causa de p&eacute;rdida de visi&oacute;n en los estadounidenses mayores de 60 a&ntilde;os. Es una enfermedad que destruye la agudeza de la visi&oacute;n central. La vista central es necesaria para ver los objetos con claridad y hacer actividades como leer o conducir veh&iacute;culos.</p>\r\n\r\n<p>La enfermedad afecta la m&aacute;cula, que es la parte del ojo que permite ver los detalles con claridad. No duele, pero provoca la muerte de las c&eacute;lulas de la m&aacute;cula. Existen dos tipos: La h&uacute;meda y la seca. La h&uacute;meda ocurre cuando vasos sangu&iacute;neos anormales crecen bajo la m&aacute;cula. Estos nuevos vasos frecuentemente gotean sangre y l&iacute;quido. El da&ntilde;o a la m&aacute;cula ocurre r&aacute;pidamente. Uno de los primeros s&iacute;ntomas es una visi&oacute;n borrosa. La seca, ocurre cuando las c&eacute;lulas de la m&aacute;cula sensibles a la luz se deterioran. Lentamente, se pierde la visi&oacute;n central. Uno de los primeros s&iacute;ntomas es ver torcidas las l&iacute;neas rectas.</p>\r\n\r\n<p>Los ex&aacute;menes oculares integrales regulares pueden detectar una degeneraci&oacute;n macular antes de que la enfermedad cause una p&eacute;rdida de la vista. El tratamiento puede hacer m&aacute;s lento el avance del deterioro de la vista, sin embargo no recupera la visi&oacute;n.</p>', '2020-01-11 20:33:16', '2020-01-11 20:33:16'),
(4, 'Conjuntivitis', 'La conjuntivitis causa hinchazón, picazón, ardor, lagrimeo y enrojecimiento de la conjuntiva, la membrana delgada y translúcida que recubre la parte blanca del ojo y el interior de los párpa', '4.jpg', 1, '<p>La conjuntivitis causa hinchaz&oacute;n, picaz&oacute;n, ardor, lagrimeo y enrojecimiento de la conjuntiva, la membrana delgada y transl&uacute;cida que recubre la parte blanca del ojo y el interior de los p&aacute;rpados. Las causas pueden ser</p>\r\n\r\n<ul>\r\n	<li>Infecci&oacute;n bacteriana o viral</li>\r\n	<li>Alergias</li>\r\n	<li>Sustancias que causan irritaci&oacute;n</li>\r\n	<li>Productos que se usan para los lentes de contacto, gotas para los ojos o ung&uuml;entos.</li>\r\n</ul>\r\n\r\n<p>La conjuntivitis, en general, no afecta la vista. La conjunctivitis infecciosa se contagia f&aacute;cilmente de persona a persona. La infecci&oacute;n desaparece por s&iacute; sola sin tratamiento, pero la conjuntivitis bacteriana necesita tratamiento con gotas o ung&uuml;entos antibi&oacute;ticos.</p>', '2020-01-11 20:34:59', '2020-01-11 20:35:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `threatments`
--

DROP TABLE IF EXISTS `threatments`;
CREATE TABLE IF NOT EXISTS `threatments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `threatments`
--

INSERT INTO `threatments` (`id`, `name`, `resume`, `img`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'TRATAMIENTO 2', 'Lorem2 ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde', '1.jpg', '<p>2Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.</p>', 1, '2020-01-11 03:49:57', '2020-01-11 05:21:25'),
(2, 'AFILADOR AUTOMATICO DE NAVAJAS', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae', '2.jpg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iusto magnam corrupti aut.</p>', 1, '2020-01-11 05:22:57', '2020-01-11 19:49:45'),
(5, 'JESUS FRANCISCO CORTES RODRIGUEZ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iu', '5.jpg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iuLorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iuLorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iuLorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iuLorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus autem fugiat soluta, necessitatibus recusandae sunt odit, laborum ullam impedit commodi quae rerum nulla maiores unde iu</p>', 1, '2020-01-11 20:01:16', '2020-01-11 20:01:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patern` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matern` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `user_type` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `patern`, `matern`, `phone`, `gender`, `active`, `user_type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jesus Fco', 'Rodriguez', '', '9611221222', 1, 1, 10, 'jfcr@live.com', NULL, '$2y$10$qmLCPoD6duyBD466YJfaAuql/95bIXgJ../Kuiv/ZN/PMcOCxZ/Z2', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
