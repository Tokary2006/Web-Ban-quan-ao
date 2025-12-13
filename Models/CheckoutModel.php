<?php

class CheckoutModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /* =========================
        ORDER
    ========================== */
    public function createOrder($user_id, $ship_address, $phone, $total_price, $payment_method, $note = null, $order_status = 0)
    {
        $sql = "
        INSERT INTO orders
        (
            user_id,
            order_code,
            ship_address,
            phone,
            total_price,
            payment_method,
            order_status,
            note,
            created_at,
            updated_at
        )
        VALUES
        (
            :user_id,
            :order_code,
            :ship_address,
            :phone,
            :total_price,
            :payment_method,
            :order_status,
            :note,
            NOW(),
            NULL
        )
        ";

        try {
            $stmt = $this->connection->prepare($sql);

            $order_code = 'ORD' . strtoupper(uniqid());

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':order_code', $order_code);
            $stmt->bindParam(':ship_address', $ship_address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':total_price', $total_price);
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->bindParam(':order_status', $order_status, PDO::PARAM_INT);
            $stmt->bindParam(':note', $note);

            if ($stmt->execute()) {
                return [
                    'order_id' => $this->connection->lastInsertId(),
                    'order_code' => $order_code
                ];
            }

            return false;

        } catch (PDOException $e) {
            error_log("CheckoutModel createOrderDetail: " . $e->getMessage());
            return false;
        }
    }

    /* =========================
        ORDER DETAIL
    ========================== */
    public function createOrderDetail($order_id, $product_id, $quantity, $price)
    {
        $sql = "
            INSERT INTO order_details
            (
                order_id,
                product_id,
                quantity,
                price
            )
            VALUES
            (
                :order_id,
                :product_id,
                :quantity,
                :price
            )
        ";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("CheckoutModel createOrderDetail: " . $e->getMessage());
            return false;
        }
    }
}
