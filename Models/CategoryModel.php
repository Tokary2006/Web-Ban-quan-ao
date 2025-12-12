<?php
class CategoryModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll($keyword = '', $limit = null, $offset = 0, $sortDate = 'desc')
    {
        $sql = "SELECT id, parent_id, name, description, slug, status, created_at 
                FROM categories WHERE 1";

        if (!empty($keyword)) {
            $sql .= " AND (name LIKE :keyword OR description LIKE :keyword)";
        }

        $sql .= " ORDER BY created_at $sortDate";

        if ($limit) {
            $sql .= " LIMIT :offset, :limit";
        }

        $stmt = $this->connection->prepare($sql);

        if (!empty($keyword)) {
            $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        }

        if ($limit) {
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id)
    {
        $stmt = $this->connection->prepare(
            "SELECT id, parent_id, name, description, slug, status 
             FROM categories WHERE id=?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->connection->prepare("
            INSERT INTO categories (name, description, slug, status, parent_id) 
            VALUES (:name, :description, :slug, :status, :parent_id)
        ");

        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':slug', $data['slug']);
        $stmt->bindValue(':status', $data['status'], PDO::PARAM_INT);

        if ($data['parent_id'] === null) {
            $stmt->bindValue(':parent_id', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':parent_id', $data['parent_id'], PDO::PARAM_INT);
        }

        $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->connection->prepare("
            UPDATE categories 
            SET parent_id = :parent_id, 
                name = :name, 
                description = :description, 
                slug = :slug, 
                status = :status
            WHERE id = :id
        ");

        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':slug', $data['slug']);
        $stmt->bindValue(':status', $data['status'], PDO::PARAM_INT);

        if ($data['parent_id'] === null) {
            $stmt->bindValue(':parent_id', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':parent_id', $data['parent_id'], PDO::PARAM_INT);
        }

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function loiTrung($name, $id = null)
    {
        $sql = "SELECT COUNT(*) FROM categories WHERE name = :name";

        if ($id !== null) {
            $sql .= " AND id != :id";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name);

        if ($id !== null) {
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function deleteWithChild($id)
    {
        // Xóa danh mục con (đệ quy)
        $stmt = $this->connection->prepare("SELECT id FROM categories WHERE parent_id = ?");
        $stmt->execute([$id]);
        $children = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($children as $child) {
            $this->deleteWithChild($child['id']);
        }

        // Xóa danh mục hiện tại
        $stmt = $this->connection->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
