<?php

require_once 'models/user.php';

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];

            // Set cookies
            setcookie('user_id', $user['id'], time() + 3600, '/');
            setcookie('username', $user['username'], time() + 3600, '/');
            setcookie('name', $user['name'], time() + 3600, '/');

            return "Selamat datang, " . $user['name'] . "!";
        }

        return "Username atau Password salah.";
    }

    public function signup($username, $name, $email, $password, $profile_pic) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, name, email, password, profile_pic) VALUES (:username, :name, :email, :password, :profile_pic)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':profile_pic', $profile_pic);

        if ($stmt->execute()) {
            // Automatically login after signup
            return $this->login($username, $password);
        }

        return "Gagal mendaftar. Username atau Email mungkin sudah digunakan.";
    }
}

?>