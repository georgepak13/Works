<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    // Пользователь не авторизован, перенаправление на страницу авторизации
    header('Location: /web-lab/LR_3_2_2/login.php');
    exit();
} else {
    // Пользователь авторизован, перенаправление на другую страницу
    header('Location: http://localhost/web-lab/lr2');
    exit();
}
?>
