<?php
namespace App\Controllers;
    
use App\Models\UserModel;
use App\Common\Blade;
use Rakit\Validation\Validator;

class UserController {

    private $userModel;
    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function getAllUser(){
        $user_name = $_GET['user_name'] ?? '';
        if(!empty($user_name)){
            $user = $this->userModel->searchByName($user_name);
        } else {
            $user = $this->userModel->getAllUser();
        }
        Blade::render('user.listUser', [
            'user' => $user,
            'keywword' => $user_name
        ]);
    }

    public function addUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'user_name' => $_POST['user_name'],
                'user_img' => $_FILES['user_img'],
                'age' => $_POST['age'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'birthday' => $_POST['birthday'],
            ], [
                'user_name' => 'required|min:3|alpha',
                'user_img' => 'uploaded_file:0,2M,png,jpg',
                'age' => 'required|integer|min:10|max:100',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:4',
                'birthday' => 'required',
            ]);
            $validation->setMessages([
                    'user_name.required' => 'Tên người dùng không được để trống!',
                    'user_name.min' => 'Tên người dùng phải có ít nhất 3 ký tự!',
                    'user_name.alpha' => 'Tên chỉ được chứa chữ cái!',
            
                    'user_img.uploaded_file' => 'Hình ảnh phải có định dạng PNG hoặc JPG, dung lượng tối đa 2MB!',
            
                    'age.required' => 'Tuổi không được để trống!',
                    'age.integer' => 'Tuổi phải là số nguyên!',
                    'age.min' => 'Tuổi tối thiểu là 10!',
                    'age.max' => 'Tuổi tối đa là 100!',
            
                    'address.required' => 'Địa chỉ không được để trống!',
                    'phone.required' => 'Số điện thoại không được để trống!',
                    'email.required' => 'Email không được để trống!',
                    'email.email' => 'Email không hợp lệ!',
                    'password.required' => 'Mật khẩu không được để trống!',
                    'password.min' => 'Mật khẩu phải có ít nhất 4 ký tự!',
                    'birthday.required' => 'Ngày sinh không được để trống!', 
            ]);
            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                $_SESSION['old'] = $_POST;
                header('location: ' . $_ENV['BASE_URL'] . 'admin/user/add');
                exit;
            }
        
            $imageLink = null;
            $image = $_FILES['user_img'];
            if($_FILES['user_img']['name'] != ""){
                
                $imageName = time() . '_' . $image['name'];
                move_uploaded_file($image['tmp_name'],"uploads/users/$imageName");
                $imageLink = "uploads/users/$imageName";
            }
            $this->userModel->addUser($imageLink);
            $_SESSION['message'] = "Thêm mới thành công";   
            header('location:' . $_ENV['BASE_URL'] . 'admin/user/') ;
        }
        Blade::render('user.addUser',[
            'errors' => $_SESSION['errors'] ?? [],
            'old' => $_SESSION['old'] ?? []
        ]);
        unset($_SESSION['errors'], $_SESSION['old']);
    }

    public function deleteUser($user_id){
        $this->userModel->deleteUser($user_id);
        header('location:' . $_ENV['BASE_URL'] . 'admin/user/');
    }

    public function updateUser($user_id){
        $userOld = $this->userModel->getUserById($user_id);    
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'user_name' => $_POST['user_name'],
                'user_img' => $_FILES['user_img'],
                'age' => $_POST['age'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'birthday' => $_POST['birthday'],
            ], [
                'user_name' => 'required|min:3|alpha',
                'user_img' => 'uploaded_file:0,2M,png,jpg',
                'age' => 'required|integer|min:10|max:100',
                'address' => 'required',
                'phone' => 'required|phone',
                'email' => 'required|email',
                'password' => 'required|min:4',
                'birthday' => 'required',
            ]);
            $validation->setMessages([
                'user_name.required' => 'Tên người dùng không được để trống!',
                'user_name.min' => 'Tên người dùng phải có ít nhất 3 ký tự!',
                'user_name.alpha' => 'Tên chỉ được chứa chữ cái!',
        
                'user_img.uploaded_file' => 'Hình ảnh phải có định dạng PNG hoặc JPG, dung lượng tối đa 2MB!',
        
                'age.required' => 'Tuổi không được để trống!',
                'age.integer' => 'Tuổi phải là số nguyên!',
                'age.min' => 'Tuổi tối thiểu là 10!',
                'age.max' => 'Tuổi tối đa là 100!',
        
                'address.required' => 'Địa chỉ không được để trống!',
                'phone.required' => 'Số điện thoại không được để trống!',
                'email.required' => 'Email không được để trống!',
                'email.email' => 'Email không hợp lệ!',
                'password.required' => 'Mật khẩu không được để trống!',
                'password.min' => 'Mật khẩu phải có ít nhất 4 ký tự!',
                'birthday.required' => 'Ngày sinh không được để trống!', 
        ]);
            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                header('location: ' . $_ENV['BASE_URL'] . 'admin/user/update/' . $user_id);
                exit;
            }
            $imageLink = $userOld['user_img'];
            $image = $_FILES['user_img'];
            if($image['name'] != "")  {
                unlink( $imageLink);
                $imageName = time() . '_' . $image['name'];
                move_uploaded_file($image['tmp_name'],"uploads/users/$imageName");
                $imageLink = "uploads/users/$imageName";
            }
            $this->userModel->updateUser($user_id,$imageLink);
            $_SESSION['message'] = "Sửa thành công";   
            header('location:' . $_ENV['BASE_URL'] . 'admin/user/') ;
        }
        Blade::render('user.updateUser',[
            'userOld'=>$userOld,
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors'], $_SESSION['old']);
    }

}
?>