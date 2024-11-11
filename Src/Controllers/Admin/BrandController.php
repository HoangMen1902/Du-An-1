<?php

namespace Src\Controllers\Admin;

use Respect\Validation\Validator as Validator;
use Src\Controllers\BaseController;
use Src\Models\Admin\BrandModel;
use Src\Validations\Admin\BrandValidation;

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
            header('location: /admin/brand/add?status=failed&code=1');
            exit();
        } else {
            $target_dir =  "public/Uploads/Brands/";

            if (Validator::image()->validate($_FILES["image"]["tmp_name"])) {
                $temp = explode(".", $_FILES["image"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
                    $BrandModel = new BrandModel();
                    $data['image'] = $newfilename;
                    $result = $BrandModel->store($data);
                    if ($result) {
                        header('location: /admin/brand/add?status=success');
                        exit();
                    } else {
                        header('location: /admin/brand/add?status=failed&code=2');
                    }
                } else {
                    header('location: /admin/brand/add?status=failed&code=3');
                    exit();
                }
            } else {
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
        if(!$validation) {
            header('location: /admin/brands?status=failed&code=1');
            exit();
        }

        if (Validator::stringType()->notEmpty()->noWhitespace()->validate($_FILES['image']['tmp_file'])) {
            if (Validator::image()->validate($_FILES['image']['tmp_file'])) {
                $target_dir = 'public/Uploads/Brands';
                $temp = explode(".", $_FILES["image"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
                    $BrandModel = new BrandModel();
                    $data['image'] = $newfilename;
                    $result = $BrandModel->update($id, $data);
                    if ($result) {
                        header('location: /admin/brands?status=success');
                        exit();
                    } else {
                        header('location: /admin/brands?status=failed&code=2');
                        exit();
                    }
                } else {
                    header('location: /admin/brands?status=failed&code=3');
                    exit();
                }
            } else {
                header('location: /admin/brands?status=failed&code=4');
            }
        } else {
            $BrandModel = new BrandModel();
            $result = $BrandModel->update($id, $data);
            if ($result) {
                header('location: /admin/brands?status=success');
                exit();
            } else {
                header('location: /admin/brands?status=failed&code=2');
                exit;
            }
        }
    }

    public function delete($params) {
        $id = $params['id'];
        $BrandModel = new BrandModel();
        $result = $BrandModel->delete($id);
        if($result) {
            header('location: /admin/brands?action=delete&status=success');
            exit();
        } else {
            header('location: /admin/brands?action=delete&status=failed&code=5');
            exit();
        }
    }
}
