<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Validations\Admin\CategoryValidation;
use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\CategoryValueModel;

class CategoryController extends BaseController
{
    public function show()
    {
        echo $this->view->render('Admin/Pages/Category/CategoryList');
    }

    public function add()
    {
        echo $this->view->render('Admin/Pages/Category/CategoryAdd');
    }

    public function store()
    {
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




    // danh mục con
    public function showSub()
    {
        $categoryModel = new CategoryValueModel();
        $categoryValues = $categoryModel->getCategoryValuesWithParent();

        echo $this->view->render('Admin/Pages/Category/CategoryValueList', [
            'categoryValues' => $categoryValues
        ]);
    }


    public function editSub($id)
    {
        $categoryValueModel = new CategoryValueModel();
        $categoryModel = new CategoryModel();

        $categoryValue = $categoryValueModel->getOneCategoryValue($id['id']);
        $categories = $categoryModel->getAllCategory();

        echo $this->view->render('Admin/Pages/Category/CategoryValueEdit', [
            'categoryValue' => $categoryValue,
            'categories' => $categories
        ]);
    }

    public function updateSub($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'category_id' => $_POST['category_id'],
                'status' => $_POST['status']
            ];

            $errors = CategoryValidation::categoryValueValidation($data, $id['id']);

            if ($errors !== true) {
                $categoryValueModel = new CategoryValueModel();
                $categoryValue = $categoryValueModel->getOneCategoryValue($id['id']);
                $categoryModel = new CategoryModel();
                $categories = $categoryModel->getAllCategory();

                echo $this->view->render('Admin/Pages/Category/CategoryValueEdit', [
                    'categoryValue' => $categoryValue,
                    'categories' => $categories,
                    'errors' => $errors
                ]);
                return;
            }

            $categoryValueModel = new CategoryValueModel();
            $updateSuccess = $categoryValueModel->updateCategoryValue($id, $data);

            if ($updateSuccess) {
                header('Location: /admin/category/value');
                exit;
            } else {
                echo "Cập nhật thất bại!";
            }
        }
    }


    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryModel = new CategoryValueModel();

            $deleteSuccess = $categoryModel->deleteCategoryValue($id['id']);

            if ($deleteSuccess) {
                header('Location: /admin/category/value');
                exit;
            } else {
                echo "Xóa thất bại!";
            }
        }
    }
}
