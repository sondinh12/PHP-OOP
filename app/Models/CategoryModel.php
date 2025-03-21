<?php
namespace App\Models;
use App\Common\Database;
class CategoryModel {
    private $connection;
    private $queryBuilder;
    public function __construct(){
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function getAllCate(){
        $stmt = $this->queryBuilder->select('*')->from('category');
        return $stmt->fetchAllAssociative();
    }

    public function addCate(){
        $stmt = $this->queryBuilder->insert('category')
        ->values([
            'cate_name' => ':cate_name',
            'create_at' => 'NOW()',
            'update_at' => 'NOW()'
        ])  
        ->setParameters([
            'cate_name' => $_POST['cate_name'],
        ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function deleteCate($cate_id){
        $stmt = $this->queryBuilder->delete('category')
        ->where('cate_id = :cate_id')
        ->setParameter(
            'cate_id',$cate_id
        );
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function findCateById($cate_id){
        $stmt = $this->queryBuilder->select('*')->from('category')->where('cate_id = :cate_id')
        ->setParameter(
            'cate_id',$cate_id
        )->executeQuery();
        return $stmt->fetchAssociative();
    }

    public function updateCate($cate_id){
        $stmt = $this->queryBuilder->update('category')
        ->where('cate_id = :cate_id')
        ->set('cate_name', ':cate_name')
        ->set('update_at' , 'NOW()')
        ->setParameters([        
            'cate_name' => $_POST['cate_name'],
            'cate_id' => $cate_id,
        ]);

        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());    
    }
    
    public function searchByName($cate_name) {
        $stmt = $this->queryBuilder->select('*')->from('category')
            ->where('cate_name LIKE :cate_name')
            ->setParameter('cate_name', "%$cate_name%")
            ->executeQuery();
        return $stmt->fetchAllAssociative();
    }

}
?>