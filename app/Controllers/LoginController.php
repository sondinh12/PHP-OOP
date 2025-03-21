<?php
namespace App\Controllers;
use App\Models\LoginModel;
use App\Common\Blade;
use Rakit\Validation\Validator;

class LoginController {
    private $loginModel;
    public function __construct(){
        $this->loginModel = new LoginModel();
    }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ], [
                'email' => 'required|email',
                'password' => 'required|min:5',
            ]);
            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                $_SESSION['old'] = $_POST;
                header('location: ' . $_ENV['BASE_URL'] . 'login');
                exit;
            }   
            $user = $this->loginModel->login();
            
            if($user){
                $_SESSION['user'] = $user;
                $_SESSION['message_log'] = "Đăng nhập thành công";
                header('location:' . $_ENV['BASE_URL'] . 'admin/');
                // var_dump($_SESSION['user']);
                exit();
            } else {
                // var_dump($user);
                $_SESSION['message_log'] = "Email hoặc mật khẩu không đúng";
                $_SESSION['old'] = $_POST;
                header('location: ' . $_ENV['BASE_URL'] . 'login');
                exit();
            }
            
        }
        Blade::render('login',[
            'errors' => $_SESSION['errors'] ?? [],
            'old' => $_SESSION['old'] ?? []
        ]);
        unset($_SESSION['errors'], $_SESSION['old']);
    }

    public function logout(){
        session_unset();
        session_destroy(); 
        header('location: ' . $_ENV['BASE_URL'] . 'login');
        exit;
    }
}
?>