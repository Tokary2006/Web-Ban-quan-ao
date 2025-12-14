<?php
require_once 'Models/UserModel.php';
require_once 'Models/OrderModel.php';
require_once 'Models/AddressModel.php';

class ProfileController
{
    private $userModel;
    private $orderModel;
    private $addressModel;

    public function __construct($connection)
    {
        $this->userModel = new UserModel($connection);
        $this->orderModel = new OrderModel($connection);
        $this->addressModel = new AddressModel($connection);

        if (!isset($_SESSION['user'])) {
            header("Location: /login.php");
            exit;
        }
    }

    public function index($errors = [], $oldData = [], $activeTab = 'account', $showAddForm = false)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->getOneUser($userId, 1);
        $addresses = $this->addressModel->getAddressesByUser($userId);
        $orders = $this->orderModel->getAllOrdersByUser($userId);
        $activeTab = $_GET['tab'] ?? $activeTab;

        include 'Views/Client/profile.php';
    }

    public function updateInfo()
    {
        $userId = $_SESSION['user']['id'];
        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $errors = [];

        if ($fullname === '')
            $errors['fullname'] = "Họ tên không được để trống.";
        if ($phone === '')
            $errors['phone'] = "Số điện thoại không được để trống.";
        if ($email === '')
            $errors['email'] = "Email không được để trống.";

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $oldImage = $this->userModel->getOneUser($userId, 1)['image'];
            if (!empty($oldImage) && file_exists("Uploads/Avatars/" . $oldImage)) {
                unlink("Uploads/Avatars/" . $oldImage);
            }

            $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            $fileName = time() . "_" . $userId . "." . $extension;
            move_uploaded_file($_FILES['avatar']['tmp_name'], "Uploads/Avatars/" . $fileName);
            $avatarPath = $fileName;
        }

        if (!empty($errors)) {
            $user = $this->userModel->getOneUser($userId, 1);
            include 'Views/Client/profile.php';
            return;
        }

        $avatarPath = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $oldAvatar = $this->userModel->getOneUser($userId, 1)['avatar'];
            if (!empty($oldAvatar) && file_exists("Uploads/Avatars/" . $oldAvatar)) {
                unlink("Uploads/Avatars/" . $oldAvatar);
            }
            $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            $fileName = time() . "_" . $userId . "." . $extension;
            move_uploaded_file($_FILES['avatar']['tmp_name'], "Uploads/Avatars/" . $fileName);
            $avatarPath = $fileName;
        }

        $result = $this->userModel->updateUserInfo($userId, $fullname, $phone, $email, $avatarPath);

        if ($result) {
            $_SESSION['user']['full_name'] = $fullname;
            $_SESSION['user']['phone'] = $phone;
            $_SESSION['user']['email'] = $email;
            if ($avatarPath)
                $_SESSION['user']['avatar'] = $avatarPath;
            $_SESSION['success'] = "Cập nhật tài khoản thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật thất bại!";
        }

        header("Location: index.php?page=profile");
        exit;
    }

    public function changePassword()
    {
        $userId = $_SESSION['user']['id'];
        $errors = [];

        $old = trim($_POST['old_password'] ?? '');
        $new = trim($_POST['new_password'] ?? '');
        $confirm = trim($_POST['confirm_password'] ?? '');

        $user = $this->userModel->getOneUser($userId, 1);

        if ($old === '')
            $errors['old_password'] = "Vui lòng nhập mật khẩu cũ.";
        elseif (!password_verify($old, $user['password']))
            $errors['old_password'] = "Mật khẩu cũ không đúng.";

        if ($new === '')
            $errors['new_password'] = "Mật khẩu mới không được để trống.";
        elseif (strlen($new) < 6)
            $errors['new_password'] = "Mật khẩu mới phải ít nhất 6 ký tự.";
        elseif ($new === $old)
            $errors['new_password'] = "Mật khẩu mới không được giống mật khẩu cũ.";

        if ($confirm === '')
            $errors['confirm_password'] = "Vui lòng nhập lại mật khẩu mới.";
        elseif ($new !== $confirm)
            $errors['confirm_password'] = "Mật khẩu nhập lại không khớp.";

        if (!empty($errors)) {
            $user = $this->userModel->getOneUser($userId, 1);
            include 'Views/Client/profile.php';
            return;
        }

        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $result = $this->userModel->updatePassword($userId, $hashed);

        if ($result)
            $_SESSION['success'] = "Đổi mật khẩu thành công!";
        else
            $_SESSION['error'] = "Không thể thay đổi mật khẩu.";

        header("Location: index.php?page=profile");
        exit;
    }

    public function addAddress()
    {
        $userId = $_SESSION['user']['id'];

        $title = trim($_POST['title'] ?? '');
        $full_address = trim($_POST['full_address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $recipient_phone = trim($_POST['recipient_phone'] ?? '');

        $errors = [];
        $oldData = ['title' => $title, 'full_address' => $full_address, 'city' => $city, 'recipient_phone' => $recipient_phone];

        if ($title === '')
            $errors['title'] = "Tên địa chỉ không được để trống.";
        if ($city === '')
            $errors['city'] = "Thành phố không được để trống.";
        if ($full_address === '')
            $errors['full_address'] = "Địa chỉ chi tiết không được để trống.";
        if ($recipient_phone === '')
            $errors['recipient_phone'] = "Số điện thoại không được để trống.";

        if (!empty($errors)) {
            $this->index($errors, $oldData, 'address', true);
            return;
        }

        $this->addressModel->addAddress($userId, $title, $full_address, $city, $recipient_phone);

        $_SESSION['success'] = "Thêm địa chỉ mới thành công!";
        header("Location: index.php?page=profile&tab=address");
        exit;
    }

    public function updateAddress()
    {
        $userId = $_SESSION['user']['id'];
        $id = $_POST['id'] ?? null;
        $address_name = trim($_POST['address_name'] ?? '');
        $full_address = trim($_POST['full_address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $recipient_phone = trim($_POST['recipient_phone'] ?? '');

        $errors = [];
        $oldData = ['address_name' => $address_name, 'full_address' => $full_address, 'city' => $city, 'recipient_phone' => $recipient_phone];

        if (!$address_name)
            $errors['address_name'] = "Tên địa chỉ không được để trống.";
        if (!$city)
            $errors['city'] = "Thành phố không được để trống.";
        if (!$full_address)
            $errors['full_address'] = "Địa chỉ chi tiết không được để trống.";
        if (!$recipient_phone)
            $errors['recipient_phone'] = "Số điện thoại không được để trống.";

        if (!empty($errors)) {
            $this->index($errors, $oldData, 'address');
            return;
        }

        $this->addressModel->updateAddress($id, $address_name, $full_address, $city, $recipient_phone);

        $_SESSION['success'] = "Cập nhật địa chỉ thành công!";
        header("Location: index.php?page=profile&tab=address");
        exit;
    }

    public function deleteAddress()
    {
        $userId = $_SESSION['user']['id'];
        $id = $_POST['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Địa chỉ không tồn tại!";
            header("Location: index.php?page=profile&tab=address");
            exit;
        }

        $this->addressModel->deleteAddress($id, $userId);

        $_SESSION['success'] = "Xóa địa chỉ thành công!";
        header("Location: index.php?page=profile&tab=address");
        exit;
    }

    public function confirmReceived()
    {
        $userId = $_SESSION['user']['id'];
        $order_id = $_POST['order_id'] ?? null;

        if (!$order_id) {
            $_SESSION['error'] = "Đơn hàng không tồn tại!";
            header("Location: index.php?page=profile&tab=orders");
            exit;
        }

        $order = $this->orderModel->getOrder($order_id, $userId);
        if (!$order) {
            $_SESSION['error'] = "Đơn hàng không thuộc quyền của bạn!";
            header("Location: index.php?page=profile&tab=orders");
            exit;
        }

        if ($order['order_status'] != 1) {
            $_SESSION['error'] = "Không thể cập nhật trạng thái này!";
            header("Location: index.php?page=profile&tab=orders");
            exit;
        }

        $this->orderModel->updateStatus($order_id, 2);
        $_SESSION['success'] = "Xác nhận đã nhận hàng thành công!";
        header("Location: index.php?page=profile&tab=orders");
        exit;
    }

    public function orderDetail()
    {
        $userId = $_SESSION['user']['id'];
        $order_id = $_GET['id'] ?? null;

        if (!$order_id) {
            $_SESSION['error'] = "Đơn hàng không tồn tại!";
            header("Location: index.php?page=profile&tab=orders");
            exit;
        }

        $order = $this->orderModel->getOrder($order_id, $userId);
        $orderItems = $this->orderModel->getItems($order_id);

        require "Views/Client/order-detail.php";
    }

}
