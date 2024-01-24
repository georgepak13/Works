<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB1/.core/index.php');


// Проверка нажатия на ссылку "Выйти"
if (isset($_GET['logout'])) {
    // Удаление сессии пользователя
    session_destroy();

    // Перенаправление на главную страницу или другую страницу
    header('Location: index.php');
    exit();
}
?>

<?php include 'html/header.php'; ?>
<div class="container mt-5">

    <h2>Добро пожаловать на сайт</h2>
    <a class="nav-link" href="secret/secret_page.php">Секретная страница</a>
    <?php
        // Проверка авторизации
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']['username'];
            echo "<p>Вы вошли как $username. <a href='?logout'>Выйти</a></p>";
        } else {
            echo "<p>Вы не авторизованы. <a href='login.php'>Ввести логин и пароль</a> или <a href='register.php'>зарегистрироваться</a></p>";
        }
        ?>
<?php include 'html/footer.php'; ?>

