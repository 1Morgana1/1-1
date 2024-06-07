<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newtable";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, country, city, departure_date, arrival_date, hotel, cost, photo FROM Tours";
$result = $conn->query($sql);

$tours = [];

if ($result->num_rows > 0) {
  // Вывод данных каждой строки
  while($row = $result->fetch_assoc()) {
    $row['photo'] = base64_encode($row['photo']); // Кодирование изображения в base64
    $tours[] = $row;
  }
} else {
  $tours = [];
}

$conn->close();

// Возвращаем данные в формате JSON
header('Content-Type: application/json');
echo json_encode($tours);
?>
