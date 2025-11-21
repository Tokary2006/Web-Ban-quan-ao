<?php

class Product
{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function getAllProducts($page=1,$limit = 10, $keyword= '', $status= null, $sortDate= "desc"){
        $offset = ($page - 1) * $limit;
        $search = '';

          if(trim($keyword) !== ''){
            $search = " WHERE `NAME` LIKE '%$keyword%' OR `description` LIKE '%$keyword%' ";
        } else {
            $search = " WHERE 1 ";
        }

        if($status !== null){
            $search .= " AND `STATUS` = :status ";
        }

        if($sortDate === 'asc' || $sortDate === 'desc') {
            $search .= " ORDER BY `created_at` $sortDate ";
        }

        $query = "SELECT * FROM `products` $search LIMIT :limit OFFSET :offset";
        $stmt = $this->connection->prepare($query);
        if($status !== null){
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}