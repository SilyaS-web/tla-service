-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 30 2024 г., 20:56
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

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
  `id` bigint UNSIGNED NOT NULL,
  `text` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bloggers`
--

CREATE TABLE `bloggers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_achievement` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_ratio` double DEFAULT NULL,
  `sex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bloggers`
--

INSERT INTO `bloggers` (`id`, `user_id`, `description`, `is_achievement`, `name`, `country_id`, `city`, `gender_ratio`, `sex`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 18, 'Канал добра и позитива', 1, NULL, 2, '1', 70, 'female', '2024-08-11 10:52:52', '2024-08-30 16:35:18', NULL),
(4, 20, 'Мы семья ФиА, у нас семейный канал. \nМы переехали из Германии в Россию, в Воронежскую область.\nВлог о нашей жизни, и о нас.', 0, NULL, 1, 'Бутурлиновка', 50, 'female', '2024-08-11 12:08:20', '2024-08-11 19:37:36', NULL),
(6, 23, 'Я люблю видеоигры и гаджеты, и говорю о них простым языком.', 1, NULL, 1, 'Нижний Новгород', 50, 'male', '2024-08-12 08:22:42', '2024-08-19 15:25:42', NULL),
(7, 26, NULL, 0, NULL, 1, '1', 50, 'female', '2024-08-13 11:58:32', '2024-08-30 16:44:05', NULL),
(8, 29, 'Канал об электроинструменте, обзоры, тесты, ремонт электроинструмента.', 1, NULL, 1, 'Белгород', 50, 'male', '2024-08-13 19:55:23', '2024-08-14 08:57:51', NULL),
(9, 30, 'Этот канал о повседневной жизни семьи, переехавшие жить на юг с Урала. В 2019 году мы переехали жить в Краснодарский край в Белореченский район. В посёлке Родники купили новый дом с пред чистовой отделкой. Участок земли 5 соток. Теперь мы живём и обустраиваем наш дом, сад и всё это мы показываем вам. Как не бояться поменять место жительства, когда тебе за 50 лет.  Если Вы решили переехать или только думаете переезжать, то этот канал для вас.', 1, NULL, 1, 'Белореченск', 50, 'male', '2024-08-14 06:50:09', '2024-08-14 08:59:53', NULL),
(10, 32, 'Актер, блогер, общественный деятель', 1, NULL, 1, 'Москва', 50, 'male', '2024-08-16 12:05:04', '2024-08-16 12:16:23', NULL),
(11, 34, 'Samara\nКсю💛мать×5\nЗнаю,как выгодно покупать🛍️\nБесконечный декрет,распродажи,обзоры🤩#бьюти_ксю', 1, NULL, 1, 'Самара', 50, 'male', '2024-08-16 12:11:57', '2024-08-16 12:29:16', NULL),
(12, 35, 'Меня зовут Роксана. Я мама, в декрете, сын Максим, 3 годика. Мы снимаем распаковки с маркетплейсов, так же рецепты и свою жизнь.', 0, NULL, 1, 'Солнечногорск', 50, 'female', '2024-08-16 12:13:05', '2024-08-16 12:27:35', NULL),
(14, 37, 'Стилист, обзоры, лайфстайл', 0, NULL, 1, 'Москва', 50, 'male', '2024-08-16 12:15:42', '2024-08-16 12:24:40', NULL),
(15, 39, 'Блог о жизни многодетной мамы через юмор', 1, NULL, 1, 'Пермь', 50, 'female', '2024-08-16 13:15:14', '2024-08-16 14:43:26', NULL),
(16, 40, 'Снимаю  распаковки, находки и в целом из жизнь , есть двое сыновей 4года и 6 месяцев', 0, NULL, 1, 'Белорецк', 50, 'male', '2024-08-16 14:11:09', '2024-08-16 14:45:15', NULL),
(17, 42, 'Распаковки,находки,лайф', 1, NULL, 1, 'Казань', 50, 'female', '2024-08-16 15:02:33', '2024-08-16 15:47:46', NULL),
(18, 41, 'Обзоры WB, OZON\nМама прекрасной девочки Софии 💖\nУчитель начальных классов', 1, NULL, 1, 'Бахчисарай', 50, 'female', '2024-08-16 15:02:56', '2024-08-16 15:49:08', NULL),
(19, 43, 'Канал с обзорами на товары, семья, дети, дом, уют, многодетные будни, рейепты', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-16 16:09:36', '2024-08-16 16:14:08', NULL),
(20, 44, 'Распаковка товаров для дома', 1, NULL, 1, 'Евпатория', 50, 'male', '2024-08-16 17:02:03', '2024-08-16 17:13:43', NULL),
(21, 45, 'lifestyle | распаковки', 1, NULL, 1, '1', 51, 'female', '2024-08-16 17:26:09', '2024-08-29 14:31:14', NULL),
(22, 46, 'Снимаю обзоры на товары из мп. \n\nСниму эстетичный, нативный рилс. \n\nАктуальные товары: для дома, одежда для детей и взрослых, обувь, всё остальное обсуждается.', 1, NULL, 1, 'Азов', 50, 'female', '2024-08-16 18:49:13', '2024-08-17 07:06:40', NULL),
(24, 48, 'Снимаю обзор и распаковки', 1, NULL, 1, '1', 51, 'female', '2024-08-17 06:22:44', '2024-08-29 14:32:13', NULL),
(25, 49, 'Lifi style, дети, путешествия', 1, NULL, 1, '1', 50, 'female', '2024-08-17 07:30:11', '2024-08-30 16:42:30', NULL),
(26, 50, 'Распаковка товаров валдберис озон', 0, NULL, 1, 'Бузулук', 50, 'female', '2024-08-17 10:13:18', '2024-08-17 10:18:31', NULL),
(27, 51, 'Большая часть видео на канале о мягкой кровле. Делаю обзоры материалов и инструмента.', 1, NULL, 1, 'Переславль-Залесский', 50, 'male', '2024-08-17 18:16:31', '2024-08-18 09:29:03', NULL),
(28, 52, 'Показываю лайфстайл мамы, делаю нативные обзоры на косметику, одежду женскую/детскую/мужскую, на товары для дома (недавно переехали в квартиру и занимаемся обустройством).', 1, NULL, 1, 'Краснодар', 50, 'female', '2024-08-17 20:00:20', '2024-08-18 09:30:47', NULL),
(29, 53, 'Женский лайфблог в «Инстаграм» и «Ютуб» о юморе, распаковках, также снимаю тренды, поддерживаю идеи селлеров и выполняю всё строго по ТЗ, если оно имеется, контент создаю с любовью и от души, дедлайн соблюдаю строго.', 1, NULL, 1, 'Симферополь', 50, 'female', '2024-08-17 21:09:45', '2024-08-18 09:32:14', NULL),
(30, 56, 'Распаковки, промокоды', 1, NULL, 1, 'Красноярск', 50, 'female', '2024-08-18 10:24:05', '2024-08-18 10:44:53', NULL),
(31, 57, 'Обзоры и распаковки с маркетплейсов, скидки', 1, NULL, 1, 'Севастополь', 50, 'female', '2024-08-18 11:22:23', '2024-08-18 11:46:02', NULL),
(32, 58, 'Распаковки, скидки акции, новинки обзоры', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-18 11:39:06', '2024-08-18 11:46:59', NULL),
(33, 61, NULL, NULL, NULL, 1, 'Киров', NULL, 'female', '2024-08-18 20:58:23', '2024-08-18 20:58:23', NULL),
(34, 61, NULL, NULL, NULL, 1, 'Киров', NULL, 'female', '2024-08-18 20:59:09', '2024-08-18 20:59:09', NULL),
(35, 62, 'Многодетная мама троих деток. Обзоры, юмор, распаковка', 0, NULL, 1, 'Воронеж', 50, 'female', '2024-08-19 06:22:05', '2024-08-19 06:24:09', NULL),
(36, 63, 'Приятная личность и вполне хорошая мать. \nА силы на всё найдем!\nБлог работающей мамы, которая не забывает про себя.', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-19 08:34:22', '2024-08-19 08:51:03', NULL),
(38, 66, 'Личный блог', NULL, NULL, 1, 'Москва', NULL, 'female', '2024-08-19 16:14:01', '2024-08-19 16:14:01', NULL),
(39, 69, 'Я веду свой блог в ютуб, инстаграм, телеграмм канал. Я занимаюсь журналистикой, балетом и моделингом! Снимаю влоги, тренды, распаковки и grwm! Буду рада сотрудничеству!', 0, NULL, 1, 'Москва', 50, 'female', '2024-08-19 18:11:53', '2024-08-19 18:34:27', NULL),
(40, 72, 'Лайф стайл, бьюти, юмор', 1, NULL, 1, 'Тула', 50, 'female', '2024-08-19 18:19:27', '2024-08-21 06:18:25', NULL),
(41, 67, 'Обучаю микроблоги продвижению. Сотрудничаю с брендами, снимаю обзоры и распаковки, также лайфстайл.', 1, NULL, 1, 'Псков', 50, 'female', '2024-08-19 18:35:24', '2024-08-21 06:19:37', NULL),
(42, 73, 'Жизнь мамы погодок. Вязание на заказ. Находки на маркетплейсах', 0, NULL, 1, 'Симферополь', 50, 'female', '2024-08-19 18:37:45', '2024-08-21 06:22:01', NULL),
(43, 74, 'Мамский блог\r\nОбзоры \r\nЛайф \r\nСтиль', 1, NULL, 1, 'Казань', 50, 'female', '2024-08-19 18:44:56', '2024-08-21 06:24:09', NULL),
(44, 75, 'Полезные интересные находки', 1, NULL, 1, 'Краснодар', 50, 'male', '2024-08-19 19:04:13', '2024-08-21 06:26:59', NULL),
(45, 76, 'Продвижение через reels, комфортный блоггинг, распаковки, сотрудничество, лайф', 0, NULL, 1, 'Люберцы', 50, 'female', '2024-08-19 19:27:16', '2024-08-21 06:28:14', NULL),
(46, 78, 'Рассмотрю ваши предложения 💝', 0, NULL, 1, 'Озерск', 50, 'female', '2024-08-19 19:44:08', '2024-08-21 06:29:05', NULL),
(47, 79, 'Здравствуйте.  Меня зовут Анна.\r\n\r\nУ меня Life блог.\r\nДелюсь находками, делаю обзоры.\r\n\r\nС удовольствием поработаю с вами на бартерной основе 👍🏼', 0, NULL, 1, 'Оренбург', 50, 'male', '2024-08-19 20:13:45', '2024-08-21 06:32:14', NULL),
(48, 80, '', 1, NULL, 1, 'Катайск', 50, 'male', '2024-08-20 03:04:55', '2024-08-21 06:33:17', NULL),
(49, 81, 'Лайф блог, с обзорами товаров и бьюти мастер', 1, NULL, 1, 'Барнаул', 50, 'female', '2024-08-20 05:29:13', '2024-08-21 06:35:42', NULL),
(50, 84, 'Тематика LIFESTYLE: активная многодетная мама (3 дочки и 1 сын), занимающаяся тренировками в зале, а также бегом. Интересуюсь обзорами женской одежды, косметики и красивыми местами', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-20 15:44:05', '2024-08-21 06:07:28', NULL),
(52, 86, 'Наталья-мама озорной девчонки Распаковки|сотрудничество|reels\nУвеличиваю продажи через красивые сторис и стильный визуал💫\nУчусь быть мамой', 1, NULL, 1, 'Воронеж', 50, 'female', '2024-08-20 19:46:07', '2024-08-21 06:10:54', NULL),
(53, 87, 'Лайфстайл', 1, NULL, 1, 'Нижний Тагил', 50, 'female', '2024-08-20 20:13:25', '2024-08-21 06:12:12', NULL),
(54, 88, 'Мола , стиль , красота и распаковка', 1, NULL, 1, 'Симферополь', 50, 'female', '2024-08-20 20:18:06', '2024-08-21 06:14:25', NULL),
(55, 89, 'Марика | Мами с юмором - Лайфстайл - Находки\n•Ращу сына Марка и Блог🤍\n•Будни мами в STORIES\n•Тут Находки для тебя и малыша, Лайф и Юмор', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-20 21:06:55', '2024-08-21 06:15:26', NULL),
(56, 91, NULL, 1, NULL, 1, 'Челябинск', 50, 'female', '2024-08-21 06:36:04', '2024-08-21 15:29:46', NULL),
(57, 92, 'Лайф контент, юмор, красота, фотосессии, развлечения, поездки', 1, NULL, 1, 'Пермь', 50, 'female', '2024-08-21 12:28:38', '2024-08-21 15:40:44', NULL),
(58, 93, NULL, 1, NULL, 1, 'Ейск', 50, 'female', '2024-08-21 12:51:14', '2024-08-21 15:44:05', NULL),
(59, 94, 'Социальный блогер на ТВЦ\n\n✔️Блог про индустрию моды,  и образы на все случаи жизни.\n✔️Travel блог в сегменте семейных гостиничных услуг', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-21 12:54:54', '2024-08-21 15:50:10', NULL),
(60, 95, 'Семья', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-21 12:58:09', '2024-08-21 16:36:57', NULL),
(61, 96, 'Lifestyle, обзоры, покупки, рекомендации, распаковки, блог о семье и детях, также показываю супруга', 1, NULL, 1, 'Тюмень', 50, 'female', '2024-08-21 13:32:01', '2024-08-21 16:39:56', NULL),
(62, 98, 'Лайф, путешествия, бьюти, распаковки, семья', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-21 13:57:20', '2024-08-21 16:56:12', NULL),
(63, 99, 'Рассказываем как мы переехали жить на Кубань, делимся своими впечатлениями, рассказываем о себе, делаем ремонт,  готовим интересные кулинарные рецепты.', 1, NULL, 1, 'Ейск', 50, 'female', '2024-08-21 14:37:33', '2024-08-21 16:57:40', NULL),
(68, 107, NULL, NULL, NULL, 1, 'dimitrovgrad', NULL, 'male', '2024-08-22 06:28:01', '2024-08-22 06:28:01', NULL),
(70, 97, NULL, 1, NULL, 1, 'Санкт-Петербург', 50, 'female', '2024-08-22 07:37:52', '2024-08-22 07:45:20', NULL),
(71, 110, 'Строительство, сад , огород . Дети', 1, NULL, 1, 'Тюмень', 50, 'female', '2024-08-22 07:56:24', '2024-08-22 07:59:47', NULL),
(72, 111, NULL, 1, NULL, 1, 'Краснодар', 50, 'female', '2024-08-22 08:01:00', '2024-08-22 08:11:51', NULL),
(73, 112, 'Жена хоккеиста \nЛюблю хоккей \nПишу о косметике\nМама двоих детей \nСтрою дом \nИ пишу про ремонт', 1, NULL, 1, 'Омск', 50, 'female', '2024-08-22 08:09:44', '2024-08-22 08:13:05', NULL),
(74, 113, 'Рассказываю про материнство и домашние дела с юмором, делюсь находками и лайфхаками', 1, NULL, 1, 'Санкт-Петербург', 50, 'female', '2024-08-22 08:39:46', '2024-08-22 13:03:29', NULL),
(75, 114, 'Семейный, дети, лайф, дом, огород', 1, NULL, 1, 'Москва, Санкт-Петербург, Астрахань', 50, 'female', '2024-08-22 09:59:36', '2024-08-22 13:04:40', NULL),
(76, 116, 'Веду блог о жизни', 1, NULL, 1, 'Сочи', 50, 'female', '2024-08-22 11:16:45', '2024-08-22 13:18:01', NULL),
(77, 117, 'Юмор , деревня , дети', 1, NULL, 1, 'Калужская область , п Бетлица', 50, 'female', '2024-08-22 11:27:18', '2024-08-22 11:31:55', NULL),
(78, 118, 'Лайфстайл блог\nМамский блог \nОбзоры /скидки \nМама особенного ребенка', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-22 11:32:26', '2024-08-22 13:19:53', NULL),
(79, 119, 'Лайф', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-22 12:59:05', '2024-08-22 13:20:45', NULL),
(80, 120, 'Семейный блог, дети, распаковки, дача , огород, ремонт,рецепты, отдых, путешествия', 1, NULL, 1, 'Люберцы', 50, 'female', '2024-08-22 13:12:34', '2024-08-22 13:22:26', NULL),
(81, 121, 'Семейный канал, занимаемся ремонтом в квартире и частном доме. Показываем выгодные покупки и стильные вещи для дома. Есть ребенок 5 лет. Планируем второго. И занимаемся благоустройством детской комнаты.', 1, NULL, 1, 'Москва', 50, 'female', '2024-08-22 13:22:37', '2024-08-22 13:26:24', NULL),
(82, 122, '🏡ДЕРЕВНЯ 👩‍🌾ОГОРОД 🐄🐑🐓ХОЗЯЙСТВО👜РАСПАКОВКА\n👩‍🌾ЧИСТО ДЕРЕВЕНСКАЯ ЖИЗНЬ\n👧🏼👧🏼 ДВЕ ЛАПОЧКИ ДОЧКИ\n👵У НАС УЮТНО И ТЕПЛО, КАК У БАБУШКИ В ДЕРЕВНЕ 🏡\n👜РАСПАКОВКА WB OZON', 1, NULL, 1, 'Бетлица', 50, 'female', '2024-08-22 15:25:48', '2024-08-22 15:27:16', NULL),
(83, 123, NULL, 1, NULL, 1, 'Красноярск', 50, 'female', '2024-08-22 17:10:45', '2024-08-22 17:17:56', NULL),
(84, 128, 'Будни многодетный мамы', 1, NULL, 1, 'Волгоград', 50, 'female', '2024-08-25 12:46:51', '2024-08-25 12:50:47', NULL),
(85, 131, 'Обзоры, многодетная мама', 1, NULL, 1, 'Кострома', 50, 'female', '2024-08-25 20:23:04', '2024-08-26 06:34:43', NULL),
(86, 132, NULL, 1, NULL, 1, 'Новотроицк', 50, 'female', '2024-08-26 11:03:09', '2024-08-26 11:25:22', NULL),
(87, 133, 'Канал посвящен видеоиграм, а именно разбором мифов легенд и сценария.', 1, NULL, 1, 'Казань', 50, 'male', '2024-08-26 14:23:33', '2024-08-26 14:24:28', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `blogger_platforms`
--

CREATE TABLE `blogger_platforms` (
  `id` bigint UNSIGNED NOT NULL,
  `blogger_id` bigint UNSIGNED NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscriber_quantity` int DEFAULT NULL,
  `coverage` int DEFAULT NULL,
  `engagement_rate` double DEFAULT NULL,
  `cost_per_mille` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `additional_coverage` int DEFAULT NULL,
  `additional_engagement_rate` double DEFAULT NULL,
  `platform_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `blogger_platforms`
--

INSERT INTO `blogger_platforms` (`id`, `blogger_id`, `link`, `subscriber_quantity`, `coverage`, `engagement_rate`, `cost_per_mille`, `created_at`, `updated_at`, `deleted_at`, `additional_coverage`, `additional_engagement_rate`, `platform_id`, `name`) VALUES
(2, 3, 'https://t.me/chedkiy1', 1, 3, 300, 2, '2024-08-11 10:52:52', '2024-08-30 16:35:18', NULL, NULL, NULL, 1, NULL),
(3, 3, 'https://www.instagram.com/chedkiy2', 4, 6, 150, 5, '2024-08-11 10:52:52', '2024-08-30 16:35:18', NULL, NULL, NULL, 3, NULL),
(4, 3, 'https://youtube.com/@semyanachemodanax?si=JjP_l7lyy4oO4myc3', 7, 9, 128.57, 8, '2024-08-11 10:52:52', '2024-08-30 16:35:18', NULL, NULL, NULL, 2, NULL),
(5, 3, 'https://vk.com/semyanachemodanah4', 10, 12, 120, 11, '2024-08-11 10:52:52', '2024-08-30 16:35:18', NULL, 13, 130, 4, NULL),
(6, 4, 'https://t.me/semyafia', NULL, NULL, NULL, NULL, '2024-08-11 12:08:20', '2024-08-11 12:08:20', NULL, NULL, NULL, 1, NULL),
(7, 4, 'https://www.youtube.com/@semyafia', 2600, 3900, 150, NULL, '2024-08-11 12:08:20', '2024-08-11 19:37:36', NULL, NULL, NULL, 2, NULL),
(8, 4, 'https://vk.com/semyafia', NULL, NULL, NULL, NULL, '2024-08-11 12:08:20', '2024-08-11 12:08:20', NULL, NULL, NULL, 4, NULL),
(10, 6, 'https://youtube.com/@kuzyakin?si=yajG6uKZbU8g6l1L', 21200, 3000, 14, NULL, '2024-08-12 08:22:42', '2024-08-12 08:36:27', NULL, NULL, NULL, 2, NULL),
(11, 6, 'https://t.me/kuzyakin94', 744, 380, 51, NULL, '2024-08-12 08:36:27', '2024-08-12 08:36:27', NULL, NULL, NULL, 1, NULL),
(12, 6, 'https://vk.com/kuzyakinvk', 229, 211, 1, NULL, '2024-08-12 08:36:27', '2024-08-12 08:36:27', NULL, NULL, NULL, 4, NULL),
(13, 7, '@tutcozy', NULL, NULL, NULL, NULL, '2024-08-13 11:58:32', '2024-08-21 17:28:50', '2024-08-21 17:28:50', NULL, NULL, 1, NULL),
(14, 7, 'https://youtube.com/@murpainter?si=L7RpCcOfwYfhmP_X', 3510, 5000, 142, NULL, '2024-08-13 11:58:32', '2024-08-21 17:28:50', NULL, 3000, 85, 2, NULL),
(15, 8, 'https://t.me/remontelectroinstrumenta', 1823, 625, 34, NULL, '2024-08-13 19:55:23', '2024-08-14 08:57:51', NULL, NULL, NULL, 1, NULL),
(16, 8, 'https://www.instagram.com/industrial_tool', 2266, 1000, 44, NULL, '2024-08-13 19:55:23', '2024-08-14 08:57:51', NULL, NULL, NULL, 3, NULL),
(17, 8, 'https://www.youtube.com/@makitabelgorod', 11000, 1200, 10, NULL, '2024-08-13 19:55:23', '2024-08-14 08:57:51', NULL, NULL, NULL, 2, NULL),
(18, 8, 'https://vk.com/industrial_tool', 657, 216, 32, NULL, '2024-08-13 19:55:23', '2024-08-14 08:57:51', NULL, NULL, NULL, 4, NULL),
(19, 9, 'https://www.youtube.com/channel/UCsr-aqlotfFO55kV0X-UUaQ', 11100, 3800, 34, NULL, '2024-08-14 06:50:09', '2024-08-14 08:59:53', NULL, NULL, NULL, 2, NULL),
(20, 10, 'https://t.me/vadimst22', NULL, NULL, NULL, NULL, '2024-08-16 12:05:04', '2024-08-16 12:05:04', NULL, NULL, NULL, 1, NULL),
(21, 10, 'Instagram.com/stukalov23', 180000, 3000, 2, NULL, '2024-08-16 12:05:04', '2024-08-16 12:16:23', NULL, NULL, NULL, 3, NULL),
(22, 11, 'https://instagram.com/xenia.hram', 13000, 5100, 39, NULL, '2024-08-16 12:11:57', '2024-08-16 12:29:16', NULL, NULL, NULL, 3, NULL),
(23, 11, 'https://vk.com/ksyobzor', 1847, 1000, 54, NULL, '2024-08-16 12:11:57', '2024-08-16 12:29:16', NULL, NULL, NULL, 4, NULL),
(24, 12, 't.me/crystal_soln', NULL, NULL, NULL, NULL, '2024-08-16 12:13:05', '2024-08-16 12:13:05', NULL, NULL, NULL, 1, NULL),
(25, 12, 'https://www.instagram.com/_crystal_soln_', 2310, 1300, 56, NULL, '2024-08-16 12:13:05', '2024-08-16 12:27:35', NULL, NULL, NULL, 3, NULL),
(27, 14, 'https://www.instagram.com/lerakuznecova_/', 604, 1500, 200, NULL, '2024-08-16 12:15:42', '2024-08-16 12:24:40', NULL, NULL, NULL, 3, NULL),
(28, 15, 'https://www.instagram.com/golden_mom3', 5047, 2000, 39, NULL, '2024-08-16 13:15:14', '2024-08-16 14:43:26', NULL, NULL, NULL, 3, NULL),
(29, 16, 'https://www.instagram.com/__venerovna/profilecard/?igsh=MWI2aDRwZzUyb2E5OA==', 398, 295, 74, NULL, '2024-08-16 14:11:09', '2024-08-16 14:45:15', NULL, NULL, NULL, 3, NULL),
(30, 17, 'https://www.instagram.com/lanasmiii', 3938, 1800, 45, NULL, '2024-08-16 15:02:33', '2024-08-16 15:47:46', NULL, NULL, NULL, 3, NULL),
(31, 18, 'https://www.instagram.com/marisadi_mom', 2775, 2000, 72, NULL, '2024-08-16 15:02:56', '2024-08-16 15:49:08', NULL, NULL, NULL, 3, NULL),
(32, 19, 'https://t.me/irinkamamy_home', 4875, 9000, 184, NULL, '2024-08-16 16:09:36', '2024-08-16 16:14:08', NULL, NULL, NULL, 1, NULL),
(33, 19, 'https://instagram.com/irinkamamy', 8209, 3000, 36, NULL, '2024-08-16 16:09:36', '2024-08-16 16:14:08', NULL, NULL, NULL, 3, NULL),
(34, 19, 'https://youtube.com/@medinceva', 81000, 4000, 4, NULL, '2024-08-16 16:09:36', '2024-08-16 16:14:08', NULL, NULL, NULL, 2, NULL),
(35, 20, 'https://www.instagram.com/malvina_obzor', 5628, 2150, 38, NULL, '2024-08-16 17:02:03', '2024-08-16 17:13:43', NULL, NULL, NULL, 3, NULL),
(36, 20, 'https://youtube.com/@malvina_obzor', 1440, 500, 34, NULL, '2024-08-16 17:02:03', '2024-08-16 17:13:43', NULL, NULL, NULL, 2, NULL),
(37, 21, 'https://www.instagram.com/moseevaa_', 4545, 1900, 41, NULL, '2024-08-16 17:26:09', '2024-08-16 17:28:35', NULL, NULL, NULL, 3, NULL),
(38, 22, 'https://instagram.com/bloger_ksulife', 53900, 18000, 33.4, NULL, '2024-08-16 18:49:13', '2024-08-17 07:06:40', NULL, NULL, NULL, 3, NULL),
(41, 24, 'https://www.instagram.com/businka_134', 2048, 1000, 48.83, NULL, '2024-08-17 06:22:44', '2024-08-17 07:09:02', NULL, NULL, NULL, 3, NULL),
(42, 25, 'https://www.instagram.com/verushka7', 4131, 200, 4.84, NULL, '2024-08-17 07:30:11', '2024-08-17 07:32:57', NULL, NULL, NULL, 3, NULL),
(43, 25, 'https://vk.com/veraefra', 9497, 300, 3.16, NULL, '2024-08-17 07:30:11', '2024-08-17 07:32:57', NULL, NULL, NULL, 4, NULL),
(44, 26, 'https://www.instagram.com/mene_stralia', 1048, 300, 28.63, NULL, '2024-08-17 10:13:18', '2024-08-17 10:18:31', NULL, NULL, NULL, 3, NULL),
(45, 27, 'https://youtube.com/@dmitriy.a.', 14800, 4500, 30.41, NULL, '2024-08-17 18:16:31', '2024-08-18 09:29:03', NULL, NULL, NULL, 2, NULL),
(46, 27, 'https://vk.com/club199687128', 3579, 300, 8.38, NULL, '2024-08-17 18:16:31', '2024-08-18 09:29:03', NULL, NULL, NULL, 4, NULL),
(47, 28, 'https://t.me/ahmedovaalu', NULL, NULL, NULL, NULL, '2024-08-17 20:00:20', '2024-08-17 20:00:20', NULL, NULL, NULL, 1, NULL),
(48, 28, 'https://www.instagram.com/ahmedovalu/', 925, 2000, 216.22, NULL, '2024-08-17 20:00:20', '2024-08-18 09:30:47', NULL, NULL, NULL, 3, NULL),
(49, 28, 'https://www.youtube.com/@ahmedovalu', 274, 4000, 1459.85, NULL, '2024-08-17 20:00:20', '2024-08-18 09:30:47', NULL, NULL, NULL, 2, NULL),
(50, 29, 'https://www.instagram.com/_seitzhelilova', 847, 2000, 236.13, NULL, '2024-08-17 21:09:45', '2024-08-18 09:32:14', NULL, NULL, NULL, 3, NULL),
(51, 29, 'https://youtube.com/@Seitzhelilova', 411, 4000, 973.24, NULL, '2024-08-17 21:09:45', '2024-08-18 09:32:14', NULL, NULL, NULL, 2, NULL),
(52, 30, 'https://www.instagram.com/krisgepner', 6572, 2000, 30.43, NULL, '2024-08-18 10:24:05', '2024-08-18 10:44:53', NULL, NULL, NULL, 3, NULL),
(53, 31, 'https://www.instagram.com/alena_prosale', 41300, 7000, 16.95, NULL, '2024-08-18 11:22:23', '2024-08-18 11:46:02', NULL, NULL, NULL, 3, NULL),
(54, 32, 'https://t.me/kvazi1706', NULL, NULL, NULL, NULL, '2024-08-18 11:39:06', '2024-08-18 11:39:06', NULL, NULL, NULL, 1, NULL),
(55, 32, 'https://instagram.com/wildberries_dlyavseh', 47300, 8000, 16.91, NULL, '2024-08-18 11:39:06', '2024-08-18 11:46:59', NULL, NULL, NULL, 3, NULL),
(56, 33, '@vnatella', NULL, NULL, NULL, NULL, '2024-08-18 20:58:23', '2024-08-18 20:58:23', NULL, NULL, NULL, 1, NULL),
(57, 33, '@vnatella', NULL, NULL, NULL, NULL, '2024-08-18 20:58:23', '2024-08-18 20:58:23', NULL, NULL, NULL, 3, NULL),
(58, 34, '@vnatella', NULL, NULL, NULL, NULL, '2024-08-18 20:59:09', '2024-08-18 20:59:09', NULL, NULL, NULL, 1, NULL),
(59, 34, '@vnatella', NULL, NULL, NULL, NULL, '2024-08-18 20:59:09', '2024-08-18 20:59:09', NULL, NULL, NULL, 3, NULL),
(60, 35, 'myzalena1989', NULL, NULL, NULL, NULL, '2024-08-19 06:22:05', '2024-08-19 06:22:05', NULL, NULL, NULL, 1, NULL),
(61, 35, 'https://www.instagram.com/myzalena', 1737, 700, 40.3, NULL, '2024-08-19 06:22:05', '2024-08-19 06:24:09', NULL, NULL, NULL, 3, NULL),
(62, 36, 'https://t.me/kudrita', 1036, 350, 33.78, NULL, '2024-08-19 08:34:22', '2024-08-19 08:51:03', NULL, NULL, NULL, 1, NULL),
(64, 38, 'avdeevaa_polinaa', NULL, NULL, NULL, NULL, '2024-08-19 16:14:01', '2024-08-19 16:14:01', NULL, NULL, NULL, 1, NULL),
(65, 38, 'avdeevaa_polinaa', NULL, NULL, NULL, NULL, '2024-08-19 16:14:01', '2024-08-19 16:14:01', NULL, NULL, NULL, 2, NULL),
(66, 39, '@anaut21', NULL, NULL, NULL, NULL, '2024-08-19 18:11:53', '2024-08-19 18:11:53', NULL, NULL, NULL, 1, NULL),
(67, 39, 'https://www.instagram.com/anait_xs2010?igsh=MTRpanhrYzRuaGl1Yg%3D%3D&utm_source=qr', NULL, NULL, NULL, NULL, '2024-08-19 18:11:53', '2024-08-19 18:11:53', NULL, NULL, NULL, 3, NULL),
(68, 39, 'https://youtube.com/@anait_xs?si=t3x7RUsniK_7w7s-', NULL, NULL, NULL, NULL, '2024-08-19 18:11:53', '2024-08-19 18:11:53', NULL, NULL, NULL, 2, NULL),
(69, 39, 'https://vk.com/anait_xs', NULL, NULL, NULL, NULL, '2024-08-19 18:11:53', '2024-08-19 18:11:53', NULL, NULL, NULL, 4, NULL),
(70, 40, 'https://www.instagram.com/nvkvy?igsh=cjVxZjJvbmpqdHc=', 2726, 1500, 55, NULL, '2024-08-19 18:19:27', '2024-08-21 06:18:25', NULL, NULL, NULL, 3, NULL),
(71, 40, 'https://youtube.com/@nvkvy?si=yX4Z322PfQxdc_Q5', NULL, NULL, NULL, NULL, '2024-08-19 18:19:27', '2024-08-21 06:18:25', '2024-08-21 06:18:25', NULL, NULL, 2, NULL),
(72, 41, 'https://www.instagram.com/massimoovna?igsh=MXEzemZoajQyYXRvcg%3D%3D&utm_source=qr', 26300, 8000, 30, NULL, '2024-08-19 18:35:24', '2024-08-21 06:19:37', NULL, NULL, NULL, 3, NULL),
(73, 41, 'Нет', NULL, NULL, NULL, NULL, '2024-08-19 18:35:24', '2024-08-21 06:19:37', '2024-08-21 06:19:37', NULL, NULL, 2, NULL),
(74, 41, 'Нет', NULL, NULL, NULL, NULL, '2024-08-19 18:35:24', '2024-08-21 06:19:37', '2024-08-21 06:19:37', NULL, NULL, 4, NULL),
(75, 42, 'https://www.instagram.com/yu_tischenko?igsh=OWVyeDB1anYwYWs%3D&utm_source=qr', 1023, 500, 48, NULL, '2024-08-19 18:37:45', '2024-08-21 06:22:01', NULL, NULL, NULL, 3, NULL),
(76, 42, 'https://youtube.com/@yu_tischenko?si=fbR4Y5k3jmme0Sz1', 208, NULL, NULL, NULL, '2024-08-19 18:37:45', '2024-08-21 06:22:01', NULL, 500, 240, 2, NULL),
(77, 42, 'https://vk.com/yuliyatishenko', 361, 280, 77, NULL, '2024-08-19 18:37:45', '2024-08-21 06:22:01', NULL, NULL, NULL, 4, NULL),
(78, 43, 'https://t.me/dari_tigina', 446, 280, 62, NULL, '2024-08-19 18:44:56', '2024-08-21 06:24:09', NULL, NULL, NULL, 1, NULL),
(79, 43, 'https://www.instagram.com/dari_tigina', 2465, 3000, 121, NULL, '2024-08-19 18:44:56', '2024-08-21 06:24:09', NULL, NULL, NULL, 3, NULL),
(80, 44, 'https://www.instagram.com/_soffi_97_', 1903, 3100, 162, NULL, '2024-08-19 19:04:13', '2024-08-21 06:26:59', NULL, NULL, NULL, 3, NULL),
(81, 45, 'https://t.me/arinchikslife', NULL, NULL, NULL, NULL, '2024-08-19 19:27:16', '2024-08-21 06:28:14', '2024-08-21 06:28:14', NULL, NULL, 1, NULL),
(82, 45, 'https://www.instagram.com/demina.arinka?igsh=MWtxdXB2dnV4NnhlZA%3D%3D&utm_source=qr', 1812, 800, 44, NULL, '2024-08-19 19:27:16', '2024-08-21 06:28:14', NULL, NULL, NULL, 3, NULL),
(83, 46, 'https://t.me/Lida_Varlamova', NULL, NULL, NULL, NULL, '2024-08-19 19:44:08', '2024-08-21 06:29:05', '2024-08-21 06:29:05', NULL, NULL, 1, NULL),
(84, 46, 'https://www.instagram.com/lida__varlamova?igsh=OHZuenZ0NXdhOGY4&utm_source=qr', 1910, 500, 26, NULL, '2024-08-19 19:44:08', '2024-08-21 06:29:05', NULL, NULL, NULL, 3, NULL),
(85, 47, 'https://www.instagram.com/anna.pikalova', 6286, 1500, 23, NULL, '2024-08-19 20:13:45', '2024-08-21 06:32:14', NULL, NULL, NULL, 3, NULL),
(86, 48, 'https://www.instagram.com/dasha.permyakova5?igsh=eWQwYTA4Y2J4OW51', 3047, 1300, 42, NULL, '2024-08-20 03:04:55', '2024-08-21 06:33:17', NULL, NULL, NULL, 3, NULL),
(87, 49, 'https://www.instagram.com/nastiagrebe?igsh=MTkzODVxNWUyaGNoNA==', 1762, 1300, 73, NULL, '2024-08-20 05:29:13', '2024-08-21 06:35:42', NULL, NULL, NULL, 3, NULL),
(88, 50, 'https://instagram.com/anzh_e_lika?igshid=YmMyMTA2M2Y=', 51100, 7000, 13.7, NULL, '2024-08-20 15:44:05', '2024-08-21 06:07:28', NULL, NULL, NULL, 3, NULL),
(93, 52, 'https://www.instagram.com/n.griboedova_?igsh=MWwyNnp1ajByejg2Nw%3D%3D&utm_source=qr', 3050, 1300, 42.62, NULL, '2024-08-20 19:46:07', '2024-08-21 06:10:54', NULL, NULL, NULL, 3, NULL),
(94, 52, 'https://vk.com/nataliagriboedova', 652, 150, 23.01, NULL, '2024-08-20 19:46:07', '2024-08-21 06:10:54', NULL, NULL, NULL, 4, NULL),
(95, 53, 'https://youtube.com/@dari__greental?si=PF42tFCoqJgoI9Rg', 698, NULL, NULL, NULL, '2024-08-20 20:13:25', '2024-08-21 06:12:12', NULL, 460, 65.9, 2, NULL),
(96, 53, 'https://vk.com/dari_greental', 677, 300, 44.31, NULL, '2024-08-20 20:13:25', '2024-08-21 06:12:12', NULL, NULL, NULL, 4, NULL),
(97, 54, 'https://www.instagram.com/difashionbeauty?igsh=YW44bTA2dTIwd2E4', 1953, 550, 28.16, NULL, '2024-08-20 20:18:06', '2024-08-21 06:14:25', NULL, NULL, NULL, 3, NULL),
(98, 54, 'https://www.youtube.com/@difashion', 46400, 3000, 6.47, NULL, '2024-08-20 20:18:06', '2024-08-21 06:14:25', NULL, 3000, 6.47, 2, NULL),
(99, 55, 'https://www.instagram.com/mir_mamy_life?igsh=MWNqNjBieHViODY5dg==', 879, 5000, 568.83, NULL, '2024-08-20 21:06:55', '2024-08-21 06:15:26', NULL, NULL, NULL, 3, NULL),
(100, 56, '@zhirovaks', NULL, NULL, NULL, NULL, '2024-08-21 06:36:04', '2024-08-21 15:29:46', '2024-08-21 15:29:46', NULL, NULL, 1, NULL),
(101, 56, 'https://www.instagram.com/ksuu_pmu?igsh=MXRvMXVnZGc3NHR1NQ==', 2023, 700, 34.6, NULL, '2024-08-21 06:36:04', '2024-08-21 15:29:46', NULL, NULL, NULL, 3, NULL),
(102, 57, 'https://www.instagram.com/99mimimi', 8091, 6000, 74.16, NULL, '2024-08-21 12:28:38', '2024-08-21 15:40:44', NULL, NULL, NULL, 3, NULL),
(103, 57, 'https://youtube.com/@red_mercedes', 21100, NULL, NULL, NULL, '2024-08-21 12:28:38', '2024-08-21 15:40:44', NULL, 6000, 28.44, 2, NULL),
(104, 58, 'https://instagram.com/nastena.statsenko?igshid=MmU2YjMzNjRlOQ==', 31200, 15000, 48.08, NULL, '2024-08-21 12:51:14', '2024-08-21 15:44:05', NULL, NULL, NULL, 3, NULL),
(105, 59, 'Https://t.me/obitchivaya', 127413, 83000, 65.14, NULL, '2024-08-21 12:54:54', '2024-08-21 15:50:10', NULL, NULL, NULL, 1, NULL),
(106, 59, 'https://instagram.com/obitchivaya?igshid=YmMyMTA2M2Y=', 1100000, 240000, 21.82, NULL, '2024-08-21 12:54:54', '2024-08-21 15:50:10', NULL, NULL, NULL, 3, NULL),
(107, 60, 'https://t.me/k_s_ksenyaa', 45277, 22000, 48.59, NULL, '2024-08-21 12:58:09', '2024-08-21 16:36:57', NULL, NULL, NULL, 1, NULL),
(108, 60, 'https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==', 209000, 70000, 33.49, NULL, '2024-08-21 12:58:09', '2024-08-21 16:36:57', NULL, NULL, NULL, 3, NULL),
(109, 61, 'https://t.me/VeraZausaylova', NULL, NULL, NULL, NULL, '2024-08-21 13:32:01', '2024-08-21 16:39:56', '2024-08-21 16:39:56', NULL, NULL, 1, NULL),
(110, 61, 'https://instagram.com/verazausaylova?igshid=YmMyMTA2M2Y=', 15500, 6500, 41.94, NULL, '2024-08-21 13:32:01', '2024-08-21 16:39:56', NULL, NULL, NULL, 3, NULL),
(111, 61, 'https://youtube.com/@verunchik_obo_vsem?feature=shared', 430, NULL, NULL, NULL, '2024-08-21 13:32:01', '2024-08-21 16:39:56', NULL, 450, 104.65, 2, NULL),
(112, 61, 'https://vk.com/club80111525', 8296, 5500, 66.3, NULL, '2024-08-21 13:32:01', '2024-08-21 16:39:56', NULL, NULL, NULL, 4, NULL),
(113, 62, 'https://instagram.com/makeeva___sveta?igshid=Zjc2ZTc4Nzk=', 42300, 18000, 42.55, NULL, '2024-08-21 13:57:20', '2024-08-21 16:56:12', NULL, NULL, NULL, 3, NULL),
(114, 63, 'https://youtube.com/channel/UC7M70CwTg2n_-U_2E3hfjVg?si=v-iF-2N4HZ_aeyjH', 45800, 20000, 43.67, NULL, '2024-08-21 14:37:33', '2024-08-21 16:57:40', NULL, 4000, 8.73, 2, NULL),
(127, 68, 'https://www.instagram.com/mnogodetnaya_mamochka_3/reels/', NULL, NULL, NULL, NULL, '2024-08-22 06:28:01', '2024-08-22 06:28:01', NULL, NULL, NULL, 3, NULL),
(132, 70, 'https://www.instagram.com/enji_kovaleva', 359000, 30000, 8.36, NULL, '2024-08-22 07:37:52', '2024-08-22 07:45:20', NULL, NULL, NULL, 3, NULL),
(133, 71, '@jglaz', NULL, NULL, NULL, NULL, '2024-08-22 07:56:24', '2024-08-22 07:59:47', '2024-08-22 07:59:47', NULL, NULL, 1, NULL),
(134, 71, 'https://www.instagram.com/tatjna.glazova_?igsh=MWxra24zNGd3eTJxNg==', 30400, 10000, 32.89, NULL, '2024-08-22 07:56:24', '2024-08-22 07:59:47', NULL, NULL, NULL, 3, NULL),
(135, 72, 'https://www.instagram.com/feya.katya?', 113000, 15000, 13.27, NULL, '2024-08-22 08:01:00', '2024-08-22 08:11:51', NULL, NULL, NULL, 3, NULL),
(136, 73, 'https://t.me/olga_ryabichenko', 23600, 15400, 65.25, NULL, '2024-08-22 08:09:44', '2024-08-22 08:13:05', NULL, NULL, NULL, 1, NULL),
(137, 73, 'https://instagram.com/olga_ryabichenko', 224000, 70000, 31.25, NULL, '2024-08-22 08:09:44', '2024-08-22 08:13:05', NULL, NULL, NULL, 3, NULL),
(138, 74, 'https://t.me/juliapopova_official', 20193, 5000, 24.76, NULL, '2024-08-22 08:39:46', '2024-08-22 13:03:29', NULL, NULL, NULL, 1, NULL),
(139, 74, 'https://www.instagram.com/wikipedia_jul', 50400, 16000, 31.75, NULL, '2024-08-22 08:39:46', '2024-08-22 13:03:29', NULL, NULL, NULL, 3, NULL),
(140, 75, 'https://www.instagram.com/lerchek.lovee?igsh=MXRxa2F0am5pZXJyNQ==', 703000, 270000, 38.41, NULL, '2024-08-22 09:59:36', '2024-08-22 13:04:40', NULL, NULL, NULL, 3, NULL),
(141, 76, 'https://t.me/necroftlara', 28888, 8000, 27.69, NULL, '2024-08-22 11:16:45', '2024-08-22 13:18:01', NULL, NULL, NULL, 1, NULL),
(142, 76, 'https://www.instagram.com/necroftlara?igsh=MTgwdTIzY21nZ3liOA==', 125000, 16000, 12.8, NULL, '2024-08-22 11:16:45', '2024-08-22 13:18:01', NULL, NULL, NULL, 3, NULL),
(143, 77, '@Yuliy_d', NULL, NULL, NULL, NULL, '2024-08-22 11:27:18', '2024-08-22 11:31:55', '2024-08-22 11:31:55', NULL, NULL, 1, NULL),
(144, 77, 'https://instagram.com/mnogodetnaya_mamochka_3?igshid=MzRlODBiNWFlZA==', 11800, 11000, 93.22, NULL, '2024-08-22 11:27:18', '2024-08-22 11:31:55', NULL, NULL, NULL, 3, NULL),
(145, 78, 'https://t.me/Ne_bigudi', 26743, 22000, 82.26, NULL, '2024-08-22 11:32:26', '2024-08-22 13:19:53', NULL, NULL, NULL, 1, NULL),
(146, 78, 'https://www.instagram.com/nebigudi', 490000, 100000, 20.41, NULL, '2024-08-22 11:32:26', '2024-08-22 13:19:53', NULL, NULL, NULL, 3, NULL),
(147, 79, 'https://www.instagram.com/yana_necmeyana?igsh=d2xkOHI0OGllYmFj', 106000, 17000, 16.04, NULL, '2024-08-22 12:59:05', '2024-08-22 13:20:45', NULL, NULL, NULL, 3, NULL),
(148, 80, 'https://www.instagram.com/kapitolina_sedco?igsh=MTF6cmhkYW1kaWVhZw==', 106000, 20000, 18.87, NULL, '2024-08-22 13:12:34', '2024-08-22 13:22:26', NULL, NULL, NULL, 3, NULL),
(149, 80, 'https://vk.com/kruella821', 1316, 200, 15.2, NULL, '2024-08-22 13:12:34', '2024-08-22 13:22:26', NULL, NULL, NULL, 4, NULL),
(150, 81, 'https://t.me/victorianoka', 172559, 30000, 17.39, NULL, '2024-08-22 13:22:37', '2024-08-22 13:26:24', NULL, NULL, NULL, 1, NULL),
(151, 81, 'https://www.instagram.com/victoriaanoka?igsh=bnFpaWVmMG8xZzVv&utm_source=qr', 282000, 70000, 24.82, NULL, '2024-08-22 13:22:37', '2024-08-22 13:26:24', NULL, NULL, NULL, 3, NULL),
(152, 82, 'https://t.me/Olenka_Dmitrakova', NULL, NULL, NULL, NULL, '2024-08-22 15:25:48', '2024-08-22 15:27:16', '2024-08-22 15:27:16', NULL, NULL, 1, NULL),
(153, 82, 'https://www.instagram.com/ola_iz_derevni?igsh=ZmUxY3kweHFxY3Vm', 13200, 12000, 90.91, NULL, '2024-08-22 15:25:48', '2024-08-22 15:27:16', NULL, NULL, NULL, 3, NULL),
(154, 83, 'https://www.instagram.com/aleksa_kez?igsh=MWRvNGZrM3dhNXppNg%3D%3D&utm_source=qr', 61600, 30000, 48.7, NULL, '2024-08-22 17:10:45', '2024-08-22 17:17:56', NULL, NULL, NULL, 3, NULL),
(155, 84, 'https://t.me/luda_potapova88', NULL, NULL, NULL, NULL, '2024-08-25 12:46:51', '2024-08-25 12:50:47', '2024-08-25 12:50:47', NULL, NULL, 1, NULL),
(156, 84, 'https://www.instagram.com/luda_potapova88?igsh=MXZjdzBwZGZucTg2eg==', 15600, 7600, 48.72, NULL, '2024-08-25 12:46:51', '2024-08-25 12:50:47', NULL, NULL, NULL, 3, NULL),
(157, 84, 'https://youtube.com/@luda_potapova88?si=2wk0I827-SfckpwF', NULL, NULL, NULL, NULL, '2024-08-25 12:46:51', '2024-08-25 12:50:47', '2024-08-25 12:50:47', NULL, NULL, 2, NULL),
(158, 84, 'https://vk.com/id66855797', NULL, NULL, NULL, NULL, '2024-08-25 12:46:51', '2024-08-25 12:50:47', '2024-08-25 12:50:47', NULL, NULL, 4, NULL),
(159, 85, 'https://instagram.com/tanya.polly?igshid=OGQ5ZDc2ODk2ZA==', 6212, 200, 3.22, NULL, '2024-08-25 20:23:04', '2024-08-26 06:34:43', NULL, NULL, NULL, 3, NULL),
(160, 85, 'https://vk.com/beautyont', 855, 100, 11.7, NULL, '2024-08-25 20:23:04', '2024-08-26 06:34:43', NULL, NULL, NULL, 4, NULL),
(161, 86, 'https://www.instagram.com/mamka.tatka?igsh=Y2xoaDIyNTNreTFn&utm_source=qr', 2466, 300, 12.17, NULL, '2024-08-26 11:03:09', '2024-08-26 11:25:22', NULL, NULL, NULL, 3, NULL),
(162, 87, 'https://www.youtube.com/@TRlANGLE', 114000, 120000, 105.26, NULL, '2024-08-26 14:23:33', '2024-08-26 14:24:28', NULL, NULL, NULL, 2, NULL),
(163, 21, 'https://t.me/madnisssss', 1, 3, 300, 2, '2024-08-29 14:31:14', '2024-08-29 14:31:14', NULL, NULL, NULL, 1, NULL),
(164, 24, 'https://t.me/madnisssss', 1, 3, 300, 2, '2024-08-29 14:32:13', '2024-08-29 14:32:13', NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `blogger_themes`
--

CREATE TABLE `blogger_themes` (
  `id` bigint UNSIGNED NOT NULL,
  `blogger_id` bigint UNSIGNED NOT NULL,
  `theme_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `blogger_themes`
--

INSERT INTO `blogger_themes` (`id`, `blogger_id`, `theme_id`, `created_at`, `updated_at`) VALUES
(5, 3, 4, '2024-08-11 10:52:52', '2024-08-11 10:52:52'),
(6, 3, 17, '2024-08-11 10:52:52', '2024-08-11 10:52:52'),
(7, 3, 30, '2024-08-11 10:52:52', '2024-08-11 10:52:52'),
(8, 4, 4, '2024-08-11 12:08:20', '2024-08-11 12:08:20'),
(9, 4, 5, '2024-08-11 12:08:20', '2024-08-11 12:08:20'),
(10, 4, 7, '2024-08-11 12:08:20', '2024-08-11 12:08:20'),
(12, 6, 12, '2024-08-12 08:22:42', '2024-08-12 08:22:42'),
(13, 6, 21, '2024-08-12 08:22:42', '2024-08-12 08:22:42'),
(14, 6, 28, '2024-08-12 08:22:42', '2024-08-12 08:22:42'),
(15, 7, 5, '2024-08-13 11:58:32', '2024-08-13 11:58:32'),
(16, 7, 7, '2024-08-13 11:58:32', '2024-08-13 11:58:32'),
(17, 7, 17, '2024-08-13 11:58:32', '2024-08-13 11:58:32'),
(18, 8, 5, '2024-08-13 19:55:23', '2024-08-13 19:55:23'),
(19, 8, 24, '2024-08-13 19:55:23', '2024-08-13 19:55:23'),
(20, 8, 27, '2024-08-13 19:55:23', '2024-08-13 19:55:23'),
(21, 9, 2, '2024-08-14 06:50:09', '2024-08-14 06:50:09'),
(22, 9, 4, '2024-08-14 06:50:09', '2024-08-14 06:50:09'),
(23, 9, 5, '2024-08-14 06:50:09', '2024-08-14 06:50:09'),
(24, 10, 2, '2024-08-16 12:05:04', '2024-08-16 12:05:04'),
(25, 10, 5, '2024-08-16 12:05:04', '2024-08-16 12:05:04'),
(26, 10, 17, '2024-08-16 12:05:04', '2024-08-16 12:05:04'),
(27, 11, 17, '2024-08-16 12:11:57', '2024-08-16 12:11:57'),
(28, 11, 19, '2024-08-16 12:11:57', '2024-08-16 12:11:57'),
(29, 11, 25, '2024-08-16 12:11:57', '2024-08-16 12:11:57'),
(30, 12, 4, '2024-08-16 12:13:05', '2024-08-16 12:13:05'),
(31, 12, 8, '2024-08-16 12:13:05', '2024-08-16 12:13:05'),
(32, 12, 16, '2024-08-16 12:13:05', '2024-08-16 12:13:05'),
(36, 14, 16, '2024-08-16 12:15:42', '2024-08-16 12:15:42'),
(37, 14, 17, '2024-08-16 12:15:42', '2024-08-16 12:15:42'),
(38, 14, 19, '2024-08-16 12:15:42', '2024-08-16 12:15:42'),
(39, 15, 4, '2024-08-16 13:15:14', '2024-08-16 13:15:14'),
(40, 15, 17, '2024-08-16 13:15:14', '2024-08-16 13:15:14'),
(41, 15, 34, '2024-08-16 13:15:14', '2024-08-16 13:15:14'),
(42, 16, 4, '2024-08-16 14:11:09', '2024-08-16 14:11:09'),
(43, 16, 17, '2024-08-16 14:11:09', '2024-08-16 14:11:09'),
(44, 17, 4, '2024-08-16 15:02:33', '2024-08-16 15:02:33'),
(45, 17, 17, '2024-08-16 15:02:33', '2024-08-16 15:02:33'),
(46, 17, 19, '2024-08-16 15:02:33', '2024-08-16 15:02:33'),
(47, 18, 17, '2024-08-16 15:02:56', '2024-08-16 15:02:56'),
(48, 19, 4, '2024-08-16 16:09:36', '2024-08-16 16:09:36'),
(49, 19, 5, '2024-08-16 16:09:36', '2024-08-16 16:09:36'),
(50, 19, 17, '2024-08-16 16:09:36', '2024-08-16 16:09:36'),
(51, 20, 4, '2024-08-16 17:02:03', '2024-08-16 17:02:03'),
(52, 20, 5, '2024-08-16 17:02:03', '2024-08-16 17:02:03'),
(53, 20, 8, '2024-08-16 17:02:03', '2024-08-16 17:02:03'),
(54, 21, 16, '2024-08-16 17:26:09', '2024-08-16 17:26:09'),
(55, 21, 17, '2024-08-16 17:26:09', '2024-08-16 17:26:09'),
(56, 21, 19, '2024-08-16 17:26:09', '2024-08-16 17:26:09'),
(57, 22, 4, '2024-08-16 18:49:13', '2024-08-16 18:49:13'),
(58, 22, 7, '2024-08-16 18:49:13', '2024-08-16 18:49:13'),
(59, 22, 17, '2024-08-16 18:49:13', '2024-08-16 18:49:13'),
(63, 24, 16, '2024-08-17 06:22:44', '2024-08-17 06:22:44'),
(64, 24, 19, '2024-08-17 06:22:44', '2024-08-17 06:22:44'),
(65, 24, 36, '2024-08-17 06:22:44', '2024-08-17 06:22:44'),
(66, 25, 4, '2024-08-17 07:30:11', '2024-08-17 07:30:11'),
(67, 25, 5, '2024-08-17 07:30:11', '2024-08-17 07:30:11'),
(68, 25, 17, '2024-08-17 07:30:11', '2024-08-17 07:30:11'),
(69, 26, 4, '2024-08-17 10:13:18', '2024-08-17 10:13:18'),
(70, 26, 17, '2024-08-17 10:13:18', '2024-08-17 10:13:18'),
(71, 26, 25, '2024-08-17 10:13:18', '2024-08-17 10:13:18'),
(72, 27, 1, '2024-08-17 18:16:31', '2024-08-17 18:16:31'),
(73, 27, 2, '2024-08-17 18:16:31', '2024-08-17 18:16:31'),
(74, 28, 16, '2024-08-17 20:00:20', '2024-08-17 20:00:20'),
(75, 28, 17, '2024-08-17 20:00:20', '2024-08-17 20:00:20'),
(76, 28, 19, '2024-08-17 20:00:20', '2024-08-17 20:00:20'),
(77, 29, 2, '2024-08-17 21:09:45', '2024-08-17 21:09:45'),
(78, 29, 17, '2024-08-17 21:09:45', '2024-08-17 21:09:45'),
(79, 29, 34, '2024-08-17 21:09:45', '2024-08-17 21:09:45'),
(80, 30, 36, '2024-08-18 10:24:05', '2024-08-18 10:24:05'),
(81, 31, 16, '2024-08-18 11:22:23', '2024-08-18 11:22:23'),
(82, 31, 19, '2024-08-18 11:22:23', '2024-08-18 11:22:23'),
(83, 31, 25, '2024-08-18 11:22:23', '2024-08-18 11:22:23'),
(84, 32, 16, '2024-08-18 11:39:06', '2024-08-18 11:39:06'),
(85, 32, 17, '2024-08-18 11:39:06', '2024-08-18 11:39:06'),
(86, 32, 25, '2024-08-18 11:39:06', '2024-08-18 11:39:06'),
(87, 33, 16, '2024-08-18 20:58:23', '2024-08-18 20:58:23'),
(88, 33, 26, '2024-08-18 20:58:23', '2024-08-18 20:58:23'),
(89, 33, 32, '2024-08-18 20:58:23', '2024-08-18 20:58:23'),
(90, 34, 16, '2024-08-18 20:59:09', '2024-08-18 20:59:09'),
(91, 34, 26, '2024-08-18 20:59:09', '2024-08-18 20:59:09'),
(92, 34, 32, '2024-08-18 20:59:09', '2024-08-18 20:59:09'),
(93, 35, 4, '2024-08-19 06:22:05', '2024-08-19 06:22:05'),
(94, 35, 8, '2024-08-19 06:22:05', '2024-08-19 06:22:05'),
(95, 35, 16, '2024-08-19 06:22:05', '2024-08-19 06:22:05'),
(96, 36, 2, '2024-08-19 08:34:22', '2024-08-19 08:34:22'),
(97, 36, 4, '2024-08-19 08:34:22', '2024-08-19 08:34:22'),
(98, 36, 17, '2024-08-19 08:34:22', '2024-08-19 08:34:22'),
(101, 38, 16, '2024-08-19 16:14:01', '2024-08-19 16:14:01'),
(102, 38, 17, '2024-08-19 16:14:01', '2024-08-19 16:14:01'),
(103, 38, 20, '2024-08-19 16:14:01', '2024-08-19 16:14:01'),
(104, 39, 2, '2024-08-19 18:11:53', '2024-08-19 18:11:53'),
(105, 39, 16, '2024-08-19 18:11:53', '2024-08-19 18:11:53'),
(106, 39, 17, '2024-08-19 18:11:53', '2024-08-19 18:11:53'),
(107, 40, 2, '2024-08-19 18:19:27', '2024-08-19 18:19:27'),
(108, 40, 16, '2024-08-19 18:19:27', '2024-08-19 18:19:27'),
(109, 40, 17, '2024-08-19 18:19:27', '2024-08-19 18:19:27'),
(110, 41, 17, '2024-08-19 18:35:24', '2024-08-19 18:35:24'),
(111, 41, 36, '2024-08-19 18:35:24', '2024-08-19 18:35:24'),
(112, 42, 4, '2024-08-19 18:37:45', '2024-08-19 18:37:45'),
(113, 42, 17, '2024-08-19 18:37:45', '2024-08-19 18:37:45'),
(114, 42, 24, '2024-08-19 18:37:45', '2024-08-19 18:37:45'),
(115, 43, 4, '2024-08-19 18:44:56', '2024-08-19 18:44:56'),
(116, 43, 19, '2024-08-19 18:44:56', '2024-08-19 18:44:56'),
(117, 44, 4, '2024-08-19 19:04:13', '2024-08-19 19:04:13'),
(118, 44, 18, '2024-08-19 19:04:13', '2024-08-19 19:04:13'),
(119, 44, 19, '2024-08-19 19:04:13', '2024-08-19 19:04:13'),
(120, 45, 17, '2024-08-19 19:27:16', '2024-08-19 19:27:16'),
(121, 45, 18, '2024-08-19 19:27:16', '2024-08-19 19:27:16'),
(122, 45, 19, '2024-08-19 19:27:16', '2024-08-19 19:27:16'),
(123, 46, 4, '2024-08-19 19:44:08', '2024-08-19 19:44:08'),
(124, 46, 5, '2024-08-19 19:44:08', '2024-08-19 19:44:08'),
(125, 46, 9, '2024-08-19 19:44:08', '2024-08-19 19:44:08'),
(126, 47, 4, '2024-08-19 20:13:45', '2024-08-19 20:13:45'),
(127, 47, 17, '2024-08-19 20:13:45', '2024-08-19 20:13:45'),
(128, 47, 19, '2024-08-19 20:13:45', '2024-08-19 20:13:45'),
(129, 48, 4, '2024-08-20 03:04:55', '2024-08-20 03:04:55'),
(130, 48, 16, '2024-08-20 03:04:55', '2024-08-20 03:04:55'),
(131, 49, 2, '2024-08-20 05:29:13', '2024-08-20 05:29:13'),
(132, 49, 17, '2024-08-20 05:29:13', '2024-08-20 05:29:13'),
(133, 49, 36, '2024-08-20 05:29:13', '2024-08-20 05:29:13'),
(134, 50, 16, '2024-08-20 15:44:05', '2024-08-20 15:44:05'),
(135, 50, 17, '2024-08-20 15:44:05', '2024-08-20 15:44:05'),
(136, 50, 26, '2024-08-20 15:44:05', '2024-08-20 15:44:05'),
(139, 52, 4, '2024-08-20 19:46:07', '2024-08-20 19:46:07'),
(140, 52, 19, '2024-08-20 19:46:07', '2024-08-20 19:46:07'),
(141, 52, 34, '2024-08-20 19:46:07', '2024-08-20 19:46:07'),
(142, 53, 17, '2024-08-20 20:13:25', '2024-08-20 20:13:25'),
(143, 53, 20, '2024-08-20 20:13:25', '2024-08-20 20:13:25'),
(144, 53, 32, '2024-08-20 20:13:25', '2024-08-20 20:13:25'),
(145, 54, 2, '2024-08-20 20:18:06', '2024-08-20 20:18:06'),
(146, 54, 16, '2024-08-20 20:18:06', '2024-08-20 20:18:06'),
(147, 55, 4, '2024-08-20 21:06:55', '2024-08-20 21:06:55'),
(148, 55, 17, '2024-08-20 21:06:55', '2024-08-20 21:06:55'),
(149, 55, 34, '2024-08-20 21:06:55', '2024-08-20 21:06:55'),
(150, 56, 4, '2024-08-21 06:36:04', '2024-08-21 06:36:04'),
(151, 56, 17, '2024-08-21 06:36:04', '2024-08-21 06:36:04'),
(152, 56, 20, '2024-08-21 06:36:04', '2024-08-21 06:36:04'),
(153, 57, 9, '2024-08-21 12:28:38', '2024-08-21 12:28:38'),
(154, 57, 17, '2024-08-21 12:28:38', '2024-08-21 12:28:38'),
(155, 57, 34, '2024-08-21 12:28:38', '2024-08-21 12:28:38'),
(156, 58, 4, '2024-08-21 12:51:14', '2024-08-21 12:51:14'),
(157, 58, 17, '2024-08-21 12:51:14', '2024-08-21 12:51:14'),
(158, 58, 19, '2024-08-21 12:51:14', '2024-08-21 12:51:14'),
(159, 59, 4, '2024-08-21 12:54:54', '2024-08-21 12:54:54'),
(160, 59, 16, '2024-08-21 12:54:54', '2024-08-21 12:54:54'),
(161, 59, 17, '2024-08-21 12:54:54', '2024-08-21 12:54:54'),
(162, 60, 4, '2024-08-21 12:58:09', '2024-08-21 12:58:09'),
(163, 60, 17, '2024-08-21 12:58:09', '2024-08-21 12:58:09'),
(164, 60, 19, '2024-08-21 12:58:09', '2024-08-21 12:58:09'),
(165, 61, 4, '2024-08-21 13:32:01', '2024-08-21 13:32:01'),
(166, 61, 17, '2024-08-21 13:32:01', '2024-08-21 13:32:01'),
(167, 61, 19, '2024-08-21 13:32:01', '2024-08-21 13:32:01'),
(168, 62, 4, '2024-08-21 13:57:20', '2024-08-21 13:57:20'),
(169, 62, 8, '2024-08-21 13:57:20', '2024-08-21 13:57:20'),
(170, 62, 17, '2024-08-21 13:57:20', '2024-08-21 13:57:20'),
(171, 63, 2, '2024-08-21 14:37:33', '2024-08-21 14:37:33'),
(172, 63, 5, '2024-08-21 14:37:33', '2024-08-21 14:37:33'),
(173, 63, 27, '2024-08-21 14:37:33', '2024-08-21 14:37:33'),
(183, 68, 3, '2024-08-22 06:28:01', '2024-08-22 06:28:01'),
(185, 70, 4, '2024-08-22 07:37:52', '2024-08-22 07:37:52'),
(186, 70, 5, '2024-08-22 07:37:52', '2024-08-22 07:37:52'),
(187, 70, 17, '2024-08-22 07:37:52', '2024-08-22 07:37:52'),
(188, 71, 4, '2024-08-22 07:56:24', '2024-08-22 07:56:24'),
(189, 71, 5, '2024-08-22 07:56:24', '2024-08-22 07:56:24'),
(190, 72, 4, '2024-08-22 08:01:00', '2024-08-22 08:01:00'),
(191, 72, 17, '2024-08-22 08:01:00', '2024-08-22 08:01:00'),
(192, 72, 20, '2024-08-22 08:01:00', '2024-08-22 08:01:00'),
(193, 73, 2, '2024-08-22 08:09:44', '2024-08-22 08:09:44'),
(194, 73, 5, '2024-08-22 08:09:44', '2024-08-22 08:09:44'),
(195, 73, 16, '2024-08-22 08:09:44', '2024-08-22 08:09:44'),
(196, 74, 4, '2024-08-22 08:39:46', '2024-08-22 08:39:46'),
(197, 74, 5, '2024-08-22 08:39:46', '2024-08-22 08:39:46'),
(198, 74, 17, '2024-08-22 08:39:46', '2024-08-22 08:39:46'),
(199, 75, 4, '2024-08-22 09:59:36', '2024-08-22 09:59:36'),
(200, 75, 5, '2024-08-22 09:59:36', '2024-08-22 09:59:36'),
(201, 75, 17, '2024-08-22 09:59:36', '2024-08-22 09:59:36'),
(202, 76, 2, '2024-08-22 11:16:45', '2024-08-22 11:16:45'),
(203, 76, 4, '2024-08-22 11:16:45', '2024-08-22 11:16:45'),
(204, 76, 7, '2024-08-22 11:16:45', '2024-08-22 11:16:45'),
(205, 77, 4, '2024-08-22 11:27:18', '2024-08-22 11:27:18'),
(206, 77, 5, '2024-08-22 11:27:18', '2024-08-22 11:27:18'),
(207, 78, 2, '2024-08-22 11:32:26', '2024-08-22 11:32:26'),
(208, 78, 4, '2024-08-22 11:32:26', '2024-08-22 11:32:26'),
(209, 78, 17, '2024-08-22 11:32:26', '2024-08-22 11:32:26'),
(210, 79, 4, '2024-08-22 12:59:05', '2024-08-22 12:59:05'),
(211, 79, 17, '2024-08-22 12:59:05', '2024-08-22 12:59:05'),
(212, 79, 30, '2024-08-22 12:59:05', '2024-08-22 12:59:05'),
(213, 80, 4, '2024-08-22 13:12:34', '2024-08-22 13:12:34'),
(214, 80, 5, '2024-08-22 13:12:34', '2024-08-22 13:12:34'),
(215, 80, 8, '2024-08-22 13:12:34', '2024-08-22 13:12:34'),
(216, 81, 4, '2024-08-22 13:22:37', '2024-08-22 13:22:37'),
(217, 81, 5, '2024-08-22 13:22:37', '2024-08-22 13:22:37'),
(218, 81, 17, '2024-08-22 13:22:37', '2024-08-22 13:22:37'),
(219, 82, 4, '2024-08-22 15:25:48', '2024-08-22 15:25:48'),
(220, 82, 5, '2024-08-22 15:25:48', '2024-08-22 15:25:48'),
(221, 82, 36, '2024-08-22 15:25:48', '2024-08-22 15:25:48'),
(222, 83, 4, '2024-08-22 17:10:45', '2024-08-22 17:10:45'),
(223, 83, 6, '2024-08-22 17:10:45', '2024-08-22 17:10:45'),
(224, 83, 17, '2024-08-22 17:10:45', '2024-08-22 17:10:45'),
(225, 84, 4, '2024-08-25 12:46:51', '2024-08-25 12:46:51'),
(226, 84, 7, '2024-08-25 12:46:51', '2024-08-25 12:46:51'),
(227, 84, 16, '2024-08-25 12:46:51', '2024-08-25 12:46:51'),
(228, 85, 4, '2024-08-25 20:23:04', '2024-08-25 20:23:04'),
(229, 85, 16, '2024-08-25 20:23:04', '2024-08-25 20:23:04'),
(230, 85, 17, '2024-08-25 20:23:04', '2024-08-25 20:23:04'),
(231, 86, 4, '2024-08-26 11:03:09', '2024-08-26 11:03:09'),
(232, 86, 5, '2024-08-26 11:03:09', '2024-08-26 11:03:09'),
(233, 86, 36, '2024-08-26 11:03:09', '2024-08-26 11:03:09'),
(234, 87, 12, '2024-08-26 14:23:33', '2024-08-26 14:23:33');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Российская Федерация', NULL, NULL),
(2, 'Беларусь', '2024-08-07 10:06:51', '2024-08-07 10:06:51');

-- --------------------------------------------------------

--
-- Структура таблицы `db_logs`
--

CREATE TABLE `db_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `db_logs`
--

INSERT INTO `db_logs` (`id`, `user_id`, `text`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Удалён пользователь Илья Адреевич Софронов, роль blogger, телефон+79021223290, emaililya.sofron@mail.ru', '2024-08-21 06:08:44', '2024-08-21 06:08:44'),
(2, NULL, 'Удалён пользователь Алексей Андреев, роль blogger, телефон+79603701424, emaillehagagog2@mail.ru', '2024-08-21 21:55:35', '2024-08-21 21:55:35'),
(3, NULL, 'Удалён пользователь Юлия, роль blogger, телефон+79065065287, emaildmitrakova2019@bk.ru', '2024-08-22 05:52:28', '2024-08-22 05:52:28'),
(4, NULL, 'Удалён пользователь Владислав, роль seller, телефон+79539800017, emailpolhol.kkk@gmail.com', '2024-08-22 06:18:59', '2024-08-22 06:18:59'),
(5, NULL, 'Удалён пользователь Владислав, роль seller, телефон+79998880004, emailpolhol.kk@gmail.com', '2024-08-22 06:21:48', '2024-08-22 06:21:48'),
(6, NULL, 'Удалён пользователь Андреев Алексей, роль blogger, телефон+79603701424, emaillehagagog3@mail.ru', '2024-08-22 06:23:26', '2024-08-22 06:23:26'),
(7, NULL, 'Удалён пользователь Алексей, роль seller, телефон+79279824554, emailadswap.ru@ya.ru', '2024-08-22 06:24:37', '2024-08-22 06:24:37'),
(8, NULL, 'Удалён пользователь Алексей Тест, роль blogger, телефон+79603701424, emaillehagagog3@mail.ru', '2024-08-22 06:35:07', '2024-08-22 06:35:07'),
(9, NULL, 'Удалён пользователь Олег, роль blogger, телефон+79048437785, emailkinodelrussia@gmail.com', '2024-08-29 14:20:30', '2024-08-29 14:20:30'),
(10, NULL, 'Удалён пользователь Анастасия, роль blogger, телефон+79824781326, emailnastya666m@mail.ru', '2024-08-29 14:25:53', '2024-08-29 14:25:53'),
(11, NULL, 'Удалён пользователь Ксения, роль blogger, телефон+79127822321, emailkonekienko@gmail.com', '2024-08-30 16:33:52', '2024-08-30 16:33:52'),
(12, NULL, 'Удалён пользователь Надежда, роль blogger, телефон+79185569984, emailsimpat9jka@gmail.com', '2024-08-30 16:37:24', '2024-08-30 16:37:24'),
(13, NULL, 'Удалён пользователь Ирина, роль seller, телефон+79229514988, emailirina.ross9191@mail.ru', '2024-08-30 16:37:50', '2024-08-30 16:37:50');

-- --------------------------------------------------------

--
-- Структура таблицы `deep_links`
--

CREATE TABLE `deep_links` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `work_id` bigint UNSIGNED DEFAULT NULL,
  `destination` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `deep_links`
--

INSERT INTO `deep_links` (`id`, `user_id`, `work_id`, `destination`, `link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 5, 'https://www.ozon.ru/product/benzopila-tsepnaya-benzinovaya-gs-516-3-24-l-s-legkiy-zapusk-partner-for-garden-693083536/', 'QqeOwE4drC', '2024-08-19 05:55:49', '2024-08-19 05:55:49', NULL),
(2, 9, 7, 'https://www.wildberries.ru/catalog/81898966/detail.aspx', 'OJm43Ecb3S', '2024-08-19 09:57:04', '2024-08-19 09:57:04', NULL),
(4, 56, 67, 'https://www.wildberries.ru/catalog/231782161/detail.aspx?targetUrl=EX', 'DiF4OOeTNt', '2024-08-19 10:32:25', '2024-08-19 10:32:25', NULL),
(5, 32, 19, 'https://www.wildberries.ru/catalog/226494492/detail.aspx', 'Cr5XJjWkSF', '2024-08-19 10:35:10', '2024-08-19 10:35:10', NULL),
(7, 56, 85, 'https://www.wildberries.ru/catalog/226494492/detail.aspx', 'qfZgr36sor', '2024-08-19 16:17:55', '2024-08-19 16:17:55', NULL),
(8, 57, 94, 'https://www.wildberries.ru/catalog/215490154/detail.aspx', 'juLDQXRIqq', '2024-08-21 10:09:31', '2024-08-21 10:09:31', NULL),
(10, 46, 60, 'https://www.wildberries.ru/catalog/173430042/detail.aspx?targetUrl=EX', '2Dmma4Hp0O', '2024-08-21 12:32:04', '2024-08-21 12:32:04', NULL),
(12, 10, 56, 'https://www.ozon.ru/product/trimmer-kustorez-benzinovyy-dlya-travy-sadovyy-bt-430-2-9-l-s-shirina-skashivaniya-44-sm-pfg-176663692/', 'xkCbeYw5WM', '2024-08-22 06:03:34', '2024-08-22 06:03:34', NULL),
(13, 46, 54, 'https://www.wildberries.ru/catalog/79670033/detail.aspx', '9nQ4oYDXK1', '2024-08-22 12:46:02', '2024-08-22 12:46:02', NULL),
(14, 99, 540, 'https://www.wildberries.ru/catalog/215490154/detail.aspx', 'pxmOXrbO78', '2024-08-26 14:45:13', '2024-08-26 14:45:13', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `deep_link_stats`
--

CREATE TABLE `deep_link_stats` (
  `id` bigint UNSIGNED NOT NULL,
  `link_id` bigint UNSIGNED NOT NULL,
  `datatime` timestamp NULL DEFAULT NULL,
  `device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `federal_district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_bot` int DEFAULT NULL,
  `is_mobile` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `deep_link_stats`
--

INSERT INTO `deep_link_stats` (`id`, `link_id`, `datatime`, `device`, `operating_system`, `country`, `federal_district`, `region`, `city`, `referrer`, `is_bot`, `is_mobile`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '2024-08-19 09:57:00', 'smartphone', 'iOS', NULL, NULL, NULL, NULL, 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 09:57:35', '2024-08-19 09:57:35', NULL),
(2, 2, '2024-08-19 09:58:00', 'desktop', 'Mac', 'Россия', 'Приволжский', 'Ульяновская', 'Димитровград', 'https://lk.adswap.ru/profile', 0, 0, '2024-08-19 09:58:18', '2024-08-19 09:58:18', NULL),
(3, 4, '2024-08-19 10:32:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 10:32:39', '2024-08-19 10:32:39', NULL),
(4, 4, '2024-08-19 10:32:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 10:32:55', '2024-08-19 10:32:55', NULL),
(5, 4, '2024-08-19 10:33:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 10:33:13', '2024-08-19 10:33:13', NULL),
(6, 4, '2024-08-19 10:33:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', NULL, 0, 1, '2024-08-19 10:33:29', '2024-08-19 10:33:29', NULL),
(7, 4, '2024-08-19 10:41:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 10:41:31', '2024-08-19 10:41:31', NULL),
(8, 4, '2024-08-19 10:41:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 10:41:40', '2024-08-19 10:41:40', NULL),
(9, 7, '2024-08-19 16:18:00', 'smartphone', 'Android', 'Россия', 'Сибирский', 'Кемеровская область - Кузбасс', 'Кемерово', 'https://lk.adswap.ru/profile', 0, 1, '2024-08-19 16:18:00', '2024-08-19 16:18:00', NULL),
(10, 1, '2024-08-21 18:46:00', 'desktop', 'Windows', 'Россия', 'Центральный', 'Москва', 'Москва', 'https://lk.adswap.ru/profile', 0, 0, '2024-08-21 18:46:20', '2024-08-21 18:46:20', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `finish_stats`
--

CREATE TABLE `finish_stats` (
  `id` bigint UNSIGNED NOT NULL,
  `subs` bigint UNSIGNED NOT NULL,
  `views` bigint UNSIGNED NOT NULL,
  `reposts` bigint UNSIGNED NOT NULL,
  `likes` bigint UNSIGNED NOT NULL,
  `work_id` bigint UNSIGNED NOT NULL,
  `message_id` bigint UNSIGNED NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `work_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `work_id`, `user_id`, `message`, `viewed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 10, 'Здравствуйте! Большое спасибо за Ваш отклик. \r\nElectrolite - компания-производитель электро и бензо инструментов, садовой и строительной техники.   \r\nМы хотим предложить вам взаимовыгодное сотрудничество по бартеру.  Мы готовы отправить вам товар (на выбор). Он останется у Вас для дальнейшего использования.  А Вы снимете обзор на него на вашем Youtube-канале.   \r\n\r\nТз ютуб: https://docs.google.com/document/d/1_FoimkGjzd4kHXoq0dxiX_2SGKyWs7C2HY2OfZ0fc1c/edit\r\n\r\nотправляю вам ссылку на документ, в котором можно ознакомиться с товарами. \r\nhttps://docs.google.com/spreadsheets/d/1wRa_FiOit1hVJRW807DP5JdI4eGETqBjI9CNek8T0Ik/edit', '2024-08-12 16:16:00', '2024-08-12 16:16:21', '2024-08-12 16:16:25', NULL),
(2, 1, 10, 'Тз', '2024-08-12 16:19:00', '2024-08-12 16:19:18', '2024-08-12 16:19:20', NULL),
(3, 1, 20, 'Добрый день! Пришлите, пожалуйста, ссылки на наш емайл semyafia@gmail.com, они здесь не кликабельны.', '2024-08-12 16:21:00', '2024-08-12 16:21:14', '2024-08-12 16:21:18', NULL),
(4, 1, 10, 'спасибо, сейчас все отправлю)', '2024-08-12 16:21:00', '2024-08-12 16:21:44', '2024-08-12 16:21:49', NULL),
(5, 1, 20, 'Мы готовы сделать обзор на Бензопилу цепную бензиновую GS 516 3.24 л.с. лёгкий запуск Partner for Garden.', '2024-08-12 16:30:00', '2024-08-12 16:29:58', '2024-08-12 16:30:00', NULL),
(6, 1, 10, 'с Тз ознакомились, нет вопросов?', '2024-08-12 16:31:00', '2024-08-12 16:31:25', '2024-08-12 16:31:29', NULL),
(7, 1, 20, 'Ознакомились, вопросов нет, если будут мы сможем к Вам обратиться?', '2024-08-12 16:34:00', '2024-08-12 16:34:47', '2024-08-12 16:34:50', NULL),
(8, 1, 10, 'да, конечно', '2024-08-12 16:35:00', '2024-08-12 16:35:15', '2024-08-12 16:35:17', NULL),
(9, 1, 10, 'доставка будет осуществляться на пункт выдачи СДЭК .   \r\nукажите, пожалуйста:  \r\n1) ФИО получателя полностью  \r\n2) адрес ближайшего Сдэка(город; микрорайон/деревня/поселок; улица; дом;)  \r\n3)номер телефона', '2024-08-12 16:35:00', '2024-08-12 16:35:31', '2024-08-12 16:35:32', NULL),
(10, 1, 20, 'Клют Федор Оттович, Сдэк -- ул. Ленина, 14А, Бутурлиновка, Воронежская обл., 397500. Тел. +7 9601346583', '2024-08-12 16:39:00', '2024-08-12 16:39:13', '2024-08-12 16:39:16', NULL),
(11, 1, 10, 'здравствуйте. Отправлено СДЭК 10020522796', '2024-08-14 06:28:00', '2024-08-14 06:26:03', '2024-08-14 06:28:37', NULL),
(12, 1, 20, 'Добрый день! Спасибо, ждем.', '2024-08-14 06:29:00', '2024-08-14 06:29:24', '2024-08-14 06:29:30', NULL),
(13, 5, 30, 'Здравствуйте. Мы согласны сделать рекламу. Вы делаете маркировку?', '2024-08-16 08:37:00', '2024-08-15 17:56:35', '2024-08-16 08:37:18', NULL),
(14, 5, 1, 'Василий готов приступить к работе', '2024-08-15 17:56:00', '2024-08-15 17:56:38', '2024-08-15 17:56:40', NULL),
(15, 5, 10, 'здравствуйте. нет, пока работаем без маркировки. дело в том, что товары подходят под тематику канала и могут расцениваться как личная рекомендация', '2024-08-16 10:59:00', '2024-08-16 08:38:12', '2024-08-16 10:59:44', NULL),
(16, 5, 10, 'Тз ютуб: https://docs.google.com/document/d/1_FoimkGjzd4kHXoq0dxiX_2SGKyWs7C2HY2OfZ0fc1c/edit', '2024-08-16 10:59:00', '2024-08-16 08:38:53', '2024-08-16 10:59:44', NULL),
(17, 5, 10, 'Тз, если ссылка не кликабельна', '2024-08-16 10:59:00', '2024-08-16 08:40:33', '2024-08-16 10:59:44', NULL),
(18, 5, 30, 'Здравствуйте. Ссылка не открывается', '2024-08-16 11:05:00', '2024-08-16 11:01:38', '2024-08-16 11:05:15', NULL),
(19, 5, 10, 'напишите, пожалуйста, почту или мессенджер для связи', '2024-08-16 11:07:00', '2024-08-16 11:06:44', '2024-08-16 11:07:05', NULL),
(20, 5, 30, 'Vasilii100152@gmail.com', '2024-08-16 11:07:00', '2024-08-16 11:07:28', '2024-08-16 11:07:38', NULL),
(21, 5, 30, 'https://vk.com/id221108547', '2024-08-16 11:08:00', '2024-08-16 11:08:11', '2024-08-16 11:08:16', NULL),
(22, 5, 30, 'Ватсап 89189524920 Василий', '2024-08-19 05:54:00', '2024-08-16 11:31:19', '2024-08-19 05:54:41', NULL),
(23, 5, 1, 'Арина готов приступить к работе', '2024-08-19 05:55:00', '2024-08-19 05:55:49', '2024-08-19 05:55:49', NULL),
(24, 5, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/QqeOwE4drC\">https://lk.adswap.ru/lnk/QqeOwE4drC</a>', '2024-08-19 05:55:00', '2024-08-19 05:55:49', '2024-08-19 05:55:54', NULL),
(25, 56, 10, 'здравствуйте. благодарю за отклик! продублируйте, пожалуйста, ссылку на свои соц сети', '2024-08-19 09:34:00', '2024-08-19 05:59:45', '2024-08-19 09:34:37', NULL),
(27, 1, 1, 'Арина готов приступить к работе', '2024-08-19 06:00:00', '2024-08-19 06:00:02', '2024-08-19 06:00:06', NULL),
(32, 56, 46, 'Здравствуйте', '2024-08-19 12:51:00', '2024-08-19 09:34:46', '2024-08-19 12:51:57', NULL),
(33, 56, 46, '<a target=\"_blank\" href=\"https://instagram.com/bloger_ksulife?igshid=Yzg5MTU1MDY=\">https://instagram.com/bloger_ksulife?igshid=Yzg5MTU1MDY=</a>', '2024-08-19 12:51:00', '2024-08-19 09:34:59', '2024-08-19 12:51:57', NULL),
(34, 56, 1, 'Ксения готов приступить к работе', '2024-08-19 09:36:00', '2024-08-19 09:36:48', '2024-08-19 09:36:52', NULL),
(35, 7, 1, 'Вадим Стукалов готов приступить к работе', '2024-08-19 09:49:00', '2024-08-19 09:49:41', '2024-08-19 09:49:45', NULL),
(36, 7, 9, 'Здравствуйте, пришлите, пожалуйста, ссылку на ваш аккант)', '2024-08-19 09:49:00', '2024-08-19 09:49:56', '2024-08-19 09:49:56', NULL),
(37, 7, 32, 'Здравствуйте. Инстаграм Instagram.com/stukalov23', '2024-08-19 09:50:00', '2024-08-19 09:50:35', '2024-08-19 09:50:36', NULL),
(38, 7, 32, 'Готовы снять и показать в рилсе, сторис', '2024-08-19 09:50:00', '2024-08-19 09:50:50', '2024-08-19 09:50:51', NULL),
(40, 7, 9, 'Отлично)\r\nУсловия:', '2024-08-19 09:53:00', '2024-08-19 09:53:28', '2024-08-19 09:53:30', NULL),
(41, 7, 9, 'Бартер, рилс- это главное)', '2024-08-19 09:53:00', '2024-08-19 09:53:45', '2024-08-19 09:53:47', NULL),
(42, 7, 32, 'С рилсом нет проблем. Продублируем в ютуб шортс', '2024-08-19 09:54:00', '2024-08-19 09:54:05', '2024-08-19 09:54:06', NULL),
(47, 7, 9, 'Прикрепила ТЗ. Пр\r\nоверьте, открывается файл, пожалуйста?', '2024-08-19 09:55:00', '2024-08-19 09:55:55', '2024-08-19 09:55:58', NULL),
(48, 7, 32, 'Нет, не открывается. А мы можем перейти в мессенджер? Или здесь скриншот', '2024-08-19 09:56:00', '2024-08-19 09:56:49', '2024-08-19 09:56:50', NULL),
(49, 7, 1, 'Анастасия готов приступить к работе', '2024-08-19 09:57:00', '2024-08-19 09:57:04', '2024-08-19 09:57:05', NULL),
(50, 7, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/OJm43Ecb3S\">https://lk.adswap.ru/lnk/OJm43Ecb3S</a>', '2024-08-19 09:57:00', '2024-08-19 09:57:04', '2024-08-19 09:57:05', NULL),
(51, 7, 9, 'Сайт подтвердит наше сотрудничество и должно заработать)', '2024-08-19 09:58:00', '2024-08-19 09:58:52', '2024-08-19 09:58:54', NULL),
(55, 54, 9, 'Здравствуйте, пришлите, пожалуйста, ссылку на ваш аккаунт', '2024-08-19 12:23:00', '2024-08-19 10:10:22', '2024-08-19 12:23:42', NULL),
(56, 67, 9, 'Здравствуйте, пришлите, пожалуйста, ссылку на ваш аккаунт', '2024-08-19 10:16:00', '2024-08-19 10:11:16', '2024-08-19 10:16:06', NULL),
(59, 2, 9, 'Здравствуйте, пришлите, пожалуйста, ссылку на ваш канал', '2024-08-19 10:45:00', '2024-08-19 10:15:18', '2024-08-19 10:45:44', NULL),
(61, 67, 56, 'Здравствуйте 👋🏻', '2024-08-19 10:30:00', '2024-08-19 10:17:38', '2024-08-19 10:30:08', NULL),
(62, 67, 56, '<a target=\"_blank\" href=\"https://www.instagram.com/krisgepner?igsh=MWlkZHRq\">https://www.instagram.com/krisgepner?igsh=MWlkZHRq</a>\r\nMWFhZHQxdw', '2024-08-19 10:30:00', '2024-08-19 10:17:43', '2024-08-19 10:30:08', NULL),
(71, 67, 56, 'Мой блог подходит?) Уточняю на всякий случай, это мой первый заказ на этой платформе🙏🏻', '2024-08-19 10:30:00', '2024-08-19 10:25:27', '2024-08-19 10:30:08', NULL),
(74, 7, 32, 'Вроде как статистику уже дает загрузить. Какие мои действия сейчас?', '2024-08-19 10:29:00', '2024-08-19 10:28:07', '2024-08-19 10:29:32', NULL),
(76, 7, 9, 'Прислать статистику, после отправки статистики и обработки ее на сайте\r\n, я смогу прислать вам ТЗ', '2024-08-19 10:33:00', '2024-08-19 10:30:02', '2024-08-19 10:33:31', NULL),
(78, 67, 9, 'На 1 товар посотрудничать можем) по данному проекту', '2024-08-19 10:32:00', '2024-08-19 10:31:58', '2024-08-19 10:32:05', NULL),
(79, 67, 1, 'Анастасия готов приступить к работе', '2024-08-19 10:32:00', '2024-08-19 10:32:04', '2024-08-19 10:32:05', NULL),
(80, 67, 1, 'Кристина готов приступить к работе', '2024-08-19 10:32:00', '2024-08-19 10:32:25', '2024-08-19 10:32:25', NULL),
(81, 67, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/DiF4OOeTNt\">https://lk.adswap.ru/lnk/DiF4OOeTNt</a>', '2024-08-19 10:32:00', '2024-08-19 10:32:25', '2024-08-19 10:32:25', NULL),
(84, 19, 9, 'По футболке тоже можем посотрудничать)', '2024-08-19 10:34:00', '2024-08-19 10:33:35', '2024-08-19 10:34:36', NULL),
(85, 19, 1, 'Анастасия готов приступить к работе', '2024-08-19 10:33:00', '2024-08-19 10:33:41', '2024-08-19 10:33:45', NULL),
(87, 94, 9, 'Этот?', '2024-08-19 10:43:00', '2024-08-19 10:35:07', '2024-08-19 10:43:21', NULL),
(88, 19, 32, 'Да, отлично!', '2024-08-19 10:35:00', '2024-08-19 10:35:09', '2024-08-19 10:35:21', NULL),
(89, 19, 1, 'Вадим Стукалов готов приступить к работе', '2024-08-19 10:35:00', '2024-08-19 10:35:10', '2024-08-19 10:35:14', NULL),
(90, 19, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/Cr5XJjWkSF\">https://lk.adswap.ru/lnk/Cr5XJjWkSF</a>', '2024-08-19 10:35:00', '2024-08-19 10:35:10', '2024-08-19 10:35:14', NULL),
(92, 67, 56, 'Ссылка не открывается', '2024-08-19 10:42:00', '2024-08-19 10:41:53', '2024-08-19 10:42:00', NULL),
(93, 67, 9, 'Какая?', '2024-08-19 10:42:00', '2024-08-19 10:42:11', '2024-08-19 10:42:14', NULL),
(96, 94, 57, 'Да, он', '2024-08-19 10:44:00', '2024-08-19 10:44:45', '2024-08-19 10:44:52', NULL),
(97, 2, 26, 'Добрый день', '2024-08-19 10:46:00', '2024-08-19 10:46:34', '2024-08-19 10:46:45', NULL),
(98, 2, 26, 'да, конечно', '2024-08-19 10:46:00', '2024-08-19 10:46:37', '2024-08-19 10:46:45', NULL),
(99, 2, 26, '<a target=\"_blank\" href=\"https://www.youtube.com/@murpainter\">https://www.youtube.com/@murpainter</a>', '2024-08-19 10:46:00', '2024-08-19 10:46:39', '2024-08-19 10:46:45', NULL),
(100, 94, 9, 'Хорошо, давайте немного подождем, сервис новый, разработчики сейчас вносят правки ,чтобы  я могла вам прислать ТЗ. Вдруг оно вас не устроит) Доработают этот момент и я вам отпишусь, пришлю ТЗ, и внесу вас в список на отправку товаров, хорошо?) Дума\r\nю это произойдет в ближайшее время', '2024-08-19 10:46:00', '2024-08-19 10:46:39', '2024-08-19 10:46:40', NULL),
(102, 67, 9, 'Хорошо, давайте немного подождем, сервис новый, разработчики сейчас вносят правки ,чтобы я могла вам прислать ТЗ. Вдруг оно вас не устроит) Доработают этот момент и я вам отпишусь, пришлю ТЗ, и внесу вас в список на отправку товаров, хорошо?) Дума ю это произойдет в ближайшее время', '2024-08-19 10:56:00', '2024-08-19 10:47:36', '2024-08-19 10:56:11', NULL),
(103, 19, 9, 'Хорошо, давайте немного подождем, сервис новый, разработчики сейчас вносят правки ,чтобы я могла вам прислать ТЗ. Вдруг оно вас не устроит) Доработают этот момент и я вам отпишусь, пришлю ТЗ, и внесу вас в список на отправку товаров, хорошо?) Дума ю это произойдет в ближайшее время. И по мангалу и по футболке', '2024-08-19 12:43:00', '2024-08-19 10:47:49', '2024-08-19 12:43:06', NULL),
(105, 85, 1, 'Анастасия готов приступить к работе', '2024-08-19 10:48:00', '2024-08-19 10:47:58', '2024-08-19 10:48:01', NULL),
(106, 67, 9, 'И по футболке и по мебели детской', '2024-08-19 10:56:00', '2024-08-19 10:48:18', '2024-08-19 10:56:11', NULL),
(107, 2, 9, 'Хорошо) Согласны', '2024-08-19 11:06:00', '2024-08-19 10:49:35', '2024-08-19 11:06:21', NULL),
(108, 2, 1, 'Анастасия готов приступить к работе', '2024-08-19 10:49:00', '2024-08-19 10:49:36', '2024-08-19 10:49:40', NULL),
(109, 2, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/QqeOwE4drC\">https://lk.adswap.ru/lnk/QqeOwE4drC</a>', '2024-08-19 10:49:00', '2024-08-19 10:49:44', '2024-08-19 10:49:45', NULL),
(110, 94, 57, 'Да, хорошо, без проблем)', '2024-08-19 10:59:00', '2024-08-19 10:50:07', '2024-08-19 10:59:35', NULL),
(133, 54, 46, 'Здравствуйте', '2024-08-19 12:31:00', '2024-08-19 12:24:00', '2024-08-19 12:31:16', NULL),
(134, 54, 46, '<a target=\"_blank\" href=\"https://instagram.com/bloger_ksulife?igshid=Yzg5MTU1MDY=\">https://instagram.com/bloger_ksulife?igshid=Yzg5MTU1MDY=</a>', '2024-08-19 12:31:00', '2024-08-19 12:24:05', '2024-08-19 12:31:16', NULL),
(135, 54, 9, 'Мы работали с вами)', '2024-08-19 12:34:00', '2024-08-19 12:31:45', '2024-08-19 12:34:27', NULL),
(136, 7, 9, '<a target=\"_blank\" href=\"https://docs.google.com/document/d/1-8Qg7uT4_rTtB95P7Wo0GzfPyj4cRJB4RyHasEtULjE/edit\">https://docs.google.com/document/d/1-8Qg7uT4_rTtB95P7Wo0GzfPyj4cRJB4RyHasEtULjE/edit</a>', '2024-08-19 12:43:00', '2024-08-19 12:35:31', '2024-08-19 12:43:19', NULL),
(137, 54, 46, 'А больше нельзя? Мы работали 2 года назад наверное', '2024-08-19 12:36:00', '2024-08-19 12:35:33', '2024-08-19 12:36:11', NULL),
(138, 7, 9, 'Проверьте, пожалуйста)', '2024-08-19 12:43:00', '2024-08-19 12:35:38', '2024-08-19 12:43:19', NULL),
(141, 54, 9, 'А нет) Это просто помним вас) Можно конечно', '2024-08-19 12:51:00', '2024-08-19 12:36:28', '2024-08-19 12:51:15', NULL),
(142, 54, 9, 'ТЗ то же, рилс\r\n, данные для отправки прежние?', '2024-08-19 12:51:00', '2024-08-19 12:36:44', '2024-08-19 12:51:15', NULL),
(143, 54, 9, '<a target=\"_blank\" href=\"https://docs.google.com/document/d/1-8Qg7uT4_rTtB95P7Wo0GzfPyj4cRJB4RyHasEtULjE/edit\">https://docs.google.com/document/d/1-8Qg7uT4_rTtB95P7Wo0GzfPyj4cRJB4RyHasEtULjE/edit</a>', '2024-08-19 12:51:00', '2024-08-19 12:36:48', '2024-08-19 12:51:15', NULL),
(144, 7, 9, 'Статистику пока не присылайтп, проект закроется. Он нужен в конце, после сотрудничества', '2024-08-19 12:43:00', '2024-08-19 12:37:18', '2024-08-19 12:43:19', NULL),
(147, 67, 9, '<a target=\"_blank\" href=\"https://docs.google.com/document/d/1bPfLAWBaTxrpmH9c1IITa0TdsqAVlR7xQ2UOvNIfUDE/edit\">https://docs.google.com/document/d/1bPfLAWBaTxrpmH9c1IITa0TdsqAVlR7xQ2UOvNIfUDE/edit</a>', '2024-08-19 16:18:00', '2024-08-19 12:37:54', '2024-08-19 16:18:44', NULL),
(148, 2, 9, 'Анастасия, вернули проект) Лучше здесь общаться :)', '2024-08-19 13:28:00', '2024-08-19 12:38:15', '2024-08-19 13:28:13', NULL),
(149, 2, 9, 'Поставила вас в список на отправку, как отправим, пришлем номер отслеживания', '2024-08-19 13:28:00', '2024-08-19 12:38:30', '2024-08-19 13:28:13', NULL),
(150, 94, 9, '<a target=\"_blank\" href=\"https://docs.google.com/document/d/1bPfLAWBaTxrpmH9c1IITa0TdsqAVlR7xQ2UOvNIfUDE/edit\">https://docs.google.com/document/d/1bPfLAWBaTxrpmH9c1IITa0TdsqAVlR7xQ2UOvNIfUDE/edit</a>', '2024-08-20 10:16:00', '2024-08-19 12:38:37', '2024-08-20 10:16:48', NULL),
(151, 1, 10, 'здравствуйте. отправляю вам ссылку, которую нужно оставить в описании: <a target=\"_blank\" href=\"https://partnerforgarden.mobz.click/semyafia\">https://partnerforgarden.mobz.click/semyafia</a>', '2024-08-19 12:56:00', '2024-08-19 12:42:57', '2024-08-19 12:56:04', NULL),
(152, 1, 10, 'дублирую Тз: <a target=\"_blank\" href=\"https://docs.google.com/document/d/1_FoimkGjzd4kHXoq0dxiX_2SGKyWs7C2HY2OfZ0fc1c/edit\">https://docs.google.com/document/d/1_FoimkGjzd4kHXoq0dxiX_2SGKyWs7C2HY2OfZ0fc1c/edit</a>', '2024-08-19 12:56:00', '2024-08-19 12:43:25', '2024-08-19 12:56:04', NULL),
(154, 54, 46, 'А я уже подумала не хотите 😄🥱', '2024-08-19 18:34:00', '2024-08-19 12:51:46', '2024-08-19 18:34:25', NULL),
(156, 54, 46, 'Данные другие, отправка чем?', '2024-08-19 18:34:00', '2024-08-19 12:52:01', '2024-08-19 18:34:25', NULL),
(157, 56, 10, 'Electrolite - компания-производитель электро и бензо инструментов, садовой и строительной техники.   \r\nМы хотим предложить вам взаимовыгодное сотрудничество по бартеру.  Мы готовы отправить вам товар (на выбор). Он останется у Вас для дальнейшего использования.  А Вы снимете обзор на него на вашем Youtube-канале.   \r\n\r\n\r\n\r\nТз инст: <a target=\"_blank\" href=\"https://docs.google.com/document/d/1aEDf7xvFTMR6HICLhYR0c1ed5UWqRWkBvkLg3WYaccA/edit\">https://docs.google.com/document/d/1aEDf7xvFTMR6HICLhYR0c1ed5UWqRWkBvkLg3WYaccA/edit</a>', '2024-08-19 12:58:00', '2024-08-19 12:52:13', '2024-08-19 12:58:03', NULL),
(158, 54, 46, 'Напишу другой адресс', '2024-08-19 18:34:00', '2024-08-19 12:52:16', '2024-08-19 18:34:25', NULL),
(159, 56, 10, 'если по Тз нет вопросов: доставка будет осуществляться на пункт выдачи СДЭК .   \r\nукажите, пожалуйста:  \r\n1) ФИО получателя полностью  \r\n2) адрес ближайшего Сдэка(город; микрорайон/деревня/поселок; улица; дом;)  \r\n3) \r\nномер телефона', '2024-08-19 12:58:00', '2024-08-19 12:53:26', '2024-08-19 12:58:03', NULL),
(166, 1, 20, 'Добрый день! Спасибо.', '2024-08-19 12:57:00', '2024-08-19 12:57:22', '2024-08-19 12:57:30', NULL),
(167, 1, 10, 'предварительно отправьте на согласование, пожалуйста', '2024-08-19 12:58:00', '2024-08-19 12:58:05', '2024-08-19 12:58:08', NULL),
(169, 56, 46, 'Здравствуйте, спасибо', '2024-08-19 12:59:00', '2024-08-19 12:59:13', '2024-08-19 12:59:24', NULL),
(171, 56, 46, 'Мельник Ксения Юрьевна', '2024-08-19 12:59:00', '2024-08-19 12:59:29', '2024-08-19 12:59:29', NULL),
(173, 56, 46, 'Ростовская область, город Азов, ул Московская 91', '2024-08-20 06:29:00', '2024-08-19 12:59:57', '2024-08-20 06:29:38', NULL),
(175, 56, 46, '89518261680', '2024-08-20 06:29:00', '2024-08-19 13:00:08', '2024-08-20 06:29:38', NULL),
(177, 1, 20, 'Конечно.', '2024-08-19 13:00:00', '2024-08-19 13:00:37', '2024-08-19 13:00:40', NULL),
(181, 2, 26, 'хорошо, благодарю!', '2024-08-19 18:36:00', '2024-08-19 13:28:30', '2024-08-19 18:36:07', NULL),
(182, 85, 1, 'Кристина готов приступить к работе', '2024-08-19 16:17:00', '2024-08-19 16:17:55', '2024-08-19 16:17:56', NULL),
(183, 85, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/qfZgr36sor\">https://lk.adswap.ru/lnk/qfZgr36sor</a>', '2024-08-19 16:17:00', '2024-08-19 16:17:55', '2024-08-19 16:17:56', NULL),
(184, 67, 56, 'С ТЗ ознакомилась.  Всё понятно, вопросов нет✅️', '2024-08-19 18:36:00', '2024-08-19 16:20:45', '2024-08-19 18:36:13', NULL),
(186, 54, 9, 'Также почтой России. Данные нужны: ФИО, индекс, адрес и номер телефона', '2024-08-19 19:19:00', '2024-08-19 18:35:00', '2024-08-19 19:19:46', NULL),
(188, 67, 9, 'Для отправки необходимы следующие данные: ФИО, индекс, адрес и номер телефона (+ подъезд и этаж). Отправка ТК, какой точно - сказать не могу', '2024-08-20 09:46:00', '2024-08-19 18:37:26', '2024-08-20 09:46:19', NULL),
(189, 85, 9, 'По футболке: С вашего согласия, менеджер Зуфы выберет из вашего профиля Инстаграм несколько фото, которые будут лучше выглядеть на футболке при раскраске, пришлю их вам, вы согласуете какое-то одно фото.\r\nТакже нужны  будут размер и цвет футболки - белый или черный) \r\nПосле раскраски футболки, ребята отправляют ее вам) нужен адрес доставки) ФИО, индекс, адрес, номер телефона', '2024-08-20 09:48:00', '2024-08-19 18:42:57', '2024-08-20 09:48:17', NULL),
(190, 19, 9, 'По футболке: С вашего согласия, менеджер Зуфы выберет из вашего профиля Инстаграм несколько фото, которые будут лучше выглядеть на футболке при раскраске, пришлю их вам, вы согласуете какое-то одно фото.\r\nТакже нужны  будут размер и цвет футболки - белый или черный) \r\nПосле раскраски футболки, ребята отправляют ее вам) нужен адрес доставки) ФИО, индекс, адрес, номер телефона', '2024-08-19 18:43:00', '2024-08-19 18:43:21', '2024-08-19 18:43:39', NULL),
(191, 19, 32, 'Отправка почтой РФ?', '2024-08-20 08:46:00', '2024-08-19 18:43:59', '2024-08-20 08:46:01', NULL),
(192, 19, 32, 'Конечно. Буду очень рад! Размер одежды М', '2024-08-20 08:46:00', '2024-08-19 18:44:10', '2024-08-20 08:46:01', NULL),
(194, 54, 46, 'Мельник Ксения Юрьевна', '2024-08-20 08:48:00', '2024-08-19 19:20:04', '2024-08-20 08:48:19', NULL),
(195, 54, 46, 'Мельник Ксения Юрьевна', '2024-08-20 08:48:00', '2024-08-19 19:20:05', '2024-08-20 08:48:19', NULL),
(196, 54, 46, 'Ростовская область, Азовский район, село Пешково 346760 пер Октябрьский 22а, 89518261680', '2024-08-20 08:48:00', '2024-08-19 19:22:30', '2024-08-20 08:48:19', NULL),
(204, 19, 9, 'Отправка будет ТК, скорей всего СДЭК', '2024-08-20 08:52:00', '2024-08-20 08:46:21', '2024-08-20 08:52:09', NULL),
(205, 7, 9, 'Футболка черная или белая?', '2024-08-20 08:52:00', '2024-08-20 08:47:51', '2024-08-20 08:52:58', NULL),
(206, 7, 9, 'Не туда написала', '2024-08-20 08:52:00', '2024-08-20 08:48:02', '2024-08-20 08:52:58', NULL),
(207, 19, 9, 'Футболка черная или белая?', '2024-08-20 08:52:00', '2024-08-20 08:48:16', '2024-08-20 08:52:09', NULL),
(208, 19, 9, 'М это 46?)', '2024-08-20 08:52:00', '2024-08-20 08:48:55', '2024-08-20 08:52:09', NULL),
(209, 19, 32, 'Давайте черную, м 46, верно)', '2024-08-20 08:52:00', '2024-08-20 08:52:26', '2024-08-20 08:52:30', NULL),
(210, 19, 32, 'Сдэк - стукалов Вадим Алексеевич, 89990039366, пункт выдачи/ Воскресенск (ул. Кагана, 3)', '2024-08-20 08:52:00', '2024-08-20 08:52:55', '2024-08-20 08:52:55', NULL),
(211, 7, 9, 'По мангалу тоже если согласны, то данные нужны уже домашние. Юникит отправляем почтой России', '2024-08-20 08:53:00', '2024-08-20 08:53:39', '2024-08-20 08:53:57', NULL),
(212, 7, 32, 'Город Воскресенск, ДНТ «Вишневый сад», ул. Каштановая, 27.', '2024-08-21 09:00:00', '2024-08-20 08:54:34', '2024-08-21 09:00:28', NULL),
(213, 7, 32, 'Заказать пропуск в день доставки 89990039366', '2024-08-21 09:00:00', '2024-08-20 08:54:54', '2024-08-21 09:00:28', NULL),
(214, 67, 56, 'Гепнер Кристина Александровна', '2024-08-21 09:04:00', '2024-08-20 09:46:45', '2024-08-21 09:04:28', NULL),
(215, 67, 56, '662156 Красноярский край г.Ачинск ул . 3й мкр Привокзального р-на д. 1 кв.31 подъезд 3, этаж 2', '2024-08-21 09:04:00', '2024-08-20 09:48:03', '2024-08-21 09:04:28', NULL),
(216, 85, 56, 'Гепнер Кристина Александровна.  Рр 54 , цвет чёрный. Адрес: индекс 662156 Красноярский край, г. Ачинск,  ул. 3й мкр Привокзального р-на д.1 кв. 31. Этаж 2 , подъезд третий. Телефон +79133053800', '2024-08-21 09:04:00', '2024-08-20 09:50:32', '2024-08-21 09:04:46', NULL),
(217, 67, 56, '+79133053800', '2024-08-21 09:04:00', '2024-08-20 09:50:56', '2024-08-21 09:04:28', NULL),
(218, 94, 57, 'Все понятно) Ничего сложного, могу взять на рекламу!)', '2024-08-21 09:01:00', '2024-08-20 10:18:34', '2024-08-21 09:01:15', NULL),
(219, 94, 57, 'со стульчиком и столом - аналогично', '2024-08-21 09:01:00', '2024-08-20 10:18:44', '2024-08-21 09:01:15', NULL),
(220, 7, 32, 'Или нужен адрес ближайшего почты РФ?', '2024-08-21 09:00:00', '2024-08-20 14:27:05', '2024-08-21 09:00:28', NULL),
(221, 19, 9, 'Здравствуйте, выбрали это фото', '2024-08-21 09:09:00', '2024-08-21 08:54:02', '2024-08-21 09:09:39', NULL),
(222, 19, 9, 'Не пришло фото?', '2024-08-21 09:09:00', '2024-08-21 08:58:20', '2024-08-21 09:09:39', NULL),
(223, 7, 9, 'У вас закрытый город? вообще доставка курьером, но можем отправить до востребования, и тогда вам нужно будет самостоятел\r\nьно забрать', '2024-08-21 09:09:00', '2024-08-21 09:01:11', '2024-08-21 09:09:53', NULL),
(224, 94, 9, 'Для отправки нам нужны данные: ФИО, индекс, адрес и номер телефона. Также нужен подъезд и этаж. \r\nОтправка скорей всего ТК. Адрес домашний. После отправки пришлем информацию', '2024-08-21 09:04:00', '2024-08-21 09:04:11', '2024-08-21 09:04:31', NULL),
(225, 94, 1, 'Анастасия готов приступить к работе', '2024-08-21 09:04:00', '2024-08-21 09:04:20', '2024-08-21 09:04:21', NULL),
(226, 67, 9, 'После отправки пришлем информацию))', '2024-08-21 09:10:00', '2024-08-21 09:04:44', '2024-08-21 09:10:49', NULL),
(227, 19, 32, 'Супер', '2024-08-21 09:17:00', '2024-08-21 09:09:48', '2024-08-21 09:17:23', NULL),
(228, 94, 57, 'Дьяковская Алёна Дмитриевна', '2024-08-21 10:01:00', '2024-08-21 09:10:12', '2024-08-21 10:01:13', NULL),
(229, 7, 32, 'Нет, въезд в посёлок через охрану кпп', '2024-08-21 10:25:00', '2024-08-21 09:10:15', '2024-08-21 10:25:34', NULL),
(230, 7, 32, 'Частный дом', '2024-08-21 10:25:00', '2024-08-21 09:10:20', '2024-08-21 10:25:34', NULL),
(231, 94, 57, 'Крым, г. Севастополь, с. Орлиное, ул. Переселенческая, 32', '2024-08-21 10:01:00', '2024-08-21 09:10:38', '2024-08-21 10:01:13', NULL),
(232, 94, 57, 'частный дом', '2024-08-21 10:01:00', '2024-08-21 09:10:42', '2024-08-21 10:01:13', NULL),
(233, 94, 57, '79182270196', '2024-08-21 10:01:00', '2024-08-21 09:10:58', '2024-08-21 10:01:13', NULL),
(234, 67, 56, 'Хорошо,  жду🩷', '2024-08-21 09:11:00', '2024-08-21 09:11:00', '2024-08-21 09:11:02', NULL),
(235, 94, 57, 'Если Тк не удобно, я могу через вб забрать (можете со своего кабинета на мойц адрес отправить, или я могу самостоятельно заказать) Вб доставка намного быстрее, чем тот же Сдэк сюда)', '2024-08-21 10:01:00', '2024-08-21 09:11:40', '2024-08-21 10:01:13', NULL),
(236, 85, 9, 'Размер футболки (42,44 и тд)\r\n и цвет - черный или белый?', '2024-08-21 10:14:00', '2024-08-21 09:17:16', '2024-08-21 10:14:28', NULL),
(237, 19, 9, 'Как отправят, пришлю трек отслеживание)', '2024-08-21 09:17:00', '2024-08-21 09:17:35', '2024-08-21 09:17:45', NULL),
(238, 19, 32, 'Спасибо', '2024-08-21 09:17:00', '2024-08-21 09:17:49', '2024-08-21 09:17:51', NULL),
(239, 85, 9, 'Увидела) спасибо. Зуфа выберут фото, пришлю сюда', '2024-08-21 10:14:00', '2024-08-21 09:21:27', '2024-08-21 10:14:28', NULL),
(240, 94, 9, 'наоборот, им удобнее ТК) к сожалению, мы не влияем на способ доставки(( И еще по каждому товару свой диалог, сейчас во втором напишу вам)', '2024-08-21 10:02:00', '2024-08-21 10:02:29', '2024-08-21 10:02:31', NULL),
(242, 94, 57, 'Окей)', '2024-08-21 10:06:00', '2024-08-21 10:06:28', '2024-08-21 10:06:32', NULL),
(243, 94, 9, 'Примите, пожалуйста, заявку на работу \r\nпо проекту)', '2024-08-21 10:09:00', '2024-08-21 10:08:06', '2024-08-21 10:09:12', NULL),
(245, 94, 1, 'Алёна готов приступить к работе', '2024-08-21 10:09:00', '2024-08-21 10:09:31', '2024-08-21 10:09:34', NULL),
(246, 94, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/juLDQXRIqq\">https://lk.adswap.ru/lnk/juLDQXRIqq</a>', '2024-08-21 10:09:00', '2024-08-21 10:09:31', '2024-08-21 10:09:34', NULL),
(249, 94, 57, 'Так, вроде подтвердила)', '2024-08-21 10:11:00', '2024-08-21 10:10:39', '2024-08-21 10:11:03', NULL),
(250, 94, 9, 'да, все)', '2024-08-21 10:23:00', '2024-08-21 10:22:51', '2024-08-21 10:23:31', NULL),
(252, 7, 9, 'Как вам лучше? Давайте так, если вы сами заберете, то присылайте адрес почты, если курьером, то домашний адрес. Ждем)', '2024-08-21 10:26:00', '2024-08-21 10:26:24', '2024-08-21 10:26:54', NULL),
(253, 7, 32, 'Давайте лучше на почту 😅 Так будет надежнее', '2024-08-21 10:29:00', '2024-08-21 10:27:11', '2024-08-21 10:29:25', NULL),
(254, 7, 32, 'Получатель: стукалов Вадим Алексеевич - 89990039366', '2024-08-21 10:29:00', '2024-08-21 10:27:23', '2024-08-21 10:29:25', NULL),
(258, 7, 32, 'Отделение почтовой связи Воскресенск 140207', '2024-08-21 10:31:00', '2024-08-21 10:31:10', '2024-08-21 10:31:15', NULL),
(259, 7, 32, 'Отделение почтовой связи Воскресенск 140207', '2024-08-21 10:31:00', '2024-08-21 10:31:12', '2024-08-21 10:31:15', NULL),
(262, 7, 32, 'Ул Зелинского 3, Воскресенск', '2024-08-21 10:31:00', '2024-08-21 10:31:45', '2024-08-21 10:31:46', NULL),
(263, 7, 9, 'Отлично) записала. Напишу тоже как отправят мангал)', '2024-08-21 10:34:00', '2024-08-21 10:32:11', '2024-08-21 10:34:37', NULL),
(265, 54, 9, 'Хорошо, внесла вас в очередь на отправку. Как отправят, пришлю номер отслеживания', '2024-08-21 12:34:00', '2024-08-21 10:39:46', '2024-08-21 12:34:14', NULL),
(268, 7, 32, 'Спасибо!!!', '2024-08-21 12:28:00', '2024-08-21 10:56:54', '2024-08-21 12:28:52', NULL),
(269, 60, 9, 'Форма бортиков какая?)', '2024-08-21 12:30:00', '2024-08-21 12:30:07', '2024-08-21 12:30:21', NULL),
(270, 60, 1, 'Анастасия готов приступить к работе', '2024-08-21 12:30:00', '2024-08-21 12:30:09', '2024-08-21 12:30:12', NULL),
(271, 60, 1, 'Ксения готов приступить к работе', '2024-08-21 12:32:00', '2024-08-21 12:32:04', '2024-08-21 12:32:06', NULL),
(272, 60, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/2Dmma4Hp0O\">https://lk.adswap.ru/lnk/2Dmma4Hp0O</a>', '2024-08-21 12:32:00', '2024-08-21 12:32:04', '2024-08-21 12:32:06', NULL),
(273, 60, 46, 'Эти бортикии)', '2024-08-21 12:34:00', '2024-08-21 12:34:03', '2024-08-21 12:34:27', NULL),
(274, 54, 46, 'Спасибо большое))', '2024-08-21 12:34:00', '2024-08-21 12:34:27', '2024-08-21 12:34:45', NULL),
(275, 60, 9, 'Поняла. Данные эти? Ростовская область, Азовский район, село Пешково 346760 пер Октябрьский 22а, 89518261680', '2024-08-21 12:35:00', '2024-08-21 12:34:57', '2024-08-21 12:35:01', NULL),
(276, 54, 1, 'Анастасия готов приступить к работе', '2024-08-21 13:47:00', '2024-08-21 13:47:20', '2024-08-21 13:47:23', NULL),
(279, 56, 1, 'Арина готов приступить к работе', '2024-08-22 06:03:00', '2024-08-22 06:03:34', '2024-08-22 06:03:42', NULL),
(280, 56, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/xkCbeYw5WM\">https://lk.adswap.ru/lnk/xkCbeYw5WM</a>', '2024-08-22 06:03:00', '2024-08-22 06:03:34', '2024-08-22 06:03:42', NULL),
(281, 510, 10, 'здравствуйте. спасибо за отклик!', '2024-08-23 05:53:00', '2024-08-22 06:04:12', '2024-08-23 05:53:47', NULL),
(282, 510, 10, 'Electrolite - компания-производитель электро и бензо инструментов, садовой и строительной техники.   \r\nМы хотим предложить вам взаимовыгодное сотрудничество по бартеру.  Мы готовы отправить вам товар (на выбор). Он останется у Вас для дальнейшего использования.  А Вы снимете обзор на него в ваших соц сетях. \r\n\r\nТз ютуб: <a target=\"_blank\" href=\"https://docs.google.com/document/d/1_FoimkGjzd4kHXoq0dxiX_2SGKyWs7C2HY2OfZ0fc1c/edit\">https://docs.google.com/document/d/1_FoimkGjzd4kHXoq0dxiX_2SGKyWs7C2HY2OfZ0fc1c/edit</a>', '2024-08-23 05:53:00', '2024-08-22 06:05:41', '2024-08-23 05:53:47', NULL),
(283, 1, 10, 'здравствуйте. когда планируете публикацию?', '2024-08-22 11:07:00', '2024-08-22 11:00:24', '2024-08-22 11:07:19', NULL),
(284, 1, 20, 'Добрый день! Сейчас ролик монтируется, как будет готов , сразу вышлем ссылку.', '2024-08-23 03:43:00', '2024-08-22 11:09:31', '2024-08-23 03:43:53', NULL),
(285, 54, 1, 'Ксения готов приступить к работе', '2024-08-22 12:46:00', '2024-08-22 12:46:02', '2024-08-22 12:46:04', NULL),
(286, 54, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/9nQ4oYDXK1\">https://lk.adswap.ru/lnk/9nQ4oYDXK1</a>', '2024-08-22 12:46:00', '2024-08-22 12:46:02', '2024-08-22 12:46:04', NULL),
(287, 1, 10, 'хорошо, спасибо', '2024-08-23 04:12:00', '2024-08-23 03:44:04', '2024-08-23 04:12:10', NULL),
(288, 56, 10, 'здравствуйте. Отправлено СДЭК 10022587051', '2024-08-23 06:22:00', '2024-08-23 03:50:24', '2024-08-23 06:22:55', NULL),
(291, 510, 10, 'здравствуйте. жду вашего ответа)', '2024-08-23 05:53:00', '2024-08-23 05:45:01', '2024-08-23 05:53:47', NULL),
(292, 510, 99, 'Да, конечно, присылайте', '2024-08-23 06:15:00', '2024-08-23 05:54:30', '2024-08-23 06:15:27', NULL),
(293, 510, 99, 'Какая информация Вам нужна? Реклама будет нативная, или с маркировкой?', '2024-08-23 06:15:00', '2024-08-23 05:55:22', '2024-08-23 06:15:27', NULL),
(294, 510, 99, 'Т3 прочитала))', '2024-08-23 06:15:00', '2024-08-23 05:56:52', '2024-08-23 06:15:27', NULL),
(295, 510, 99, 'Всё понятно, сделаем👍', '2024-08-23 06:15:00', '2024-08-23 06:00:49', '2024-08-23 06:15:27', NULL),
(296, 510, 10, 'да, реклама без маркировки, подача нативная.', '2024-08-23 06:20:00', '2024-08-23 06:16:03', '2024-08-23 06:20:13', NULL),
(297, 510, 99, 'Сделаем, уже прочитали Т3', '2024-08-26 05:28:00', '2024-08-23 06:20:43', '2024-08-26 05:28:24', NULL),
(298, 510, 99, 'У Вас данные о нас есть? Адрес и т.д.?', '2024-08-26 05:28:00', '2024-08-23 06:21:24', '2024-08-26 05:28:24', NULL),
(299, 56, 46, 'Здравствуйте, спасибо ☺', '2024-08-26 05:48:00', '2024-08-23 06:23:09', '2024-08-26 05:48:09', NULL),
(300, 510, 1, 'Мария готов приступить к работе', '2024-08-23 06:35:00', '2024-08-23 06:35:07', '2024-08-23 06:35:12', NULL),
(301, 1, 10, 'ссылка для описания: <a target=\"_blank\" href=\"https://partnerforgarden.mobz.click/semyafia\">https://partnerforgarden.mobz.click/semyafia</a>', '2024-08-23 11:56:00', '2024-08-23 11:55:51', '2024-08-23 11:56:34', NULL),
(302, 1, 20, 'Спасибо!', '2024-08-26 05:46:00', '2024-08-23 11:57:34', '2024-08-26 05:46:29', NULL),
(303, 540, 99, '😊👍♥️', '2024-08-23 12:36:00', '2024-08-23 12:33:18', '2024-08-23 12:36:33', NULL),
(304, 540, 9, 'Здравствуйте, Мария. а вы не хотите еще один товар взять из детской мебели? Посмотрите каталог, пришлите заявку на второй товар, который выберите', '2024-08-23 12:37:00', '2024-08-23 12:37:27', '2024-08-23 12:37:57', NULL),
(305, 540, 1, 'Анастасия готов приступить к работе', '2024-08-23 12:37:00', '2024-08-23 12:37:28', '2024-08-23 12:37:32', NULL),
(306, 510, 99, 'Ждём товар, сделаем качественно работу, у нас два частных дома, и травы - косить не перекосить😊', '2024-08-26 05:28:00', '2024-08-23 12:37:41', '2024-08-26 05:28:24', NULL),
(307, 540, 9, 'Будет две разные интеграции с разницей в 7-10 дней)', '2024-08-23 12:37:00', '2024-08-23 12:37:45', '2024-08-23 12:37:57', NULL),
(308, 540, 99, 'А можно два одинаковых товара? Мол два дома у нас, заказали в один, через 10 дней в другой дом?', '2024-08-26 11:16:00', '2024-08-23 12:39:08', '2024-08-26 11:16:13', NULL),
(309, 540, 99, 'Если можно конечно', '2024-08-26 11:16:00', '2024-08-23 12:39:58', '2024-08-26 11:16:13', NULL),
(310, 540, 99, 'Я заказала ещё комод))', '2024-08-26 11:16:00', '2024-08-24 06:53:13', '2024-08-26 11:16:13', NULL),
(311, 698, 112, 'Здравствуйте', '2024-08-26 11:17:00', '2024-08-24 08:45:30', '2024-08-26 11:17:05', NULL),
(312, 698, 1, 'Ольга готов приступить к работе', '2024-08-24 08:45:00', '2024-08-24 08:45:31', '2024-08-24 08:45:35', NULL),
(313, 697, 1, 'Ольга готов приступить к работе', '2024-08-24 08:45:00', '2024-08-24 08:45:49', '2024-08-24 08:45:53', NULL),
(314, 697, 112, 'Здравствуйте', '2024-08-26 11:17:00', '2024-08-24 08:45:53', '2024-08-26 11:17:41', NULL),
(316, 60, 46, 'Здравствуйте да', '2024-08-26 11:17:00', '2024-08-24 15:00:44', '2024-08-26 11:17:43', NULL),
(321, 510, 10, 'здравствуйте. доставка будет осуществляться на пункт выдачи СДЭК .   \r\nукажите, пожалуйста:  \r\n1) ФИО получателя полностью  \r\n2) адрес ближайшего Сдэка(город; микрорайон/деревня/поселок; улица; дом;)  \r\n3)номер телефона', '2024-08-26 05:33:00', '2024-08-26 05:29:01', '2024-08-26 05:33:16', NULL),
(322, 510, 99, 'Полякова Мария Алексеевна', '2024-08-26 05:35:00', '2024-08-26 05:34:18', '2024-08-26 05:35:00', NULL),
(324, 510, 99, 'Город Ейск ,Сдек  ул.Пушкина 71/1', '2024-08-26 05:35:00', '2024-08-26 05:34:47', '2024-08-26 05:35:00', NULL),
(325, 510, 99, '89966395622', '2024-08-26 05:36:00', '2024-08-26 05:35:09', '2024-08-26 05:36:00', NULL),
(329, 1, 10, 'здравствуйте. видео посмотрела, все отлично. можем публиковать', '2024-08-26 06:30:00', '2024-08-26 05:54:24', '2024-08-26 06:30:42', NULL),
(337, 1, 20, 'Хорошо. Спасибо', '2024-08-26 06:31:00', '2024-08-26 06:31:12', '2024-08-26 06:31:21', NULL),
(338, 540, 9, 'Здравствуйте) Все-таки комод и туалетный столик или 2 столика?)', '2024-08-26 11:36:00', '2024-08-26 11:17:03', '2024-08-26 11:36:26', NULL),
(339, 698, 9, 'Здравствуйте) Пришлите, пожалуйста, ссылку на вашу страницу?', NULL, '2024-08-26 11:17:40', '2024-08-26 11:17:40', NULL),
(340, 766, 9, 'Здравствуйте) готовы сотрудничать с вами)', '2024-08-26 12:07:00', '2024-08-26 11:23:06', '2024-08-26 12:07:56', NULL),
(341, 756, 9, 'Здравствуйте) готовы сотрудничать с вами) Подскажите, сможете сделать публикацию и в ш\r\nортс на ютубе и в рилс в инстаграм?', NULL, '2024-08-26 11:23:46', '2024-08-26 11:23:46', NULL),
(342, 766, 9, 'С вашего согласия, менеджер Зуфы выберет из вашего профиля Инстаграм несколько фото, которые будут лучше выглядеть на футболке при раскраске, пришлю их вам, вы согласуете какое-то одно фото. Также нужны будут размер и цвет футболки - белый или черный) После раскраски футболки, ребята отправляют ее вам) нужен адрес доставки) ФИО, индекс, адрес, номер телефона', '2024-08-26 12:07:00', '2024-08-26 11:25:02', '2024-08-26 12:07:56', NULL),
(343, 756, 9, 'С вашего согласия, менеджер Зуфы выберет из вашего профиля Инстаграм несколько фото, которые будут лучше выглядеть на футболке при раскраске, пришлю их вам, вы согласуете какое-то одно фото. Также нужны будут размер и цвет футболки - белый или черный) После раскраски футболки, ребята отправляют ее вам) нужен адрес доставки) ФИО, индекс, адрес, номер телефона', NULL, '2024-08-26 11:25:08', '2024-08-26 11:25:08', NULL),
(344, 747, 9, 'По тачке нужен шортс на ютубе', NULL, '2024-08-26 11:34:40', '2024-08-26 11:34:40', NULL),
(345, 759, 9, 'и по самосвалу готовы)', '2024-08-26 11:35:00', '2024-08-26 11:34:49', '2024-08-26 11:35:48', NULL),
(346, 759, 9, 'ТЗ <a target=\"_blank\" href=\"https://docs.google.com/document/d/1Zaw35SOS0ntpV4MX7MGBJS2QBpVDOmW2tNyHiBH9pn0/edit\">https://docs.google.com/document/d/1Zaw35SOS0ntpV4MX7MGBJS2QBpVDOmW2tNyHiBH9pn0/edit</a>', '2024-08-26 11:35:00', '2024-08-26 11:35:11', '2024-08-26 11:35:48', NULL),
(347, 759, 9, 'ТЗ <a target=\"_blank\" href=\"https://docs.google.com/document/d/1Zaw35SOS0ntpV4MX7MGBJS2QBpVDOmW2tNyHiBH9pn0/edit\">https://docs.google.com/document/d/1Zaw35SOS0ntpV4MX7MGBJS2QBpVDOmW2tNyHiBH9pn0/edit</a>', '2024-08-26 11:35:00', '2024-08-26 11:35:16', '2024-08-26 11:35:48', NULL),
(348, 667, 9, 'Здравствуйте)\r\n Ждем ссылку на страницу)', NULL, '2024-08-26 11:35:54', '2024-08-26 11:35:54', NULL),
(349, 759, 99, 'Ок😊🌹, адрес надо?))', '2024-08-26 14:10:00', '2024-08-26 11:36:09', '2024-08-26 14:10:09', NULL),
(350, 540, 99, 'Желательно 2 столика♥️', '2024-08-26 14:03:00', '2024-08-26 11:36:55', '2024-08-26 14:03:59', NULL),
(351, 540, 9, 'Хорошо)', '2024-08-26 14:06:00', '2024-08-26 14:04:13', '2024-08-26 14:06:34', NULL),
(352, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(353, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(354, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(355, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(356, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(357, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(358, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(359, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(360, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:35', '2024-08-26 14:06:34', NULL),
(361, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(362, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(363, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(364, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(365, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(366, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(367, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(368, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:36', '2024-08-26 14:06:34', NULL),
(369, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:48', '2024-08-26 14:06:34', NULL),
(370, 540, 9, 'ТЗ - <a target=\"_blank\" href=\"https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit\">https://docs.google.com/document/d/1FmtIK8cV1Rd4FljZI4y3l-3M3pZVE0lbHELwk-4-mNs/edit</a>', '2024-08-26 14:06:00', '2024-08-26 14:05:48', '2024-08-26 14:06:34', NULL),
(371, 540, 99, 'Ок', '2024-08-26 14:08:00', '2024-08-26 14:07:23', '2024-08-26 14:08:54', NULL),
(372, 540, 9, 'Простите за 100 сообщений, интернет с ума сошел', '2024-08-26 14:10:00', '2024-08-26 14:09:13', '2024-08-26 14:10:15', NULL),
(373, 540, 9, 'для отправки нужны данные: ФИО, индекс, адрес и номер \r\nтелефона. Отправка ТК', '2024-08-26 14:10:00', '2024-08-26 14:09:39', '2024-08-26 14:10:15', NULL),
(374, 759, 9, 'Да) ФИО, индекс, адрес и номер телефона. Отправка Почтой Р\r\nоссии', '2024-08-26 14:11:00', '2024-08-26 14:10:25', '2024-08-26 14:11:20', NULL),
(375, 759, 99, 'Полякова Мария Алексеевна', '2024-08-26 14:11:00', '2024-08-26 14:11:43', '2024-08-26 14:11:46', NULL),
(376, 759, 99, 'Краснодарский край', '2024-08-26 14:11:00', '2024-08-26 14:11:53', '2024-08-26 14:11:56', NULL),
(377, 759, 99, 'Город Ейск', '2024-08-26 14:12:00', '2024-08-26 14:11:59', '2024-08-26 14:12:01', NULL),
(378, 759, 99, 'Полякова Мария Алексеевна', '2024-08-26 15:20:00', '2024-08-26 14:24:30', '2024-08-26 15:20:12', NULL),
(379, 759, 99, 'УлТаманская 259', '2024-08-26 15:20:00', '2024-08-26 14:24:54', '2024-08-26 15:20:12', NULL),
(380, 759, 99, '353682', '2024-08-26 15:20:00', '2024-08-26 14:25:05', '2024-08-26 15:20:12', NULL),
(381, 759, 99, '89966395622', '2024-08-26 15:20:00', '2024-08-26 14:42:47', '2024-08-26 15:20:12', NULL),
(382, 540, 99, 'Краснодарский край город Ейск улица Таманская 259 индекс 353682 , Полякова Мария Алексеевна 89966395622, Вы у меня в ватсапе есть', NULL, '2024-08-26 14:45:01', '2024-08-26 14:45:01', NULL),
(383, 540, 1, 'Мария готов приступить к работе', '2024-08-26 14:45:00', '2024-08-26 14:45:13', '2024-08-26 14:45:16', NULL),
(384, 540, 1, 'Статус работы изменён на: <span style=\"color: var(--primary)\">выполняется</span> - ссылка для сбора статистики <a target=\"_blank\" href=\"https://lk.adswap.ru/lnk/pxmOXrbO78\">https://lk.adswap.ru/lnk/pxmOXrbO78</a>', '2024-08-26 14:45:00', '2024-08-26 14:45:13', '2024-08-26 14:45:16', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `message_files`
--

CREATE TABLE `message_files` (
  `id` bigint UNSIGNED NOT NULL,
  `source_id` bigint UNSIGNED NOT NULL,
  `type` int NOT NULL DEFAULT '0',
  `link` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `message_files`
--

INSERT INTO `message_files` (`id`, `source_id`, `type`, `link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 0, 'messages/5faufJdwKiMOcI1gCxTVqrXOO0ekxbLdO0HjUV2i.pdf', '2024-08-12 16:19:18', '2024-08-12 16:19:18', NULL),
(2, 4, 0, 'messages/zSlEQDHCe6PTMEI6rxY5Ljc8VIxrWuwcKCK6WxhL.pdf', '2024-08-12 16:21:44', '2024-08-12 16:21:44', NULL),
(3, 17, 0, 'messages/cKifLReCXheZxtRYvXzhV7FQQuCcq5Uw0Il3WetU.pdf', '2024-08-16 08:40:33', '2024-08-16 08:40:33', NULL),
(4, 47, 0, 'messages/2xHePLa8QYY4oon8gP0O0dUxeaehIL7tprIToRgD.docx', '2024-08-19 09:55:55', '2024-08-19 09:55:55', NULL),
(5, 51, 0, 'messages/qFeCffUmiTh6g7OSw6dPNqLrmPGruVd2NagzrwY1.docx', '2024-08-19 09:58:52', '2024-08-19 09:58:52', NULL),
(10, 100, 0, 'messages/6p6kVI0Uv5TgJyG9SRd2dZk7bcZOaseJEJ4zfz4a.docx', '2024-08-19 10:46:39', '2024-08-19 10:46:39', NULL),
(22, 135, 0, 'messages/eorUk8oVjfLVYaBmnG6giFC0BZfeLsWQJFskKvsX.docx', '2024-08-19 12:31:45', '2024-08-19 12:31:45', NULL),
(23, 136, 0, 'messages/1Bcbo9CwEhLkYzn6ybgtx3ix4XKnqfdFz5HO8U3l.docx', '2024-08-19 12:35:31', '2024-08-19 12:35:31', NULL),
(24, 222, 0, 'messages/prIRwJt1jF4UjvaVxa25ts0TmDhEVvqYz8DPlT5O.jpg', '2024-08-21 08:58:20', '2024-08-21 08:58:20', NULL),
(25, 273, 0, 'messages/6oY7U97NCTOKStdGeWFke65Q6A6EfGRSvNomRhwz.jpg', '2024-08-21 12:34:03', '2024-08-21 12:34:03', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(309, '2014_05_27_093208_create_tg_phones_table', 1),
(310, '2014_10_12_000000_create_users_table', 1),
(311, '2014_10_12_100000_create_password_resets_table', 1),
(312, '2019_08_19_000000_create_failed_jobs_table', 1),
(313, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(314, '2024_05_13_052308_create_countries_table', 1),
(315, '2024_05_16_230109_create_projects_table', 1),
(316, '2024_05_24_114155_create_sellers_table', 1),
(317, '2024_05_24_114200_create_bloggers_table', 1),
(318, '2024_05_24_124631_create_notifications_table', 1),
(319, '2024_05_24_124850_create_achievemnts_table', 1),
(320, '2024_05_24_124855_create_user_achievemnts_table', 1),
(321, '2024_05_24_170936_create_project_files_table', 1),
(322, '2024_05_29_013725_create_feedback_table', 1),
(323, '2024_06_02_120231_create_blogger_platforms_table', 1),
(324, '2024_06_06_152056_create_project_works_table', 1),
(325, '2024_06_08_102726_create_works_table', 1),
(326, '2024_06_08_110458_create_messages_table', 1),
(327, '2024_06_08_122123_create_themes_table', 1),
(328, '2024_06_08_123925_create_blogger_themes_table', 1),
(329, '2024_06_08_134352_create_deep_links_table', 1),
(330, '2024_06_08_134418_create_deep_link_stats_table', 1),
(331, '2024_06_08_144512_create_tariff_groups_table', 1),
(332, '2024_06_08_144755_create_tariffs_table', 1),
(333, '2024_06_08_151109_create_message_files_table', 1),
(334, '2024_06_08_204802_create_seller_tariffs_table', 1),
(335, '2024_06_13_233447_create_finish_stats_table', 1),
(336, '2024_07_05_130847_create_payments_table', 1),
(337, '2024_08_18_192925_platforms_soft_delete', 2),
(338, '2024_08_18_204336_platforms_reels_shorts_views_er', 2),
(339, '2024_08_19_215943_create_logs_table', 3),
(340, '2024_08_23_023523_admin_field_user', 4),
(341, '2024_08_20_211428_create_platforms_table', 5),
(342, '2024_08_20_211842_blogger_platforms_forign', 5),
(347, '2024_08_29_213110_create_referral_codes_table', 6),
(348, '2024_08_29_213216_create_referral_users_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `work_id` bigint UNSIGNED DEFAULT NULL,
  `from_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `text`, `viewed_at`, `work_id`, `from_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 'Новая заявка', 'Вам поступила новая заявка от Семья ФиА на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 1, 20, '2024-08-12 14:42:11', '2024-08-12 14:42:11', NULL),
(2, 20, 'Новая заявка', 'Арина принял вашу заявку на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 1, 10, '2024-08-12 16:13:25', '2024-08-12 16:13:25', NULL),
(3, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-12 16:16:21', '2024-08-12 16:16:21', NULL),
(4, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-12 16:19:18', '2024-08-12 16:19:18', NULL),
(5, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, NULL, NULL, '2024-08-12 16:21:14', '2024-08-12 16:21:14', NULL),
(6, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-12 16:21:44', '2024-08-12 16:21:44', NULL),
(7, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, NULL, NULL, '2024-08-12 16:29:58', '2024-08-12 16:29:58', NULL),
(8, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-12 16:31:25', '2024-08-12 16:31:25', NULL),
(9, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, NULL, NULL, '2024-08-12 16:34:47', '2024-08-12 16:34:47', NULL),
(10, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-12 16:35:15', '2024-08-12 16:35:15', NULL),
(11, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-12 16:35:31', '2024-08-12 16:35:31', NULL),
(12, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, NULL, NULL, '2024-08-12 16:39:13', '2024-08-12 16:39:13', NULL),
(13, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, NULL, NULL, '2024-08-14 06:26:03', '2024-08-14 06:26:03', NULL),
(14, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, NULL, NULL, '2024-08-14 06:29:24', '2024-08-14 06:29:24', NULL),
(15, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-19 10:41:00', 2, 26, '2024-08-14 11:10:46', '2024-08-19 10:41:23', NULL),
(16, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-19 10:41:00', 3, 26, '2024-08-14 17:38:43', '2024-08-19 10:41:24', NULL),
(17, 29, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 4, 10, '2024-08-15 08:18:56', '2024-08-15 08:18:56', NULL),
(18, 30, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', '2024-08-19 05:48:00', 5, 10, '2024-08-15 08:19:31', '2024-08-19 05:48:07', NULL),
(19, 26, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 6, 10, '2024-08-15 08:19:46', '2024-08-15 08:19:46', NULL),
(20, 10, 'Подтверждение', 'Арина принял вашу заявку по проекту Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 5, 30, '2024-08-15 17:53:59', '2024-08-15 17:53:59', NULL),
(21, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Василий', NULL, NULL, NULL, '2024-08-15 17:56:35', '2024-08-15 17:56:35', NULL),
(22, 10, 'Согласование проекта', 'Василий готов приступить к работе по проекту Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 5, 30, '2024-08-15 17:56:38', '2024-08-15 17:56:38', NULL),
(23, 30, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', '2024-08-19 05:47:00', NULL, NULL, '2024-08-16 08:38:12', '2024-08-19 05:47:58', NULL),
(24, 30, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', '2024-08-19 05:47:00', NULL, NULL, '2024-08-16 08:38:53', '2024-08-19 05:47:57', NULL),
(25, 30, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', '2024-08-19 05:47:00', NULL, NULL, '2024-08-16 08:40:33', '2024-08-19 05:47:56', NULL),
(26, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Василий', NULL, NULL, NULL, '2024-08-16 11:01:38', '2024-08-16 11:01:38', NULL),
(27, 30, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', '2024-08-19 05:47:00', NULL, NULL, '2024-08-16 11:06:44', '2024-08-19 05:47:55', NULL),
(28, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Василий', NULL, NULL, NULL, '2024-08-16 11:07:29', '2024-08-16 11:07:29', NULL),
(29, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Василий', NULL, NULL, NULL, '2024-08-16 11:08:11', '2024-08-16 11:08:11', NULL),
(30, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Василий', NULL, NULL, NULL, '2024-08-16 11:31:19', '2024-08-16 11:31:19', NULL),
(31, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-19 10:41:00', 7, 32, '2024-08-16 12:25:20', '2024-08-19 10:41:25', NULL),
(32, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 8, 32, '2024-08-16 12:25:20', '2024-08-19 10:41:20', NULL),
(33, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-19 10:41:00', 9, 32, '2024-08-16 12:25:26', '2024-08-19 10:41:26', NULL),
(34, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 10, 32, '2024-08-16 12:25:26', '2024-08-19 10:41:27', NULL),
(35, 10, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 11, 32, '2024-08-16 12:25:26', '2024-08-16 12:25:26', NULL),
(36, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-19 10:41:00', 12, 32, '2024-08-16 12:25:59', '2024-08-19 10:41:28', NULL),
(37, 10, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 13, 32, '2024-08-16 12:25:59', '2024-08-16 12:25:59', NULL),
(38, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 14, 32, '2024-08-16 12:25:59', '2024-08-19 10:41:29', NULL),
(39, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-19 10:41:00', 15, 32, '2024-08-16 12:25:59', '2024-08-19 10:41:30', NULL),
(40, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-19 10:41:00', 16, 32, '2024-08-16 12:26:32', '2024-08-19 10:41:31', NULL),
(41, 31, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Брюки школьные классические палаццо', NULL, 17, 32, '2024-08-16 12:26:41', '2024-08-16 12:26:41', NULL),
(42, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-19 10:41:00', 18, 32, '2024-08-16 12:26:41', '2024-08-19 10:41:32', NULL),
(43, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Футболка женская с принтом хлопок', '2024-08-19 10:41:00', 19, 32, '2024-08-16 12:27:45', '2024-08-19 10:41:34', NULL),
(44, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 20, 36, '2024-08-16 12:43:09', '2024-08-19 10:41:35', NULL),
(45, 9, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 21, 32, '2024-08-16 14:00:21', '2024-08-19 10:41:35', NULL),
(46, 9, 'Новая заявка', 'Вам поступила новая заявка от Алина на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-19 10:41:00', 22, 45, '2024-08-16 17:29:59', '2024-08-19 10:41:36', NULL),
(47, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 23, 49, '2024-08-17 07:35:03', '2024-08-19 10:41:36', NULL),
(48, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 24, 49, '2024-08-17 07:35:23', '2024-08-19 10:41:37', NULL),
(49, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 25, 49, '2024-08-17 07:35:23', '2024-08-19 10:41:37', NULL),
(50, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 26, 49, '2024-08-17 07:35:34', '2024-08-19 10:41:38', NULL),
(51, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 27, 49, '2024-08-17 07:35:34', '2024-08-19 10:41:39', NULL),
(52, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 28, 49, '2024-08-17 07:35:34', '2024-08-17 07:35:34', NULL),
(53, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 29, 49, '2024-08-17 07:36:08', '2024-08-19 10:41:39', NULL),
(54, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 30, 49, '2024-08-17 07:36:08', '2024-08-17 07:36:08', NULL),
(55, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 31, 49, '2024-08-17 07:36:08', '2024-08-19 10:41:40', NULL),
(56, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-19 10:41:00', 32, 49, '2024-08-17 07:36:08', '2024-08-19 10:41:40', NULL),
(57, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 33, 49, '2024-08-17 07:36:52', '2024-08-19 10:41:40', NULL),
(58, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 34, 49, '2024-08-17 07:36:52', '2024-08-19 10:41:41', NULL),
(59, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 35, 49, '2024-08-17 07:36:52', '2024-08-17 07:36:52', NULL),
(60, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-19 10:41:00', 36, 49, '2024-08-17 07:36:52', '2024-08-19 10:41:41', NULL),
(61, 31, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Брюки школьные классические палаццо', NULL, 37, 49, '2024-08-17 07:36:52', '2024-08-17 07:36:52', NULL),
(62, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 39, 49, '2024-08-17 07:37:06', '2024-08-19 10:41:41', NULL),
(63, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 38, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(64, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 40, 49, '2024-08-17 07:37:06', '2024-08-19 10:41:42', NULL),
(65, 31, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Брюки школьные классические палаццо', NULL, 41, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(66, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-19 10:41:00', 42, 49, '2024-08-17 07:37:06', '2024-08-19 10:41:42', NULL),
(67, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Футболка женская с принтом хлопок', '2024-08-19 10:41:00', 43, 49, '2024-08-17 07:37:06', '2024-08-19 10:41:42', NULL),
(68, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-19 10:41:00', 44, 49, '2024-08-17 07:37:54', '2024-08-19 10:41:42', NULL),
(69, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 45, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(70, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-19 10:41:00', 46, 49, '2024-08-17 07:37:54', '2024-08-19 10:41:42', NULL),
(71, 31, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Брюки школьные классические палаццо', NULL, 47, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(72, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-19 10:41:00', 48, 49, '2024-08-17 07:37:54', '2024-08-19 10:41:43', NULL),
(73, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Футболка женская с принтом хлопок', '2024-08-19 10:41:00', 49, 49, '2024-08-17 07:37:54', '2024-08-19 10:41:43', NULL),
(74, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кроватка с мягким изголовьем', '2024-08-21 13:47:00', 50, 49, '2024-08-17 07:37:54', '2024-08-21 13:47:46', NULL),
(75, 31, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Брюки школьные классические палаццо', NULL, 51, 48, '2024-08-17 07:42:27', '2024-08-17 07:42:27', NULL),
(76, 9, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:47:00', 53, 48, '2024-08-17 07:43:15', '2024-08-21 13:47:47', NULL),
(77, 31, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Брюки школьные классические палаццо', NULL, 52, 48, '2024-08-17 07:43:15', '2024-08-17 07:43:15', NULL),
(78, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:47:00', 54, 46, '2024-08-17 21:17:38', '2024-08-21 13:47:48', NULL),
(79, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:47:00', 55, 46, '2024-08-17 21:18:56', '2024-08-21 13:47:48', NULL),
(80, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 56, 46, '2024-08-17 21:18:56', '2024-08-17 21:18:56', NULL),
(81, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:47:00', 57, 46, '2024-08-17 21:19:40', '2024-08-21 13:47:50', NULL),
(82, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:47:00', 58, 46, '2024-08-17 21:19:40', '2024-08-21 13:47:51', NULL),
(83, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 59, 46, '2024-08-17 21:19:40', '2024-08-17 21:19:40', NULL),
(84, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Кровать детская', '2024-08-21 13:50:00', 60, 46, '2024-08-17 21:20:40', '2024-08-21 13:50:17', NULL),
(85, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Кровать детская', '2024-08-21 13:50:00', 61, 46, '2024-08-17 21:20:50', '2024-08-21 13:50:18', NULL),
(86, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:50:00', 62, 46, '2024-08-17 21:20:50', '2024-08-21 13:50:15', NULL),
(87, 31, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Брюки школьные классические палаццо', NULL, 63, 46, '2024-08-17 21:21:26', '2024-08-17 21:21:26', NULL),
(88, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Кровать детская', '2024-08-21 13:50:00', 64, 46, '2024-08-17 21:21:26', '2024-08-21 13:50:16', NULL),
(89, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:50:00', 65, 46, '2024-08-17 21:21:27', '2024-08-21 13:50:16', NULL),
(90, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:50:00', 66, 46, '2024-08-18 09:22:00', '2024-08-21 13:50:12', NULL),
(91, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Растущий стол и стул для детей', '2024-08-21 13:50:00', 67, 56, '2024-08-18 11:04:33', '2024-08-21 13:50:11', NULL),
(92, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стол и мягкий стул', '2024-08-21 13:50:00', 68, 56, '2024-08-18 11:04:42', '2024-08-21 13:50:11', NULL),
(93, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Растущий стол и стул для детей', '2024-08-21 13:50:00', 69, 56, '2024-08-18 11:04:42', '2024-08-21 13:50:10', NULL),
(94, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Растущий стол и стул для детей', '2024-08-21 13:50:00', 71, 56, '2024-08-18 11:05:04', '2024-08-21 13:50:10', NULL),
(95, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стол и мягкий стул', '2024-08-21 13:50:00', 70, 56, '2024-08-18 11:05:04', '2024-08-21 13:50:09', NULL),
(96, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кровать детская', '2024-08-21 13:50:00', 72, 56, '2024-08-18 11:05:04', '2024-08-21 13:50:09', NULL),
(97, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кроватка с мягким изголовьем', '2024-08-21 13:50:00', 73, 56, '2024-08-18 11:05:26', '2024-08-21 13:50:08', NULL),
(98, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стол и мягкий стул', '2024-08-21 13:50:00', 74, 56, '2024-08-18 11:05:26', '2024-08-21 13:50:08', NULL),
(99, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Растущий стол и стул для детей', '2024-08-21 13:50:00', 75, 56, '2024-08-18 11:05:26', '2024-08-21 13:50:08', NULL),
(100, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кровать детская', '2024-08-21 13:50:00', 76, 56, '2024-08-18 11:05:26', '2024-08-21 13:50:07', NULL),
(101, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стол и мягкий стул', '2024-08-21 13:50:00', 77, 56, '2024-08-18 11:05:43', '2024-08-21 13:50:07', NULL),
(102, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Растущий стол и стул для детей', '2024-08-21 13:50:00', 78, 56, '2024-08-18 11:05:43', '2024-08-21 13:50:07', NULL),
(103, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кровать детская', '2024-08-21 13:50:00', 79, 56, '2024-08-18 11:05:43', '2024-08-21 13:50:06', NULL),
(104, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кроватка с мягким изголовьем', '2024-08-21 13:50:00', 80, 56, '2024-08-18 11:05:43', '2024-08-21 13:50:06', NULL),
(105, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:50:00', 81, 56, '2024-08-18 11:05:43', '2024-08-21 13:50:06', NULL),
(106, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Растущий стол и стул для детей', '2024-08-21 13:50:00', 82, 56, '2024-08-18 11:05:59', '2024-08-21 13:50:05', NULL),
(107, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стол и мягкий стул', '2024-08-21 13:50:00', 83, 56, '2024-08-18 11:05:59', '2024-08-21 13:50:05', NULL),
(108, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кроватка с мягким изголовьем', '2024-08-21 13:50:00', 84, 56, '2024-08-18 11:05:59', '2024-08-21 13:50:05', NULL),
(109, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Футболка женская с принтом хлопок', '2024-08-21 13:50:00', 85, 56, '2024-08-18 11:05:59', '2024-08-21 13:50:04', NULL),
(110, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Кровать детская', '2024-08-21 13:50:00', 86, 56, '2024-08-18 11:05:59', '2024-08-21 13:50:04', NULL),
(111, 9, 'Новая заявка', 'Вам поступила новая заявка от Кристина на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:50:00', 87, 56, '2024-08-18 11:05:59', '2024-08-21 13:50:04', NULL),
(112, 10, 'Новая заявка', 'Вам поступила новая заявка от Семья ФиА на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 88, 20, '2024-08-18 15:20:22', '2024-08-18 15:20:22', NULL),
(113, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Стол и мягкий стул', '2024-08-21 13:50:00', 89, 57, '2024-08-18 16:11:53', '2024-08-21 13:50:04', NULL),
(114, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Стол и мягкий стул', '2024-08-21 13:50:00', 90, 57, '2024-08-18 16:12:07', '2024-08-21 13:50:03', NULL),
(115, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Мольберт детский', '2024-08-21 13:50:00', 91, 57, '2024-08-18 16:12:07', '2024-08-21 13:50:03', NULL),
(116, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Стол и мягкий стул', '2024-08-21 13:50:00', 92, 57, '2024-08-18 16:12:39', '2024-08-21 13:50:03', NULL),
(117, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Мольберт детский', '2024-08-21 13:50:00', 93, 57, '2024-08-18 16:12:39', '2024-08-21 13:50:02', NULL),
(118, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:50:00', 94, 57, '2024-08-18 16:12:39', '2024-08-21 13:50:02', NULL),
(119, 9, 'Новая заявка', 'Вам поступила новая заявка от Алёна на проект Мольберт детский', '2024-08-21 13:50:00', 95, 57, '2024-08-18 17:41:46', '2024-08-21 13:50:02', NULL),
(120, 30, 'Согласование проекта', 'Можно приступать к выполнению проекта Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 5, 10, '2024-08-19 05:55:49', '2024-08-19 05:55:49', NULL),
(121, 32, 'Новая заявка', 'Арина принял вашу заявку на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 13, 10, '2024-08-19 05:58:32', '2024-08-19 05:58:32', NULL),
(122, 46, 'Новая заявка', 'Арина принял вашу заявку на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 56, 10, '2024-08-19 05:58:56', '2024-08-19 05:58:56', NULL),
(123, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 56, NULL, '2024-08-19 05:59:45', '2024-08-19 05:59:45', NULL),
(124, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-19 05:59:58', '2024-08-19 05:59:58', NULL),
(125, 20, 'Согласование проекта', 'Арина готов приступить к работе по проекту Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 1, 10, '2024-08-19 06:00:02', '2024-08-19 06:00:02', NULL),
(126, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 06:00:58', '2024-08-19 06:00:58', NULL),
(127, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 06:01:07', '2024-08-19 06:01:07', NULL),
(128, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:50:00', 96, 49, '2024-08-19 07:22:52', '2024-08-21 13:50:02', NULL),
(129, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:50:00', 97, 49, '2024-08-19 07:23:07', '2024-08-21 13:50:02', NULL),
(130, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:50:00', 98, 49, '2024-08-19 07:23:07', '2024-08-21 13:50:01', NULL),
(131, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:50:00', 99, 49, '2024-08-19 07:23:20', '2024-08-21 13:50:01', NULL),
(132, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:50:00', 100, 49, '2024-08-19 07:23:20', '2024-08-21 13:50:01', NULL),
(133, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 101, 49, '2024-08-19 07:23:20', '2024-08-19 07:23:20', NULL),
(134, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 102, 49, '2024-08-19 07:23:46', '2024-08-19 07:23:46', NULL),
(135, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:50:00', 103, 49, '2024-08-19 07:23:46', '2024-08-21 13:50:01', NULL),
(136, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:50:00', 104, 49, '2024-08-19 07:23:46', '2024-08-21 13:50:00', NULL),
(137, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:50:00', 105, 49, '2024-08-19 07:23:46', '2024-08-21 13:50:00', NULL),
(138, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:50:00', 106, 49, '2024-08-19 07:23:54', '2024-08-21 13:50:00', NULL),
(139, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:50:00', 107, 49, '2024-08-19 07:23:54', '2024-08-21 13:50:00', NULL),
(140, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кроватка с мягким изголовьем', '2024-08-21 13:50:00', 108, 49, '2024-08-19 07:23:54', '2024-08-21 13:50:00', NULL),
(141, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 109, 49, '2024-08-19 07:23:54', '2024-08-19 07:23:54', NULL),
(142, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 110, 49, '2024-08-19 07:23:54', '2024-08-21 13:49:59', NULL),
(143, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 112, 49, '2024-08-19 07:24:08', '2024-08-21 13:49:59', NULL),
(144, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:49:00', 111, 49, '2024-08-19 07:24:08', '2024-08-21 13:49:59', NULL),
(145, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 113, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(146, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 114, 49, '2024-08-19 07:24:08', '2024-08-21 13:49:58', NULL),
(147, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 115, 49, '2024-08-19 07:24:08', '2024-08-21 13:49:58', NULL),
(148, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Футболка женская с принтом хлопок', '2024-08-21 13:49:00', 116, 49, '2024-08-19 07:24:08', '2024-08-21 13:49:58', NULL),
(149, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 117, 49, '2024-08-19 07:24:13', '2024-08-21 13:49:58', NULL),
(150, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:49:00', 118, 49, '2024-08-19 07:24:13', '2024-08-21 13:49:57', NULL),
(151, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 119, 49, '2024-08-19 07:24:13', '2024-08-21 13:49:57', NULL),
(152, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 120, 49, '2024-08-19 07:24:13', '2024-08-21 13:49:57', NULL),
(153, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Футболка женская с принтом хлопок', '2024-08-21 13:49:00', 121, 49, '2024-08-19 07:24:13', '2024-08-21 13:49:57', NULL),
(154, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 122, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(155, 31, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Брюки школьные классические палаццо', NULL, 123, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(156, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:49:00', 124, 49, '2024-08-19 07:24:35', '2024-08-21 13:49:56', NULL),
(157, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 125, 49, '2024-08-19 07:24:35', '2024-08-21 13:49:56', NULL),
(158, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 126, 49, '2024-08-19 07:24:35', '2024-08-21 13:49:56', NULL),
(159, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 127, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(160, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 128, 49, '2024-08-19 07:24:35', '2024-08-21 13:49:56', NULL),
(161, 31, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Брюки школьные классические палаццо', NULL, 129, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(162, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Футболка женская с принтом хлопок', '2024-08-21 13:49:00', 130, 49, '2024-08-19 07:24:35', '2024-08-21 13:49:56', NULL),
(163, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:49:00', 131, 49, '2024-08-19 07:24:35', '2024-08-21 13:49:55', NULL),
(164, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:49:00', 132, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:55', NULL),
(165, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 133, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:55', NULL),
(166, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 134, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:55', NULL),
(167, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 135, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(168, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 136, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:55', NULL),
(169, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Футболка женская с принтом хлопок', '2024-08-21 13:49:00', 137, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:54', NULL),
(170, 31, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Брюки школьные классические палаццо', NULL, 138, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(171, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', '2024-08-21 13:49:00', 139, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:54', NULL),
(172, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:49:00', 140, 49, '2024-08-19 07:25:31', '2024-08-21 13:49:54', NULL),
(173, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 07:30:54', '2024-08-19 07:30:54', NULL),
(174, 10, 'Согласование проекта', 'Вадим Стукалов готов приступить к работе по проекту Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 13, 32, '2024-08-19 07:30:55', '2024-08-19 07:30:55', NULL),
(175, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-19 09:34:46', '2024-08-19 09:34:46', NULL),
(176, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-19 09:34:59', '2024-08-19 09:34:59', NULL),
(177, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 141, 46, '2024-08-19 09:36:01', '2024-08-21 13:49:53', NULL),
(178, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 143, 46, '2024-08-19 09:36:11', '2024-08-21 13:49:53', NULL),
(179, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Кровать детская', '2024-08-21 13:49:00', 142, 46, '2024-08-19 09:36:11', '2024-08-21 13:49:53', NULL),
(180, 10, 'Согласование проекта', 'Ксения готов приступить к работе по проекту Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 56, 46, '2024-08-19 09:36:48', '2024-08-19 09:36:48', NULL),
(181, 32, 'Новая заявка', 'Анастасия принял вашу заявку на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 7, 9, '2024-08-19 09:46:34', '2024-08-19 09:46:34', NULL),
(182, 9, 'Согласование проекта', 'Вадим Стукалов готов приступить к работе по проекту Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 7, 32, '2024-08-19 09:49:41', '2024-08-21 13:49:52', NULL),
(183, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 09:49:56', '2024-08-19 09:49:56', NULL),
(184, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-19 09:50:35', '2024-08-21 13:49:52', NULL),
(185, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-19 09:50:50', '2024-08-21 13:49:52', NULL),
(186, 49, 'Новая заявка', 'Анастасия принял вашу заявку на проект Садовая тачка Самосвал, тележка строительная', NULL, 133, 9, '2024-08-19 09:51:59', '2024-08-19 09:51:59', NULL),
(187, 49, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 133, NULL, '2024-08-19 09:52:22', '2024-08-19 09:52:22', NULL),
(188, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 09:53:28', '2024-08-19 09:53:28', NULL),
(189, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 09:53:45', '2024-08-19 09:53:45', NULL),
(190, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-19 09:54:05', '2024-08-21 13:49:52', NULL),
(191, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вера', '2024-08-21 13:49:00', 133, NULL, '2024-08-19 09:54:31', '2024-08-21 13:49:51', NULL),
(192, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вера', '2024-08-21 13:49:00', 133, NULL, '2024-08-19 09:54:35', '2024-08-21 13:49:51', NULL),
(193, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вера', '2024-08-21 13:49:00', 133, NULL, '2024-08-19 09:55:04', '2024-08-21 13:49:51', NULL),
(194, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вера', '2024-08-21 13:49:00', 133, NULL, '2024-08-19 09:55:07', '2024-08-21 13:49:51', NULL),
(195, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 09:55:55', '2024-08-19 09:55:55', NULL),
(196, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-19 09:56:49', '2024-08-21 13:49:51', NULL),
(197, 32, 'Согласование проекта', 'Можно приступать к выполнению проекта Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 7, 9, '2024-08-19 09:57:04', '2024-08-19 09:57:04', NULL),
(198, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 09:58:52', '2024-08-19 09:58:52', NULL),
(199, 49, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 133, NULL, '2024-08-19 10:02:05', '2024-08-19 10:02:05', NULL),
(203, 46, 'Новая заявка', 'Анастасия принял вашу заявку на проект Арка садовая металлическая, пергола, шпалера', NULL, 54, 9, '2024-08-19 10:09:05', '2024-08-19 10:09:05', NULL),
(204, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-19 10:10:22', '2024-08-19 10:10:22', NULL),
(205, 56, 'Новая заявка', 'Анастасия принял вашу заявку на проект Растущий стол и стул для детей', NULL, 67, 9, '2024-08-19 10:10:59', '2024-08-19 10:10:59', NULL),
(206, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 10:11:16', '2024-08-19 10:11:16', NULL),
(207, 57, 'Новая заявка', 'Анастасия принял вашу заявку на проект Стол и мягкий стул', NULL, 90, 9, '2024-08-19 10:11:49', '2024-08-19 10:11:49', NULL),
(208, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 90, NULL, '2024-08-19 10:12:04', '2024-08-19 10:12:04', NULL),
(209, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:13:13', '2024-08-21 13:49:50', NULL),
(210, 26, 'Новая заявка', 'Анастасия принял вашу заявку на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 2, 9, '2024-08-19 10:14:53', '2024-08-19 10:14:53', NULL),
(211, 26, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 2, NULL, '2024-08-19 10:15:18', '2024-08-19 10:15:18', NULL),
(213, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-19 10:17:38', '2024-08-21 13:49:50', NULL),
(214, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-19 10:17:43', '2024-08-21 13:49:50', NULL),
(216, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:18:57', '2024-08-21 13:49:50', NULL),
(219, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:49:00', 90, NULL, '2024-08-19 10:21:20', '2024-08-21 13:49:49', NULL),
(220, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:21:54', '2024-08-21 13:49:49', NULL),
(221, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:49:00', 20, 36, '2024-08-19 10:21:56', '2024-08-21 13:49:48', NULL),
(222, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-19 10:25:27', '2024-08-21 13:49:48', NULL),
(225, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-19 10:28:07', '2024-08-21 13:49:48', NULL),
(226, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 90, NULL, '2024-08-19 10:29:25', '2024-08-19 10:29:25', NULL),
(227, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 10:30:02', '2024-08-19 10:30:02', NULL),
(228, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:31:07', '2024-08-21 13:49:48', NULL),
(229, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 10:31:58', '2024-08-19 10:31:58', NULL),
(230, 56, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Растущий стол и стул для детей', NULL, 67, 9, '2024-08-19 10:32:04', '2024-08-19 10:32:04', NULL),
(231, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Растущий стол и стул для детей', '2024-08-21 13:49:00', 67, 56, '2024-08-19 10:32:25', '2024-08-21 13:49:48', NULL),
(233, 32, 'Новая заявка', 'Анастасия принял вашу заявку на проект Футболка женская с принтом хлопок', NULL, 19, 9, '2024-08-19 10:33:17', '2024-08-19 10:33:17', NULL),
(234, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:49:00', 90, NULL, '2024-08-19 10:33:20', '2024-08-21 13:49:47', NULL),
(235, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-19 10:33:35', '2024-08-19 10:33:35', NULL),
(236, 32, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Футболка женская с принтом хлопок', NULL, 19, 9, '2024-08-19 10:33:41', '2024-08-19 10:33:41', NULL),
(237, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:34:11', '2024-08-21 13:49:47', NULL),
(238, 57, 'Новая заявка', 'Анастасия принял вашу заявку на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 94, 9, '2024-08-19 10:34:53', '2024-08-19 10:34:53', NULL),
(239, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-19 10:35:07', '2024-08-19 10:35:07', NULL),
(240, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 19, NULL, '2024-08-19 10:35:09', '2024-08-21 13:49:47', NULL),
(241, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Футболка женская с принтом хлопок', '2024-08-21 13:49:00', 19, 32, '2024-08-19 10:35:10', '2024-08-21 13:49:47', NULL),
(243, 56, 'Новая заявка', 'Анастасия принял вашу заявку на проект Футболка женская с принтом хлопок', NULL, 85, 9, '2024-08-19 10:35:47', '2024-08-19 10:35:47', NULL),
(244, 10, 'Новая заявка', 'Вам поступила новая заявка от Вадим Стукалов на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 144, 32, '2024-08-19 10:39:59', '2024-08-19 10:39:59', NULL),
(245, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-19 10:41:53', '2024-08-21 13:49:47', NULL),
(246, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 10:42:11', '2024-08-19 10:42:11', NULL),
(247, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:43:14', '2024-08-21 13:49:46', NULL),
(248, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:43:38', '2024-08-21 13:49:46', NULL),
(249, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:49:00', 94, NULL, '2024-08-19 10:44:45', '2024-08-21 13:49:46', NULL),
(250, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', '2024-08-21 13:49:00', 2, NULL, '2024-08-19 10:46:34', '2024-08-21 13:49:45', NULL),
(251, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', '2024-08-21 13:49:00', 2, NULL, '2024-08-19 10:46:37', '2024-08-21 13:49:45', NULL),
(252, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', '2024-08-21 13:49:00', 2, NULL, '2024-08-19 10:46:39', '2024-08-21 13:49:45', NULL),
(253, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-19 10:46:39', '2024-08-19 10:46:39', NULL),
(255, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 10:47:36', '2024-08-19 10:47:36', NULL),
(256, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-19 10:47:49', '2024-08-19 10:47:49', NULL),
(257, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 10:47:52', '2024-08-21 13:49:45', NULL),
(258, 56, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Футболка женская с принтом хлопок', NULL, 85, 9, '2024-08-19 10:47:58', '2024-08-19 10:47:58', NULL),
(259, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 10:48:18', '2024-08-19 10:48:18', NULL),
(260, 26, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 2, NULL, '2024-08-19 10:49:35', '2024-08-19 10:49:35', NULL),
(261, 26, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Стеллаж (комод) детский \"Лео 4\"', NULL, 2, 9, '2024-08-19 10:49:36', '2024-08-19 10:49:36', NULL),
(262, 26, 'Подтверждение', 'Селлер подтвердил выполнение проекта Стеллаж (комод) детский \"Лео 4\"', NULL, 2, 9, '2024-08-19 10:49:44', '2024-08-19 10:49:44', NULL),
(263, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:49:00', 94, NULL, '2024-08-19 10:50:07', '2024-08-21 13:49:45', NULL),
(264, 26, 'Новая заявка', 'Анастасия принял вашу заявку на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 3, 9, '2024-08-19 10:50:12', '2024-08-19 10:50:12', NULL),
(265, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вера', '2024-08-21 13:49:00', 133, NULL, '2024-08-19 11:01:29', '2024-08-21 13:49:44', NULL),
(289, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 147, 36, '2024-08-19 11:54:21', '2024-08-21 13:49:44', NULL),
(290, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 148, 36, '2024-08-19 11:54:42', '2024-08-21 13:49:44', NULL),
(291, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 149, 36, '2024-08-19 11:54:42', '2024-08-21 13:49:43', NULL),
(292, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 150, 36, '2024-08-19 11:55:20', '2024-08-21 13:49:43', NULL),
(293, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 151, 36, '2024-08-19 11:55:20', '2024-08-21 13:49:43', NULL),
(294, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 152, 36, '2024-08-19 11:55:20', '2024-08-19 11:55:20', NULL),
(295, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 153, 36, '2024-08-19 11:55:32', '2024-08-19 11:55:32', NULL),
(296, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 154, 36, '2024-08-19 11:55:32', '2024-08-21 13:49:43', NULL),
(297, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 155, 36, '2024-08-19 11:55:32', '2024-08-21 13:49:43', NULL),
(298, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 156, 36, '2024-08-19 11:55:32', '2024-08-19 11:55:32', NULL),
(299, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 157, 36, '2024-08-19 11:55:49', '2024-08-21 13:49:42', NULL),
(300, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 158, 36, '2024-08-19 11:55:49', '2024-08-19 11:55:49', NULL),
(301, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 159, 36, '2024-08-19 11:55:49', '2024-08-21 13:49:42', NULL),
(302, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 160, 36, '2024-08-19 11:55:49', '2024-08-19 11:55:49', NULL),
(303, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 161, 36, '2024-08-19 11:55:49', '2024-08-19 11:55:49', NULL),
(304, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 163, 36, '2024-08-19 11:55:58', '2024-08-21 13:49:42', NULL),
(305, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 162, 36, '2024-08-19 11:55:58', '2024-08-21 13:49:42', NULL),
(306, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 164, 36, '2024-08-19 11:55:58', '2024-08-19 11:55:58', NULL),
(307, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 165, 36, '2024-08-19 11:55:58', '2024-08-19 11:55:58', NULL);
INSERT INTO `notifications` (`id`, `user_id`, `type`, `text`, `viewed_at`, `work_id`, `from_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(308, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 166, 36, '2024-08-19 11:55:58', '2024-08-19 11:55:58', NULL),
(309, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '2024-08-21 13:49:00', 167, 36, '2024-08-19 11:55:58', '2024-08-21 13:49:41', NULL),
(310, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 168, 36, '2024-08-19 11:56:16', '2024-08-21 13:49:41', NULL),
(311, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 169, 36, '2024-08-19 11:56:16', '2024-08-21 13:49:41', NULL),
(312, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 170, 36, '2024-08-19 11:56:16', '2024-08-19 11:56:16', NULL),
(313, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 171, 36, '2024-08-19 11:56:16', '2024-08-19 11:56:16', NULL),
(314, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '2024-08-21 13:49:00', 172, 36, '2024-08-19 11:56:16', '2024-08-21 13:49:41', NULL),
(315, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 173, 36, '2024-08-19 11:56:16', '2024-08-19 11:56:16', NULL),
(316, 10, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 174, 36, '2024-08-19 11:56:16', '2024-08-19 11:56:16', NULL),
(317, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 175, 36, '2024-08-19 11:56:34', '2024-08-21 13:49:41', NULL),
(318, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной для дачи 3 мм 12 шампуров с подказанником, разборный', '2024-08-21 13:49:00', 176, 36, '2024-08-19 11:56:40', '2024-08-21 13:49:40', NULL),
(319, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 177, 36, '2024-08-19 11:56:40', '2024-08-21 13:49:40', NULL),
(320, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 178, 36, '2024-08-19 11:56:45', '2024-08-21 13:49:40', NULL),
(321, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', '2024-08-21 13:49:00', 179, 36, '2024-08-19 11:56:45', '2024-08-21 13:49:40', NULL),
(322, 9, 'Новая заявка', 'Вам поступила новая заявка от Надежда на проект Мангал складной для дачи 3 мм 12 шампуров с подказанником, разборный', '2024-08-21 13:49:00', 180, 36, '2024-08-19 11:56:45', '2024-08-21 13:49:39', NULL),
(323, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стол и мягкий стул', '2024-08-21 13:49:00', 181, 49, '2024-08-19 12:14:34', '2024-08-21 13:49:39', NULL),
(324, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 12:24:00', '2024-08-21 13:49:38', NULL),
(325, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 12:24:05', '2024-08-21 13:49:38', NULL),
(326, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 182, 46, '2024-08-19 12:25:00', '2024-08-21 13:49:38', NULL),
(327, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-19 12:31:45', '2024-08-19 12:31:45', NULL),
(329, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 12:35:31', '2024-08-19 12:35:31', NULL),
(330, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 12:35:33', '2024-08-21 13:49:38', NULL),
(331, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 12:35:38', '2024-08-19 12:35:38', NULL),
(334, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-19 12:36:28', '2024-08-19 12:36:28', NULL),
(335, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-19 12:36:44', '2024-08-19 12:36:44', NULL),
(336, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-19 12:36:48', '2024-08-19 12:36:48', NULL),
(337, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-19 12:37:18', '2024-08-19 12:37:18', NULL),
(338, 57, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Стол и мягкий стул', NULL, 90, 9, '2024-08-19 12:37:39', '2024-08-19 12:37:39', NULL),
(339, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 90, NULL, '2024-08-19 12:37:43', '2024-08-19 12:37:43', NULL),
(340, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 12:37:54', '2024-08-19 12:37:54', NULL),
(341, 26, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 2, NULL, '2024-08-19 12:38:15', '2024-08-19 12:38:15', NULL),
(342, 26, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 2, NULL, '2024-08-19 12:38:30', '2024-08-19 12:38:30', NULL),
(343, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-19 12:38:37', '2024-08-19 12:38:37', NULL),
(344, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-19 12:42:57', '2024-08-19 12:42:57', NULL),
(345, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-19 12:43:25', '2024-08-19 12:43:25', NULL),
(347, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 12:51:46', '2024-08-21 13:49:38', NULL),
(349, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 12:52:01', '2024-08-21 13:49:37', NULL),
(350, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 56, NULL, '2024-08-19 12:52:13', '2024-08-19 12:52:13', NULL),
(351, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 12:52:16', '2024-08-21 13:49:37', NULL),
(352, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 56, NULL, '2024-08-19 12:53:26', '2024-08-19 12:53:26', NULL),
(353, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-19 12:54:45', '2024-08-19 12:54:45', NULL),
(354, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 12:55:03', '2024-08-19 12:55:03', NULL),
(355, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-19 12:55:09', '2024-08-19 12:55:09', NULL),
(356, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-19 12:56:36', '2024-08-19 12:56:36', NULL),
(357, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 12:57:11', '2024-08-19 12:57:11', NULL),
(358, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 12:57:18', '2024-08-19 12:57:18', NULL),
(359, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, 1, NULL, '2024-08-19 12:57:22', '2024-08-19 12:57:22', NULL),
(360, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-19 12:58:05', '2024-08-19 12:58:05', NULL),
(361, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-19 12:59:00', '2024-08-19 12:59:00', NULL),
(362, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-19 12:59:13', '2024-08-19 12:59:13', NULL),
(363, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-19 12:59:23', '2024-08-19 12:59:23', NULL),
(364, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-19 12:59:29', '2024-08-19 12:59:29', NULL),
(365, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 12:59:53', '2024-08-19 12:59:53', NULL),
(366, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-19 12:59:57', '2024-08-19 12:59:57', NULL),
(367, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 12:59:57', '2024-08-19 12:59:57', NULL),
(368, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-19 13:00:08', '2024-08-19 13:00:08', NULL),
(369, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-19 13:00:11', '2024-08-19 13:00:11', NULL),
(370, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, 1, NULL, '2024-08-19 13:00:37', '2024-08-19 13:00:37', NULL),
(371, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 13:00:46', '2024-08-21 13:49:37', NULL),
(372, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 13:00:59', '2024-08-21 13:49:36', NULL),
(373, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-19 13:01:35', '2024-08-19 13:01:35', NULL),
(374, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', '2024-08-21 13:49:00', 2, NULL, '2024-08-19 13:28:30', '2024-08-21 13:49:36', NULL),
(375, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Футболка женская с принтом хлопок', '2024-08-21 13:49:00', 85, 56, '2024-08-19 16:17:55', '2024-08-21 13:49:36', NULL),
(376, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-19 16:20:45', '2024-08-21 13:49:36', NULL),
(377, 10, 'Согласование проекта', 'Надежда готов приступить к работе по проекту Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 174, 36, '2024-08-19 17:53:22', '2024-08-19 17:53:22', NULL),
(378, 31, 'Новая заявка', 'Вам поступила новая заявка от Виктория на проект Брюки школьные классические палаццо', NULL, 183, 44, '2024-08-19 18:17:36', '2024-08-19 18:17:36', NULL),
(379, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 184, 52, '2024-08-19 18:27:00', '2024-08-21 13:49:36', NULL),
(380, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 185, 52, '2024-08-19 18:27:13', '2024-08-21 13:49:35', NULL),
(381, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 186, 52, '2024-08-19 18:27:14', '2024-08-21 13:49:35', NULL),
(382, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 187, 52, '2024-08-19 18:27:27', '2024-08-21 13:49:35', NULL),
(383, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 188, 52, '2024-08-19 18:27:27', '2024-08-21 13:49:35', NULL),
(384, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 189, 52, '2024-08-19 18:27:27', '2024-08-21 13:49:34', NULL),
(385, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 191, 52, '2024-08-19 18:27:33', '2024-08-21 13:49:34', NULL),
(386, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 190, 52, '2024-08-19 18:27:33', '2024-08-21 13:49:33', NULL),
(387, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 192, 52, '2024-08-19 18:27:33', '2024-08-21 13:49:33', NULL),
(388, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кровать детская', '2024-08-21 13:49:00', 193, 52, '2024-08-19 18:27:33', '2024-08-21 13:49:33', NULL),
(389, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 194, 52, '2024-08-19 18:27:40', '2024-08-21 13:49:33', NULL),
(390, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 195, 52, '2024-08-19 18:27:40', '2024-08-21 13:49:32', NULL),
(391, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 196, 52, '2024-08-19 18:27:40', '2024-08-21 13:49:32', NULL),
(392, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кровать детская', '2024-08-21 13:49:00', 197, 52, '2024-08-19 18:27:40', '2024-08-21 13:49:32', NULL),
(393, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 198, 52, '2024-08-19 18:27:40', '2024-08-21 13:49:32', NULL),
(394, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 199, 52, '2024-08-19 18:27:45', '2024-08-21 13:49:31', NULL),
(395, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 200, 52, '2024-08-19 18:27:45', '2024-08-21 13:49:31', NULL),
(396, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 201, 52, '2024-08-19 18:27:45', '2024-08-21 13:49:31', NULL),
(397, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 202, 52, '2024-08-19 18:27:45', '2024-08-21 13:49:31', NULL),
(398, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кровать детская', '2024-08-21 13:49:00', 203, 52, '2024-08-19 18:27:45', '2024-08-21 13:49:31', NULL),
(399, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Мольберт детский', '2024-08-21 13:49:00', 204, 52, '2024-08-19 18:27:45', '2024-08-21 13:49:30', NULL),
(400, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 206, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:30', NULL),
(401, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 205, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:30', NULL),
(402, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 207, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:30', NULL),
(403, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 208, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:29', NULL),
(404, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кровать детская', '2024-08-21 13:49:00', 209, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:29', NULL),
(405, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Мольберт детский', '2024-08-21 13:49:00', 210, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:28', NULL),
(406, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:49:00', 211, 52, '2024-08-19 18:27:50', '2024-08-21 13:49:28', NULL),
(407, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 212, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:28', NULL),
(408, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 213, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:28', NULL),
(409, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 214, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:27', NULL),
(410, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кровать детская', '2024-08-21 13:49:00', 215, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:27', NULL),
(411, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 216, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:27', NULL),
(412, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Мольберт детский', '2024-08-21 13:49:00', 217, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:27', NULL),
(413, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:49:00', 218, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:27', NULL),
(414, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:49:00', 219, 52, '2024-08-19 18:28:00', '2024-08-21 13:49:26', NULL),
(415, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 220, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:26', NULL),
(416, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:49:00', 221, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:26', NULL),
(417, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кровать детская', '2024-08-21 13:49:00', 222, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:26', NULL),
(418, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 223, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:26', NULL),
(419, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Кроватка с мягким изголовьем', '2024-08-21 13:49:00', 224, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:25', NULL),
(420, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стол и мягкий стул', '2024-08-21 13:49:00', 225, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:25', NULL),
(421, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Мольберт детский', '2024-08-21 13:49:00', 226, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:25', NULL),
(422, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:49:00', 227, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:25', NULL),
(423, 9, 'Новая заявка', 'Вам поступила новая заявка от Лилияна на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:49:00', 228, 52, '2024-08-19 18:28:14', '2024-08-21 13:49:25', NULL),
(424, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-19 18:35:00', '2024-08-19 18:35:00', NULL),
(426, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-19 18:37:26', '2024-08-19 18:37:26', NULL),
(427, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 85, NULL, '2024-08-19 18:42:57', '2024-08-19 18:42:57', NULL),
(428, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-19 18:43:21', '2024-08-19 18:43:21', NULL),
(429, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 19, NULL, '2024-08-19 18:43:59', '2024-08-21 13:49:24', NULL),
(430, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 19, NULL, '2024-08-19 18:44:10', '2024-08-21 13:49:24', NULL),
(431, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:49:00', 20, NULL, '2024-08-19 18:44:43', '2024-08-21 13:49:23', NULL),
(432, 9, 'Новая заявка', 'Вам поступила новая заявка от Анаит на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 229, 69, '2024-08-19 18:45:43', '2024-08-21 13:49:23', NULL),
(433, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 19:20:04', '2024-08-21 13:49:23', NULL),
(434, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 19:20:05', '2024-08-21 13:49:23', NULL),
(435, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:49:00', 54, NULL, '2024-08-19 19:22:30', '2024-08-21 13:49:23', NULL),
(436, 9, 'Новая заявка', 'Вам поступила новая заявка от Яна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 230, 72, '2024-08-19 22:21:59', '2024-08-21 13:49:22', NULL),
(437, 31, 'Новая заявка', 'Вам поступила новая заявка от Яна на проект Брюки школьные классические палаццо', NULL, 232, 72, '2024-08-19 22:22:54', '2024-08-19 22:22:54', NULL),
(438, 9, 'Новая заявка', 'Вам поступила новая заявка от Яна на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 231, 72, '2024-08-19 22:22:54', '2024-08-21 13:49:22', NULL),
(439, 31, 'Новая заявка', 'Вам поступила новая заявка от Анаит на проект Брюки школьные классические палаццо', NULL, 233, 69, '2024-08-20 01:08:00', '2024-08-20 01:08:00', NULL),
(442, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-20 06:31:03', '2024-08-20 06:31:03', NULL),
(443, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-20 06:31:07', '2024-08-20 06:31:07', NULL),
(444, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 13, NULL, '2024-08-20 06:43:28', '2024-08-20 06:43:28', NULL),
(445, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-20 06:48:34', '2024-08-20 06:48:34', NULL),
(446, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', NULL, 13, NULL, '2024-08-20 06:49:31', '2024-08-20 06:49:31', NULL),
(447, 18, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 234, 10, '2024-08-20 07:48:53', '2024-08-20 07:48:53', NULL),
(448, 26, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 235, 10, '2024-08-20 07:49:49', '2024-08-20 07:49:49', NULL),
(449, 43, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 236, 10, '2024-08-20 07:50:04', '2024-08-20 07:50:04', NULL),
(450, 30, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 237, 10, '2024-08-20 07:50:25', '2024-08-20 07:50:25', NULL),
(451, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-20 08:46:21', '2024-08-20 08:46:21', NULL),
(452, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-20 08:47:51', '2024-08-20 08:47:51', NULL),
(453, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-20 08:48:02', '2024-08-20 08:48:02', NULL),
(454, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-20 08:48:16', '2024-08-20 08:48:16', NULL),
(455, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-20 08:48:55', '2024-08-20 08:48:55', NULL),
(456, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 19, NULL, '2024-08-20 08:52:26', '2024-08-21 13:49:22', NULL),
(457, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 19, NULL, '2024-08-20 08:52:55', '2024-08-21 13:49:22', NULL),
(458, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-20 08:53:39', '2024-08-20 08:53:39', NULL),
(459, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-20 08:54:34', '2024-08-21 13:49:22', NULL),
(460, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:49:00', 7, NULL, '2024-08-20 08:54:54', '2024-08-21 13:49:21', NULL),
(461, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-20 09:46:45', '2024-08-21 13:49:21', NULL),
(462, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-20 09:48:03', '2024-08-21 13:49:21', NULL),
(463, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 85, NULL, '2024-08-20 09:50:32', '2024-08-21 13:49:21', NULL),
(464, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:49:00', 67, NULL, '2024-08-20 09:50:56', '2024-08-21 13:49:20', NULL),
(465, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:49:00', 94, NULL, '2024-08-20 10:18:34', '2024-08-21 13:49:19', NULL),
(466, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:49:00', 94, NULL, '2024-08-20 10:18:44', '2024-08-21 13:49:19', NULL),
(467, 31, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Брюки школьные классические палаццо', NULL, 238, 73, '2024-08-20 11:59:51', '2024-08-20 11:59:51', NULL),
(468, 31, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Брюки школьные классические палаццо', NULL, 239, 73, '2024-08-20 12:00:20', '2024-08-20 12:00:20', NULL),
(469, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:49:00', 240, 73, '2024-08-20 12:00:20', '2024-08-21 13:49:14', NULL),
(470, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 241, 78, '2024-08-20 12:02:09', '2024-08-21 13:49:19', NULL),
(471, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 242, 78, '2024-08-20 12:02:26', '2024-08-21 13:49:13', NULL),
(472, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 243, 78, '2024-08-20 12:02:26', '2024-08-21 13:49:13', NULL),
(473, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 244, 78, '2024-08-20 12:02:35', '2024-08-20 12:02:35', NULL),
(474, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 245, 78, '2024-08-20 12:02:35', '2024-08-21 13:49:13', NULL),
(475, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 246, 78, '2024-08-20 12:02:35', '2024-08-21 13:49:12', NULL),
(476, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 247, 78, '2024-08-20 12:02:43', '2024-08-20 12:02:43', NULL),
(477, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 248, 78, '2024-08-20 12:02:43', '2024-08-21 13:49:12', NULL),
(478, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 249, 78, '2024-08-20 12:02:43', '2024-08-21 13:49:12', NULL),
(479, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 250, 78, '2024-08-20 12:02:43', '2024-08-20 12:02:43', NULL),
(480, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 251, 78, '2024-08-20 12:02:53', '2024-08-21 13:49:11', NULL),
(481, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 252, 78, '2024-08-20 12:02:53', '2024-08-21 13:49:11', NULL),
(482, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 253, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(483, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 254, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(484, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 255, 78, '2024-08-20 12:02:53', '2024-08-21 13:49:10', NULL),
(485, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 256, 78, '2024-08-20 12:02:58', '2024-08-21 13:49:10', NULL),
(486, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 257, 78, '2024-08-20 12:02:58', '2024-08-21 13:49:10', NULL),
(487, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 258, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(488, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 259, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(489, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 260, 78, '2024-08-20 12:02:58', '2024-08-21 13:49:10', NULL),
(490, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 261, 78, '2024-08-20 12:02:58', '2024-08-21 13:49:09', NULL),
(491, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 262, 78, '2024-08-20 12:03:12', '2024-08-21 13:49:08', NULL),
(492, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 263, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(493, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 264, 78, '2024-08-20 12:03:12', '2024-08-21 13:49:08', NULL),
(494, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 265, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(495, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 266, 78, '2024-08-20 12:03:12', '2024-08-21 13:49:08', NULL),
(496, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 267, 78, '2024-08-20 12:03:12', '2024-08-21 13:49:08', NULL),
(497, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:49:00', 268, 78, '2024-08-20 12:03:12', '2024-08-21 13:49:08', NULL),
(498, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 270, 78, '2024-08-20 12:03:22', '2024-08-21 13:49:07', NULL),
(499, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 269, 78, '2024-08-20 12:03:22', '2024-08-21 13:49:07', NULL),
(500, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 271, 78, '2024-08-20 12:03:22', '2024-08-20 12:03:22', NULL),
(501, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 272, 78, '2024-08-20 12:03:23', '2024-08-20 12:03:23', NULL),
(502, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:49:00', 273, 78, '2024-08-20 12:03:23', '2024-08-21 13:49:07', NULL),
(503, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 274, 78, '2024-08-20 12:03:23', '2024-08-21 13:49:07', NULL),
(504, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 275, 78, '2024-08-20 12:03:23', '2024-08-21 13:49:06', NULL),
(505, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:49:00', 276, 78, '2024-08-20 12:03:23', '2024-08-21 13:49:06', NULL),
(506, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 277, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:06', NULL),
(507, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 278, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:06', NULL),
(508, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 279, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(509, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 280, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(510, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 281, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:06', NULL),
(511, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 282, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:05', NULL),
(512, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:49:00', 283, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:05', NULL),
(513, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 284, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:05', NULL),
(514, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:49:00', 285, 78, '2024-08-20 12:03:30', '2024-08-21 13:49:05', NULL),
(515, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 286, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:05', NULL),
(516, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 287, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:04', NULL),
(517, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 288, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(518, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 289, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(519, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 290, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:03', NULL),
(520, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 291, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:03', NULL),
(521, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:49:00', 292, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:03', NULL),
(522, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:49:00', 293, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:03', NULL),
(523, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 294, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:02', NULL),
(524, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:49:00', 295, 78, '2024-08-20 12:03:53', '2024-08-21 13:49:02', NULL),
(525, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:49:00', 296, 78, '2024-08-20 12:03:58', '2024-08-21 13:49:02', NULL),
(526, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 297, 78, '2024-08-20 12:03:58', '2024-08-21 13:49:01', NULL),
(527, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 298, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(528, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 299, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(529, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 300, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:01', NULL),
(530, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 301, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:01', NULL),
(531, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:49:00', 302, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:01', NULL),
(532, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:49:00', 303, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:01', NULL),
(533, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:49:00', 304, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:01', NULL),
(534, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:49:00', 305, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:00', NULL),
(535, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:49:00', 306, 78, '2024-08-20 12:03:59', '2024-08-21 13:49:00', NULL),
(536, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:49:00', 307, 78, '2024-08-20 12:04:06', '2024-08-21 13:49:00', NULL),
(537, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:49:00', 308, 78, '2024-08-20 12:04:06', '2024-08-21 13:49:00', NULL),
(538, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 309, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(539, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 310, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:59', NULL),
(540, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:49:00', 311, 78, '2024-08-20 12:04:06', '2024-08-21 13:49:00', NULL),
(541, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 312, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(542, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 313, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:58', NULL),
(543, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 314, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:58', NULL),
(544, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 315, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:58', NULL),
(545, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 316, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:58', NULL),
(546, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 317, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:58', NULL),
(547, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 318, 78, '2024-08-20 12:04:06', '2024-08-21 13:48:57', NULL),
(548, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:48:00', 319, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:57', NULL),
(549, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 320, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(550, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 321, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:57', NULL),
(551, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:48:00', 322, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:57', NULL),
(552, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 323, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(553, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:48:00', 324, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:57', NULL),
(554, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 325, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:56', NULL),
(555, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 326, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:56', NULL),
(556, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 327, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:56', NULL),
(557, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 328, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:55', NULL),
(558, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 329, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:54', NULL),
(559, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 330, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:48', NULL),
(560, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:48:00', 331, 78, '2024-08-20 12:04:10', '2024-08-21 13:48:48', NULL),
(561, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:48:00', 332, 78, '2024-08-20 12:04:18', '2024-08-21 13:48:48', NULL),
(562, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:48:00', 333, 78, '2024-08-20 12:04:18', '2024-08-21 13:48:47', NULL),
(563, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 334, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:47', NULL),
(564, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 335, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:47', NULL),
(565, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 336, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(566, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 337, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(567, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:48:00', 338, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:47', NULL),
(568, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 339, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:46', NULL),
(569, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 340, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:40', NULL),
(570, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 341, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:40', NULL),
(571, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:48:00', 342, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:39', NULL),
(572, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 343, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:40', NULL),
(573, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 344, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:38', NULL),
(574, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 345, 78, '2024-08-20 12:04:19', '2024-08-21 13:48:38', NULL),
(575, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 346, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:38', NULL),
(576, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:48:00', 347, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:38', NULL),
(577, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 348, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(578, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 349, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(579, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:48:00', 350, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:37', NULL),
(580, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 351, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:37', NULL),
(581, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 352, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:37', NULL),
(582, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 353, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:37', NULL),
(583, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 354, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:37', NULL);
INSERT INTO `notifications` (`id`, `user_id`, `type`, `text`, `viewed_at`, `work_id`, `from_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(584, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 355, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:36', NULL),
(585, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:48:00', 356, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:36', NULL),
(586, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:48:00', 357, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:36', NULL),
(587, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 358, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:36', NULL),
(588, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 359, 78, '2024-08-20 12:04:25', '2024-08-21 13:48:35', NULL),
(589, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 360, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(590, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 361, 78, '2024-08-20 12:05:00', '2024-08-21 13:48:35', NULL),
(591, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:48:00', 362, 78, '2024-08-20 12:05:00', '2024-08-21 13:48:35', NULL),
(592, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 363, 78, '2024-08-20 12:05:00', '2024-08-21 13:48:35', NULL),
(593, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 364, 78, '2024-08-20 12:05:00', '2024-08-21 13:48:33', NULL),
(594, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 365, 78, '2024-08-20 12:05:00', '2024-08-21 13:48:33', NULL),
(595, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 366, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(596, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 367, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(597, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:48:00', 368, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:33', NULL),
(598, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 369, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:33', NULL),
(599, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:48:00', 370, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:33', NULL),
(600, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 371, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:32', NULL),
(601, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 372, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:32', NULL),
(602, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 373, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(603, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 374, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:32', NULL),
(604, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 375, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:32', NULL),
(605, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:48:00', 376, 78, '2024-08-20 12:05:01', '2024-08-21 13:48:32', NULL),
(606, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 377, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:32', NULL),
(607, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:48:00', 378, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:31', NULL),
(608, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 379, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(609, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 380, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(610, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 381, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:31', NULL),
(611, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:48:00', 382, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:31', NULL),
(612, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 383, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:31', NULL),
(613, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 384, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:31', NULL),
(614, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 385, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:31', NULL),
(615, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:48:00', 386, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:30', NULL),
(616, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 387, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:30', NULL),
(617, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 388, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:30', NULL),
(618, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 389, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:30', NULL),
(619, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:48:00', 390, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:30', NULL),
(620, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 392, 78, '2024-08-20 12:05:10', '2024-08-21 13:48:29', NULL),
(621, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 391, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(622, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 393, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(623, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 394, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:28', NULL),
(624, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-21 13:48:00', 395, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:28', NULL),
(625, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '2024-08-21 13:48:00', 396, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:28', NULL),
(626, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 397, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(627, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский туалетный столик и стул зайка', '2024-08-21 13:48:00', 398, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:28', NULL),
(628, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 399, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:28', NULL),
(629, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '2024-08-21 13:48:00', 400, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:27', NULL),
(630, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 401, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:27', NULL),
(631, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 402, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(632, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 403, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:27', NULL),
(633, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол Монтессори', '2024-08-21 13:48:00', 404, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:27', NULL),
(634, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Детский стол и стул для игр и рисования', '2024-08-21 13:48:00', 405, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:26', NULL),
(635, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '2024-08-21 13:48:00', 406, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:26', NULL),
(636, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 407, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:26', NULL),
(637, 9, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 408, 78, '2024-08-20 12:05:15', '2024-08-21 13:48:26', NULL),
(638, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 409, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(639, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 410, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(640, 10, 'Новая заявка', 'Вам поступила новая заявка от Лидия на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 411, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(641, 9, 'Новая заявка', 'Вам поступила новая заявка от София Цыбиз на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 412, 75, '2024-08-20 12:34:10', '2024-08-21 13:48:26', NULL),
(642, 9, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 413, 76, '2024-08-20 12:36:40', '2024-08-21 13:48:25', NULL),
(643, 9, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Футболка женская с принтом хлопок', '2024-08-21 13:48:00', 414, 76, '2024-08-20 12:37:22', '2024-08-21 13:48:25', NULL),
(644, 31, 'Новая заявка', 'Вам поступила новая заявка от Арина на проект Брюки школьные классические палаццо', NULL, 415, 76, '2024-08-20 12:37:23', '2024-08-20 12:37:23', NULL),
(645, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-20 14:27:05', '2024-08-21 13:48:25', NULL),
(646, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Мольберт детский', '2024-08-21 13:48:00', 416, 46, '2024-08-20 22:28:29', '2024-08-21 13:48:25', NULL),
(647, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 417, 81, '2024-08-21 04:59:10', '2024-08-21 13:48:25', NULL),
(648, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 418, 81, '2024-08-21 04:59:30', '2024-08-21 13:48:23', NULL),
(649, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 419, 81, '2024-08-21 04:59:30', '2024-08-21 13:48:23', NULL),
(650, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 420, 81, '2024-08-21 04:59:54', '2024-08-21 13:48:23', NULL),
(651, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 421, 81, '2024-08-21 04:59:54', '2024-08-21 13:48:23', NULL),
(652, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '2024-08-21 13:48:00', 422, 81, '2024-08-21 04:59:54', '2024-08-21 13:48:23', NULL),
(653, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 423, 81, '2024-08-21 05:00:06', '2024-08-21 13:48:22', NULL),
(654, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 424, 81, '2024-08-21 05:00:06', '2024-08-21 13:48:22', NULL),
(655, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '2024-08-21 13:48:00', 425, 81, '2024-08-21 05:00:06', '2024-08-21 13:48:22', NULL),
(656, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 426, 81, '2024-08-21 05:00:06', '2024-08-21 13:48:22', NULL),
(657, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 427, 81, '2024-08-21 05:00:27', '2024-08-21 13:48:22', NULL),
(658, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 428, 81, '2024-08-21 05:00:27', '2024-08-21 13:48:21', NULL),
(659, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '2024-08-21 13:48:00', 429, 81, '2024-08-21 05:00:27', '2024-08-21 13:48:21', NULL),
(660, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 430, 81, '2024-08-21 05:00:27', '2024-08-21 13:48:21', NULL),
(661, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-21 13:48:00', 431, 81, '2024-08-21 05:00:27', '2024-08-21 13:48:21', NULL),
(662, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-21 13:48:00', 432, 81, '2024-08-21 05:01:00', '2024-08-21 13:48:20', NULL),
(663, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Арка садовая металлическая, пергола, шпалера', '2024-08-21 13:48:00', 433, 81, '2024-08-21 05:01:00', '2024-08-21 13:48:20', NULL),
(664, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стол и мягкий стул', '2024-08-21 13:48:00', 434, 81, '2024-08-21 05:01:00', '2024-08-21 13:48:20', NULL),
(665, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '2024-08-21 13:48:00', 435, 81, '2024-08-21 05:01:00', '2024-08-21 13:48:19', NULL),
(666, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-21 13:48:00', 436, 81, '2024-08-21 05:01:00', '2024-08-21 13:48:20', NULL),
(667, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-21 13:48:00', 437, 81, '2024-08-21 05:01:00', '2024-08-21 13:48:18', NULL),
(668, 31, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Брюки школьные классические палаццо', NULL, 438, 81, '2024-08-21 05:03:06', '2024-08-21 05:03:06', NULL),
(669, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-21 08:54:02', '2024-08-21 08:54:02', NULL),
(670, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-21 08:58:20', '2024-08-21 08:58:20', NULL),
(671, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-21 09:01:11', '2024-08-21 09:01:11', NULL),
(672, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-21 09:04:11', '2024-08-21 09:04:11', NULL),
(673, 57, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 94, 9, '2024-08-21 09:04:20', '2024-08-21 09:04:20', NULL),
(674, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 67, NULL, '2024-08-21 09:04:44', '2024-08-21 09:04:44', NULL),
(675, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 19, NULL, '2024-08-21 09:09:48', '2024-08-21 13:48:18', NULL),
(676, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 09:10:12', '2024-08-21 13:48:18', NULL),
(677, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 09:10:15', '2024-08-21 13:48:18', NULL),
(678, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 09:10:20', '2024-08-21 13:48:18', NULL),
(679, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 09:10:38', '2024-08-21 13:48:17', NULL),
(680, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 09:10:42', '2024-08-21 13:48:17', NULL),
(681, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 09:10:58', '2024-08-21 13:48:17', NULL),
(682, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Кристина', '2024-08-21 13:48:00', 67, NULL, '2024-08-21 09:11:00', '2024-08-21 13:48:17', NULL),
(683, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 09:11:40', '2024-08-21 13:48:17', NULL),
(684, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 85, NULL, '2024-08-21 09:17:16', '2024-08-21 09:17:16', NULL),
(685, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 19, NULL, '2024-08-21 09:17:35', '2024-08-21 09:17:35', NULL),
(686, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 19, NULL, '2024-08-21 09:17:49', '2024-08-21 13:48:16', NULL),
(687, 56, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 85, NULL, '2024-08-21 09:21:27', '2024-08-21 09:21:27', NULL),
(688, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-21 10:02:29', '2024-08-21 10:02:29', NULL),
(689, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 90, NULL, '2024-08-21 10:02:54', '2024-08-21 10:02:54', NULL),
(690, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 10:06:28', '2024-08-21 13:48:16', NULL),
(691, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-21 10:08:06', '2024-08-21 10:08:06', NULL),
(692, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 90, NULL, '2024-08-21 10:09:09', '2024-08-21 13:48:16', NULL),
(693, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-21 13:48:00', 94, 57, '2024-08-21 10:09:31', '2024-08-21 13:48:16', NULL),
(694, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Стол и мягкий стул', '2024-08-21 13:48:00', 90, 57, '2024-08-21 10:09:41', '2024-08-21 13:48:15', NULL),
(695, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 94, NULL, '2024-08-21 10:10:39', '2024-08-21 13:48:15', NULL),
(696, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 94, NULL, '2024-08-21 10:22:51', '2024-08-21 10:22:51', NULL),
(697, 57, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 90, NULL, '2024-08-21 10:23:07', '2024-08-21 10:23:07', NULL),
(698, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-21 10:26:24', '2024-08-21 10:26:24', NULL),
(699, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 10:27:11', '2024-08-21 13:48:15', NULL),
(700, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 10:27:23', '2024-08-21 13:48:13', NULL),
(702, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:48:00', 20, NULL, '2024-08-21 10:30:11', '2024-08-21 13:48:14', NULL),
(703, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:48:00', 20, NULL, '2024-08-21 10:31:05', '2024-08-21 13:48:08', NULL),
(704, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 10:31:10', '2024-08-21 13:48:08', NULL),
(705, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 10:31:12', '2024-08-21 13:48:08', NULL),
(706, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:48:00', 20, NULL, '2024-08-21 10:31:13', '2024-08-21 13:48:07', NULL),
(707, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:48:00', 20, NULL, '2024-08-21 10:31:33', '2024-08-21 13:48:07', NULL),
(708, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 10:31:45', '2024-08-21 13:48:07', NULL),
(709, 32, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 7, NULL, '2024-08-21 10:32:11', '2024-08-21 10:32:11', NULL),
(711, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 54, NULL, '2024-08-21 10:39:46', '2024-08-21 10:39:46', NULL),
(712, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Алёна', '2024-08-21 13:48:00', 90, NULL, '2024-08-21 10:40:02', '2024-08-21 13:48:06', NULL),
(713, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', '2024-08-21 13:48:00', 20, NULL, '2024-08-21 10:41:12', '2024-08-21 13:48:02', NULL),
(714, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Вадим Стукалов', '2024-08-21 13:48:00', 7, NULL, '2024-08-21 10:56:54', '2024-08-21 13:48:02', NULL),
(715, 46, 'Новая заявка', 'Анастасия принял вашу заявку на проект Кровать детская', NULL, 60, 9, '2024-08-21 12:29:46', '2024-08-21 12:29:46', NULL),
(716, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 60, NULL, '2024-08-21 12:30:07', '2024-08-21 12:30:07', NULL),
(717, 46, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Кровать детская', NULL, 60, 9, '2024-08-21 12:30:09', '2024-08-21 12:30:09', NULL),
(718, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Кровать детская', '2024-08-21 13:48:00', 60, 46, '2024-08-21 12:32:04', '2024-08-21 13:48:01', NULL),
(719, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:48:00', 60, NULL, '2024-08-21 12:34:03', '2024-08-21 13:48:00', NULL),
(720, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', '2024-08-21 13:48:00', 54, NULL, '2024-08-21 12:34:27', '2024-08-21 13:48:06', NULL),
(721, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 60, NULL, '2024-08-21 12:34:57', '2024-08-21 12:34:57', NULL),
(722, 46, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Арка садовая металлическая, пергола, шпалера', NULL, 54, 9, '2024-08-21 13:47:20', '2024-08-21 13:47:20', NULL),
(723, 18, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', NULL, 439, 9, '2024-08-21 13:51:12', '2024-08-21 13:51:12', NULL),
(724, 23, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', NULL, 440, 9, '2024-08-21 13:51:20', '2024-08-21 13:51:20', NULL),
(726, 10, 'Новая заявка', 'Вам поступила новая заявка от Лина на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 442, 94, '2024-08-21 15:51:50', '2024-08-21 15:51:50', NULL),
(727, 18, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 443, 9, '2024-08-21 16:02:38', '2024-08-21 16:02:38', NULL),
(728, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 444, 96, '2024-08-21 16:45:57', '2024-08-22 06:47:18', NULL),
(729, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 445, 96, '2024-08-21 16:45:57', '2024-08-21 16:45:57', NULL),
(730, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 447, 96, '2024-08-21 16:46:08', '2024-08-21 16:46:08', NULL),
(731, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 446, 96, '2024-08-21 16:46:08', '2024-08-22 06:47:19', NULL),
(732, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 448, 96, '2024-08-21 16:46:08', '2024-08-22 06:47:17', NULL),
(733, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 449, 96, '2024-08-21 16:46:33', '2024-08-22 06:47:17', NULL),
(734, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 450, 96, '2024-08-21 16:46:33', '2024-08-21 16:46:33', NULL),
(735, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Растущий стол и стул для детей', '2024-08-22 06:47:00', 451, 96, '2024-08-21 16:46:33', '2024-08-22 06:47:15', NULL),
(736, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 452, 96, '2024-08-21 16:46:33', '2024-08-22 06:47:14', NULL),
(737, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 453, 96, '2024-08-21 16:46:42', '2024-08-22 06:47:14', NULL),
(738, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 454, 96, '2024-08-21 16:46:42', '2024-08-21 16:46:42', NULL),
(739, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 455, 96, '2024-08-21 16:46:42', '2024-08-22 06:47:14', NULL),
(740, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Растущий стол и стул для детей', '2024-08-22 06:47:00', 456, 96, '2024-08-21 16:46:42', '2024-08-22 06:47:13', NULL),
(741, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стол и мягкий стул', '2024-08-22 06:47:00', 457, 96, '2024-08-21 16:46:42', '2024-08-22 06:47:13', NULL),
(742, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 458, 96, '2024-08-21 16:46:59', '2024-08-21 16:46:59', NULL),
(743, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 459, 96, '2024-08-21 16:46:59', '2024-08-22 06:47:13', NULL),
(744, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 460, 96, '2024-08-21 16:46:59', '2024-08-22 06:47:12', NULL),
(745, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Растущий стол и стул для детей', '2024-08-22 06:47:00', 461, 96, '2024-08-21 16:46:59', '2024-08-22 06:47:12', NULL),
(746, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-22 06:47:00', 462, 96, '2024-08-21 16:47:00', '2024-08-22 06:47:12', NULL),
(747, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стол и мягкий стул', '2024-08-22 06:47:00', 463, 96, '2024-08-21 16:47:00', '2024-08-22 06:47:12', NULL),
(748, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 464, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(749, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 465, 96, '2024-08-21 16:47:09', '2024-08-22 06:47:11', NULL),
(750, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Растущий стол и стул для детей', '2024-08-22 06:47:00', 466, 96, '2024-08-21 16:47:09', '2024-08-22 06:47:11', NULL),
(751, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стол и мягкий стул', '2024-08-22 06:47:00', 467, 96, '2024-08-21 16:47:09', '2024-08-22 06:47:11', NULL),
(752, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 468, 96, '2024-08-21 16:47:09', '2024-08-22 06:47:11', NULL),
(753, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кровать детская', '2024-08-22 06:47:00', 469, 96, '2024-08-21 16:47:09', '2024-08-22 06:47:10', NULL),
(754, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-22 06:47:00', 470, 96, '2024-08-21 16:47:09', '2024-08-22 06:47:10', NULL),
(755, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 472, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:10', NULL),
(756, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 471, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(757, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Растущий стол и стул для детей', '2024-08-22 06:47:00', 473, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:10', NULL),
(758, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 474, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:09', NULL),
(759, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стол и мягкий стул', '2024-08-22 06:47:00', 476, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:09', NULL),
(760, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-22 06:47:00', 475, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:09', NULL),
(761, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-22 06:47:00', 477, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:08', NULL),
(762, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кровать детская', '2024-08-22 06:47:00', 478, 96, '2024-08-21 16:47:22', '2024-08-22 06:47:08', NULL),
(763, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '2024-08-22 06:47:00', 479, 96, '2024-08-21 16:47:59', '2024-08-22 06:47:07', NULL),
(764, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 480, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(765, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 481, 96, '2024-08-21 16:47:59', '2024-08-22 06:47:07', NULL),
(766, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стол и мягкий стул', '2024-08-22 06:47:00', 482, 96, '2024-08-21 16:47:59', '2024-08-22 06:47:06', NULL),
(767, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Растущий стол и стул для детей', '2024-08-22 06:47:00', 483, 96, '2024-08-21 16:47:59', '2024-08-22 06:47:06', NULL),
(768, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Стеллаж (комод) детский \"Лео 4\"', '2024-08-22 06:47:00', 485, 96, '2024-08-21 16:47:59', '2024-08-22 06:47:05', NULL),
(769, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Кровать детская', '2024-08-22 06:47:00', 484, 96, '2024-08-21 16:47:59', '2024-08-22 06:47:05', NULL),
(770, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-22 06:47:00', 486, 96, '2024-08-21 16:48:00', '2024-08-22 06:47:05', NULL),
(771, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Детский туалетный столик и стул зайка', '2024-08-22 06:47:00', 487, 96, '2024-08-21 16:48:00', '2024-08-22 06:47:05', NULL),
(772, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-22 06:47:00', 488, 93, '2024-08-21 18:21:53', '2024-08-22 06:47:04', NULL),
(773, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-22 06:47:00', 489, 93, '2024-08-21 18:22:20', '2024-08-22 06:47:04', NULL),
(774, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кроватка с мягким изголовьем', '2024-08-22 06:47:00', 490, 93, '2024-08-21 18:22:20', '2024-08-22 06:47:04', NULL),
(775, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кроватка с мягким изголовьем', '2024-08-22 06:47:00', 491, 93, '2024-08-21 18:33:42', '2024-08-22 06:47:04', NULL),
(776, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 492, 93, '2024-08-21 18:33:42', '2024-08-22 06:47:03', NULL),
(777, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-22 06:47:00', 493, 93, '2024-08-21 18:33:42', '2024-08-22 06:47:03', NULL),
(778, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-22 06:47:00', 494, 93, '2024-08-21 18:34:39', '2024-08-22 06:47:03', NULL),
(779, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кроватка с мягким изголовьем', '2024-08-22 06:47:00', 495, 93, '2024-08-21 18:34:39', '2024-08-22 06:47:03', NULL),
(780, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 496, 93, '2024-08-21 18:34:39', '2024-08-22 06:47:02', NULL),
(781, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 497, 93, '2024-08-21 18:34:39', '2024-08-21 18:34:39', NULL),
(782, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-22 06:47:00', 498, 93, '2024-08-21 18:35:02', '2024-08-22 06:47:02', NULL),
(783, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 500, 93, '2024-08-21 18:35:02', '2024-08-22 06:47:02', NULL),
(784, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кроватка с мягким изголовьем', '2024-08-22 06:47:00', 499, 93, '2024-08-21 18:35:02', '2024-08-22 06:47:02', NULL),
(785, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 501, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(786, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 502, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(787, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кровать детская', '2024-08-22 06:47:00', 503, 93, '2024-08-21 18:35:37', '2024-08-22 06:47:02', NULL),
(788, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Кроватка с мягким изголовьем', '2024-08-22 06:47:00', 504, 93, '2024-08-21 18:35:37', '2024-08-22 06:47:01', NULL),
(789, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 505, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(790, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 506, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(791, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', '2024-08-22 06:47:00', 507, 93, '2024-08-21 18:35:37', '2024-08-22 06:47:01', NULL),
(792, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 508, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(793, 10, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 509, 99, '2024-08-21 19:36:47', '2024-08-21 19:36:47', NULL),
(794, 10, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 510, 99, '2024-08-21 19:42:25', '2024-08-21 19:42:25', NULL),
(795, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 511, 95, '2024-08-22 05:06:40', '2024-08-22 05:06:40', NULL),
(796, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 512, 95, '2024-08-22 05:06:40', '2024-08-22 05:06:40', NULL),
(797, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 513, 95, '2024-08-22 05:06:40', '2024-08-22 05:06:40', NULL),
(798, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 514, 95, '2024-08-22 05:06:41', '2024-08-22 05:06:41', NULL),
(799, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 515, 95, '2024-08-22 05:06:49', '2024-08-22 05:06:49', NULL),
(800, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 516, 95, '2024-08-22 05:06:50', '2024-08-22 05:06:50', NULL),
(801, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 517, 95, '2024-08-22 05:07:07', '2024-08-22 05:07:07', NULL),
(802, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 518, 95, '2024-08-22 05:07:07', '2024-08-22 05:07:07', NULL),
(803, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 519, 95, '2024-08-22 05:07:08', '2024-08-22 05:07:08', NULL),
(804, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 520, 95, '2024-08-22 05:07:09', '2024-08-22 05:07:09', NULL),
(805, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 521, 95, '2024-08-22 05:07:14', '2024-08-22 05:07:14', NULL),
(806, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 522, 95, '2024-08-22 05:07:14', '2024-08-22 05:07:14', NULL),
(807, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 523, 95, '2024-08-22 05:07:15', '2024-08-22 05:07:15', NULL),
(808, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 524, 95, '2024-08-22 05:07:15', '2024-08-22 05:07:15', NULL),
(809, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 525, 95, '2024-08-22 05:07:16', '2024-08-22 05:07:16', NULL),
(810, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 526, 95, '2024-08-22 05:07:16', '2024-08-22 05:07:16', NULL),
(811, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 527, 95, '2024-08-22 05:07:17', '2024-08-22 05:07:17', NULL),
(812, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 528, 95, '2024-08-22 05:07:17', '2024-08-22 05:07:17', NULL),
(813, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 529, 95, '2024-08-22 05:07:18', '2024-08-22 05:07:18', NULL),
(814, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 530, 95, '2024-08-22 05:07:19', '2024-08-22 05:07:19', NULL),
(815, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 531, 95, '2024-08-22 05:07:19', '2024-08-22 05:07:19', NULL),
(816, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 532, 95, '2024-08-22 05:07:19', '2024-08-22 05:07:19', NULL),
(817, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 533, 95, '2024-08-22 05:07:54', '2024-08-22 05:07:54', NULL),
(818, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 534, 95, '2024-08-22 05:07:54', '2024-08-22 05:07:54', NULL),
(819, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 535, 95, '2024-08-22 05:07:54', '2024-08-22 05:07:54', NULL),
(820, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 536, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(821, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 537, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(822, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 538, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(823, 10, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 539, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(824, 9, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Туалетный столик белый с зеркалом и ящиком в спальню', '2024-08-22 06:47:00', 540, 99, '2024-08-22 05:17:42', '2024-08-22 06:47:01', NULL),
(825, 99, 'Новая заявка', 'Арина принял вашу заявку на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 510, 10, '2024-08-22 06:03:01', '2024-08-22 06:03:01', NULL),
(827, 46, 'Согласование проекта', 'Можно приступать к выполнению проекта Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 56, 10, '2024-08-22 06:03:34', '2024-08-22 06:03:34', NULL),
(828, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 510, NULL, '2024-08-22 06:04:12', '2024-08-22 06:04:12', NULL),
(829, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 510, NULL, '2024-08-22 06:05:41', '2024-08-22 06:05:41', NULL),
(830, 10, 'Новая заявка', 'Вам поступила новая заявка от Лина на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 541, 94, '2024-08-22 07:39:09', '2024-08-22 07:39:09', NULL),
(831, 9, 'Новая заявка', 'Вам поступила новая заявка от Анжелита на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 543, 97, '2024-08-22 07:50:58', '2024-08-22 07:50:58', NULL),
(832, 10, 'Новая заявка', 'Вам поступила новая заявка от Анжелита на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 542, 97, '2024-08-22 07:50:58', '2024-08-22 07:50:58', NULL),
(833, 9, 'Новая заявка', 'Вам поступила новая заявка от Анжелита на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 545, 97, '2024-08-22 07:52:15', '2024-08-22 07:52:15', NULL),
(834, 10, 'Новая заявка', 'Вам поступила новая заявка от Анжелита на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 544, 97, '2024-08-22 07:52:15', '2024-08-22 07:52:15', NULL),
(835, 10, 'Новая заявка', 'Вам поступила новая заявка от Анжелита на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 546, 97, '2024-08-22 07:52:15', '2024-08-22 07:52:15', NULL),
(836, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 547, 112, '2024-08-22 09:06:57', '2024-08-22 09:06:57', NULL),
(837, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 548, 112, '2024-08-22 09:07:03', '2024-08-22 09:07:03', NULL),
(838, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 549, 112, '2024-08-22 09:07:03', '2024-08-22 09:07:03', NULL),
(839, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 551, 112, '2024-08-22 09:07:06', '2024-08-22 09:07:06', NULL),
(840, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 550, 112, '2024-08-22 09:07:06', '2024-08-22 09:07:06', NULL),
(841, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 552, 112, '2024-08-22 09:07:06', '2024-08-22 09:07:06', NULL),
(842, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 553, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(843, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 554, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(844, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 555, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(845, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 556, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(846, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 557, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(847, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 558, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(848, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 559, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(849, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 560, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL);
INSERT INTO `notifications` (`id`, `user_id`, `type`, `text`, `viewed_at`, `work_id`, `from_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(850, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 561, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(851, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 562, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(852, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 563, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(853, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 564, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(854, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 565, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(855, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 566, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(856, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 567, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(857, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 568, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(858, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 569, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(859, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 570, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(860, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 571, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(861, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 572, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(862, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 573, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(863, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 574, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(864, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 576, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(865, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 575, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(866, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 577, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(867, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 578, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(868, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 579, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(869, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 580, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(870, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 581, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(871, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 582, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(872, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 583, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(873, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 584, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(874, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 585, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(875, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 586, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(876, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 587, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(877, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 588, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(878, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 589, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(879, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 590, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(880, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 591, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(881, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 592, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(882, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 593, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(883, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 594, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(884, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 595, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(885, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 597, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(886, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 596, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(887, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 598, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(888, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 599, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(889, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 600, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(890, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 601, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(891, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 602, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(892, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 603, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(893, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 604, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(894, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 605, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(895, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 606, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(896, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 607, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(897, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 608, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(898, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 609, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(899, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 610, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(900, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 611, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(901, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 612, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(902, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 613, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(903, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 614, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(904, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 615, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(905, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 616, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(906, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 617, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(907, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 618, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(908, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 619, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(909, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 620, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(910, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 621, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(911, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 622, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(912, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 623, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(913, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 624, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(914, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 625, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(915, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 626, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(916, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 627, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(917, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 628, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(918, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 629, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(919, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 630, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(920, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 632, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(921, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 631, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(922, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 633, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(923, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 634, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(924, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 635, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(925, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 636, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(926, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 637, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(927, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 638, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(928, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 639, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(929, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 640, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(930, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 641, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(931, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 642, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(932, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 643, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(933, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 644, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(934, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 645, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(935, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 646, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(936, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 647, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(937, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мольберт детский', NULL, 648, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(938, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 649, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(939, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 650, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(940, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 651, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(941, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 652, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(942, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 653, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(943, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 654, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(944, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 655, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(945, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 656, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(946, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 657, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(947, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 658, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(948, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 659, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(949, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 660, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(950, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 661, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(951, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 662, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(952, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мольберт детский', NULL, 663, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(953, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 664, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(954, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 665, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(955, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 666, 112, '2024-08-22 09:07:54', '2024-08-22 09:07:54', NULL),
(956, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 667, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(957, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 668, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(958, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 669, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(959, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 670, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(960, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 671, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(961, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 672, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(962, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 673, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(963, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 674, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(964, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 675, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(965, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 676, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(966, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 677, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(967, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 678, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(968, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 679, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(969, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мольберт детский', NULL, 680, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(970, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 681, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(971, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 682, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(972, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 683, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(973, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 684, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(974, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 685, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(975, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Детский стол и стул для игр и рисования', NULL, 686, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(976, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол и мягкий стул', NULL, 687, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(977, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 688, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(978, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 689, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(979, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 690, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(980, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 691, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(981, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Растущий стол и стул для детей', NULL, 692, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(982, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 693, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(983, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 694, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(984, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 695, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(985, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 696, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(986, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мольберт детский', NULL, 697, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(987, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 698, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(988, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 699, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(989, 10, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 700, 99, '2024-08-22 10:52:06', '2024-08-22 10:52:06', NULL),
(990, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-22 11:00:24', '2024-08-22 11:00:24', NULL),
(991, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, 1, NULL, '2024-08-22 11:09:31', '2024-08-22 11:09:31', NULL),
(992, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 701, 117, '2024-08-22 11:33:57', '2024-08-22 11:33:57', NULL),
(993, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 702, 117, '2024-08-22 11:34:43', '2024-08-22 11:34:43', NULL),
(994, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 703, 117, '2024-08-22 11:34:43', '2024-08-22 11:34:43', NULL),
(995, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Кровать детская', NULL, 704, 117, '2024-08-22 11:37:27', '2024-08-22 11:37:27', NULL),
(996, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Арка садовая металлическая, пергола, шпалера', NULL, 54, 46, '2024-08-22 12:46:02', '2024-08-22 12:46:02', NULL),
(997, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 705, 118, '2024-08-22 13:36:12', '2024-08-22 13:36:12', NULL),
(998, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 707, 118, '2024-08-22 13:36:34', '2024-08-22 13:36:34', NULL),
(999, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 706, 118, '2024-08-22 13:36:34', '2024-08-22 13:36:34', NULL),
(1000, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 708, 118, '2024-08-22 13:37:03', '2024-08-22 13:37:03', NULL),
(1001, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 709, 118, '2024-08-22 13:37:03', '2024-08-22 13:37:03', NULL),
(1002, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', NULL, 710, 118, '2024-08-22 13:37:03', '2024-08-22 13:37:03', NULL),
(1003, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 712, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(1004, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 711, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(1005, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', NULL, 713, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(1006, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 714, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(1007, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Садовая тачка Самосвал, тележка строительная', NULL, 715, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(1008, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 716, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(1009, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', NULL, 717, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(1010, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 718, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(1011, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 719, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(1012, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 720, 120, '2024-08-22 13:55:26', '2024-08-22 13:55:26', NULL),
(1013, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 722, 120, '2024-08-22 13:55:56', '2024-08-22 13:55:56', NULL),
(1014, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 721, 120, '2024-08-22 13:55:56', '2024-08-22 13:55:56', NULL),
(1015, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 724, 120, '2024-08-22 13:56:27', '2024-08-22 13:56:27', NULL),
(1016, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 723, 120, '2024-08-22 13:56:27', '2024-08-22 13:56:27', NULL),
(1017, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Садовая тачка Самосвал, тележка строительная', NULL, 725, 120, '2024-08-22 13:56:27', '2024-08-22 13:56:27', NULL),
(1018, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Стол-сумка \"Мишка\" и стул \"Мишка\"белый', NULL, 726, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(1019, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 727, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(1020, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 728, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(1021, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Садовая тачка Самосвал, тележка строительная', NULL, 729, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(1022, 9, 'Новая заявка', 'Вам поступила новая заявка от Лариса на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 730, 116, '2024-08-22 13:58:24', '2024-08-22 13:58:24', NULL),
(1023, 9, 'Новая заявка', 'Вам поступила новая заявка от Лариса на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 731, 116, '2024-08-22 13:58:51', '2024-08-22 13:58:51', NULL),
(1024, 9, 'Новая заявка', 'Вам поступила новая заявка от Лариса на проект Детский туалетный столик и стул зайка', NULL, 732, 116, '2024-08-22 13:58:51', '2024-08-22 13:58:51', NULL),
(1025, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 733, 122, '2024-08-22 15:33:30', '2024-08-22 15:33:30', NULL),
(1026, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 734, 122, '2024-08-22 15:33:49', '2024-08-22 15:33:49', NULL),
(1027, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 735, 122, '2024-08-22 15:33:49', '2024-08-22 15:33:49', NULL),
(1028, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кровать детская', NULL, 736, 122, '2024-08-22 15:35:13', '2024-08-22 15:35:13', NULL),
(1029, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Кроватка с мягким изголовьем', NULL, 737, 122, '2024-08-22 15:35:13', '2024-08-22 15:35:13', NULL),
(1030, 10, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 738, 122, '2024-08-22 15:35:13', '2024-08-22 15:35:13', NULL),
(1031, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Арка садовая металлическая, пергола, шпалера', NULL, 739, 120, '2024-08-22 16:34:53', '2024-08-22 16:34:53', NULL),
(1032, 9, 'Новая заявка', 'Вам поступила новая заявка от Александра на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 740, 123, '2024-08-22 17:23:35', '2024-08-22 17:23:35', NULL),
(1033, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 741, 113, '2024-08-22 20:40:07', '2024-08-22 20:40:07', NULL),
(1034, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 742, 113, '2024-08-22 20:40:24', '2024-08-22 20:40:24', NULL),
(1035, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Кроватка с мягким изголовьем', NULL, 743, 113, '2024-08-22 20:40:24', '2024-08-22 20:40:24', NULL),
(1036, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-23 03:44:04', '2024-08-23 03:44:04', NULL),
(1037, 46, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 56, NULL, '2024-08-23 03:50:24', '2024-08-23 03:50:24', NULL),
(1039, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-23 04:20:51', '2024-08-23 04:20:51', NULL),
(1040, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 510, NULL, '2024-08-23 05:45:01', '2024-08-23 05:45:01', NULL),
(1041, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 05:54:30', '2024-08-23 05:54:30', NULL),
(1042, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 05:55:22', '2024-08-23 05:55:22', NULL),
(1043, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 05:56:52', '2024-08-23 05:56:52', NULL),
(1044, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 06:00:49', '2024-08-23 06:00:49', NULL),
(1045, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 510, NULL, '2024-08-23 06:16:03', '2024-08-23 06:16:03', NULL),
(1046, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 06:20:43', '2024-08-23 06:20:43', NULL),
(1047, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 06:21:24', '2024-08-23 06:21:24', NULL),
(1048, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 56, NULL, '2024-08-23 06:23:09', '2024-08-23 06:23:09', NULL),
(1049, 10, 'Согласование проекта', 'Мария готов приступить к работе по проекту Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 510, 99, '2024-08-23 06:35:07', '2024-08-23 06:35:07', NULL),
(1050, 10, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 744, 117, '2024-08-23 10:41:10', '2024-08-23 10:41:10', NULL),
(1051, 9, 'Новая заявка', 'Вам поступила новая заявка от Юлия на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 745, 117, '2024-08-23 10:41:25', '2024-08-23 10:41:25', NULL),
(1052, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-23 11:55:51', '2024-08-23 11:55:51', NULL),
(1053, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, 1, NULL, '2024-08-23 11:57:34', '2024-08-23 11:57:34', NULL),
(1054, 99, 'Новая заявка', 'Анастасия принял вашу заявку на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 540, 9, '2024-08-23 12:29:30', '2024-08-23 12:29:30', NULL),
(1055, 112, 'Новая заявка', 'Анастасия принял вашу заявку на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 698, 9, '2024-08-23 12:30:42', '2024-08-23 12:30:42', NULL),
(1056, 123, 'Новая заявка', 'Анастасия принял вашу заявку на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 740, 9, '2024-08-23 12:31:31', '2024-08-23 12:31:31', NULL),
(1057, 113, 'Новая заявка', 'Анастасия принял вашу заявку на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 742, 9, '2024-08-23 12:32:05', '2024-08-23 12:32:05', NULL),
(1058, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-23 12:33:18', '2024-08-23 12:33:18', NULL),
(1059, 112, 'Новая заявка', 'Анастасия принял вашу заявку на проект Мольберт детский', NULL, 697, 9, '2024-08-23 12:35:34', '2024-08-23 12:35:34', NULL),
(1060, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-23 12:37:27', '2024-08-23 12:37:27', NULL),
(1061, 99, 'Согласование проекта', 'Анастасия готов приступить к работе по проекту Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 540, 9, '2024-08-23 12:37:28', '2024-08-23 12:37:28', NULL),
(1062, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-23 12:37:41', '2024-08-23 12:37:41', NULL),
(1063, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-23 12:37:45', '2024-08-23 12:37:45', NULL),
(1064, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-23 12:39:08', '2024-08-23 12:39:08', NULL),
(1065, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-23 12:39:58', '2024-08-23 12:39:58', NULL),
(1066, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 746, 92, '2024-08-23 14:49:27', '2024-08-23 14:49:27', NULL),
(1067, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Садовая тачка Самосвал, тележка строительная', NULL, 747, 92, '2024-08-23 14:49:53', '2024-08-23 14:49:53', NULL),
(1068, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', NULL, 748, 92, '2024-08-23 14:50:31', '2024-08-23 14:50:31', NULL),
(1069, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Электротриммер садовый Partner for Garden ЕТ-2000', NULL, 749, 92, '2024-08-23 14:50:38', '2024-08-23 14:50:38', NULL),
(1070, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', NULL, 750, 92, '2024-08-23 14:50:46', '2024-08-23 14:50:46', NULL),
(1071, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 751, 92, '2024-08-23 14:50:52', '2024-08-23 14:50:52', NULL),
(1072, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', NULL, 752, 92, '2024-08-23 14:50:58', '2024-08-23 14:50:58', NULL),
(1073, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', NULL, 753, 92, '2024-08-23 14:51:03', '2024-08-23 14:51:03', NULL),
(1074, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал складной для дачи 3 мм 12 шампуров с подказанником, разборный', NULL, 754, 92, '2024-08-23 14:51:07', '2024-08-23 14:51:07', NULL),
(1075, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', NULL, 755, 92, '2024-08-23 14:51:12', '2024-08-23 14:51:12', NULL),
(1076, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Футболка женская с принтом хлопок', NULL, 756, 92, '2024-08-23 14:51:53', '2024-08-23 14:51:53', NULL),
(1077, 10, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 757, 92, '2024-08-23 14:51:58', '2024-08-23 14:51:58', NULL),
(1078, 9, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Стеллаж (комод) детский \"Лео 4\"', NULL, 758, 99, '2024-08-24 06:52:42', '2024-08-24 06:52:42', NULL),
(1079, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-24 06:53:13', '2024-08-24 06:53:13', NULL),
(1080, 9, 'Новая заявка', 'Вам поступила новая заявка от Мария на проект Садовая тачка Самосвал, тележка строительная', NULL, 759, 99, '2024-08-24 06:54:01', '2024-08-24 06:54:01', NULL),
(1081, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ольга', NULL, 698, NULL, '2024-08-24 08:45:30', '2024-08-24 08:45:30', NULL),
(1082, 9, 'Согласование проекта', 'Ольга готов приступить к работе по проекту Стеллаж (комод) детский \"Лео 4\"', NULL, 698, 112, '2024-08-24 08:45:31', '2024-08-24 08:45:31', NULL),
(1083, 9, 'Согласование проекта', 'Ольга готов приступить к работе по проекту Мольберт детский', NULL, 697, 112, '2024-08-24 08:45:49', '2024-08-24 08:45:49', NULL),
(1084, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ольга', NULL, 697, NULL, '2024-08-24 08:45:53', '2024-08-24 08:45:53', NULL),
(1085, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Садовая тачка Самосвал, тележка строительная', NULL, 760, 112, '2024-08-24 08:47:44', '2024-08-24 08:47:44', NULL),
(1086, 9, 'Новая заявка', 'Вам поступила новая заявка от Ольга на проект Мангал складной для дачи 3 мм 12 шампуров с подказанником, разборный', NULL, 761, 112, '2024-08-24 08:47:53', '2024-08-24 08:47:53', NULL),
(1087, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', NULL, 762, 96, '2024-08-24 10:50:45', '2024-08-24 10:50:45', NULL),
(1088, 9, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Арка садовая металлическая, пергола, шпалера', NULL, 763, 96, '2024-08-24 10:51:17', '2024-08-24 10:51:17', NULL),
(1089, 10, 'Новая заявка', 'Вам поступила новая заявка от Вера на проект Электротриммер садовый Partner for Garden ЕТ 2800', NULL, 764, 96, '2024-08-24 10:51:48', '2024-08-24 10:51:48', NULL),
(1090, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-24 13:57:32', '2024-08-24 13:57:32', NULL),
(1091, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Ксения', NULL, 60, NULL, '2024-08-24 15:00:44', '2024-08-24 15:00:44', NULL),
(1092, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Детский стол и стул для игр и рисования', NULL, 765, 34, '2024-08-24 16:13:28', '2024-08-24 16:13:28', NULL),
(1093, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Футболка женская с принтом хлопок', NULL, 766, 34, '2024-08-24 16:15:14', '2024-08-24 16:15:14', NULL),
(1094, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Кровать детская', NULL, 767, 34, '2024-08-24 16:15:56', '2024-08-24 16:15:56', NULL),
(1095, 9, 'Новая заявка', 'Вам поступила новая заявка от Ксения на проект Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 768, 34, '2024-08-24 16:16:40', '2024-08-24 16:16:40', NULL),
(1096, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-25 07:51:05', '2024-08-25 07:51:05', NULL),
(1097, 9, 'Новая заявка', 'Вам поступила новая заявка от Людмила на проект Садовая тачка Самосвал, тележка строительная', NULL, 769, 128, '2024-08-25 12:54:44', '2024-08-25 12:54:44', NULL),
(1098, 9, 'Новая заявка', 'Вам поступила новая заявка от Людмила на проект Садовая тачка Самосвал, тележка строительная', NULL, 770, 128, '2024-08-25 12:54:44', '2024-08-25 12:54:44', NULL),
(1099, 9, 'Новая заявка', 'Вам поступила новая заявка от Людмила на проект Кроватка с мягким изголовьем', NULL, 771, 128, '2024-08-25 12:55:44', '2024-08-25 12:55:44', NULL),
(1100, 9, 'Новая заявка', 'Вам поступила новая заявка от Людмила на проект Кровать детская', NULL, 772, 128, '2024-08-25 12:56:08', '2024-08-25 12:56:08', NULL),
(1101, 9, 'Новая заявка', 'Вам поступила новая заявка от Людмила на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', NULL, 773, 128, '2024-08-25 12:56:34', '2024-08-25 12:56:34', NULL),
(1105, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 510, NULL, '2024-08-26 05:29:01', '2024-08-26 05:29:01', NULL),
(1106, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-26 05:34:18', '2024-08-26 05:34:18', NULL),
(1107, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-26 05:34:41', '2024-08-26 05:34:41', NULL),
(1108, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-26 05:34:47', '2024-08-26 05:34:47', NULL),
(1109, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 510, NULL, '2024-08-26 05:35:09', '2024-08-26 05:35:09', NULL),
(1111, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-26 05:46:47', '2024-08-26 05:46:47', NULL),
(1112, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-26 05:54:01', '2024-08-26 05:54:01', NULL),
(1113, 20, 'Новое сообщение', 'Вам поступило новое сообщение от Арина', NULL, 1, NULL, '2024-08-26 05:54:24', '2024-08-26 05:54:24', NULL),
(1115, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-26 05:55:05', '2024-08-26 05:55:05', NULL),
(1117, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-26 05:58:15', '2024-08-26 05:58:15', NULL),
(1120, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Надежда', NULL, 174, NULL, '2024-08-26 06:00:35', '2024-08-26 06:00:35', NULL),
(1121, 10, 'Новое сообщение', 'Вам поступило новое сообщение от Семья ФиА', NULL, 1, NULL, '2024-08-26 06:31:12', '2024-08-26 06:31:12', NULL),
(1122, 9, 'Новая заявка', 'Вам поступила новая заявка от Анастасия на проект Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', NULL, 774, 93, '2024-08-26 10:19:34', '2024-08-26 10:19:34', NULL),
(1123, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 11:17:03', '2024-08-26 11:17:03', NULL),
(1124, 112, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 698, NULL, '2024-08-26 11:17:40', '2024-08-26 11:17:40', NULL),
(1125, 34, 'Новая заявка', 'Анастасия принял вашу заявку на проект Футболка женская с принтом хлопок', NULL, 766, 9, '2024-08-26 11:19:27', '2024-08-26 11:19:27', NULL),
(1126, 92, 'Новая заявка', 'Анастасия принял вашу заявку на проект Футболка женская с принтом хлопок', NULL, 756, 9, '2024-08-26 11:21:44', '2024-08-26 11:21:44', NULL),
(1127, 34, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 766, NULL, '2024-08-26 11:23:06', '2024-08-26 11:23:06', NULL),
(1128, 92, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 756, NULL, '2024-08-26 11:23:46', '2024-08-26 11:23:46', NULL),
(1129, 34, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 766, NULL, '2024-08-26 11:25:02', '2024-08-26 11:25:02', NULL),
(1130, 92, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 756, NULL, '2024-08-26 11:25:08', '2024-08-26 11:25:08', NULL),
(1131, 112, 'Новая заявка', 'Анастасия принял вашу заявку на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 667, 9, '2024-08-26 11:26:26', '2024-08-26 11:26:26', NULL),
(1132, 99, 'Новая заявка', 'Анастасия принял вашу заявку на проект Садовая тачка Самосвал, тележка строительная', NULL, 759, 9, '2024-08-26 11:28:48', '2024-08-26 11:28:48', NULL);
INSERT INTO `notifications` (`id`, `user_id`, `type`, `text`, `viewed_at`, `work_id`, `from_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1133, 92, 'Новая заявка', 'Анастасия принял вашу заявку на проект Садовая тачка Самосвал, тележка строительная', NULL, 747, 9, '2024-08-26 11:29:55', '2024-08-26 11:29:55', NULL),
(1134, 92, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 747, NULL, '2024-08-26 11:34:40', '2024-08-26 11:34:40', NULL),
(1135, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 759, NULL, '2024-08-26 11:34:49', '2024-08-26 11:34:49', NULL),
(1136, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 759, NULL, '2024-08-26 11:35:11', '2024-08-26 11:35:11', NULL),
(1137, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 759, NULL, '2024-08-26 11:35:16', '2024-08-26 11:35:16', NULL),
(1138, 112, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 667, NULL, '2024-08-26 11:35:54', '2024-08-26 11:35:54', NULL),
(1139, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 11:36:09', '2024-08-26 11:36:09', NULL),
(1140, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-26 11:36:55', '2024-08-26 11:36:55', NULL),
(1141, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:04:13', '2024-08-26 14:04:13', NULL),
(1142, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1143, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1144, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1145, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1146, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1147, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1148, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1149, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1150, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:35', '2024-08-26 14:05:35', NULL),
(1151, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1152, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1153, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1154, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1155, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1156, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1157, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1158, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:36', '2024-08-26 14:05:36', NULL),
(1159, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:48', '2024-08-26 14:05:48', NULL),
(1160, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:05:48', '2024-08-26 14:05:48', NULL),
(1161, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-26 14:07:23', '2024-08-26 14:07:23', NULL),
(1162, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:09:13', '2024-08-26 14:09:13', NULL),
(1163, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 540, NULL, '2024-08-26 14:09:39', '2024-08-26 14:09:39', NULL),
(1164, 99, 'Новое сообщение', 'Вам поступило новое сообщение от Анастасия', NULL, 759, NULL, '2024-08-26 14:10:25', '2024-08-26 14:10:25', NULL),
(1165, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:11:43', '2024-08-26 14:11:43', NULL),
(1166, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:11:53', '2024-08-26 14:11:53', NULL),
(1167, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:11:59', '2024-08-26 14:11:59', NULL),
(1168, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:24:30', '2024-08-26 14:24:30', NULL),
(1169, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:24:54', '2024-08-26 14:24:54', NULL),
(1170, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 775, 133, '2024-08-26 14:25:02', '2024-08-26 14:25:02', NULL),
(1171, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:25:05', '2024-08-26 14:25:05', NULL),
(1172, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Садовая тачка Самосвал, тележка строительная', NULL, 776, 133, '2024-08-26 14:25:07', '2024-08-26 14:25:07', NULL),
(1173, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Арка садовая металлическая, пергола, шпалера', NULL, 777, 133, '2024-08-26 14:29:12', '2024-08-26 14:29:12', NULL),
(1174, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 759, NULL, '2024-08-26 14:42:47', '2024-08-26 14:42:47', NULL),
(1175, 9, 'Новое сообщение', 'Вам поступило новое сообщение от Мария', NULL, 540, NULL, '2024-08-26 14:45:01', '2024-08-26 14:45:01', NULL),
(1176, 9, 'Согласование проекта', 'Можно приступать к выполнению проекта Туалетный столик белый с зеркалом и ящиком в спальню', NULL, 540, 99, '2024-08-26 14:45:13', '2024-08-26 14:45:13', NULL),
(1177, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Садовая тачка Самосвал, тележка строительная', NULL, 778, 133, '2024-08-26 14:51:55', '2024-08-26 14:51:55', NULL),
(1178, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 779, 133, '2024-08-26 14:57:51', '2024-08-26 14:57:51', NULL),
(1179, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Садовая тачка Самосвал, тележка строительная', NULL, 780, 133, '2024-08-26 14:59:14', '2024-08-26 14:59:14', NULL),
(1180, 9, 'Новая заявка', 'Вам поступила новая заявка от TRIANGLE на проект Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', NULL, 781, 133, '2024-08-26 14:59:54', '2024-08-26 14:59:54', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_id` bigint UNSIGNED DEFAULT NULL,
  `tariff_id` bigint UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `payment_id`, `tariff_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(11, 10, 1111111, 10, 1200000, 'CONFIRMED', '2024-08-29 22:23:27', NULL),
(12, 10, 222222, 11, 500000, 'CONFIRMED', '2024-08-29 22:23:27', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `platforms`
--

INSERT INTO `platforms` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Telegram', 'img/telegram-icon.svg', '2024-08-29 14:02:43', '2024-08-29 14:02:43'),
(2, 'Youtube', 'img/youtube-colored-icon.svg', '2024-08-29 14:02:43', '2024-08-29 14:02:43'),
(3, 'Instagram', 'img/inst-icon.svg', '2024-08-29 14:02:43', '2024-08-29 14:02:43'),
(4, 'VK', 'img/vk-icon.svg', '2024-08-29 14:02:43', '2024-08-29 14:02:43');

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_nm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_link` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `seller_id` bigint UNSIGNED NOT NULL,
  `marketplace_brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketplace_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketplace_product_name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketplace_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `marketplace_options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `marketplace_rate` int UNSIGNED DEFAULT NULL,
  `is_blogger_access` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `product_name`, `product_nm`, `product_link`, `product_price`, `status`, `seller_id`, `marketplace_brand`, `marketplace_category`, `marketplace_product_name`, `marketplace_description`, `marketplace_options`, `marketplace_rate`, `is_blogger_access`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Мангал складной сталь 3 мм 10 шампуров для дачи многоразовый', '81898966', 'https://www.wildberries.ru/catalog/81898966/detail.aspx', 3929, -1, 9, 'UniKit', 'Мангалы', 'Мангал складной сталь 3 мм для дачи многоразовый', 'Мангал складной  для дачи разборный многоразовый\n\nСтальной мангал для дачи, который обеспечит вам отличный отдых на природе.\nОсобенностью мангала являются разборные ножки, которые складываются внутрь. Поэтому он может быть использован как стационарный и передвижной. Изготовлен из стали, окрашен - жаростойкая порошковая краска черный графит, выдерживает температуру до 1200 градусов. Тройные боковые прорези подходят для установки любых шампуров и не дают им падать. ВАЖНО! Перед применением необходимо провести термозакалку элементов - чаши по инструкции! Кочерга применяется только после закалки поверхности.\nКорпус мангала выполнен из прочной стали, что обеспечивает его надежность и долговечность. \nМангал является складным и разборным, что позволяет его легко транспортировать и хранить в любом месте. Вы сможете взять мангал с собой на пикник, в поход или на отдых в природном парке.\n\nПростой в использовании и легкий в уходе. Стальной мангал - отличный выбор для любителей отдыха на природе. Он не требует сложного ухода, а все элементы мангала легко помыть. Это значительно упрощает процесс уборки и сохраняет мангал в хорошем состоянии на долгие годы.\nВсе это делает стальной мангал идеальным выбором для любителей отдыха на природе и хорошей еды. Вы сможете наслаждаться приятным отдыхом, готовить вкусную еду, и получать удовольствие от простоты и удобства использования этого прекрасного мангала.\nМангал отлично подойдёт как подарок для любого повода: день рождения, юбилей, годовщина, новоселье, 23 февраля, 14 февраля, новый год. Подарить мангал вы можете: Папе , мужу, мужчине, брату, соседу, коллеге по работе, они по достоинству оценят мангал!\n\nМангал разборный, поэтому вы легко можете погрузить его в машину и взять на пикник. Для мангала не требуется особых условий хранения, монгал многоразовый, хорошо подходит для профессионального использования, кемпинга , барбекю. Мангал подходит как для приготовления шашлыка, так и других блюд на открытом огне и гриля.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041c\\u0430\\u043d\\u0433\\u0430\\u043b \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u043e\\u0439 - 1\\u0448\\u0442.\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"14 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0442\\u043e\\u0432\\u0430\\u0440\\u0430 \\u0431\\u0435\\u0437 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438 (\\u0433)\",\"value\":\"15000 \\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"66 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"24 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"34 \\u0441\\u043c\"}]', NULL, 1, '2024-08-08 19:14:07', '2024-08-30 16:38:01', NULL),
(2, 'Садовая тачка Самосвал, тележка строительная', '73762642', 'https://www.wildberries.ru/catalog/73762642/detail.aspx?targetUrl=EX', 8369, -2, 9, 'UniKit', 'Тележки садовые', 'Садовая тачка Самосвал, тележка строительная', 'Уникальная садовая тележка Самосвал на 4-х пневматических колесах, тачка хозяйственная :\nИспользуйте в любой сезон года !\nФункция телеги строительной \"самосвала\" позволяет легко выгружать груз одной рукой!- Ось с вращением на 270гр. позволяет вписываться в любые повороты!\nПреимущества конструкции:- Стальная рама выдерживает нагрузку до 200 кг;\nКузов из стали толщиной 0,8 мм;\nКрая кузова ( борт ) закруглены для избежания порезов на руках и ногах;- Порошковый окрас уличной стойкой краской;\nВыдерживает температуру от -60гр.С до +50гр.С;\nНакачиваемое колесо шириной 8 см выдерживает нагрузку до 150 кг;\nДлинная рукоятка с мягкой неоперновой ручкой ;\nСпециальный стопор не позволяет рукоятке падать на землю и оставляет ее чистой. Функция антигрязь.Не имеет аналогов в России!\n', '[{\"name\":\"\\u041a\\u043e\\u043b\\u0438\\u0447\\u0435\\u0441\\u0442\\u0432\\u043e \\u043a\\u043e\\u043b\\u0435\\u0441\",\"value\":\"4 \\u0448\\u0442.\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"19 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0420\\u0443\\u043a\\u043e\\u044f\\u0442\\u043a\\u0430 - 1 \\u0448\\u0442; \\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442 \\u043a\\u0440\\u0435\\u043f\\u0435\\u0436\\u0430 - 1 \\u043a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442; \\u043a\\u0443\\u0437\\u043e\\u0432 \\u0438\\u0437 \\u0441\\u0442\\u0430\\u043b\\u0438 0,8 \\u043c\\u043c - 1 \\u0448\\u0442; \\u043a\\u043e\\u043b\\u0435\\u0441\\u0430 \\u0434\\u0438\\u0430\\u043c\\u0435\\u0442\\u0440\\u043e\\u043c 26 \\u0441\\u043c - 4 \\u0448\\u0442; \\u0420\\u0430\\u043c\\u0430 - 1 \\u0448\\u0442\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"98 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"20 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"60 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 06:40:44', '2024-08-30 16:37:59', NULL),
(3, 'Арка садовая металлическая, пергола, шпалера', '79670033', 'https://www.wildberries.ru/catalog/79670033/detail.aspx', 4754, 0, 9, 'UniKit', 'Мангалы', 'Мангал складной сталь 3 мм для дачи многоразовый', 'Мангал складной  для дачи разборный многоразовый\n\nСтальной мангал для дачи, который обеспечит вам отличный отдых на природе.\nОсобенностью мангала являются разборные ножки, которые складываются внутрь. Поэтому он может быть использован как стационарный и передвижной. Изготовлен из стали, окрашен - жаростойкая порошковая краска черный графит, выдерживает температуру до 1200 градусов. Тройные боковые прорези подходят для установки любых шампуров и не дают им падать. ВАЖНО! Перед применением необходимо провести термозакалку элементов - чаши по инструкции! Кочерга применяется только после закалки поверхности.\nКорпус мангала выполнен из прочной стали, что обеспечивает его надежность и долговечность. \nМангал является складным и разборным, что позволяет его легко транспортировать и хранить в любом месте. Вы сможете взять мангал с собой на пикник, в поход или на отдых в природном парке.\n\nПростой в использовании и легкий в уходе. Стальной мангал - отличный выбор для любителей отдыха на природе. Он не требует сложного ухода, а все элементы мангала легко помыть. Это значительно упрощает процесс уборки и сохраняет мангал в хорошем состоянии на долгие годы.\nВсе это делает стальной мангал идеальным выбором для любителей отдыха на природе и хорошей еды. Вы сможете наслаждаться приятным отдыхом, готовить вкусную еду, и получать удовольствие от простоты и удобства использования этого прекрасного мангала.\nМангал отлично подойдёт как подарок для любого повода: день рождения, юбилей, годовщина, новоселье, 23 февраля, 14 февраля, новый год. Подарить мангал вы можете: Папе , мужу, мужчине, брату, соседу, коллеге по работе, они по достоинству оценят мангал!\n\nМангал разборный, поэтому вы легко можете погрузить его в машину и взять на пикник. Для мангала не требуется особых условий хранения, монгал многоразовый, хорошо подходит для профессионального использования, кемпинга , барбекю. Мангал подходит как для приготовления шашлыка, так и других блюд на открытом огне и гриля.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041c\\u0430\\u043d\\u0433\\u0430\\u043b \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u043e\\u0439 - 1\\u0448\\u0442.\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"14 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0442\\u043e\\u0432\\u0430\\u0440\\u0430 \\u0431\\u0435\\u0437 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438 (\\u0433)\",\"value\":\"15000 \\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"66 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"24 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"34 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 06:42:52', '2024-08-09 14:25:51', NULL),
(4, 'Электротриммер садовый Partner for Garden ЕТ 2800', '511078194', 'https://www.ozon.ru/product/elektrokosa-dlya-kosheniya-travy-elektrotrimmer-sadovyy-partner-for-garden-et-2800-2800-vt-nozh-3t-511078194/', 7308, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-09 08:49:42', '2024-08-12 15:59:09', '2024-08-12 15:59:09'),
(5, 'Триммер кусторез бензиновый для травы садовый BT-430 2.9 л.с.', '176663692', 'https://www.ozon.ru/product/trimmer-kustorez-benzinovyy-dlya-travy-sadovyy-bt-430-2-9-l-s-shirina-skashivaniya-44-sm-pfg-176663692/', 6422, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-09 09:02:32', '2024-08-09 09:23:17', NULL),
(6, 'Электротриммер садовый Partner for Garden ЕТ-2000', '511075623', 'https://www.ozon.ru/product/elektrokosa-dlya-kosheniya-travy-elektrotrimmer-sadovyy-partner-for-garden-et-2000-2000-vt-nozh-3-t-511075623/', 6322, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-09 09:08:45', '2024-08-09 09:23:08', NULL),
(7, 'Триммер кусторез бензиновый для травы садовый BT-620 4,9 л.с.', '176663690', 'https://www.ozon.ru/product/trimmer-kustorez-benzinovyy-dlya-travy-sadovyy-bt-620-4-9-l-s-shirina-skashivaniya-44-sm-pfg-176663690/', 6853, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-09 09:14:08', '2024-08-09 09:22:58', NULL),
(8, 'Бензопила цепная бензиновая GS 516 3.24 л.с. лёгкий запуск Partner for Garden', '693083536', 'https://www.ozon.ru/product/benzopila-tsepnaya-benzinovaya-gs-516-3-24-l-s-legkiy-zapusk-partner-for-garden-693083536/', 5673, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-09 09:17:01', '2024-08-09 09:22:50', NULL),
(9, 'Мангал складной сталь 3 мм, для дачи высокий 12 шампуров', '157208140', 'https://www.wildberries.ru/catalog/157208140/detail.aspx', 4168, 0, 9, 'UniKit', 'Мангалы', 'Мангал складной сталь 3 мм, для дачи высокий', 'Мангал складной для дачи разборный, многоразовый, высокий.\nСтальной мангал для дачи, который обеспечит вам отличный отдых.\nОсобенностью мангала являются разборные ножки, которые складываются внутрь. Поэтому он может быть использован как стационарный и передвижной. Изготовлен из стали толщиной 3 мм , окрашен - жаростойкая порошковая краска черный графит, выдерживает температуру до 1200 градусов. Тройные боковые прорези подходят для установки любых шампуров и не дают им падать. ВАЖНО! Перед применением необходимо провести термозакалку элементов - чаши по инструкции! Кочерга применяется только после закалки поверхности.\nКорпус мангала выполнен из прочной стали, что обеспечивает его надежность и долговечность.\nВ комплект с мангалом НЕ входит решетка для гриля и угольная решетка. \nПростой в использовании и легкий в уходе. Стальной мангал - отличный выбор для любителей отдыха на природе. Он не требует сложного ухода, а все элементы мангала легко помыть. Это значительно упрощает процесс уборки и сохраняет мангал в хорошем состоянии на долгие годы.\nВсе это делает стальной мангал идеальным выбором для любителей отдыха на природе и хорошей еды. Вы сможете наслаждаться приятным отдыхом, готовить вкусную еду, и получать удовольствие от простоты и удобства использования этого прекрасного мангала.\nМангал отлично подойдёт как подарок для любого повода: день рождения, юбилей, годовщина, новоселье, 23 февраля, 14 февраля, новый год. Подарить мангал вы можете: Папе , мужу, мужчине, брату, соседу, коллеге по работе, они по достоинству оценят мангал!\n\nМангал разборный, поэтому вы легко можете погрузить его в машину и взять на пикник. Для мангала не требуется особых условий хранения, монгал многоразовый, хорошо подходит для профессионального использования, кемпинга , барбекю. Мангал довольно высокий не требует дополнительных подпорок. Мангал подходит как для приготовления шашлыка, так и других блюд на открытом огне и гриля. \n\n', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u043c\\u0435\\u0442\\u0430\\u043b\\u043b\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"18 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0442\\u043e\\u0432\\u0430\\u0440\\u0430 \\u0431\\u0435\\u0437 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438 (\\u0433)\",\"value\":\"18500 \\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"23 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"34 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 14:13:06', '2024-08-09 14:25:58', NULL),
(10, 'Мангал складной 3 мм 12 шампуров с полкой, для дачи высокий', '95473315', 'https://www.wildberries.ru/catalog/95473315/detail.aspx', 5351, 0, 9, 'UniKit', 'Мангалы', 'Мангал складной 3 мм с полкой, для дачи  высокий', 'Мангал складной на 12 шампуров, толщина стали 3 мм, с полкой для дачи разборный, многоразовый.\nСтальной мангал для дачи обеспечит вам отличный отдых.\nОсобенностью мангала являются разборные ножки, которые складываются внутрь. Поэтому он может быть использован как стационарный и передвижной. Изготовлен из стали толщиной 3 мм, окрашен жаростойкой порошковой краской черный графит, выдерживает температуру до 1200 градусов. Тройные боковые прорези подходят для установки любых шампуров и не дают им падать. ВАЖНО! Перед применением необходимо провести термозакалку элементов - чаши - по инструкции! Кочерга применяется только после закалки поверхности.\nВ комплект с мангалом НЕ входит решетка для гриля, угольная решетка и шампуры.\n\nРазмеры мангала позволяют готовить большие порции еды для всей компании. \nМангал является складным, что позволяет его легко транспортировать и хранить в любом месте. Вы легко можете погрузить его в машину и взять на пикник, на дачу, на отдых в природном парке. \n\nВсе это делает стальной мангал идеальным выбором для любителей отдыха на природе и хорошей еды. Вы сможете наслаждаться приятным отдыхом, готовить вкусную еду и получать удовольствие от простоты и удобства использования этого прекрасного мангала.\nМангал отлично подойдёт в качестве подарка к любому событию: дню рождения, юбилею, годовщине, новоселью, 23 февраля, 14 февраля, новому году. Подарить мангал вы можете: папе, мужу, мужчине, брату, соседу, коллеге, они по достоинству оценят мангал!\n\nДля мангала не требуется особых условий хранения, мангал многоразовый, хорошо подходит для профессионального использования, кемпинга, барбекю. Мангал довольно высокий, не требует дополнительных подпорок. Мангал подходит как для приготовления шашлыка, так и других блюд на открытом огне и гриля. ', '[{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u0433\\u0440\\u0430\\u0444\\u0438\\u0442\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043d\\u0441\\u0442\\u0440\\u0443\\u043a\\u0446\\u0438\\u044f \\u043c\\u0430\\u043d\\u0433\\u0430\\u043b\\u0430\\/\\u0433\\u0440\\u0438\\u043b\\u044f\",\"value\":\"\\u043d\\u0430 \\u043d\\u043e\\u0436\\u043a\\u0430\\u0445; \\u043d\\u0430\\u043f\\u043e\\u043b\\u044c\\u043d\\u0430\\u044f; \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u0430\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043f\\u0447\\u0435\\u043d\\u0438\\u0435\",\"value\":\"\\u0412\\u043e\\u0437\\u043c\\u043e\\u0436\\u043d\\u043e\",\"charc_type\":1},{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041c\\u0430\\u043d\\u0433\\u0430\\u043b \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u043e\\u0439 - 1\\u0448\\u0442.; \\u043f\\u043e\\u043b\\u043a\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"20 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0442\\u043e\\u0432\\u0430\\u0440\\u0430 \\u0431\\u0435\\u0437 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438 (\\u0433)\",\"value\":\"20000 \\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"24 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"34 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 14:17:35', '2024-08-09 14:26:29', NULL),
(11, 'Мангал складной для дачи 3 мм 12 шампуров с подказанником, разборный', '95473147', 'https://www.wildberries.ru/catalog/95473147/detail.aspx', 5555, 0, 9, 'UniKit', 'Мангалы', 'Мангал складной для дачи 3 мм с подказанником, разборный', 'Мангал складной на 12 шампуров, толщина стали 3 мм, с подказанником  разборный, многоразовый.\n\nОсобенностью мангала являются разборные ножки, которые складываются внутрь. Поэтому он может быть использован как стационарный и передвижной. Изготовлен из стали толщиной 3 мм, окрашен жаростойкой порошковой краской черный графит, выдерживает температуру до 1200 градусов. Тройные боковые прорези подходят для установки любых шампуров и не дают им падать. ВАЖНО! Перед применением необходимо провести термозакалку элементов - чаши - по инструкции! Кочерга применяется только после закалки поверхности.\nВ комплект с мангалом НЕ входят решетка для гриля, угольная решетка и шампуры. \n\nРазмеры мангала позволяют готовить большие порции еды для всей компании. Вы сможете приготовить все, что пожелаете, и порадовать своих гостей вкусной и сочной едой.\nМангал является складным, что позволяет его легко транспортировать и хранить в любом месте. \nПростой в использовании и легкий в уходе. \nВсе это делает стальной мангал идеальным выбором для любителей отдыха на природе и хорошей еды. Вы сможете наслаждаться приятным отдыхом, готовить вкусную еду и получать удовольствие от простоты и удобства использования этого прекрасного мангала.\n\nМангал отлично подойдёт в качестве подарка к любому событию: дню рождения, юбилею, годовщине, новоселью, 23 февраля, 14 февраля, новому году. Подарить мангал вы можете: папе, мужу, мужчине, брату, соседу, коллеге, они по достоинству оценят мангал!\n\nМангал складной, поэтому вы легко можете погрузить его в машину и взять на пикник, на дачу, на отдых в природном парке. Для мангала не требуется особых условий хранения, мангал многоразовый, хорошо подходит для профессионального использования, кемпинга, барбекю. Мангал довольно высокий, не требует дополнительных подпорок. Мангал подходит как для приготовления шашлыка, так и других блюд на открытом огне и гриля. ', '[{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u0433\\u0440\\u0430\\u0444\\u0438\\u0442\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043d\\u0441\\u0442\\u0440\\u0443\\u043a\\u0446\\u0438\\u044f \\u043c\\u0430\\u043d\\u0433\\u0430\\u043b\\u0430\\/\\u0433\\u0440\\u0438\\u043b\\u044f\",\"value\":\"\\u043d\\u0430 \\u043d\\u043e\\u0436\\u043a\\u0430\\u0445; \\u043d\\u0430\\u043f\\u043e\\u043b\\u044c\\u043d\\u0430\\u044f; \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u0430\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043f\\u0447\\u0435\\u043d\\u0438\\u0435\",\"value\":\"\\u0412\\u043e\\u0437\\u043c\\u043e\\u0436\\u043d\\u043e\",\"charc_type\":1},{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041c\\u0430\\u043d\\u0433\\u0430\\u043b \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u043e\\u0439 - 1\\u0448\\u0442.; \\u043f\\u043e\\u0434\\u043a\\u0430\\u0437\\u0430\\u043d\\u043d\\u0438\\u043a\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"20 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0442\\u043e\\u0432\\u0430\\u0440\\u0430 \\u0431\\u0435\\u0437 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438 (\\u0433)\",\"value\":\"19500 \\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"24 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"34 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 14:20:49', '2024-08-09 14:26:39', NULL),
(12, 'Мангал для дачи 3 мм 12 шампуров с подказанником и полкой, складной', '95474787', 'https://www.wildberries.ru/catalog/95474787/detail.aspx', 6321, 0, 9, 'UniKit', 'Мангалы', 'Мангал для дачи 3 мм с подказанником и полкой, складной', 'Мангал складной на 12 шампуров, толщина стали 3 мм, с подказанником и полкой для дачи разборный, многоразовый.\nОсобенностью мангала являются разборные ножки, которые складываются внутрь. Поэтому он может быть использован как стационарный и передвижной. Изготовлен из стали толщиной 3 мм, окрашен жаростойкой порошковой краской черный графит, выдерживает температуру до 1200 градусов. Тройные боковые прорези подходят для установки любых шампуров и не дают им падать. \nВ комплект с мангалом НЕ входит решетка для гриля, угольная решетка и шампуры.\nВАЖНО! Перед применением необходимо провести термозакалку элементов - чаши - по инструкции! Кочерга применяется только после закалки поверхности.\nРазмеры мангала позволяют готовить большие порции еды для всей компании. Простой в использовании и легкий в уходе. \nВсе это делает стальной мангал идеальным выбором для любителей отдыха на природе и хорошей еды. Вы сможете наслаждаться приятным отдыхом, готовить вкусную еду и получать удовольствие от простоты и удобства использования этого прекрасного мангала.\nМангал отлично подойдёт в качестве подарка к любому событию: дню рождения, юбилею, годовщине, новоселью, 23 февраля, 14 февраля, новому году. Подарить мангал вы можете: папе, мужу, мужчине, брату, соседу, коллеге, они по достоинству оценят мангал!\n\nМангал складной, поэтому вы легко можете погрузить его в машину и взять на пикник. Для мангала не требуется особых условий хранения, мангал многоразовый, хорошо подходит для профессионального использования, кемпинга, барбекю. Мангал довольно высокий, не требует дополнительных подпорок. Мангал подходит как для приготовления шашлыка, так и других блюд на открытом огне и гриля. ', '[{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u0433\\u0440\\u0430\\u0444\\u0438\\u0442\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043d\\u0441\\u0442\\u0440\\u0443\\u043a\\u0446\\u0438\\u044f \\u043c\\u0430\\u043d\\u0433\\u0430\\u043b\\u0430\\/\\u0433\\u0440\\u0438\\u043b\\u044f\",\"value\":\"\\u043d\\u0430 \\u043d\\u043e\\u0436\\u043a\\u0430\\u0445; \\u043d\\u0430\\u043f\\u043e\\u043b\\u044c\\u043d\\u0430\\u044f; \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u0430\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043f\\u0447\\u0435\\u043d\\u0438\\u0435\",\"value\":\"\\u0412\\u043e\\u0437\\u043c\\u043e\\u0436\\u043d\\u043e\",\"charc_type\":1},{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041c\\u0430\\u043d\\u0433\\u0430\\u043b \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u043e\\u0439 - 1\\u0448\\u0442.; \\u043f\\u043e\\u043b\\u043a\\u0430; \\u043f\\u043e\\u0434\\u043a\\u0430\\u0437\\u0430\\u043d\\u043d\\u0438\\u043a\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"22 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u0435\\u0441 \\u0442\\u043e\\u0432\\u0430\\u0440\\u0430 \\u0431\\u0435\\u0437 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438 (\\u0433)\",\"value\":\"21400 \\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"24 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"34 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 14:22:30', '2024-08-09 14:25:19', NULL),
(13, 'Детский стол и стул для игр и рисования', '116317715', 'https://www.wildberries.ru/catalog/116317715/detail.aspx?targetUrl=EX', 2098, 0, 9, 'DIMDOMkids', 'Столы детские', 'Детский стол и стул для игр и рисования', 'Для каждого родителя, который ищет идеальный комплект мебели для своего ребенка, мы предлагаем деревянный детский стол и стул со спинкой - прекрасный набор для детской комнаты! Выполненный из массива сосны и ЛДСП в белом цвете, спинка стула в виде мишки с ушками. Скругленная форма столика в виде облака предотвращает травмы от углов, а спинка стула выполнена в виде ушей мишки, что делает его еще более приятным в использовании. Высота стола 48 см, а стула 28 см, диаметр столешницы 61х41 см, рассчитаны на детей от 1,5 до 4 лет.  Спинка стула обеспечивает правильную осанку во время игры или рисования. Наша мебель идеально подходит для школьного образования, развивающих игр, творчества и кормления малышей. Сборка занимает всего 5 минут, а поверхность легко моется обычными средствами. Кроме того, ножки сделаны из массива сосны, что делает этот комплект долговечным и экологически чистым. Стол разработан в России в городе Ульяновск и соответствует всем стандартам качества. Мы предоставляем сертификаты качества на все наши изделия. На каждом этапе производства проводим контроль качества. DimDomKids - это отличная альтернатива дорогим брендам по оптимальной цене. Мы также осуществляем индивидуальную упаковку для каждой детали для избежания порчи мебели при транспортировке. Современный и минималистичный дизайн обеспечивает комфорт и удобство во время использования, а также подходит для девочек и мальчиков. Этот комплект мебели - прекрасный подарок для вашего маленького ребенка на первый годик или как обновление для детской комнаты. Он поможет вашему ребенку чувствовать себя комфортно и раскрывать свое творчество!', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439 \\u043c\\u0430\\u0442\\u043e\\u0432\\u044b\\u0439; \\u0441\\u043e\\u0441\\u043d\\u0430\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439 \\u043c\\u0430\\u0442\\u043e\\u0432\\u044b\\u0439\",\"\\u0441\\u043e\\u0441\\u043d\\u0430\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043a\\u043e\\u0440\\u043f\\u0443\\u0441\\u0430 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0434\\u0440\\u0435\\u0432\\u0435\\u0441\\u0438\\u043d\\u0430; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0421\\u043e\\u0441\\u043d\\u0430 \\u0432\\u044b\\u0441\\u0448\\u0435\\u0433\\u043e \\u0441\\u043e\\u0440\\u0442\\u0430; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043d\\u043e\\u0436\\u0435\\u043a\",\"value\":\"\\u0434\\u0435\\u0440\\u0435\\u0432\\u043e; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e \\u0441\\u043e\\u0441\\u043d\\u044b; \\u043c\\u0435\\u0442\\u0430\\u043b\\u043b\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0433\\u0440\\u0443\\u0437\\u043a\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"30 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"50 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0413\\u043b\\u0443\\u0431\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"40 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"60 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0421 \\u0432\\u044b\\u0434\\u0432\\u0438\\u0436\\u043d\\u044b\\u043c \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c\",\"value\":\"\\u041d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u0430\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"6.9 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"1 \\u0441\\u0442\\u0443\\u043b; 1 \\u0441\\u0442\\u043e\\u043b; 8 \\u043d\\u043e\\u0436\\u0435\\u043a\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0421\\u043e\\u0432\\u0440\\u0435\\u043c\\u0435\\u043d\\u043d\\u044b\\u0439; \\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043a\\u0430\\u043d\\u0434\\u0438\\u043d\\u0430\\u0432\\u0441\\u043a\\u0438\\u0439\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"76 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"8 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"51 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:21:26', '2024-08-09 20:17:22', NULL),
(14, 'Детский туалетный столик и стул зайка', '226215784', 'https://www.wildberries.ru/catalog/226215784/detail.aspx?targetUrl=EX', 5417, 0, 9, 'DIMDOMkids', 'Столы детские', 'Детский туалетный столик и стул зайка', 'Откройте дверь в мир творчества и игры для вашего малыша с нашим уникальным детским столом и стулом, который станет не просто мебелью, а настоящим центром развития и вдохновения в детской комнате. Этот многофункциональный туалетный стол и стул сочетает в себе удобство и стиль, предлагая место не только для игр и рисования, но и для хранения игрушек и косметики. Сделанный из высококачественного ЛДСП с ножками из натуральной сосны, наш стол обеспечивает долговечность и безопасность, в то время как деревянные элементы добавляют теплоту интерьеру, делая его идеальным выбором как для дома, так и для дачного использования.\nКомплект включает в себя круглое зеркало, которое добавит ощущение волшебства в комнату вашей маленькой принцессы, делая утренние подготовки или игры в роли более радостными. Большой выдвижной ящик предоставит достаточно места для хранения косметических и макияжных принадлежностей, рукоделия, или игрушек, поддерживая порядок и организованность пространства.\nБыстрая и легкая сборка этого игрового стола, для которой не требуются дополнительные инструменты, позволит вам без усилий создать уютный уголок для вашего ребенка дома или на даче всего за 30 минут. Этот стол и стул - отличная альтернатива мебели из IKEA, предлагая лучшее соотношение цены и качества от российского производителя полного цикла.\nИспользование этого стола  стула способствует развитию творческих и интеллектуальных способностей ребенка, создавая идеальные условия для рисования, чтения, игры и даже учебы. Его дизайн и функциональность делают его подходящим для любого интерьера, будь то современный городской апартамент или уютный дачный домик, обеспечивая вашему ребенку идеальное место для развития и веселья.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043a\\u043e\\u0440\\u043f\\u0443\\u0441\\u0430 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u0422\\u043e\\u043b\\u0449\\u0438\\u043d\\u0430 \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"16 \\u043c\\u043c\",\"charc_type\":4},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043d\\u043e\\u0436\\u0435\\u043a\",\"value\":\"\\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0433\\u0440\\u0443\\u0437\\u043a\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"90 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0420\\u0435\\u0433\\u0443\\u043b\\u0438\\u0440\\u043e\\u0432\\u043a\\u0430\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"97 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0413\\u043b\\u0443\\u0431\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"40 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"65 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0421 \\u0432\\u044b\\u0434\\u0432\\u0438\\u0436\\u043d\\u044b\\u043c \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c\",\"value\":\"\\u0414\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043d\\u0430\\u043f\\u0440\\u0430\\u0432\\u043b\\u044f\\u044e\\u0449\\u0438\\u0445\",\"value\":\"\\u0440\\u043e\\u043b\\u0438\\u043a\\u043e\\u0432\\u044b\\u0435\",\"charc_type\":1},{\"name\":\"\\u0414\\u043e\\u0432\\u043e\\u0434\\u0447\\u0438\\u043a\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"17 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041d\\u043e\\u0436\\u043a\\u0438; \\u0437\\u0435\\u0440\\u043a\\u0430\\u043b\\u043e; \\u043a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f \\u0434\\u043b\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0438; \\u0441\\u0442\\u0443\\u043b\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u0441 \\u0437\\u0435\\u0440\\u043a\\u0430\\u043b\\u043e\\u043c; \\u0441 \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043e\\u0432\\u0440\\u0435\\u043c\\u0435\\u043d\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"74 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"10 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"57 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:24:22', '2024-08-09 20:17:11', NULL),
(15, 'Растущий стол и стул для детей', '231782161', 'https://www.wildberries.ru/catalog/231782161/detail.aspx?targetUrl=EX', 4010, -2, 9, 'DIMDOMkids', 'Наборы мебели для детей', 'Растущий стол и стул для детей ', 'Развивающий стол и стул – это современный детский набор, созданный с применением методики Монтессори. Этот комплект растущей мебели, рассчитанный на детей от года, способствует сохранению правильной осанки и предотвращает развитие близорукости у вашего ребенка.\n\nРазработанные с учетом универсальности, Развивающийся стол и стул  подойдут как для мальчиков, так и для девочек.\nМногофункциональный стол оснащен системой регулировки высоты, что позволяет адаптировать его под возраст и рост ребенка. Внутри стола предусмотрен ящик для хранения канцелярских принадлежностей или игрушек. \n\nС правой и левой стороны секции для хранения канцелярских принадлежностей. \nК тому же, на внутренней стороне столешницы расположена складная грифельная доска, которую можно использовать в качестве мольберта для развивающих плакатов или для рисования.\n\nСтульчик для детей имеет ширину 37 см, высоту до верха спинки 68 см и глубину 37 см. \n\nСтол для детей имеет ширину 77см. глубину 47 см. высоту 76см.\nЭтот стол и стул отличается высокой устойчивостью и способен выдержать нагрузку до 90 кг..\n\nРазвивающий стол и стул  идеально подходят не только для занятий и рисования, но и для кормления ребенка, игр с конструктором или крупами.\nМебель изготовлена из гипоаллергенных материалов. Каждый комплект снабжен инструкцией и крепежами для быстрой и удобной сборки.\n', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u041c\\u0414\\u0424\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0444\\u0430\\u0441\\u0430\\u0434\\u0430\",\"value\":\"\\u041b\\u041c\\u0414\\u0424\",\"charc_type\":1},{\"name\":\"\\u0420\\u0430\\u0441\\u043f\\u043e\\u043b\\u043e\\u0436\\u0435\\u043d\\u0438\\u0435 \\u0443\\u0433\\u043b\\u0430\",\"value\":\"\\u0443\\u043d\\u0438\\u0432\\u0435\\u0440\\u0441\\u0430\\u043b\\u044c\\u043d\\u043e\\u0435\",\"charc_type\":1},{\"name\":\"\\u042d\\u043b\\u0435\\u043c\\u0435\\u043d\\u0442\\u044b\",\"value\":\"\\u0433\\u0440\\u0438\\u0444\\u0435\\u043b\\u044c\\u043d\\u0430\\u044f \\u0434\\u043e\\u0441\\u043a\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u0440\\u0430\\u0441\\u0442\\u0443\\u0449\\u0430\\u044f \\u043c\\u043e\\u0434\\u0435\\u043b\\u044c\",\"charc_type\":1},{\"name\":\"\\u0420\\u0430\\u0441\\u0442\\u0443\\u0449\\u0430\\u044f \\u043c\\u043e\\u0434\\u0435\\u043b\\u044c\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0420\\u0435\\u0433\\u0443\\u043b\\u0438\\u0440\\u043e\\u0432\\u043a\\u0430\",\"value\":\"\\u043f\\u043e \\u0432\\u044b\\u0441\\u043e\\u0442\\u0435\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0441\\u0442\\u043e\\u043b,\\u0441\\u0442\\u0443\\u043b,\\u043a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f \\u0434\\u043b\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0438\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0421\\u043a\\u0430\\u043d\\u0434\\u0438\\u043d\\u0430\\u0432\\u0441\\u043a\\u0438\\u0439; \\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"18.4 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u041a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044f \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u0440\\u0430\\u0441\\u0442\\u0443\\u0449\\u0438\\u0439 \\u0441\\u0442\\u043e\\u043b \\u0438 \\u0441\\u0442\\u0443\\u043b\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"12 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"56 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:28:08', '2024-08-30 16:38:03', NULL),
(16, 'Стол и мягкий стул', '173562209', 'https://www.wildberries.ru/catalog/173562209/detail.aspx?targetUrl=EX', 3476, 0, 9, 'DIMDOMkids', 'Наборы мебели для детей', 'Стол и мягкий стул', 'Детская мебель DIMDOMkids - набор детской мебели стол и мягкий стульчик предназначены для творчества детей. За столом могут свободно расположиться 2 ребенка. Мебельный комплект для детской комнаты имеет сертификаты качества, а по отзывам наших покупателей мебель не уступает мировым брендам . Столик произведен из МДФ и массива дерева,  столешница не боится влаги и пролитой краски, в отличие от столиков из ЛДСП. Обивка стульчика из вельвета обеспечивает мягкость и комфорт для вашего ребенка. Стульчик легко моется моющими средствами, оттирается даже влажной салфеткой. Ножки из сосны. Также стол и стульчик можно использовать как парту для подготовки к школе или школьным занятиям.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0441\\u0435\\u0440\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0441\\u0435\\u0440\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041c\\u0414\\u0424; \\u043f\\u043b\\u0451\\u043d\\u043a\\u0430 \\u041f\\u0412\\u0425; \\u0432\\u0435\\u043b\\u044c\\u0432\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0444\\u0430\\u0441\\u0430\\u0434\\u0430\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0420\\u0430\\u0441\\u043f\\u043e\\u043b\\u043e\\u0436\\u0435\\u043d\\u0438\\u0435 \\u0443\\u0433\\u043b\\u0430\",\"value\":\"\\u0431\\u0435\\u0437 \\u0443\\u0433\\u043b\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u0434\\u0432\\u0435\\u0440\\u0435\\u0439\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0441\\u0442\\u043e\\u043b; \\u0441\\u0442\\u0443\\u043b; 8 \\u043d\\u043e\\u0436\\u0435\\u043a\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0421\\u043a\\u0430\\u043d\\u0434\\u0438\\u043d\\u0430\\u0432\\u0441\\u043a\\u0438\\u0439; \\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"9 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"74 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"25 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"50 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:32:57', '2024-08-09 20:17:37', NULL);
INSERT INTO `projects` (`id`, `product_name`, `product_nm`, `product_link`, `product_price`, `status`, `seller_id`, `marketplace_brand`, `marketplace_category`, `marketplace_product_name`, `marketplace_description`, `marketplace_options`, `marketplace_rate`, `is_blogger_access`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'Детский стол \"Испания\"', '219814113', 'https://www.wildberries.ru/catalog/219814113/detail.aspx', 3659, 0, 9, 'DIMDOMkids', 'Столы детские', 'Детский стол \"Испания\"', 'Стол «Испания» сочетает в себе практичность и элегантность. \nЭтот чудесный столик может превратиться в комфортное рабочее пространство или игровую площадку - идеальное место для конструктурирования ,творчества, лепки а так же  для учебы вашего ребенка.\nСтол «Испания» -Изготовленный из качественных деревянных материалов, он обеспечивает надежность и прочность, что делает его идеальным выбором для активных детских игр. \nДве большие вместительные секции внутри и компактные размеры этого столика делают его отличным решением для любого дома .\nС яркими, забавными акцентами ваш ребенок будет погружаться в мир волшебства и фантазии.\nЭто настоящий темпл для детского творчества и обучения.\n', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043a\\u043e\\u0440\\u043f\\u0443\\u0441\\u0430 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0414\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u0422\\u043e\\u043b\\u0449\\u0438\\u043d\\u0430 \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"16 \\u043c\\u043c\",\"charc_type\":4},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043d\\u043e\\u0436\\u0435\\u043a\",\"value\":\"\\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0433\\u0440\\u0443\\u0437\\u043a\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"90 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"54 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0413\\u043b\\u0443\\u0431\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"55 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"80080 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0421 \\u0432\\u044b\\u0434\\u0432\\u0438\\u0436\\u043d\\u044b\\u043c \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c\",\"value\":\"\\u041d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043d\\u0430\\u043f\\u0440\\u0430\\u0432\\u043b\\u044f\\u044e\\u0449\\u0438\\u0445\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0414\\u043e\\u0432\\u043e\\u0434\\u0447\\u0438\\u043a\",\"value\":\"\\u0411\\u0435\\u0437 \\u0434\\u043e\\u0432\\u043e\\u0434\\u0447\\u0438\\u043a\\u0430\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u0430\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"15 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0421\\u0442\\u043e\\u043b; \\u041d\\u043e\\u0436\\u043a\\u0438; \\u041a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u043d\\u0430 \\u043d\\u043e\\u0436\\u043a\\u0430\\u0445; \\u0441 \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c; \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u0430\\u044f \\u043a\\u043e\\u043d\\u0441\\u0442\\u0440\\u0443\\u043a\\u0446\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043e\\u0432\\u0440\\u0435\\u043c\\u0435\\u043d\\u043d\\u044b\\u0439; \\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044f \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u0418\\u0441\\u043f\\u0430\\u043d\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"81 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"8 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"61 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:35:25', '2024-08-09 20:17:48', NULL),
(18, 'Туалетный столик белый с зеркалом и ящиком в спальню', '215490154', 'https://www.wildberries.ru/catalog/215490154/detail.aspx', 5747, 1, 9, 'DIMDOMkids', 'Столики туалетные', 'Туалетный столик белый с зеркалом и ящиком в спальню', 'Откройте для себя идеальный мир утончённости и порядка с нашим эксклюзивным туалетным столиком с зеркалом. \nЭтот изысканный столик, имеет уникальным дизайн и функциональность и предлагает безупречное решение для хранения ваших любимых косметических средств и аксессуаров, придавая вашему пространству неповторимый шарм и удобство.\nНаши столик, подходит для любого интерьера: от классического до современного лофта.\nЕсли вы ищете что-то особенное для маленькой принцессы, девушки, женщины наш туалетный столик с зеркалом или туалетный столик для девочки с зеркалом станет восхитительным дополнением к её комнате, обеспечивая идеальное место для игр в красоту.\nДля тех, кто предпочитает минимализм или имеет ограниченное пространство, наш напольный туалетный столик легко впишется в ваш интерьер за счет небольшого размера, при этом вы сэкономите ваше пространство и время.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0444\\u0430\\u0441\\u0430\\u0434\\u0430\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u0413\\u043b\\u0443\\u0431\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"40 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"65 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"135 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u041a\\u043e\\u043b\\u0438\\u0447\\u0435\\u0441\\u0442\\u0432\\u043e \\u044f\\u0449\\u0438\\u043a\\u043e\\u0432\",\"value\":\"1\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u043b\\u0438\\u0447\\u0438\\u0435 \\u0437\\u0435\\u0440\\u043a\\u0430\\u043b\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"6 \\u0441\\u0435\\u043a\\u0446\\u0438\\u0439\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"20.6 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041d\\u043e\\u0436\\u043a\\u0438,\\u0437\\u0435\\u0440\\u043a\\u0430\\u043b\\u043e,\\u043a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442 \\u0434\\u043b\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0438\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439; \\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043e\\u0432\\u0440\\u0435\\u043c\\u0435\\u043d\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"11 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"57 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:47:55', '2024-08-26 14:45:28', NULL),
(19, 'Кровать детская', '173430042', 'https://www.wildberries.ru/catalog/173430042/detail.aspx?targetUrl=EX', 5228, 0, 9, 'DIMDOMkids', 'Кровати детские', 'Кровать детская', 'Если вы ищете идеальную детскую односпальную кровать для вашего малыша или подростка, то кроватка с бортиком от бренда DimDomKids - это именно то, что вам нужно! Эта деревянная кровать из гипоаллергенных материалов представлена в белом цвете. Общий размер кровати 165x75 см. Размер спального места 160х70 см, идеально подходит для мальчиков и девочек в возрасте от 2 до 10 лет. За счет этого позволяет ребенку спать комфортно, а также поместить матрас без проблем. А комфортный сон – это залог здоровья! Бортики на спальном месте классической формы обеспечат безопасность вашего малыша или подростка в течение всей ночи. Идеально подходит для детской или подростковой комнаты в любом интерьере, а также для дачи. Изголовье и изножье классической  формы придаст интерьеру вашей комнаты изысканный вид. \nСделана из ЛДСП – изголовья, изножье, царги и бортик, а ножки изготовлены из сосны, что гарантирует ее надежность и долговечность. Легкая в установке и сборке, что позволяет разместить ее в любой квартире. Ортопедическое основание и бортики также входят в комплект, что обеспечивает полный комфорт вашего малыша или подростка во время сна. Ящики в комплект не входят.\nЕе прямоугольная форма делает ее универсальной для любых детских комнат. Приобретите мебель от DimDomKids и вы обеспечите своего ребенка здоровым и комфортным сном каждую ночь! В настоящее время мы предлагаем акцию, где вы можете получить скидку на этот российский бренд полного цикла производства. Вся мебель изготовлена из экологичных и безопасных материалов. DIMDOMkids имеет сертификаты качества, а по отзывам наших покупателей мебель не уступает мировым брендам. Так что не упустите возможность купить эту прекрасную кровать по привлекательной цене.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u0434\\u0435\\u0440\\u0435\\u0432\\u043e; \\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u0420\\u0430\\u0437\\u043c\\u0435\\u0440 \\u0441\\u043f\\u0430\\u043b\\u044c\\u043d\\u043e\\u0433\\u043e \\u043c\\u0435\\u0441\\u0442\\u0430\",\"value\":\"160x70\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"70\\u0445160 \\u0441\\u043c\"]},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u043c\\u0438\\u043d\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"160 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"165 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0438\\u0437\\u043d\\u043e\\u0436\\u044c\\u044f\",\"value\":\"65 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0438\\u0437\\u0433\\u043e\\u043b\\u043e\\u0432\\u044c\\u044f\",\"value\":\"65 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u041d\\u0430\\u0433\\u0440\\u0443\\u0437\\u043a\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"100 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441 \\u0441\\u0432\\u043e\\u0431 \\u043f\\u0440\\u043e\\u0441\\u0442\\u0440\\u0430\\u043d\\u0441\\u0442\\u0432\\u0430 \\u043f\\u043e\\u0434 \\u043c\\u0435\\u0431\\u0435\\u043b\\u044c\\u044e\",\"value\":\"17 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u041c\\u0435\\u0445\\u0430\\u043d\\u0438\\u0437\\u043c \\u043a\\u0430\\u0447\\u0430\\u043d\\u0438\\u044f\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043f\\u0435\\u0442\\u0435\\u043b\\u044c \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043d\\u043e\\u0432\\u0430\\u043d\\u0438\\u0435 \\u0432 \\u043a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0435\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u043a\\u0440\\u043e\\u0432\\u0430\\u0442\\u044c; 2 \\u0431\\u043e\\u0440\\u0442\\u0438\\u043a\\u0430; \\u043e\\u0441\\u043d\\u043e\\u0432\\u0430\\u043d\\u0438\\u0435; \\u043d\\u043e\\u0436\\u043a\\u0438; \\u043a\\u0440\\u0435\\u043f\\u0435\\u0436\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"24.4 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"13 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"60 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 19:57:13', '2024-08-09 20:18:10', NULL),
(20, 'Кроватка с мягким изголовьем', '179332745', 'https://www.wildberries.ru/catalog/179332744/detail.aspx?targetUrl=EX', 5653, 0, 9, 'DIMDOMkids', 'Кровати детские', 'Кроватка с мягким изголовьем', 'Мягкая кроватка с бортиком от бренда DimDomKids - это именно то, что вам нужно! Эта деревянная кровать из гипоаллергенных материалов. Сделана из ЛДСП, ножки изготовлены из сосны. Обшивка изголовий и бортика - велюр. Покрытие обратной стороны изголовия - чёрный спанбонд.  Размер спального места 160х70 см, общие габариты кровати 165х75 см, идеально подходит для мальчиков и девочек в возрасте от 2 до 10 лет.  Ортопедическое основание и бортик также входят в комплект, что обеспечивает полный комфорт вашего малыша или подростка во время сна. Ящики и матрас в комплект не входят.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0441\\u0438\\u043d\\u0438\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0441\\u0438\\u043d\\u0438\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u0432\\u0435\\u043b\\u044e\\u0440; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e; \\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u0420\\u0430\\u0437\\u043c\\u0435\\u0440 \\u0441\\u043f\\u0430\\u043b\\u044c\\u043d\\u043e\\u0433\\u043e \\u043c\\u0435\\u0441\\u0442\\u0430\",\"value\":\"160*70\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"70\\u0445160 \\u0441\\u043c\"]},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u043c\\u0438\\u043d\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"160 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"165 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0438\\u0437\\u043d\\u043e\\u0436\\u044c\\u044f\",\"value\":\"36 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0438\\u0437\\u0433\\u043e\\u043b\\u043e\\u0432\\u044c\\u044f\",\"value\":\"75 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u041d\\u0430\\u0433\\u0440\\u0443\\u0437\\u043a\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"120 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441 \\u0441\\u0432\\u043e\\u0431 \\u043f\\u0440\\u043e\\u0441\\u0442\\u0440\\u0430\\u043d\\u0441\\u0442\\u0432\\u0430 \\u043f\\u043e\\u0434 \\u043c\\u0435\\u0431\\u0435\\u043b\\u044c\\u044e\",\"value\":\"17 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u041c\\u0435\\u0445\\u0430\\u043d\\u0438\\u0437\\u043c \\u043a\\u0430\\u0447\\u0430\\u043d\\u0438\\u044f\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043d\\u043e\\u0432\\u0430\\u043d\\u0438\\u0435 \\u0432 \\u043a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0435\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u043a\\u0440\\u043e\\u0432\\u0430\\u0442\\u044c; \\u0431\\u043e\\u0440\\u0442\\u0438\\u043a; \\u043d\\u043e\\u0436\\u043a\\u0438\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"23 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"79 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"15 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"60 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 20:00:01', '2024-08-09 20:18:43', NULL),
(21, 'Мольберт детский', '215455255', 'https://www.wildberries.ru/catalog/215455255/detail.aspx', 4571, 0, 9, 'DIMDOMkids', 'Мольберты', 'Мольберт детский\n', 'Откройте дверь в мир фантазии и творчества для вашего ребенка с детским мольбертом . Этот уникальный двухсторонний мольберт предлагает не только возможность рисования на доске, но и обеспечивает удобство использования благодаря своей мобильности на колесиках. Изготовленный из высококачественного деревянного материала, этот напольный мольберт гарантирует долговечность и безопасность для вашего малыша.\nНезависимо от того, предпочитает ли ваш ребенок рисовать мелками или фломастерами, детский двухсторонний мольберт Твин-Арт идеально подходит для развития творческих навыков. \nУникальность этого мольберта также заключается в его дополнительных функциях. Оснащенный двумя полками для хранения наборов для рисования и третьей полкой-сумкой из прочного материала для аксессуаров, он предлагает достаточно места для всех необходимых принадлежностей. К тому же, в комплект входит рулон бумаги, который легко крепится к мольберту, обеспечивая еще одну удобную поверхность для творчества.\nВысота мольберта в 1.40 м и ширина 56 см делают его идеальным выбором для детей разных возрастных групп, позволяя мольберту расти вместе с вашим ребенком. Выбирая наш детский мольберт  вы не только поддерживаете и развиваете творческие способности вашего ребенка, но и предоставляете ему инструмент для радости и обучения каждый день.\n', '[{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"140 \\u0441\\u043c\",\"is_variable\":true,\"charc_type\":4},{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u041c\\u0414\\u0424; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e; \\u0444\\u0430\\u043d\\u0435\\u0440\\u0430\",\"charc_type\":1},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"60 \\u0441\\u043c\",\"is_variable\":true,\"charc_type\":4},{\"name\":\"\\u0412\\u043e\\u0437\\u0440\\u0430\\u0441\\u0442\\u043d\\u044b\\u0435 \\u043e\\u0433\\u0440\\u0430\\u043d\\u0438\\u0447\\u0435\\u043d\\u0438\\u044f\",\"value\":\"+10\\u043c\\u0435\\u0441\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043c\\u043e\\u043b\\u044c\\u0431\\u0435\\u0440\\u0442\\u0430\",\"value\":\"\\u043d\\u0430\\u043f\\u043e\\u043b\\u044c\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u043c\\u043e\\u043b\\u044c\\u0431\\u0435\\u0440\\u0442; 2 \\u0434\\u043e\\u0441\\u043a\\u0438 \\u0434\\u043b\\u044f \\u0440\\u0438\\u0441\\u043e\\u0432\\u0430\\u043d\\u0438\\u044f; \\u0441\\u0443\\u043c\\u043a\\u0430; \\u043a\\u043e\\u043b\\u0435\\u0441\\u0438\\u043a\\u0438; \\u0431\\u0443\\u043c\\u0430\\u0433\\u0430 \\u0434\\u043b\\u044f \\u0440\\u0438\\u0441\\u043e\\u0432\\u0430\\u043d\\u0438\\u044f; \\u043a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f \\u0434\\u043b\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0438\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"16.8 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"82 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"10 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"61 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 20:04:54', '2024-08-09 20:18:52', NULL),
(22, 'Стол-сумка \"Мишка\" и стул \"Мишка\"белый', '219870745', 'https://www.wildberries.ru/catalog/219870745/detail.aspx', 3626, 0, 9, 'DIMDOMkids', 'Наборы мебели для детей', 'Стол-сумка \"Мишка\" и стул \"Мишка\"белый', 'Стол-сумка \"Мишка\" и стул \"Мишка\" белый- это больше, чем обычный детский стол и стул. \nОн способствует развитию фантазии и творческого мышления вашего ребенка. \nБольшая рабочая поверхность предоставляет место для игры в конструкторы, рисования красками, лепкой и т.д.\nНаш столик оборудован сумкой внутри стола ,что позволяет складывать все игровые элементы внутрь стола, то есть в сумку, в которой будут храниться все игрушки вашего ребенка, а стульчик позволит удобно и комфортно заниматься за этим столом.\n\nСтол-сумка \"Мишка\" и стул \"Мишка\" функциональный детский столик со стульчиком, который прекрасно подходит для домашней атмосферы и детских уголков. \nНаш набор детской мебели является развивающим и способствует формированию моторики речи, координации движений и мышления у детей. \nСтол-сумка и стульчик имеет складной дизайн, что позволяет легко хранить его в уголке или под столом, когда он не используется. \nЭтот столик и стульчик может быть использован для рисования, игр, занятий по монтессори и других развивающих занятий. \nСтол-сумка , сделанный из высококачественного дерева и МДФ он экологичен и безопасен для детей. \n\nИгровой уголок становится магическим местом, где дети впитывают знания и развивают свои таланты.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u0434\\u0435\\u0440\\u0435\\u0432\\u043e; \\u043c\\u0434\\u0444\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0421\\u0442\\u043e\\u043b; \\u0421\\u0443\\u043c\\u043a\\u0430; \\u041d\\u043e\\u0436\\u043a\\u0438; \\u041a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f; \\u0441\\u0442\\u0443\\u043b\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043a\\u0430\\u043d\\u0434\\u0438\\u043d\\u0430\\u0432\\u0441\\u043a\\u0438\\u0439\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044f \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u0421\\u0442\\u043e\\u043b-\\u0421\\u0443\\u043c\\u043a\\u0430\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"76 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"8 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"51 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 20:07:02', '2024-08-09 20:18:22', NULL),
(23, 'Стеллаж (комод) детский \"Лео 4\"', '205434762', 'https://www.wildberries.ru/catalog/205434762/detail.aspx?targetUrl=EX', 4139, 0, 9, 'DIMDOMkids', 'Стеллажи детские', 'Стеллаж детский \"Лео 4\" корпус Клен / ящики Белые', 'Детский комод «Лео», изготовленный из качественной ЛДСП, станет идеальным решением для организации пространства и хранения вещей в детской комнате. Два вместительных ящика помогут аккуратно разложить все детские вещи и аксессуары, а компактная конструкция сэкономит место. Гладкая поверхность и безопасные материалы комода обеспечат комфорт и защиту для вашего малыша. Классический стиль и разные цвета комода позволят ему легко вписаться в интерьер любой детской. Комод «Лео» - это решение, которое позволяет использовать пространство рационально. Вы можете выбрать подходящую мебель, которая подойдет для вашего интерьера и будет выполнять все необходимые функции. В нашем каталоге вы найдете комоды с ящиками, которые подойдут для детской комнаты, прихожей, спальни и даже гостиной. Мы предлагаем комоды различных размеров и цветов, чтобы вы могли выбрать тот, который лучше всего подходит для вашего дома. Не упустите возможность приобрести качественную мебель по доступной цене.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u043a\\u043b\\u0435\\u043d; \\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u043a\\u043b\\u0435\\u043d\",\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043b\\u0438\\u0447\\u0435\\u0441\\u0442\\u0432\\u043e \\u044f\\u0449\\u0438\\u043a\\u043e\\u0432\",\"value\":\"2 \\u0448\\u0442.\",\"charc_type\":1},{\"name\":\"\\u0413\\u043b\\u0443\\u0431\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"40 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"63.5 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"67.5 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"24.9 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u041a\\u043e\\u043c\\u043e\\u0434; \\u0418\\u043d\\u0441\\u0442\\u0440\\u0443\\u043a\\u0446\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"76 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"17 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"48 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 20:09:41', '2024-08-09 20:19:03', NULL),
(24, 'Детский стол Монтессори', '219808986', 'https://www.wildberries.ru/catalog/219808986/detail.aspx?targetUrl=GP', 3136, 0, 9, 'DIMDOMkids', 'Столы детские', 'Детский стол Монтессори', 'Наш Детский стол Монтессори это - Игровой уголок который становится магическим местом, где дети впитывают знания и развивают свои таланты.\n\nСтол для детей порадует как самых маленьких, так и уже подросших. Большую игру можно начать с него!\n\nРазвивающий столик Монтессори - настоящая находка для создания эффективной зоны творчества.\n\nОн, как волшебник, притягивает внимание своей функциональностью и безупречным дизайном, способным вдохновить ребенка на чудесные открытия. \n\nБлагодаря своему разнообразию возможностей, он не только служит простым и удобным рабочим местом для детского творчества. \n\nОн очень функционален: благодаря выдвижному ящику и двум секциям у него внутри, в него можно складывать карандаши тетради книги и многое другое. \n\nСозданный из натурального материала позволяет вашему малышу почувствовать свежесть деревянных поверхностей и полностью погрузиться в процесс экспериментирования и открытий.\n\nСтол предназначен для игр и развивающих занятий СТОЯ.\n', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043a\\u043e\\u0440\\u043f\\u0443\\u0441\\u0430 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0414\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"\\u041b\\u0414\\u0421\\u041f\",\"charc_type\":1},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041b\\u0414\\u0421\\u041f; \\u0414\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u0422\\u043e\\u043b\\u0449\\u0438\\u043d\\u0430 \\u0441\\u0442\\u043e\\u043b\\u0435\\u0448\\u043d\\u0438\\u0446\\u044b\",\"value\":\"16 \\u043c\\u043c\",\"charc_type\":4},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u043d\\u043e\\u0436\\u0435\\u043a\",\"value\":\"\\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0433\\u0440\\u0443\\u0437\\u043a\\u0430 \\u043c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u0430\\u044f\",\"value\":\"90 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0420\\u0435\\u0433\\u0443\\u043b\\u0438\\u0440\\u043e\\u0432\\u043a\\u0430\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"40 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0413\\u043b\\u0443\\u0431\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"75 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\",\"value\":\"75 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0421 \\u0432\\u044b\\u0434\\u0432\\u0438\\u0436\\u043d\\u044b\\u043c \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c\",\"value\":\"\\u0414\\u0430\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043d\\u0430\\u043f\\u0440\\u0430\\u0432\\u043b\\u044f\\u044e\\u0449\\u0438\\u0445\",\"value\":\"\\u0440\\u043e\\u043b\\u0438\\u043a\\u043e\\u0432\\u044b\\u0435\",\"charc_type\":1},{\"name\":\"\\u0414\\u043e\\u0432\\u043e\\u0434\\u0447\\u0438\\u043a\",\"value\":\"\\u0411\\u0435\\u0437 \\u0434\\u043e\\u0432\\u043e\\u0434\\u0447\\u0438\\u043a\\u0430\",\"charc_type\":1},{\"name\":\"\\u041d\\u0430\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u0430\",\"value\":\"\\u043d\\u0435\\u0442\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"16.6 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0421\\u0442\\u043e\\u043b; \\u041d\\u043e\\u0436\\u043a\\u0438; \\u041a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u043d\\u0430 \\u043d\\u043e\\u0436\\u043a\\u0430\\u0445; \\u0441 \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043e\\u0432\\u0440\\u0435\\u043c\\u0435\\u043d\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044f \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u041c\\u043e\\u043d\\u0442\\u0435\\u0441\\u0441\\u043e\\u0440\\u0438\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"80 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"9 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"56 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 20:13:59', '2024-08-09 20:18:33', NULL),
(25, 'Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', '221721111', 'https://www.wildberries.ru/catalog/221721111/detail.aspx', 4182, 0, 9, 'DIMDOMkids', 'Столы детские', 'Детский Стол-Парта Прямоугольный и стул \"Мишка\" белый', 'Детский Стол-Парта прямоугольный и стул \"Зайка\" белый  - это набор детской мебели, стол и стул , который станет отличным решением для обустройства детской комнаты.\n\nОн выполнен в современном дизайне и имеет откидную крышку с газлифтом, секцию под крышкой что позволяет сэкономить место в комнате.\n\nДанный комплект детской мебели идеально подходит для детских занятий, таких как рисование или конструирование. \nВ нем удобно хранить книги, игрушки или другие предметы. \n\nБлагодаря своей универсальности и функциональности, Детский Стол-Парта и стул станет отличным выбором для вашего ребенка и поможет ему развиваться и обучаться в игровой форме.\n\nДизайн стола и стула выполнен в современном стиле, что позволяет ему гармонично вписаться в любой интерьер. Кроме того, стол и стул доступен в различных формах, что позволяет вам выбрать наиболее подходящий для вашей детской комнаты вариант.', '[{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0431\\u0435\\u043b\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0431\\u0435\\u043b\\u044b\\u0439\"]},{\"name\":\"\\u041c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b \\u0438\\u0437\\u0434\\u0435\\u043b\\u0438\\u044f\",\"value\":\"\\u041c\\u0414\\u0424 \\u043f\\u043b\\u0435\\u043d\\u043a\\u0430; \\u0434\\u0435\\u0440\\u0435\\u0432\\u043e\",\"charc_type\":1},{\"name\":\"\\u0422\\u0440\\u0435\\u0431\\u0443\\u0435\\u0442\\u0441\\u044f \\u0441\\u0431\\u043e\\u0440\\u043a\\u0430\",\"value\":\"\\u0434\\u0430\",\"charc_type\":1},{\"name\":\"\\u0412\\u0435\\u0441 \\u0441 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u043e\\u0439 (\\u043a\\u0433)\",\"value\":\"14 \\u043a\\u0433\",\"charc_type\":4},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0421\\u0442\\u043e\\u043b; \\u041d\\u043e\\u0436\\u043a\\u0438\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u043d\\u0430 \\u043d\\u043e\\u0436\\u043a\\u0430\\u0445; \\u0441 \\u044f\\u0449\\u0438\\u043a\\u043e\\u043c; \\u0441\\u043a\\u043b\\u0430\\u0434\\u043d\\u0430\\u044f \\u043a\\u043e\\u043d\\u0441\\u0442\\u0440\\u0443\\u043a\\u0446\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0438\\u043b\\u044c \\u0434\\u0438\\u0437\\u0430\\u0439\\u043d\\u0430\",\"value\":\"\\u0414\\u0435\\u0442\\u0441\\u043a\\u0438\\u0439; \\u041a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0439; \\u0421\\u043e\\u0432\\u0440\\u0435\\u043c\\u0435\\u043d\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044f \\u043c\\u0435\\u0431\\u0435\\u043b\\u0438\",\"value\":\"\\u0421\\u0442\\u043e\\u043b-\\u043f\\u0430\\u0440\\u0442\\u0430\",\"charc_type\":1},{\"name\":\"\\u0414\\u043b\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"77 \\u0441\\u043c\"},{\"name\":\"\\u0412\\u044b\\u0441\\u043e\\u0442\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"8 \\u0441\\u043c\"},{\"name\":\"\\u0428\\u0438\\u0440\\u0438\\u043d\\u0430 \\u0443\\u043f\\u0430\\u043a\\u043e\\u0432\\u043a\\u0438\",\"value\":\"51 \\u0441\\u043c\"}]', NULL, 1, '2024-08-09 20:16:08', '2024-08-09 20:16:52', NULL),
(26, 'Футболка женская с принтом хлопок', '226494492', 'https://www.wildberries.ru/catalog/226494492/detail.aspx', 3564, 0, 9, 'ZUFA PIXEL', 'Футболки', 'Футболка женская с принтом хлопок', 'Zufa Pixel — это первая в мире женская футболка с принтом , изображение на которую вы выбираете и наносите сами по своей фотографии на базовой черной футболке для женщин. \nЗагружаете свое фото на сайт, получаете подробную инструкцию по его нанесению в формате пиксель арт и рисуете собственную фотографию. Женская футболка с принтом Зуфа Пиксель может быть прекрасным подарком для подростка или любимой подруги, т.к. они смогут собрать собственную фотографию. \nКраска наносится точками и в результате выглядит словно сделано стразами.\nКраскам не страшна стирка, они высыхают за 1 час, в комплекте есть все необходимое для нанесения качественной картинки.\nВы сами можете нанести рисунок с фото или, например, с надписью или логотипом, тогда получится подарок сделанный своими руками. \nСвободная футболка оверсайз с крутым декоративным фото отлично вписывается в популярные молодежные стили и подойдет для дома.\nВ качестве принта можно выбрать мем или смешной рисунок Душнила.\nКартинка также может быть любимым героем.\nМожно покупать парные наборы для влюбленных.\nПри пошиве мы используем высококачественную ткань из 100% хлопка высокой плотности 180 г/м, которая обеспечивает максимальный комфорт летом и весной. \nОбладает прямым кроем y2k.\nДля того, чтобы посадка была укороченная, возьмите свой размер или на 1 меньше.\nЕсли хотите, чтобы посадка была oversize, то возьмите на 1-2 размера больше..,', '[{\"name\":\"\\u0421\\u043e\\u0441\\u0442\\u0430\\u0432\",\"value\":\"\\u0445\\u043b\\u043e\\u043f\\u043e\\u043a; \\u0430\\u043a\\u0440\\u0438\\u043b\",\"charc_type\":1},{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\"]},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u043e\\u0434\\u0435\\u043b\\u0438\",\"value\":\"\\u043f\\u0440\\u044f\\u043c\\u043e\\u0439 \\u043a\\u0440\\u043e\\u0439\",\"charc_type\":1},{\"name\":\"\\u0414\\u0435\\u043a\\u043e\\u0440\\u0430\\u0442\\u0438\\u0432\\u043d\\u044b\\u0435 \\u044d\\u043b\\u0435\\u043c\\u0435\\u043d\\u0442\\u044b\",\"value\":\"\\u0430\\u043f\\u043f\\u043b\\u0438\\u043a\\u0430\\u0446\\u0438\\u044f; \\u0431\\u0435\\u0437 \\u044d\\u043b\\u0435\\u043c\\u0435\\u043d\\u0442\\u043e\\u0432\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043a\\u0430\\u0440\\u043c\\u0430\\u043d\\u043e\\u0432\",\"value\":\"\\u0431\\u0435\\u0437 \\u043a\\u0430\\u0440\\u043c\\u0430\\u043d\\u043e\\u0432\",\"charc_type\":1},{\"name\":\"\\u0412\\u044b\\u0440\\u0435\\u0437 \\u0433\\u043e\\u0440\\u043b\\u043e\\u0432\\u0438\\u043d\\u044b\",\"value\":\"U-\\u043e\\u0431\\u0440\\u0430\\u0437\\u043d\\u044b\\u0439\",\"charc_type\":1},{\"name\":\"\\u041f\\u043e\\u043a\\u0440\\u043e\\u0439\",\"value\":\"\\u043f\\u0440\\u044f\\u043c\\u043e\\u0439\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0444\\u0443\\u0442\\u0431\\u043e\\u043b\\u043a\\u0430 \\u0447\\u0451\\u0440\\u043d\\u0430\\u044f \\u043a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0430\\u044f \\u0441 \\u0442\\u0435\\u0445\\u043d\\u0438\\u0447\\u0435\\u0441\\u043a\\u043e\\u0439 \\u0441\\u0435\\u0442\\u043a\\u043e\\u0439 - 1 \\u0448\\u0442; \\u043a\\u0440\\u0430\\u0441\\u043a\\u0438 \\u043f\\u043e \\u0442\\u043a\\u0430\\u043d\\u0438 - 8 \\u0448\\u0442; \\u043c\\u0438\\u043a\\u0440\\u043e\\u0431\\u0440\\u0430\\u0448\\u0438 \\u0434\\u043b\\u044f \\u043d\\u0430\\u043d\\u0435\\u0441\\u0435\\u043d\\u0438\\u044f \\u043a\\u0440\\u0430\\u0441\\u043a\\u0438 - 20 \\u0448\\u0442; \\u0437\\u0430\\u0436\\u0438\\u043c\\u044b \\u0434\\u043b\\u044f \\u0444\\u0438\\u043a\\u0441\\u0430\\u0446\\u0438\\u0438 \\u0444\\u0443\\u0442\\u0431\\u043e\\u043b\\u043a\\u0438 - 6 \\u0448\\u0442\",\"charc_type\":1},{\"name\":\"\\u0423\\u0445\\u043e\\u0434 \\u0437\\u0430 \\u0432\\u0435\\u0449\\u0430\\u043c\\u0438\",\"value\":\"\\u0440\\u0443\\u0447\\u043d\\u0430\\u044f \\u0441\\u0442\\u0438\\u0440\\u043a\\u0430\",\"charc_type\":1}]', NULL, 1, '2024-08-12 08:34:29', '2024-08-12 08:34:45', NULL),
(27, 'Электротриммер садовый Partner for Garden ЕТ 2800', '511078194', 'https://www.ozon.ru/product/elektrokosa-dlya-kosheniya-travy-elektrotrimmer-sadovyy-partner-for-garden-et-2800-2800-vt-nozh-3t-511078194/', 7204, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-12 16:03:12', '2024-08-12 16:04:12', NULL);
INSERT INTO `projects` (`id`, `product_name`, `product_nm`, `product_link`, `product_price`, `status`, `seller_id`, `marketplace_brand`, `marketplace_category`, `marketplace_product_name`, `marketplace_description`, `marketplace_options`, `marketplace_rate`, `is_blogger_access`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 'Брюки школьные классические палаццо', '150450527', 'https://www.wildberries.ru/catalog/150450527/detail.aspx', 2277, 1, 31, 'GULAM', 'Брюки', 'Брюки школьные классические палаццо', 'Стильные женские классические брюки палаццо с карманами - это базовый гардероб каждой девушки. Широкие брюки клеш делают образ элегантным, вытягивают силуэт, визуально удлиняют ноги, придают стройность. Чёрные брюки палаццо с завышенной талией помогут Вам создать образ для офиса, для учебы, для отдыха с подругами и близкими. Брюки клеш станут вашей любимой базовой вещью, которую легко сочетать с блузами, классическими рубашками и топами. брюки женские штаны палаццо классические школьная форма широкие клеш для девочки в школу осенние плотные размер больших черные с высокой талией легкие свободные осень посадкой прямые карманами стрейчевые офисные классика дома модные офис', '[{\"name\":\"\\u0421\\u043e\\u0441\\u0442\\u0430\\u0432\",\"value\":\"\\u0432\\u0438\\u0441\\u043a\\u043e\\u0437\\u0430, \\u043f\\u043e\\u043b\\u0438\\u044d\\u0441\\u0442\\u0435\\u0440\",\"charc_type\":1},{\"name\":\"\\u0426\\u0432\\u0435\\u0442\",\"value\":\"\\u0433\\u043b\\u0443\\u0431\\u043e\\u043a\\u0438\\u0439 \\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\",\"is_variable\":true,\"charc_type\":1,\"variable_values\":[\"\\u0433\\u043b\\u0443\\u0431\\u043e\\u043a\\u0438\\u0439 \\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\"]},{\"name\":\"\\u0421\\u0435\\u0437\\u043e\\u043d\",\"value\":\"\\u043a\\u0440\\u0443\\u0433\\u043b\\u043e\\u0433\\u043e\\u0434\\u0438\\u0447\\u043d\\u044b\\u0439; \\u043b\\u0435\\u0442\\u043e; \\u0434\\u0435\\u043c\\u0438\\u0441\\u0435\\u0437\\u043e\\u043d\",\"charc_type\":1},{\"name\":\"\\u041e\\u0441\\u043e\\u0431\\u0435\\u043d\\u043d\\u043e\\u0441\\u0442\\u0438 \\u043c\\u043e\\u0434\\u0435\\u043b\\u0438\",\"value\":\"\\u043a\\u043b\\u0430\\u0441\\u0441\\u0438\\u0447\\u0435\\u0441\\u043a\\u0430\\u044f \\u043c\\u043e\\u0434\\u0435\\u043b\\u044c\",\"charc_type\":1},{\"name\":\"\\u0420\\u0430\\u0437\\u043c\\u0435\\u0440 \\u043d\\u0430 \\u043c\\u043e\\u0434\\u0435\\u043b\\u0438\",\"value\":\"S(42)\",\"charc_type\":1},{\"name\":\"\\u0420\\u043e\\u0441\\u0442 \\u043c\\u043e\\u0434\\u0435\\u043b\\u0438 \\u043d\\u0430 \\u0444\\u043e\\u0442\\u043e\",\"value\":\"170 \\u0441\\u043c\",\"charc_type\":4},{\"name\":\"\\u0422\\u0438\\u043f \\u043f\\u043e\\u0441\\u0430\\u0434\\u043a\\u0438\",\"value\":\"\\u0432\\u044b\\u0441\\u043e\\u043a\\u0430\\u044f\",\"charc_type\":1},{\"name\":\"\\u0421\\u0442\\u0440\\u0430\\u043d\\u0430 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u0434\\u0441\\u0442\\u0432\\u0430\",\"value\":\"\\u0420\\u043e\\u0441\\u0441\\u0438\\u044f\",\"charc_type\":1},{\"name\":\"\\u0412\\u0438\\u0434 \\u0437\\u0430\\u0441\\u0442\\u0435\\u0436\\u043a\\u0438\",\"value\":\"\\u043c\\u043e\\u043b\\u043d\\u0438\\u044f; \\u043f\\u0443\\u0433\\u043e\\u0432\\u0438\\u0446\\u044b\",\"charc_type\":1},{\"name\":\"\\u0422\\u0438\\u043f \\u043a\\u0430\\u0440\\u043c\\u0430\\u043d\\u043e\\u0432\",\"value\":\"\\u0431\\u043e\\u043a\\u043e\\u0432\\u044b\\u0435 \\u043a\\u0430\\u0440\\u043c\\u0430\\u043d\\u044b\",\"charc_type\":1},{\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\",\"value\":\"\\u0411\\u0440\\u044e\\u043a\\u0438 - 1 \\u0448\\u0442\",\"charc_type\":1},{\"name\":\"\\u0423\\u0445\\u043e\\u0434 \\u0437\\u0430 \\u0432\\u0435\\u0449\\u0430\\u043c\\u0438\",\"value\":\"\\u0411\\u0435\\u0440\\u0435\\u0436\\u043d\\u0430\\u044f \\u0441\\u0442\\u0438\\u0440\\u043a\\u0430 30 C \\u043e\\u0442\\u0431\\u0435\\u043b\\u0438\\u0432\\u0430\\u043d\\u0438\\u0435 \\u0437\\u0430\\u043f\\u0440\\u0435\\u0449\\u0435\\u043d\\u043e; \\u0433\\u043b\\u0430\\u0434\\u0438\\u0442\\u044c \\u043d\\u0430 \\u043d\\u0438\\u0437\\u043a\\u043e\\u0439 \\u0442\\u0435\\u043c\\u043f\\u0435\\u0440\\u0430\\u0442\\u0443\\u0440\\u0435\",\"charc_type\":1}]', NULL, 1, '2024-08-14 10:52:43', '2024-08-22 07:02:34', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint UNSIGNED NOT NULL,
  `source_id` bigint UNSIGNED NOT NULL,
  `type` int NOT NULL DEFAULT '0',
  `link` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `project_files`
--

INSERT INTO `project_files` (`id`, `source_id`, `type`, `link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0, 'projects/a7iVixrf8K90dzVQQD13zX7ystw89VUsZmK1gg0D.png', '2024-08-08 19:14:07', '2024-08-09 14:14:53', '2024-08-09 14:14:53'),
(2, 1, 0, 'projects/qcfmZbCgWL3UtdRKGvxdOHrQpJWQvHv1Ko2VjUsm.png', '2024-08-08 19:14:07', '2024-08-09 14:14:53', '2024-08-09 14:14:53'),
(3, 1, 0, 'projects/AzQki8UpHIemz2GTJuOD10ZYb6EJz2zih8zSVygT.png', '2024-08-08 19:14:07', '2024-08-09 14:14:53', '2024-08-09 14:14:53'),
(4, 2, 0, 'projects/Sa3elqcjKwtWtvxorBEaa0fTfitlTspDUKFoWD7x.png', '2024-08-09 06:40:44', '2024-08-09 06:55:35', '2024-08-09 06:55:35'),
(5, 2, 0, 'projects/H6TRcpC1INZxPQ8iifuBnqmofWg2Fy3SNpxWpDS3.png', '2024-08-09 06:40:44', '2024-08-09 06:55:35', '2024-08-09 06:55:35'),
(6, 3, 0, 'projects/ku7zsJgDe67ORQ9vmPdn4M5PKB7TojDoJTStCzA6.png', '2024-08-09 06:42:52', '2024-08-09 06:49:48', '2024-08-09 06:49:48'),
(7, 3, 0, 'projects/UsArYegO29HEOkzjTFEPdJgaf0SmWSrjMLxguTfG.png', '2024-08-09 06:49:48', '2024-08-09 06:55:14', '2024-08-09 06:55:14'),
(8, 3, 0, 'projects/wCSZqTHIybPLqIOcdproQQU4rXGz2wcQNgCk50aO.png', '2024-08-09 06:49:48', '2024-08-09 06:55:14', '2024-08-09 06:55:14'),
(9, 3, 0, 'projects/Orz29olgrz3busoTSrqxyI1w4YqvRj15guiawN6J.png', '2024-08-09 06:49:48', '2024-08-09 06:55:14', '2024-08-09 06:55:14'),
(10, 3, 0, 'projects/FxKaGdFeYPyS65rinY62xHqpA6YqY8bKkbEshCtD.png', '2024-08-09 06:49:48', '2024-08-09 06:55:14', '2024-08-09 06:55:14'),
(11, 3, 0, 'projects/uDwViTcn0jY07JbkRTeLHEQZpaOXrrXyNkGXsxUB.jpg', '2024-08-09 06:55:14', '2024-08-09 06:55:14', NULL),
(12, 3, 0, 'projects/UduiMTUdYaX0AQgmqi1yUNAGvr8ZhIw3bJ4i2eUC.jpg', '2024-08-09 06:55:14', '2024-08-09 06:55:14', NULL),
(13, 2, 0, 'projects/WAb6XfJ7I7pp5JJ7Pu5w9CJYWdxahOUv3AVsgA7f.jpg', '2024-08-09 06:55:35', '2024-08-09 06:55:35', NULL),
(14, 2, 0, 'projects/49Wmejw5xvLxvfzeolCK73hHTxEVA89tT4tGaIBQ.jpg', '2024-08-09 06:55:35', '2024-08-09 06:55:35', NULL),
(15, 4, 0, 'projects/u6JtXMHbUOdP9Om5Jq84Zf8P28vCfwVarfUJmsHE.webp', '2024-08-09 08:49:42', '2024-08-09 08:49:42', NULL),
(16, 4, 0, 'projects/Fc30Se39ItsQ71HkdFAvAnXU7qFPqCuOt75KoVRR.webp', '2024-08-09 08:49:42', '2024-08-09 08:49:42', NULL),
(17, 4, 0, 'projects/VljZpWqJXby5gRzvnth9Qbovjqij8lSAEYUQq1KH.webp', '2024-08-09 08:49:42', '2024-08-09 08:49:42', NULL),
(18, 4, 0, 'projects/TVNGr27FkSuHflC6MB4m869MLP13yoCGqIjWV1wO.webp', '2024-08-09 08:49:42', '2024-08-09 08:49:42', NULL),
(19, 4, 0, 'projects/wOfl7gJdce7ZewDqp2RGOuesQWJ5yhDzWUIbGmqE.webp', '2024-08-09 08:49:42', '2024-08-09 08:49:42', NULL),
(20, 4, 0, 'projects/vmTBQSG3UcXzWSBlPyQx1DQohdQP6rB945OUjkVt.webp', '2024-08-09 08:49:42', '2024-08-09 08:49:42', NULL),
(21, 5, 0, 'projects/BSZ6Uxcyacqq2QGbmplkvHmFfVsVqJlEkeZEOScD.webp', '2024-08-09 09:02:32', '2024-08-09 09:02:32', NULL),
(22, 5, 0, 'projects/H43hFycVQQPxAsszud55z5zYe7Me0UKmfsLsitJX.webp', '2024-08-09 09:02:32', '2024-08-09 09:02:32', NULL),
(23, 5, 0, 'projects/5XGqMCq12FiHcoacOxu8wjozslGfEQxECFgjkTdo.webp', '2024-08-09 09:02:32', '2024-08-09 09:02:32', NULL),
(24, 5, 0, 'projects/8epyRhUntdmeN8QfNhZwbuy7h488oM65tCeCPcPO.webp', '2024-08-09 09:02:32', '2024-08-09 09:02:32', NULL),
(25, 5, 0, 'projects/oYPPWWm1AAKdXIafLJG2tMgSoW2s8eoHWaggBXcC.webp', '2024-08-09 09:02:32', '2024-08-09 09:02:32', NULL),
(26, 6, 0, 'projects/OZBmBCkWDRIXmdnq8mIZpSW9T26MxZEKBuIHJEJy.webp', '2024-08-09 09:08:45', '2024-08-09 09:08:45', NULL),
(27, 6, 0, 'projects/NjxnZTGCrpkSiGxWF9Qed8b0SWFmKWZlor214tnP.webp', '2024-08-09 09:08:45', '2024-08-09 09:08:45', NULL),
(28, 6, 0, 'projects/XnxhshH4KaKr2WT7fOdb85Ra7YuavIFXbQri5irb.webp', '2024-08-09 09:08:45', '2024-08-09 09:08:45', NULL),
(29, 6, 0, 'projects/EKjY5MYJ6JVlrc27Dv2odvUd36an99sNSbbKqThQ.webp', '2024-08-09 09:08:45', '2024-08-09 09:08:45', NULL),
(30, 6, 0, 'projects/cM69gkZSGDMaijEBgIYJwLrAbTWqbZ7GboiqYxYf.webp', '2024-08-09 09:08:45', '2024-08-09 09:08:45', NULL),
(31, 7, 0, 'projects/Dq4b61xn2dXaJNh13GyIAh5aEBc9ClnDiNNOUdqr.webp', '2024-08-09 09:14:08', '2024-08-09 09:14:08', NULL),
(32, 7, 0, 'projects/WNJAPth5OW0f94kcSyhmXDhqMZZWXeKx5nX9kxaK.webp', '2024-08-09 09:14:08', '2024-08-09 09:14:08', NULL),
(33, 7, 0, 'projects/qhVk8F9hauDJBlVGtpE86rZj55zLJ9rLCaA1ldaq.webp', '2024-08-09 09:14:08', '2024-08-09 09:14:08', NULL),
(34, 7, 0, 'projects/4ZrwQHTHk1Yc3rggFlv5hZ7JaUlGEXtmgjTnRhtW.webp', '2024-08-09 09:14:08', '2024-08-09 09:14:08', NULL),
(35, 7, 0, 'projects/4WUTJML6FffUSmIExMfoR9soq9Q7uz2CfxE6cJgk.webp', '2024-08-09 09:14:08', '2024-08-09 09:14:08', NULL),
(36, 8, 0, 'projects/ifLrmNRXRTJXJwMobjpM3JNqIDXlbwSutTzOxZyc.webp', '2024-08-09 09:17:01', '2024-08-09 09:17:01', NULL),
(37, 8, 0, 'projects/PttJecgJrIpTryqizedKDAgtuolfjpxLmwG2yqTx.webp', '2024-08-09 09:17:01', '2024-08-09 09:17:01', NULL),
(38, 8, 0, 'projects/beEIgIe5M9UVSVPdomUtN1O8l7HqonlnIfAncapq.webp', '2024-08-09 09:17:01', '2024-08-09 09:17:01', NULL),
(39, 8, 0, 'projects/hn0M1XVcDpHoJWnsxfv7FL1GTmO7tK86uF15HeHN.webp', '2024-08-09 09:17:01', '2024-08-09 09:17:01', NULL),
(40, 8, 0, 'projects/54vOzSh1BVLlHHz9obdyq4WtiUFxrUKFpmz0iMet.webp', '2024-08-09 09:17:01', '2024-08-09 09:17:01', NULL),
(41, 9, 0, 'projects/hDPt6nfeTTC6l9tkxrOoHh9PC9Nvy3u0eIpfTuV6.jpg', '2024-08-09 14:13:06', '2024-08-09 14:13:06', NULL),
(42, 9, 0, 'projects/uWdcKbtyWFNPzUYnZ5mX3mu7dMr3NPK3u43smMU1.jpg', '2024-08-09 14:13:06', '2024-08-09 14:13:06', NULL),
(43, 1, 0, 'projects/6lSMNhOmtHKxJQpxB9GRwz1Ug4gdRC8WUcDeX6VF.jpg', '2024-08-09 14:14:53', '2024-08-09 14:14:53', NULL),
(44, 1, 0, 'projects/Vs85h2hD1PIqSRBBcQKwm2hLsqtibjiqfoCNRZnZ.jpg', '2024-08-09 14:14:53', '2024-08-09 14:14:53', NULL),
(45, 10, 0, 'projects/v1DVGirIhqBjsNmST6ErAlF6kmGlTsHVKntPwM4k.jpg', '2024-08-09 14:17:35', '2024-08-09 14:17:35', NULL),
(46, 10, 0, 'projects/DJvcH0mJN94oYMnYLupoHUg1DKMe07jLhPsTx60p.jpg', '2024-08-09 14:17:35', '2024-08-09 14:17:35', NULL),
(47, 11, 0, 'projects/aBSpfMPFAMw2lmt4pOQLwBY2RDrwQDwuvznGKhNQ.jpg', '2024-08-09 14:20:49', '2024-08-09 14:20:49', NULL),
(48, 11, 0, 'projects/eRun2885BlxnbqiwBglF4d5BcJgquqL5CyUNQJ61.jpg', '2024-08-09 14:20:49', '2024-08-09 14:20:49', NULL),
(49, 12, 0, 'projects/Qf3TxbWbrbIs1m4fh51A3scmh6itTxkYNm2eyAwJ.jpg', '2024-08-09 14:22:30', '2024-08-09 14:22:30', NULL),
(50, 12, 0, 'projects/qI2ESNIHp20JF66WGaXpGfRFff8j56ycxOsh9m1I.jpg', '2024-08-09 14:22:30', '2024-08-09 14:22:30', NULL),
(51, 13, 0, 'projects/UtmdjNeU1lb9xEoUSKGsYnptKO6lYOxghcrb7t6X.jpg', '2024-08-09 19:21:26', '2024-08-09 19:21:26', NULL),
(52, 13, 0, 'projects/qEBPcnhAljbPbJw0a6IobclqQgVQrkwJhrWbNElU.jpg', '2024-08-09 19:21:26', '2024-08-09 19:21:26', NULL),
(53, 13, 0, 'projects/pGsQMJhthZkFvShAAz22IcqHgJRTROG58aMsAlgK.jpg', '2024-08-09 19:21:26', '2024-08-09 19:21:26', NULL),
(54, 14, 0, 'projects/VPFnGlMz3nIxQsRi7GbhE664313g6IgwUqEqGPXM.jpg', '2024-08-09 19:24:22', '2024-08-09 19:24:22', NULL),
(55, 14, 0, 'projects/fF30YYjnCiJP8QImgkb0WiQ1qcoKxYlKpvvwNM4T.jpg', '2024-08-09 19:24:22', '2024-08-09 19:24:22', NULL),
(56, 15, 0, 'projects/2elzPoams8CZDrKgSPyMGZnAFXOHgRo4L7vzZ1E2.jpg', '2024-08-09 19:28:08', '2024-08-09 19:28:08', NULL),
(57, 15, 0, 'projects/wjwZXY0MzPoMzTru0ujtavLfc69SrtrVRMbWu1GW.jpg', '2024-08-09 19:28:08', '2024-08-09 19:28:08', NULL),
(58, 15, 0, 'projects/6XpUGZre3XAW6iFN3mk9SJlvA3CiK4h2t5pd00vm.jpg', '2024-08-09 19:28:08', '2024-08-09 19:28:08', NULL),
(59, 15, 0, 'projects/G3WuBm01N5SOwHcSWEvtJoouhotso9amL70ExYE5.jpg', '2024-08-09 19:28:08', '2024-08-09 19:28:08', NULL),
(60, 16, 0, 'projects/sKxKJ9BQVO3Y1vE2VdRVK3YNOp1cFAgjN7j3C9vl.jpg', '2024-08-09 19:32:57', '2024-08-09 19:32:57', NULL),
(61, 16, 0, 'projects/yhd85VR3aT6Q8HHlRXc0I05S54eFT63L3wuqyiso.jpg', '2024-08-09 19:32:57', '2024-08-09 19:32:57', NULL),
(62, 16, 0, 'projects/DNakZnEEdNAH65LseySWIThKQixWkQN1WAbEXxZw.jpg', '2024-08-09 19:32:57', '2024-08-09 19:32:57', NULL),
(63, 16, 0, 'projects/HSdYZwCcUiCYZO6Pbh8J8MgfbuPHa3PgnNyMDAsJ.jpg', '2024-08-09 19:32:57', '2024-08-09 19:32:57', NULL),
(64, 16, 0, 'projects/TkKMDcHbnyJvbcCwEZV39e3ylLjfUL9cTRzSiwZF.jpg', '2024-08-09 19:32:57', '2024-08-09 19:32:57', NULL),
(65, 17, 0, 'projects/bLusSpXhhqAjyzMwuicCJjWjNuhHuZ2AwU3bxLxC.jpg', '2024-08-09 19:35:25', '2024-08-09 19:35:25', NULL),
(66, 17, 0, 'projects/eYjfGbTpj22Vxu7toxhyymcSvHz9qufIIpRtmrvx.jpg', '2024-08-09 19:35:25', '2024-08-09 19:35:25', NULL),
(67, 17, 0, 'projects/QmDhF7rT9r0MnjPNnJGhGTTtD7MpqSe6Uy4bU9jD.jpg', '2024-08-09 19:35:25', '2024-08-09 19:35:25', NULL),
(68, 18, 0, 'projects/iKkOQut2nZD6HucV7gKExuMD9bhqY2xvfciJMNmw.jpg', '2024-08-09 19:47:55', '2024-08-09 19:47:55', NULL),
(69, 18, 0, 'projects/swJhw9F1ITdSyefEVGBJGtZ1pk5Wc45gqfTv5rPw.jpg', '2024-08-09 19:47:55', '2024-08-09 19:47:55', NULL),
(70, 19, 0, 'projects/ggmMvhfXM0PUWY9lCfOSQIr9bIuuGaALEliWrhd2.jpg', '2024-08-09 19:57:13', '2024-08-09 19:57:13', NULL),
(71, 19, 0, 'projects/UIyI1PCDzd1cGfNUCCiJv8TGtDDmTV5ugqOfAuNg.jpg', '2024-08-09 19:57:13', '2024-08-09 19:57:13', NULL),
(72, 19, 0, 'projects/t9NPJJ2JcdmmJTZ6KN6UxG1OhHCvvDENWQFslO2u.jpg', '2024-08-09 19:57:13', '2024-08-09 19:57:13', NULL),
(73, 19, 0, 'projects/clxHdPWYkA6LY2DgGpqhEHbIncZ5MiD8f4tlpBQZ.jpg', '2024-08-09 19:57:13', '2024-08-09 19:57:13', NULL),
(74, 20, 0, 'projects/6eS9oHkYzz9fIQbZjhDA2rf2ViSqwwjOY81aP6Hy.jpg', '2024-08-09 20:00:01', '2024-08-09 20:00:01', NULL),
(75, 20, 0, 'projects/bI7jYwKgPGdAsKGqb4gJC5yLAXuEIKQKLTsK8CA4.jpg', '2024-08-09 20:00:01', '2024-08-09 20:00:01', NULL),
(76, 20, 0, 'projects/DW6QXeqwBDF1Iidvh7SsUKvUhgV815QdWfsUJcDR.jpg', '2024-08-09 20:00:01', '2024-08-09 20:00:01', NULL),
(77, 21, 0, 'projects/ZYdYPXYSM0Now0xPLecj4kOd6uYN3o1x8bF4YV75.jpg', '2024-08-09 20:04:54', '2024-08-09 20:04:54', NULL),
(78, 21, 0, 'projects/i5kVVNByClSs0Nn86BvqorMIK6sFISRubsLkDcVS.jpg', '2024-08-09 20:04:54', '2024-08-09 20:04:54', NULL),
(79, 21, 0, 'projects/LAUzcSKdWxJpIpf1QE06dSwaJZ1ciVI6c2UpPeRa.jpg', '2024-08-09 20:04:54', '2024-08-09 20:04:54', NULL),
(80, 21, 0, 'projects/OcFqAz5o3iAbEkyhtESjZ75LZ6P8GGGpzZJUe2xk.jpg', '2024-08-09 20:04:54', '2024-08-09 20:04:54', NULL),
(81, 22, 0, 'projects/3zaJO3Hxv5A9F3mLVQEHW9QHyC9WpQFhZe7mJkil.jpg', '2024-08-09 20:07:02', '2024-08-09 20:07:02', NULL),
(82, 22, 0, 'projects/nUkRQOwGPo3mWUR3eekPjRATP0TKJF2mASYpcb9q.jpg', '2024-08-09 20:07:02', '2024-08-09 20:07:02', NULL),
(83, 22, 0, 'projects/9CJVBVDjYjKI3WC18y9XfXPIO3Aq7oLhF8FrIsvM.jpg', '2024-08-09 20:07:02', '2024-08-09 20:07:02', NULL),
(84, 22, 0, 'projects/uHa2ooRzysNA85O2njHc6gHzDhXNN4ybmOOCScDB.jpg', '2024-08-09 20:07:02', '2024-08-09 20:07:02', NULL),
(85, 23, 0, 'projects/Yr0yPLvqrJVjAMHg8c5tznuCQs2UnnLEdp7Dvkri.jpg', '2024-08-09 20:09:41', '2024-08-09 20:09:41', NULL),
(86, 23, 0, 'projects/1eKZa0ddSBr1a34KN2xdOxs80eTH8u1W6QDgHD98.jpg', '2024-08-09 20:09:41', '2024-08-09 20:09:41', NULL),
(87, 23, 0, 'projects/bkZFNEbcShlIP2SkVUVbhN9Ei3GnYM1jnGbthZzf.jpg', '2024-08-09 20:09:41', '2024-08-09 20:09:41', NULL),
(88, 23, 0, 'projects/VzBaFaWw22nZbD6FSyuhhhF6cktpYHBTGPgkCYoJ.jpg', '2024-08-09 20:09:41', '2024-08-09 20:09:41', NULL),
(89, 23, 0, 'projects/EbzzUYOrQOTSAxc1IjZmNiuiFIIcVKyZn7e72eAX.jpg', '2024-08-09 20:09:41', '2024-08-09 20:09:41', NULL),
(90, 23, 0, 'projects/MXeIrjF3yufP4WlNORwLhsRy40GLwmpLTYMe2q7r.jpg', '2024-08-09 20:09:41', '2024-08-09 20:09:41', NULL),
(91, 24, 0, 'projects/WPKkdOssuvKdaMW82IVAlizRtGX35nehbcM0VbkY.jpg', '2024-08-09 20:13:59', '2024-08-09 20:13:59', NULL),
(92, 24, 0, 'projects/6TFUYcz9gRthRcnZbFIuSuPC7nbBCZIC4Ok6fgPW.jpg', '2024-08-09 20:13:59', '2024-08-09 20:13:59', NULL),
(93, 24, 0, 'projects/4EKqIFNrUpCIWtaPN9s2oOEwbhnkvY6I77kLxwB3.jpg', '2024-08-09 20:13:59', '2024-08-09 20:13:59', NULL),
(94, 24, 0, 'projects/CInLZDg2fk1iONZt4vJT4ZwvpjDSSPqLOU6CCUCh.jpg', '2024-08-09 20:13:59', '2024-08-09 20:13:59', NULL),
(95, 25, 0, 'projects/E18YAcLc3UB8y1nk3eN3NGhcc0DNhyObGQSK1j22.jpg', '2024-08-09 20:16:08', '2024-08-09 20:16:08', NULL),
(96, 25, 0, 'projects/r5qAnD2HEw1W2zO7kV5ZeIEvAITQn1WROYM4X8Gb.jpg', '2024-08-09 20:16:08', '2024-08-09 20:16:08', NULL),
(97, 25, 0, 'projects/fG29kknzTSz43lyWFWwZaW3M70pje9Jwf8EsMMES.jpg', '2024-08-09 20:16:08', '2024-08-09 20:16:08', NULL),
(98, 25, 0, 'projects/t2Sm8G4zznPq9qigT6EpUIPG3YUFB3ABjvK9g1fJ.jpg', '2024-08-09 20:16:08', '2024-08-09 20:16:08', NULL),
(99, 25, 0, 'projects/EsKpqHDgFeOX0bSewZrswnFPlu2JCanaHoQZ6tIK.jpg', '2024-08-09 20:16:08', '2024-08-09 20:16:08', NULL),
(100, 26, 0, 'projects/sYe5peXh7kGk30MoynBhFQQrTsJwDPpLRhIrCD48.jpg', '2024-08-12 08:34:29', '2024-08-12 08:34:29', NULL),
(101, 26, 0, 'projects/UVBpFMbWEw8c3N68W7ultt41iZs95tPHlekQSDQP.jpg', '2024-08-12 08:34:29', '2024-08-12 08:34:29', NULL),
(102, 26, 0, 'projects/kzkLBZzUvZWMPB14mpkFBX1KQHQuIEMkjhc6nCdo.jpg', '2024-08-12 08:34:29', '2024-08-12 08:34:29', NULL),
(103, 26, 0, 'projects/ThDO1b3RDoWGyAfLeI6bZKSJ7U9AqoLzJSprJBhZ.jpg', '2024-08-12 08:34:29', '2024-08-12 08:34:29', NULL),
(104, 27, 0, 'projects/WoVuXxEuRvShjFMnvvNcKLlxY7MGlDhjHo2N2G1k.webp', '2024-08-12 16:03:12', '2024-08-12 16:03:12', NULL),
(105, 27, 0, 'projects/CMAq6xqCcAkLtWoQGzbZXY2F6zrOrR7Ggf5IECZM.webp', '2024-08-12 16:03:12', '2024-08-12 16:03:12', NULL),
(106, 27, 0, 'projects/3OhR2O9r2R6sEZIDqAlDkkJn0e4QpLZ7SbhJdgVM.webp', '2024-08-12 16:03:12', '2024-08-12 16:03:12', NULL),
(107, 28, 0, 'projects/5fZ9GFRTxlBHWGLnMNz5nbGsP6ep2GRpYhKuxTA9.webp', '2024-08-14 10:52:43', '2024-08-14 10:52:43', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `project_works`
--

CREATE TABLE `project_works` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `project_works`
--

INSERT INTO `project_works` (`id`, `type`, `quantity`, `project_id`, `finish_date`, `created_at`, `updated_at`) VALUES
(1, 'inst', '2', 1, '2024-12-31 20:59:59', '2024-08-08 19:14:07', '2024-08-09 14:25:27'),
(2, 'youtube', '3', 1, '2024-12-31 20:59:59', '2024-08-08 19:14:07', '2024-08-09 14:25:27'),
(3, 'inst', '15', 2, '2024-12-31 20:59:59', '2024-08-09 06:40:44', '2024-08-09 14:25:33'),
(4, 'youtube', '15', 2, '2024-12-31 20:59:59', '2024-08-09 06:40:44', '2024-08-09 14:25:33'),
(5, 'inst', '5', 3, '2024-12-31 20:59:59', '2024-08-09 06:42:52', '2024-08-09 14:25:51'),
(6, 'youtube', '5', 3, '2024-12-31 20:59:59', '2024-08-09 06:42:52', '2024-08-09 14:25:51'),
(7, 'inst', '15', 4, '2024-12-31 20:59:59', '2024-08-09 08:49:42', '2024-08-09 08:52:36'),
(8, 'youtube', '15', 4, '2024-12-31 20:59:59', '2024-08-09 08:49:42', '2024-08-09 08:52:36'),
(9, 'inst', '4', 5, '2024-12-31 20:59:59', '2024-08-09 09:02:32', '2024-08-09 09:23:17'),
(10, 'youtube', '4', 5, '2024-12-31 20:59:59', '2024-08-09 09:02:32', '2024-08-09 09:23:17'),
(11, 'inst', '3', 6, '2024-12-31 20:59:59', '2024-08-09 09:08:45', '2024-08-09 09:23:08'),
(12, 'youtube', '3', 6, '2024-12-31 20:59:59', '2024-08-09 09:08:45', '2024-08-09 09:23:08'),
(13, 'inst', '3', 7, '2024-12-31 20:59:59', '2024-08-09 09:14:08', '2024-08-09 09:22:58'),
(14, 'youtube', '3', 7, '2024-12-31 20:59:59', '2024-08-09 09:14:08', '2024-08-09 09:22:58'),
(15, 'inst', '3', 8, '2024-12-31 20:59:59', '2024-08-09 09:17:01', '2024-08-09 09:22:50'),
(16, 'youtube', '3', 8, '2024-12-31 20:59:59', '2024-08-09 09:17:01', '2024-08-09 09:22:50'),
(17, 'inst', '7', 9, '2024-12-31 20:59:59', '2024-08-09 14:13:06', '2024-08-09 14:25:58'),
(18, 'youtube', '8', 9, '2024-12-31 20:59:59', '2024-08-09 14:13:06', '2024-08-09 14:25:58'),
(19, 'inst', '2', 10, '2024-12-31 20:59:59', '2024-08-09 14:17:35', '2024-08-09 14:26:29'),
(20, 'youtube', '3', 10, '2024-12-31 20:59:59', '2024-08-09 14:17:35', '2024-08-09 14:26:29'),
(21, 'inst', '2', 11, '2024-12-31 20:59:59', '2024-08-09 14:20:49', '2024-08-09 14:26:39'),
(22, 'youtube', '3', 11, '2024-12-31 20:59:59', '2024-08-09 14:20:49', '2024-08-09 14:26:39'),
(23, 'inst', '2', 12, '2024-12-31 20:59:59', '2024-08-09 14:22:30', '2024-08-09 14:25:19'),
(24, 'youtube', '3', 12, '2024-12-31 20:59:59', '2024-08-09 14:22:30', '2024-08-09 14:25:19'),
(25, 'inst', '1', 13, '2024-12-31 20:59:59', '2024-08-09 19:21:26', '2024-08-09 20:17:22'),
(26, 'youtube', '1', 13, '2024-12-31 20:59:59', '2024-08-09 19:21:26', '2024-08-09 20:17:22'),
(27, 'inst', '1', 14, '2024-12-31 20:59:59', '2024-08-09 19:24:22', '2024-08-09 20:17:11'),
(28, 'youtube', '1', 14, '2024-12-31 20:59:59', '2024-08-09 19:24:22', '2024-08-09 20:17:11'),
(29, 'inst', '1', 15, '2024-12-31 20:59:59', '2024-08-09 19:28:08', '2024-08-09 20:17:02'),
(30, 'youtube', '2', 15, '2024-12-31 20:59:59', '2024-08-09 19:28:08', '2024-08-09 20:17:02'),
(31, 'inst', '1', 16, '2024-12-31 20:59:59', '2024-08-09 19:32:57', '2024-08-09 20:17:37'),
(32, 'youtube', '1', 16, '2024-12-31 20:59:59', '2024-08-09 19:32:57', '2024-08-09 20:17:37'),
(33, 'inst', '1', 17, '2024-12-31 20:59:59', '2024-08-09 19:35:25', '2024-08-09 20:17:48'),
(34, 'youtube', '1', 17, '2024-12-31 20:59:59', '2024-08-09 19:35:25', '2024-08-09 20:17:48'),
(35, 'inst', '1', 18, '2024-12-31 20:59:59', '2024-08-09 19:47:55', '2024-08-09 20:17:59'),
(36, 'youtube', '1', 18, '2024-12-31 20:59:59', '2024-08-09 19:47:55', '2024-08-09 20:17:59'),
(37, 'inst', '2', 19, '2024-12-31 20:59:59', '2024-08-09 19:57:13', '2024-08-09 20:18:10'),
(38, 'youtube', '1', 19, '2024-12-31 20:59:59', '2024-08-09 19:57:13', '2024-08-09 20:18:10'),
(39, 'inst', '1', 20, '2024-12-31 20:59:59', '2024-08-09 20:00:01', '2024-08-09 20:18:43'),
(40, 'youtube', '1', 20, '2024-12-31 20:59:59', '2024-08-09 20:00:01', '2024-08-09 20:18:43'),
(41, 'inst', '1', 21, '2024-12-31 20:59:59', '2024-08-09 20:04:54', '2024-08-09 20:18:52'),
(42, 'youtube', '2', 21, '2024-12-31 20:59:59', '2024-08-09 20:04:54', '2024-08-09 20:18:52'),
(43, 'inst', '1', 22, '2024-12-31 20:59:59', '2024-08-09 20:07:02', '2024-08-09 20:18:22'),
(44, 'youtube', '1', 22, '2024-12-31 20:59:59', '2024-08-09 20:07:02', '2024-08-09 20:18:22'),
(45, 'inst', '2', 23, '2024-12-31 20:59:59', '2024-08-09 20:09:41', '2024-08-09 20:19:03'),
(46, 'youtube', '1', 23, '2024-12-31 20:59:59', '2024-08-09 20:09:41', '2024-08-09 20:19:03'),
(47, 'inst', '1', 24, '2024-12-31 20:59:59', '2024-08-09 20:13:59', '2024-08-09 20:18:33'),
(48, 'youtube', '1', 24, '2024-12-31 20:59:59', '2024-08-09 20:13:59', '2024-08-09 20:18:33'),
(49, 'inst', '1', 25, '2024-12-31 20:59:59', '2024-08-09 20:16:08', '2024-08-09 20:16:52'),
(50, 'youtube', '1', 25, '2024-12-31 20:59:59', '2024-08-09 20:16:08', '2024-08-09 20:16:52'),
(51, 'inst', '10', 26, '2024-12-31 20:59:59', '2024-08-12 08:34:29', '2024-08-12 08:34:45'),
(52, 'youtube', '9', 26, '2024-12-31 20:59:59', '2024-08-12 08:34:29', '2024-08-12 08:34:45'),
(53, 'inst', '4', 27, '2024-12-31 20:59:59', '2024-08-12 16:03:12', '2024-08-12 16:04:12'),
(54, 'youtube', '4', 27, '2024-12-31 20:59:59', '2024-08-12 16:03:12', '2024-08-12 16:04:12'),
(55, 'feedback', '0', 28, '2024-08-21 10:49:31', '2024-08-14 10:52:43', '2024-08-22 07:00:01');

-- --------------------------------------------------------

--
-- Структура таблицы `referral_codes`
--

CREATE TABLE `referral_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `referral_codes`
--

INSERT INTO `referral_codes` (`id`, `user_id`, `code`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '12345', 'company', NULL, NULL, NULL),
(2, 1, '54321', 'managers', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `referral_users`
--

CREATE TABLE `referral_users` (
  `id` bigint UNSIGNED NOT NULL,
  `referral_code_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `referral_users`
--

INSERT INTO `referral_users` (`id`, `referral_code_id`, `user_id`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 1, 10, 'sellers', NULL, NULL, NULL),
(10, 2, 12, 'blogger', NULL, NULL, NULL),
(11, 2, 22, 'seller', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `organization_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_achievement` int DEFAULT NULL,
  `is_agent` int NOT NULL DEFAULT '0',
  `inn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `wb_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wb_api_key` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ozon_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ozon_api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ozon_client_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `organization_type`, `is_achievement`, `is_agent`, `inn`, `description`, `organization_name`, `finish_date`, `wb_link`, `wb_api_key`, `ozon_link`, `ozon_api_key`, `ozon_client_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 9, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(6, 10, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 06:56:53', '2024-08-09 06:56:53', NULL),
(11, 22, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-11 18:48:09', '2024-08-11 18:48:09', NULL),
(12, 25, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-13 09:37:32', '2024-08-13 09:37:32', NULL),
(14, 31, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-14 10:49:31', '2024-08-14 10:49:31', NULL),
(15, 60, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-18 13:06:49', '2024-08-18 13:06:49', NULL),
(17, 124, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-22 17:52:22', '2024-08-22 17:52:22', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `seller_tariffs`
--

CREATE TABLE `seller_tariffs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tariff_id` bigint UNSIGNED NOT NULL,
  `quantity` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `finish_date` timestamp NOT NULL,
  `activation_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `seller_tariffs`
--

INSERT INTO `seller_tariffs` (`id`, `user_id`, `tariff_id`, `quantity`, `type`, `finish_date`, `activation_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 9, 4, 150, 'feedback', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(5, 9, 7, 90, 'inst', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-12 08:34:45', NULL),
(6, 9, 10, 86, 'youtube', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-12 08:34:45', NULL),
(7, 9, 13, 150, 'vk', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(8, 9, 16, 150, 'telegram', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(15, 10, 4, 50, 'feedback', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(16, 10, 7, 33, 'inst', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-12 16:04:12', NULL),
(17, 10, 10, 33, 'youtube', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-12 16:04:12', NULL),
(18, 10, 13, 50, 'vk', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(19, 10, 16, 50, 'telegram', '2024-12-31 20:59:59', '2024-08-08 12:23:11', '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL),
(24, 22, 1, 1, 'feedback', '2024-08-18 18:48:09', '2024-08-11 18:48:09', '2024-08-11 18:48:09', '2024-08-19 07:00:01', '2024-08-19 07:00:01'),
(25, 25, 1, 1, 'feedback', '2024-08-20 09:37:32', '2024-08-13 09:37:32', '2024-08-13 09:37:32', '2024-08-21 07:00:01', '2024-08-21 07:00:01'),
(27, 31, 1, 0, 'feedback', '2024-08-21 10:49:31', '2024-08-14 10:49:31', '2024-08-14 10:49:31', '2024-08-22 07:00:01', '2024-08-22 07:00:01'),
(28, 60, 1, 1, 'feedback', '2024-08-25 13:06:49', '2024-08-18 13:06:49', '2024-08-18 13:06:49', '2024-08-26 07:00:01', '2024-08-26 07:00:01'),
(31, 124, 1, 1, 'feedback', '2024-08-29 17:52:22', '2024-08-22 17:52:22', '2024-08-22 17:52:22', '2024-08-22 17:52:22', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tariffs`
--

CREATE TABLE `tariffs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `period` int NOT NULL DEFAULT '31',
  `group_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_best` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tariffs`
--

INSERT INTO `tariffs` (`id`, `title`, `description`, `price`, `type`, `quantity`, `period`, `group_id`, `is_active`, `is_best`, `created_at`, `updated_at`) VALUES
(1, 'Стартовый', NULL, 0, 'feedback', 1, 7, 1, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(2, 'СЕЛЛЕР - 10 отзывов', 'Оплатив этот тариф, вы получаете доступ к получению 10 отзывов на свой товар в течение 30 дней.', 490000, 'feedback', 10, 30, 2, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(3, 'БИЗНЕС - 30 отзывов', 'Оплатив этот тариф, вы получаете доступ к получению 30 отзывов на свой товар в течение 30 дней.', 1350000, 'feedback', 30, 30, 2, 1, 1, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(4, 'КОМПАНИЯ - 50 отзывов', 'Оплатив этот тариф, вы получаете доступ к получению 10 отзывов на свой товар в течение 30 дней.', 2000000, 'feedback', 50, 30, 2, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(5, 'СЕЛЛЕР - 10 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.', 790000, 'inst', 10, 30, 3, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(6, 'БИЗНЕС - 30 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.', 2070000, 'inst', 30, 30, 3, 1, 1, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(7, 'КОМПАНИЯ - 50 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.', 2950000, 'inst', 50, 30, 3, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(8, 'СЕЛЛЕР - 10 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.', 990000, 'youtube', 10, 30, 4, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(9, 'БИЗНЕС - 30 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.', 2670000, 'youtube', 30, 30, 4, 1, 1, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(10, 'КОМПАНИЯ - 50 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.', 3950000, 'youtube', 50, 30, 4, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(11, 'СЕЛЛЕР - 10 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.', 790000, 'vk', 10, 30, 5, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(12, 'БИЗНЕС - 30 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.', 2070000, 'vk', 30, 30, 5, 1, 1, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(13, 'КОМПАНИЯ - 50 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.', 2950000, 'vk', 50, 30, 5, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(14, 'СЕЛЛЕР - 10 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.', 790000, 'telegram', 10, 30, 6, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(15, 'БИЗНЕС - 30 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.', 2070000, 'telegram', 30, 30, 6, 1, 1, '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(16, 'КОМПАНИЯ - 50 интеграций', 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.', 2950000, 'telegram', 50, 30, 6, 1, 0, '2024-08-07 09:05:46', '2024-08-07 09:05:46');

-- --------------------------------------------------------

--
-- Структура таблицы `tariff_groups`
--

CREATE TABLE `tariff_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tariff_groups`
--

INSERT INTO `tariff_groups` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Стартовый (Отзывы)', '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(2, 'Отзывы на WB, OZON', '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(3, 'Интеграции Inst', '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(4, 'Интеграции YouTube', '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(5, 'Интеграции VK', '2024-08-07 09:05:46', '2024-08-07 09:05:46'),
(6, 'Интеграции Telegram', '2024-08-07 09:05:46', '2024-08-07 09:05:46');

-- --------------------------------------------------------

--
-- Структура таблицы `tg_phones`
--

CREATE TABLE `tg_phones` (
  `id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tg_phones`
--

INSERT INTO `tg_phones` (`id`, `phone`, `chat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '+70000000001', 470155536, NULL, NULL, NULL),
(2, '+70000000000', 470155536, NULL, NULL, NULL),
(3, '+79998880001', 470155536, NULL, NULL, NULL),
(4, '+79998880002', 470155536, NULL, NULL, NULL),
(5, '+79998880003', 470155536, NULL, NULL, NULL),
(6, '+79998880004', 470155536, NULL, NULL, NULL),
(7, '+79998880005', 470155536, NULL, NULL, NULL),
(8, '+79998880006', 470155536, NULL, NULL, NULL),
(9, '+79279824554', 470155536, '2024-08-08 10:53:18', '2024-08-08 10:53:18', NULL),
(10, '+79648573160', 470155536, '2024-08-08 12:22:11', '2024-08-08 12:22:11', NULL),
(11, '+79153788434', 470155536, '2024-08-09 06:56:46', '2024-08-09 06:56:46', NULL),
(12, '+79991944447', 470155536, '2024-08-09 10:05:19', '2024-08-09 10:05:19', NULL),
(13, '+79603701424', 470155536, '2024-08-09 10:14:23', '2024-08-09 10:14:23', NULL),
(14, '+79783459958', 470155536, '2024-08-10 08:25:11', '2024-08-10 08:25:11', NULL),
(15, '+79539800017', 470155536, '2024-08-10 13:19:18', '2024-08-10 13:19:18', NULL),
(16, '+79533482098', 470155536, '2024-08-10 21:41:52', '2024-08-10 21:41:52', NULL),
(17, '+79127822321', 470155536, '2024-08-11 10:41:19', '2024-08-11 10:41:19', NULL),
(18, '+79260877002', 470155536, '2024-08-11 10:49:55', '2024-08-11 10:49:55', NULL),
(19, '+79990737397', 470155536, '2024-08-11 11:09:23', '2024-08-11 11:09:23', NULL),
(20, '+79601346583', 470155536, '2024-08-11 11:53:56', '2024-08-11 11:53:56', NULL),
(21, '+79048437785', 470155536, '2024-08-11 13:18:37', '2024-08-11 13:18:37', NULL),
(24, '+79525897023', 470155536, '2024-08-11 18:47:37', '2024-08-11 18:47:37', NULL),
(25, '+79612865091', 470155536, '2024-08-11 18:47:58', '2024-08-11 18:47:58', NULL),
(26, '+79603677437', 470155536, '2024-08-12 08:51:15', '2024-08-12 08:51:15', NULL),
(27, '17623241720', 470155536, '2024-08-13 04:50:23', '2024-08-13 04:50:23', NULL),
(28, '+79047742206', 470155536, '2024-08-13 09:36:54', '2024-08-13 09:36:54', NULL),
(29, '+79162089773', 470155536, '2024-08-13 11:47:40', '2024-08-13 11:47:40', NULL),
(30, '+79056727038', 470155536, '2024-08-13 19:49:21', '2024-08-13 19:49:21', NULL),
(31, '+79189524920', 470155536, '2024-08-14 06:45:53', '2024-08-14 06:45:53', NULL),
(32, '+79935622499', 470155536, '2024-08-14 10:49:25', '2024-08-14 10:49:25', NULL),
(33, '+79627542942', 470155536, '2024-08-15 19:16:55', '2024-08-15 19:16:55', NULL),
(34, '+79262137723', 470155536, '2024-08-16 12:00:46', '2024-08-16 12:00:46', NULL),
(35, '+79990039366', 470155536, '2024-08-16 12:01:26', '2024-08-16 12:01:26', NULL),
(36, '+79873977707', 470155536, '2024-08-16 12:03:21', '2024-08-16 12:03:21', NULL),
(37, '+79264160640', 470155536, '2024-08-16 12:04:42', '2024-08-16 12:04:42', NULL),
(38, '+79373951806', 470155536, '2024-08-16 12:05:17', '2024-08-16 12:05:17', NULL),
(39, '+79171558203', 470155536, '2024-08-16 12:06:39', '2024-08-16 12:06:39', NULL),
(40, '+79965994266', 470155536, '2024-08-16 12:07:29', '2024-08-16 12:07:29', NULL),
(41, '+79185569984', 470155536, '2024-08-16 12:11:46', '2024-08-16 12:11:46', NULL),
(42, '+79854242335', 470155536, '2024-08-16 12:12:59', '2024-08-16 12:12:59', NULL),
(43, '+79956535674', 470155536, '2024-08-16 12:30:25', '2024-08-16 12:30:25', NULL),
(44, '+79044226953', 470155536, '2024-08-16 12:56:31', '2024-08-16 12:56:31', NULL),
(45, '+79082782176', 470155536, '2024-08-16 13:12:13', '2024-08-16 13:12:13', NULL),
(46, '+77784087544', 470155536, '2024-08-16 13:23:46', '2024-08-16 13:23:46', NULL),
(47, '+79170450770', 470155536, '2024-08-16 13:46:26', '2024-08-16 13:46:26', NULL),
(48, '+79528325603', 470155536, '2024-08-16 14:29:45', '2024-08-16 14:29:45', NULL),
(49, '+79787110668', 470155536, '2024-08-16 14:58:18', '2024-08-16 14:58:18', NULL),
(50, '+79393776398', 470155536, '2024-08-16 15:00:13', '2024-08-16 15:00:13', NULL),
(51, '+79038626900', 470155536, '2024-08-16 16:05:33', '2024-08-16 16:05:33', NULL),
(52, '+79787028736', 470155536, '2024-08-16 16:53:24', '2024-08-16 16:53:24', NULL),
(53, '+79953042724', 470155536, '2024-08-16 17:23:16', '2024-08-16 17:23:16', NULL),
(54, '+79518261680', 470155536, '2024-08-16 18:41:21', '2024-08-16 18:41:21', NULL),
(55, '+79824781326', 470155536, '2024-08-16 19:54:08', '2024-08-16 19:54:08', NULL),
(56, '+79377098703', 470155536, '2024-08-17 06:19:30', '2024-08-17 06:19:30', NULL),
(58, '+79818200243', 470155536, '2024-08-17 07:27:11', '2024-08-17 07:27:11', NULL),
(59, '+79612332357', 470155536, '2024-08-17 09:54:55', '2024-08-17 09:54:55', NULL),
(63, '+79325544076', 470155536, '2024-08-17 10:11:23', '2024-08-17 10:11:23', NULL),
(64, '+79056388130', 470155536, '2024-08-17 18:02:43', '2024-08-17 18:02:43', NULL),
(65, '+79961221280', 470155536, '2024-08-17 19:56:14', '2024-08-17 19:56:14', NULL),
(66, '+79789553623', 470155536, '2024-08-17 21:04:23', '2024-08-17 21:04:23', NULL),
(67, '+79672442294', 470155536, '2024-08-18 08:53:59', '2024-08-18 08:53:59', NULL),
(68, '+79046664306', 470155536, '2024-08-18 09:09:30', '2024-08-18 09:09:30', NULL),
(69, '+79133053800', 470155536, '2024-08-18 10:22:09', '2024-08-18 10:22:09', NULL),
(70, '+79182270196', 470155536, '2024-08-18 11:18:26', '2024-08-18 11:18:26', NULL),
(71, '+79157213990', 470155536, '2024-08-18 11:36:21', '2024-08-18 11:36:21', NULL),
(72, '+79663005516', 470155536, '2024-08-18 12:26:56', '2024-08-18 12:26:56', NULL),
(73, '+79163505750', 470155536, '2024-08-18 13:06:06', '2024-08-18 13:06:06', NULL),
(74, '+79228309114', 470155536, '2024-08-18 14:56:47', '2024-08-18 14:56:47', NULL),
(75, '+79166801640', 470155536, '2024-08-18 17:33:11', '2024-08-18 17:33:11', NULL),
(76, '+79190366824', 470155536, '2024-08-18 20:53:32', '2024-08-18 20:53:32', NULL),
(77, '+79805468687', 470155536, '2024-08-19 06:16:49', '2024-08-19 06:16:49', NULL),
(78, '+79252290285', 470155536, '2024-08-19 08:29:22', '2024-08-19 08:29:22', NULL),
(80, '+79104771401', 470155536, '2024-08-19 11:12:54', '2024-08-19 11:12:54', NULL),
(81, '+79628557780', 470155536, '2024-08-19 15:08:51', '2024-08-19 15:08:51', NULL),
(82, '+79113547064', 470155536, '2024-08-19 17:53:13', '2024-08-19 17:53:13', NULL),
(83, '+79775093273', 470155536, '2024-08-19 17:54:15', '2024-08-19 17:54:15', NULL),
(86, '+79237627438', 470155536, '2024-08-19 17:56:08', '2024-08-19 17:56:08', NULL),
(88, '+79966754476', 470155536, '2024-08-19 18:00:46', '2024-08-19 18:00:46', NULL),
(89, '+79780281130', 470155536, '2024-08-19 18:02:52', '2024-08-19 18:02:52', NULL),
(90, '+79966268390', 470155536, '2024-08-19 18:04:13', '2024-08-19 18:04:13', NULL),
(91, '+79870189340', 470155536, '2024-08-19 18:07:06', '2024-08-19 18:07:06', NULL),
(92, '+79028440779', 470155536, '2024-08-19 18:13:23', '2024-08-19 18:13:23', NULL),
(93, '+79782450142', 470155536, '2024-08-19 18:30:58', '2024-08-19 18:30:58', NULL),
(95, '+79370361041', 470155536, '2024-08-19 18:42:43', '2024-08-19 18:42:43', NULL),
(96, '+79187553829', 470155536, '2024-08-19 18:57:05', '2024-08-19 18:57:05', NULL),
(97, '+79182978218', 470155536, '2024-08-19 18:59:30', '2024-08-19 18:59:30', NULL),
(100, '+79773557890', 470155536, '2024-08-19 19:20:25', '2024-08-19 19:20:25', NULL),
(101, '+79207600686', 470155536, '2024-08-19 19:21:10', '2024-08-19 19:21:10', NULL),
(102, '+79090693132', 470155536, '2024-08-19 19:36:45', '2024-08-19 19:36:45', NULL),
(104, '+79128846761', 470155536, '2024-08-19 19:43:17', '2024-08-19 19:43:17', NULL),
(106, '+79619293050', 470155536, '2024-08-19 20:07:32', '2024-08-19 20:07:32', NULL),
(107, '+79828044311', 470155536, '2024-08-20 03:02:14', '2024-08-20 03:02:14', NULL),
(108, '+79130820176', 470155536, '2024-08-20 05:24:32', '2024-08-20 05:24:32', NULL),
(109, '+79081291023', 470155536, '2024-08-20 06:37:44', '2024-08-20 06:37:44', NULL),
(111, '+79279849406', 470155536, '2024-08-20 14:36:25', '2024-08-20 14:36:25', NULL),
(114, '+79296432876', 470155536, '2024-08-20 15:36:55', '2024-08-20 15:36:55', NULL),
(115, '+79021223290', 470155536, '2024-08-20 16:15:46', '2024-08-20 16:15:46', NULL),
(116, '+79529903884', 470155536, '2024-08-20 19:36:45', '2024-08-20 19:36:45', NULL),
(117, '+79202291672', 470155536, '2024-08-20 19:41:38', '2024-08-20 19:41:38', NULL),
(118, '+79505590718', 470155536, '2024-08-20 20:06:12', '2024-08-20 20:06:12', NULL),
(119, '+79780432070', 470155536, '2024-08-20 20:14:09', '2024-08-20 20:14:09', NULL),
(120, '+79031382604', 470155536, '2024-08-20 21:01:22', '2024-08-20 21:01:22', NULL),
(121, '+79158565530', 470155536, '2024-08-21 04:23:55', '2024-08-21 04:23:55', NULL),
(122, '+79000613066', 470155536, '2024-08-21 06:31:55', '2024-08-21 06:31:55', NULL),
(123, '+79127832717', 470155536, '2024-08-21 12:22:44', '2024-08-21 12:22:44', NULL),
(125, '+79131684689', 470155536, '2024-08-21 12:45:39', '2024-08-21 12:45:39', NULL),
(127, '+79770002222', 470155536, '2024-08-21 12:52:35', '2024-08-21 12:52:35', NULL),
(128, '+79959188642', 470155536, '2024-08-21 12:54:09', '2024-08-21 12:54:09', NULL),
(130, '+79266570733', 470155536, '2024-08-21 12:55:06', '2024-08-21 12:55:06', NULL),
(131, '+79065065287', 470155536, '2024-08-21 12:57:25', '2024-08-21 12:57:25', NULL),
(133, '+79097416037', 470155536, '2024-08-21 13:25:38', '2024-08-21 13:25:38', NULL),
(134, '+79046496649', 470155536, '2024-08-21 13:26:52', '2024-08-21 13:26:52', NULL),
(135, '+79260498395', 470155536, '2024-08-21 13:54:36', '2024-08-21 13:54:36', NULL),
(136, '+79186571897', 470155536, '2024-08-21 14:00:28', '2024-08-21 14:00:28', NULL),
(138, '+79966395622', 470155536, '2024-08-21 14:31:25', '2024-08-21 14:31:25', NULL),
(139, '+998913124274', 470155536, '2024-08-21 15:56:32', '2024-08-21 15:56:32', NULL),
(140, '+79206367936', 470155536, '2024-08-21 20:01:42', '2024-08-21 20:01:42', NULL),
(142, '+79054780901', 470155536, '2024-08-21 21:09:18', '2024-08-21 21:09:18', NULL),
(144, '+77713554999', 470155536, '2024-08-21 21:48:59', '2024-08-21 21:48:59', NULL),
(145, '+77776750275', 470155536, '2024-08-21 21:50:43', '2024-08-21 21:50:43', NULL),
(146, '+79144604714', 470155536, '2024-08-22 07:02:29', '2024-08-22 07:02:29', NULL),
(148, '+79224832542', 470155536, '2024-08-22 07:02:55', '2024-08-22 07:02:55', NULL),
(149, '+79111419909', 470155536, '2024-08-22 07:23:36', '2024-08-22 07:23:36', NULL),
(150, '+79772944214', 470155536, '2024-08-22 07:41:39', '2024-08-22 07:41:39', NULL),
(151, '+79994546720', 470155536, '2024-08-22 07:45:16', '2024-08-22 07:45:16', NULL),
(152, '+79535006474', 470155536, '2024-08-22 07:48:00', '2024-08-22 07:48:00', NULL),
(157, '+79185753988', 470155536, '2024-08-22 08:33:13', '2024-08-22 08:33:13', NULL),
(159, '+79992053126', 470155536, '2024-08-22 08:34:52', '2024-08-22 08:34:52', NULL),
(161, '+79026076089', 470155536, '2024-08-22 09:17:00', '2024-08-22 09:17:00', NULL),
(163, '+79171869531', 470155536, '2024-08-22 09:55:07', '2024-08-22 09:55:07', NULL),
(164, '+79371204669', 470155536, '2024-08-22 09:56:07', '2024-08-22 09:56:07', NULL),
(165, '+79028705247', 470155536, '2024-08-22 09:57:19', '2024-08-22 09:57:19', NULL),
(166, '+79628868729', 470155536, '2024-08-22 11:09:23', '2024-08-22 11:09:23', NULL),
(167, '+79260791183', 470155536, '2024-08-22 11:29:57', '2024-08-22 11:29:57', NULL),
(168, '+79657035642', 470155536, '2024-08-22 11:43:43', '2024-08-22 11:43:43', NULL),
(169, '+79100192150', 470155536, '2024-08-22 12:50:44', '2024-08-22 12:50:44', NULL),
(170, '+79057420169', 470155536, '2024-08-22 13:06:18', '2024-08-22 13:06:18', NULL),
(171, '+79296684459', 470155536, '2024-08-22 13:15:37', '2024-08-22 13:15:37', NULL),
(172, '+79233182288', 470155536, '2024-08-22 17:07:13', '2024-08-22 17:07:13', NULL),
(173, '+71111111111', 470155536, '2024-08-23 00:43:38', '2024-08-23 00:43:38', NULL),
(175, '+79616468098', 470155536, '2024-08-23 03:28:03', '2024-08-23 03:28:03', NULL),
(178, '+79229514988', 470155536, '2024-08-23 11:54:06', '2024-08-23 11:54:06', NULL),
(180, '+79611754532', 470155536, '2024-08-24 11:06:49', '2024-08-24 11:06:49', NULL),
(181, '+79136290928', 470155536, '2024-08-24 16:13:07', '2024-08-24 16:13:07', NULL),
(183, '+79520156950', 470155536, '2024-08-25 00:09:33', '2024-08-25 00:09:33', NULL),
(185, '+79275080742', 470155536, '2024-08-25 11:10:09', '2024-08-25 11:10:09', NULL),
(186, '+79872729753', 470155536, '2024-08-25 15:03:42', '2024-08-25 15:03:42', NULL),
(187, '+79262731442', 470155536, '2024-08-25 20:16:36', '2024-08-25 20:16:36', NULL),
(188, '+79969300117', 470155536, '2024-08-25 20:18:40', '2024-08-25 20:18:40', NULL),
(189, '+79636556450', 470155536, '2024-08-26 10:57:08', '2024-08-26 10:57:08', NULL),
(190, '+79991943585', 470155536, '2024-08-26 14:21:50', '2024-08-26 14:21:50', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` bigint UNSIGNED NOT NULL,
  `theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `theme`, `created_at`, `updated_at`) VALUES
(1, 'Автомобили', NULL, NULL),
(2, 'Авторский блог', NULL, NULL),
(3, 'Бизнес, предприниматель', NULL, NULL),
(4, 'Дети, семья и отношения', NULL, NULL),
(5, 'Дом, сад и огород', NULL, NULL),
(6, 'Дизайн и фотография', NULL, NULL),
(7, 'Дизайн интерьера, ремонт', NULL, NULL),
(8, 'Еда и кафе', NULL, NULL),
(9, 'Животные', NULL, NULL),
(10, 'Жизнь за границей', NULL, NULL),
(11, 'Здоровье и медицина', NULL, NULL),
(12, 'Игры', NULL, NULL),
(13, 'Инвестиции', NULL, NULL),
(14, 'Искусство', NULL, NULL),
(15, 'Книги и чтение', NULL, NULL),
(16, 'Красота и косметика', NULL, NULL),
(17, 'Лайфстайл', NULL, NULL),
(18, 'Маркетинг, smm, pr', NULL, NULL),
(19, 'Мода и шопинг', NULL, NULL),
(20, 'Мотивация и саморазвитие', NULL, NULL),
(21, ' Наука и технологии', NULL, NULL),
(22, 'Недвижимость', NULL, NULL),
(23, 'Региональные', NULL, NULL),
(24, 'Рукоделие, DIY', NULL, NULL),
(25, 'Скидки и акции', NULL, NULL),
(26, 'Спорт', NULL, NULL),
(27, 'Строительство и ремонт', NULL, NULL),
(28, 'Сфера IT', NULL, NULL),
(29, 'Театр, кино и аниме', NULL, NULL),
(30, 'Туризм и путешествия', NULL, NULL),
(31, 'Медитация, тренировки', NULL, NULL),
(32, 'Хобби, отдых и развлечения', NULL, NULL),
(33, 'Экономика и финансы', NULL, NULL),
(34, 'Юмор и мемы', NULL, NULL),
(35, 'Юриспруденция', NULL, NULL),
(36, 'Другое', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `telegram_verified_at` timestamp NULL DEFAULT NULL,
  `tg_phone_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `role`, `password`, `status`, `telegram_verified_at`, `tg_phone_id`, `created_at`, `updated_at`, `deleted_at`, `is_admin`) VALUES
(1, 'Системное сообщение', 'system@adswap.ru', '+70000000001', NULL, 'admin', '$2y$10$iQDI0S/Wg61vOMHmLNwauuGk4o3gEZcB2EHf8Y9IvxP50ZTncwrie', 1, NULL, 1, '2024-08-07 09:05:45', '2024-08-07 09:05:45', NULL, NULL),
(2, 'Админ', 'admin@adswap.ru', '+70000000000', NULL, 'admin', '$2y$10$uZnfXTeAhdKXJ2/N1kwrK.DV1EYYKIHXEANjhBM12SMEtDuZESgGC', 0, NULL, 2, '2024-08-07 09:05:45', '2024-08-07 09:05:45', NULL, 1),
(3, 'Модератор', 'moderation@adswap.ru', '+71111111111', NULL, 'admin', '$2y$10$q93bajh59P5sQMlDIesXn.Y.E4kz3HvooDI/iPs6S2dwQe.M5pF66', 1, '2024-08-23 00:42:49', 173, '2024-08-23 00:42:49', '2024-08-23 00:42:49', NULL, NULL),
(9, 'Анастасия', 'influence@tla-agency.ru', '+79648573160', NULL, 'seller', '$2y$10$Uy1.sR56ofmwpxOT5P2UKua7i5fLdXjid9eV4cxbr4j3IMF3YHv/G', 1, NULL, 10, '2024-08-08 12:23:11', '2024-08-08 12:23:11', NULL, NULL),
(10, 'Арина', 'arina.work.4@mail.ru', '+79153788434', NULL, 'seller', '$2y$10$FVAQwGXBk5UInUmIi05M3eTq18hNAf0AcJDPYCDme090DNICtRwBO', 1, NULL, 11, '2024-08-09 06:56:53', '2024-08-09 06:56:53', NULL, NULL),
(12, 'Владислав', 'mng33@top-you.ru', '+79998880006', NULL, 'blogger', '$2y$10$EZl897sycyuUtVUH1HeILui.U6179WnAZzDH.RWrNVBsCCpO3pVUa', 0, NULL, 8, '2024-08-09 10:09:47', '2024-08-09 10:09:47', NULL, NULL),
(18, 'Вячеслав', 'slava.baranchuk@gmail.com', '+79260877002', 'profile/pohoKIO8E8xfZH7prioVzeym1fBU4y7kVSTk81cR.jpg', 'blogger', '$2y$10$49aUQ8E4XdImCzIzwBx9qOKV72w2EU77/9YwlqaBguA4XRWDcgEhy', 1, NULL, 18, '2024-08-11 10:50:18', '2024-08-30 16:35:18', NULL, NULL),
(20, 'Семья ФиА', 'semyafia@gmail.com', '+79601346583', 'profile/793SYhJwzSRs9QtMbM1Al4RF4PXhVuvaG06Z3U2O.png', 'blogger', '$2y$10$0gVQR/7ur4I1ZxIZbwkD4eLecBqq39cWNEWpPkjqNkv1uCqXgP/uu', 0, NULL, 20, '2024-08-11 11:54:15', '2024-08-11 19:37:36', NULL, NULL),
(22, 'Елена', 'alenkared7@gmail.com', '+79612865091', NULL, 'seller', '$2y$10$2SW8.KoTgp6CXO/JvimYbuQusdUQfPJtiQlpLLJFG4wr8.O5FFrqi', 1, NULL, 25, '2024-08-11 18:48:09', '2024-08-11 18:48:09', NULL, NULL),
(23, 'Юрий Кузякин', 'kz152rap@gmail.com', '+79990737397', 'profile/DddaTBZNupPdhpcPSmi7UzpEsECW7OnDLm3XEU7T.png', 'blogger', '$2y$10$olvAcixR1ia.L2p.U76zc.hvsRXk.eetdXBrrLYQoI97JB7FFkVIi', -1, NULL, 19, '2024-08-12 08:20:45', '2024-08-30 16:42:25', NULL, NULL),
(24, 'SELLER', 'mng336@top-you.ru', '+79603677437', NULL, 'blogger', '$2y$10$.2kzNXUxNxqiiL05bEwZauRH0XGxWjimnQ0jp7j9NJAULRgEBfNqO', 0, NULL, 26, '2024-08-12 08:58:26', '2024-08-12 08:58:26', NULL, NULL),
(25, 'Анастасия', 'kubrakowaz@gmail.com', '+79047742206', NULL, 'seller', '$2y$10$NIFS/z.v6BDm7y6ZLT/mneXPDHkVyW41LRtBIysglgZgzDnSGF5SC', 1, NULL, 28, '2024-08-13 09:37:32', '2024-08-13 09:37:32', NULL, NULL),
(26, 'Анастасия', 'murpainter@gmail.com', '+79162089773', 'profile/A09ZajuGfYA2ChsOlPQqv9jAT8NI9Olgaa9FC3Cy.jpg', 'blogger', '$2y$10$a1CoOkwGBKyjzdmyRMgpr.9ilgizk3fkK7IeW6FkhQ5OjBi25977m', 1, NULL, 29, '2024-08-13 11:47:46', '2024-08-30 16:44:05', NULL, NULL),
(29, 'Андрей', 'andrei_255@mail.ru', '+79056727038', 'profile/w7F7RFSn67Wb6rvzgBeLOdlWYzYHsf70tOU16gEL.jpg', 'blogger', '$2y$10$Gl0ndSMzLUOVnh7ij22n1u0Wc/4qpFV855hamg9WJNytkhV55i5D.', 1, NULL, 30, '2024-08-13 19:49:36', '2024-08-14 08:57:51', NULL, NULL),
(30, 'Василий', 'vasilii100152@gmail.com', '+79189524920', 'profile/souYZInxBEIc1kQSsoeOtYKEgs8z0luMPoMhP6eb.jpg', 'blogger', '$2y$10$JvVAo/X4fSZ848hkcF8kMOzx/1uDiRFGbtwFq1FcwT/GC.HrL0JF2', 1, NULL, 31, '2024-08-14 06:46:04', '2024-08-14 08:59:53', NULL, NULL),
(31, 'Егор', 'e.p.kravtsov@yandex.ru', '+79935622499', NULL, 'seller', '$2y$10$l1z4zfZofGwt3yeNeIc/d.tVDPgOEVVBYOkQX.HFF2vG0HG29diby', 1, NULL, 32, '2024-08-14 10:49:31', '2024-08-14 10:49:31', NULL, NULL),
(32, 'Вадим Стукалов', 'info.stukalov@mail.ru', '+79990039366', 'profile/R1F5ms1QuoRKUB1SEgRKUUgPICcJ56DhRoAjMLyj.jpg', 'blogger', '$2y$10$K9dQPWRNiwW2EERsSi3mDuT4zTWCohZoRsW.f8stHrI4Wo8A4aK9a', 1, NULL, 35, '2024-08-16 12:02:11', '2024-08-16 12:16:23', NULL, NULL),
(33, 'Вероника', 'veronija17.05@list.ru', '+79873977707', NULL, 'blogger', '$2y$10$Gsk/lWaCORXMksslmV36Pe8lyPPTvoLF9ociM54jgAcLhmTkxI./W', 0, NULL, 36, '2024-08-16 12:03:49', '2024-08-16 12:03:49', NULL, NULL),
(34, 'Ксения', 'hramovaxeni@ya.ru', '+79171558203', 'profile/JvhQV2hjGqwhtjvBw1KzrggtbK86ZvsKBOZIDFWh.png', 'blogger', '$2y$10$bENEKRds5YTEOBCfVKb7T.Ryp4aMoQsiJQtfoIF.6IMbq1AAYM/aS', 1, NULL, 39, '2024-08-16 12:07:03', '2024-08-16 12:29:16', NULL, NULL),
(35, 'Роксана', 'raksanachernokan@mail.ru', '+79965994266', 'profile/nuFhcpHwGSFCv84pDmWToytzqVIQNIhdrWljC7z5.jpg', 'blogger', '$2y$10$M60qYmNzXTmTTndulbGBEeV5u3xSHQ7rHFgrKUOKMHnvj9Q6llfYa', 1, NULL, 40, '2024-08-16 12:08:38', '2024-08-30 16:37:29', NULL, NULL),
(37, 'Лера', 'valeriesurina@bk.ru', '+79854242335', 'profile/YfCT2PSwqGpoT8UwaNp7ZrW0vP6Gjke2Gv4MVDUZ.png', 'blogger', '$2y$10$1BFsSsdvU6rD1pI6moXLQueLiuElQgY0eV88t0yDHNsdBEH06ZpAe', 1, NULL, 42, '2024-08-16 12:13:06', '2024-08-16 12:24:40', NULL, NULL),
(38, 'Ксения', 'ksyusha.97uuu@mail.ru', '+79956535674', NULL, 'blogger', '$2y$10$6.XoN8Enqz6eZyXBxAb0v.k8VpeK9ykSkYdKxGKJm84tQ2W096QDu', 0, NULL, 43, '2024-08-16 12:30:44', '2024-08-16 12:30:44', NULL, NULL),
(39, 'Мария', 'rzh-machs@uandex.ru', '+79082782176', 'profile/Tvuq6HyWyiyUh4wurm85gunqaujaLEUBCrBX9iEE.png', 'blogger', '$2y$10$uJhgXSiCylMqfhN0oPpcx.sPQngRRgTmxkE5QWJGWBH7cVdTmwrWK', 1, NULL, 45, '2024-08-16 13:12:18', '2024-08-16 14:43:26', NULL, NULL),
(40, 'Регина', 'zubaldullina2017@gmail.com', '+79170450770', 'profile/VfHGaboLcJdA3Ll7bCIg56bhIfgNBQcNn9u1ojFI.jpg', 'blogger', '$2y$10$sLVUHbe3ZjhrNQ/fwFvqzu6U/FPd3fHk2uqpVSuGLS0Qk3OrgiqQa', 1, NULL, 47, '2024-08-16 13:46:42', '2024-08-16 14:45:15', NULL, NULL),
(41, 'Мария', 'vad1mowna.m@ysndex.ru', '+79787110668', 'profile/knmhNEK69yiCmsorMMtxBDdrlvv6kxe78A2e9Ggn.jpg', 'blogger', '$2y$10$.n9OOa/Y8qvZJNuoeCFaV.jgZ5gbTf11KMHqMxYoFJ1WLl0AYGTPG', 1, NULL, 49, '2024-08-16 15:00:04', '2024-08-16 15:49:08', NULL, NULL),
(42, 'Светлана', 'lanasmi1997@mail.ru', '+79393776398', 'profile/ww1edwxGO6SxeuVnvFbcj6vhi4qPnAlsekmgWaWK.jpg', 'blogger', '$2y$10$YMcWciyW85I5TD9/zw5Rz.ullkMA2dCcr3BKK60c2ukUiuATXhsFm', 1, NULL, 50, '2024-08-16 15:00:30', '2024-08-16 15:47:46', NULL, NULL),
(43, 'Ирина', 'tsoy.io.2015@gmail.com', '+79038626900', 'profile/Fberx3IRuio3tzt5zQaia3xE4UPJ83LR85qdHNjs.png', 'blogger', '$2y$10$.Wd4NpPCd8UFNA80v8QSwOf44fiSL8vXd.DvxXqILiWM8LHb/.su6', 1, NULL, 51, '2024-08-16 16:05:54', '2024-08-16 16:14:08', NULL, NULL),
(44, 'Виктория', 'vikasmolova58@gmail.com', '+79787028736', 'profile/y8Ecbhs6I8bNJhVAKmfVaxLk03dAfNXJ43qMAMhv.jpg', 'blogger', '$2y$10$s2mjmGzT0EFEI4wSYPEGneIN5AOksSjWauj.9pciK1McfnoL3KKcm', 1, NULL, 52, '2024-08-16 16:55:20', '2024-08-19 18:15:09', NULL, NULL),
(45, 'Алина', 'alina123.zadg@gmail.com', '+79953042724', 'profile/OZBJqhdETi3TAUZBHF9cYe9nSVjXqaFEmDAJMaSz.jpg', 'blogger', '$2y$10$z6rbFXPoUpucqaBPzku5Tus2sxFNRL7B3C4XeTnUVy1c4DpTPlYLC', 1, NULL, 53, '2024-08-16 17:24:32', '2024-08-29 14:31:14', NULL, NULL),
(46, 'Ксения', 'kgumenuk688@gmail.com', '+79518261680', 'profile/gzEjDy3tzLXmy7IuOls2YyO37egbjHJIDLbGykz2.jpg', 'blogger', '$2y$10$zuGEHA6Fti0D5xkV/EOSLOJU7BVVqRditqAuvDvR5/0L7hjHZ.3i2', 1, NULL, 54, '2024-08-16 18:42:03', '2024-08-17 07:06:40', NULL, NULL),
(48, 'Мария', 'mari.klimova1006@mail.ru', '+79377098703', 'profile/mHAAsOkxQtwkM2hmgxjiGjMzfFqCLJyoYHpsn8CY.jpg', 'blogger', '$2y$10$3HdfxLfzr/h9SLH6KFZ.tuAeE17TKdFuURQ2DEglun9NR1I1SN9y.', 1, NULL, 56, '2024-08-17 06:19:40', '2024-08-29 14:32:13', NULL, NULL),
(49, 'Вера', 'vera.efremkina@mail.ru', '+79818200243', 'profile/SySk1129NlQSDVtqwglhHlMQaqtkVT9M0Q4a2278.jpg', 'blogger', '$2y$10$CKs0TKIh7SuAMFFGgGnRZ.MhS9AwZ84MMOMlR3aJKYLauXhIQ5N8C', 1, NULL, 58, '2024-08-17 07:28:07', '2024-08-30 16:42:30', NULL, NULL),
(50, 'Анастасия', 'menestralia219@gmail.com', '+79325544076', 'profile/WZNkSOzaCcTl5sMCAjaNvQh8Peot3t5qdb7X0AEv.jpg', 'blogger', '$2y$10$w8yE/U24qbaZvDznXHP5iuIHRWlUTGWUPxXwiY8DPks2GOT7.rqOq', 1, NULL, 63, '2024-08-17 10:11:30', '2024-08-17 10:18:31', NULL, NULL),
(51, 'Дмитрий', 'dima76antonov@yandex.ru', '+79056388130', 'profile/8vvASkMTaoNjLNqswr1oIX30gzJgbFSYgwo3zkMO.jpg', 'blogger', '$2y$10$D5cZUh1aPsM.CYa89NMo/OaMunVSH3Sn62JvhpoMUl2u4ONdSmrb2', 1, NULL, 64, '2024-08-17 18:05:07', '2024-08-18 09:29:03', NULL, NULL),
(52, 'Лилияна', 'wowliil@yandex.ru', '+79961221280', 'profile/EgcqeNX0l429eG3OCjBXcXB42Ht6gvd6KG8Wu3lP.jpg', 'blogger', '$2y$10$zubuOwCZGg5FAQ1TsgaSqOCllS2WvNwTqig5U7EVcUO6UfvfTrlzu', 1, NULL, 65, '2024-08-17 19:58:08', '2024-08-18 09:30:47', NULL, NULL),
(53, 'Карина', 'k29229913@gmail.com', '+79789553623', 'profile/u9UrfpQH6xNzezXM77UFuj4sQiMVUNVDvAVPtEuO.png', 'blogger', '$2y$10$a/hoka5m78.tlXyUwzxUOeCUH7tNyO/wTgyPmcWZLOfZKpx0rQF0K', 1, NULL, 66, '2024-08-17 21:05:29', '2024-08-18 09:32:14', NULL, NULL),
(54, 'Ирина Криницына', 'irisha141994@mail.ru', '+79672442294', NULL, 'blogger', '$2y$10$JCqWIKhGWVaEUNN27lj8se0HM.0eFC3tIFPa.GVi41cr4tSBhmgH.', 0, NULL, 67, '2024-08-18 08:54:04', '2024-08-18 08:54:04', NULL, NULL),
(55, 'Айгуль Загфяровна Латыпова', 'lataigul94@gmail.com', '+79046664306', NULL, 'blogger', '$2y$10$vmMbvmPAVnqJzFl.4PBLmeF3JsnuLJYL0.qi2c8eEu61eBY5aWo3C', 0, NULL, 68, '2024-08-18 09:09:58', '2024-08-18 09:09:58', NULL, NULL),
(56, 'Кристина', 'Tapki.babki@gmail.com', '+79133053800', 'profile/QyPpLa1ZkITBkiUDzSYPy42uOZwLvAOF4pR9eAAT.jpg', 'blogger', '$2y$10$LSWJr.WuOINBbzdBwMz.Oelu2Ub1L8VcqF1smPvsZkjCKQYw3lz3K', 1, NULL, 69, '2024-08-18 10:22:20', '2024-08-18 10:44:53', NULL, NULL),
(57, 'Алёна', 'alenanaro@vk.com', '+79182270196', 'profile/yhfbdqIIsc5TVkbaGnQqHWBRQ9TeKEBRfHKN21r9.jpg', 'blogger', '$2y$10$rpw96mXmei0CLRI4AoRZI.upMkJVGyQFcE.iyQJ1GgH92FT.Xcr0a', 1, NULL, 70, '2024-08-18 11:19:27', '2024-08-18 11:46:02', NULL, NULL),
(58, 'Елена', 'tankistkazhiraf@mal.ru', '+79157213990', 'profile/Pc1pXKASUqDLiZ9bzs6rfnRZz6fQxEqW5VvP7DCc.jpg', 'blogger', '$2y$10$62155n1SYG/IrsuWenIxU.Tv8sh/TFqbhBG/k7uhSwWMrMnixr5.e', 1, NULL, 71, '2024-08-18 11:36:27', '2024-08-18 11:46:59', NULL, NULL),
(60, 'Анна Константиновна Кулешова', 'Anybloom@mail.ru', '+79163505750', NULL, 'seller', '$2y$10$bxgTCGE4vuZXir01O7XfMOX.uzryU1Ew.SblZBrZ9yb9Fhgc/R6Aa', 1, NULL, 73, '2024-08-18 13:06:49', '2024-08-18 13:06:49', NULL, NULL),
(61, 'Наталья', 'vlasowa.natashka@yandex.ru', '+79190366824', 'profile/cwlIdUumCyfq6znBRiE2dp32MhhmVIuCfhLelLqr.jpg', 'blogger', '$2y$10$wPc9tyr3KOUhBT.qsrtmEO0LwbjUjDIyZ.m4IdZrcR8Pvj.8VQXxC', -1, NULL, 76, '2024-08-18 20:53:54', '2024-08-19 06:10:25', NULL, NULL),
(62, 'Елена', 'myzalenarabota@yandex.ru', '+79805468687', 'profile/Iym9lIGr3pawqkTHl9tbAe5Q4AWFK1MVfNmuA3za.jpg', 'blogger', '$2y$10$OCe2Xz2mzl0ZAOf9UiC5seIRPqxeYXDI7dOdsRq5/g3QW7V2QzlOa', 1, NULL, 77, '2024-08-19 06:17:07', '2024-08-19 06:24:09', NULL, NULL),
(63, 'Маргарита', 'ritakorotkova@bk.ru', '+79252290285', 'profile/sAdc9bHKRrJFgfN4N8HydCDK84Ejqj2658sd6N8a.jpg', 'blogger', '$2y$10$DkoHR7ltt0WoMf.aXMv0Qu1M3KiWBYeRUJp1YUiVip0lkgU4rjvmq', 1, NULL, 78, '2024-08-19 08:29:31', '2024-08-19 08:51:03', NULL, NULL),
(65, 'Марина', 'nanni987@mail.ru', '+79104771401', NULL, 'blogger', '$2y$10$J5vRikIP8Rw1moVTiWkQnegKCLLVL63NqxQJL/t006WtrL6eL5m.e', 0, NULL, 80, '2024-08-19 11:14:03', '2024-08-19 11:14:03', NULL, NULL),
(66, 'Полина', 'polinaavdeevaa@yandex.ru', '+79628557780', 'profile/WDekSK4EWiIBhsZYCfzxZ2IMbsgw2eB9WaRTUJT2.jpg', 'blogger', '$2y$10$fC2/i4Im26yz0g6oGExbKOcK.Ppyn0RjBxyrUHao.wFhHnpxhkUxO', -1, NULL, 81, '2024-08-19 16:11:59', '2024-08-19 16:26:31', NULL, NULL),
(67, 'Алёна', 'mozzhukhina20@gmail.com', '+79113547064', 'profile/tjm9HlkC57qzz5zRlwa3uHXj22mGu87up2iR7mhK.png', 'blogger', '$2y$10$6WxaJcLQUk6wUc3RXkqHzOKkXDbVKOOvLLIH.rC/kmssZk1X0xTb6', 1, NULL, 82, '2024-08-19 17:54:49', '2024-08-19 18:37:08', NULL, NULL),
(68, 'Екатерина', 'ekaterina_bizina_gmail.com@mail.ru', '+79237627438', NULL, 'blogger', '$2y$10$wlaS.2GvDR2pAx6dN5..zedCCUxTRHyRVxde0Z3zXmbr9iu6jF7TG', 0, NULL, 86, '2024-08-19 17:56:59', '2024-08-19 17:56:59', NULL, NULL),
(69, 'Анаит', 'anul09105@gmail.com', '+79966754476', 'profile/kcWGmzmfINLEzdRREkmQJJvZOBLbd0fpPO88n0Av.jpg', 'blogger', '$2y$10$SSS.G0mEjP1JfY4fmtNHmOYqnr4.sy7/gIe1GpojSUnixUa3huSwS', -1, NULL, 88, '2024-08-19 18:01:08', '2024-08-20 09:00:47', NULL, NULL),
(70, 'Екатерина', 'pitinaen@mail.ru', '+79780281130', NULL, 'blogger', '$2y$10$tbByNspm6JT/W2dh6reHle/9anqiOwXUFfM.rRFgHU2bfDXvnbklW', 0, NULL, 89, '2024-08-19 18:03:10', '2024-08-19 18:03:10', NULL, NULL),
(71, 'Дарья', 'dasha.busygina.95@bk.ru', '+79966268390', NULL, 'blogger', '$2y$10$ia0C8O8ViKO6H1urwGAYGOvcBBTY.wX1CUZ26KXZDS2WiWJV0stWO', 0, NULL, 90, '2024-08-19 18:04:22', '2024-08-19 18:04:22', NULL, NULL),
(72, 'Яна', 'yananovikova.ru@gmail.com', '+79028440779', 'profile/Lnj9YrzUjvFl1mE7cf0ZajJAcksgQgOCkdZ1LKHH.png', 'blogger', '$2y$10$bVhgb//PtT80tmjFFfK3ZOZ41LSDtCTabkvkJ8lN.FVGd/JhWMZia', 1, NULL, 92, '2024-08-19 18:13:30', '2024-08-19 18:35:55', NULL, NULL),
(73, 'Юлия', 'yulya.rytko@mail.ru', '+79782450142', 'profile/fcAEDbzia0zZAKzJ0xU479ct8xXLiramSNoDzyad.jpg', 'blogger', '$2y$10$c7dytkG/Szy/7DoJAfXlIOSmpxVtdXxzbXvZ.mqkF4TzNzZ9xikeu', 1, NULL, 93, '2024-08-19 18:33:34', '2024-08-20 11:56:50', NULL, NULL),
(74, 'Дарья', 'dasha-sham@mail.ru', '+79370361041', 'profile/wVEucEN6Bl6ai2CUFmlcWUnCqRtWXr5B2otlkiVX.jpg', 'blogger', '$2y$10$LNo9iBMXnCtjRjWZhrwuxeZMRguO31sgshUNjSCy/xZJ2dOVIOKv2', 1, NULL, 95, '2024-08-19 18:43:06', '2024-08-20 11:51:36', NULL, NULL),
(75, 'София Цыбиз', 'stsybiz@bk.ru', '+79182978218', 'profile/8HqeerrARMZ421qS7pg5rvG28pIk4Q797ts5nDSz.png', 'blogger', '$2y$10$QarGisJtvV/PsFqM/wA2PO1uDkvo00k4949ljMmBxA68bkY5JfRwK', 1, NULL, 97, '2024-08-19 19:01:40', '2024-08-20 11:53:03', NULL, NULL),
(76, 'Арина', 'rina1512kotuk@gmail.com', '+79773557890', 'profile/6l7y05fA7QLjrx7fXXX5SKcGJzQaSFY8sQgL0Pnm.png', 'blogger', '$2y$10$v7Jv22edKN0GaNXwQOyApOLW9XgPTE4HF4CcBkE0D9zJn/nSe9Dqe', 1, NULL, 100, '2024-08-19 19:20:50', '2024-08-20 11:54:26', NULL, NULL),
(77, 'Инна', 'litinna82@mail.ru', '+79207600686', NULL, 'blogger', '$2y$10$VT8ORVspStZrZqfNtWLfD.TBkCmrEtxEralfaohQ/mPMdsT9gcTxW', 0, NULL, 101, '2024-08-19 19:22:09', '2024-08-19 19:22:09', NULL, NULL),
(78, 'Лидия', 'lida1234567.2016@yandex.ru', '+79090693132', 'profile/nSFTvcKNWGuXEx5gvVbvM1FsHHbKPTIwityYjMUQ.jpg', 'blogger', '$2y$10$2q3t24K5W68eEnPykobl8eKLOJ20RdnuT4MJ1YdCiP7aYbpjw9rhi', 1, NULL, 102, '2024-08-19 19:41:29', '2024-08-20 11:55:48', NULL, NULL),
(79, 'Анна', 'annapikalova89@mail.ru', '+79619293050', 'profile/6o630M9yjwfW1WS7rzf4Xq8eRu2zsX3hc0avKFA1.png', 'blogger', '$2y$10$JEuhaCWmQ9w5GjCBFhZpDuTyzlXwUX6MDRNzSoj0WxGXe9nhYRKpK', 1, NULL, 106, '2024-08-19 20:08:54', '2024-08-25 18:24:21', NULL, NULL),
(80, 'Дарья', 'dasha.trap50@gmail.com', '+79828044311', 'profile/Dn4hHmFM65V7x6QWjwIwtFAJ3zfzODAk1XKINaF8.jpg', 'blogger', '$2y$10$TZYVGH1u/ueBG.NSmMM7R.dtPIvVs9DJFcdVYsycL/vURatX19w2W', 1, NULL, 107, '2024-08-20 03:02:28', '2024-08-20 11:57:41', NULL, NULL),
(81, 'Анастасия', 'avorozcova929@gmail.com', '+79130820176', 'profile/xSJmIkJe7uhrCLltF8h0SlwtvEwEzhG9XIW5c9jb.jpg', 'blogger', '$2y$10$nBluPpbfjG3PjbnwTHAQOeZWboZptF9SWe1FSZfnPBRI9n3y5m4BS', 1, NULL, 108, '2024-08-20 05:24:43', '2024-08-20 11:59:13', NULL, NULL),
(82, 'Елена Головина', 'elenagolovina46@mail.ru', '+79081291023', NULL, 'blogger', '$2y$10$AcbQTPNuz5s1vors9GHq..Kg46OvgzKFJUdePHmETtWGcBNygdp3q', 0, NULL, 109, '2024-08-20 06:37:58', '2024-08-20 06:37:58', NULL, NULL),
(83, 'Татьяна', 'tatyana2073@yandex.ru', '+79279849406', NULL, 'blogger', '$2y$10$y8RVQ4ox0fcqxCVmk86xUeltMm1BEkYKxfBOrcXGTU.Z0XmXtQxpm', 0, NULL, 111, '2024-08-20 14:37:11', '2024-08-20 14:37:11', NULL, NULL),
(84, 'Анжелика', 'molokanova.00@list.ru', '+79296432876', 'profile/sOVEFlrZg2bq7HMp1IGYpB0kY6nZlB4bKi3QoNMN.png', 'blogger', '$2y$10$WWKatv5In72ns4xO55ga5eAZ9ftnZGS/PeTloDUSJAfNgQlUqtvLW', 1, NULL, 114, '2024-08-20 15:38:08', '2024-08-21 06:07:28', NULL, NULL),
(86, 'Наталья', 'atalya.evsyukova1995@mail.ru', '+79202291672', 'profile/vV7HtRS3xGlsoaGhcWi5VlAWLyH49OA0wswsZd1c.png', 'blogger', '$2y$10$FtTHJHX10fvIHjfHSFlMEehDuJwcAZUVGyQG6vg3loH8pM2YoKLgS', 1, NULL, 117, '2024-08-20 19:42:32', '2024-08-21 06:10:54', NULL, NULL),
(87, 'Дария', 'dashkamurzina43@gmail.com', '+79505590718', 'profile/mzGwYlgzJLPPanfd2e0ZnAfwrZrqWrUqj6IFDb2T.jpg', 'blogger', '$2y$10$YaNldHY7s/aprIIXNiN6nO8oE6RRRcItFfjgMCZncjM6eUHNvuoGy', 1, NULL, 118, '2024-08-20 20:10:13', '2024-08-21 06:12:12', NULL, NULL),
(88, 'Эля', 'mazikelka@yandex.ru', '+79780432070', 'profile/yY3wtC1G4VSpt2ec9cYF4Rwnw5toOMH8PMmgK5jc.jpg', 'blogger', '$2y$10$UvO6efJ13S2rJvCReY8te.HdcDhWYphehcnfmmrDJzD.QOs8Uc72a', 1, NULL, 119, '2024-08-20 20:14:39', '2024-08-21 06:14:25', NULL, NULL),
(89, 'Мари', 'tayra-taksa@mail.ru', '+79031382604', 'profile/lCiPGem7OWIujTB5Vxbf4vTVf6t3bfDytr5f44RI.jpg', 'blogger', '$2y$10$FODKtmL5an/Nz2l9khPEf.kDZIUL/YUrQKy.fhHkUXgSyrA/ICzP.', 1, NULL, 120, '2024-08-20 21:01:58', '2024-08-21 06:15:26', NULL, NULL),
(90, 'Анастасия Клейменова', 'anastasiria@gmail.com', '+79158565530', NULL, 'blogger', '$2y$10$Tq0/hkOdxwSGo73.dB8SK.ZfMoy/VGOa8R08yV0c9u/gVzrCiAWsO', 0, NULL, 121, '2024-08-21 04:24:01', '2024-08-21 04:24:01', NULL, NULL),
(91, 'Ксения', 'Zhirova.93@bk.ru', '+79000613066', 'profile/mSGgmVpVapqkclh6izEA6NxXROORFKeJhy4IBR1a.jpg', 'blogger', '$2y$10$RtaiLK01Nqdmh52rExyLrO5ZaD6qq4aYEhl6IH4mDyJstB1gypIqy', 1, NULL, 122, '2024-08-21 06:32:33', '2024-08-21 15:29:46', NULL, NULL),
(92, 'Анастасия', 'bugagasha2012@yandex.ru', '+79127832717', 'profile/58XXT0knIGP2mQltRsONqIv2csCEEZMACpjl6yZf.png', 'blogger', '$2y$10$bDXqK6x.9omGKsP.vglsd.1bRBACxzdcIan9v7pkQD1B8C4WAcr9K', 1, NULL, 123, '2024-08-21 12:25:46', '2024-08-21 15:40:44', NULL, NULL),
(93, 'Анастасия', 'nastya.reva.1997@mail.ru', '+79131684689', 'profile/jufpVZ9BaE5cltIrwnG9d9tqqnui6kVudKn8CST0.jpg', 'blogger', '$2y$10$/0hN5WFqUH0qw97JtLqtAuNeA/U6W.A7pNY1XZ92IhVqmNYZ5k3LK', 1, NULL, 125, '2024-08-21 12:49:20', '2024-08-21 15:44:05', NULL, NULL),
(94, 'Лина', 'perets_pr@mail.ru', '+79770002222', 'profile/W0dUalQ8jzremySUCkNgpgqeHcF2kvTrgylK4cyC.jpg', 'blogger', '$2y$10$XltyUeeP6BPpbyorsOlg.eMO7JV5X/pDRi0/dGPZwa10dK8tU2k1W', 1, NULL, 127, '2024-08-21 12:52:43', '2024-08-21 15:50:10', NULL, NULL),
(95, 'Ксения', 'ksqsha2012@yandex.ru', '+79266570733', 'profile/rybESq494XHnBn9I4C2E2TpK4uJgOnjQhmr7X4iu.jpg', 'blogger', '$2y$10$UF/YSuv2Lc3y4T3aQa5AlOtgaKsqed/X8P78j2zdfADD8Cdvxl2kW', 1, NULL, 130, '2024-08-21 12:55:10', '2024-08-21 16:36:57', NULL, NULL),
(96, 'Вера', 'vera-zausaylova@rambler.ru', '+79097416037', 'profile/ujPnfM6pCw5L95s4dic88BZw7u5vNJiojSuNKJrs.jpg', 'blogger', '$2y$10$Q5rLguQMCGwpgTFF7H40NeKs1hKPsy19ZvBH2ahRJCoNxotVSVUOO', 1, NULL, 133, '2024-08-21 13:25:59', '2024-08-21 16:39:56', NULL, NULL),
(97, 'Анжелита', '1234567890anj@mail.ru', '+79046496649', 'profile/hQ6MSm8UbMWmZDHxPNB3UMpWcMCmeDH3lFqXX3iE.png', 'blogger', '$2y$10$O.rAw48GTC4JufLdTlpJtuD/rVGUQaNq4jQLEfOX.RN2Yzso.Hypy', -1, NULL, 134, '2024-08-21 13:27:17', '2024-08-29 14:19:59', NULL, NULL),
(98, 'Светлана Андреевна Макеева', 'makeeva.pr@mail.ru', '+79260498395', 'profile/rjsggM6HlmYTV9hgSNbPSoXHslxn7XRRCgphzWde.jpg', 'blogger', '$2y$10$lnqImpXUrFdN3BHjD8.VOOK9gn.gfU9SrMX0RRdRS.zLdCoUtpydy', 1, NULL, 135, '2024-08-21 13:55:17', '2024-08-21 16:56:12', NULL, NULL),
(99, 'Мария', 'mashulya.polyakova.74@list.ru', '+79966395622', 'profile/XXnpNGmnFx5JvAd68r0abazDvJhglW13nnptBKKc.jpg', 'blogger', '$2y$10$WImTGr.Vz8xhY1uLW9EAIOldp4j1xpOP9IVYYgC24T1znZ9G9PHJO', 1, NULL, 138, '2024-08-21 14:34:05', '2024-08-21 16:59:00', NULL, NULL),
(101, 'Анжела', 'dzhepko93@gmail.com', '+77776750275', NULL, 'blogger', '$2y$10$wpUim3VjQe3dNMGdZvrK2...r9FFpzpXbvwFmYU6jEERmV9gdU6aa', 0, NULL, 145, '2024-08-21 21:50:49', '2024-08-21 21:50:49', NULL, NULL),
(104, 'Владислав', 'traffic@tla-agency.ru', '+79539800017', NULL, 'blogger', '$2y$10$Uy1.sR56ofmwpxOT5P2UKua7i5fLdXjid9eV4cxbr4j3IMF3YHv/G', 1, NULL, 15, '2024-08-22 06:19:38', '2024-08-22 15:13:03', NULL, NULL),
(105, 'Владислав', 'polhol.kk@gmail.com', '+79998880004', NULL, 'blogger', '$2y$10$gUe9KnrbZa7eiP5HkimGxO//glWNS/LavKjM0VYAAF6diwtxAvEZS', 0, NULL, 6, '2024-08-22 06:22:53', '2024-08-22 06:22:53', NULL, NULL),
(107, 'формы Тест', 'aleksey.4elnokov@ya.ru', '+79279824554', 'profile/LniSJo1fL0GeKmClV4XcLNBQTzy7kMRLhaRP7n2d.jpg', 'blogger', '$2y$10$9n.QYDO9FWZkBw5XLTvCDeHSUceQ305UDyo.qSt0BynJuomeHhpRK', -1, NULL, 9, '2024-08-22 06:26:02', '2024-08-26 09:55:25', NULL, NULL),
(109, 'Оксана', 'epikhina.ok@yandex.ru', '+79772944214', NULL, 'blogger', '$2y$10$wo7j2Tb9wqdwou/3iFZqau5OFUvGTxGP4AMKoYLED2BbOq.WD.yR6', 0, NULL, 150, '2024-08-22 07:42:10', '2024-08-22 07:42:10', NULL, NULL),
(110, 'Татьяна', 'glazova85@icloud.com', '+79224832542', 'profile/tqGFrZymMW3Os3rK8YptYrvxEatpHw17OwkG8g0g.jpg', 'blogger', '$2y$10$hhpeJK2N8yI7xB7xb6CvvODNuGq1em5il8oVZP2fuWV6mYflXnBLe', 1, NULL, 148, '2024-08-22 07:54:17', '2024-08-22 07:59:47', NULL, NULL),
(111, 'Екатерина Никитична Есичева', 'Belousova_en@mail.ru', '+79535006474', 'profile/IqM3pqadSwKhDVwzTwrg6g2tO8DIkQRCIAwd1cYq.png', 'blogger', '$2y$10$Gg9GEal9YOJc4f7aJSC/sO4olxCUHcvO20nVeu8wZ2.ZiWMIh9gq6', 1, NULL, 152, '2024-08-22 07:58:21', '2024-08-22 08:11:51', NULL, NULL),
(112, 'Ольга', 'zmeika52@mail.ru', '+79994546720', 'profile/DbDuDiMqyFMHGsdMq4exIDzbMkK17fu3YYeoMrLx.jpg', 'blogger', '$2y$10$kJ8p/wH6cPDRI1pCKupZB.p2cYhADs9g0x1mkxbxPxt26tWgWbiqa', 1, NULL, 151, '2024-08-22 08:06:43', '2024-08-22 08:13:05', NULL, NULL),
(113, 'Юлия', 'masa.ki@yandex.ru', '+79992053126', 'profile/Hn12DFIP9ok5yYaTeUTmlbyYoAfVRS0s3V1I6Irm.png', 'blogger', '$2y$10$qv31v8DQQnsiGX9h..IhaOl6L.napd/wY1z4oCAolkDi9aXBDXOIS', 1, NULL, 159, '2024-08-22 08:35:18', '2024-08-22 13:03:29', NULL, NULL),
(114, 'Валерия', 'lera.burlina08@mail.ru', '+79371204669', 'profile/Dhxitvx2ILEdpqMUHLbH336pDmVjDJ81LokqRHMq.jpg', 'blogger', '$2y$10$yxDRkTxeFLEtN4Z/nYn1veB/bW9pW9NH3ZaLfHWxxwan6Bslp/Obu', 1, NULL, 164, '2024-08-22 09:56:11', '2024-08-22 13:04:40', NULL, NULL),
(115, 'Елена', 'elena_gricai@mail.ru', '+79028705247', NULL, 'blogger', '$2y$10$E0oJqirtal2lNZTlv8ZQ/e6.5RnfLv.sviEcRSJbHwDq9QYfbkvuG', 0, NULL, 165, '2024-08-22 09:57:31', '2024-08-22 09:57:31', NULL, NULL),
(116, 'Лариса', 'katya884@bk.ru', '+79628868729', 'profile/pcaPzpw3A5RompFuWEHrVr4O8tAFx99zLXuwV45D.jpg', 'blogger', '$2y$10$EqveGf2CPHidI80zoX3fqu727O0fK3H/1NHhrs8f6E69O2t32Goqq', 1, NULL, 166, '2024-08-22 11:09:29', '2024-08-22 13:18:01', NULL, NULL),
(117, 'Юлия', 'dmitrakova2019@bk.ru', '+79065065287', 'profile/TBywWpT7S3Epb0lvCYgxF1nNwVkjBRMQOADxMqNG.png', 'blogger', '$2y$10$hW.E8nGkfxy4glqJoVZPcOsGFc7ixN2Nfz9IO.povwwTr3EvXzRB.', 1, NULL, 131, '2024-08-22 11:25:33', '2024-08-22 11:31:55', NULL, NULL),
(118, 'Юлия', 'julia.re@bk.ru', '+79260791183', 'profile/Mld00NIoLrAnesWhTGzKg2OL6Cyc2Sog9rrLLGGc.png', 'blogger', '$2y$10$CnVzGhNf7XPcyPXzItWwbu9BIR8O/WOwSrr5bndpFrPMyd3Ov0n0G', 1, NULL, 167, '2024-08-22 11:30:02', '2024-08-22 13:19:53', NULL, NULL),
(119, 'Яна', 'yana.maks@inbox.ru', '+79100192150', 'profile/xB6ebVgTsPrSvwNDJ9xUj76bRiHETaT5WsAgFVFw.jpg', 'blogger', '$2y$10$816OIIMJseiiHdhDE4.DRO8Y6gsIAS92QmbTJWg4x2nWFQdxCoJVO', 1, NULL, 169, '2024-08-22 12:51:08', '2024-08-22 13:20:45', NULL, NULL),
(120, 'Ольга', 'kruella821@mail.ru', '+79057420169', 'profile/QUm4VV2DrJQU6LYz8aCWbxA86QfIhhK5wTtfqckK.jpg', 'blogger', '$2y$10$c7/ZFiK1b2RDY2W4fZ4BFuzVgVrdew0ok.AvrOgkz3.mpsMdD7A2m', 1, NULL, 170, '2024-08-22 13:06:46', '2024-08-22 13:22:26', NULL, NULL),
(121, 'Виктория', 'victoria_vip@list.ru', '+79296684459', 'profile/D8uSkJmzPby94aSLlpZdO8JsP0bJFXu8lV4KrSkI.jpg', 'blogger', '$2y$10$hQUwrbaYv4YDPjr7EPxxUO4n4iubRiMcrBjHM.TzjO4ppOiV/Bq5S', 1, NULL, 171, '2024-08-22 13:15:40', '2024-08-22 13:26:24', NULL, NULL),
(122, 'Ольга', 'olya.siverina@mail.ru', '+79657035642', 'profile/xfto2920qUi6XRikV3wySOQejj2mud2oN57uPR47.png', 'blogger', '$2y$10$vn9mvvZ9oaAu1kd.TNJ8ieRe2XqLpj82FG4C9m0SHzcZmWiOlF2nC', 1, NULL, 168, '2024-08-22 15:21:28', '2024-08-22 15:27:16', NULL, NULL),
(123, 'Александра', 'kezina.alexandra@ya.ru', '+79233182288', 'profile/h5s4tX6iowWHmioKLiB28oYBnEZHygUe17XOieLv.png', 'blogger', '$2y$10$IylUm0aQFtCE.UcV.yj62.aEYmTi3mdhHzGlGiynlbq4i/tHpY0km', 1, NULL, 172, '2024-08-22 17:08:53', '2024-08-22 17:17:56', NULL, NULL),
(124, 'Владислав', 'polhol.hdfkk@gmail.com', '+79998880005', NULL, 'seller', '$2y$10$YyJVFv8hShiFbhVdWPB8VeqwfBxCMs2fmu4mPknCKtDdRca7ELYTe', 1, NULL, 7, '2024-08-22 17:52:22', '2024-08-30 16:37:54', NULL, NULL),
(126, 'Алёна', 'marketc063@gmail.com', '+79611754532', NULL, 'blogger', '$2y$10$z3.b3yDk7EJfRi/oIMmUZuEA9Vp0OXMmRcFY0AtibQ6XVqdAsqo06', 0, NULL, 180, '2024-08-24 11:06:56', '2024-08-24 11:06:56', NULL, NULL),
(127, 'Валерия', 'leramari@icloud.com', '+79520156950', 'profile/xUbNvUfRMNsrtka98Bgv4kJZs2CBzCgg34by0IzP.jpg', 'blogger', '$2y$10$ceQR1XrwqEvbfPle34Jx6eGW0wPqEe84V4lf6UvsyVqK1IzlGu2Du', 0, NULL, 183, '2024-08-25 00:10:01', '2024-08-25 00:11:24', NULL, NULL),
(128, 'Людмила', 'lusien1788@mail.ru', '+79275080742', 'profile/E9Qt10QsJ3gKFGSH6kXKZgnOC47q7Icc0iwkM4ln.jpg', 'blogger', '$2y$10$vabtP7J5Su8gaYNJHr/UpemtW5y19VDF/looIaVuTzNeXCXpfrjZi', 1, NULL, 185, '2024-08-25 11:10:21', '2024-08-25 12:50:47', NULL, NULL),
(129, 'Андреев', 'lehagagog@mail.ru', '+79603701424', NULL, 'blogger', '$2y$10$xmnDpj8FqvxOpVI4QWeyqeUlgoA5hiBeXUUhC7W0NrKGG/4uBCKW6', 0, NULL, 13, '2024-08-25 11:51:22', '2024-08-25 11:51:22', NULL, NULL),
(130, 'константин котов', 'kotovkostyan@gmail.com', '+79872729753', NULL, 'blogger', '$2y$10$P4qQsittNHr8FFdEGxA.jur1KVcacWaRm6rAL2qhnOz.pCEdW54EK', 0, NULL, 186, '2024-08-25 15:07:43', '2024-08-25 15:07:43', NULL, NULL),
(131, 'Татьяна', 'tpolasova34@gmail.com', '+79969300117', 'profile/Wyr7MhVU7bVZ38AXto1zjBesFOKDyluIXnh9Hy3K.jpg', 'blogger', '$2y$10$XCPc/a9MjiW8SjY8XXhAPOo3LeUSMBSp1tTVXHkp2FS9b4yVb6Dde', 1, NULL, 188, '2024-08-25 20:19:18', '2024-08-26 06:34:43', NULL, NULL),
(132, 'Татьяна', 'romenkova1993@mail.ru', '+79636556450', 'profile/ufnOEgYa0Ikp4UP4xnA6ZPXwMoaZwv1VzX2qmcl6.jpg', 'blogger', '$2y$10$ntkFK5JBSqS14GAIdVoAY.2MbCk410GdkeNfA1M8Ydft9fHoLaiRq', 1, NULL, 189, '2024-08-26 10:59:05', '2024-08-26 11:25:22', NULL, NULL),
(133, 'TRIANGLE', 'clashsavin@gmail.com', '+79991943585', 'profile/gOO2PHnUqUOnzrfXgaPE1vXU1jkpbNAAOeO1fFqy.jpg', 'blogger', '$2y$10$.WJOhKhU2qHFURnxLTYmMe105wDeRd7TMnEFE2ZF/tPfkQpbZPqDW', 1, NULL, 190, '2024-08-26 14:21:53', '2024-08-26 14:24:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_achievemnts`
--

CREATE TABLE `user_achievemnts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `achievement_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE `works` (
  `id` bigint UNSIGNED NOT NULL,
  `blogger_id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `project_work_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accepted_by_blogger_at` timestamp NULL DEFAULT NULL,
  `accepted_by_seller_at` timestamp NULL DEFAULT NULL,
  `confirmed_by_blogger_at` timestamp NULL DEFAULT NULL,
  `confirmed_by_seller_at` timestamp NULL DEFAULT NULL,
  `last_message_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `blogger_id`, `seller_id`, `project_id`, `project_work_id`, `status`, `message`, `accepted_by_blogger_at`, `accepted_by_seller_at`, `confirmed_by_blogger_at`, `confirmed_by_seller_at`, `last_message_at`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 10, 8, 16, 'pending', 'Добрый день!\r\nМы обращаемся к Вам с предложением о сотрудничестве с нашим каналом на YouTube *Семья ФиА*. Мы бы хотели участвовать в рекламе Вашего товара по бартеру.\r\nС, уважением, Семья ФиА.', NULL, '2024-08-19 06:00:00', NULL, NULL, '2024-08-26 06:31:00', 20, '2024-08-12 14:42:11', '2024-08-26 06:31:12', NULL),
(2, 26, 9, 23, 46, 'progress', 'Добрый день!\r\nГотова разместить интеграцию у себя на канале.\r\nБуду рада сотрудничеству.', '2024-08-19 12:58:22', '2024-08-19 10:49:00', NULL, NULL, '2024-08-19 13:28:00', 26, '2024-08-14 11:10:46', '2024-08-19 13:28:30', NULL),
(4, 29, 10, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-08-15 08:18:56', '2024-08-15 08:18:56', NULL),
(5, 30, 10, 8, 16, 'progress', NULL, '2024-08-15 17:56:00', '2024-08-19 05:55:00', NULL, NULL, '2024-08-19 05:55:00', 10, '2024-08-15 08:19:31', '2024-08-19 05:55:49', NULL),
(6, 26, 10, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-08-15 08:19:46', '2024-08-15 08:19:46', NULL),
(7, 32, 9, 1, 1, 'progress', 'Дачная тематика в блоге присутствует, готовы сделать обзор в рилс и сторис.', '2024-08-19 09:49:00', '2024-08-19 09:57:00', NULL, NULL, '2024-08-21 10:56:00', 32, '2024-08-16 12:25:20', '2024-08-21 10:56:54', NULL),
(8, 32, 9, 2, 3, NULL, 'Дачная тематика в блоге присутствует, готовы сделать обзор в рилс и сторис.', NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:20', '2024-08-16 12:25:20', NULL),
(9, 32, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:26', '2024-08-24 21:01:29', '2024-08-24 21:01:29'),
(10, 32, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:26', '2024-08-16 12:25:26', NULL),
(11, 32, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:26', '2024-08-19 12:33:38', '2024-08-19 12:33:38'),
(12, 32, 9, 1, 1, NULL, 'Для обустройства гардеробной. Готовы снять рилс и сторис.', NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:59', '2024-08-24 21:01:33', '2024-08-24 21:01:33'),
(14, 32, 9, 2, 3, NULL, 'Для обустройства гардеробной. Готовы снять рилс и сторис.', NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:59', '2024-08-16 12:25:59', NULL),
(15, 32, 9, 18, 35, NULL, 'Для обустройства гардеробной. Готовы снять рилс и сторис.', NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:25:59', '2024-08-16 12:25:59', NULL),
(16, 32, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:26:32', '2024-08-24 21:01:52', '2024-08-24 21:01:52'),
(17, 32, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:26:41', '2024-08-16 12:26:41', NULL),
(18, 32, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 12:26:41', '2024-08-16 12:26:41', NULL),
(19, 32, 9, 26, 51, 'progress', NULL, '2024-08-19 10:35:00', '2024-08-19 10:33:00', NULL, NULL, '2024-08-21 09:17:00', 32, '2024-08-16 12:27:45', '2024-08-21 09:17:49', NULL),
(21, 32, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-16 14:00:21', '2024-08-16 14:00:21', NULL),
(22, 45, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, '2024-08-16 17:29:59', '2024-08-19 10:12:49', '2024-08-19 10:12:49'),
(23, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:35:03', '2024-08-19 10:02:28', '2024-08-19 10:02:28'),
(24, 49, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:35:23', '2024-08-19 10:13:10', '2024-08-19 10:13:10'),
(25, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:35:23', '2024-08-19 10:03:00', '2024-08-19 10:03:00'),
(26, 49, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:35:34', '2024-08-19 10:13:21', '2024-08-19 10:13:21'),
(27, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:35:34', '2024-08-19 10:03:23', '2024-08-19 10:03:23'),
(28, 49, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:35:34', '2024-08-19 12:38:02', '2024-08-19 12:38:02'),
(29, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:08', '2024-08-19 10:04:43', '2024-08-19 10:04:43'),
(30, 49, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:08', '2024-08-19 12:38:14', '2024-08-19 12:38:14'),
(31, 49, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:08', '2024-08-17 07:36:08', NULL),
(32, 49, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:08', '2024-08-17 07:36:08', NULL),
(33, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:52', '2024-08-17 07:36:52', NULL),
(34, 49, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:52', '2024-08-17 07:36:52', NULL),
(35, 49, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:52', '2024-08-19 12:38:45', '2024-08-19 12:38:45'),
(36, 49, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:52', '2024-08-17 07:36:52', NULL),
(37, 49, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:36:52', '2024-08-17 07:36:52', NULL),
(38, 49, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:06', '2024-08-19 12:39:16', '2024-08-19 12:39:16'),
(39, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(40, 49, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(41, 49, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(42, 49, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(43, 49, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:06', '2024-08-17 07:37:06', NULL),
(44, 49, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(45, 49, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-19 12:39:05', '2024-08-19 12:39:05'),
(46, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(47, 49, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(48, 49, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(49, 49, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(50, 49, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-17 07:37:54', '2024-08-17 07:37:54', NULL),
(51, 48, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, '2024-08-17 07:42:27', '2024-08-17 07:42:27', NULL),
(52, 48, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, '2024-08-17 07:43:15', '2024-08-17 07:43:15', NULL),
(53, 48, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, '2024-08-17 07:43:15', '2024-08-17 07:43:15', NULL),
(54, 46, 9, 3, 5, 'progress', NULL, '2024-08-22 12:46:00', '2024-08-21 13:47:00', NULL, NULL, '2024-08-22 12:46:00', 46, '2024-08-17 21:17:38', '2024-08-22 12:46:02', NULL),
(55, 46, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:18:56', '2024-08-17 21:18:56', NULL),
(56, 46, 10, 5, 9, 'progress', NULL, '2024-08-19 09:36:00', '2024-08-22 06:03:00', NULL, NULL, '2024-08-23 06:23:00', 46, '2024-08-17 21:18:56', '2024-08-23 06:23:09', NULL),
(57, 46, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:19:40', '2024-08-17 21:19:40', NULL),
(58, 46, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:19:40', '2024-08-17 21:19:40', NULL),
(59, 46, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:19:40', '2024-08-19 12:33:50', '2024-08-19 12:33:50'),
(60, 46, 9, 19, 37, 'progress', NULL, '2024-08-21 12:32:00', '2024-08-21 12:30:00', NULL, NULL, '2024-08-24 15:00:00', 46, '2024-08-17 21:20:40', '2024-08-24 15:00:44', NULL),
(61, 46, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:20:50', '2024-08-17 21:20:50', NULL),
(62, 46, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:20:50', '2024-08-17 21:20:50', NULL),
(63, 46, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:21:26', '2024-08-17 21:21:26', NULL),
(64, 46, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:21:26', '2024-08-17 21:21:26', NULL),
(65, 46, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-17 21:21:27', '2024-08-17 21:21:27', NULL),
(66, 46, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-18 09:22:00', '2024-08-18 09:22:00', NULL),
(67, 56, 9, 15, 29, 'progress', NULL, '2024-08-19 10:32:00', '2024-08-19 10:32:00', NULL, NULL, '2024-08-21 09:11:00', 56, '2024-08-18 11:04:33', '2024-08-21 09:11:00', NULL),
(68, 56, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:04:42', '2024-08-18 11:04:42', NULL),
(69, 56, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:04:42', '2024-08-18 11:04:42', NULL),
(70, 56, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:04', '2024-08-18 11:05:04', NULL),
(71, 56, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:04', '2024-08-18 11:05:04', NULL),
(72, 56, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:04', '2024-08-18 11:05:04', NULL),
(73, 56, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:26', '2024-08-18 11:05:26', NULL),
(74, 56, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:26', '2024-08-18 11:05:26', NULL),
(75, 56, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:26', '2024-08-18 11:05:26', NULL),
(76, 56, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:26', '2024-08-18 11:05:26', NULL),
(77, 56, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:43', '2024-08-18 11:05:43', NULL),
(78, 56, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:43', '2024-08-18 11:05:43', NULL),
(79, 56, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:43', '2024-08-18 11:05:43', NULL),
(80, 56, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:43', '2024-08-18 11:05:43', NULL),
(81, 56, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:43', '2024-08-18 11:05:43', NULL),
(82, 56, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:59', '2024-08-18 11:05:59', NULL),
(83, 56, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:59', '2024-08-18 11:05:59', NULL),
(84, 56, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:59', '2024-08-18 11:05:59', NULL),
(85, 56, 9, 26, 51, 'progress', NULL, '2024-08-19 16:17:00', '2024-08-19 10:47:00', NULL, NULL, '2024-08-21 09:21:00', 56, '2024-08-18 11:05:59', '2024-08-21 09:21:27', NULL),
(86, 56, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:59', '2024-08-18 11:05:59', NULL),
(87, 56, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-08-18 11:05:59', '2024-08-18 11:05:59', NULL),
(88, 20, 10, 7, 14, NULL, 'Добрый день! Мы хотим сделать обзор Вашего товара.', NULL, NULL, NULL, NULL, NULL, 20, '2024-08-18 15:20:22', '2024-08-18 15:20:22', NULL),
(89, 57, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, '2024-08-18 16:11:53', '2024-08-18 16:11:53', NULL),
(91, 57, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, '2024-08-18 16:12:07', '2024-08-18 16:12:07', NULL),
(92, 57, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, '2024-08-18 16:12:39', '2024-08-18 16:12:39', NULL),
(93, 57, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, '2024-08-18 16:12:39', '2024-08-18 16:12:39', NULL),
(94, 57, 9, 18, 35, 'progress', NULL, '2024-08-21 10:09:00', '2024-08-21 09:04:00', NULL, NULL, '2024-08-21 10:22:00', 57, '2024-08-18 16:12:39', '2024-08-21 10:22:51', NULL),
(95, 57, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, '2024-08-18 17:41:46', '2024-08-18 17:41:46', NULL),
(96, 49, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:22:52', '2024-08-19 07:22:52', NULL),
(97, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:07', '2024-08-19 07:23:07', NULL),
(98, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:07', '2024-08-19 07:23:07', NULL),
(99, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:20', '2024-08-19 07:23:20', NULL),
(100, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:20', '2024-08-19 07:23:20', NULL),
(101, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:20', '2024-08-19 12:41:02', '2024-08-19 12:41:02'),
(102, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:46', '2024-08-19 12:41:22', '2024-08-19 12:41:22'),
(103, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:46', '2024-08-19 07:23:46', NULL),
(104, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:46', '2024-08-19 07:23:46', NULL),
(105, 49, 9, 18, 35, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:46', '2024-08-19 07:23:46', NULL),
(106, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:54', '2024-08-19 07:23:54', NULL),
(107, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:54', '2024-08-19 07:23:54', NULL),
(108, 49, 9, 20, 39, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:54', '2024-08-19 07:23:54', NULL),
(109, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:54', '2024-08-19 07:23:54', NULL),
(110, 49, 9, 18, 35, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:23:54', '2024-08-19 07:23:54', NULL),
(111, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(112, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(113, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(114, 49, 9, 18, 35, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(115, 49, 9, 20, 39, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(116, 49, 9, 26, 51, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:08', '2024-08-19 07:24:08', NULL),
(117, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(118, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(119, 49, 9, 18, 35, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(120, 49, 9, 20, 39, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(121, 49, 9, 26, 51, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(122, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(123, 49, 31, 28, 55, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:13', '2024-08-19 07:24:13', NULL),
(124, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(125, 49, 9, 2, 3, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(126, 49, 9, 20, 39, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(127, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(128, 49, 9, 18, 35, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(129, 49, 31, 28, 55, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(130, 49, 9, 26, 51, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(131, 49, 9, 23, 45, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:24:35', '2024-08-19 07:24:35', NULL),
(132, 49, 9, 3, 5, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(134, 49, 9, 18, 35, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(135, 49, 10, 8, 15, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(136, 49, 9, 20, 39, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(137, 49, 9, 26, 51, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(138, 49, 31, 28, 55, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(139, 49, 9, 12, 23, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 10:13:40', '2024-08-19 10:13:40'),
(140, 49, 9, 23, 45, NULL, 'могу сделать рекламу не только в инсте. но и обширный лонгрид на отзовиках (Айрекоменд, Отзовик)', NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 07:25:31', '2024-08-19 07:25:31', NULL),
(141, 46, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-19 09:36:01', '2024-08-19 09:36:01', NULL),
(142, 46, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-19 09:36:11', '2024-08-19 09:36:11', NULL),
(143, 46, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-19 09:36:11', '2024-08-19 09:36:11', NULL),
(144, 32, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2024-08-19 10:39:59', '2024-08-19 10:39:59', NULL),
(181, 49, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, '2024-08-19 12:14:34', '2024-08-19 12:14:34', NULL),
(182, 46, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-19 12:25:00', '2024-08-19 12:25:00', NULL),
(183, 44, 31, 28, 55, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 44, '2024-08-19 18:17:36', '2024-08-19 18:17:36', NULL),
(184, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:00', '2024-08-22 06:51:22', '2024-08-22 06:51:22'),
(185, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:13', '2024-08-19 18:27:13', NULL),
(186, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:14', '2024-08-19 18:27:14', NULL),
(187, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:27', '2024-08-19 18:27:27', NULL),
(188, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:27', '2024-08-19 18:27:27', NULL),
(189, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:27', '2024-08-19 18:27:27', NULL),
(190, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:33', '2024-08-19 18:27:33', NULL),
(191, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:33', '2024-08-19 18:27:33', NULL),
(192, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:33', '2024-08-19 18:27:33', NULL),
(193, 52, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:33', '2024-08-19 18:27:33', NULL),
(194, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:40', '2024-08-19 18:27:40', NULL),
(195, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:40', '2024-08-19 18:27:40', NULL),
(196, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:40', '2024-08-19 18:27:40', NULL),
(197, 52, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:40', '2024-08-19 18:27:40', NULL),
(198, 52, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:40', '2024-08-19 18:27:40', NULL),
(199, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:45', '2024-08-19 18:27:45', NULL),
(200, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:45', '2024-08-19 18:27:45', NULL),
(201, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:45', '2024-08-19 18:27:45', NULL),
(202, 52, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:45', '2024-08-19 18:27:45', NULL),
(203, 52, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:45', '2024-08-19 18:27:45', NULL),
(204, 52, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:45', '2024-08-19 18:27:45', NULL),
(205, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(206, 52, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(207, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(208, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(209, 52, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(210, 52, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(211, 52, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:27:50', '2024-08-19 18:27:50', NULL),
(212, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(213, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(214, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(215, 52, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(216, 52, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(217, 52, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(218, 52, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(219, 52, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:00', '2024-08-19 18:28:00', NULL),
(220, 52, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(221, 52, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(222, 52, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(223, 52, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(224, 52, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(225, 52, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(226, 52, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(227, 52, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(228, 52, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-08-19 18:28:14', '2024-08-19 18:28:14', NULL),
(229, 69, 9, 18, 36, NULL, 'Мне как раз 14 лет и я могла бы прорекламировать его для подростковой аудитории!', NULL, NULL, NULL, NULL, NULL, 69, '2024-08-19 18:45:43', '2024-08-19 18:45:43', NULL),
(230, 72, 9, 18, 35, NULL, 'Могу прорекламировать в тик токе (6,5 тыс подписчиков)', NULL, NULL, NULL, NULL, NULL, 72, '2024-08-19 22:21:59', '2024-08-19 22:21:59', NULL),
(231, 72, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, '2024-08-19 22:22:54', '2024-08-19 22:22:54', NULL),
(232, 72, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, '2024-08-19 22:22:54', '2024-08-19 22:22:54', NULL),
(233, 69, 31, 28, 55, NULL, 'Штаны хорошо подойдут на первое сентября, можно прорекламировать их именно с этой стороны.', NULL, NULL, NULL, NULL, NULL, 69, '2024-08-20 01:08:00', '2024-08-20 01:08:00', NULL),
(234, 18, 10, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-08-20 07:48:53', '2024-08-20 07:48:53', NULL),
(235, 26, 10, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-08-20 07:49:49', '2024-08-20 07:49:49', NULL),
(236, 43, 10, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-08-20 07:50:04', '2024-08-20 07:50:04', NULL),
(237, 30, 10, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-08-20 07:50:25', '2024-08-20 07:50:25', NULL),
(238, 73, 31, 28, 55, NULL, 'Здравствуйте, я Юлия. Предлагаю сотрудничество на бартерной основе ✨ \r\n\r\nhttps://www.instagram.com/yu_tischenko?igsh=OWVyeDB1anYwYWs%3D&utm_source=qr\r\n\r\nhttps://www.tiktok.com/@tischenko_yulia?_t=8mfTggInS59&_r=1\r\n\r\nhttps://youtube.com/@yu_tischenko?si=fbR4Y5k3jmme0Sz1', NULL, NULL, NULL, NULL, NULL, 73, '2024-08-20 11:59:51', '2024-08-20 11:59:51', NULL),
(239, 73, 31, 28, 55, NULL, 'Здравствуйте, я Юлия. Предлагаю сотрудничество на бартерной основе ✨ \r\n\r\nhttps://www.instagram.com/yu_tischenko?igsh=OWVyeDB1anYwYWs%3D&utm_source=qr\r\n\r\nhttps://www.tiktok.com/@tischenko_yulia?_t=8mfTggInS59&_r=1\r\n\r\nhttps://youtube.com/@yu_tischenko?si=fbR4Y5k3jmme0Sz1', NULL, NULL, NULL, NULL, NULL, 73, '2024-08-20 12:00:20', '2024-08-20 12:00:20', NULL),
(240, 73, 9, 23, 46, NULL, 'Здравствуйте, я Юлия. Предлагаю сотрудничество на бартерной основе ✨ \r\n\r\nhttps://www.instagram.com/yu_tischenko?igsh=OWVyeDB1anYwYWs%3D&utm_source=qr\r\n\r\nhttps://www.tiktok.com/@tischenko_yulia?_t=8mfTggInS59&_r=1\r\n\r\nhttps://youtube.com/@yu_tischenko?si=fbR4Y5k3jmme0Sz1', NULL, NULL, NULL, NULL, NULL, 73, '2024-08-20 12:00:20', '2024-08-20 12:00:20', NULL),
(241, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:09', '2024-08-20 12:02:09', NULL),
(242, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:26', '2024-08-20 12:02:26', NULL),
(243, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:26', '2024-08-20 12:02:26', NULL),
(244, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:35', '2024-08-20 12:02:35', NULL),
(245, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:35', '2024-08-20 12:02:35', NULL),
(246, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:35', '2024-08-20 12:02:35', NULL),
(247, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:43', '2024-08-20 12:02:43', NULL),
(248, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:43', '2024-08-20 12:02:43', NULL),
(249, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:43', '2024-08-20 12:02:43', NULL),
(250, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:43', '2024-08-20 12:02:43', NULL),
(251, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(252, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(253, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(254, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(255, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:53', '2024-08-20 12:02:53', NULL),
(256, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(257, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(258, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(259, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(260, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(261, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:02:58', '2024-08-20 12:02:58', NULL),
(262, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(263, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(264, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(265, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(266, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(267, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(268, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:12', '2024-08-20 12:03:12', NULL),
(269, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:22', '2024-08-20 12:03:22', NULL),
(270, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:22', '2024-08-20 12:03:22', NULL),
(271, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:22', '2024-08-20 12:03:22', NULL),
(272, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:23', '2024-08-20 12:03:23', NULL),
(273, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:23', '2024-08-20 12:03:23', NULL),
(274, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:23', '2024-08-20 12:03:23', NULL),
(275, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:23', '2024-08-20 12:03:23', NULL),
(276, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:23', '2024-08-20 12:03:23', NULL),
(277, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(278, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(279, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(280, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(281, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(282, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(283, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(284, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(285, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:30', '2024-08-20 12:03:30', NULL),
(286, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(287, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(288, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(289, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(290, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(291, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(292, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(293, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(294, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(295, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:53', '2024-08-20 12:03:53', NULL),
(296, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:58', '2024-08-20 12:03:58', NULL),
(297, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:58', '2024-08-20 12:03:58', NULL),
(298, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(299, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(300, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(301, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(302, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(303, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(304, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(305, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(306, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:03:59', '2024-08-20 12:03:59', NULL),
(307, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(308, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(309, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(310, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(311, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(312, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(313, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(314, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(315, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(316, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(317, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(318, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:06', '2024-08-20 12:04:06', NULL),
(319, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(320, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(321, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(322, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(323, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(324, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(325, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(326, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(327, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(328, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(329, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(330, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(331, 78, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:10', '2024-08-20 12:04:10', NULL),
(332, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:18', '2024-08-20 12:04:18', NULL),
(333, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:18', '2024-08-20 12:04:18', NULL),
(334, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(335, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(336, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(337, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(338, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(339, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(340, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(341, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(342, 78, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(343, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(344, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(345, 78, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:19', '2024-08-20 12:04:19', NULL),
(346, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(347, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(348, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(349, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(350, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(351, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(352, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(353, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(354, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(355, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(356, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(357, 78, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(358, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(359, 78, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-20 12:04:25', NULL),
(360, 78, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:04:25', '2024-08-21 04:41:13', '2024-08-21 04:41:13'),
(361, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(362, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(363, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(364, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(365, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(366, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:00', '2024-08-20 12:05:00', NULL),
(367, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(368, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(369, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(370, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(371, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(372, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(373, 78, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(374, 78, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(375, 78, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(376, 78, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:01', '2024-08-20 12:05:01', NULL),
(377, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(378, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(379, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(380, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(381, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(382, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(383, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(384, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(385, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(386, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(387, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(388, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(389, 78, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(390, 78, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(391, 78, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-21 04:41:28', '2024-08-21 04:41:28'),
(392, 78, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-20 12:05:10', NULL),
(393, 78, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:10', '2024-08-21 04:42:52', '2024-08-21 04:42:52'),
(394, 78, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(395, 78, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(396, 78, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(397, 78, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(398, 78, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(399, 78, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(400, 78, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(401, 78, 9, 26, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(402, 78, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(403, 78, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(404, 78, 9, 24, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(405, 78, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(406, 78, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(407, 78, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL);
INSERT INTO `works` (`id`, `blogger_id`, `seller_id`, `project_id`, `project_work_id`, `status`, `message`, `accepted_by_blogger_at`, `accepted_by_seller_at`, `confirmed_by_blogger_at`, `confirmed_by_seller_at`, `last_message_at`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(408, 78, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(409, 78, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(410, 78, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(411, 78, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, '2024-08-20 12:05:15', '2024-08-20 12:05:15', NULL),
(412, 75, 9, 1, 1, NULL, 'Буду Рада сотрудничать', NULL, NULL, NULL, NULL, NULL, 75, '2024-08-20 12:34:10', '2024-08-20 12:34:10', NULL),
(413, 76, 9, 26, 51, NULL, 'Возьму на бартер рилс+сторис', NULL, NULL, NULL, NULL, NULL, 76, '2024-08-20 12:36:40', '2024-08-20 12:36:40', NULL),
(414, 76, 9, 26, 51, NULL, 'Возьму на бартер рилс+сторис)', NULL, NULL, NULL, NULL, NULL, 76, '2024-08-20 12:37:22', '2024-08-20 12:37:22', NULL),
(415, 76, 31, 28, 55, NULL, 'Возьму на бартер рилс+сторис)', NULL, NULL, NULL, NULL, NULL, 76, '2024-08-20 12:37:23', '2024-08-20 12:37:23', NULL),
(416, 46, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-08-20 22:28:29', '2024-08-20 22:28:29', NULL),
(417, 81, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 04:59:10', '2024-08-21 04:59:10', NULL),
(418, 81, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 04:59:30', '2024-08-21 04:59:30', NULL),
(419, 81, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 04:59:30', '2024-08-21 04:59:30', NULL),
(420, 81, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 04:59:54', '2024-08-21 04:59:54', NULL),
(421, 81, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 04:59:54', '2024-08-21 04:59:54', NULL),
(422, 81, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 04:59:54', '2024-08-21 04:59:54', NULL),
(423, 81, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:06', '2024-08-21 05:00:06', NULL),
(424, 81, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:06', '2024-08-21 05:00:06', NULL),
(425, 81, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:06', '2024-08-21 05:00:06', NULL),
(426, 81, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:06', '2024-08-21 05:00:06', NULL),
(427, 81, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:27', '2024-08-21 05:00:27', NULL),
(428, 81, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:27', '2024-08-21 05:00:27', NULL),
(429, 81, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:27', '2024-08-21 05:00:27', NULL),
(430, 81, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:27', '2024-08-21 05:00:27', NULL),
(431, 81, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:00:27', '2024-08-21 05:00:27', NULL),
(432, 81, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:01:00', '2024-08-21 05:01:00', NULL),
(433, 81, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:01:00', '2024-08-21 05:01:00', NULL),
(434, 81, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:01:00', '2024-08-21 05:01:00', NULL),
(435, 81, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:01:00', '2024-08-21 05:01:00', NULL),
(436, 81, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:01:00', '2024-08-21 05:01:00', NULL),
(437, 81, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:01:00', '2024-08-21 05:01:00', NULL),
(438, 81, 31, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2024-08-21 05:03:06', '2024-08-21 05:03:06', NULL),
(439, 18, 9, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2024-08-21 13:51:12', '2024-08-21 13:51:12', NULL),
(440, 23, 9, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2024-08-21 13:51:20', '2024-08-21 13:51:20', NULL),
(442, 94, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 94, '2024-08-21 15:51:50', '2024-08-21 15:51:50', NULL),
(443, 18, 9, 22, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2024-08-21 16:02:38', '2024-08-21 16:02:38', NULL),
(444, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:45:57', '2024-08-21 16:45:57', NULL),
(445, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:45:57', '2024-08-21 16:45:57', NULL),
(446, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:08', '2024-08-21 16:46:08', NULL),
(447, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:08', '2024-08-21 16:46:08', NULL),
(448, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:08', '2024-08-21 16:46:08', NULL),
(449, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:33', '2024-08-21 16:46:33', NULL),
(450, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:33', '2024-08-21 16:46:33', NULL),
(451, 96, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:33', '2024-08-21 16:46:33', NULL),
(452, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:33', '2024-08-21 16:46:33', NULL),
(453, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:42', '2024-08-21 16:46:42', NULL),
(454, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:42', '2024-08-21 16:46:42', NULL),
(455, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:42', '2024-08-21 16:46:42', NULL),
(456, 96, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:42', '2024-08-21 16:46:42', NULL),
(457, 96, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:42', '2024-08-21 16:46:42', NULL),
(458, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:59', '2024-08-21 16:46:59', NULL),
(459, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:59', '2024-08-21 16:46:59', NULL),
(460, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:59', '2024-08-21 16:46:59', NULL),
(461, 96, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:46:59', '2024-08-21 16:46:59', NULL),
(462, 96, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:00', '2024-08-21 16:47:00', NULL),
(463, 96, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:00', '2024-08-21 16:47:00', NULL),
(464, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(465, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(466, 96, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(467, 96, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(468, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(469, 96, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(470, 96, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:09', '2024-08-21 16:47:09', NULL),
(471, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(472, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(473, 96, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(474, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(475, 96, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(476, 96, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(477, 96, 9, 23, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(478, 96, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:22', '2024-08-21 16:47:22', NULL),
(479, 96, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(480, 96, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(481, 96, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(482, 96, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(483, 96, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(484, 96, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(485, 96, 9, 23, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:47:59', '2024-08-21 16:47:59', NULL),
(486, 96, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:48:00', '2024-08-21 16:48:00', NULL),
(487, 96, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-21 16:48:00', '2024-08-21 16:48:00', NULL),
(488, 93, 9, 19, 37, NULL, 'Буду рада сотрудничеству 🌸☺️', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:21:53', '2024-08-21 18:21:53', NULL),
(489, 93, 9, 19, 37, NULL, 'Буду рада сотрудничеству)', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:22:20', '2024-08-21 18:22:20', NULL),
(490, 93, 9, 20, 39, NULL, 'Буду рада сотрудничеству)', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:22:20', '2024-08-21 18:22:20', NULL),
(491, 93, 9, 20, 39, NULL, 'Буду рада сотрудничеству)', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:33:42', '2024-08-21 18:33:42', NULL),
(492, 93, 9, 2, 3, NULL, 'Буду рада сотрудничеству)', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:33:42', '2024-08-21 18:33:42', NULL),
(493, 93, 9, 19, 37, NULL, 'Буду рада сотрудничеству)', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:33:42', '2024-08-21 18:33:42', NULL),
(494, 93, 9, 19, 37, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:34:39', '2024-08-21 18:34:39', NULL),
(495, 93, 9, 20, 39, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:34:39', '2024-08-21 18:34:39', NULL),
(496, 93, 9, 2, 3, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:34:39', '2024-08-21 18:34:39', NULL),
(497, 93, 10, 5, 9, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:34:39', '2024-08-21 18:34:39', NULL),
(498, 93, 9, 19, 37, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(499, 93, 9, 20, 39, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(500, 93, 9, 2, 3, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(501, 93, 10, 5, 9, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(502, 93, 10, 7, 13, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:02', '2024-08-21 18:35:02', NULL),
(503, 93, 9, 19, 37, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(504, 93, 9, 20, 39, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(505, 93, 10, 5, 9, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(506, 93, 10, 7, 13, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(507, 93, 9, 2, 3, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(508, 93, 10, 8, 15, NULL, 'Буду рада сотрудничеству', NULL, NULL, NULL, NULL, NULL, 93, '2024-08-21 18:35:37', '2024-08-21 18:35:37', NULL),
(509, 99, 10, 8, 16, NULL, 'Купили дом на юге, работы валом, в том числе надо пилить деревья, будет интересный контент', NULL, NULL, NULL, NULL, NULL, 99, '2024-08-21 19:36:47', '2024-08-21 19:36:47', NULL),
(510, 99, 10, 7, 14, 'pending', 'Купили дом на юге, работы валом, 11 соток, заросло травой, будет интересно😁', '2024-08-23 06:35:00', NULL, NULL, NULL, '2024-08-26 05:35:00', 99, '2024-08-21 19:42:25', '2024-08-26 05:35:09', NULL),
(511, 95, 10, 5, 9, NULL, 'СОТРУДНИЧЕСТВО\r\n\r\nДобрый день ☀️\r\nМеня зовут Оксана, я менеджер Ксении\r\n\r\n1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)\r\n\r\nХотели бы предложить размещения в блоге Ксении.\r\n\r\nПодскажите для вас актуально размещение рекламы? 🌹\r\n\r\n\r\n➖ Статистику вышлем по запросу, так же после рекламы видео статистику высылаем.', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:06:40', '2024-08-22 05:06:40', NULL),
(512, 95, 10, 5, 9, NULL, 'СОТРУДНИЧЕСТВО\r\n\r\nДобрый день ☀️\r\nМеня зовут Оксана, я менеджер Ксении\r\n\r\n1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)\r\n\r\nХотели бы предложить размещения в блоге Ксении.\r\n\r\nПодскажите для вас актуально размещение рекламы? 🌹\r\n\r\n\r\n➖ Статистику вышлем по запросу, так же после рекламы видео статистику высылаем.', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:06:40', '2024-08-22 05:06:40', NULL),
(513, 95, 10, 5, 9, NULL, 'СОТРУДНИЧЕСТВО\r\n\r\nДобрый день ☀️\r\nМеня зовут Оксана, я менеджер Ксении\r\n\r\n1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)\r\n\r\nХотели бы предложить размещения в блоге Ксении.\r\n\r\nПодскажите для вас актуально размещение рекламы? 🌹\r\n\r\n\r\n➖ Статистику вышлем по запросу, так же после рекламы видео статистику высылаем.', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:06:40', '2024-08-22 05:06:40', NULL),
(514, 95, 10, 5, 9, NULL, 'СОТРУДНИЧЕСТВО\r\n\r\nДобрый день ☀️\r\nМеня зовут Оксана, я менеджер Ксении\r\n\r\n1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)\r\n\r\nХотели бы предложить размещения в блоге Ксении.\r\n\r\nПодскажите для вас актуально размещение рекламы? 🌹\r\n\r\n\r\n➖ Статистику вышлем по запросу, так же после рекламы видео статистику высылаем.', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:06:41', '2024-08-22 05:06:41', NULL),
(515, 95, 10, 5, 9, NULL, 'СОТРУДНИЧЕСТВО\r\n\r\nДобрый день ☀️\r\nМеня зовут Оксана, я менеджер Ксении\r\n\r\n1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)\r\n\r\nХотели бы предложить размещения в блоге Ксении.\r\n\r\nПодскажите для вас актуально размещение рекламы? 🌹\r\n\r\n\r\n➖ Статистику вышлем по запросу, так же после рекламы видео статистику высылаем.', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:06:49', '2024-08-22 05:06:49', NULL),
(516, 95, 10, 5, 9, NULL, 'СОТРУДНИЧЕСТВО\r\n\r\nДобрый день ☀️\r\nМеня зовут Оксана, я менеджер Ксении\r\n\r\n1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)\r\n\r\nХотели бы предложить размещения в блоге Ксении.\r\n\r\nПодскажите для вас актуально размещение рекламы? 🌹\r\n\r\n\r\n➖ Статистику вышлем по запросу, так же после рекламы видео статистику высылаем.', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:06:50', '2024-08-22 05:06:50', NULL),
(517, 95, 10, 5, 9, NULL, '1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:07', '2024-08-22 05:07:07', NULL),
(518, 95, 10, 5, 9, NULL, '1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:07', '2024-08-22 05:07:07', NULL),
(519, 95, 10, 5, 9, NULL, '1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:08', '2024-08-22 05:07:08', NULL),
(520, 95, 10, 5, 9, NULL, '1️⃣ https://instagram.com/k_s_ksenya?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 53 тыс \r\n\r\n2️⃣ https://instagram.com/ksenya_skilim?igshid=MzRlODBiNWFlZA==\r\n🎀гарант охватов 15 тыс\r\n\r\n3️⃣ Тг канал https://t.me/k_s_ksenyaa ( маркировку делаем)', NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:09', '2024-08-22 05:07:09', NULL),
(521, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:14', '2024-08-22 05:07:14', NULL),
(522, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:14', '2024-08-22 05:07:14', NULL),
(523, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:15', '2024-08-22 05:07:15', NULL),
(524, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:15', '2024-08-22 05:07:15', NULL),
(525, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:16', '2024-08-22 05:07:16', NULL),
(526, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:16', '2024-08-22 05:07:16', NULL),
(527, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:17', '2024-08-22 05:07:17', NULL),
(528, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:17', '2024-08-22 05:07:17', NULL),
(529, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:18', '2024-08-22 05:07:18', NULL),
(530, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:19', '2024-08-22 05:07:19', NULL),
(531, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:19', '2024-08-22 05:07:19', NULL),
(532, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:19', '2024-08-22 05:07:19', NULL),
(533, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:54', '2024-08-22 05:07:54', NULL),
(534, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:54', '2024-08-22 05:07:54', NULL),
(535, 95, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:07:54', '2024-08-22 05:07:54', NULL),
(536, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(537, 95, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(538, 95, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(539, 95, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2024-08-22 05:08:00', '2024-08-22 05:08:00', NULL),
(540, 99, 9, 18, 36, 'progress', 'Будет интересно', '2024-08-26 14:45:00', '2024-08-23 12:37:00', NULL, NULL, '2024-08-26 14:45:00', 99, '2024-08-22 05:17:42', '2024-08-26 14:45:13', NULL),
(541, 94, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 94, '2024-08-22 07:39:09', '2024-08-22 07:39:09', NULL),
(542, 97, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, '2024-08-22 07:50:58', '2024-08-22 07:50:58', NULL),
(543, 97, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, '2024-08-22 07:50:58', '2024-08-22 07:50:58', NULL),
(544, 97, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, '2024-08-22 07:52:15', '2024-08-22 07:52:15', NULL),
(545, 97, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, '2024-08-22 07:52:15', '2024-08-22 07:52:15', NULL),
(546, 97, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, '2024-08-22 07:52:15', '2024-08-22 07:52:15', NULL),
(547, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:06:57', '2024-08-22 09:06:57', NULL),
(548, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:03', '2024-08-22 09:07:03', NULL),
(549, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:03', '2024-08-22 09:07:03', NULL),
(550, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:06', '2024-08-22 09:07:06', NULL),
(551, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:06', '2024-08-22 09:07:06', NULL),
(552, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:06', '2024-08-22 09:07:06', NULL),
(553, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(554, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(555, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(556, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:10', '2024-08-22 09:07:10', NULL),
(557, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(558, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(559, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(560, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(561, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:13', '2024-08-22 09:07:13', NULL),
(562, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(563, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(564, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(565, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(566, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(567, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:18', '2024-08-22 09:07:18', NULL),
(568, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(569, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(570, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(571, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(572, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(573, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(574, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:21', '2024-08-22 09:07:21', NULL),
(575, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(576, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(577, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(578, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(579, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(580, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(581, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(582, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:26', '2024-08-22 09:07:26', NULL),
(583, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(584, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(585, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(586, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(587, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(588, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(589, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(590, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(591, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:32', '2024-08-22 09:07:32', NULL),
(592, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(593, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(594, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(595, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(596, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(597, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(598, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(599, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(600, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(601, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:36', '2024-08-22 09:07:36', NULL),
(602, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(603, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(604, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(605, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(606, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:40', '2024-08-22 09:07:40', NULL),
(607, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(608, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(609, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(610, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(611, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(612, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:41', '2024-08-22 09:07:41', NULL),
(613, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(614, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(615, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(616, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(617, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(618, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(619, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(620, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(621, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(622, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(623, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(624, 112, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:44', '2024-08-22 09:07:44', NULL),
(625, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(626, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(627, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(628, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(629, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(630, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(631, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(632, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(633, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(634, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(635, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(636, 112, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(637, 112, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:47', '2024-08-22 09:07:47', NULL),
(638, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(639, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(640, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(641, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(642, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(643, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:50', '2024-08-22 09:07:50', NULL),
(644, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(645, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(646, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(647, 112, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(648, 112, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(649, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(650, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(651, 112, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:51', '2024-08-22 09:07:51', NULL),
(652, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(653, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(654, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(655, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(656, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(657, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(658, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(659, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(660, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(661, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(662, 112, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(663, 112, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(664, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(665, 112, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:53', '2024-08-22 09:07:53', NULL),
(666, 112, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:54', '2024-08-22 09:07:54', NULL),
(667, 112, 9, 1, 1, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:35:00', 112, '2024-08-22 09:07:57', '2024-08-26 11:35:54', NULL),
(668, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(669, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(670, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(671, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(672, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(673, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(674, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(675, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(676, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(677, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(678, 112, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(679, 112, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(680, 112, 9, 21, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(681, 112, 9, 23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(682, 112, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:07:57', '2024-08-22 09:07:57', NULL),
(683, 112, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(684, 112, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(685, 112, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(686, 112, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(687, 112, 9, 16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(688, 112, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(689, 112, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(690, 112, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(691, 112, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(692, 112, 9, 15, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(693, 112, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(694, 112, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(695, 112, 9, 20, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(696, 112, 9, 22, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(697, 112, 9, 21, 41, 'pending', NULL, '2024-08-24 08:45:00', NULL, NULL, NULL, '2024-08-24 08:45:00', 112, '2024-08-22 09:08:05', '2024-08-24 08:45:53', NULL),
(698, 112, 9, 23, 45, 'pending', NULL, '2024-08-24 08:45:00', NULL, NULL, NULL, '2024-08-26 11:17:00', 112, '2024-08-22 09:08:05', '2024-08-26 11:17:40', NULL),
(699, 112, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-22 09:08:05', '2024-08-22 09:08:05', NULL),
(700, 99, 10, 5, 10, NULL, 'https://youtube.com/channel/UC7M70CwTg2n_-U_2E3hfjVg?si=C8mmbYHg-50e3CmH', NULL, NULL, NULL, NULL, NULL, 99, '2024-08-22 10:52:06', '2024-08-22 10:52:06', NULL),
(701, 117, 9, 2, 3, NULL, 'Могу разместить сторис рилс в инстограмм канале. https://instagram.com/mnogodetnaya_mamochka_3?igshid=MzRlODBiNWFlZA==', NULL, NULL, NULL, NULL, NULL, 117, '2024-08-22 11:33:57', '2024-08-22 11:33:57', NULL),
(702, 117, 9, 2, 3, NULL, 'Размещу сторис рилс в инстограмм \r\n\r\nhttps://instagram.com/mnogodetnaya_mamochka_3?igshid=MzRlODBiNWFlZA==', NULL, NULL, NULL, NULL, NULL, 117, '2024-08-22 11:34:43', '2024-08-22 11:34:43', NULL),
(703, 117, 10, 5, 9, NULL, 'Размещу сторис рилс в инстограмм \r\n\r\nhttps://instagram.com/mnogodetnaya_mamochka_3?igshid=MzRlODBiNWFlZA==', NULL, NULL, NULL, NULL, NULL, 117, '2024-08-22 11:34:43', '2024-08-22 11:34:43', NULL),
(704, 117, 9, 19, 37, NULL, 'Размещу рекламу в сторис и рилс в инстограмм https://instagram.com/mnogodetnaya_mamochka_3?igshid=MzRlODBiNWFlZA==', NULL, NULL, NULL, NULL, NULL, 117, '2024-08-22 11:37:27', '2024-08-22 11:37:27', NULL),
(705, 118, 9, 2, 3, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:36:12', '2024-08-26 11:27:47', '2024-08-26 11:27:47'),
(706, 118, 9, 2, 3, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:36:34', '2024-08-22 13:36:34', NULL),
(707, 118, 10, 5, 9, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:36:34', '2024-08-22 13:36:34', NULL),
(708, 118, 10, 5, 9, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:03', '2024-08-22 13:37:03', NULL),
(709, 118, 9, 2, 3, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:03', '2024-08-26 15:12:55', '2024-08-26 15:12:55'),
(710, 118, 9, 12, 23, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:03', '2024-08-22 13:37:03', NULL),
(711, 118, 9, 2, 3, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(712, 118, 10, 5, 9, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(713, 118, 9, 12, 23, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(714, 118, 10, 8, 15, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:37:17', '2024-08-22 13:37:17', NULL),
(715, 118, 9, 2, 3, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(716, 118, 10, 5, 9, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(717, 118, 9, 12, 23, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(718, 118, 10, 8, 15, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(719, 118, 10, 27, 53, NULL, 'Данный товар могу освятить в сторис. Так как охваты в сторис 90-100к ; и стоимость серии сторис от 24.000₽ \r\n\r\nЛибо можно рассмотреть на пост несколько товаров. Пост от 50.000₽', NULL, NULL, NULL, NULL, NULL, 118, '2024-08-22 13:38:06', '2024-08-22 13:38:06', NULL),
(720, 120, 9, 22, 43, NULL, 'Для рилс с ребенком', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:55:26', '2024-08-22 13:55:26', NULL),
(721, 120, 10, 8, 15, NULL, 'Ремонт дачи , рилс', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:55:56', '2024-08-22 13:55:56', NULL),
(722, 120, 9, 22, 43, NULL, 'Ремонт дачи , рилс', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:55:56', '2024-08-22 13:55:56', NULL),
(723, 120, 9, 22, 43, NULL, 'Для дачи , рилс', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:56:27', '2024-08-22 13:56:27', NULL),
(724, 120, 10, 8, 15, NULL, 'Для дачи , рилс', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:56:27', '2024-08-22 13:56:27', NULL),
(725, 120, 9, 2, 3, NULL, 'Для дачи , рилс', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:56:27', '2024-08-22 13:56:27', NULL),
(726, 120, 9, 22, 43, NULL, 'Обставляю детскую , сделаю интересный рилс как было до и после', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(727, 120, 10, 8, 15, NULL, 'Обставляю детскую , сделаю интересный рилс как было до и после', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(728, 120, 9, 20, 39, NULL, 'Обставляю детскую , сделаю интересный рилс как было до и после', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(729, 120, 9, 2, 3, NULL, 'Обставляю детскую , сделаю интересный рилс как было до и после', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 13:57:20', '2024-08-22 13:57:20', NULL),
(730, 116, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 116, '2024-08-22 13:58:24', '2024-08-22 13:58:24', NULL),
(731, 116, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 116, '2024-08-22 13:58:51', '2024-08-22 13:58:51', NULL),
(732, 116, 9, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 116, '2024-08-22 13:58:51', '2024-08-22 13:58:51', NULL),
(733, 122, 9, 19, 37, NULL, 'Я сделаю рилс и сторис в инстаграм', NULL, NULL, NULL, NULL, NULL, 122, '2024-08-22 15:33:30', '2024-08-22 15:33:30', NULL),
(734, 122, 9, 19, 37, NULL, 'Сделаю рилс и сторис в инстаграм', NULL, NULL, NULL, NULL, NULL, 122, '2024-08-22 15:33:49', '2024-08-22 15:33:49', NULL),
(735, 122, 9, 20, 39, NULL, 'Сделаю рилс и сторис в инстаграм', NULL, NULL, NULL, NULL, NULL, 122, '2024-08-22 15:33:49', '2024-08-22 15:33:49', NULL),
(736, 122, 9, 19, 37, NULL, 'Сделаю рилс и сторис .', NULL, NULL, NULL, NULL, NULL, 122, '2024-08-22 15:35:13', '2024-08-22 15:35:13', NULL),
(737, 122, 9, 20, 39, NULL, 'Сделаю рилс и сторис .', NULL, NULL, NULL, NULL, NULL, 122, '2024-08-22 15:35:13', '2024-08-22 15:35:13', NULL),
(738, 122, 10, 5, 9, NULL, 'Сделаю рилс и сторис .', NULL, NULL, NULL, NULL, NULL, 122, '2024-08-22 15:35:13', '2024-08-22 15:35:13', NULL),
(739, 120, 9, 3, 5, NULL, 'Есть частный дом, сниму красивый рилс', NULL, NULL, NULL, NULL, NULL, 120, '2024-08-22 16:34:53', '2024-08-22 16:34:53', NULL),
(740, 123, 9, 23, 45, 'pending', 'Отсниму стильно и красиво', NULL, NULL, NULL, NULL, '2024-08-23 12:31:00', 123, '2024-08-22 17:23:35', '2024-08-23 12:31:31', NULL),
(741, 113, 9, 23, 45, NULL, 'Здравствуйте, буду рада сотрудничеству!', NULL, NULL, NULL, NULL, NULL, 113, '2024-08-22 20:40:07', '2024-08-22 20:40:07', NULL),
(742, 113, 9, 23, 45, 'pending', 'Здравствуйте, буду рада сотрудничеству!', NULL, NULL, NULL, NULL, '2024-08-23 12:32:00', 113, '2024-08-22 20:40:24', '2024-08-23 12:32:05', NULL),
(743, 113, 9, 20, 39, NULL, 'Здравствуйте, буду рада сотрудничеству!', NULL, NULL, NULL, NULL, NULL, 113, '2024-08-22 20:40:24', '2024-08-22 20:40:24', NULL),
(744, 117, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 117, '2024-08-23 10:41:10', '2024-08-23 10:41:10', NULL),
(745, 117, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 117, '2024-08-23 10:41:25', '2024-08-23 10:41:25', NULL),
(746, 92, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:49:27', '2024-08-23 14:49:27', NULL),
(747, 92, 9, 2, 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:34:00', 92, '2024-08-23 14:49:53', '2024-08-26 11:34:40', NULL),
(748, 92, 10, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:50:31', '2024-08-23 14:50:31', NULL),
(749, 92, 10, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:50:38', '2024-08-23 14:50:38', NULL),
(750, 92, 10, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:50:46', '2024-08-23 14:50:46', NULL);
INSERT INTO `works` (`id`, `blogger_id`, `seller_id`, `project_id`, `project_work_id`, `status`, `message`, `accepted_by_blogger_at`, `accepted_by_seller_at`, `confirmed_by_blogger_at`, `confirmed_by_seller_at`, `last_message_at`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(751, 92, 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:50:52', '2024-08-23 14:50:52', NULL),
(752, 92, 9, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:50:58', '2024-08-23 14:50:58', NULL),
(753, 92, 9, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:51:03', '2024-08-23 14:51:03', NULL),
(754, 92, 9, 11, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:51:07', '2024-08-23 14:51:07', NULL),
(755, 92, 9, 12, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:51:12', '2024-08-23 14:51:12', NULL),
(756, 92, 9, 26, 51, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:25:00', 92, '2024-08-23 14:51:53', '2024-08-26 11:25:08', NULL),
(757, 92, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, '2024-08-23 14:51:58', '2024-08-23 14:51:58', NULL),
(758, 99, 9, 23, 46, NULL, 'Хороший комод, интересная интеграция будет♥️', NULL, NULL, NULL, NULL, NULL, 99, '2024-08-24 06:52:42', '2024-08-24 06:52:42', NULL),
(759, 99, 9, 2, 4, 'pending', 'Очень классная тележка, будет интересная интеграция', NULL, NULL, NULL, NULL, '2024-08-26 14:42:00', 99, '2024-08-24 06:54:01', '2024-08-26 14:42:47', NULL),
(760, 112, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-24 08:47:44', '2024-08-24 08:47:44', NULL),
(761, 112, 9, 11, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, '2024-08-24 08:47:53', '2024-08-24 08:47:53', NULL),
(762, 96, 10, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-24 10:50:45', '2024-08-24 10:50:45', NULL),
(763, 96, 9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-24 10:51:17', '2024-08-24 10:51:17', NULL),
(764, 96, 10, 27, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, '2024-08-24 10:51:48', '2024-08-24 10:51:48', NULL),
(765, 34, 9, 13, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, '2024-08-24 16:13:28', '2024-08-24 16:13:28', NULL),
(766, 34, 9, 26, 51, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:25:00', 34, '2024-08-24 16:15:14', '2024-08-26 11:25:02', NULL),
(767, 34, 9, 19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, '2024-08-24 16:15:56', '2024-08-24 16:15:56', NULL),
(768, 34, 9, 18, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, '2024-08-24 16:16:40', '2024-08-24 16:16:40', NULL),
(769, 128, 9, 2, 3, NULL, 'Здравствуйте! \r\n \r\nМеня зовут Людмила. \r\nЯ веду свой блог, и мне безумно понравился ваш бренд, я хотела бы вам предложить прорекламировать ваш товар у себя в блоге. \r\n\r\nhttps://www.instagram.com/luda_potapova88?igsh=MXZjdzBwZGZucTg2eg==\r\n\r\n\r\nКак вы на это смотрите? \r\nБуду ждать ваш ответ❤️', NULL, NULL, NULL, NULL, NULL, 128, '2024-08-25 12:54:44', '2024-08-25 12:54:44', NULL),
(770, 128, 9, 2, 3, NULL, 'Здравствуйте! \r\n \r\nМеня зовут Людмила. \r\nЯ веду свой блог, и мне безумно понравился ваш бренд, я хотела бы вам предложить прорекламировать ваш товар у себя в блоге. \r\n\r\nhttps://www.instagram.com/luda_potapova88?igsh=MXZjdzBwZGZucTg2eg==\r\n\r\n\r\nКак вы на это смотрите? \r\nБуду ждать ваш ответ❤️', NULL, NULL, NULL, NULL, NULL, 128, '2024-08-25 12:54:44', '2024-08-25 12:54:44', NULL),
(771, 128, 9, 20, 39, NULL, 'Здравствуйте! \r\n \r\nМеня зовут Людмила. \r\nЯ веду свой блог, и мне безумно понравился ваш бренд, я хотела бы вам предложить прорекламировать ваш товар у себя в блоге. \r\n\r\nhttps://www.instagram.com/luda_potapova88?igsh=MXZjdzBwZGZucTg2eg==\r\n\r\n\r\nКак вы на это смотрите? \r\nБуду ждать ваш ответ❤️', NULL, NULL, NULL, NULL, NULL, 128, '2024-08-25 12:55:44', '2024-08-25 12:55:44', NULL),
(772, 128, 9, 19, 37, NULL, 'Здравствуйте! \r\n \r\nМеня зовут Людмила. \r\nЯ веду свой блог, и мне безумно понравился ваш бренд, я хотела бы вам предложить прорекламировать ваш товар у себя в блоге. \r\n\r\nhttps://www.instagram.com/luda_potapova88?igsh=MXZjdzBwZGZucTg2eg==\r\n\r\n\r\nКак вы на это смотрите? \r\nБуду ждать ваш ответ❤️', NULL, NULL, NULL, NULL, NULL, 128, '2024-08-25 12:56:08', '2024-08-25 12:56:08', NULL),
(773, 128, 9, 25, 49, NULL, 'Здравствуйте! \r\n \r\nМеня зовут Людмила. \r\nЯ веду свой блог, и мне безумно понравился ваш бренд, я хотела бы вам предложить прорекламировать ваш товар у себя в блоге. \r\n\r\nhttps://www.instagram.com/luda_potapova88?igsh=MXZjdzBwZGZucTg2eg==\r\n\r\n\r\nКак вы на это смотрите? \r\nБуду ждать ваш ответ❤️', NULL, NULL, NULL, NULL, NULL, 128, '2024-08-25 12:56:34', '2024-08-25 12:56:34', NULL),
(774, 93, 9, 25, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93, '2024-08-26 10:19:34', '2024-08-26 10:19:34', NULL),
(775, 133, 9, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:25:02', '2024-08-26 14:45:21', '2024-08-26 14:45:21'),
(776, 133, 9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:25:07', '2024-08-26 14:51:18', '2024-08-26 14:51:18'),
(777, 133, 9, 3, 5, NULL, 'Тестовая заявка проверки.', NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:29:12', '2024-08-26 15:02:18', '2024-08-26 15:02:18'),
(778, 133, 9, 2, 3, NULL, 'f', NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:51:55', '2024-08-26 14:58:06', '2024-08-26 14:58:06'),
(779, 133, 9, 1, 1, NULL, 'п', NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:57:51', '2024-08-26 14:58:34', '2024-08-26 14:58:34'),
(780, 133, 9, 2, 3, NULL, 'а', NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:59:14', '2024-08-26 15:01:54', '2024-08-26 15:01:54'),
(781, 133, 9, 1, 1, NULL, 'п', NULL, NULL, NULL, NULL, NULL, 133, '2024-08-26 14:59:54', '2024-08-26 15:01:26', '2024-08-26 15:01:26');

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
  ADD KEY `bloggers_user_id_foreign` (`user_id`),
  ADD KEY `bloggers_country_id_foreign` (`country_id`);

--
-- Индексы таблицы `blogger_platforms`
--
ALTER TABLE `blogger_platforms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogger_platforms_blogger_id_foreign` (`blogger_id`),
  ADD KEY `blogger_platforms_platform_id_foreign` (`platform_id`);

--
-- Индексы таблицы `blogger_themes`
--
ALTER TABLE `blogger_themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogger_themes_blogger_id_foreign` (`blogger_id`),
  ADD KEY `blogger_themes_theme_id_foreign` (`theme_id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_logs`
--
ALTER TABLE `db_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `db_logs_user_id_foreign` (`user_id`);

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
-- Индексы таблицы `finish_stats`
--
ALTER TABLE `finish_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finish_stats_work_id_foreign` (`work_id`),
  ADD KEY `finish_stats_message_id_foreign` (`message_id`);

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
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_tariff_id_foreign` (`tariff_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `project_works`
--
ALTER TABLE `project_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_works_project_id_foreign` (`project_id`);

--
-- Индексы таблицы `referral_codes`
--
ALTER TABLE `referral_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_codes_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `referral_users`
--
ALTER TABLE `referral_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_users_referral_code_id_foreign` (`referral_code_id`),
  ADD KEY `referral_users_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `seller_tariffs`
--
ALTER TABLE `seller_tariffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_tariffs_user_id_foreign` (`user_id`),
  ADD KEY `seller_tariffs_tariff_id_foreign` (`tariff_id`);

--
-- Индексы таблицы `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tariffs_group_id_foreign` (`group_id`);

--
-- Индексы таблицы `tariff_groups`
--
ALTER TABLE `tariff_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tg_phones`
--
ALTER TABLE `tg_phones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tg_phones_phone_unique` (`phone`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
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
  ADD KEY `works_project_id_foreign` (`project_id`),
  ADD KEY `works_project_work_id_foreign` (`project_work_id`),
  ADD KEY `works_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `achievemnts`
--
ALTER TABLE `achievemnts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bloggers`
--
ALTER TABLE `bloggers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `blogger_platforms`
--
ALTER TABLE `blogger_platforms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT для таблицы `blogger_themes`
--
ALTER TABLE `blogger_themes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `db_logs`
--
ALTER TABLE `db_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `deep_links`
--
ALTER TABLE `deep_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `deep_link_stats`
--
ALTER TABLE `deep_link_stats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `finish_stats`
--
ALTER TABLE `finish_stats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT для таблицы `message_files`
--
ALTER TABLE `message_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1181;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT для таблицы `project_works`
--
ALTER TABLE `project_works`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `referral_codes`
--
ALTER TABLE `referral_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `referral_users`
--
ALTER TABLE `referral_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `seller_tariffs`
--
ALTER TABLE `seller_tariffs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `tariff_groups`
--
ALTER TABLE `tariff_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `tg_phones`
--
ALTER TABLE `tg_phones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT для таблицы `user_achievemnts`
--
ALTER TABLE `user_achievemnts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `works`
--
ALTER TABLE `works`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=782;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bloggers`
--
ALTER TABLE `bloggers`
  ADD CONSTRAINT `bloggers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bloggers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `blogger_platforms`
--
ALTER TABLE `blogger_platforms`
  ADD CONSTRAINT `blogger_platforms_blogger_id_foreign` FOREIGN KEY (`blogger_id`) REFERENCES `bloggers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogger_platforms_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `blogger_themes`
--
ALTER TABLE `blogger_themes`
  ADD CONSTRAINT `blogger_themes_blogger_id_foreign` FOREIGN KEY (`blogger_id`) REFERENCES `bloggers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogger_themes_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `db_logs`
--
ALTER TABLE `db_logs`
  ADD CONSTRAINT `db_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Ограничения внешнего ключа таблицы `finish_stats`
--
ALTER TABLE `finish_stats`
  ADD CONSTRAINT `finish_stats_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finish_stats_work_id_foreign` FOREIGN KEY (`work_id`) REFERENCES `works` (`id`) ON DELETE CASCADE;

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
-- Ограничения внешнего ключа таблицы `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_tariff_id_foreign` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Ограничения внешнего ключа таблицы `project_works`
--
ALTER TABLE `project_works`
  ADD CONSTRAINT `project_works_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `referral_codes`
--
ALTER TABLE `referral_codes`
  ADD CONSTRAINT `referral_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `referral_users`
--
ALTER TABLE `referral_users`
  ADD CONSTRAINT `referral_users_referral_code_id_foreign` FOREIGN KEY (`referral_code_id`) REFERENCES `referral_codes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referral_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `seller_tariffs`
--
ALTER TABLE `seller_tariffs`
  ADD CONSTRAINT `seller_tariffs_tariff_id_foreign` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seller_tariffs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tariffs`
--
ALTER TABLE `tariffs`
  ADD CONSTRAINT `tariffs_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `tariff_groups` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `works_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `works_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `works_project_work_id_foreign` FOREIGN KEY (`project_work_id`) REFERENCES `project_works` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `works_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
