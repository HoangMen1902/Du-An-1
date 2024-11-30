<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\AttributeModel;
use Src\Validations\Admin\AttributeValidation;
use Src\Notifications\Notification;

class AttributeController extends BaseController {

    public function show() {
        $attributeModel = new AttributeModel();
        $data = $attributeModel->getAllAttribute();

        $statusMessage = '';
        if (isset($_SESSION['status_message'])) {
            $statusMessage = $_SESSION['status_message'];
            unset($_SESSION['status_message']); 
        }

        echo $this->view->render('Admin/Pages/Attribute/AttributeList', [
            'data' => $data,
            'statusMessage' => $statusMessage,
        ]);
    }

    public function add() {
        echo $this->view->render('Admin/Pages/Attribute/AttributeAdd');
    }

    public function store() {
        $errors = [];
        $attributeModel = new AttributeModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            $validation = AttributeValidation::attributeValidation([
                'name' => $name,
            ]);

            if ($validation !== true) {
                $errors = $validation; 
            } else {
                $data = [
                    'name' => $name,
                ];

                if ($attributeModel->createAttribute($data)) {
                    $_SESSION['status_message'] = 'Thuộc tính đã được thêm thành công!';
                    Notification::success('Thêm thành công', 'Thuộc tính đã được thêm.');
                    header("Location: /admin/allAttribute");
                    exit();
                } else {
                    $errors[] = "Có lỗi khi tạo thuộc tính. Vui lòng thử lại.";
                    Notification::error('Thêm không thành công', 'Có lỗi xảy ra khi thêm thuộc tính.');
                }
            }
        }

        echo $this->view->render('Admin/Pages/Attribute/AttributeAdd', [
            'errors' => $errors
        ]);
    }

    public function edit($params) {
        $id = $params['id'];
    
        $attributeModel = new AttributeModel();
        $data = $attributeModel->getOneAttribute($id);
    
        if (!$data) {
            Notification::error('Không tồn tại', 'Thuộc tính không tồn tại.');
            header("Location: /admin/attributes?status=failed");
            exit();
        }
    
        echo $this->view->render('Admin/Pages/Attribute/AttributeEdit', [
            'data' => $data
        ]);
    }

    public function update($id) {
        $attributeModel = new AttributeModel();
        $attribute = $attributeModel->getOneAttribute($id['id']);
        $errors = [];

        if (!$attribute) {
            Notification::error('Không tồn tại', 'Thuộc tính không tồn tại.');
            header("Location: /admin/attribute-edit/$id?status=failed");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            $validation = AttributeValidation::editAttributeValidation([
                'name' => $name,
            ], $id);

            if ($validation !== true) {
                $errors = $validation; 
            } else {
                $data = [
                    'name' => $name,
                ];

                if ($attributeModel->updateAttribute($id['id'], $data)) {
                    $_SESSION['status_message'] = 'Thuộc tính đã được cập nhật thành công!';
                    Notification::success('Cập nhật thành công', 'Thuộc tính đã được cập nhật.');
                    header("Location: /admin/allAttribute");
                    exit();
                } else {
                    $errors[] = "Có lỗi khi cập nhật thuộc tính. Vui lòng thử lại.";
                    Notification::error('Cập nhật không thành công', 'Có lỗi xảy ra khi cập nhật thuộc tính.');
                }
            }
        }

        echo $this->view->render('Admin/Pages/Attribute/AttributeEdit', [
            'attribute' => $attribute,
            'errors' => $errors
        ]);
    }

    public function delete($id) {
        $attributeModel = new AttributeModel();
        $errors = [];

        $attribute = $attributeModel->getOneAttribute($id['id']);

        if (!$attribute) {
            $errors[] = "Thuộc tính không tồn tại.";
            Notification::error('Không tồn tại', 'Thuộc tính không tồn tại.');
        } else {
            if ($attributeModel->deleteAttribute($id['id'])) {
                $_SESSION['status_message'] = 'Thuộc tính đã được xóa thành công!';
                Notification::success('Xóa thành công', 'Thuộc tính đã được xóa.');
                header("Location: /admin/allAttribute");
                exit();
            } else {
                $errors[] = "Có lỗi khi xóa thuộc tính. Vui lòng thử lại.";
                Notification::error('Xóa không thành công', 'Có lỗi xảy ra khi xóa thuộc tính.');
            }
        }

        if (!empty($errors)) {
            header("Location: /admin/allAttribute?status=failed&errors=" . urlencode(implode(", ", $errors)));
            exit();
        }
    }
}
