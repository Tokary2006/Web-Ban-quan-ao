<?php
class ProductCommentModel
{
    private $conn;
    private $table = "comment_products";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Lấy tất cả bình luận kèm tên sản phẩm và tên user
    public function getAll()
    {
        $sql = "SELECT pc.id, pc.product_id, pc.user_id, pc.content, pc.status, pc.created_at,
               p.title AS product_name,  
               u.full_name AS user_name
        FROM {$this->table} pc
        LEFT JOIN products p ON pc.product_id = p.id
        LEFT JOIN users u ON pc.user_id = u.id
        ORDER BY pc.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một bình luận
    public function getOne($id)
    {
        $sql = "SELECT pc.id, pc.product_id, pc.user_id, pc.content, pc.status, pc.created_at,
                   p.title AS product_name,
                   u.full_name AS user_name
            FROM {$this->table} pc
            LEFT JOIN products p ON pc.product_id = p.id
            LEFT JOIN users u ON pc.user_id = u.id
            WHERE pc.id = :id
            LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái bình luận
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    // Xóa bình luận
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
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
?>