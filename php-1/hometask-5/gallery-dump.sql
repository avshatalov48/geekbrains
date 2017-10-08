-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 08 2017 г., 20:53
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pictures`
--

INSERT INTO `pictures` (`id`, `path`, `size`, `name`, `view`, `click`, `description`) VALUES
(1, './img/', 160986, 'examples_001_1280.jpg', 3, 3, NULL),
(2, './img/', 338451, 'examples_002_1280.jpg', 1, 1, NULL),
(3, './img/', 122944, 'examples_003_1280.jpg', 1, 1, NULL),
(4, './img/', 204683, 'examples_004_1280.jpg', 8, 8, NULL),
(5, './img/', 157030, 'examples_005_1280.jpg', 2, 2, NULL),
(6, './img/', 167750, 'examples_006_1280.jpg', 1, 1, NULL),
(7, './img/', 71951, 'examples_007_1280.jpg', 5, 3, NULL),
(8, './img/', 98397, 'examples_008_1280.jpg', 0, 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
