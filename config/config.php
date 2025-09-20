<?php
$host = 'localhost'; // Сервер БД на Beget
$db = 'luckyhop_avoska'; // Полное имя БД 
$user = 'luckyhop_avoska'; // Пользователь БД 
$pass = 'Colgitec777'; // Пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8mb4'");
    $pdo->exec("SET CHARACTER SET utf8mb4");
} catch (PDOException $e) {
    error_log('Connection failed: ' . $e->getMessage());
    die('Ошибка подключения к базе данных. Пожалуйста, попробуйте позже.');
}