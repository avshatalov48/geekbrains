-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 13 2017 г., 20:15
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Смартфоны'),
(2, 'Планшеты'),
(3, 'Ноутбуки'),
(4, 'ПК'),
(5, 'Аудиотехника'),
(6, 'Телевизоры'),
(7, 'Игры и приставки'),
(8, 'Уценка');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `product_id`, `text`) VALUES
(1, 1, 4, 'Хороший телевизор. Доволен, как слон.'),
(2, 2, 4, 'Данный телевизор приобретался исключительно для игр в связке с Playstation 4 PRO. Картинку выдаёт отличную, цвета сочные, всё смотрится просто отлично.'),
(3, 3, 2, 'Купил уже второй такой - матери, сериалы смотреть. За эти деньги - вне конкуренции.'),
(4, 4, 3, 'Алюминиевый корпус и выглядит отлично, и чувствуется в руке здорово - сразу видно что нормальное устройство, а не просто какая-то дешёвка. Скорость работы приятно радует, ничего не подвисает и не лагает, в игрушки я как-то и не играю, а на всё остальное производительности устройства хватает с хорошим запасом. Смело рекомендую к покупке, вещица вполне себе нормальная и разочарований от покупки нет.');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `photo`, `short_description`, `description`, `price`) VALUES
(1, 8, 'Тест', 'no-photo.jpg', 'Краткое описание товара', 'Подробное описание товара', 100),
(2, 1, 'Смартфон 1', 'smartphone_001.jpg', 'Краткое описание 1', 'Описание 1', 200),
(3, 1, 'Смартфон 2', 'smartphone_002.jpg', 'Краткое описание 2', 'Описание 2', 300),
(4, 6, 'Телевизор LG 49LJ540V', 'tv-lg.jpg', '49\" (124 см) LED-телевизор LG 49LJ540V черный', 'LED-телевизор LG 49LJ540V с экраном в 49\", разрешение которого составляет 1920х1080. Такой экран обеспечит яркое, чёткое, реалистичное изображение и даст возможность получить максимум удовольствия от просмотра фильмов и телепередач. Телевизор оборудован аналоговым и цифровым тюнером. Вам не придётся приобретать дополнительное оборудование, чтобы смотреть передачи цифрового ТВ. В телевизоре присутствует технология Virtual Surround Plus, которая обеспечит Вам мощный и реалистичный объёмный звук. Технология Smart TV открывает телевизору доступ в интернет. Вы сможете смотреть видео с онлайн-ресурсов, пользоваться разнообразными приложениями. Разъёмы HDMI и USB позволят легко подключить к телевизору USB-накопители, проигрыватели дисков различного типа, а также другие устройства, чтобы воспроизводить видеоконтент на большом ярком экране.', 38999);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `groups_id` int(11) DEFAULT NULL,
  `login` varchar(32) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `groups_id`, `login`, `password`, `name`, `surname`, `email`, `phone`, `description`) VALUES
(12, 1, 'admin', '123', 'Alexander', NULL, NULL, NULL, 'The site administrator'),
(14, 1, 'admin', '123', 'Alexander', NULL, NULL, NULL, 'The site administrator'),
(15, 1, 'user2', '123456789', 'Миша', 'Галустян', NULL, NULL, 'The site administrator'),
(16, 1, 'admin', '123', 'Alexander', NULL, NULL, NULL, 'The site administrator'),
(17, 1, 'admin', '123', 'Alexander', NULL, NULL, NULL, 'The site administrator'),
(18, 1, 'admin', '123', 'Alexander', NULL, NULL, NULL, 'The site administrator'),
(19, 1, 'admin', '123', 'Alexander', NULL, NULL, NULL, 'The site administrator'),
(20, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(21, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(22, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(23, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(24, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(26, 1, 'user2', '123456789', 'Миша', 'Галустян', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(27, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(28, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(29, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(30, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(31, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(32, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(33, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(34, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(35, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!'),
(36, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!');

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
