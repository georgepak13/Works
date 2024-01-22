<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/.core/index.php');

$errors = [];

$userAction = new UserAction(DB::getInstance());
$errors = $userAction->handleLoginRequest();
?>


    <?php include 'html/header.php'; ?>
    <div class="container mt-5">
        <?php
        // Проверка авторизации
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']['username'];
            echo "<p>Вы уже авторизованы как $username. <a href='index.php'>Выйти</a></p>";
        } else {
            echo "<h2>Авторизация</h2>";

            // Вывод ошибок здесь
            if (!empty($errors)) {
                echo "<div class='mt-3 alert alert-danger'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            }
            ?>

            <!-- Форма авторизации -->
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Войти</button>
            </form>

            <!-- Ссылка на регистрацию -->
            <p>Еще не зарегистрированы? <a href="register.php">Зарегистрироваться</a></p>
        <?php
        }
        ?>
    </div>
    <br>
<?php include 'html/footer.php'; ?>

