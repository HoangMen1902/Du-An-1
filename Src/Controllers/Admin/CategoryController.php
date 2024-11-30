<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Validations\Admin\CategoryValidation;
use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\CategoryValueModel;
use Src\Notifications\Notification;

class CategoryController extends BaseController
{
    public function show()
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getAllCategory();
        echo $this->view->render('Admin/Pages/Category/CategoryList', [
            'categories' => $category
        ]);
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
                    Notification::success('Thành công', 'đã thêm thành công');

                    header("Location: /admin/categories");
                    exit();
                } else {
                    Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');

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


    public function edit($id)
    {
        $categoryModel = new CategoryModel();


        $category = $categoryModel->getOneCategory($id['id']);
        echo $this->view->render('Admin/Pages/Category/CategoryEdit', [
            'category' => $category
        ]);
    }
    public function update($id)
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'status' => $_POST['status']
            ];

            $validationResult = CategoryValidation::categoryValidation($data, $id);

            if ($validationResult === true) {
                $categoryModel = new CategoryModel();

                $saveResult = $categoryModel->updateCategory($id, $data);
                if ($saveResult) {
                    Notification::success('Thành công', 'đã sửa thành công');
                    header("Location: /admin/categories");

                    exit();
                } else {
                    $errors[] = "Không thể lưu phân loại. Vui lòng thử lại.";
                    Notification::error('Lỗi', 'có lỗi xảy ra khi sửa');
                }
            } else {
                Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');
                header("Location: /admin/categories");
            }
        }
    }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $categoryModel = new CategoryModel();
            $category = $categoryModel->getOneCategory($id['id']);
            if ($category) {
                $category_id = $category['category_id'];

                $deleteSuccess = $categoryModel->deleteCategory($id['id']);

                if ($deleteSuccess) {
                    Notification::success('Thành công', 'đã xóa thành công');
                    header("Location: /admin/category/CategoryValueList/$category_id?status=success");
                    exit;
                } else {
                    Notification::error('Lỗi', 'có lỗi xảy ra khi xóa');
                    header("Location: /admin/category/CategoryValueList/$category_id?status=failed");
                }
            } else {
                echo "Không tìm thấy danh mục!";
            }
        }
    }


    // danh mục con
    public function showSub($id)
    {

        $categoryValueModel = new CategoryValueModel();
        $categoryValues = $categoryValueModel->getCategoryValuesWithParent($id['id']);

        echo $this->view->render('Admin/Pages/Category/CategoryValueList', [
            'categoryValues' => $categoryValues
        ]);
    }
    public function addSub($params)
    {
        $id = $params['id'];
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getOneCategory($id);
        echo $this->view->render('Admin/Pages/Category/CategoryValueAdd', [
            'categories' => $categories
        ]);
    }
    public function storeSub()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? null,
                'status' => $_POST['status'] ?? null,
                'category_id' => $_POST['category_id'] ?? null
            ];

            $validationResult = CategoryValidation::categoryValueValidation($data);

            if ($validationResult === true) {
                $categoryValueModel = new CategoryValueModel();
                $saveResult = $categoryValueModel->createCategoryValue($data);


                if ($saveResult) {
                    Notification::success('Thành công', 'đã thêm thành công');
                    header("Location: /admin/category/CategoryValueList/{$data['category_id']}");
                    exit();
                } else {
                    Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');

                    $errors[] = "Không thể lưu phân loại. Vui lòng thử lại.";
                }
            } else {
                Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');

                $errors = $validationResult;
            }
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->getAllCategory();

            echo $this->view->render('Admin/Pages/Category/CategoryValueAdd/', [
                'categories' => $categories,
                'data' => $data,
                'errors' => $errors ?? []
            ]);
        } else {
            Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');

            // header("Location: /category/add");
            exit();
        }
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
            $updateSuccess = $categoryValueModel->updateCategoryValue($id['id'], $data);

            if ($updateSuccess) {
                if ($updateSuccess) {
                    Notification::success('Thành công', 'đã sửa thành công');
                    header("location: /admin/category/CategoryValueList/{$data['category_id']}?status=success");
                    exit();
                } else {
                    Notification::error('Lỗi', 'có lỗi xảy ra khi sửa');

                    header("location: /admin/category/CategoryValueList/{$data['category_id']}?status=failed");
                }
            } else {
                Notification::error('Lỗi', 'có lỗi xảy ra khi sửa');

                echo "Cập nhật thất bại!";
            }
        }
    }


    public function deleteSub($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryValueModel = new CategoryValueModel();
            $categoryValue = $categoryValueModel->getOneCategoryValue($id['id']);

            if ($categoryValue) {
                $category_id = $categoryValue['category_id'];
                $deleteSuccess = $categoryValueModel->deleteCategoryValue($id['id']);
                if ($deleteSuccess) {
                    Notification::success('Thành công', 'đã xóa thành công');

                    header("Location: /admin/category/CategoryValueList/$category_id?status=success");
                    exit;
                } else {
                    Notification::error('Lỗi', 'có lỗi xảy ra khi xóa');

                    header("Location: /admin/category/CategoryValueList/$category_id?status=failed");
                }
            } else {
                Notification::error('Lỗi', 'có lỗi xảy ra khi xóa');
                echo "Không tìm thấy danh mục!";
            }
        }
    }
}
