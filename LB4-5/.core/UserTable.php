<?php

class UserTable {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function prepare($query) {
        $stmt = $this->db->prepare($query);
        return $stmt;
    }
    public function getUserByEmail($email) {
        $checkUserQuery = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($checkUserQuery);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function insertUser($username, $email, $hashedPassword, $salt, $fullName, $date_of_birth, $adress, $gender, $bloodGroup, $rhesusFactor, $vk_profile, $interests) {
        $insertUserQuery = "INSERT INTO users (username, email, password, salt, full_name, date_of_birth, adress, gender, blood_group, rh_factor, vk_profile, interests) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($insertUserQuery);
        $stmt->bind_param('ssssssssssss', $username, $email, $hashedPassword, $salt, $fullName, $date_of_birth, $adress, $gender,$bloodGroup, $rhesusFactor, $vk_profile, $interests);
        $stmt->execute();
    }

}
?>
