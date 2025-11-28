<?php
class Category
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getAllCategory()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneCategory($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO categories (parent_id, name, description, slug, status) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([

            $data['parent_id'],
            $data['name'],
            $data['description'],
            $data['slug'],
            $data['status']
        ]);
    }

    public function store($id, $data)
    {
        $sql = "UPDATE categories 
                SET parent_id=?, name=?, description=?, slug=?, status=? 
                WHERE id=?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['parent_id'],
            $data['name'],
            $data['description'],
            $data['slug'],
            $data['status'],
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
