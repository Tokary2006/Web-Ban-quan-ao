<?php
class OrderModel
{
    private $conn;
    private $table = "orders";

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Lấy danh sách đơn hàng
    public function getAll()
    {
        $sql = "SELECT 
                    id,
                    user_id,
                    order_code,
                    ship_address,
                    total_price,
                    payment_method,
                    order_status,
                    created_at
                FROM orders
                ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 đơn hàng
    public function find($id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllOrdersByUser($userId)
    {
        $sql = "SELECT 
                id,
                order_code,
                ship_address,
                total_price,
                payment_method,
                order_status,
                created_at
            FROM orders
            WHERE user_id = :user_id
            ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết đơn hàng
    public function getOrderDetails($orderId)
    {
        $sql = "
            SELECT 
                od.*,
                p.title AS product_name
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = :order_id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE STATUS
    public function updateStatus($orderId, $status)
    {
        $sql = "UPDATE orders 
            SET order_status = :status, updated_at = NOW()
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'status' => $status,
            'id' => $orderId
        ]);
    }

    public function getOrder($identifier, $userId, $by = 'id')
    {
        if ($by === 'code') {
            $sql = "SELECT *
                FROM orders
                WHERE order_code = :identifier AND user_id = :user_id
                LIMIT 1";
        } else {
            $sql = "SELECT *
                FROM orders
                WHERE id = :identifier AND user_id = :user_id
                LIMIT 1";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'identifier' => $identifier,
            'user_id' => $userId
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getItems($orderId)
    {
        $sql = "SELECT od.*, p.title, p.image
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = :oid";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(params: [':oid' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
