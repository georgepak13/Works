<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/.core/index.php');

    
    $number = $_GET["number"] ?? "";
    $campusId = isset($_GET["campusId"]) ? (int)$_GET["campusId"] : null;
    $minStudents = isset($_GET["minStudents"]) ? (int)$_GET["minStudents"] : null;
    $maxStudents = isset($_GET["maxStudents"]) ? (int)$_GET["maxStudents"] : null;
    
    $filter = new Filter($number, $campusId, $minStudents, $maxStudents);
    
    
    $itemAction = new ItemAction(DB::getInstance());

    $itemAction->setFilter($filter);
    
    $result = $itemAction->getFilteredClassrooms();;

    $campuses = $itemAction->getAllCampuses();
    


    

?>
<?php

    
    if (!isset($_SESSION['user'])) {
   
        header('Location: /web-lab/LB4-5/login.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<?php  require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/html/header.php'); ?>


<div class="container mt-5">
    <h2 class="mb-4">Аудитории</h2>

    <form action="" method="get" class="mb-2">
        <div class="mb-3">
            <label class="form-label">Номер аудитории:</label>
            <input type="text" id="number" name="number" class="form-control"
                value="<?= htmlspecialchars($number)?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Корпус:</label>
            <select id="campusId" name="campusId" class="form-select">
                <?php foreach ($campuses as $campus): ?>
                <option value="<?= $campus['id'] ?>"><?= $campus['name'] ?></option>
                <?php endforeach; ?>
            </select>
            </select>
        </div>
        <div class="mb-1">
            <label class="form-label">Минимальное кол-во студентов:</label>
            <input type='number' name='minStudents' step="0.01" class="form-control"
                value="<?= htmlspecialchars($minStudents)?>">
        </div>
        <div class="mb-2">
            <label class="form-label">Максимальное кол-во студентов:</label>
            <input type='number' name='maxStudents' step="0.01" class="form-control"
                value="<?= htmlspecialchars($maxStudents)?>">
        </div>
        <div>
            <button type="submit" name="filter" class="btn btn-primary">Фильтрация</button>
            <a href="secret_page.php">            
            <div  name="reset" class="btn btn-outline-secondary">Сброс</div>
                </a>
        </div>
    </form>
    <?php
        if(isset($_GET['add_result']) && $_GET['add_result'] === "true"){
            echo('<div class="alert alert-success" role="alert">');
            echo('Запись успешно добавлена.');
            echo('</div>');
        }
        if(isset($_GET['edit_result']) && $_GET['edit_result'] === "true"){
            echo('<div class="alert alert-success" role="alert">');
            echo('Запись успешно изменена.');
            echo('</div>');
        }
        if(isset($_GET['delete_result']) && $_GET['delete_result'] === "true"){
            echo('<div class="alert alert-success" role="alert">');
            echo('Запись успешно удалена.');
            echo('</div>');
        }
    ?>
    <?php
    
    echo '<a href="add_item.php"';
    echo '<button class="btn btn-success">Добавить</button>';
    echo '</a>';
            if ($result) {
                
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Фото</th>";
                echo "<th>Номер аудитории</th>";
                echo "<th>Корпус</th>";
                echo "<th>Вместимость (кол-во студентов)     </th>";
                echo "<th>Мебель</th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td><img src='" . $row["photo"] . "' alt='" . $row["number"] . "' width='100'></td>";
                    echo "<td>" . $row["number"] . "</td>";
                    echo "<td>" . $row["campus"] . "</td>";
                    echo "<td>" . number_format($row["students"],0) . "</td>";
                    echo "<td>" . $row["furniture"] . "</td>";
                    echo("<td>".
                            '<a href="./add_item.php?id='.$row["id"].'">
                                <button class="btn btn-outline-success outline-button" style="font-weight: 400;">Редактировать</button>
                            </a>'. 
                        "</td>");
                        echo("<td>". 
                        '<a href="./delete_item.php?id='.$row["id"].'" onclick="return confirm(\'Вы уверены, что хотите удалить этот элемент?\')">
                            <button type="submit" class="btn btn-outline-danger outline-button" style="font-weight: 400;">Удалить</button>
                        </a>'. 
                    "</td>");
                    echo "</tr>";
                    
                }
                
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "0 результатов";
            }

            ?>
</div>

<?php  require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/html/footer.php'); ?>

</html>