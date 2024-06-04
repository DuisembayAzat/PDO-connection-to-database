<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=publications;charset=utf8mb4';
$username = 'root'; // Ваше имя пользователя
$password = ''; // Ваш пароль (если установлен)

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL запрос для извлечения данных
    $sql = "SELECT * FROM classics";
    $stmt = $pdo->query($sql);
    $delete_row_1 = "DELETE FROM classics WHERE author IS NULL OR author = ''";
    $stmt2 = $pdo->query($delete_row_1);
    $stmt2 ->execute();

    // Обработка результатов запроса
    echo "<h2>Publications</h2>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>Title: " . htmlspecialchars($row['title'] ) .", <br>". " Author: " . $row['author'] .", <br>". " Year: " . $row['year'] . "</li>";
    }
    echo "</ul>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Закрытие соединения
unset($pdo);
?>
