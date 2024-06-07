<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "newtable"; // Убедитесь, что это имя базы данных существует

    // Создаем соединение
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверяем соединение
    if ($conn->connect_error) {
        die("Сбой подключения: " . $conn->connect_error);
    }

    // Получение данных из формы
    $country = $_POST["country"];
    $city = $_POST["city"];
    $departure_date = $_POST["departure_date"];
    $arrival_date = $_POST["arrival_date"];
    $hotel = $_POST["hotel"];
    $cost = $_POST["cost"];
    $photo = null;

    if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }

    // Проверка получения данных
    if (empty($country) || empty($city) || empty($departure_date) || empty($arrival_date) || empty($hotel) || empty($cost)) {
        die("Пожалуйста, заполните все поля формы.");
    }

    // Подготовка и выполнение запроса
    $sql = "INSERT INTO Tours (country, city, departure_date, arrival_date, hotel, cost, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Проверяем, успешно ли подготовлен запрос
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }

    // Проверка корректности привязки параметров
    if (!$stmt->bind_param("ssssssd", $country, $city, $departure_date, $arrival_date, $hotel, $cost, $photo)) {
        die("Ошибка привязки параметров: " . $stmt->error);
    }

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
