-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2025 a las 18:00:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `original_mycms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `module`, `parent`, `name`, `slug`, `file_path`, `icono`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Seccion 1: Libros', 'seccion-1-libros', '2024-05-30', '423-1seccionlibros.png', 0, NULL, '2024-05-30 18:43:07', '2024-05-30 18:43:07'),
(2, 0, 0, 'Session 2: Material escolar', 'session-2-material-escolar', '2024-05-30', '313-2seccionmaterialescolar.png', 0, NULL, '2024-05-30 18:44:20', '2024-05-30 18:44:20'),
(3, 0, 0, 'Session 3: Papeleria', 'session-3-papeleria', '2024-05-30', '882-3papeleria.png', 0, NULL, '2024-05-30 18:44:34', '2024-05-30 18:44:34'),
(4, 0, 0, 'Session 4: Otros', 'session-4-otros', '2024-05-30', '475-4otros.png', 0, NULL, '2024-05-30 18:45:16', '2024-05-30 18:45:16'),
(5, 0, 1, '1Seccionlibros_1ficcion', '1seccionlibros-1ficcion', '2024-05-30', '714-1seccionlibros-1ficcion.png', 0, NULL, '2024-05-30 18:45:51', '2024-05-30 18:45:51'),
(6, 0, 1, '1Seccionlibros_2NoFiccion', '1seccionlibros-2noficcion', '2024-05-30', '454-1seccionlibros-2noficcion.png', 0, NULL, '2024-05-30 18:46:47', '2024-05-30 18:46:47'),
(7, 0, 1, '1Seccionlibros_3LibroparaNiños', '1seccionlibros-3libroparaninos', '2024-05-30', '306-1seccionlibros-3libroparaninos.png', 0, NULL, '2024-05-30 18:47:04', '2024-05-30 18:47:04'),
(8, 0, 2, '2SeccionMaterialEscolar_1UtilesEscrituras', '2seccionmaterialescolar-1utilesescrituras', '2024-05-30', '344-2seccionmaterialescolar-1utilesescrituras.png', 0, NULL, '2024-05-30 18:48:27', '2024-05-30 18:48:27'),
(9, 0, 2, '2SeccionMaterialEscolar_2Mochilas', '2seccionmaterialescolar-2mochilas', '2024-05-30', '618-2seccionmaterialescolar-2mochilas.png', 0, NULL, '2024-05-30 18:49:19', '2024-05-30 18:49:19'),
(10, 0, 2, '2SeccionMaterialEscolar_3Calculadoras', '2seccionmaterialescolar-3calculadoras', '2024-05-30', '589-2seccionmaterialescolar-3calculadoras.png', 0, NULL, '2024-05-30 18:49:31', '2024-05-30 18:49:31'),
(11, 0, 2, '2SeccionMaterialEscolar_4diccionarios', '2seccionmaterialescolar-4diccionarios', '2024-05-30', '777-2seccionmaterialescolar-4diccionarios.png', 0, NULL, '2024-05-30 18:49:45', '2024-05-30 18:49:45'),
(12, 0, 3, '3Papeleria_1TarjetaFelicitacion', '3papeleria-1tarjetafelicitacion', '2024-05-30', '268-3papeleria-1tarjetafelicitacion.png', 0, NULL, '2024-05-30 18:50:59', '2024-05-30 18:50:59'),
(13, 0, 3, '3Papeleria_2Regalos', '3papeleria-2regalos', '2024-05-30', '191-3papeleria-2regalos.png', 0, NULL, '2024-05-30 18:51:13', '2024-05-30 18:51:13'),
(14, 0, 3, '3Papeleria_3MateriaOficina', '3papeleria-3materiaoficina', '2024-05-30', '64-3papeleria-3materiaoficina.png', 0, NULL, '2024-05-30 18:51:28', '2024-05-30 18:51:28'),
(15, 0, 4, '4Otros_1LibrosElectronicos', '4otros-1libroselectronicos', '2024-05-30', '693-4otros-1libroselectronicos.png', 0, NULL, '2024-05-30 18:51:54', '2024-05-30 18:51:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coverage`
--

CREATE TABLE `coverage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ctype` int(11) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `days` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_06_103025_create_categories_table', 1),
(6, '2021_09_20_030321_create_products_table', 2),
(7, '2021_09_23_192238_add_field_file_path_to_products_table', 3),
(8, '2021_09_27_021443_create_product_gallery_table', 4),
(9, '2021_10_02_050641_add_field_avatar_status_to_users_table', 5),
(10, '2021_10_03_191801_add_field_permissions_to_users_table', 6),
(11, '2021_10_03_232459_add_field_inventory_and_code_to_products_table', 7),
(12, '2021_10_07_215253_add_fields_phone_year_gender', 8),
(13, '2021_10_11_003709_add_field_file_path_to_categories_table', 9),
(14, '2021_10_14_025348_create_sliders_table', 10),
(15, '2021_10_16_145010_create_table_user_favorites', 11),
(16, '2021_10_24_194645_add_field_parent_to_categories', 12),
(17, '2021_10_24_203622_add_field_order_to_categories_table', 13),
(18, '2021_10_24_224840_add_field_sub_category_id_to_products_table', 14),
(19, '2021_11_04_184511_create_products_inventory_table', 15),
(20, '2021_11_04_225737_create_product_inventory_variant', 16),
(21, '2021_11_05_010912_drop_products_table_price_inventory', 17),
(22, '2021_11_05_015822_add_price_field_to_products_table', 18),
(23, '2022_01_20_144352_create_orders_table', 19),
(24, '2022_01_20_155140_create_orders_items_table', 20),
(25, '2022_01_20_231250_add_field_price_org_to_table_orders_items', 21),
(26, '2022_01_21_004706_add_field_discount_until_date_to_table_products', 22),
(27, '2022_01_22_184923_add_field_discount_until_date_to_table_orders_items', 23),
(28, '2022_01_23_215902_create_coverage_table', 24),
(30, '2022_01_24_174734_add_fild_status_to_coverage_table', 25),
(31, '2022_01_27_211945_create_user_address_table', 26),
(32, '2022_01_27_214746_add_field_default_to_user_address_table', 27),
(33, '2022_04_26_023150_add_password_code_to_users_table', 28),
(34, '2024_05_29_194042_add_times_activity_fields_to_order_table', 29),
(35, '2024_05_30_065839_add_times_activity_fields2_to_order_table', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `o_number` varchar(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `o_type` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_address_id` int(11) DEFAULT NULL,
  `user_comment` text DEFAULT NULL,
  `subtotal` decimal(11,2) NOT NULL DEFAULT 0.00,
  `delivery` decimal(11,2) NOT NULL DEFAULT 0.00,
  `total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `payment_method` int(11) DEFAULT NULL,
  `payment_info` text DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `request_at` timestamp NULL DEFAULT NULL,
  `process_at` timestamp NULL DEFAULT NULL,
  `send_at` timestamp NULL DEFAULT NULL,
  `delivery_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_items`
--

CREATE TABLE `orders_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `label_item` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `discount_status` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `discount_until_date` date DEFAULT NULL,
  `price_initial` decimal(11,2) DEFAULT NULL,
  `price_unit` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL DEFAULT 0,
  `file_path` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `in_discount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_until_date` date DEFAULT NULL,
  `content` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `status`, `code`, `name`, `slug`, `category_id`, `subcategory_id`, `file_path`, `image`, `price`, `in_discount`, `discount`, `discount_until_date`, `content`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '0001', 'Libros 001-001', 'libros-001-001', 1, 5, '2024-05-30', '380-p1.png', 25.00, 0, 0, '2024-08-25', '&lt;p&gt;Libros 001-001 AA&lt;/p&gt;', NULL, '2024-05-30 18:53:53', '2024-05-30 19:00:20'),
(2, 1, '0002', 'Libros 001-002', 'libros-001-002', 1, 6, '2024-05-30', '807-p1.png', 34.00, 1, 10, '2025-01-30', '&lt;p&gt;Libros 001-001 A2&lt;/p&gt;', NULL, '2024-05-30 18:54:59', '2024-05-30 19:01:05'),
(3, 1, '0003', 'Libros 001-003', 'libros-001-003', 1, 7, '2024-05-30', '694-p1.png', 40.00, 1, 5, '2024-11-27', '&lt;p&gt;Libros 001-001 A3&lt;/p&gt;', NULL, '2024-05-30 18:58:39', '2024-05-30 19:01:41'),
(4, 1, '0004', 'Material escolar 0002', 'material-escolar-0002', 2, 8, '2024-05-30', '730-p2.png', 0.00, 1, 2, '2025-02-27', '&lt;p&gt;Material escolar A4&lt;/p&gt;', NULL, '2024-05-30 19:03:38', '2024-05-30 19:03:50'),
(5, 1, '0005', 'Material escolar 002-001', 'material-escolar-002-001', 2, 9, '2024-05-30', '1-p2.png', 0.00, 0, 0, '2024-12-21', '&lt;p&gt;Material escolar A5&lt;/p&gt;', NULL, '2024-05-30 19:05:40', '2024-05-30 19:06:11'),
(6, 1, '0006', 'Material escolar 002-002', 'material-escolar-002-002', 2, 10, '2024-05-30', '350-p2.png', 43.00, 1, 3, '2025-05-22', '&lt;p&gt;Material escolar 002-002 A6&lt;/p&gt;', NULL, '2024-05-30 19:06:55', '2024-05-30 19:07:58'),
(7, 1, '0007', 'Papeleria 003-001', 'papeleria-003-001', 3, 12, '2024-05-30', '648-p3.png', 15.00, 0, 0, '2025-02-14', '&lt;p&gt;Papeleria 003-001 A7&lt;/p&gt;', NULL, '2024-05-30 19:09:44', '2024-05-30 19:10:32'),
(8, 1, '0008', 'Otros 004-001', 'otros-004-001', 4, 15, '2024-05-30', '81-p9.png', 25.00, 1, 4, '2025-02-01', '&lt;p&gt;Otros 004-001 A10&lt;/p&gt;', NULL, '2024-05-30 19:11:56', '2024-05-30 19:12:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `limited` int(11) NOT NULL,
  `minimum` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `name`, `quantity`, `price`, `limited`, `minimum`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Libros001', 1000, 25.00, 0, 10, NULL, '2024-05-30 19:00:20', '2024-05-30 19:00:20'),
(2, 2, 'Libros2', 1000, 34.00, 1, 1, NULL, '2024-05-30 19:01:05', '2024-05-30 19:01:05'),
(3, 3, 'Libros3', 2500, 40.00, 1, 1, NULL, '2024-05-30 19:01:41', '2024-05-30 19:01:41'),
(4, 6, 'Material escolar 3', 2000, 43.00, 0, 1, NULL, '2024-05-30 19:07:39', '2024-05-30 19:07:39'),
(5, 7, 'Papeleria 1', 5000, 15.00, 1, 1, NULL, '2024-05-30 19:10:32', '2024-05-30 19:10:32'),
(6, 8, 'Otros 1', 10000, 25.00, 1, 1, NULL, '2024-05-30 19:12:42', '2024-05-30 19:12:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_inventory_variantes`
--

CREATE TABLE `product_inventory_variantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_inventory_variantes`
--

INSERT INTO `product_inventory_variantes` (`id`, `product_id`, `inventory_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Variante de 1 nivel', NULL, '2021-11-05 07:14:18', '2021-11-05 07:14:18'),
(2, 4, 1, 'Segunda Variante de nivel 1', NULL, '2021-11-05 07:15:31', '2021-11-05 07:15:31'),
(3, 4, 1, 'Variante 3 de nivel 1', NULL, '2021-11-05 07:15:53', '2021-11-05 07:30:44'),
(4, 1, 6, 'variante uno', NULL, '2022-01-20 22:22:52', '2022-01-20 22:22:52'),
(5, 1, 6, 'variante dos', NULL, '2022-01-20 22:23:00', '2022-01-20 22:23:00'),
(6, 1, 7, 'variante 3', NULL, '2022-01-21 03:41:25', '2022-01-21 03:41:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `sorder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_code` varchar(191) DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `status`, `role`, `name`, `lastname`, `email`, `avatar`, `phone`, `birthday`, `gender`, `email_verified_at`, `password`, `password_code`, `permissions`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Admin', 'ad', 'admin@gmail.com', '677_e.jpg', 343453, NULL, NULL, NULL, '$2y$10$LpjlxS6pWMsqt06mcka5EO0O0cxizQdEl2H0.nYDPUr/v07k59R8.', NULL, '{\"dashboard\":\"true\",\"dashboard_small_stats\":\"true\",\"dashboard_sell_today\":\"true\",\"products\":\"true\",\"product_add\":\"true\",\"product_edit\":\"true\",\"product_search\":\"true\",\"product_delete\":\"true\",\"product_gallery_add\":\"true\",\"product_gallery_deleted\":\"true\",\"product_inventory\":\"true\",\"categories\":\"true\",\"category_add\":\"true\",\"category_edit\":\"true\",\"category_delete\":\"true\",\"user_list\":\"true\",\"user_view\":\"true\",\"user_edit\":\"true\",\"user_banned\":\"true\",\"user_permissions\":\"true\",\"sliders_list\":\"true\",\"slider_add\":\"true\",\"slider_edit\":\"true\",\"slider_delete\":\"true\",\"configuracion\":\"true\",\"orders_list\":\"true\",\"order_view\":\"true\",\"orders_change_status\":\"true\",\"coverage_list\":\"true\",\"coverage_add\":\"true\",\"coverage_edit\":\"true\",\"coverage_delete\":\"true\"}', 'aBLUbalUQRJfZ6iXEoKX6sTbIzUeoMAXLeeH8oDak4u4sBGDartqNMjw1ivf', NULL, '2024-05-30 13:44:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `addr_info` text NOT NULL,
  `default` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `state_id`, `city_id`, `name`, `addr_info`, `default`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, 'Mi casa', '{\"add1\":\"Barrio1\",\"add2\":\"Avenida1\",\"add3\":\"150\",\"add4\":\"Frente a la tienda color verde\"}', 0, NULL, '2022-02-05 01:18:18', '2022-04-23 03:03:27'),
(2, 4, 1, 6, 'Mi oficina', '{\"add1\":\"Barrio1\",\"add2\":\"Avenida1\",\"add3\":\"3\",\"add4\":\"Frente a la tienda color verde\"}', 0, NULL, '2022-02-05 01:33:57', '2022-04-06 21:05:49'),
(3, 4, 3, 7, 'Mi trabajo', '{\"add1\":\"Barrio 2\",\"add2\":\"Avenida 2\",\"add3\":\"555\",\"add4\":\"Frente a la tienda color verde\"}', 1, NULL, '2022-02-05 02:39:42', '2022-04-23 03:03:27'),
(4, 1, 1, 2, 'Edson Gutierrez', '{\"add1\":\"sii\",\"add2\":\"av to,mas\",\"add3\":\"140\",\"add4\":\"or\"}', 1, NULL, '2024-05-22 13:26:04', '2024-05-22 13:26:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_favorites`
--

CREATE TABLE `user_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_favorites`
--

INSERT INTO `user_favorites` (`id`, `user_id`, `module`, `object_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 30, '2021-10-17 13:17:55', '2021-10-17 13:17:55'),
(2, 4, 1, 29, '2021-10-17 13:18:01', '2021-10-17 13:18:01'),
(3, 4, 1, 28, '2021-10-17 13:57:08', '2021-10-17 13:57:08'),
(4, 4, 1, 2, '2021-11-03 07:20:04', '2021-11-03 07:20:04'),
(5, 4, 1, 4, '2021-11-06 11:12:04', '2021-11-06 11:12:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coverage`
--
ALTER TABLE `coverage`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_inventory_variantes`
--
ALTER TABLE `product_inventory_variantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `coverage`
--
ALTER TABLE `coverage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `product_inventory_variantes`
--
ALTER TABLE `product_inventory_variantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
