<?php
require_once "Models/UserModel.php";
class UserController
{
    private $UserModel;

    public function __construct($connection)
    {
        $this->UserModel = new UserModel($connection);
    }
    public function index()
    {
        $users = $this->UserModel->getAllUsers();
        include "Views/Admin/User/index.php";
    }
    public function store()
    {
        include "Views/Admin/User/edit.php";
    }
    public function create()
    {
        include "Views/Admin/User/create.php";
    }

    public function profile()
{
    $id = $_GET['id'] ?? null;
    if (!$id) exit('Thiếu ID');

    $user = $this->UserModel->getOne($id);
    if (!$user) exit('User không tồn tại');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $active = $_POST['active'];

        $this->UserModel->updateStatus($id, $active);

        header("Location: admin.php?page=user&action=index.php");
        exit;
    }

    require "Views/Admin/User/profile.php";
}
}
?>