<?php

namespace Src\Helpers\Client;

use Exception;
use Src\Models\Admin\OrderModel;
use Src\Models\Client\OrderModel as ClientOrderModel;

class VNPayHelper
{
    private $tmnCode;
    private $hashSecret;
    private $test_url;
    private $vnp_return_url;
    private $expire;

    public function __construct()
    {
        $this->tmnCode = $_ENV['vnp_TmnCode'];
        $this->hashSecret = $_ENV['vnp_HashSecret'];
        $this->test_url = $_ENV['vnp_test_url'];
        $this->vnp_return_url = $_ENV['vnp_return_url'];
    }

    public function createPayment($amount, $orderInfo, $orderId)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes'));

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->tmnCode,
            "vnp_Amount" => $amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $startTime,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => 'vn',
            "vnp_OrderInfo" => $orderInfo,
            "vnp_OrderType" => "VNPAY",
            "vnp_ReturnUrl" => $this->vnp_return_url,
            "vnp_TxnRef" => $orderId,
            "vnp_ExpireDate" => $expire
        );

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->test_url . "?" . $query;
        if (isset($this->hashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $this->hashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );


        if (isset($_POST['payment-method'])) {
            return $returnData;
        } else {
            return false;
        }
    }

    public function response()
    { {
            $orderId = $_GET['vnp_TxnRef'];
            $vnp_SecureHash = $_GET['vnp_SecureHash'];
            $inputData = array();
            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }

            unset($inputData['vnp_SecureHash']);
            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }

            $secureHash = hash_hmac('sha512', $hashData, $this->hashSecret);
            if ($secureHash == $vnp_SecureHash) {
                if ($_GET['vnp_ResponseCode'] == '00') {
                    return ['status' => 'success', 'order_id' => $orderId];
                } else {
                    return ['error' => 1, 'order_id' => $orderId];
                }
            } else {
                return ['error' => 2, ['order_id'] => $orderId];
            }
        }
    }
}
