-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Май 01 2022 г., 14:03
-- Версия сервера: 5.7.34
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `MY_DATA`
--

-- --------------------------------------------------------

--
-- Структура таблицы `connect_table`
--

CREATE TABLE `connect_table` (
  `id_purchases` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `items_info`
--

CREATE TABLE `items_info` (
  `id_item` int(11) NOT NULL,
  `table_material` char(100) DEFAULT NULL,
  `footing_material` char(100) DEFAULT NULL,
  `type_table` char(100) DEFAULT NULL,
  `number_legs` int(11) DEFAULT NULL,
  `shape` varchar(100) DEFAULT NULL,
  `id_prise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items_info`
--

INSERT INTO `items_info` (`id_item`, `table_material`, `footing_material`, `type_table`, `number_legs`, `shape`, `id_prise`) VALUES
(1, 'Эбоксидная смола и дерево', 'Металл', 'Прямоугольный', 4, NULL, NULL),
(2, 'Дерево', 'Дерево', 'Круглый', 1, NULL, NULL),
(3, 'Эбоксидная  смола с светодиодной подсцветкой и тесла элементами', 'Камень', 'Прямоугольный', 4, NULL, NULL),
(4, 'Камень', 'камень', 'Круглый', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `prise`
--

CREATE TABLE `prise` (
  `id_prise` int(11) NOT NULL,
  `prise` int(11) DEFAULT NULL,
  `stoim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE `purchases` (
  `id_purchases` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_purchase` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `USER`
--

CREATE TABLE `USER` (
  `user_id` int(11) NOT NULL,
  `Name` char(60) DEFAULT NULL,
  `date_birth` char(10) DEFAULT NULL,
  `addres` char(100) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `privilege` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `USER`
--

INSERT INTO `USER` (`user_id`, `Name`, `date_birth`, `addres`, `login`, `password`, `tel`, `privilege`) VALUES
(7, 'Глубоков Герман Викторович', '09.06.2002', 'Россия', 'MrFokus', '15b1b04a2c1a08c938677c8a33fba8e5', '+79182962756', 'admin'),
(9, 'Иванов Иван Иванович', '01.01.2001', 'Россия, Липецкая область, г. Липецк', 'Vano', 'f93dfd909eb0460b02759e1f37debfc4', '89998887766', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `connect_table`
--
ALTER TABLE `connect_table`
  ADD KEY `connect_table_items_info_id_item_fk` (`id_item`),
  ADD KEY `connect_table_purchases_id_purchases_fk` (`id_purchases`);

--
-- Индексы таблицы `items_info`
--
ALTER TABLE `items_info`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `items_info_id_uindex` (`id_item`),
  ADD KEY `items_info_prise_id_prise_fk` (`id_prise`);

--
-- Индексы таблицы `prise`
--
ALTER TABLE `prise`
  ADD PRIMARY KEY (`id_prise`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id_purchases`),
  ADD KEY `purchases_USER_user_id_fk` (`user_id`);

--
-- Индексы таблицы `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `USER_user_id_uindex_2` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `items_info`
--
ALTER TABLE `items_info`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `prise`
--
ALTER TABLE `prise`
  MODIFY `id_prise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id_purchases` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `USER`
--
ALTER TABLE `USER`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `connect_table`
--
ALTER TABLE `connect_table`
  ADD CONSTRAINT `connect_table_items_info_id_item_fk` FOREIGN KEY (`id_item`) REFERENCES `items_info` (`id_item`),
  ADD CONSTRAINT `connect_table_purchases_id_purchases_fk` FOREIGN KEY (`id_purchases`) REFERENCES `purchases` (`id_purchases`);

--
-- Ограничения внешнего ключа таблицы `items_info`
--
ALTER TABLE `items_info`
  ADD CONSTRAINT `items_info_prise_id_prise_fk` FOREIGN KEY (`id_prise`) REFERENCES `prise` (`id_prise`);

--
-- Ограничения внешнего ключа таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_USER_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
