-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 29 2017 г., 12:58
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL,
  `name` tinytext CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `finished` tinyint(1) DEFAULT NULL,
  `finished_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `added_at`, `name`, `user_id`, `finished`, `finished_at`) VALUES
(8, '2017-04-29 09:39:09', 'Создать проект', 8, 1, NULL),
(7, '2017-04-29 09:29:55', 'вторая задача', 7, 0, NULL),
(6, '2017-04-29 09:29:31', 'еще одна задача задач', 7, 0, NULL),
(9, '2017-04-29 12:08:28', 'Инициалзировать гит', 8, 1, NULL),
(10, '2017-04-29 10:41:18', 'Создать таблицу в БД', 8, 1, '2017-04-29 12:30:05'),
(20, '2017-04-29 12:34:36', 'Выполнить дополнительные задания', 8, NULL, NULL),
(21, '2017-04-29 12:36:54', 'Поехать домой', 8, NULL, NULL),
(22, '2017-04-29 12:37:02', 'Поспать', 8, NULL, NULL),
(23, '2017-04-29 12:37:52', 'Что-то еще', 8, NULL, NULL),
(24, '2017-04-29 12:37:57', '1', 8, 1, '2017-04-29 12:38:54'),
(27, '2017-04-29 12:42:42', '2', 8, NULL, NULL),
(28, '2017-04-29 12:42:44', '23', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `session_id` varchar(26) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `session_id`) VALUES
(8, 'bk3es33jhn0bokumt63035j4p1'),
(7, 'bk3es33jhn0bokumt63035j4p2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
