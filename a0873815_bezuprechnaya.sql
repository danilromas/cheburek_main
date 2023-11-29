-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2023 г., 16:56
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `a0873815_bezuprechnaya`
--

-- --------------------------------------------------------

--
-- Структура таблицы `AdminOrders`
--

CREATE TABLE `AdminOrders` (
  `order_id` int NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `customer_address` text,
  `order_details` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `user_session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `user_session_id`) VALUES
(146, NULL, 2, 1, '653e83e9b6d81'),
(147, NULL, 2, 1, '653e83e9b6d81'),
(148, NULL, 2, 1, '653e8437b5b2e'),
(149, NULL, 2, 1, '653e862a36c9b'),
(150, NULL, 10, 1, '653e862a36c9b'),
(151, NULL, 2, 1, '653e891d69d3c'),
(152, NULL, 2, 1, '653e891d69d3c'),
(153, NULL, 2, 1, '653e8934cbc14'),
(154, NULL, 2, 1, '653e8934cbc14'),
(155, NULL, 10, 1, '653e896b3d873'),
(156, NULL, 10, 1, '653e8a49901ab'),
(157, NULL, 2, 1, '653e8a89c6af6'),
(158, NULL, 2, 1, '653e8a8ee1eb8'),
(159, NULL, 10, 1, '653e8a9cac281'),
(160, NULL, 18, 1, '653f58076a3c8'),
(161, NULL, 19, 1, '653f58076a3c8'),
(162, NULL, 45, 1, '653fbe2728a4b'),
(163, NULL, 43, 1, '653fbe2728a4b'),
(164, NULL, 1, 1, '6540ad4c82b0b'),
(165, NULL, 2, 1, '6540ad4c82b0b'),
(166, NULL, 10, 1, '65427b1feefd9'),
(167, NULL, 2, 1, '65427b4938b68'),
(168, NULL, 1, 1, '65427c5d3e012'),
(169, NULL, 10, 1, '65427caa6869f'),
(170, NULL, 1, 1, '65498e5716e99'),
(171, NULL, 10, 1, '654bb9e84ed90'),
(172, NULL, 10, 1, '654bbbfc99347'),
(173, NULL, 10, 1, '654bbc6063380'),
(174, NULL, 10, 1, '654bbc6a1265e'),
(175, NULL, 10, 1, '654bbd2e47da8'),
(176, NULL, 58, 1, '6555146d5491f'),
(177, NULL, 58, 1, '6555146d5491f'),
(178, NULL, 14, 1, '655515517ac8d'),
(179, NULL, 14, 1, '655515517ac8d'),
(180, NULL, 14, 1, '655515517ac8d'),
(181, NULL, 2, 1, '6555158027ce5'),
(182, NULL, 52, 1, '6555149956c7a'),
(183, NULL, 47, 1, '65551641a2dfc'),
(184, NULL, 2, 1, '65551644ac251'),
(185, NULL, 60, 1, '655516f732fbb'),
(186, NULL, 10, 1, '65551817be1d2'),
(187, NULL, 1, 1, '655598e62f4b3'),
(188, NULL, 2, 1, '655598e62f4b3'),
(189, NULL, 2, 1, '6555990c706ea'),
(190, NULL, 1, 1, '6555f757ca233'),
(191, NULL, 1, 1, '6555f8487c0ba'),
(192, NULL, 16, 1, '655603aa6dbe1'),
(193, NULL, 16, 1, '65562b551cc35'),
(194, NULL, 14, 1, '65562b551cc35'),
(195, NULL, 2, 1, '65570aee9b908'),
(196, NULL, 1, 1, '65570aee9b908'),
(197, NULL, 58, 1, '65570bbedce09'),
(198, NULL, 59, 1, '65570bbedce09'),
(199, NULL, 59, 1, '6557105fc5c10'),
(200, NULL, 14, 1, '6557105fc5c10'),
(201, NULL, 2, 1, '65574e154fca4'),
(202, NULL, 2, 1, '65578ed15e2cf'),
(203, NULL, 1, 1, '65578f5a4037b'),
(204, NULL, 1, 1, '65578fa62b4cc'),
(205, NULL, 55, 1, '6557900e04183'),
(206, NULL, 2, 1, '6557902b047b0'),
(207, NULL, 2, 1, '6557908b8e8d3'),
(208, NULL, 2, 1, '6557908b8e8d3'),
(209, NULL, 16, 1, '655790dfdae54'),
(210, NULL, 1, 1, '655791e8e1006'),
(211, NULL, 2, 1, '655791e8e1006'),
(212, NULL, 1, 1, '655791e8e1006'),
(213, NULL, 1, 1, '655791e8e1006'),
(214, NULL, 1, 1, '655791e8e1006'),
(215, NULL, 1, 1, '655791e8e1006'),
(216, NULL, 1, 1, '655791e8e1006'),
(217, NULL, 2, 1, '6557bb387b155'),
(218, NULL, 2, 1, '6557c29b85000'),
(219, NULL, 2, 1, '65586fe0781bc'),
(220, NULL, 16, 1, '6558b929442c7'),
(221, NULL, 19, 1, '6558eb5a22e0d'),
(222, NULL, 2, 1, '6558f4dd20ce9'),
(223, NULL, 2, 1, '655a52fb5383f'),
(224, NULL, 14, 1, '655b3ba77481f'),
(225, NULL, 18, 1, '655b4a93cd551'),
(226, NULL, 1, 1, '655ca12860441'),
(227, NULL, 1, 1, '655cc47e57ba5'),
(228, NULL, 2, 1, '655cccfd1238b'),
(229, NULL, 10, 1, '655cccfd1238b'),
(230, NULL, 16, 1, '655cd3ba1c5dc'),
(231, NULL, 2, 1, '655cd4c00da34'),
(232, NULL, 2, 1, NULL),
(233, NULL, 2, 1, NULL),
(234, NULL, 2, 1, '11'),
(235, NULL, 10, 1, '11'),
(236, NULL, 1, 1, '11');

-- --------------------------------------------------------

--
-- Структура таблицы `Categories`
--

CREATE TABLE `Categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Categories`
--

INSERT INTO `Categories` (`category_id`, `category_name`) VALUES
(1, 'Салаты'),
(2, 'Напитки'),
(4, 'Первые блюда'),
(5, 'Вторые блюда'),
(6, 'Закуски'),
(7, 'Пирожные'),
(8, 'Сэндвичи'),
(9, 'Мороженое'),
(10, 'Молочные коктейли'),
(11, 'Горячие напитки'),
(13, 'Чебуреки');

-- --------------------------------------------------------

--
-- Структура таблицы `Customers`
--

CREATE TABLE `Customers` (
  `customer_id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Customers`
--

INSERT INTO `Customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `password`) VALUES
(1, 'Безупречная Чебуречная', '', 'Infiniti_ooo@Inbox.Ru', NULL, NULL, 'administrator'),
(2, 'Mako', 'Sin', 'mdanuishis@mail.ru', '+789997', 'Jopas Street', '123412341234'),
(4, 'asdfasdfasd', 'asdfasdfasdf', 'Ma@ma', 'asdfasdfasdf', 'asdfasdfasdfasdf', 'asdfasdf'),
(10, 'Мако Синчик', 'Фамилия', 'bronepoezduav@gmail.com', '+79785892033', 'Адрес', '123412341234'),
(11, 'Иван Сергеевич', 'Фамилия', 'mdanushis@mail.ru', '+79785892033', 'Адрес пуст', '123123123'),
(12, 'Мако Мако', 'Фамилия', 'Mako@mail.ru', '+79780000000', 'улица Пушкина, дом Колотушкина', 'makomako');

-- --------------------------------------------------------

--
-- Структура таблицы `MenuItems`
--

CREATE TABLE `MenuItems` (
  `item_id` int NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `category_id` int DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `MenuItems`
--

INSERT INTO `MenuItems` (`item_id`, `item_name`, `category_id`, `description`, `price`, `image_url`) VALUES
(1, 'Чебурек / баранина', 13, 'Что может быть прекрасней чебурека, обжигающе горячего, с хрустящей, обжаренной в кипящем масле корочкой, истекающего ароматным бульоном и наполненного пряной мясной начинкой.', '175.00', '../images/1_Чебурек.jpg'),
(2, 'Чебурек / Говядина', 13, 'Что может быть прекрасней чебурека, обжигающе горячего, с хрустящей, обжаренной в кипящем масле корочкой, истекающего ароматным бульоном и наполненного пряной мясной начинкой.', '175.00', '../images/2_Чебурек.jpg'),
(10, 'Чебурек / свинина', 13, 'Описание', '155.00', '../images/10_Чебурек.jpg'),
(14, 'Чебурек / курица', 13, 'Описание', '165.00', '../images/14_Чебурек.jpg'),
(16, 'Чебурек / Свинина-Говядина', 13, 'Описание', '165.00', '../images/16_Чебурек.jpg'),
(17, 'Чебурек / Сыр-зелень', 13, 'Описание', '155.00', '../images/17_Чебурек.jpg'),
(18, 'Чубурек Царский / баранина', 13, 'Описание', '195.00', '../images/18_Чебурек.jpg'),
(19, 'Чебурек Царский / Говядина', 13, 'Описание', '195.00', '../images/19_Чебурек.jpg'),
(20, 'Чебурек Царский / Свинина', 13, 'Описание', '195.00', '../images/20_Чебурек.jpg'),
(21, 'Чебурек Царский / Курица', 13, 'Описание', '195.00', '../images/21_Чебурек.jpg'),
(22, 'Чебурек Царский / Свинина-Говядина ', 13, 'Описание', '195.00', '../images/22_Чебурек.jpg'),
(23, 'Салат Оливье', 1, 'Описание', '180.00', '../images/23_Салат Оливье.jpg'),
(24, 'Салат Столичный', 1, 'Описание', '180.00', '../images/24_Салат Столичный.jpg'),
(25, 'Салат Винегрет', 1, 'Описание', '130.00', '../images/25_Салат Винегрет.jpg'),
(26, 'Баварские колбаски', 6, 'Описание', '290.00', '../images/26_Баварские колбаски.jpg'),
(27, 'Картофель Фри', 6, 'Описание', '175.00', '../images/27_Картофель Фри.jpg'),
(28, 'Наггетсы 6шt', 6, 'Описание', '195.00', '../images/28_Наггетсы куриные.jpg'),
(29, 'Чесночные гренки', 6, 'Описание', '145.00', '../images/29_Гренки чесночные.jpg'),
(30, 'Куриные крылья 3шт', 6, 'Описание', '245.00', '../images/30_Крылья куриные.jpg'),
(31, 'Сырные палочки 4шт', 6, 'Описание', '185.00', '../images/31_Сырные палочки.jpg'),
(32, 'Сэндвич / Ветчина', 8, 'Описание', '295.00', '../images/32_Сэндвич.jpg'),
(33, 'Сэндвич / Бекон', 8, 'Описание', '295.00', '../images/33_Сэндвич.jpg'),
(34, 'Ностальгия Лимонад 0,5л', 2, 'Описание', '95.00', '../images/34_Лимонад.png'),
(35, 'Ностальгия Тархун 0,5л', 2, 'Описание', '95.00', '../images/35_Тархун.png'),
(36, 'Ностальгия Дюшес 0,5л', 2, 'Описание', '95.00', '../images/36_Дюшес.png'),
(37, 'Ностальгия Крем-Сода 0,5л', 2, 'Описание', '95.00', '../images/37_Крем-сода.png'),
(38, 'Ностальгия Саган 0,5л', 2, 'Описание', '95.00', '../images/38_Саган.png'),
(39, 'Ностальгия Тайга 0,5л', 2, 'Описание', '95.00', '../images/39_Тайга.png'),
(40, 'Вода БонАква газ 0,5л', 2, 'Описание', '65.00', '../images/40_БонАква газ.jpeg'),
(41, 'Сок ДК Апельсин 1л', 2, 'Описание', '220.00', '../images/41_Дары кубани апельсин.jpg'),
(42, 'Сок ДК Вишня 1л', 2, 'Описание', '220.00', '../images/42_Дары кубани вишня.jpeg'),
(43, 'Сок ДК Мультифрукт 1л', 2, 'Описание', '220.00', '../images/43_Дары кубани мульт.jpg'),
(44, 'Сок ДК Персик 1л', 2, 'Описание', '220.00', '../images/44_Дары кубани персик.jpg'),
(45, 'Сок ДК Томат 1л', 2, 'Описание', '220.00', '../images/45_Дары кубани томат.png'),
(46, 'Сок ДК Яблоко', 2, 'Описание', '220.00', '../images/46_Дары кубани яблоко.png'),
(47, 'Салат Летний', 1, 'Описание', '130.00', '../images/47_Салат летний.jpg'),
(48, 'Салат Капустный ', 1, 'Описание', '130.00', '../images/48_1666787972_35-mykaleidoscope-ru-p-salat-so-svezhei-kapustoi-i-ogurtsom-insta-40.jpg'),
(49, 'Понедельник-Среда: Борщ Красный', 4, 'Описание', '220.00', '../images/49_60890a9652.jpg'),
(50, 'Понедельник-Среда Суп-Лапша', 4, 'Описание', '220.00', '../images/50_1667243438_34-vkusnyashki-club-p-vkusnii-sup-s-vermishelyu-pinterest-36.jpg'),
(51, 'Ежедневно Окрошка на сыворотке', 4, 'Описание', '220.00', '../images/51_kvass-or-kefir-which-is-better-for-okroshka-3.jpg'),
(52, 'Четверг-Суббота Суп-фрикадельки', 4, 'Описание', '220.00', '../images/52_dae4ca82625d6914a93d4109a92344c6.jpg'),
(53, 'Четверг-Суббота Борщ Зеленый', 4, 'Описание', '220.00', '../images/53_2720879311.jpg'),
(54, 'Ежедневно Пельмени', 5, 'Описание', '260.00', '../images/54_nici.jpg'),
(55, 'Понедельник-Среда Картофельное Пюре с мясной котлетой', 5, 'Описание', '260.00', '../images/55_b76c02be3ff079fb6ff09a81a2b3adde.jpg'),
(56, 'Четверг-Суббота Макароны  По-флотски', 5, 'Описание', '260.00', '../images/56_1617224131_3-p-makaroni-po-flotski-klassicheskii-krasivo-3.jpg'),
(57, 'Четверг-Суббота Отварной картофель с минтаем', 5, 'Описание', '260.00', '../images/57_2cbe0a59d4506efa44ca02a22e32a911.jpeg'),
(58, 'Понедельник-Среда Плов со свининой', 5, 'Описание', '260.00', '../images/58_1517124782_sytnyy-plov-s-govyadinoy.jpg'),
(59, 'Компот ягодный 1л', 2, 'Описание', '200.00', '../images/59_1677561944_3-44.jpg'),
(60, 'Мороженое Ванильное', 9, 'Описание', '185.00', '../images/60_Sweets_Ice_cream_488977.jpg'),
(61, 'Мороженое Шоколадное ', 9, 'Описание', '185.00', '../images/61_1657323265_48-mykaleidoscope-ru-p-shokoladnoe-morozhenoe-v-stakanchike-vkusn-54.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `OrderItems`
--

CREATE TABLE `OrderItems` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `unique_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `OrderItems`
--

INSERT INTO `OrderItems` (`order_id`, `product_id`, `quantity`, `unique_id`) VALUES
(17, 2, 1, 1),
(17, 2, 1, 2),
(17, 2, 1, 3),
(17, 1, 1, 4),
(17, 1, 1, 5),
(17, 1, 1, 6),
(17, 37, 1, 7),
(21, 27, 1, 88),
(21, 16, 1, 94),
(23, 10, 1, 95),
(23, 2, 1, 96);

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orderstatus` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`order_id`, `user_id`, `order_date`, `orderstatus`) VALUES
(17, 12, '2023-11-23 16:36:54', 'finished'),
(21, 12, '2023-11-24 16:12:12', 'active'),
(23, 1, '2023-11-25 11:39:20', 'Оплата наличкой');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `AdminOrders`
--
ALTER TABLE `AdminOrders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Индексы таблицы `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `MenuItems`
--
ALTER TABLE `MenuItems`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`unique_id`),
  ADD KEY `item_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `AdminOrders`
--
ALTER TABLE `AdminOrders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT для таблицы `Categories`
--
ALTER TABLE `Categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `Customers`
--
ALTER TABLE `Customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `MenuItems`
--
ALTER TABLE `MenuItems`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `unique_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `MenuItems`
--
ALTER TABLE `MenuItems`
  ADD CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`);

--
-- Ограничения внешнего ключа таблицы `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `MenuItems` (`item_id`),
  ADD CONSTRAINT `orderitems_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
