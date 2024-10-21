-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 21 2024 г., 21:42
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testtask`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doljnost`
--

CREATE TABLE `doljnost` (
  `id` int(11) NOT NULL,
  `Name` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `doljnost`
--

INSERT INTO `doljnost` (`id`, `Name`) VALUES
(1, 'Разработчик'),
(2, 'Тестировщик'),
(3, 'Системный администратор'),
(4, 'Менеджер проектов'),
(5, 'Аналитик');

-- --------------------------------------------------------

--
-- Структура таблицы `otdel`
--

CREATE TABLE `otdel` (
  `id` int(11) NOT NULL,
  `Name` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `otdel`
--

INSERT INTO `otdel` (`id`, `Name`) VALUES
(1, 'Отдел разработки'),
(2, 'Отдел тестирования'),
(3, 'Отдел поддержки'),
(4, 'Отдел продаж'),
(5, 'Отдел маркетинга');

-- --------------------------------------------------------

--
-- Структура таблицы `sotrudniki`
--

CREATE TABLE `sotrudniki` (
  `id` int(11) NOT NULL,
  `Lastname` varchar(999) NOT NULL,
  `Firstname` varchar(999) NOT NULL,
  `Middlename` varchar(999) NOT NULL,
  `SeriyaNomerPasport` varchar(999) NOT NULL,
  `ContactInformation` varchar(10) NOT NULL,
  `Address` varchar(999) NOT NULL,
  `idOtdela` int(11) NOT NULL,
  `idDoljnosti` int(11) NOT NULL,
  `SalaryAmount` varchar(999) NOT NULL,
  `DateEmployment` date NOT NULL,
  `Dismissed` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `sotrudniki`
--

INSERT INTO `sotrudniki` (`id`, `Lastname`, `Firstname`, `Middlename`, `SeriyaNomerPasport`, `ContactInformation`, `Address`, `idOtdela`, `idDoljnosti`, `SalaryAmount`, `DateEmployment`, `Dismissed`) VALUES
(1, 'Иванов', 'Иван', 'Иванович', '1234 567890', '+7 (000) 0', 'Москва, ул. Ленина, 1', 1, 1, '60000.00', '2024-01-15', b'0'),
(2, 'Петров', 'Петр', 'Петрович', '2345 678901', '+7 (111) 1', 'Москва, ул. Пушкина, 2', 2, 2, '55000.00', '2024-02-20', b'0'),
(3, 'Сидоров', 'Сидор', 'Сидорович', '3456 789012', '+7 (222) 2', 'Москва, ул. Чехова, 3', 3, 3, '70000.00', '2024-03-10', b'0'),
(4, 'Кузнецов', 'Алексей', 'Алексеевич', '4567 890123', '+7 (333) 3', 'Москва, ул. Гоголя, 4', 1, 4, '80000.00', '2024-04-05', b'0'),
(5, 'Михайлов', 'Анна', 'Сергеевна', '5678 901234', '+7 (444) 4', 'Москва, ул. Толстого, 5', 2, 5, '50000.00', '2024-05-15', b'0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doljnost`
--
ALTER TABLE `doljnost`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `otdel`
--
ALTER TABLE `otdel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDoljnosti` (`idDoljnosti`),
  ADD KEY `idOtdela` (`idOtdela`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doljnost`
--
ALTER TABLE `doljnost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `otdel`
--
ALTER TABLE `otdel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  ADD CONSTRAINT `sotrudniki_ibfk_1` FOREIGN KEY (`idDoljnosti`) REFERENCES `doljnost` (`id`),
  ADD CONSTRAINT `sotrudniki_ibfk_2` FOREIGN KEY (`idOtdela`) REFERENCES `otdel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
