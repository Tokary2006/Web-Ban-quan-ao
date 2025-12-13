<?php
require_once "Models/OrderModel.php";

class OrderController {
    private $orderModel;

    public function __construct($connection) {
        $this->orderModel = new OrderModel($connection);
    }

    public function index() {
        $orders = $this->orderModel->getAll();
        include "Views/Admin/Order/index.php";
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: admin.php?page=order");
            exit;
        }

        $id = $_GET['id'];
        $order = $this->orderModel->find($id);
        $orderDetails = $this->orderModel->getOrderDetails($id);

        include "Views/Admin/Order/edit.php";
    }

    // UPDATE STATUS
    public function update_status() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: admin.php?page=order");
            exit;
        }

        $orderId = $_POST['order_id'];
        $status  = $_POST['order_status'];

        $this->orderModel->updateStatus($orderId, $status);

       header("Location: admin.php?page=order");
exit;

    }
}
