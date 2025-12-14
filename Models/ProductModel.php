<?php

class ProductModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Lấy danh sách sản phẩm với phân trang, tìm kiếm và sắp xếp.
     * @param mixed $page số trang
     * @param mixed $limit lấy bao nhiêu sản phẩm mỗi trang
     * @param mixed $keyword từ khóa tìm kiếm
     * @param mixed $status trạng thái ẩn hoặc hiện
     * @param int|null $categoryId ID danh mục
     * @param string $sortBy cột để sắp xếp ('name' , 'price' hoặc 'date')
     * @param string $sortOrder thứ tự sắp xếp ('asc' hoặc 'desc')
     */
    public function getAllProducts(
        $page = 1,
        $limit = 10,
        $keyword = '',
        $status = null,
        $categoryId = null,
        $featuredId = null,
        $sortBy = 'date',
        $sortOrder = 'desc',
    ) {
        $page = max(1, (int) $page);
        $limit = max(1, (int) $limit);
        $offset = ($page - 1) * $limit;

        $search = '';

        if (trim($keyword) !== '') {
            $search = " WHERE p.`title` LIKE :keyword OR p.`description` LIKE :keyword ";
        } else {
            $search = " WHERE 1 ";
        }

        if ($categoryId !== null && (int) $categoryId > 0) {
            $search .= " AND p.`category_id` = :categoryId ";
        }

        if ($status !== null) {
            $search .= " AND p.`status` = :status ";
        }

        if ($featuredId !== null) {
            $search .= " AND p.`featured_id` = :featuredId ";
        }

        $orderBy = '';
        $safeSortOrder = ($sortOrder === 'asc' || $sortOrder === 'desc') ? $sortOrder : 'DESC';

        switch ($sortBy) {
            case 'title':
                $orderBy = " ORDER BY p.`title` $safeSortOrder ";
                break;
            case 'price':
                $orderBy = " ORDER BY COALESCE(p.`discount_price`, p.`price`) $safeSortOrder ";
                break;
            case 'date':
            default:
                $orderBy = " ORDER BY p.`created_at` $safeSortOrder ";
                break;
        }

        $query = "
                SELECT p.* FROM products p
                $search
                $orderBy 
                LIMIT :limit OFFSET :offset
            ";

        $stmt = $this->connection->prepare($query);

        if ($status !== null) {
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        }
        if (trim($keyword) !== '') {
            $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        }
        if ($categoryId !== null && (int) $categoryId > 0) {
            $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        }
        if ($featuredId !== null) {
            $stmt->bindValue(':featuredId', $featuredId, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tổng số trang cần thiết cho danh sách sản phẩm.
     * Hàm này đếm TẤT CẢ sản phẩm (status=1) và chia cho $limit.
     * @param int $limit Số sản phẩm tối đa mỗi trang (Mặc định là 10 nếu không truyền vào).
     * @param int|null $categoryId ID danh mục để lọc sản phẩm (Nếu null, đếm tất cả sản phẩm).
     * @return int Tổng số trang.
     */
    public function getProductById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getOne($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getTotalProductCount(int $limit = 10, $categoryId = null, $keyword = '', $status = null): int
    {
        $search = '';

        if (trim($keyword) !== '') {
            $search = " WHERE p.`title` LIKE :keyword OR p.`description` LIKE :keyword ";
        } else {
            $search = " WHERE 1 ";
        }

        if ($categoryId !== null) {
            $search .= " AND p.category_id = :category_id";
        }

        if ($status !== null) {
            $search .= " AND p.`status` = :status ";
        }

        $query = "
                SELECT COUNT(*) AS total
                FROM products p
                $search 
            ";

        try {
            $stmt = $this->connection->prepare($query);

            if ($status !== null) {
                $stmt->bindValue(':status', $status, PDO::PARAM_INT);
            }
            if (trim($keyword) !== '') {
                $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
            }
            if ($categoryId !== null && (int) $categoryId > 0) {
                $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
            }

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalCount = (int) $result['total'];

            if ($totalCount === 0) {
                return 1;
            }

            $safeLimit = ($limit > 0) ? $limit : 10;
            $totalPages = (int) ceil($totalCount / $safeLimit);

            return $totalPages;

        } catch (PDOException $e) {
            error_log("Lỗi khi đếm tổng sản phẩm: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Lấy thông tin chi tiết của một sản phẩm dựa trên slug.
     * @param string $slug Slug của sản phẩm.
     * @param mixed $status Trạng thái sản phẩm (ví dụ: 1 cho hiển thị). Mặc định là null (lấy tất cả).
     * @return array|false Thông tin sản phẩm hoặc false nếu không tìm thấy.
     */
    /** * Lấy thông tin chi tiết của một sản phẩm dựa trên slug. * @param string $slug Slug của sản phẩm. * @param mixed $status Trạng thái sản phẩm (ví dụ: 1 cho hiển thị). Mặc định là null (lấy tất cả). * @return array|false Thông tin sản phẩm hoặc false nếu không tìm thấy. */
    public function getProductBySlug(string $slug, $status = 1)
    {
        $queryProduct = " SELECT p.* FROM products p WHERE p.slug = :slug ";
        if ($status !== null) {
            $queryProduct .= " AND p.status = :status ";
        }
        $stmt = $this->connection->prepare($queryProduct);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        if ($status !== null) {
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        }
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;
    }

    // Kiểm tra trùng tên (trừ chính nó)
    public function checkDuplicateTitle($title, $id = null)
    {
        if ($id) {
            $sql = "SELECT id FROM products WHERE title = :title AND id != :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':title' => $title, ':id' => $id]);
        } else {
            $sql = "SELECT id FROM products WHERE title = :title";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':title' => $title]);
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo sản phẩm
    public function create($data)
    {
        $sql = "INSERT INTO products
            (category_id, title, slug, stock, price, discount_price, short_description, description, image, status, featured_id, created_at, updated_at)
            VALUES (:category_id, :title, :slug, :stock, :price, :discount_price, :short_description, :description, :image, :status, :featured_id, NOW(), NULL)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':discount_price', $data['discount_price']);
        $stmt->bindParam(':short_description', $data['short_description'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);
        $stmt->bindParam(':featured_id', $data['featured_id'], PDO::PARAM_INT);

        return $stmt->execute();
    }


    // Cập nhật sản phẩm
    public function updateProduct($id, $data)
    {
        $sql = "UPDATE products SET 
            category_id = :category_id,
            title = :title,
            slug = :slug,
            stock = :stock,
            price = :price,
            discount_price = :discount_price,
            short_description = :short_description,
            description = :description,
            image = :image,
            status = :status,
            featured_id = :featured_id,
            updated_at = NOW()
        WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':discount_price', $data['discount_price']);
        $stmt->bindParam(':short_description', $data['short_description'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);
        $stmt->bindParam(':featured_id', $data['featured_id'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Xoá sản phẩm
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Kiểm tra slug đã tồn tại hay chưa (trừ chính sản phẩm hiện tại nếu $id khác null)
    public function checkDuplicateSlug($slug, $id = null)
    {
        if ($id) {
            $sql = "SELECT id FROM products WHERE slug = :slug AND id != :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':slug' => $slug, ':id' => $id]);
        } else {
            $sql = "SELECT id FROM products WHERE slug = :slug";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':slug' => $slug]);
        }

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }


    // Lấy tồn kho (hiển thị, kiểm tra giỏ hàng)
    public function getProductStock($product_id)
    {
        $stmt = $this->connection->prepare(
            "SELECT stock FROM products WHERE id = :id"
        );
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);

        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    // Trừ tồn kho (chỉ dùng khi checkout)
    public function decreaseStock($product_id, $quantity)
    {
        // Trừ tồn kho nếu đủ
        $sql = "
        UPDATE products
        SET stock = stock - :qty
        WHERE id = :id AND stock >= :qty
    ";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':qty', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() !== 1) {
            return false;
        }

        $this->updateStatus($product_id);

        return true;
    }

    private function updateStatus($product_id)
    {
        $sql = "
        UPDATE products
        SET status = 0, updated_at = NOW()
        WHERE id = :id AND stock = 0
    ";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
    }


}
