<?php

class ItemLogic
{
    private $itemTable;

    public function __construct(ItemTable $itemsTable) {
        $this->itemTable = $itemsTable;
    }

    public function getFilteredClassrooms(){
        return $this->itemTable->get_filtered_classrooms();
    }

    public function getAllCampuses(){
        return $this->itemTable->getAllCampuses();
    }

    public function editClassroom($id, $photo, $number, $campus, $furniture, $students, $oldPhoto){
        $err = '';

        
        if (!is_numeric($students) || $students < 0) {
            $err .= 'Количество студентов должно быть числом больше или равным 0.<br>';
        }

        
        $newPhotoName = $oldPhoto;
        if ($_FILES && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
            if (!preg_match('/\.(jpe?g|png)$/', $_FILES["photo"]["name"])) {
                $err .= 'Некорректный формат файла изображения.<br>';
            } else {
                $oldPhotoPath = $_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/secret/' . $oldPhoto;
                if ($oldPhoto && file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }

                $newPhotoName = 'images/' . $_FILES["photo"]["name"];
                $photoPath = $_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/secret/' . $newPhotoName;
                move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);
            }
        }

        if ($err == '') {
            $this->itemTable->editClassroom($id, $newPhotoName, $number, $campus, $furniture, $students);
        }

        return $err;
    }

    public function addClassroom($photo,$number, $campus, $furniture, $students){
        $err = '';

        
        if (!is_numeric($students) || $students < 0) {
            $err .= 'Количество студентов должно быть числом больше или равным 0.<br>';
        }

       
        $photoName = "";
        if ($_FILES && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
            if (!preg_match('/\.(jpe?g|png)$/', $_FILES["photo"]["name"])) {
                $err .= 'Некорректный формат файла изображения.<br>';
            } else {
                $photoName = 'images/' . $_FILES["photo"]["name"];
                $photoPath = $_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/secret/' . $photoName;
                move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);
            }
        }

        if ($err == '') {
            $this->itemTable->addClassroom($photoName, $number, $campus, $furniture, $students);
        }

        return $err;
    }

    public function deleteClassroom($id){
        $classroom = $this->itemTable->getClassroomById($id);
        $photo = $classroom['photo'] ?? '';

        if ($photo && file_exists($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/secret/' . $photo)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/secret/' . $photo);
        }

        $this->itemTable->deleteClassroom($id);
    }
}
?>
