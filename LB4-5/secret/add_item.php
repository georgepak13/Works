<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/.core/index.php');

    $itemAction = new ItemAction(DB::getInstance());

    $classroom = $itemAction->getClassroomById();

    if($classroom){
        $result = $itemAction->editClassroom();
        $id = $_GET['id'] ?? '';
        $number = $classroom["number"] ?? '';
        $campusId = $classroom["campus"] ?? '';
        $furniture = $classroom["furniture"] ?? '';
        $students = $classroom["students"] ?? '';
        $photo = $classroom['photo'] ?? '';
    }
    else {
        $result = $itemAction->addClassroom();
        $number = $_POST["number"] ?? '';
        $campusId = $_POST["campus"] ?? '';
        $furniture = $_POST["furniture"] ?? '';
        $students = $_POST["students"] ?? '';
    }

    $campuses = $itemAction->getAllCampuses();
?>

<!doctype html>
<html lang="en">

    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/html/header.php'); ?>
    <body>
        <div class="container mt-5">
            <form method="POST" action="add_item.php<?= isset($_GET['id']) ? '?id='.$_GET['id'] : '';?>" class="mb-5" enctype="multipart/form-data">
                <h2><?= !isset($_GET['id']) ? 'Добавление аудитории' : 'Редактирование аудитории'; ?></h2>
                <?php 
                if(isset($result) && is_string($result)){
                    echo '<div class="alert alert-danger" role="alert">' . $result . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="number">Номер аудитории:</label>
                    <input type="text" name="number" id="number" class="form-control" value="<?= htmlspecialchars($number)?>" required>
                    
                    <label for="campus">Кампус:</label>
                    <select class="form-select" name="campus" id="campus" required>
                        <?php
                        foreach ($campuses as $campus) {
                            $selected = $campusId == $campus["id"] ? " selected" : "";
                            echo "<option value='{$campus["id"]}'{$selected}>{$campus["name"]}</option>";
                        }
                        ?>
                    </select>

                    <label for="furniture">Мебель:</label>
                    <input type="text" name="furniture" id="furniture" class="form-control" value="<?= htmlspecialchars($furniture)?>" required>

                    <label for="students">Вместимость студентов:</label>
                    <input type="number" name="students" id="students" class="form-control" value="<?= htmlspecialchars($students)?>" required>

                    <label for="photo">Фото аудитории:</label>
                    <input type="file" accept=".jpg,.jpeg,.png" name="photo" id="photo" class="form-control" />
                    <input type="hidden" name="oldPhoto" value="<?= htmlspecialchars($photo) ?>" />
                </div>
                <button type="submit" class="btn btn-outline-primary p-2"><?= !isset($_GET['id']) ? 'Добавить аудиторию' : 'Сохранить изменения'; ?></button>
            </form>
        </div>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/html/footer.php'); ?>
    </body>
</html>