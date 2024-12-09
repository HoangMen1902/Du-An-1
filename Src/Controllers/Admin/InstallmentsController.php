<?php

namespace Src\Controllers\Admin;

use Src\Validations\Admin\InstallmentsValidation;
use Src\Models\Admin\InstallmentModel;
use Src\Models\Admin\ProductSkuModel;
use Src\Notifications\Notification;

use Src\Controllers\BaseController;

class InstallmentsController extends BaseController
{
    public function show()
    {
        echo $this->view->render('Admin/Pages/InstallmentPlan/InstallmentList');
    }
    public function add()
    {
        echo $this->view->render('Admin/Pages/InstallmentPlan/AddInstallment');
    }
    public function detail()
    {
        echo $this->view->render('Admin/Pages/InstallmentPlan/InstallmentDetail');
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $installmentModel = new ProductSkuModel();

            $skuName = $_POST['sku_name'] ?? null; 
            $skuId = null;

            if ($skuName) {
                $skuId = $installmentModel->getSkuIdByName($skuName);

                if (!$skuId) {
                    Notification::error('Lỗi', 'Không tìm thấy sản phẩm với tên: ' . $skuName);
                    $errors[] = "Không tìm thấy sản phẩm với tên '$skuName'.";
                }
            }

            $data = [
                'sku_id' => $skuId,  
                'interest_rate' => $_POST['interest_rate'] ?? null,
                'term' => $_POST['term'] ?? null,
                'down_payment_rate' => $_POST['down_payment_rate'] ?? [],
            ];

            if (is_array($data['down_payment_rate'])) {
                $data['down_payment_rate'] = implode(',', $data['down_payment_rate']);
            }

            $validationResult = InstallmentsValidation::InstallmentsValidation($data);

            if ($validationResult === true) {
                $installmentModel = new InstallmentModel();
                $saveResult = $installmentModel->createInstallment($data);

                if ($saveResult) {
                    Notification::success('Thành công', 'Đã thêm trả góp thành công');
                    header("Location: /admin/tragop/add");
                    exit();
                } else {
                    Notification::error('Lỗi', 'Có lỗi xảy ra khi thêm trả góp');
                    $errors[] = "Không thể lưu thông tin trả góp. Vui lòng thử lại.";
                }
            } else {
                $errors = $validationResult;
            }

            echo $this->view->render('Admin/Pages/InstallmentPlan/AddInstallment', [
                'data' => $data,
                'errors' => $errors ?? []
            ]);
        } else {
            header("Location:/admin");
            exit();
        }
    }
}
