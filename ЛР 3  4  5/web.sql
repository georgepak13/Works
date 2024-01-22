-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 22 2024 г., 07:35
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `web`
--

-- --------------------------------------------------------

--
-- Структура таблицы `campus`
--

CREATE TABLE `campus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `campus`
--

INSERT INTO `campus` (`id`, `name`) VALUES
(1, 'Main Campus'),
(2, 'North Campus'),
(3, 'South Campus'),
(4, 'East Campus'),
(5, 'West Campus');

-- --------------------------------------------------------

--
-- Структура таблицы `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `number` varchar(100) DEFAULT NULL,
  `campus` int(11) NOT NULL,
  `furniture` text NOT NULL,
  `students` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `classroom`
--

INSERT INTO `classroom` (`id`, `photo`, `number`, `campus`, `furniture`, `students`) VALUES
(5, 'images/classroom5.jpg', '202', 4, 'Desks, Chairs, Projector', 28),
(6, 'images/classroom6.jpg', '302', 2, 'Tables, Chairs, Smartboard', 32),
(7, 'images/classroom7.jpg', '103', 5, 'Desks, Chairs, Whiteboard', 22),
(8, 'images/classroom8.jpg', '203', 3, 'Tables, Chairs, Projector', 33),
(9, 'images/classroom9.jpg', '303', 4, 'Desks, Chairs, Smartboard', 26),
(10, 'images/classroom10.jpg', '104', 1, 'Desks, Chairs, Whiteboard', 31),
(11, 'images/classroom11.jpg', '204', 2, 'Tables, Chairs, Projector', 29),
(12, 'images/classroom12.jpg', '304', 5, 'Desks, Chairs, Smartboard', 36),
(13, 'images/classroom13.jpg', '105', 3, 'Desks, Chairs, Whiteboard', 27),
(14, 'images/classroom14.jpg', '205', 4, 'Tables, Chairs, Projector', 38),
(15, 'images/classroom15.jpg', '305', 1, 'Desks, Chairs, Smartboard', 24),
(16, 'images/classroom16.jpg', '106', 2, 'Tables, Chairs, Whiteboard', 34),
(17, 'images/classroom17.jpg', '206', 3, 'Desks, Chairs, Projector', 37),
(18, 'images/classroom18.jpg', '306', 4, 'Tables, Chairs, Smartboard', 23),
(19, 'images/classroom19.jpg', '107', 5, 'Desks, Chairs, Whiteboard', 39),
(20, 'images/classroom20.jpg', '207', 1, 'Tables, Chairs, Projector', 32);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `rh_factor` varchar(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Мужской','Женский') NOT NULL,
  `interests` text DEFAULT NULL,
  `vk_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `salt`, `full_name`, `adress`, `blood_group`, `rh_factor`, `date_of_birth`, `gender`, `interests`, `vk_profile`) VALUES
(2, 'george_pak@mail.ru', 'George', '$2y$10$FID4sqTOdNzAue/axWHZ.eHt6OchV6pqY/xJB4h5XY1RYwQJ4Jeh.', '68abac39d8c2666536c430f645cb0061a310fcd83f1f08bd42a42876617d9e47', 'Пак Георгий Вячеславович', 'Ленина 42', '2', 'о', '2024-01-22', 'Мужской', 'Программирование, политика', 'VK_profile');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campus` (`campus`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`campus`) REFERENCES `campus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
