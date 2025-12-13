<?php

require_once 'Models/CartModel.php';
require_once 'Models/AddressModel.php';
require_once 'Models/CheckoutModel.php';
require_once 'Models/OrderModel.php';

class CheckoutController
{
    private $cartModel;
    private $addressModel;
    private $checkoutModel;
    private $orderModel;

    public function __construct($connection)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $this->cartModel = new CartModel($connection);
        $this->addressModel = new AddressModel($connection);
        $this->checkoutModel = new CheckoutModel($connection);
        $this->orderModel = new OrderModel($connection);
    }

    // HIỂN THỊ CHECKOUT
    public function index()
    {
        $user_id = $_SESSION['user']['id'];

        $cartItems = $this->cartModel->getAllCart($user_id, 1, 1000);
        if (empty($cartItems)) {
            header("Location: index.php?page=error");
            exit;
        }

        $addresses = $this->addressModel->getAddressesByUser($user_id);

        $total = 0;
        foreach ($cartItems as $item) {
            $price = $item['discount_price'] ?? $item['price'];
            $total += $price * $item['quantity'];
        }

        require "Views/Client/checkout.php";
    }

    // ĐẶT HÀNG
    public function placeOrder()
    {
        $user_id = $_SESSION['user']['id'];
        $errors = [];

        $address_type = $_POST['address_type'] ?? 'saved';
        $payment_method = $_POST['payment_method'] ?? 'cod';
        $note = trim($_POST['note'] ?? '');

        if ($address_type === 'saved') {
            $address_id = (int) ($_POST['saved_address_id'] ?? 0);
            if ($address_id <= 0) {
                $errors['saved_address_id'] = "Vui lòng chọn địa chỉ giao hàng";
            } else {
                $address = $this->addressModel->getAddressById($address_id);
                if (!$address) {
                    $errors['saved_address_id'] = "Địa chỉ không tồn tại";
                } else {
                    $ship_address = $address['full_address'] . ', ' . $address['city'];
                    $phone = $address['recipient_phone'];
                }
            }
        } else {
            $phone = trim($_POST['new_phone'] ?? '');
            $address_text = trim($_POST['new_address'] ?? '');
            $city = trim($_POST['new_city'] ?? '');

            if (!$phone)
                $errors['new_phone'] = "Vui lòng nhập số điện thoại";
            if (!$address_text)
                $errors['new_address'] = "Vui lòng nhập địa chỉ";
            if (!$city)
                $errors['new_city'] = "Vui lòng nhập thành phố";

            $ship_address = $address_text . ', ' . $city;
        }

        $cartItems = $this->cartModel->getAllCart($user_id, 1, 1000);
        if (empty($cartItems)) {
            $errors['cart'] = "Giỏ hàng trống";
        }

        // Nếu có lỗi, hiển thị lại form với dữ liệu cũ
        if (!empty($errors)) {
            $addresses = $this->addressModel->getAddressesByUser($user_id);
            $total = 0;
            foreach ($cartItems as $item) {
                $price = $item['discount_price'] ?? $item['price'];
                $total += $price * $item['quantity'];
            }
            require "Views/Client/checkout.php";
            return;
        }

        // Không có lỗi, tiến hành tạo order
        $total = 0;
        foreach ($cartItems as $item) {
            $price = $item['discount_price'] ?? $item['price'];
            $total += $price * $item['quantity'];
        }

        $result = $this->checkoutModel->createOrder(
            $user_id,
            $ship_address,
            $phone,
            $total,
            $payment_method,
            $note
        );

        if (!$result) {
            $errors['create_order'] = "Không thể tạo đơn hàng";
            $addresses = $this->addressModel->getAddressesByUser($user_id);
            require "Views/Client/checkout.php";
            return;
        }

        $order_id = $result['order_id'];
        $order_code = $result['order_code'];

        foreach ($cartItems as $item) {
            $price = $item['discount_price'] ?? $item['price'];
            $this->checkoutModel->createOrderDetail(
                $order_id,
                $item['product_id'],
                $item['quantity'],
                $price
            );
        }

        foreach ($cartItems as $item) {
            $this->cartModel->removeFromCart($item['cart_item_id']);
        }

        header("Location: index.php?page=thankyou&order_code=$order_code");
        exit;
    }



    public function thankyou()
    {
        $user_id = $_SESSION['user']['id'];
        $order_code = $_GET['order_code'] ?? null;

        if (!$order_code) {
            header("Location: index.php?page=error");
            exit;
        }

        $order = $this->orderModel->getOrderByCode($order_code, $user_id);

        if (!$order) {
            header("Location: index.php?page=error");
            exit;
        }

        require "Views/Client/thankyou.php";
    }

}
