<?php

class BlogsCommentModel {

    private $conn;
    private $table = "comment_blogs";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // GET ALL
    public function getAll() {
        $sql = "SELECT 
                    cb.id,
                    cb.blog_id,
                    cb.user_id,
                    cb.content,
                    cb.status,
                    cb.created_at,
                    b.title AS blog_title,
                    u.full_name AS full_name
                FROM {$this->table} cb
                LEFT JOIN blogs b ON cb.blog_id = b.id
                LEFT JOIN users u ON cb.user_id = u.id
                ORDER BY cb.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET ONE
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // BLOG
    public function getBlog($blog_id) {
        $stmt = $this->conn->prepare("SELECT id, title FROM blogs WHERE id=?");
        $stmt->execute([$blog_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // USER
public function getUser($user_id) {
    if (!$user_id) return null;
    $stmt = $this->conn->prepare(
        "SELECT id, full_name, email FROM users WHERE id=?"
    );
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // UPDATE
    public function update($id, $content, $status) {
        $sql = "UPDATE {$this->table} 
                SET content=?, status=? 
                WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$content, $status, $id]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }

        public function getByBlogId($blog_id)
    {
        $sql = "SELECT cb.*, u.full_name, u.avatar
                FROM {$this->table} cb
                JOIN users u ON cb.user_id = u.id
                WHERE cb.blog_id = ?
                ORDER BY cb.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$blog_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $sql = "INSERT INTO {$this->table} (blog_id, user_id, content, status, created_at)
                VALUES (:blog_id, :user_id, :content, :status, NOW())";
        $stmt = $this->conn->prepare($sql);
        if (!isset($data['status'])) {
            $data['status'] = 0;
        }
        return $stmt->execute($data);
    }

}
