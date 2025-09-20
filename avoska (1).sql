-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 13 2024 г., 20:16
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
-- База данных: `avoska`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `status` enum('новое','подтверждено','отменено') DEFAULT 'новое',
  `delivery_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `status`, `delivery_address`, `created_at`) VALUES
(1, 1, 1, 2, 'подтверждено', 'Мушникова 27', '2024-11-13 14:52:24'),
(2, 1, 3, 1, 'новое', '124', '2024-11-13 17:06:54'),
(3, 1, 3, 1, 'новое', '124', '2024-11-13 17:07:49'),
(4, 1, 3, 1, 'новое', '124', '2024-11-13 17:08:13'),
(5, 1, 3, 1, 'новое', '124', '2024-11-13 17:08:46'),
(6, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:05'),
(7, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:09'),
(8, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:14'),
(9, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:21'),
(10, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:28'),
(11, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:33'),
(12, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:39'),
(13, 1, 3, 1, 'новое', '124', '2024-11-13 17:09:45'),
(14, 1, 3, 1, 'новое', '124', '2024-11-13 17:10:52'),
(15, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:02'),
(16, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:09'),
(17, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:19'),
(18, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:24'),
(19, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:28'),
(20, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:35'),
(21, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:43'),
(22, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:51'),
(23, 1, 3, 1, 'новое', '124', '2024-11-13 17:11:56'),
(24, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:00'),
(25, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:04'),
(26, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:08'),
(27, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:13'),
(28, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:16'),
(29, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:20'),
(30, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:27'),
(31, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:30'),
(32, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:34'),
(33, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:40'),
(34, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:45'),
(35, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:50'),
(36, 1, 3, 1, 'новое', '124', '2024-11-13 17:12:55'),
(37, 1, 3, 1, 'новое', '124', '2024-11-13 17:13:50'),
(38, 1, 1, 5, 'новое', '15', '2024-11-13 17:15:34');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'Яблоки', '50.00'),
(2, 'Бананы', '60.00'),
(3, 'Апельсины', '70.00'),
(4, 'Киви', '80.00'),
(5, 'Груши', '55.00'),
(6, 'Виноград', '90.00'),
(7, 'Мандарины', '75.00'),
(8, 'Персики', '85.00'),
(9, 'Лимоны', '65.00'),
(10, 'Арбузы', '100.00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `full_name`, `phone`, `email`) VALUES
(1, 'Art', '$2y$10$Bt3CVQkMvpRWpg8vpLdT/OaoYClZaqD/X6KIIWfiyoCmLMpuY87qO', 'Склизков Артём Вячеславович', '7000078094', 'luckyhop002@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
