<?php

class BlogsCommentModel {

    private $conn;
    private $table = "comment_blogs";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Lấy tất cả bình luận
public function getAll()
{
    $sql = "SELECT cb.id, cb.blog_id, cb.user_id, cb.content_text, cb.status_enum, cb.created_at,
                   b.title AS blog_title,
                   u.username AS username
            FROM {$this->table} cb
            LEFT JOIN blogs b ON cb.blog_id = b.id
            LEFT JOIN users u ON cb.user_id = u.id
            ORDER BY cb.created_at DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    // Lấy bình luận theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin blog
    public function getBlog($blog_id)
    {
        $sql = "SELECT id, title FROM blogs WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$blog_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin user
public function getUser($user_id)
{
    $sql = "SELECT id, username AS fullname, email FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Update bình luận
    public function update($id, $content_text, $status_enum)
    {
        $sql = "UPDATE {$this->table}
                SET content_text = ?, status_enum = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$content_text, $status_enum, $id]);
    }

    // Xóa bình luận
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
