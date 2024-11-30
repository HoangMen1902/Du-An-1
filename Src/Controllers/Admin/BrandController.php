<?php

namespace Src\Controllers\Admin;

use Respect\Validation\Validator as Validator;
use Src\Controllers\BaseController;
use Src\Models\Admin\BrandModel;
use Src\Validations\Admin\BrandValidation;
use Src\Notifications\Notification;

class BrandController extends BaseController
{
    public function show()
    {
        $BrandModel = new BrandModel();
        $data = $BrandModel->getAll();
        echo $this->view->render('Admin/Pages/Brands/BrandsList', ['data' => $data]);
    }

    public function add()
    {
        $BrandModel = new BrandModel();
        $data = $BrandModel->getAll();
        echo $this->view->render('Admin/Pages/Brands/BrandAdd');
    }

    public function edit($params)
    {
        $id = $params['id'];
        $BrandModel = new BrandModel();
        $data = $BrandModel->getOne($id);
        if ($data) {
            echo $this->view->render('Admin/Pages/Brands/BrandEdit', ['data' => $data]);
        } else {
            Notification::error('Lỗi', 'Thương hiệu không tồn tại.');
            header('location: /admin/brands');
        }
    }

    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'status' => $_POST['status']
        ];

        $validation = BrandValidation::brandValidation($data);
        if (!$validation) {
            Notification::error('Thêm không thành công', 'Dữ liệu không hợp lệ.');
            header('location: /admin/brand/add?status=failed&code=1');
            exit();
        } else {
            $target_dir = "public/Uploads/Brands/";

            if (Validator::image()->validate($_FILES["image"]["tmp_name"])) {
                $temp = explode(".", $_FILES["image"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
                    $BrandModel = new BrandModel();
                    $data['image'] = $newfilename;
                    $result = $BrandModel->store($data);
                    if ($result) {
                        Notification::success('Thêm thành công', 'Thương hiệu đã được thêm.');
                        header('location: /admin/brand/add?status=success');
                        exit();
                    } else {
                        Notification::error('Thêm không thành công', 'Lỗi khi thêm thương hiệu.');
                        header('location: /admin/brand/add?status=failed&code=2');
                    }
                } else {
                    Notification::error('Thêm không thành công', 'Không thể tải lên hình ảnh.');
                    header('location: /admin/brand/add?status=failed&code=3');
                    exit();
                }
            } else {
                Notification::error('Thêm không thành công', 'Tệp hình ảnh không hợp lệ.');
                header('location: /admin/brand/add?status=failed&code=4');
                exit();
            }
        }
    }

    public function update($params)
    {
        $id = $params['id'];
        $data = [];

        foreach ($_POST as $input => $value) {
            $data[$input] = $value;
        }

        $validation = BrandValidation::brandValidation($data);
        if (!$validation) {
            Notification::error('Cập nhật không thành công', 'Dữ liệu không hợp lệ.');
            header('location: /admin/brands?status=failed&code=1');
            exit();
        }

        if (isset($_FILES['image']['tmp_name']) && Validator::image()->validate($_FILES['image']['tmp_name'])) {
            $target_dir = 'public/Uploads/Brands/';
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
                $BrandModel = new BrandModel();
                $data['image'] = $newfilename;
                $result = $BrandModel->update($id, $data);
                if ($result) {
                    Notification::success('Cập nhật thành công', 'Thương hiệu đã được cập nhật.');
                    header('location: /admin/brands?status=success');
                    exit();
                } else {
                    Notification::error('Cập nhật không thành công', 'Lỗi khi cập nhật thương hiệu.');
                    header('location: /admin/brands?status=failed&code=2');
                    exit();
                }
            } else {
                Notification::error('Cập nhật không thành công', 'Không thể tải lên hình ảnh.');
                header('location: /admin/brands?status=failed&code=3');
                exit();
            }
        } else {
            $BrandModel = new BrandModel();
            $result = $BrandModel->update($id, $data);
            if ($result) {
                Notification::success('Cập nhật thành công', 'Thương hiệu đã được cập nhật.');
                header('location: /admin/brands?status=success');
                exit();
            } else {
                Notification::error('Cập nhật không thành công', 'Lỗi khi cập nhật thương hiệu.');
                header('location: /admin/brands?status=failed&code=2');
                exit();
            }
        }
    }

    public function delete($params)
    {
        $id = $params['id'];
        $BrandModel = new BrandModel();
        $result = $BrandModel->delete($id);
        if ($result) {
            Notification::success('Xóa thành công', 'Thương hiệu đã được xóa.');
            header('location: /admin/brands?action=delete&status=success');
            exit();
        } else {
            Notification::error('Xóa không thành công', 'Lỗi khi xóa thương hiệu.');
            header('location: /admin/brands?action=delete&status=failed&code=5');
            exit();
        }
    }
}