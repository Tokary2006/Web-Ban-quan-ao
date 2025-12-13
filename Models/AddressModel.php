<?php
class AddressModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Lấy tất cả địa chỉ của user
    public function getAddressesByUser($userId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM addresses WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 địa chỉ theo ID
    public function getAddressById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM addresses WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm địa chỉ mới
    public function addAddress($userId, $address_name, $full_address, $city, $recipient_phone)
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO addresses (user_id, address_name, full_address, city, recipient_phone, created_at) 
             VALUES (:user_id, :address_name, :full_address, :city, :recipient_phone, now())"
        );
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':address_name', $address_name);
        $stmt->bindValue(':full_address', $full_address);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':recipient_phone', $recipient_phone);
        return $stmt->execute();
    }

    // Cập nhật địa chỉ
    public function updateAddress($id, $title, $full_address, $address, $recipient_phone)
    {
        $stmt = $this->connection->prepare(
            "UPDATE addresses 
             SET title = :title, full_address = :full_address, address = :address, recipient_phone = :recipient_phone 
             WHERE id = :id"
        );
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':full_address', $full_address);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':recipient_phone', $recipient_phone);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Xóa địa chỉ
    public function deleteAddress($id, $userId)
    {
        $sql = "DELETE FROM addresses WHERE id = :id AND user_id = :user_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);
    }
}
