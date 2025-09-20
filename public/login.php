<?php 
include('../config/config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];
            header('Location: orders.php');
            exit;
        } else {
            $error = "Неверный логин или пароль.";
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $error = "Ошибка авторизации. Попробуйте позже.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация - Авоська</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h2>Авторизация</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <input type="text" name="login" required placeholder="Логин" value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>">
            <input type="password" name="password" required placeholder="Пароль">
            
            <button type="submit" class="wht">Войти</button>
            
            <div class="action-links">
                <a href="../index.php" class="wht">На главную</a>
                <a href="register.php" class="wht">Регистрация</a>
            </div>
        </form>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>