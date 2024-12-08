<?php

namespace Src\Helpers\Client;

use Src\Models\Client\AddressModel;
use Src\Controllers\BaseController;
use Src\Notifications\Notification;
use Src\Models\Client\OrderModel;

class ProvinceHelper extends BaseController
{

    public function showAllAddress($id)
    {   
        $id = $_SESSION['user']['id'];
        $addressModel = new AddressModel();
        $results = $addressModel->getUserAddress($id); 
        
        
        echo $this->view->render('Client/Pages/UserAddressManage', [
            'results' => $results
        ]);
    }

    public static function createAddress()
    {
        if (!isset($_SESSION['user']['phone'])) {
            Notification::error('Thao tác thất bại', 'Vui lòng nhập số điện thoại trước khi lưu địa chỉ');
            header('Location: /profile');
            exit;
        }

        $city = $_POST['city'] ?? null;
        $district = $_POST['district'] ?? null;
        $ward = $_POST['ward'] ?? null;
        $address = $_POST['address'] ?? null;
        $phone = $_POST['phone'] ?? null;


        if (!$city || !$district || !$ward || !$address || !$phone) {
            Notification::error('Thao tác thất bại', 'Vui lòng điền đầy đủ thông tin địa chỉ');
            header('Location: /profile');
            exit;
        }

        if (!preg_match('/^\d{10}$/', $phone)) {
            Notification::error('Thao tác thất bại', 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại hợp lệ.');
            header('Location: /profile/address');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $data = [
            'user_id' => $user_id,
            'province_id' => $city,
            'district_id' => $district,
            'ward_id' => $ward,
            'address' => $address,
            'phone' => $phone,
            'status' => 1
        ];

        $addressModel = new AddressModel();

        $result = $addressModel->createAddress($data);

        if ($result) {
            Notification::success('Thành công', 'Địa chỉ đã được lưu thành công');
        } else {
            Notification::error('Thao tác thất bại', 'Đã xảy ra lỗi, vui lòng thử lại');
        }

        header('Location: /profile/address');
        exit;
    }

    public function deleteAddress($id)
{
    $addressModel = new AddressModel();
    $orderModel = new OrderModel();

    $relatedOrders = $orderModel->getOrdersByAddressId($id['id']);
    
    if (!empty($relatedOrders)) {
        Notification::error(
            'Thao tác thất bại',
            'Không thể xóa địa chỉ này vì đang được sử dụng trong các đơn hàng.'
        );
        header('Location: /profile/address');
        exit;
    }

    $delete = $addressModel->delete($id['id']);
    if ($delete) {
        Notification::success('Thao tác thành công', 'Bạn đã xóa thành công địa chỉ này!');
    } else {
        Notification::error('Thao tác thất bại', 'Xóa địa chỉ thất bại!');
    }
    header('Location: /profile/address');
    exit;
}

}
