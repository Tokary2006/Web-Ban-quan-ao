<?php
require_once 'Models/UserModel.php';
// require_once '../models/OrderModel.php';
require_once 'Models/AddressModel.php';

class ProfileController
{
    private $userModel;
    private $addressModel;
    public function __construct($connection)
    {
        $this->userModel = new UserModel($connection);
        $this->addressModel = new AddressModel($connection);

        if (!isset($_SESSION['user'])) {
            header("Location: /login.php");
            exit;
        }
    }

    /** -----------------------------------------------------
     *  Lấy dữ liệu trang Profile
     * -----------------------------------------------------*/
    public function index($errors = [], $oldData = [], $activeTab = 'account', $showAddForm = false)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->getOneUser($userId, 1);
        $addresses = $this->addressModel->getAddressesByUser($userId);
        $activeTab = $_GET['tab'] ?? $activeTab;

        include 'Views/Client/profile.php';
    }



    /** -----------------------------------------------------
     *  Cập nhật thông tin tài khoản
     * -----------------------------------------------------*/
    public function updateInfo()
    {
        $userId = $_SESSION['user']['id'];

        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');

        $errors = [];

        // VALIDATION
        if ($fullname === '') {
            $errors['fullname'] = "Họ tên không được để trống.";
        }
        if ($phone === '') {
            $errors['phone'] = "Số điện thoại không được để trống.";
        }
        if ($email === '') {
            $errors['email'] = "Email không được để trống.";
        }

        // VALIDATION ẢNH (Không dùng JS)
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== 4) {

            if ($_FILES['avatar']['error'] !== 0) {
                $errors['avatar'] = "Không thể upload ảnh.";
            } else {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));

                if (!in_array($extension, $allowed)) {
                    $errors['avatar'] = "Chỉ cho phép JPG, JPEG, PNG, GIF.";
                }
            }
        }

        // Nếu có lỗi → load lại trang kèm lỗi
        if (!empty($errors)) {
            $user = $this->userModel->getOneUser($userId, 1);
            include 'Views/Client/profile.php';
            return;
        }

        // XỬ LÝ UPLOAD ẢNH (nếu có)
        $avatarPath = null;

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            // Lấy avatar cũ từ database
            $oldAvatar = $this->userModel->getOneUser($userId, 1)['avatar'];

            // Nếu có avatar cũ → xoá file
            if (!empty($oldAvatar) && file_exists("Uploads/Avatars/" . $oldAvatar)) {
                unlink("Uploads/Avatars/" . $oldAvatar);
            }

            $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            $fileName = time() . "_" . $userId . "." . $extension;

            $uploadDir = "Uploads/Avatars/";
            $uploadFile = $uploadDir . $fileName;

            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

            $avatarPath = $fileName;
        }

        // Cập nhật DB
        $result = $this->userModel->updateUserInfo(
            $userId,
            $fullname,
            $phone,
            $email,
            $avatarPath
        );

        if ($result) {
            $_SESSION['user']['full_name'] = $fullname;
            $_SESSION['user']['phone'] = $phone;
            $_SESSION['user']['email'] = $email;

            if ($avatarPath) {
                $_SESSION['user']['avatar'] = $avatarPath;
            }

            $_SESSION['success'] = "Cập nhật tài khoản thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật thất bại!";
        }

        header("Location: index.php?page=profile");
    }

    /** -----------------------------------------------------
     *  Đổi mật khẩu
     * -----------------------------------------------------*/
    public function changePassword()
    {
        $userId = $_SESSION['user']['id'];
        $errors = [];

        $old = trim($_POST['old_password'] ?? '');
        $new = trim($_POST['new_password'] ?? '');
        $confirm = trim($_POST['confirm_password'] ?? '');

        // Lấy thông tin user
        $user = $this->userModel->getOneUser($userId, 1);

        // 1. Kiểm tra mật khẩu cũ
        if ($old === '') {
            $errors['old_password'] = "Vui lòng nhập mật khẩu cũ.";
        } elseif (!password_verify($old, $user['password'])) {
            $errors['old_password'] = "Mật khẩu cũ không đúng.";
        }

        // 2. Kiểm tra mật khẩu mới
        if ($new === '') {
            $errors['new_password'] = "Mật khẩu mới không được để trống.";
        } elseif (strlen($new) < 6) {
            $errors['new_password'] = "Mật khẩu mới phải ít nhất 6 ký tự.";
        } elseif ($new === $old) {
            $errors['new_password'] = "Mật khẩu mới không được giống mật khẩu cũ.";
        }

        // 3. Kiểm tra nhập lại mật khẩu mới
        if ($confirm === '') {
            $errors['confirm_password'] = "Vui lòng nhập lại mật khẩu mới.";
        } elseif ($new !== $confirm) {
            $errors['confirm_password'] = "Mật khẩu nhập lại không khớp.";
        }

        // Nếu có lỗi → load lại trang cùng thông báo
        if (!empty($errors)) {
            $user = $this->userModel->getOneUser($userId, 1);
            include 'Views/Client/profile.php';
            return;
        }

        // 4. Lưu password mới
        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $result = $this->userModel->updatePassword($userId, $hashed);

        if ($result) {
            $_SESSION['success'] = "Đổi mật khẩu thành công!";
        } else {
            $_SESSION['error'] = "Không thể thay đổi mật khẩu.";
        }

        header("Location: index.php?page=profile");
    }

    public function addAddress()
    {
        $userId = $_SESSION['user']['id'];

        $title = trim($_POST['title'] ?? '');
        $full_address = trim($_POST['full_address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $recipient_phone = trim($_POST['recipient_phone'] ?? '');

        $errors = [];
        $oldData = [
            'title' => $title,
            'full_address' => $full_address,
            'city' => $city,
            'recipient_phone' => $recipient_phone
        ];

        if ($title === '')
            $errors['title'] = "Tên địa chỉ không được để trống.";
        if ($city === '')
            $errors['city'] = "Thành phố không được để trống.";
        if ($full_address === '')
            $errors['full_address'] = "Địa chỉ chi tiết không được để trống.";
        if ($recipient_phone === '')
            $errors['recipient_phone'] = "Số điện thoại không được để trống.";

        if (!empty($errors)) {
            $showAddForm = true;
            $this->index($errors, $oldData, 'address', $showAddForm);
            return;
        }


        // Thêm địa chỉ vào DB
        $this->addressModel->addAddress($userId, $title, $full_address, $city, $recipient_phone);

        // Thành công → thông báo và vẫn ở tab address
        $_SESSION['success'] = "Thêm địa chỉ mới thành công!";
        header("Location: index.php?page=profile&tab=address");
        exit;
    }

    /** -----------------------------------------------------
     *  Cập nhật địa chỉ
     * -----------------------------------------------------*/
    public function updateAddress()
    {
        $userId = $_SESSION['user']['id'];
        $id = $_POST['id'] ?? null; // ID địa chỉ cần update
        $address_name = trim($_POST['address_name'] ?? '');
        $full_address = trim($_POST['full_address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $recipient_phone = trim($_POST['recipient_phone'] ?? '');

        $errors = [];
        $oldData = [
            'address_name' => $address_name,
            'full_address' => $full_address,
            'city' => $city,
            'recipient_phone' => $recipient_phone
        ];

        if (!$address_name)
            $errors['address_name'] = "Tên địa chỉ không được để trống.";
        if (!$city)
            $errors['city'] = "Thành phố không được để trống.";
        if (!$full_address)
            $errors['full_address'] = "Địa chỉ chi tiết không được để trống.";
        if (!$recipient_phone)
            $errors['recipient_phone'] = "Số điện thoại không được để trống.";

        if (!empty($errors)) {
            // Load lại profile tab address kèm lỗi
            $this->index($errors, $oldData, 'address');
            return;
        }

        // Cập nhật địa chỉ
        $this->addressModel->updateAddress($id, $address_name, $full_address, $city, $recipient_phone);

        $_SESSION['success'] = "Cập nhật địa chỉ thành công!";
        header("Location: index.php?page=profile&tab=address");
        exit;
    }

    /** -----------------------------------------------------
     *  Xóa địa chỉ
     * -----------------------------------------------------*/
    public function deleteAddress()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->addressModel->deleteAddress($id);
            $_SESSION['success'] = "Xóa địa chỉ thành công!";
        } else {
            $_SESSION['error'] = "Địa chỉ không tồn tại!";
        }

        header("Location: index.php?page=profile&tab=address");
        exit;
    }

}

