<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB1/.core/index.php');

class UserLogic {
    private $userTable;

    public function __construct($userTable) {
        $this->userTable = $userTable;
    }

    public function checkEmailExists($email) {
        return $this->userTable->getUserByEmail($email) !== null;
    }

    public function hashPassword($password, $salt) {
        return password_hash($password . $salt, PASSWORD_DEFAULT);
    }
    
    public function authenticateUser($email, $password) {
        $user = $this->userTable->getUserByEmail($email);
    
        if ($user !== null) {
            $hashedPassword = $user['password'];
            if (password_verify($password . $user['salt'], $hashedPassword)) {
                return $user;
            }
        }
    
        return null;
    }

    public function validateRegistrationData($username, $email, $password, $confirmPassword) {
        $errors = [];

        $passwordRequirements = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-_ ])(?=.*[!@#$%^&*(),.?":{}|<>\[\]\/\\+=;`~])(?!.*[а-яА-Я]).{7,}$/';
        if (!preg_match($passwordRequirements, $password)) {
            $errors['password'] = 'Пароль не соответствует требованиям.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некорректный email.';
        }

        if ($password !== $confirmPassword) {
            $errors['confirm_password'] = 'Пароли не совпадают.';
        }

        if ($this->checkEmailExists($email)) {
            $errors['email'] = 'Пользователь с таким email уже существует.';
        }

        return $errors;
    }

    public function validateLoginData($email, $password) {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некорректный email.';
        } else {
            $user = $this->authenticateUser($email, $password);
            if ($user === null) {
                $errors['login'] = 'Неверный email или пароль';
            }
        }

        return $errors;
    }

    public function registerUser($username, $email, $password, $confirmPassword, $fullName, $date_of_birth, $adress, $gender,$bloodGroup, $rhesusFactor, $vk_profile, $interests) {
        if ($this->checkEmailExists($email)) {
            return false;
        }

        $salt = bin2hex(random_bytes(32));
        $hashedPassword = $this->hashPassword($password, $salt);
        $this->userTable->insertUser($username, $email, $hashedPassword, $salt, $fullName, $date_of_birth, $adress, $gender,$bloodGroup, $rhesusFactor, $vk_profile, $interests);

        return true;
    }
}
?>
