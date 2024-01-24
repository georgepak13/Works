<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB1/.core/index.php');
class UserAction {
    private $userLogic;
    private $userTable;

    public function __construct($db) {
        $this->userTable = new UserTable($db);
        $this->userLogic = new UserLogic($this->userTable);
    }

    public function handleRegistrationRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $fullName = $_POST['full_name'];
            $date_of_birth = $_POST['date_of_birth'];
            $adress = $_POST['adress'];
            $gender= $_POST['gender'];
            $bloodGroup = $_POST['blood_group'];
            $rhesusFactor = $_POST['rhesus_factor'];
            $vk_profile = $_POST['vk_profile'];
            $interests = $_POST['interests'];
            $errors = $this->userLogic->validateRegistrationData($username, $email, $password, $confirmPassword);

            if (empty($errors)) {
                $this->userLogic->registerUser($username, $email, $password, $confirmPassword, $fullName, $date_of_birth, $adress, $gender, $bloodGroup, $rhesusFactor, $vk_profile, $interests);
                header('Location: login.php');
                exit();
            } else {
                return $errors;
            }
        }
    }

    public function handleLoginRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = $this->userLogic->validateLoginData($email, $password);

            if (empty($errors)) {
                $_SESSION['user'] = $this->userLogic->authenticateUser($email, $password);
                header('Location: index.php');
                exit();
            }
            return $errors;
        }
    }
}
?>
