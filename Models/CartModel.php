<?php

class CartModel
{
    private $connection;
    private $table = 'cart'; // Thêm tên bảng để dễ quản lý

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Lấy các mục trong giỏ hàng của một người dùng cụ thể, hỗ trợ phân trang.
     *
     * @param int $userId ID của người dùng.
     * @param int $page Trang hiện tại (Mặc định: 1).
     * @param int $limit Số lượng mục trên mỗi trang (Mặc định: 10).
     * @return array Danh sách các mục trong giỏ hàng.
     */
    public function getAllCart(int $user_id, int $page = 1, int $limit = 10)
    {
        $page = max(1, $page);
        $limit = max(1, $limit);
        $offset = ($page - 1) * $limit;

        $query = "
            SELECT 
                c.id AS id, 
                c.quantity AS cart_quantity,
                c.created_at AS created_at,
                
                u.id AS user_id,
                u.email AS user_email,
                u.full_name AS user_fullname,
                
                p.title AS product_title, 
                p.price AS product_price,
                p.image as product_image,
                
                pv.id AS variant_id, 
                pv.sku_id,
                pv.additional_price,
                pv.discount_price,
                pv.quantity AS variant_stock
                
            FROM cart c
            JOIN product_variants pv ON c.variant_id = pv.id
            JOIN products p ON pv.product_id = p.id
            JOIN users u ON c.user_id = u.id
            WHERE c.user_id = :user_id 
            ORDER BY c.created_at DESC
            LIMIT :limit OFFSET :offset
        ";

        try {
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database Error in getAllCart: " . $e->getMessage());
            return [];
        }
    }
}