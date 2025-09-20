<?php include('../config/config.php'); session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новый Заказ</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Новый Заказ</h2>
    <?php
    // Проверка на авторизацию пользователя
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php'); // Если пользователь не авторизован, перенаправляем на страницу логина
        exit;
    }
    // Вывод формы для нового заказа
    ?>
    <form action="" method="POST" class="wht">
        <label for="product_id">Выберите товар:</label>
        <select name="product_id" id="product_id" required class="wht">
            <?php
            // Получаем список товаров из базы данных
            $stmt = $pdo->query("SELECT * FROM products");
            while ($product = $stmt->fetch()) {
                echo "<option value='" . $product['id'] . "'>" . htmlspecialchars($product['name']) . " - " . htmlspecialchars($product['price']) . "₽</option>";
            }
            ?>
        </select>
        <label for="quantity">Количество:</label>
        <input type="number" name="quantity" id="quantity" required min="1" placeholder="Введите количество">
        <label for="delivery_address">Адрес доставки:</label>
        <input type="text" name="delivery_address" id="delivery_address" required placeholder="Введите адрес доставки">
        <button type="submit">Заказать</button>
        <a href="../index.php" class="wht">На главную страницу</a>
    </form>
    <?php
    // Обработка формы при отправке заказа
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получаем данные из формы
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);
        $delivery_address = trim($_POST['delivery_address']);

        if ($quantity > 0) {
            // Вставка заказа в базу данных
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, quantity, delivery_address) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$_SESSION['user_id'], $product_id, $quantity, $delivery_address])) {
                echo "<p class='mid'>Заказ успешно создан.</p>";
            } else {
                echo "<p class='mid unc'>Ошибка при создании заказа.</p>";
            }
        } else {
            echo "<p style='color: red;'>Некорректное количество товара.</p>";
        }
    }
    ?>
    <script src="../js/script.js"></script>
</body>
</html>