<?php

class CommentProductModel
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getByProduct($productId)
    {
        $sql = "SELECT c.*, u.full_name, u.image
          FROM comment_products c
          JOIN users u ON c.user_id = u.id
          WHERE c.product_id = :pid
          AND c.status = 1
          ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':pid' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($productId, $userId, $content)
    {
        $sql = "INSERT INTO comment_products (product_id, user_id, content, status, created_at)
          VALUES (:pid, :uid, :content, 0, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':pid' => $productId,
            ':uid' => $userId,
            ':content' => $content
        ]);
    }

    public function approve($id)
    {
        $sql = "UPDATE comment_products SET status = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function hasPurchased($productId, $userId)
    {
        $sql = "SELECT COUNT(*) 
            FROM orders o
            JOIN order_details oi ON o.id = oi.order_id
            WHERE o.user_id = :uid
            AND oi.product_id = :pid
            AND o.order_status = 2";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':uid' => $userId,
            ':pid' => $productId
        ]);

        return $stmt->fetchColumn() > 0;
    }

}
