<?php
// Подключение к базе данных
$servername = "localhost"; // Имя вашего сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "user_auth"; // Имя базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$email = $_POST['email'];
$password = $_POST['password'];

// Хеширование пароля
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL-запрос для вставки данных
$sql = "INSERT INTO users (email, password) VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    // Перенаправление на главную страницу после успешной регистрации
    header("Location: index.html?email=" . urlencode($email));
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
