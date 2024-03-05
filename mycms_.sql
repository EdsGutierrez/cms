-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2022 a las 03:13:40
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mycms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `module`, `parent`, `name`, `slug`, `file_path`, `icono`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Categoría 1', 'categoria-1', '2021-10-28', '649-activity.svg', 1, NULL, '2021-10-28 08:14:16', '2021-11-02 23:39:29'),
(2, 0, 0, 'Categoría 2', 'categoria-2', '2021-10-28', '840-airplay.svg', 0, NULL, '2021-10-28 08:14:33', '2021-10-28 08:14:33'),
(3, 0, 1, 'Subcategoría 1 de 1', 'subcategoria-1-de-1', '2021-10-28', '581-bar-chart.svg', 0, NULL, '2021-10-28 08:15:19', '2021-10-28 08:15:19'),
(4, 0, 1, 'Subcategoría 2 de 1', 'subcategoria-2-de-1', '2021-10-28', '259-bar-chart-2.svg', 0, NULL, '2021-10-28 08:16:17', '2021-11-02 17:06:04'),
(5, 0, 2, 'Sub Categoria 1 de 2', 'sub-categoria-1-de-2', '2021-12-17', '919-bxl-docker.png', 0, NULL, '2021-12-17 04:26:47', '2021-12-17 04:27:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(26, '2022_01_21_004706_add_field_discount_until_date_to_table_products', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `o_number` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `o_type` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_address_id` int(11) DEFAULT NULL,
  `user_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(11,2) NOT NULL DEFAULT 0.00,
  `delivery` decimal(11,2) NOT NULL DEFAULT 0.00,
  `total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `payment_method` int(11) NOT NULL DEFAULT 0,
  `payment_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `o_number`, `status`, `o_type`, `user_id`, `user_address_id`, `user_comment`, `subtotal`, `delivery`, `total`, `payment_method`, `payment_info`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 0, 4, NULL, NULL, '0.00', '0.00', '0.00', 0, NULL, NULL, '2022-01-20 19:39:23', '2022-01-20 19:39:23');

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
  `label_item` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `discount_status` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `price_initial` decimal(11,2) DEFAULT NULL,
  `price_unit` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders_items`
--

INSERT INTO `orders_items` (`id`, `user_id`, `order_id`, `product_id`, `inventory_id`, `variant_id`, `label_item`, `quantity`, `discount_status`, `discount`, `price_initial`, `price_unit`, `total`, `created_at`, `updated_at`) VALUES
(6, 4, 1, 1, 8, NULL, 'imagen uno / tres', 1, 1, 15, '151.00', '128.35', '128.35', '2022-01-21 04:43:41', '2022-01-21 04:43:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL DEFAULT 0,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `in_discount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_until_date` date DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `status`, `code`, `name`, `slug`, `category_id`, `subcategory_id`, `file_path`, `image`, `price`, `in_discount`, `discount`, `discount_until_date`, `content`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 'imagen uno', 'imagen-uno', 1, 3, '2022-01-20', '32-bx-accessibility.png', '10.00', 1, 15, '2022-01-30', '&lt;p&gt;imagen uno ... uno&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut eum maiores soluta hic, esse doloremque repudiandae vero repellat maxime numquam eveniet porro dolores autem ullam voluptate ea rerum quibusdam beatae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Tenetur fugiat assumenda, pariatur iusto tempora fugit repellat quia error quaerat velit atque perspiciatis reiciendis aperiam eveniet illum perferendis culpa mollitia quasi. Molestiae exercitationem eaque error. Quos animi obcaecati temporibus?&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Quibusdam sed maiores vitae sunt doloribus autem consequatur at laboriosam tempore voluptatem, dolorum suscipit doloremque, vel earum cum eos. Suscipit beatae recusandae nobis, sequi quia blanditiis est animi reiciendis quod.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Fuga illum incidunt impedit veniam rerum fugit tempora! Reprehenderit aperiam corrupti vero numquam officia officiis iure placeat adipisci! Odit odio molestias tempora exercitationem consequatur placeat totam obcaecati perferendis, atque nam.&lt;/p&gt;\r\n\r\n&lt;p&gt;Ducimus velit quam ipsa quo. Mo&lt;strong&gt;lestias aliquid, vitae ratione ipsam quos rem, libero atque totam labore ut minima qui sapiente ipsa voluptatem adipisci autem incidunt odit odio so&lt;/strong&gt;luta modi dolorem!&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;https://www.youtube.com/watch?v=n1O1MM3nYmI&lt;/p&gt;', NULL, '2021-10-28 08:18:07', '2022-01-21 04:59:58'),
(2, 1, '0', 'imagen dos', 'imagen-dos', 1, 4, '2021-10-28', '385-bxs-speaker.png', '0.00', 0, 0, NULL, '&lt;p&gt;imagen uno ... dos&lt;/p&gt;', NULL, '2021-10-28 08:18:58', '2021-11-02 22:46:28'),
(3, 1, '0', 'imagen 3', 'imagen-3', 1, 3, '2021-11-02', '155-bxs-map-pin.png', '0.00', 0, 0, NULL, '&lt;p&gt;imagen tres u subcategoria 2 de 1&lt;/p&gt;', NULL, '2021-11-02 23:13:05', '2021-11-02 23:26:11'),
(4, 1, '0', 'imagen cuatro', 'imagen-cuatro', 1, 3, '2021-11-02', '637-bx-download.png', '151.00', 0, 0, NULL, '&lt;p&gt;imagen 4 categoria 1 subcategoria 1 de 1&lt;/p&gt;', NULL, '2021-11-03 00:00:09', '2021-11-05 06:13:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `product_id`, `file_path`, `file_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 26, '2021-09-27', '731-logo.png', NULL, '2021-09-27 08:07:09', '2021-09-27 08:07:09'),
(2, 26, '2021-09-27', '141-is.png', NULL, '2021-09-27 08:29:30', '2021-09-27 08:29:30'),
(3, 27, '2021-09-27', '105-bibliotecacioss-removebg-preview-3b2fa63f3ab1beed32ddbfef2f9f5917.png', '2021-09-27 13:29:27', '2021-09-27 10:25:33', '2021-09-27 13:29:27'),
(5, 27, '2021-09-27', '25-logo.png', NULL, '2021-09-27 12:27:14', '2021-09-27 12:27:14'),
(6, 27, '2021-09-27', '949-is.jpg', NULL, '2021-09-27 12:27:27', '2021-09-27 12:27:27'),
(7, 27, '2021-09-27', '232-en-cartelera-escuadron-suicida-300x450.jpg', NULL, '2021-09-27 12:28:17', '2021-09-27 12:28:17'),
(8, 27, '2021-09-27', '798-en-cartelera-free-guy-300x450.jpg', NULL, '2021-09-27 12:28:25', '2021-09-27 12:28:25'),
(9, 27, '2021-09-27', '532-estreno-after-300x450.jpg', NULL, '2021-09-27 12:28:37', '2021-09-27 12:28:37'),
(10, 27, '2021-09-27', '830-web.png', '2021-09-27 13:32:10', '2021-09-27 12:28:47', '2021-09-27 13:32:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 4, '1 nivel', 1, '151.00', 1, 1, NULL, '2021-11-04 23:13:40', '2021-11-05 06:09:37'),
(2, 4, '50 personas', 1, '280.00', 1, 1, NULL, '2021-11-04 23:15:13', '2021-11-04 23:15:13'),
(3, 4, '100 personas2', 1, '500.00', 1, 1, NULL, '2021-11-04 23:15:42', '2021-11-05 00:12:28'),
(4, 4, '200 personas', 1, '900.00', 1, 1, NULL, '2021-11-04 23:25:42', '2021-11-05 00:26:35'),
(5, 4, '10 personas', 1, '55.00', 1, 1, '2021-11-05 06:13:27', '2021-11-05 06:11:00', '2021-11-05 06:13:27'),
(6, 1, 'uno', 100, '10.00', 0, 1, NULL, '2022-01-20 18:21:19', '2022-01-20 23:45:01'),
(7, 1, 'dos', 1, '20.00', 0, 1, NULL, '2022-01-20 18:21:33', '2022-01-20 18:21:33'),
(8, 1, 'tres', 2, '151.00', 0, 1, NULL, '2022-01-20 23:44:48', '2022-01-21 04:38:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_inventory_variantes`
--

CREATE TABLE `product_inventory_variantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_inventory_variantes`
--

INSERT INTO `product_inventory_variantes` (`id`, `product_id`, `inventory_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Variante de 1 nivel', NULL, '2021-11-05 03:14:18', '2021-11-05 03:14:18'),
(2, 4, 1, 'Segunda Variante de nivel 1', NULL, '2021-11-05 03:15:31', '2021-11-05 03:15:31'),
(3, 4, 1, 'Variante 3 de nivel 1', NULL, '2021-11-05 03:15:53', '2021-11-05 03:30:44'),
(4, 1, 6, 'variante uno', NULL, '2022-01-20 18:22:52', '2022-01-20 18:22:52'),
(5, 1, 6, 'variante dos', NULL, '2022-01-20 18:23:00', '2022-01-20 18:23:00'),
(6, 1, 7, 'variante 3', NULL, '2022-01-20 23:41:25', '2022-01-20 23:41:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sliders`
--

INSERT INTO `sliders` (`id`, `user_id`, `status`, `name`, `file_path`, `file_name`, `content`, `sorder`, `created_at`, `updated_at`) VALUES
(2, 4, 0, 'slider 2', '2021-10-14', '702-bx-slideshow.png', '&lt;h2&gt;Slider &lt;h2&gt;\r\n&lt;p&gt;Esto es un slider dos&lt;/p&gt;', 0, '2021-10-14 07:35:16', '2021-10-14 22:49:14'),
(3, 4, 1, 'slider 3', '2021-10-14', '814-bx-transfer-alt.png', '&lt;h2&gt;Slider tres&lt;/h2&gt;\r\n&lt;p&gt; Desxipcoin tres &lt;/p&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, aliquid magnam consectetur atque soluta nostrum\r\n    similique aspernatur doloremque odio ipsam itaque corrupti aperiam deserunt voluptatum assumenda dolorem sint earum\r\n    natus.&lt;/p&gt;\r\n&lt;a href=&quot;http://www.google.com&quot; class=&quot;btn&quot;&gt; Detalles&lt;/a&gt;', 1, '2021-10-14 08:39:42', '2021-10-15 02:47:26'),
(5, 4, 1, 'SLIDER 5', '2021-10-14', '437-bxs-slideshow.png', '&lt;h2&gt;ESLIDER CINCO&lt;/h2&gt;\r\n&lt;p&gt;Descripcion cinco&lt;/p&gt;', 3, '2021-10-14 20:26:22', '2021-10-14 20:26:22'),
(6, 4, 1, 'Slider 4', '2021-10-14', '487-bx-download.png', '&lt;h2&gt;Slider cuatro&lt;/h2&gt;\r\n&lt;p&gt;Desxipcoin cuadtro&lt;/p&gt;', 2, '2021-10-14 20:27:20', '2021-10-14 20:27:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `status`, `role`, `name`, `lastname`, `email`, `avatar`, `phone`, `birthday`, `gender`, `email_verified_at`, `password`, `permissions`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 'usuario1', 'usuario uno', 'usuario1@gmail.com', '800_default-avatar.png', 71107566, '1944-01-01', 1, '2021-10-28 07:51:33', '$2y$10$LpjlxS6pWMsqt06mcka5EO0O0cxizQdEl2H0.nYDPUr/v07k59R8.', '{\"dashboard\":\"true\",\"dashboard_small_stats\":\"true\",\"dashboard_sell_today\":\"true\",\"products\":\"true\",\"product_add\":\"true\",\"product_edit\":\"true\",\"product_search\":\"true\",\"product_delete\":\"true\",\"product_gallery_add\":\"true\",\"product_gallery_deleted\":\"true\",\"product_inventory\":\"true\",\"categories\":\"true\",\"category_add\":\"true\",\"category_edit\":\"true\",\"category_delete\":\"true\",\"user_list\":\"true\",\"user_edit\":\"true\",\"user_banned\":\"true\",\"user_permissions\":\"true\",\"sliders_list\":\"true\",\"slider_add\":\"true\",\"slider_edit\":\"true\",\"slider_delete\":\"true\",\"configuracion\":\"true\",\"orders_list\":\"true\"}', 'xpewjc78s2BPV1B021HJrsYkIGa4NKqDUWPARJIl0vbTEZuT3CIWyMfdgcxr', '2021-10-07 11:50:14', '2021-11-04 21:17:49'),
(5, 0, 0, 'usuario2', 'usuario dos', 'usuario2@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$7AeBtqCugL/IvYbo1WsRheiNiW5CwGEgZuKW9xdDDxlKs/wPuTgxq', '{\"dashboard\":\"true\"}', 'lkym5MycdDv6vaU1b9ISupCqDbUMXEfu8SAoqhsEhCQW0jhpZ8q82QGvnjFm', '2021-10-07 20:47:17', '2021-10-15 09:15:12');

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
(1, 4, 1, 30, '2021-10-17 09:17:55', '2021-10-17 09:17:55'),
(2, 4, 1, 29, '2021-10-17 09:18:01', '2021-10-17 09:18:01'),
(3, 4, 1, 28, '2021-10-17 09:57:08', '2021-10-17 09:57:08'),
(4, 4, 1, 2, '2021-11-03 03:20:04', '2021-11-03 03:20:04'),
(5, 4, 1, 4, '2021-11-06 07:12:04', '2021-11-06 07:12:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `product_inventory_variantes`
--
ALTER TABLE `product_inventory_variantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
