<?php
class BlogModel {
    private $conn;
    private $table = "blogs";

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Lấy tất cả blog
    public function getAll() {
        $sql = "SELECT b.*, u.full_name AS author_name 
                FROM blogs b 
                JOIN users u ON b.user_id = u.id
                ORDER BY b.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy blog theo id
    public function getById($id) {
        $sql = "SELECT b.*, u.full_name AS author_name 
                FROM blogs b 
                JOIN users u ON b.user_id = u.id
                WHERE b.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách user
    public function getUsers() {
        $stmt = $this->conn->prepare("SELECT id, full_name FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert blog
    public function create($data) {
        $sql = "INSERT INTO blogs 
            (user_id, slug, title, content, image, meta_keywords, meta_description, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['user_id'],
            $data['slug'],
            $data['title'],
            $data['content'],
            $data['image'],
            $data['meta_keywords'],
            $data['meta_description'],
            $data['status'],
        ]);
    }

    // Update blog
    public function update($id, $data) {
        $sql = "UPDATE $this->table SET 
                slug = ?, 
                title = ?, 
                content = ?, 
                image = ?, 
                meta_keywords = ?, 
                meta_description = ?, 
                status = ?, 
                updated_at = NOW()
            WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['slug'],
            $data['title'],
            $data['content'],
            $data['image'],
            $data['meta_keywords'],
            $data['meta_description'],
            $data['status'],
            $id
        ]);
    }

    public function getBySlug($slug)
{
    $sql = "SELECT * FROM blogs WHERE slug = ? AND status = 1 LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$slug]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // Delete blog
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getByBlogSlug($slug)
{
    $sql = "SELECT cb.*, u.full_name, u.image
            FROM comment_blogs cb
            JOIN blogs b ON cb.blog_id = b.id
            JOIN users u ON cb.user_id = u.id
            WHERE b.slug = ?
            ORDER BY cb.created_at DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$slug]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
