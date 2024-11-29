<?php
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Загрузка изображения
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $image_path = 'images/' . $image_name;

        // Перемещение загруженного файла
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $query = "INSERT INTO interior (name, img, description) VALUES ('$name', '$image_path', '$description')";
        } else {
            echo "Ошибка при загрузке изображения.";
            exit;
        }
    } else {
        // Если изображение не загружено, добавляем запись без изображения
        $query = "INSERT INTO interior (name, description) VALUES ('$name', '$description')";
    }

    // Выполнение запроса
    if ($mysql->query($query) === TRUE) {
        header("Location: http://localhost:8080/Лабораторная 5/index.php");
        exit;
    } else {
        echo "Ошибка: " . $mysql->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <?php $title = "Добавление данных"; ?>
    <title><?php echo $title; ?></title>
</head>

<body>
    <header>
        <nav>
            <div class="menu">
                <a href="index.php">На главную</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="form">
            <h1>Добавить новый стиль</h1>
            <form action="add.php" method="POST" enctype="multipart/form-data">
                <label for="name">Название стиля:</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Описание стиля:</label>
                <textarea name="description" id="description" required></textarea>

                <label for="image">Выберите изображение:</label>
                <input type="file" name="image" id="image">

                <button type="submit">Добавить</button>
            </form>
        </div>
    </main>
</body>

</html>