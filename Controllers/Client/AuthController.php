<?php
require_once 'Models/UserModel.php';

class AuthControlller
{
    private $userModel;

    public function __construct($connection)
    {
        $this->userModel = new userModel($connection);
    }

    public function login()
    {
        unset($_SESSION['user']);
        if (isset($_SESSION['user'])) {
            header("location: index.php?page=home");
            return;
        }

        include "Views/Client/login.php";
    }

    public function handleLogin()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userModel->getOneUser($email);

        $_SESSION["old_email"] = $email;

        if ($user["active"] == 0) {
            $_SESSION["error"] = "Tài khoản bị vô hiệu hóa!";
            header("location: index.php?page=login");
            return;
        }
        
        if (empty($user) || !password_verify($password, $user["password"])) {
            $_SESSION["error"] = "Tài khoản hoặc mật khẩu của bạn không đúng!";
            header("location: index.php?page=login");
            return;
        } else {
            $_SESSION["user"] = $user;
            $_SESSION["success"] = "Chúc mừng " . $user["username"] . " đăng nhập thành công!";
            unset($_SESSION['old_email']);
            header("location: index.php?page=home");
            return;
        }
    }
}