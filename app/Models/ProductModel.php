<?php
namespace App\Models;
use App\Common\Database;
class ProductModel {
    private $connection;
    private $queryBuilder;
    public function __construct(){
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function getAllPro(){
        $stmt = $this->queryBuilder->select('*')->from('product');
        return $stmt->fetchAllAssociative();
    }

    public function addPro($imageLink){
        $stmt = $this->queryBuilder->insert('product')
        ->values([
            'pro_name' => ':pro_name',
            'pro_img' => ':pro_img',
            'price' => ':price',
            'description' => ':description',
            'cate_id' => ':cate_id',    
            'create_at' => 'NOW()',
            'update_at' => 'NOW()' 
        ])  
        ->setParameters([
            'pro_name' => $_POST['pro_name'],
            'pro_img' => $imageLink,
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'cate_id' => $_POST['cate_id']

        ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function deletePro($pro_id){
        $stmt = $this->queryBuilder->delete('product')
        ->where('pro_id = :pro_id')
        ->setParameter(
            'pro_id',$pro_id
        );
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function getProById($pro_id) {
        $stmt = $this->queryBuilder->select('p.*, c.cate_name')
            ->from('product', 'p')
            ->leftJoin('p', 'category', 'c', 'p.cate_id = c.cate_id')
            ->where('p.pro_id = :pro_id')
            ->setParameter('pro_id', $pro_id)
            ->executeQuery();
        return $stmt->fetchAssociative();
    }

    public function getAllCategories() {
        $stmt = $this->queryBuilder
            ->select('*')
            ->from('category')
            ->executeQuery();
        return $stmt->fetchAllAssociative();
    }
    

    public function updatePro($pro_id,$imageLink){
        $stmt = $this->queryBuilder->update('product')
        ->where('pro_id = :pro_id')
        ->set('pro_name',':pro_name')
        ->set('pro_img',':pro_img')
        ->set('price',':price')
        ->set('description',':description')
        ->set('cate_id',':cate_id')
        ->set('update_at','NOW()')
        ->setParameters([
            'pro_name' => $_POST['pro_name'],
            'pro_img' => $imageLink,
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'cate_id' => $_POST['cate_id'],
            'pro_id'=>$pro_id
        ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }

    public function searchByName($pro_name) {
        $stmt = $this->queryBuilder->select('*')->from('product')
            ->where('pro_name LIKE :pro_name')
            ->setParameter('pro_name', "%$pro_name%")
            ->executeQuery();
        return $stmt->fetchAllAssociative();
    }
}
?>