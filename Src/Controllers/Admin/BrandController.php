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
        echo $this->view->render('Admin/Pages/Brands/BrandAdd');
    }
    public function edit()
    {
        echo $this->view->render('Admin/Pages/Brands/BrandEdit');
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
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;

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
}
