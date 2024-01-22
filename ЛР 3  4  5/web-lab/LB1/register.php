<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB1/.core/index.php');

$errors = [];

$userAction = new UserAction(DB::getInstance());
$errors = $userAction->handleRegistrationRequest();
?>

    <?php include 'html/header.php'; ?>
    <div class="container mt-5">

    <?php if (!empty($errors)): ?>
            <div class="mt-3 alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="full_name">ФИО:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Дата рождения:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= isset($_POST['date_of_birth']) ? htmlspecialchars($_POST['date_of_birth']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="adress">Адрес:</label>
                <input type="text" class="form-control" id="adress" name="adress" value="<?= isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="gender">Пол:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="">Выберите пол</option>
                        <option value="Мужской" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Мужской') ? 'selected' : '' ?>>Мужской</option>
                        <option value="Женский" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Женский') ? 'selected' : '' ?>>Женский</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="blood_group">Группа крови:</label>
                <input type="text" class="form-control" id="blood_group" name="blood_group" value="<?= isset($_POST['blood_group']) ? htmlspecialchars($_POST['blood_group']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="rhesus_factor">Резус-фактор:</label>
                <input type="text" class="form-control" id="rhesus_factor" name="rhesus_factor" value="<?= isset($_POST['rhesus_factor']) ? htmlspecialchars($_POST['rhesus_factor']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="vk_profile">ВК профиль:</label>
                <input type="text" class="form-control" id="vk_profile" name="vk_profile" value="<?= isset($_POST['vk_profile']) ? htmlspecialchars($_POST['vk_profile']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="interests">Интересы:</label>
                <input type="text" class="form-control" id="interests" name="interests" value="<?= isset($_POST['interests']) ? htmlspecialchars($_POST['interests']) : '' ?>">
            </div>

            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
        <p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
    </div>
    <br>
<?php include 'html/footer.php'; ?>
