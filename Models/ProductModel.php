    <?php

    class productModel
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
            $limit = 50,
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
            if (!$product) {
                return false;
            }
            $queryVariants = " SELECT pv.id AS variant_id, pv.sku_id, pv.quantity, pv.additional_price 
                                FROM product_variants pv 
                                WHERE pv.product_id = :product_id ";
            $stmtVar = $this->connection->prepare($queryVariants);
            $stmtVar->bindValue(':product_id', $product['id'], PDO::PARAM_INT);
            $stmtVar->execute();
            $variants = $stmtVar->fetchAll(PDO::FETCH_ASSOC);
            foreach ($variants as &$variant) {
                $queryOptions = " SELECT o.option_name AS option_name, ov.value_name AS option_value 
                                    FROM variant_values vv 
                                    JOIN option_values ov ON ov.value_id = vv.value_id 
                                    JOIN options o ON o.option_id = ov.option_id 
                                    WHERE vv.variant_id = :variant_id ";
                $stmtOpt = $this->connection->prepare($queryOptions);
                $stmtOpt->bindValue(':variant_id', $variant['variant_id'], PDO::PARAM_INT);
                $stmtOpt->execute();
                $variant['options'] = $stmtOpt->fetchAll(PDO::FETCH_ASSOC);
            }
            $product['variants'] = $variants;
            return $product;
        }
        public function updateProduct($id, $data) {
            $sql = "UPDATE products SET 
                        category_id = :category_id,
                        title = :title,
                        slug = :slug,
                        price = :price,
                        short_description = :short_description,
                        description = :description,
                        image = :image,
                        status = :status
                    WHERE id = :id";
        
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute($data);
        }
        
        public function getAllCategories() {
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($data)
{
    $sql = "INSERT INTO products 
            (category_id, title, slug, price, short_description, description, image, status)
            VALUES 
            (:category_id, :title, :slug, :price, :short_description, :description, :image, :status)";

    $stmt = $this->connection->prepare($sql);
    return $stmt->execute([
        ':category_id' => $data['category_id'],
        ':title' => $data['title'],
        ':slug' => $data['slug'],
        ':price' => $data['price'],
        ':short_description' => $data['short_description'],
        ':description' => $data['description'],
        ':image' => $data['image'],
        ':status' => $data['status'],
    ]);
}
public function deleteProduct($id) {
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $this->connection->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

    }