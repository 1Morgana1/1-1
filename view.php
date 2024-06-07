<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel Data</title>
</head>
<body>
    <h1>Travel Data</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Country</th>
            <th>City</th>
            <th>Departure Date</th>
            <th>Arrival Date</th>
            <th>Hotel</th>
            <th>Cost</th>
            <th>Photo</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "newtable";

        // Создаем соединение
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверяем соединение
        if ($conn->connect_error) {
            die("Сбой подключения: " . $conn->connect_error);
        }

        $sql = "SELECT id, country, city, departure_date, arrival_date, hotel, cost, photo FROM Tours";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Вывод данных каждой строки
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["country"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["departure_date"] . "</td>";
                echo "<td>" . $row["arrival_date"] . "</td>";
                echo "<td>" . $row["hotel"] . "</td>";
                echo "<td>" . $row["cost"] . "</td>";
                if (!empty($row["photo"])) {
                    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row["photo"]) . '" width="100"/></td>';
                } else {
                    echo "<td>No photo</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No results found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
