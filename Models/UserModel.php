<?php

class UserModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Lấy danh sách người dùng với phân trang, tìm kiếm và sắp xếp.
     * @param mixed $page số trang
     * @param mixed $limit lấy bao nhiêu người dùng mỗi trang
     * @param mixed $keyword từ khóa tìm kiếm
     * @param mixed $status trạng thái ẩn hoặc hiện
     * @param string $sortBy cột để sắp xếp ('name' , 'price' hoặc 'date')
     * @param string $sortOrder thứ tự sắp xếp ('asc' hoặc 'desc')
     */
    public function getAllUsers(
        $page = 1,
        $limit = 10,
        $keyword = '',
        $status = null,
        $sortBy = 'date',
        $sortOrder = 'desc',
    ) {
        $page = max(1, (int) $page);
        $limit = max(1, (int) $limit);
        $offset = ($page - 1) * $limit;

        $search = '';

        if (trim($keyword) !== '') {
            $search = " WHERE `username` LIKE :keyword OR `phone` = :keyword ";
        } else {
            $search = " WHERE 1 ";
        }

        if ($status !== null) {
            $search .= " AND p.`status` = :status ";
        }

        $orderBy = '';
        $safeSortOrder = ($sortOrder === 'asc' || $sortOrder === 'desc') ? $sortOrder : 'DESC';

        switch ($sortBy) {
            case 'name':
                $orderBy = " ORDER BY `name` $safeSortOrder ";
                break;
            case 'price':
                $orderBy = " ORDER BY COALESCE(`discount_price`, `price`) $safeSortOrder ";
                break;
            case 'date':
            default:
                $orderBy = " ORDER BY `created_at` $safeSortOrder ";
                break;
        }

        $query = "
                SELECT * FROM users
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

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOneUser(int|string $id, $active = null)
    {

        if ($active !== null) {
            $search = "AND `active` = :active";
        } else {
            $search = "";
        }

        if (is_int($id)) {
            $query = "SELECT * FROM `users` WHERE `id` = :id $search LIMIT 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        } else {
            $query = "SELECT * FROM `users` WHERE `email` = :id $search LIMIT 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        }

        if ($active !== null) {
            $stmt->bindValue(":active", $active, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
