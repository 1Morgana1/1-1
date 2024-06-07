<?php
session_start();
require_once 'config.php'; // Подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Поиск пользователя в базе данных
    $query = "SELECT * FROM user_auth WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Сохранение информации о пользователе в сессии
        $_SESSION['user_email'] = $user['email'];
        header("Location: index.html"); // Перенаправление на главную страницу после успешного входа
        exit();
    } else {
        echo "Неверный email или пароль.";
    }
}
?>
