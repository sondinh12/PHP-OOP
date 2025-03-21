<?php
namespace App\Models;

use App\Common\Database;

class UserModel {
    private $connection;
    private $queryBuilder;
    public function __construct(){
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function getAllUser(){
        $stmt = $this->queryBuilder->select('*')->from('user');
        return $stmt->fetchAllAssociative();
    }

    public function addUser($imageLink){
        $stmt = $this->queryBuilder->insert('user')
        ->values([
            'user_name' => ':user_name',
            'age' => ':age',
            'address' => ':address',
            'phone' => ':phone',
            'birthday' => ':birthday',  
            'email' => ':email',
            'password' => ':password',
            'role' => ':role',
            'user_img' => ':user_img',        
            'create_at' => 'NOW()',
            'update_at' => 'NOW()' 
        ])  
        ->setParameters([
            'user_name' => $_POST['user_name'],
            'user_img' => $imageLink,
            'age' => $_POST['age'],
            'password' => $_POST['password'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'birthday' => $_POST['birthday'],
            'role' => 'user',
        ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function deleteUser($user_id){
        $stmt = $this->queryBuilder->delete('user')
        ->where('user_id = :user_id')
        ->setParameter(
            'user_id',$user_id
        );
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function getUserById($user_id) {
        $stmt = $this->queryBuilder->select('*')
            ->from('user')
            ->where('user_id = :user_id')
            ->setParameter('user_id', $user_id)
            ->executeQuery();
        return $stmt->fetchAssociative();
    }
    

    public function updateUser($user_id,$imageLink){
        $stmt = $this->queryBuilder->update('user')
        ->where('user_id = :user_id')
        ->set('user_name',':user_name')
        ->set('user_img',':user_img')
        ->set('age',':age')
        ->set('password',':password')
        ->set('phone',':phone')
        ->set('email',':email')
        ->set('address',':address')
        ->set('birthday',':birthday')
        ->set('update_at','NOW()')
        ->setParameters([
            'user_name' => $_POST['user_name'],
            'user_img' => $imageLink,
            'age' => $_POST['age'],
            'password' => $_POST['password'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'birthday' => $_POST['birthday'],
            'user_id'=>$user_id
        ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }

    public function searchByName($user_name) {
        $stmt = $this->queryBuilder->select('*')->from('user')
            ->where('user_name LIKE :user_name')
            ->setParameter('user_name', "%$user_name%")
            ->executeQuery();
        return $stmt->fetchAllAssociative();
    }

}
?>