<?php
class CategoryModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Lấy tất cả danh mục (bao gồm parent_id) để hiển thị
    public function getAll($keyword = '', $limit = null, $offset = 0, $sortDate = 'desc')
    {
        $sql = "SELECT id, parent_id, name, description, slug, status, created_at FROM categories WHERE 1";

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
        $stmt = $this->connection->prepare("SELECT id, parent_id, name, description, slug, status FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->connection->prepare("INSERT INTO categories (name, description, slug, status, parent_id) 
        VALUES (:name, :description, :slug, :status, :parent_id)");
$stmt->execute([
':name' => $data['name'],
':description' => $data['description'],
':slug' => $data['slug'],
':status' => $data['status'],
':parent_id' => $data['parent_id'] // NULL nếu root
]);

    }

    public function update($id, $data)
    {
        $stmt = $this->connection->prepare("UPDATE categories SET parent_id=?, name=?, description=?, slug=?, status=? WHERE id=?");
        return $stmt->execute([
            $data['parent_id'] ?? 0, // giữ parent_id
            $data['name'],
            $data['description'],
            $data['slug'],
            $data['status'] ?? 1,
            $id
        ]);
    }

    public function loiTrung($name, $id = null)
{
    $sql = "SELECT COUNT(*) FROM categories WHERE name = :name";

    // Khi edit thì bỏ qua chính nó
    if ($id !== null) {
        $sql .= " AND id != :id";
    }

    $stmt = $this->connection->prepare($sql);
    $stmt->bindValue(':name', $name);

    if ($id !== null) {
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchColumn() > 0; // Trả về true nếu trùng
}
public function deleteWithChild($id)
{
    // 1. Lấy danh mục con
    $stmt = $this->connection->prepare("SELECT id FROM categories WHERE parent_id = ?");
    $stmt->execute([$id]);
    $children = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Xóa từng danh mục con (đệ quy)
    foreach ($children as $child) {
        $this->deleteWithChild($child['id']);
    }

    // 3. Xóa chính nó
    $stmt = $this->connection->prepare("DELETE FROM categories WHERE id = ?");
    return $stmt->execute([$id]);
}
}

