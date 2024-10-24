<?php
require 'db.php'; // Подключение к базе данны
$sql = "SELECT * FROM books"; // Замените 'books' на название вашей таблицы
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="ru">
<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
$userName = $_SESSION['user'] ?? 'Гость';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Библиотека</title>
    <link rel="stylesheet" href="styles_0.css"> <!-- Подключение CSS файла -->
</head>

<body>

    <header>
        <h1>Добро пожаловать в Библиотеку, <?php echo htmlspecialchars($userName); ?>!</h1>
        <?php if ($isLoggedIn): ?>
            <div class="button_class">
                <a href="logout.php" class="button_exit">Выход</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Библиотекарь'): ?>
                    <a href="delete_user.php" class="button">Удалить пользователя</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="auto.php" class="button button_d">Вход</a>
                <a href="creatusers.php" class="button">Регистрация</a>
            </div>
        <?php endif; ?>
    </header>

    <div class="container">


    </div>

    <div class="user_buttons">
    <button class="button" id="add_button">Добавить</button>
    </div> 

    <div id="myAdd" class="wind">
        <div class="wind_screen">
            <span class="close" id = "add_close">&times;</span>
            <form action="add_book.php" method="post">
                <label>Автор:</label><br>
                <input type="text" id="author" name="author" required><br><br>
                <label>Название:</label><br>
                <input type="text" id="name" name="name" required><br><br>
                <label>Год:</label><br>
                <input type="text" id="year" name="year" required><br><br>
                <label>Количество:</label><br>
                <input type="text" id="quantity" name="quantity" required><br><br>
                <input type="submit" value="Отправить">
            </form>
        </div>
    </div>

    <h2>Доступные книги</h2>
    <div class="book-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="book">
                    <p>Название: <?php echo htmlspecialchars($book['name']); ?></p>
                    <p>Автор: <?php echo htmlspecialchars($book['author']); ?></p>
                    <p>Год: <?php echo htmlspecialchars($book['year']); ?></p>
                    <p>Количество: <?php echo htmlspecialchars($book['quantity']); ?></p>
                    <button onclick="editBook(<?php echo htmlspecialchars($book['nn']); ?>)"
                        class="button_add">Изменить</button>
                    <button onclick="deleteBook(<?php echo htmlspecialchars($book['nn']); ?>)"
                        class="button_add button_d">Удалить</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Книг нет в наличии.</p>
        <?php endif; ?>
    </div>

    

</body>
<script src="script.js"></script>