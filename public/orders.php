<?php include('../config/config.php'); session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мои Заказы - Авоська</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2 class="header">Мои Заказы</h2>
        
        <?php
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM orders JOIN products ON orders.product_id = products.id WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll();
        
        if ($orders) {
            echo '<div class="table-container">';
            echo '<table>';
            echo '<thead><tr><th>Товар</th><th>Количество</th><th>Статус</th></tr></thead>';
            echo '<tbody>';
            
            foreach ($orders as $order) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($order['name']) . '</td>';
                echo '<td>' . htmlspecialchars($order['quantity']) . '</td>';
                echo '<td>' . htmlspecialchars($order['status']) . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-info">У вас нет заказов.</div>';
        }
        ?>  
        
        <div class="action-links">
            <a href="new_order.php">Сделать новый заказ</a>
            <a href="../index.php">На главную страницу</a>
        </div>
    </div>
    
    <script src="../js/script.js"></script>
</body>
</html>