<?php include('../config/config.php'); session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель Администратора - Авоська</title>
    <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="container">
        <?php
        // Проверка, вошел ли администратор в систему
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            // Если это не POST-запрос, показываем форму входа
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') { ?>
                <form action="" method="POST">
                    <h2>Панель Администратора</h2>
                    <div class="input-group">
                        <label for="login">Логин:</label>
                        <input type="text" name="login" id="login" placeholder="Введите логин" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Пароль:</label>
                        <input type="password" name="password" id="password" placeholder="Введите пароль" required>
                    </div>
                    <button type="submit">Войти</button>
                    <div class="action-links">
                        <a href="../index.php">На главную страницу</a>
                    </div>
                </form>
                <?php 
            } else {
                // Проверка логина и пароля
                if ($_POST['login'] === 'sklad' && $_POST['password'] === '123qwe') {
                    $_SESSION['admin_logged_in'] = true; // Устанавливаем сессию администратора
                    // Перенаправляем чтобы обновить страницу
                    header('Location: admin.php');
                    exit;
                } else {
                    echo '<div class="alert alert-error">Неверный логин или пароль.</div>';
                }
            }
        }

        // Если администратор уже вошел, показываем заказы
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
            // Верхняя панель администратора
            echo '<div class="admin-top-bar">';
            echo '<h1>Панель управления заказами</h1>';
            echo '<div class="admin-actions">';
            echo '<button type="submit" name="logout">Выйти</button>';
            echo '<a href="../index.php">На главную</a>';
            echo '</div>';
            echo '</div>';
            
            
            // Статистика заказов
            $totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
            $newOrders = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'новое'")->fetchColumn();
            $confirmedOrders = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'подтверждено'")->fetchColumn();
            
            echo '<div class="stats-cards">';
            echo '<div class="stat-card">';
            echo '<h3>Всего заказов</h3>';
            echo '<div class="number">' . $totalOrders . '</div>';
            echo '</div>';
            
            echo '<div class="stat-card">';
            echo '<h3>Новые заказы</h3>';
            echo '<div class="number">' . $newOrders . '</div>';
            echo '</div>';
            
            echo '<div class="stat-card">';
            echo '<h3>Подтвержденные</h3>';
            echo '<div class="number">' . $confirmedOrders . '</div>';
            echo '</div>';
            echo '</div>';
            
            // Вывод всех заказов
            $stmt = $pdo->query("SELECT orders.id, users.full_name, users.email, products.name AS product_name, orders.quantity, orders.status, orders.created_at, orders.delivery_address 
                                FROM orders 
                                JOIN users ON orders.user_id = users.id 
                                JOIN products ON orders.product_id = products.id
                                ORDER BY orders.created_at DESC");
            
            // Проверка, есть ли заказы
            if ($stmt->rowCount() > 0) {
                echo '<div class="table-container">';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID заказа</th>';
                echo '<th>Клиент</th>';
                echo '<th>Товар</th>';
                echo '<th>Кол-во</th>';
                echo '<th>Адрес доставки</th>';
                echo '<th>Дата заказа</th>';
                echo '<th>Статус</th>';
                echo '<th>Действия</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                while ($order = $stmt->fetch()) {
                    $statusClass = '';
                    switch ($order['status']) {
                        case 'подтверждено':
                            $statusClass = 'alert-success';
                            break;
                        case 'отменено':
                            $statusClass = 'alert-error';
                            break;
                        default:
                            $statusClass = 'alert-warning';
                    }
                    
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($order['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['full_name']) . '<br><small>' . htmlspecialchars($order['email']) . '</small></td>';
                    echo '<td>' . htmlspecialchars($order['product_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['quantity']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['delivery_address']) . '</td>';
                    echo '<td>' . date('d.m.Y H:i', strtotime($order['created_at'])) . '</td>';
                    echo '<td><span class="alert ' . $statusClass . '">' . htmlspecialchars($order['status']) . '</span></td>';
                    echo '<td>';
                    echo '<form action="" method="POST" class="status-form">';
                    echo '<input type="hidden" name="order_id" value="' . $order['id'] . '">';
                    echo '<select name="status" class="status-select">';
                    echo '<option value="новое"' . ($order['status'] === 'новое' ? ' selected' : '') . '>Новое</option>';
                    echo '<option value="подтверждено"' . ($order['status'] === 'подтверждено' ? ' selected' : '') . '>Подтверждено</option>';
                    echo '<option value="отменено"' . ($order['status'] === 'отменено' ? ' selected' : '') . '>Отменено</option>';
                    echo '</select>';
                    echo '<button type="submit" class="btn-update">Обновить</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-info">Нет заказов.</div>';
            }

            // Обработка изменения статуса заказа
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
                $order_id = $_POST['order_id'];
                $status = $_POST['status'];

                $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
                if ($stmt->execute([$status, $order_id])) {
                    echo '<div class="alert alert-success">Статус заказа обновлен.</div>';
                    // Перенаправляем чтобы избежать повторной отправки формы
                    echo '<script>setTimeout(function() { window.location.href = "admin.php"; }, 1000);</script>';
                } else {
                    echo '<div class="alert alert-error">Ошибка обновления статуса.</div>';
                }
            }

            // Обработка выхода
            if (isset($_POST['logout'])) {
                session_destroy(); // Удаляем сессию
                header('Location: admin.php'); // Перенаправляем назад на панель администратора
                exit;
            }
        }
        ?>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>