<?php
namespace App\Models;
use App\Common\Database;

class LoginModel {
    private $connection;
    private $queryBuilder;
    public function __construct(){
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }
    public function login(){
        $stmt = $this->queryBuilder->select('*')->from('user')
        ->where('email = :email' )
        ->setParameter(
            'email', $_POST['email']
        )->executeQuery();
        $user = $stmt->fetchAssociative();
        if (!$user) {
            return false;
        }
    
        if (password_get_info($user['password'])['algo'] == 0) {
            $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->queryBuilder->update('user')
                ->set('password', ':password')
                ->where('user_id = :user_id')
                ->setParameters([
                    'password' => $hashedPassword,
                    'user_id' => $user['user_id']
                ])
                ->executeQuery();
            $user['password'] = $hashedPassword;
        }
    
        if (password_verify($_POST['password'], $user['password'])) {
            return $user;
        }
    
        return false;
    }
}
?>