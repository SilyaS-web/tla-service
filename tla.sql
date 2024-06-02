-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2024 г., 14:02
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tla`
--

-- --------------------------------------------------------

--
-- Структура таблицы `achievemnts`
--

CREATE TABLE `achievemnts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bloggers`
--

CREATE TABLE `bloggers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_achievement` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscriber_quantity` int(11) NOT NULL,
  `coverage` int(11) NOT NULL,
  `engagement_rate` double NOT NULL,
  `cost_per_mille` double NOT NULL,
  `gender_ratio` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bloggers`
--

INSERT INTO `bloggers` (`id`, `user_id`, `platform`, `description`, `is_achievement`, `name`, `sex`, `subscriber_quantity`, `coverage`, `engagement_rate`, `cost_per_mille`, `gender_ratio`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'youtube', 'youtube channel', 1, 'Канал добра и позитива', 'male', 123, 123, 123, 123, 123, '2024-06-02 11:36:15', '2024-06-02 11:36:15', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `deep_links`
--

CREATE TABLE `deep_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `work_id` bigint(20) UNSIGNED DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `deep_link_stats`
--

CREATE TABLE `deep_link_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `datatime` timestamp NULL DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_system` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `federal_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_bot` int(11) DEFAULT NULL,
  `is_mobile` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `work_id`, `user_id`, `message`, `viewed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Хелло', '2024-06-02 08:02:00', '2024-06-02 07:58:38', '2024-06-02 08:02:39', NULL),
(3, 1, 1, 'Итс ми', '2024-06-02 08:02:00', '2024-06-02 08:01:21', '2024-06-02 08:02:39', NULL),
(4, 1, 2, 'Ай вос вондеринг иф афтер олл зис еарс ю вод лайк то мит', NULL, '2024-06-02 08:02:21', '2024-06-02 08:02:21', NULL),
(5, 1, 2, 'Ту гоу овер еврифинг', NULL, '2024-06-02 08:02:37', '2024-06-02 08:02:37', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `message_files`
--

CREATE TABLE `message_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_05_27_093208_create_tg_phones_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_05_16_230109_create_projects_table', 1),
(7, '2024_05_24_102726_create_works_table', 1),
(8, '2024_05_24_110458_create_messages_table', 1),
(9, '2024_05_24_114155_create_sellers_table', 1),
(10, '2024_05_24_114200_create_bloggers_table', 1),
(11, '2024_05_24_124631_create_notifications_table', 1),
(12, '2024_05_24_124850_create_achievemnts_table', 1),
(13, '2024_05_24_124855_create_user_achievemnts_table', 1),
(14, '2024_05_24_151109_create_message_files_table', 1),
(15, '2024_05_24_170936_create_project_files_table', 1),
(16, '2024_05_29_013725_create_feedback_table', 1),
(17, '2024_05_30_134352_create_deep_links_table', 1),
(18, '2024_05_30_134418_create_deep_link_stats_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `text`, `viewed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Новая заявка', 'Вам поступила новая заявка от Алексей Селлер', NULL, '2024-06-02 07:57:26', '2024-06-02 07:57:26', NULL),
(2, 2, 'message', 'Вам поступило новое сообщение от Алексей Селлер', NULL, '2024-06-02 07:58:38', '2024-06-02 07:58:38', NULL),
(3, 2, 'message', 'Вам поступило новое сообщение от Алексей Селлер', NULL, '2024-06-02 07:59:46', '2024-06-02 07:59:46', NULL),
(4, 2, 'message', 'Вам поступило новое сообщение от Алексей Селлер', NULL, '2024-06-02 08:01:21', '2024-06-02 08:01:21', NULL),
(5, 1, 'message', 'Вам поступило новое сообщение от Алексей Блоггер', NULL, '2024-06-02 08:02:21', '2024-06-02 08:02:21', NULL),
(6, 1, 'message', 'Вам поступило новое сообщение от Алексей Блоггер', NULL, '2024-06-02 08:02:37', '2024-06-02 08:02:37', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
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
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_nm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `project_type`, `project_name`, `product_name`, `product_nm`, `product_link`, `product_price`, `status`, `seller_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'feedback', 'Беруши', 'Беруши для сна противошумные многоразовые 4 пары', '205060445', 'https://www.wildberries.ru/catalog/205060445/detail.aspx', 256, 0, 1, '2024-06-02 07:50:47', '2024-06-02 07:50:47', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `project_files`
--

INSERT INTO `project_files` (`id`, `source_id`, `type`, `link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0, 'projects/eVQGAOPv1iCHYWQhbLcRw6JXFrggGWFbAk766ExG.webp', '2024-06-02 07:50:47', '2024-06-02 07:50:47', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organization_type` int(11) DEFAULT NULL,
  `tariff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Пробный',
  `is_achievement` int(11) DEFAULT NULL,
  `remaining_tariff` int(11) NOT NULL DEFAULT 1,
  `is_agent` int(11) NOT NULL DEFAULT 0,
  `inn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `platform_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wb_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `organization_type`, `tariff`, `is_achievement`, `remaining_tariff`, `is_agent`, `inn`, `description`, `platform`, `finish_date`, `platform_link`, `wb_api_key`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Пробный', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-02 07:35:12', '2024-06-02 07:57:26', NULL),
(2, 2, NULL, 'Пробный', NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-02 07:35:58', '2024-06-02 07:35:58', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tg_phones`
--

CREATE TABLE `tg_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tg_phones`
--

INSERT INTO `tg_phones` (`id`, `phone`, `chat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '+70000000000', 123, '2024-06-02 11:32:04', '2024-06-02 11:32:04', NULL),
(2, '+71111111111', 1234, '2024-06-02 11:32:48', '2024-06-02 11:32:48', NULL),
(3, '+72222222222', 12345, '2024-06-02 11:33:04', '2024-06-02 11:33:04', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `telegram_verified_at` timestamp NULL DEFAULT NULL,
  `tg_phone_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `role`, `password`, `status`, `telegram_verified_at`, `tg_phone_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Алексей Селлер', 'seller@tla.ru', '+7 (000) 000-00-00', NULL, 'seller', '$2y$10$Yl7a4dgPRz6aAJedi8ekX.PGKKASTHeSOicXbV/WIanMUfpfboAwi', 0, NULL, 1, '2024-06-02 07:35:12', '2024-06-02 07:35:12', NULL),
(2, 'Алексей Блоггер', 'blogger@tla.ru', '+7 (111) 111-11-11', NULL, 'blogger', '$2y$10$JVWfo050lGabEl5GL91U1e7mA22wwe6pfPep8QCIDKuckqdn.YaJW', 0, NULL, 2, '2024-06-02 07:35:58', '2024-06-02 07:35:58', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_achievemnts`
--

CREATE TABLE `user_achievemnts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `achievement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE `works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blogger_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `confirmed_by_blogger_at` timestamp NULL DEFAULT NULL,
  `confirmed_by_seller_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `blogger_id`, `seller_id`, `project_id`, `status`, `confirmed_by_blogger_at`, `confirmed_by_seller_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 0, NULL, NULL, '2024-06-02 07:57:26', '2024-06-02 07:57:26', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `achievemnts`
--
ALTER TABLE `achievemnts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bloggers`
--
ALTER TABLE `bloggers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bloggers_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `deep_links`
--
ALTER TABLE `deep_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deep_links_user_id_foreign` (`user_id`),
  ADD KEY `deep_links_work_id_foreign` (`work_id`);

--
-- Индексы таблицы `deep_link_stats`
--
ALTER TABLE `deep_link_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deep_link_stats_link_id_foreign` (`link_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_work_id_foreign` (`work_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `message_files`
--
ALTER TABLE `message_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_files_source_id_foreign` (`source_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_seller_id_foreign` (`seller_id`);

--
-- Индексы таблицы `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_files_source_id_foreign` (`source_id`);

--
-- Индексы таблицы `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `tg_phones`
--
ALTER TABLE `tg_phones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tg_phones_phone_unique` (`phone`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_tg_phone_id_foreign` (`tg_phone_id`);

--
-- Индексы таблицы `user_achievemnts`
--
ALTER TABLE `user_achievemnts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_achievemnts_user_id_foreign` (`user_id`),
  ADD KEY `user_achievemnts_achievement_id_foreign` (`achievement_id`);

--
-- Индексы таблицы `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `works_blogger_id_foreign` (`blogger_id`),
  ADD KEY `works_seller_id_foreign` (`seller_id`),
  ADD KEY `works_project_id_foreign` (`project_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `achievemnts`
--
ALTER TABLE `achievemnts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bloggers`
--
ALTER TABLE `bloggers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `deep_links`
--
ALTER TABLE `deep_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `deep_link_stats`
--
ALTER TABLE `deep_link_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `message_files`
--
ALTER TABLE `message_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tg_phones`
--
ALTER TABLE `tg_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_achievemnts`
--
ALTER TABLE `user_achievemnts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `works`
--
ALTER TABLE `works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bloggers`
--
ALTER TABLE `bloggers`
  ADD CONSTRAINT `bloggers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `deep_links`
--
ALTER TABLE `deep_links`
  ADD CONSTRAINT `deep_links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deep_links_work_id_foreign` FOREIGN KEY (`work_id`) REFERENCES `works` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `deep_link_stats`
--
ALTER TABLE `deep_link_stats`
  ADD CONSTRAINT `deep_link_stats_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `deep_links` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_work_id_foreign` FOREIGN KEY (`work_id`) REFERENCES `works` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `message_files`
--
ALTER TABLE `message_files`
  ADD CONSTRAINT `message_files_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `project_files`
--
ALTER TABLE `project_files`
  ADD CONSTRAINT `project_files_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tg_phone_id_foreign` FOREIGN KEY (`tg_phone_id`) REFERENCES `tg_phones` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_achievemnts`
--
ALTER TABLE `user_achievemnts`
  ADD CONSTRAINT `user_achievemnts_achievement_id_foreign` FOREIGN KEY (`achievement_id`) REFERENCES `achievemnts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievemnts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_blogger_id_foreign` FOREIGN KEY (`blogger_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `works_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `works_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
