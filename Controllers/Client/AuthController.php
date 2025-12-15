<?php
require_once 'Models/UserModel.php';

class AuthController
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
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if (empty($email) || empty($password)) {
            $_SESSION["error"] = "Vui lòng nhập đầy đủ Email và Mật khẩu!";
            $_SESSION["old_email"] = $email;
            header("location: index.php?page=login");
            return;
        }

        $user = $this->userModel->getOneUser($email);

        if (empty($user) || !password_verify($password, $user["password"])) {
            $_SESSION["error"] = "Tài khoản hoặc mật khẩu của bạn không đúng!";
            header("location: index.php?page=login");
            return;
        }

        if ($user["active"] == 0) {
            $_SESSION["error"] = "Tài khoản bị vô hiệu hóa!";
            header("location: index.php?page=login");
            return;
        }

        $_SESSION["user"] = $user;
        $_SESSION["success"] = "Chúc mừng " . $user["username"] . " đăng nhập thành công!";
        unset($_SESSION["old_email"]);
        header("location: index.php?page=home");
    }


    public function register()
    {
        unset($_SESSION['user']);
        if (isset($_SESSION['user'])) {
            header("location: index.php?page=home");
            return;
        }

        include "Views/Client/register.php";
    }

    public function handleRegister()
    {
        $errors = [];

        $fullname = trim($_POST["fullname"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");
        $confirmPassword = trim($_POST["confirm_password"] ?? "");

        $_SESSION["old"] = compact("fullname", "email");

        if ($fullname === "") {
            $errors["fullname"] = "Họ và tên không được để trống";
        }

        if ($email === "") {
            $errors["email"] = "Email không được để trống";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email không hợp lệ";
        } elseif ($this->userModel->getOneUser($email)) {
            $errors["email"] = "Email đã tồn tại";
        }

        if ($password === "") {
            $errors["password"] = "Mật khẩu không được để trống";
        }

        if ($confirmPassword === "") {
            $errors["confirm_password"] = "Vui lòng xác nhận mật khẩu";
        } elseif ($password !== $confirmPassword) {
            $errors["confirm_password"] = "Mật khẩu xác nhận không khớp";
        }

        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            header("location: index.php?page=register");
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $this->userModel->createUser($fullname, $passwordHash, $email, 1);

        $_SESSION["success"] = "Đăng ký thành công, vui lòng đăng nhập!";
        header("location: index.php?page=login");
    }

}