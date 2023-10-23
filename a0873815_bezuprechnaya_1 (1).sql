-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2023 г., 21:32
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

--
-- Дамп данных таблицы `AdminOrders`
--

INSERT INTO `AdminOrders` (`order_id`, `customer_name`, `phone_number`, `customer_address`, `order_details`, `total_price`, `order_date`) VALUES
(1, 'Тест', '+79785580159', 'Переулок Ладыгина 6', '[{\"category\":\"\\\"Чебуреки\\\" -\",\"name\":\"Чебурек c бараниной-\",\"quantity\":\"1шт\",\"price\":\"280.00руб\"},{\"category\":\"\\\"Чебуреки\\\" -\",\"name\":\"Чебурек с мясом-\",\"quantity\":\"1шт\",\"price\":\"200.00руб\"},{\"category\":\"\\\"Чебуреки\\\" -\",\"name\":\"Чебурек c бараниной-\",\"quantity\":\"20шт\",\"price\":\"280.00руб\"}]', '6080.00', '2023-10-14 17:26:14');

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
(87, NULL, 20, 1, '6536af5ae9248'),
(88, NULL, 17, 1, '6536af5ae9248'),
(89, NULL, 16, 1, '6536af5ae9248'),
(90, NULL, 2, 1, '6536af5ae9248'),
(91, NULL, 2, 1, '6536af5ae9248'),
(92, NULL, 2, 1, '6536af5ae9248'),
(93, NULL, 2, 1, '6536af5ae9248'),
(94, NULL, 2, 1, '6536af5ae9248'),
(95, NULL, 14, 1, '6536b02d40450'),
(96, NULL, 14, 1, '6536b02d40450'),
(97, NULL, 14, 1, '6536b1dc09362'),
(98, NULL, 14, 1, '6536b3a6e497d'),
(99, NULL, 16, 1, '6536b3a6e497d'),
(100, NULL, 10, 1, '6536b3eb46a9d'),
(101, NULL, 14, 1, '6536b3eb46a9d'),
(102, NULL, 14, 1, '6536b43ff1659'),
(103, NULL, 10, 1, '6536b4e023a24'),
(104, NULL, 10, 1, '6536b500b8809'),
(105, NULL, 16, 1, '6536b583cf0e4'),
(106, NULL, 10, 1, '6536b5b25a7bd'),
(107, NULL, 10, 1, '6536b67aa80b8'),
(108, NULL, 10, 1, '6536b67aa80b8'),
(109, NULL, 14, 1, '6536b7445844d'),
(110, NULL, 10, 1, '6536b7445844d'),
(111, NULL, 10, 1, '6536b7bcddc56'),
(112, NULL, 16, 1, '6536b7bcddc56'),
(113, NULL, 2, 1, '6536b7bcddc56'),
(114, NULL, 10, 1, '6536b8e42eea2'),
(115, NULL, 10, 1, '6536b8fce8e3b'),
(116, NULL, 10, 1, '6536b95f9c46a'),
(117, NULL, 16, 1, '6536b9b9e8b90'),
(118, NULL, 10, 1, '6536ba2ce521f'),
(119, NULL, 16, 1, '6536ba8993b0d'),
(120, NULL, 10, 1, '6536bbe58fb7d'),
(121, NULL, 18, 1, '6536bbe58fb7d'),
(122, NULL, 16, 1, '6536bbe58fb7d'),
(123, NULL, 20, 1, '6536bbe58fb7d'),
(124, NULL, 21, 1, '6536bbe58fb7d'),
(125, NULL, 21, 1, '6536bbe58fb7d');

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
(3, 'Основные блюда'),
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
(1, 'Безупречная', 'Чебуречная', 'administrator', NULL, NULL, 'admin');

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
(28, 'Наггетсы 6шт', 6, 'Описание', '195.00', '../images/28_Наггетсы куриные.jpg'),
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
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `AdminOrders`
--
ALTER TABLE `AdminOrders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT для таблицы `Categories`
--
ALTER TABLE `Categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `Customers`
--
ALTER TABLE `Customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `MenuItems`
--
ALTER TABLE `MenuItems`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
