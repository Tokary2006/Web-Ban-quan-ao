<?php

class CartModel
{
    private $connection;
    private $table = 'cart';

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
                c.id as cart_item_id, 
                c.user_id, 
                c.product_id, 
                c.quantity, 
                p.title, 
                p.price, 
                p.discount_price, 
                p.image,
                p.stock
            FROM 
                {$this->table} c
            JOIN 
                products p ON c.product_id = p.id
            WHERE 
                c.user_id = :user_id
            ORDER BY 
                c.created_at DESC
            LIMIT :limit OFFSET :offset
        ";

        try {
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database Error in getAllCart: " . $e->getMessage());
            return [];
        }
    }

    // --- Bắt đầu hàm mới: addToCart ---

    /**
     * Thêm một sản phẩm vào giỏ hàng hoặc cập nhật số lượng nếu nó đã tồn tại.
     *
     * @param int $user_id ID của người dùng.
     * @param int $product_id ID của sản phẩm.
     * @param int $quantity Số lượng muốn thêm (Mặc định: 1).
     * @return bool True nếu thành công, False nếu thất bại.
     */
    public function addToCart(int $user_id, int $product_id, int $quantity = 1): bool
    {
        $check_query = "
            SELECT 
                id, quantity 
            FROM 
                {$this->table}
            WHERE 
                user_id = :user_id AND product_id = :product_id
            LIMIT 1
        ";

        try {
            $check_stmt = $this->connection->prepare($check_query);
            $check_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $check_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $check_stmt->execute();
            $cart_item = $check_stmt->fetch(PDO::FETCH_ASSOC);

            if ($cart_item) {
                $new_quantity = $cart_item['quantity'] + $quantity;

                $update_query = "
                    UPDATE 
                        {$this->table}
                    SET 
                        quantity = :quantity
                    WHERE 
                        id = :id
                ";

                $update_stmt = $this->connection->prepare($update_query);
                $update_stmt->bindParam(':quantity', $new_quantity, PDO::PARAM_INT);
                $update_stmt->bindParam(':id', $cart_item['id'], PDO::PARAM_INT);

                return $update_stmt->execute();
            } else {
                $insert_query = "
                    INSERT INTO 
                        {$this->table} 
                        (user_id, product_id, quantity, created_at)
                    VALUES 
                        (:user_id, :product_id, :quantity, NOW())
                ";

                $insert_stmt = $this->connection->prepare($insert_query);
                $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

                return $insert_stmt->execute();
            }
        } catch (PDOException $e) {
            error_log("Database Error in addToCart: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Xóa một mục khỏi giỏ hàng dựa trên cart_item_id.
     *
     * @param int $cart_item_id ID của mục trong giỏ hàng.
     * @return bool True nếu xóa thành công, False nếu thất bại.
     */
    public function removeFromCart(int $cart_item_id): bool
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $cart_item_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Error in removeFromCart: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật số lượng cho một mục trong giỏ hàng.
     *
     * @param int $cart_item_id ID của mục trong giỏ hàng.
     * @param int $quantity Số lượng mới (>=1).
     * @return bool True nếu cập nhật thành công, False nếu thất bại.
     */
    public function updateQuantity(int $cart_item_id, int $quantity): bool
    {
        $quantity = max(1, $quantity); 
        $query = "UPDATE {$this->table} SET quantity = :quantity WHERE id = :id";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':id', $cart_item_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Error in updateQuantity: " . $e->getMessage());
            return false;
        }
    }

}

