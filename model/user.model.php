<?php
require_once "base.model.php";
class UserModel extends BaseModel {
    // --- PUBLIC METHODS ---
    public function checkLogin($email, $pwd) {
        $result = [];

        $user = $this->getUserByEmail($email);
        if($user) {
            $pwdHashed = $user[0]['pwd'];
            $checkPwd = password_verify($pwd, $pwdHashed);

            if ($checkPwd === false) {
                $result['postError'] = "Incorrect password. Please try again.";
                $result['email'] = $user[0]['email'];
            } else if ($checkPwd === true) {
                $_SESSION['email'] = $user[0]['email'];
                $_SESSION['name'] = $user[0]["name"];
                $_SESSION['id'] = $user[0]["id"];
            }
        } else {
            $result['postError'] = "This emailadress does not exist."; 
        }

        return $result;
    }

    public function saveRegister($name, $email, $pwd, $repeat_pwd, $shipping_adress, $billing_adress) {
        $result = [];

        $user = $this->getUserByEmail($email);
        if ($user) {
            $result['postError'] = 'This email already exists.';
        } else {
            if ($pwd !== $repeat_pwd) {
                $result['postError'] = 'Passwords do not match.';
            } else {
                $this->createUser($name, $email, $pwd, $shipping_adress, $billing_adress);
                $result['email'] = $email;
            }
        }

        return $result;
    }

    // --- PRIVATE METHODS ---
    private function createUser($name, $email, $pwd, $shipping_adress, $billing_adress) : int {
        $sql = "INSERT INTO user (name, email, pwd, shipping_adress, billing_adress) VALUES (?, ?, ?, ?, ?)";
        $hashedPwd =  password_hash($pwd, PASSWORD_DEFAULT);
        $var = [$name, $email, $hashedPwd, $shipping_adress, $billing_adress];
        return $this->crud->create($sql, $var);
    }

    private function getUserByEmail($email) : array {
        $sql = "SELECT * FROM user WHERE email = ?";
        $var = [$email];
        return $this->crud->read($sql, $var);
    }
}