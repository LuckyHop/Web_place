<?php include('../config/config.php'); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <form action="" method="POST">    <!-- Область действий формы -->
    <h2>Регистрация</h2>
        <input type="text" name="login" required placeholder="Логин">
        <input type="password" name="password" required placeholder="Пароль">
        <input type="text" name="full_name" required placeholder="ФИО">
        <input type="text" name="phone" placeholder="Телефон">
        <input type="email" name="email" required placeholder="Email">
        <button type="submit" class="wht">Зарегистрироваться</button>
        <a href="../index.php" class="wht">На главную страницу</a>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Получения данных из формы
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $stmt = $pdo->prepare("INSERT INTO users (login, password, full_name, phone, email) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$login, $password, $full_name, $phone, $email])) {
            echo "Регистрация прошла успешно.";
        } else {
            echo "Ошибка регистрации.";
        }
    }
    ?>
    <script src="../js/script.js"></script>
</body>
</html>