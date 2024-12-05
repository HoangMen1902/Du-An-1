<?php

namespace Src\Controllers\Client;

use Src\Models\Client\AddressModel;

class ShippingController
{

    public function getGHTKFee()
    {
        $province = $_POST['province_name'];
        $district = $_POST['district_name'];

        $apiUrl = "https://services.giaohangtietkiem.vn/services/shipment/fee";
        $apiKey = "DOC9A1JQHlOHdmQC9HvimdSyMt65ScYFrb3GWd";
        $data = [
            'weight' => 1000,
            'distance' => 15,
            'pick_province' => 'Hồ Chí Minh',
            'pick_district' => 'Quận 5',
            'province' => $province,
            'district' => $district,
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Token: $apiKey",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode !== 200) {
            echo json_encode(['error' => 'Không thể tính phí giao hàng', 'code' => $httpCode]);
            exit;
        }


        $result = json_decode($response, true);

        if (isset($result['fee']['options']['shipMoneyText'])) {

            $shipMoneyText = $result['fee']['options']['shipMoneyText'];
            $shipMoney = preg_replace('/[^0-9]/', '', $shipMoneyText);


            header('Content-Type: application/json');
            echo json_encode(['fee' => $shipMoney]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Không có phí giao hàng trong phản hồi']);
        }
    }
}
