<?php

class categoryModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Lấy tất cả danh mục từ cơ sở dữ liệu, sắp xếp theo ID để dễ quản lý.
     * @return array Mảng chứa tất cả danh mục.
     */
    public function getAllCategory($keyword = '', $limit = null, $sortDate = 'desc')
    {
        $search = '';

        if (trim($keyword) !== '') {
            $search = " WHERE name LIKE :keyword OR description LIKE :keyword ";
        } else {
            $search = " WHERE 1 ";
        }

        $query = "
        SELECT 
            id,
            parent_id,
            name,
            description,
            slug,
            status,
            created_at  -- Include created_at for sorting!
        FROM 
            categories
        $search
        ORDER BY created_at $sortDate
    ";

        if ($limit && $limit > 0) {
            $query .= " LIMIT :limit";
        }

        try {
            $stmt = $this->connection->prepare($query);

            if (trim($keyword) !== '') {
                $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
            }

            if ($limit && $limit > 0) {
                $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Lỗi khi lấy danh mục: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Lấy ID và Tên danh mục dựa trên Tên (để sử dụng ở frontend).
     * Rất quan trọng để khắc phục lỗi "Undefined array key 'name'".
     * @param string $name Tên danh mục (ví dụ: 'Nữ', 'Nam').
     * @return array|null Mảng chứa ['id', 'name'] hoặc null nếu không tìm thấy.
     */
    public function getCategoryDataByName($name)
    {
        $query = "SELECT id, name FROM categories WHERE name = :name LIMIT 1";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về MẢNG ['id' => X, 'name' => Y]

        } catch (PDOException $e) {
            error_log("Lỗi khi lấy dữ liệu danh mục theo tên: " . $e->getMessage());
            return null;
        }
    }

}