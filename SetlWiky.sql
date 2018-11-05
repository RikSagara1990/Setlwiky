-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 05 2018 г., 08:13
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
-- База данных: `SetlWiky`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Companies`
--

CREATE TABLE `Companies` (
  `id` int(11) NOT NULL,
  `idcompany` varchar(150) NOT NULL,
  `title` varchar(50) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'img/logo.png',
  `parent` varchar(250) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Companies`
--

INSERT INTO `Companies` (`id`, `idcompany`, `title`, `icon`, `parent`) VALUES
(129, 'SetlGroup', 'Сэтл Групп', 'pngcompany/SetlGroup.png', 'none'),
(130, 'SetlSity', 'Сэтл Сити', 'pngcompany/SetlSity.png', 'none'),
(131, 'SetlEstate', 'Сэтл Эстейт', 'pngcompany/SetlEstate.png', 'none'),
(133, 'CRP', 'ЦРП', 'pngcompany/CRP.png', 'none'),
(134, 'DIT', 'ДИТ', 'img/logo.png', 'SetlGroup'),
(135, 'Help-desk', 'Help-desl', 'img/logo.png', 'DIT');

-- --------------------------------------------------------

--
-- Структура таблицы `docs`
--

CREATE TABLE `docs` (
  `id` int(255) UNSIGNED NOT NULL,
  `id companies` varchar(150) NOT NULL,
  `number docs` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `date of creation` datetime NOT NULL,
  `date of change` datetime NOT NULL,
  `keywords` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Companies`
--
ALTER TABLE `Companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `repetition` (`idcompany`,`parent`) USING BTREE,
  ADD UNIQUE KEY `title` (`title`,`parent`);

--
-- Индексы таблицы `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Same docs in company` (`id companies`,`type`,`name`),
  ADD UNIQUE KEY `Number docs in company` (`id companies`,`number docs`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Companies`
--
ALTER TABLE `Companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT для таблицы `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
