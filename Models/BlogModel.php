<?php

class BlogModel {
    private $conn;
    private $table = "blogs";

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Lấy tất cả blog
    public function getAll() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy blog theo id
    public function getById($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert blog
public function create($data) {
    $sql = "INSERT INTO blogs 
        (user_id, slug, title, content_text, images, meta_keywords, meta_description, status_enum, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        $data['user_id'],
        $data['slug'],
        $data['title'],
        $data['content_text'],
        $data['images'],
        $data['meta_keywords'],
        $data['meta_description'],
        $data['status_enum'],
    ]);
}


    // Update
    public function update($id, $data) {
        $sql = "UPDATE $this->table SET 
            slug = ?, 
            title = ?, 
            content_text = ?, 
            images = ?, 
            meta_keywords = ?, 
            meta_description = ?, 
            status_enum = ?, 
            updated_at = NOW()
        WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['slug'],
            $data['title'],
            $data['content_text'],
            $data['images'],
            $data['meta_keywords'],
            $data['meta_description'],
            $data['status_enum'],
            $id
        ]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
