-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-07-2017 a las 12:03:49
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `msystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applications`
--

CREATE TABLE `applications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `IP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_read` enum('si','no') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `department_id`, `subject`, `message`, `IP`, `department_user`, `message_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 'asdasd', 'asdassad', '127.0.0.1', 'cardiologia consulta', 'si', '2017-07-09 03:46:41', '2017-07-09 12:20:21', NULL),
(2, 5, 2, 'asasd', 'asdaas', '127.0.0.1', 'cardiologia consulta', 'no', '2017-07-09 03:46:46', '2017-07-09 03:46:46', NULL),
(3, 5, 1, 'abc', 'asdaaasdasdassad', '127.0.0.1', 'cardiologia consulta', 'no', '2017-07-09 03:52:22', '2017-07-09 03:52:22', NULL),
(4, 5, 2, 'abcd', 'asdasdasdsd', '127.0.0.1', 'cardiologia consulta', 'no', '2017-07-09 04:00:27', '2017-07-09 04:00:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LG', '2017-07-08 23:01:41', '2017-07-08 23:01:41', NULL),
(2, 'SAMSUNG', '2017-07-08 23:01:41', '2017-07-08 23:01:41', NULL),
(3, 'HP', '2017-07-08 23:01:41', '2017-07-08 23:01:41', NULL),
(4, 'ASUS', '2017-07-08 23:01:41', '2017-07-08 23:01:41', NULL),
(5, 'INTEL', '2017-07-08 23:01:41', '2017-07-08 23:01:41', NULL),
(6, 'AMD', '2017-07-08 23:01:41', '2017-07-08 23:01:41', NULL),
(7, 'HITACHI', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(8, 'SEAGATE', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(9, 'VIT', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(10, 'COMPAQ', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(11, 'DELL', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(12, 'YBT', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(13, 'TOSHIBA', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(14, 'TP-LINK', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(15, 'LANPRO', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL),
(16, 'ZTE', '2017-07-08 23:01:42', '2017-07-08 23:01:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'informatica', NULL, '2017-07-08 23:01:39', '2017-07-08 23:01:39'),
(2, 'mantenimiento', NULL, '2017-07-08 23:01:39', '2017-07-08 23:01:39'),
(3, 'administracion', NULL, '2017-07-08 23:01:39', '2017-07-08 23:01:39'),
(4, 'recursos humanos', NULL, '2017-07-08 23:01:39', '2017-07-08 23:01:39'),
(5, 'servicios sociales', NULL, '2017-07-08 23:01:39', '2017-07-08 23:01:39'),
(6, 'coordinacion de enfermeria', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(7, 'docencia de enfermeria', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(8, 'control de gestion', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(9, 'asesoria legal', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(10, 'vigilancia y comunicacion', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(11, 'saniamiento', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(12, 'prensa', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(13, 'sala situacional', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(14, 'direccion', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(15, 'historias medicas', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(16, 'laboratorios', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(17, 'consulta de personal', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(18, 'rayos x', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(19, 'audiometria', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(20, 'banco de sangre', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(21, 'nutricion y dietetica', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(22, 'epidemiologia', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(23, 'hematologia', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(24, 'anatomia patologica', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(25, 'neurocirugia consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(26, 'ginecologia consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(27, 'neumonologia consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(28, 'medicina interna consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(29, 'gastroentereologia consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(30, 'toxicologia consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(31, 'salud ocupacional', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(32, 'oftalmologia consulta', NULL, '2017-07-08 23:01:40', '2017-07-08 23:01:40'),
(33, 'cardiologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(34, 'neurologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(35, 'odontologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(36, 'otorrino consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(37, 'rehabilitacion consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(38, 'oncologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(39, 'urologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(40, 'remautologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(41, 'radio terapia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(42, 'nefrologia consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(43, 'osteosintesis consulta', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41'),
(44, 'unidad de cuidados intensivos', NULL, '2017-07-08 23:01:41', '2017-07-08 23:01:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipments`
--

CREATE TABLE `equipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `hard_driver_id` int(10) UNSIGNED DEFAULT NULL,
  `ram_id` int(10) UNSIGNED DEFAULT NULL,
  `video_id` int(10) UNSIGNED DEFAULT NULL,
  `motherboard_id` int(10) UNSIGNED DEFAULT NULL,
  `read_driver_id` int(10) UNSIGNED DEFAULT NULL,
  `net_card_id` int(10) UNSIGNED DEFAULT NULL,
  `microprocessor_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inventory` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipments`
--

INSERT INTO `equipments` (`id`, `user_id`, `department_id`, `brand_id`, `hard_driver_id`, `ram_id`, `video_id`, `motherboard_id`, `read_driver_id`, `net_card_id`, `microprocessor_id`, `type`, `serial`, `IP`, `inventory`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 9, 2, 1, 2, 2, 2, 2, 2, 2, 'computador de escritorio', '9665JTH23', '192.168.88.36', 1, '2017-07-09 02:51:22', '2017-07-09 13:24:48', NULL),
(2, 1, 8, 13, 2, 1, 1, 1, 1, 1, 1, 'computador de escritorio', '9654FGH325', '192.168.88.32', 1, '2017-07-09 02:51:32', '2017-07-09 13:25:12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hard_drivers`
--

CREATE TABLE `hard_drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `hard_drivers`
--

INSERT INTO `hard_drivers` (`id`, `brand_id`, `serial`, `capacity`, `speed`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, '1', '120', '3400', 1, '2017-07-09 02:39:10', '2017-07-09 13:24:48', NULL),
(2, 4, '2', '420 GB', '7500 RPM', 1, '2017-07-09 02:39:20', '2017-07-09 13:25:12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventories`
--

INSERT INTO `inventories` (`id`, `equipment_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'asdasdsad', '2017-07-09 13:22:50', '2017-07-09 13:22:50', NULL),
(2, 2, 'asdasasasasd', '2017-07-09 13:25:13', '2017-07-09 13:25:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maintenances`
--

CREATE TABLE `maintenances` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `problem` longtext COLLATE utf8_unicode_ci NOT NULL,
  `solution` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `maintenances`
--

INSERT INTO `maintenances` (`id`, `equipment_id`, `problem`, `solution`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'asdasd', 'asdasasd', '2017-07-09 02:51:42', '2017-07-09 13:17:20', NULL),
(2, 2, 'asdasd', 'asdadasd', '2017-07-09 02:51:48', '2017-07-09 02:51:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `microprocessors`
--

CREATE TABLE `microprocessors` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand` enum('intel','amd') COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socket` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `microprocessors`
--

INSERT INTO `microprocessors` (`id`, `brand`, `model`, `speed`, `socket`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'intel', 'DUAL CORE', '2.5 GHZ', 'AF3456', 1, '2017-07-09 02:48:23', '2017-07-09 13:25:13', NULL),
(2, 'amd', 'ATX 10', '2.5 GHZ', 'AF34564', 1, '2017-07-09 02:48:31', '2017-07-09 13:24:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_16_000000_create_roles_table', 1),
(2, '2016_12_27_115653_create_departments_table', 1),
(3, '2016_12_27_115654_create_users_table', 1),
(4, '2016_12_27_115655_create_password_resets_table', 1),
(5, '2016_12_27_120018_create_applications_table', 1),
(6, '2016_12_27_120919_create_brands_table', 1),
(7, '2016_12_27_122711_create_hard_drivers_table', 1),
(8, '2016_12_27_132351_create_rams_table', 1),
(9, '2016_12_27_150655_create_videos_table', 1),
(10, '2016_12_27_151532_create_motherboards_table', 1),
(11, '2016_12_27_152110_create_read_drivers_table', 1),
(12, '2016_12_27_152500_create_net_cards_table', 1),
(13, '2017_06_16_015831_create_records_table', 1),
(14, '2017_06_17_121909_create_microprecessors_table', 1),
(15, '2017_06_18_121244_create_equipments_table', 1),
(16, '2017_06_19_153330_create_maintenances_table', 1),
(17, '2017_06_19_164433_create_inventories_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motherboards`
--

CREATE TABLE `motherboards` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `slot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `motherboards`
--

INSERT INTO `motherboards` (`id`, `brand_id`, `slot`, `usb`, `type_source`, `serial`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '5', '4', 'ATX', '9665JTH23', 1, '2017-07-09 02:48:41', '2017-07-09 13:25:12', NULL),
(2, 7, '5', '4', 'ATX', '98563FG', 1, '2017-07-09 02:48:51', '2017-07-09 13:24:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `net_cards`
--

CREATE TABLE `net_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `type` enum('interna','externa') COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_slot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `net_cards`
--

INSERT INTO `net_cards` (`id`, `brand_id`, `type`, `speed`, `type_slot`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 'interna', '100 mbps', 'RJ45', 1, '2017-07-09 02:49:15', '2017-07-09 13:25:13', NULL),
(2, 4, 'externa', '100 mbps', 'PCI-E', 1, '2017-07-09 02:49:27', '2017-07-09 13:24:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rams`
--

CREATE TABLE `rams` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rams`
--

INSERT INTO `rams` (`id`, `brand_id`, `type`, `speed`, `capacity`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 'DDR400', '400 MHZ', '1 GB', 1, '2017-07-09 02:50:22', '2017-07-09 13:25:12', NULL),
(2, 11, 'DDR400', '400 MHZ', '4 GB', 1, '2017-07-09 02:50:44', '2017-07-09 13:24:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `read_drivers`
--

CREATE TABLE `read_drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `type` enum('cd-r','cd-rw','dvd-r','dvd-rw') COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `read_drivers`
--

INSERT INTO `read_drivers` (`id`, `brand_id`, `type`, `speed`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 'dvd-rw', '1200 RPM', 1, '2017-07-09 02:49:42', '2017-07-09 13:25:12', NULL),
(2, 5, 'dvd-r', '1200 RPM', 1, '2017-07-09 02:49:52', '2017-07-09 13:24:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `operation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `records`
--

INSERT INTO `records` (`id`, `date`, `user`, `host`, `operation`, `table`, `reason`) VALUES
(1, '2017-07-09 02:39:10', 'admin admin', '127.0.0.1', 'INSERT', 'DiscosDuros', 'registro de disco duro'),
(2, '2017-07-09 02:39:20', 'admin admin', '127.0.0.1', 'INSERT', 'DiscosDuros', 'registro de disco duro'),
(3, '2017-07-09 02:48:23', 'admin admin', '127.0.0.1', 'INSERT', 'CPU', 'registro de cpu'),
(4, '2017-07-09 02:48:31', 'admin admin', '127.0.0.1', 'INSERT', 'CPU', 'registro de cpu'),
(5, '2017-07-09 02:48:41', 'admin admin', '127.0.0.1', 'INSERT', 'Tarjeta Madre', 'registro de tarjeta madre'),
(6, '2017-07-09 02:48:52', 'admin admin', '127.0.0.1', 'INSERT', 'Tarjeta Madre', 'registro de tarjeta madre'),
(7, '2017-07-09 02:49:15', 'admin admin', '127.0.0.1', 'INSERT', 'Tarjetas de Red', 'registro de tarjeta de red'),
(8, '2017-07-09 02:49:27', 'admin admin', '127.0.0.1', 'INSERT', 'Tarjetas de Red', 'registro de tarjeta de red'),
(9, '2017-07-09 02:49:42', 'admin admin', '127.0.0.1', 'INSERT', 'Unidad Lectora', 'registro de unidad lectora'),
(10, '2017-07-09 02:49:53', 'admin admin', '127.0.0.1', 'INSERT', 'Unidad Lectora', 'registro de unidad lectora'),
(11, '2017-07-09 02:50:02', 'admin admin', '127.0.0.1', 'INSERT', 'Memoria de Video', 'regstro de memoria de video'),
(12, '2017-07-09 02:50:07', 'admin admin', '127.0.0.1', 'INSERT', 'Memoria de Video', 'regstro de memoria de video'),
(13, '2017-07-09 02:50:22', 'admin admin', '127.0.0.1', 'INSERT', 'Memoria RAM', 'registro de memoria ram'),
(14, '2017-07-09 02:50:44', 'admin admin', '127.0.0.1', 'INSERT', 'Memoria RAM', 'registro de memoria ram'),
(15, '2017-07-09 02:51:22', 'admin admin', '127.0.0.1', 'INSERT', 'Equipos', 'registro de equipo'),
(16, '2017-07-09 02:51:32', 'admin admin', '127.0.0.1', 'INSERT', 'Equipos', 'registro de equipo'),
(17, '2017-07-09 02:51:42', 'admin admin', '127.0.0.1', 'INSERT', 'Mantenimiento', 'registro de mantenimiento'),
(18, '2017-07-09 02:51:48', 'admin admin', '127.0.0.1', 'INSERT', 'Mantenimiento', 'registro de mantenimiento'),
(19, '2017-07-09 13:17:19', 'admin admin', '127.0.0.1', 'DELETE', 'Mantenimiento', 'asdassa'),
(20, '2017-07-09 13:22:50', 'admin admin', '127.0.0.1', 'INSERT', 'Inventario', 'registro de equipo en inventario'),
(21, '2017-07-09 13:24:48', 'admin admin', '127.0.0.1', 'UPDATE', 'Inventarios', 'asdasas'),
(22, '2017-07-09 13:25:13', 'admin admin', '127.0.0.1', 'INSERT', 'Inventario', 'registro de equipo en inventario'),
(23, '2017-07-09 19:43:19', 'admin admin', '127.0.0.1', 'DELETE', 'Usuarios', 'asdadasd'),
(24, '2017-07-10 10:03:15', 'admin admin', '127.0.0.1', 'UPDATE', 'Usuarios', 'modificacion de usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'jefe de departamento', '2017-07-08 23:01:39', '2017-07-08 23:01:39', NULL),
(2, 'personal', '2017-07-08 23:01:39', '2017-07-08 23:01:39', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `active`, `department_id`, `role_id`, `name`, `lastname`, `cedula`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'admin', 'admin', '00000000', 'admin@gmail.com', '$2y$10$2c.3NMFZamNUDlCMNwZjgOfsU.XjdsV7EQ1Gdqr5XC5Kg3kDL24EC', 'XEcidEx2tYC0XoeGGLMm6zB9t3fdbkzNWTeuTFstegyZLVfldKQaNtQEKpxg', '2017-07-08 23:01:42', '2017-07-10 10:03:29', NULL),
(2, 1, 1, 2, 'personal', 'personal', '00000001', 'personal@gmail.com', '$2y$10$OYIJovNE4TXjmtOTP2rVM.yur.OIWG6E8zYSCZTasVEsuvv4T9zCG', 'ycL7lgyO86sZoz8NhQ90PHSpvN5poX226ACZ9krioVzfrkwWwDkh14OvmRWi', '2017-07-08 23:01:42', '2017-07-10 10:03:14', NULL),
(3, 1, 3, 1, 'administracion', 'administracion', '00000003', 'adminis@gmail.com', '$2y$10$ZiNIHG6RH22hMcPgDMHKC./pqgoPwYoN1cTAyFW.WAD/.XXsv17ni', '7554yXVrYAua5raT7YGIDM0HaTKp3Gu8oaz1vEMWRDtBC7MZNKTMqDLomIof', '2017-07-08 23:01:42', '2017-07-09 03:43:01', NULL),
(4, 1, 2, 1, 'mantenimiento', 'mantenimiento', '00000004', 'manteni@gmail.com', '$2y$10$7nPqEJCXkkw59wwC7Xdx4uUWytR8qPL/l8c1DF75Cy60RLZ7BMl42', 'EZ1G17KNkJ1gFHdBzu13vVEtRMwO5AmVIHZe25BxVdWo6aBBkkr66DUQriSm', '2017-07-08 23:01:42', '2017-07-09 04:00:35', NULL),
(5, 1, 33, 2, 'otro', 'otro', '22222222', 'otro@gmail.com', '$2y$10$SGaos82pfpoIW6bhOUCb8uJrHVPPRIIffYaY8/4o3cLDYvKGB138K', '9HafIHRpAiRqLPKr6JPNyZDNDvGtwOfNalnjdi3pRNDGDWbrBu2JXWJEDvCp', '2017-07-09 02:33:58', '2017-07-09 04:10:04', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('externa','integrada') COLLATE utf8_unicode_ci NOT NULL,
  `memory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `groove` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id`, `type`, `memory`, `groove`, `registered`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'integrada', '256 mb', 'VGA', 1, '2017-07-09 02:50:02', '2017-07-09 13:25:12', NULL),
(2, 'externa', '1 GB', 'PCI-E', 1, '2017-07-09 02:50:07', '2017-07-09 13:24:48', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_user_id_foreign` (`user_id`),
  ADD KEY `applications_department_id_foreign` (`department_id`);

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipments_serial_unique` (`serial`),
  ADD UNIQUE KEY `equipments_ip_unique` (`IP`),
  ADD KEY `equipments_user_id_foreign` (`user_id`),
  ADD KEY `equipments_brand_id_foreign` (`brand_id`),
  ADD KEY `equipments_department_id_foreign` (`department_id`),
  ADD KEY `equipments_hard_driver_id_foreign` (`hard_driver_id`),
  ADD KEY `equipments_ram_id_foreign` (`ram_id`),
  ADD KEY `equipments_video_id_foreign` (`video_id`),
  ADD KEY `equipments_motherboard_id_foreign` (`motherboard_id`),
  ADD KEY `equipments_read_driver_id_foreign` (`read_driver_id`),
  ADD KEY `equipments_net_card_id_foreign` (`net_card_id`),
  ADD KEY `equipments_microprocessor_id_foreign` (`microprocessor_id`);

--
-- Indices de la tabla `hard_drivers`
--
ALTER TABLE `hard_drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hard_drivers_serial_unique` (`serial`),
  ADD KEY `hard_drivers_brand_id_foreign` (`brand_id`);

--
-- Indices de la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_equipment_id_foreign` (`equipment_id`);

--
-- Indices de la tabla `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenances_equipment_id_foreign` (`equipment_id`);

--
-- Indices de la tabla `microprocessors`
--
ALTER TABLE `microprocessors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motherboards`
--
ALTER TABLE `motherboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motherboards_brand_id_foreign` (`brand_id`);

--
-- Indices de la tabla `net_cards`
--
ALTER TABLE `net_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `net_cards_brand_id_foreign` (`brand_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `rams`
--
ALTER TABLE `rams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rams_brand_id_foreign` (`brand_id`);

--
-- Indices de la tabla `read_drivers`
--
ALTER TABLE `read_drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `read_drivers_brand_id_foreign` (`brand_id`);

--
-- Indices de la tabla `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_cedula_unique` (`cedula`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `hard_drivers`
--
ALTER TABLE `hard_drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `microprocessors`
--
ALTER TABLE `microprocessors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `motherboards`
--
ALTER TABLE `motherboards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `net_cards`
--
ALTER TABLE `net_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rams`
--
ALTER TABLE `rams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `read_drivers`
--
ALTER TABLE `read_drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `equipments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `equipments_hard_driver_id_foreign` FOREIGN KEY (`hard_driver_id`) REFERENCES `hard_drivers` (`id`),
  ADD CONSTRAINT `equipments_microprocessor_id_foreign` FOREIGN KEY (`microprocessor_id`) REFERENCES `microprocessors` (`id`),
  ADD CONSTRAINT `equipments_motherboard_id_foreign` FOREIGN KEY (`motherboard_id`) REFERENCES `motherboards` (`id`),
  ADD CONSTRAINT `equipments_net_card_id_foreign` FOREIGN KEY (`net_card_id`) REFERENCES `net_cards` (`id`),
  ADD CONSTRAINT `equipments_ram_id_foreign` FOREIGN KEY (`ram_id`) REFERENCES `rams` (`id`),
  ADD CONSTRAINT `equipments_read_driver_id_foreign` FOREIGN KEY (`read_driver_id`) REFERENCES `read_drivers` (`id`),
  ADD CONSTRAINT `equipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `equipments_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);

--
-- Filtros para la tabla `hard_drivers`
--
ALTER TABLE `hard_drivers`
  ADD CONSTRAINT `hard_drivers_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `motherboards`
--
ALTER TABLE `motherboards`
  ADD CONSTRAINT `motherboards_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `net_cards`
--
ALTER TABLE `net_cards`
  ADD CONSTRAINT `net_cards_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rams`
--
ALTER TABLE `rams`
  ADD CONSTRAINT `rams_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `read_drivers`
--
ALTER TABLE `read_drivers`
  ADD CONSTRAINT `read_drivers_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
