<?php
include 'database.php';
$name_result = mysqli_query($mysql, "SELECT * FROM interior");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="styles/main.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet" />
  <?php $title = "Мочалова А.В. 231-362 лаб.5"; ?>
  <title><?php echo $title; ?></title>
</head>

<body>
  <header>
    <nav>
      <div class="menu">
        <a href="add.php">Добавить данные</a>
      </div>
    </nav>
  </header>

  <main>
    <h1>Галерея изображений</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Название</th>
          <th>Описание</th>
          <th>Изображение</th>
        </tr>
      </thead>
      <?php while ($name = mysqli_fetch_assoc($name_result)): ?>
        <tr>
          <td><?php echo ($name['name']); ?></td>
          <td style="text-align: left;"><?php echo ($name['description']); ?></td>
          <td>
            <?php if (!empty($name['img'])): ?>
              <img src="<?php echo ($name['img']); ?>" alt="Изображение" title="<?php echo basename($name['name']); ?>">
            <?php else: ?>
              Нет изображения
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </main>
</body>

</html>