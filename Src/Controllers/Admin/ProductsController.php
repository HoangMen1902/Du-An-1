<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Validations\Admin\ProductValidation;
use Src\Models\Admin\ProductModel;


class ProductsController extends BaseController {
    public function index(){
        echo $this->view->render('Admin/Pages/Products/ProductList');

    }
    public function show() {

    }

    public function add(){
        echo $this->view->render('Admin/Pages/Products/ProductAdd');
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'total_quantity' => $_POST['total_quantity'] ?? 0,
                'brand' => $_POST['brand'] ?? null,
                'status' => $_POST['status'] ?? null,
                'discount' => $_POST['discount'] ?? 0
            ];
            
            $errors = []; 
    
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $thumbnailTmpPath = $_FILES['thumbnail']['tmp_name'];
                $thumbnailName = $_FILES['thumbnail']['name'];
                $thumbnailType = pathinfo($thumbnailName, PATHINFO_EXTENSION);
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    
                if (in_array(strtolower($thumbnailType), $allowedTypes)) {
                    $targetDir = 'public/Uploads/Products/';
    
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
    
                    $newThumbnailName = uniqid() . '.' . $thumbnailType;
                    $thumbnailPath = $targetDir . $newThumbnailName;
    
                    if (move_uploaded_file($thumbnailTmpPath, $thumbnailPath)) {
                        $data['thumbnail'] = $newThumbnailName;
                    } else {
                        $errors[] = "Không thể lưu ảnh thumbnail. Vui lòng thử lại.";
                    }
                } else {
                    $errors[] = "Định dạng ảnh không hợp lệ cho thumbnail. Chỉ chấp nhận JPG, JPEG, PNG, GIF.";
                }
            }
    
            $validationResult = ProductValidation::productValidation($data);
    
            if ($validationResult === true && empty($errors)) {
                $ProductModel = new ProductModel();
                $saveResult = $ProductModel->createProduct($data);
    
                if ($saveResult) {
                    header("Location: /admin/products");
                    exit();
                } else {
                    $errors[] = "Không thể lưu sản phẩm. Vui lòng thử lại.";
                }
            } else {
                $errors = array_merge($errors, is_array($validationResult) ? $validationResult : []);
            }
    
            echo $this->view->render('Admin/Pages/Products/ProductAdd', [
                'data' => $data,
                'errors' => $errors
            ]);
        } else {
            header("Location: /admin/Product/add");
            exit();
        }
    }
    
    


    public function edit(){
        echo $this->view->render('Admin/Pages/Products/ProductEdit');
    }
}