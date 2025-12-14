<?php
class ProductCommentModel {
    private $conn;
    private $table = "comment_products";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy tất cả bình luận kèm tên sản phẩm và tên user
    public function getAll() {
   $sql = "SELECT pc.id, pc.product_id, pc.user_id, pc.content, pc.created_at,
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
 public function getOne($id) {
    $sql = "SELECT pc.id, pc.product_id, pc.user_id, pc.content, pc.created_at,
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


    // Cập nhật nội dung bình luận
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET content = :content WHERE id = :id");
        return $stmt->execute([
            'content' => $data['content'],
            'id' => $id
        ]);
    }

    // Xóa bình luận
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
