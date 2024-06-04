<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=publications;charset=utf8mb4';
$username = 'root'; // Ваше имя пользователя
$password = ''; // Ваш пароль (если установлен)

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(!isset($_POST['title']) || empty($_POST['title'])) {
      die ('<p style = "background-color: red;"> invalid title </p> '); 
        return;
    };

    // Получение данных из формы
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    // Подготовка SQL запроса для вставки данных
    $sql = "INSERT INTO classics (title, author, year) VALUES (:title, :author, :year)";
    $stmt = $pdo->prepare($sql);

    // Привязка параметров
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':year', $year);

    // Выполнение запроса
    $stmt->execute();

    echo "Publication added successfully!";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Закрытие соединения
unset($pdo);
?>

