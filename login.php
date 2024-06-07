<?php
session_start();
$servername = "localhost"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "user_auth"; // Имя базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}

// Получение данных из формы
$email = $_POST['email'];
$password = $_POST['password'];

// Защита от SQL инъекций
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Поиск пользователя в базе данных
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Пользователь найден
    $_SESSION['email'] = $email;
    echo json_encode(['status' => 'success', 'message' => 'Добро пожаловать, ' . $email . '!']);
} else {
    // Пользователь не найден
    echo json_encode(['status' => 'error', 'message' => 'Ошибка: неверный email или пароль.']);
}
$conn->close();
?>
