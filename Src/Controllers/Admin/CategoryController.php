<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Validations\Admin\CategoryValidation;
use Src\Models\Admin\CategoryModel;

class CategoryController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Category/CategoryList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Category/CategoryAdd');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? null,
                'status' => $_POST['status'] ?? null
            ];
    
            $validationResult = CategoryValidation::categoryValidation($data);
    
            if ($validationResult === true) {
                $categoryModel = new CategoryModel();
                $saveResult = $categoryModel->createCategory($data);
    
                if ($saveResult) {
                    header("Location: /admin/categories");
                    exit();
                } else {
                    $errors[] = "Không thể lưu phân loại. Vui lòng thử lại.";
                }
            } else {
                $errors = $validationResult;
            }
    
            echo $this->view->render('Admin/Pages/Category/CategoryAdd', [
                'data' => $data,
                'errors' => $errors ?? []
            ]);
        } else {
            header("Location: /category/add");
            exit();
        }
    }
    
    
    public function edit(){
        echo $this->view->render('Admin/Pages/Category/CategoryEdit');
    }
}