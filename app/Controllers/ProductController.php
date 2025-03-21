<?php
namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Rakit\Validation\Validator;
use App\Common\Blade;
class ProductController {
    private $productModel;
    public function __construct(){
        $this->productModel = new ProductModel();
    }

    public function getAllPro(){
        $pro_name = $_GET['pro_name'] ?? '';
        if(!empty($pro_name)){
            $pro = $this->productModel->searchByName($pro_name);
        } else {
            $pro = $this->productModel->getAllPro();
        }
        Blade::render('product.listProduct',[
            'pro' => $pro,
            'keyword' => $pro_name
        ]);
    }  


    public function addPro(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'pro_name' => $_POST['pro_name'],
                'pro_image' => $_FILES['pro_image'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
            ], [
                'pro_name' => 'required|min:3|alpha',
                'pro_image' => 'uploaded_file:0,2M,png,jpg',
                'price' => 'required|integer|min:1',
            ]);

            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                $_SESSION['old'] = $_POST;
                header('location: ' . $_ENV['BASE_URL'] . 'admin/product/add');
                exit;
            }
        
            $imageLink = null;
            $image = $_FILES['pro_img'];
            if($_FILES['pro_img']['name'] != ""){
                
                $imageName = time() . '_' . $image['name'];
                move_uploaded_file($image['tmp_name'],"uploads/products/$imageName");
                $imageLink = "uploads/products/$imageName";
            }
            $this->productModel->addPro($imageLink);
            $_SESSION['message'] = "Thêm mới thành công";   
            header('location:' . $_ENV['BASE_URL'] . 'admin/product/') ;
        }
        $cateModel = new CategoryModel();
        $category = $cateModel->getAllCate();
        Blade::render('product.addProduct',[
            'category'=>$category,
            'errors' => $_SESSION['errors'] ?? [],
            'old' => $_SESSION['old'] ?? []

        ]);
        unset($_SESSION['errors'], $_SESSION['old']);
    }

    public function deletePro($pro_id){
        $this->productModel->deletePro($pro_id);
        header('location:' . $_ENV['BASE_URL'] . 'admin/product/');
    }

    public function updatePro($pro_id){
        $proOld = $this->productModel->getProById($pro_id);  
        $categories = $this->productModel->getAllCategories(); 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validater = new Validator;
            $validation = $validater->make([
                'pro_name' => $_POST['pro_name'],
                'pro_image' => $_FILES['pro_image'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
            ], [
                'pro_name' => 'required|min:3|alpha',
                'pro_image' => 'uploaded_file:0,2M,png,jpg',
                'price' => 'required|integer|min:1',
            ]);
            $validation->validate();
            if($validation->fails()){
                $_SESSION['errors'] = $validation->errors()->toArray();
                header('location: ' . $_ENV['BASE_URL'] . 'admin/product/update/' . $pro_id);
                exit;
            }
            $imageLink = $proOld['pro_img'];
            $image = $_FILES['pro_img'];
            if($image['name'] != "")  {
                unlink($imageLink);
                $imageName = time() . '_' . $image['name'];
                move_uploaded_file($image['tmp_name'],"uploads/products/$imageName");
                $imageLink = "uploads/products/$imageName";
            }
            $this->productModel->updatePro($pro_id,$imageLink);
            $_SESSION['message'] = "Sửa thành công";   
            header('location:' . $_ENV['BASE_URL'] . 'admin/product/') ;
        }
        Blade::render('product.updateProduct',[
            'proOld'=>$proOld,
            'category' => $categories,
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors']);
    }

    // public function search() {
    //     $pro_name = $_GET['pro_name'] ?? ''; // Lấy giá trị tìm kiếm từ query string
    //     $products = $this->productModel->searchByName($pro_name);

    //     Blade::render('product.searchProduct', [
    //         'products' => $products,
    //         'keyword' => $pro_name
    //     ]);
    // }
}
?>  