
<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/web-lab/lr2/.core/index.php");

$number = $_GET['number'] ?? '';
$studentsfrom = $_GET['studentsfrom'] ?? '';
$studentsto = $_GET['studentsto'] ?? '';
$furniture = $_GET['furniture'] ?? '';
$campus = $_GET['campus'] ?? '';

$data = classroom::getAllFiltered($number, $studentsfrom, $studentsto, $furniture, $campus);

function draw_clients($data): void
{
    if (count($data) > 0) {
        $table = "<table class='table my-custom-table'>
            <thead>
             <tr>
                 <th>Id</th>
                 <th>Фото</th>
                 <th>Номер аудитории</th>
                 <th>Корпус</th>
                 <th>Оборудование в аудитории</th>
                 <th>Сколько людей вмещает</th>
             </tr>
             </thead>
             <tbody>";
        foreach ($data as $row) {
            $table .= "<tr>";
            $table .= "<td>" . $row["id"] . "</td>";
            $table .= "<td>" . "<img src='" . ('/web-lab/lr2/img/' . $row["photo"]) . "' width='100' height='100' alt='" . $row["photo"] . "'>" . "</td>";
            $table .= "<td>" . $row["number"] . "</td>";
            $table .= "<td>" . $row["name"] . "</td>";
            $table .= "<td>" . $row["furniture"] . "</td>";
            $table .= "<td>" . $row["students"] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody></table>";
        echo $table;
    } else {
        echo "<div>Ничего не найдено</div>";
    }
}

?>


<div class="container">
    <form method="get" action="" class="mb-5">
        <h2>Фильтрация результата поиска</h2>
        <div class="form-group">
            <label for="number">Номер аудитории:</label>
            <input type="text" name="number" id="number" class="form-control"
                   value="<?= htmlspecialchars($number)?>">
        </div>

        <div class="form-group">
            <label for="studentsfrom">От скольки людей вмещает:</label>
            <input type="number" name="studentsfrom" id="studentsfrom" class="form-control"
                   value="<?= htmlspecialchars($studentsfrom) ?>">
        </div>


        <div class="form-group">
            <label for="studentsto">До скольки людей вмещает:</label>
            <input type="number" name="studentsto" id="studentsto" class="form-control"
                   value="<?= htmlspecialchars($studentsto) ?>">
        </div>

        <div class="form-group">
            <label for="furniture">Оборудование в аудитории</label>
            <input type="text" name="furniture" id="furniture" class="form-control"
                   value="<?= htmlspecialchars($furniture) ?>">
        </div>

        <div class="form-group">
            <label for="campus">Кампус</label>
            <input type="text" name="campus" id="campus" class="form-control"
                   value="<?= htmlspecialchars($campus) ?>">
        </div>


        <button type="submit" class="btn btn-primary">Filter</button>
        <script>
            function resetFilters() {
                window.location.href = window.location.pathname;
            }
        </script>
        <button type="reset" onclick="resetFilters()" class="btn btn-secondary">Reset</button>
    </form>
    <?php
    if ($data) {
        draw_clients($data);
    }
    ?>
</div>
