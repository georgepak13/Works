<?php
class ItemAction
{
    private $itemLogic;
    public $itemTable;

    public function __construct($db) {
        $this->itemTable = new ItemTable($db);
        $this->itemLogic = new ItemLogic($this->itemTable);
    }
    
    public function getFilteredClassrooms(){
      
        return $this->itemLogic->getFilteredClassrooms();
    }

    public function getClassroomById(){
        if(isset($_GET['id'])){
       
            return $this->itemTable->getClassroomById($_GET['id']);
        }
        return false;
    }

    public function getAllCampuses(){
      
        return $this->itemLogic->getAllCampuses();
    }

    public function setFilter(Filter $filter){
      
        $this->itemTable->set_filter($filter);
    }

    public function editClassroom(){
        if(isset($_POST['edit_item'])){
         
            $result = $this->itemLogic->editClassroom(
                $_GET['id'], 
                $_POST['photo'] ?? "", 
                $_POST['number'] ?? "", 
                $_POST['campus'] ?? "", 
                $_POST['furniture'] ?? "", 
                $_POST['students'] ?? "",
                $_POST['old_photo_name'] ?? ""
            );

            if($result == ''){
                unset($_POST);
                header("Location: ".'/web-lab/LB4-5/secret/secret_page.php'.'?edit_result=true');
                exit;
            }
            return $result;
        }             
    }

    public function addClassroom(){
        if(isset($_POST['add_item'])){
           
            $result = $this->itemLogic->addClassroom(
                $_POST['photo'] ?? "",
                $_POST['number'] ?? "", 
                $_POST['campus'] ?? "", 
                $_POST['furniture'] ?? "", 
                $_POST['students'] ?? ""
            );

            if($result == ''){
                unset($_POST);
                header("Location: ".'/web-lab/LB4-5/secret/secret_page.php'.'?add_result=true');
                exit;
            }
            return $result;
        }             
    }

    public function deleteClassroom(){
        if(isset($_GET['id'])){
       
            return $this->itemLogic->deleteClassroom($_GET['id']);
        }
    }
}
?>
