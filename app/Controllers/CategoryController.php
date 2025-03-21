<?php
namespace App\Controllers;

use App\Models\CategoryModel;
use Rakit\Validation\Validator;
use App\Common\Blade;
class CategoryController {
    private $categoryModel;
    public function __construct(){
        $this->categoryModel = new CategoryModel();
    }

    public function getAllCate(){
        $cate_name = $_GET['cate_name'] ?? '';
        if(!empty($cate_name)){
            $cate = $this->categoryModel->searchByName($cate_name);
        } else {
            $cate = $this->categoryModel->getAllCate();
        }
        Blade::render('category.listCate',[
            'cate' => $cate,
            'keyword' => $cate_name
        ]);
    }

    public function addCate(){       
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'cate_name' => $_POST['cate_name'],
            ], [
                'cate_name' => 'required|min:3|alpha',
            ]);
            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                $_SESSION['old'] = $_POST;
                header('location: ' . $_ENV['BASE_URL'] . 'admin/category/add');
                exit;
            }
            $this->categoryModel->addCate();
            $_SESSION['message'] = "Thêm mới thành công"; 
            header('location: ' . $_ENV['BASE_URL']. 'admin/category/');
        }
        Blade::render('category.addCategory',[
            'errors' => $_SESSION['errors'] ?? [],
            'old' => $_SESSION['old'] ?? []
        ]);
        unset($_SESSION['errors'], $_SESSION['old']);
    }

    public function deleteCate($cate_id){
        $this->categoryModel->deleteCate($cate_id);
        header('location:' . $_ENV['BASE_URL'] . 'admin/category/');
    }

    public function updateCate($cate_id){
        $cateOld = $this->categoryModel->findCateById($cate_id);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'cate_name' => $_POST['cate_name'],
            ], [
                'cate_name' => 'required|min:3|alpha',
            ]);
            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                header('location: ' . $_ENV['BASE_URL'] . 'admin/category/update/' . $cate_id);
                exit;
            }
            $this->categoryModel->updateCate($cate_id);
            $_SESSION['message'] = "Sửa thành công"; 
            header('location: ' . $_ENV['BASE_URL']. 'admin/category');
        }
        Blade::render('category.updateCategory',[
            'cateOld' => $cateOld,
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors']);
    }
}
?>