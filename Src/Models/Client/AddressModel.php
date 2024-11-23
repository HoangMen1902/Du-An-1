<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;
use Throwable;

class AddressModel extends BaseModel
{


    protected $table = "checkout_addresses";
    protected $id = "id";

    public function createAddress($data){
       return $this->create($data);
    }

    public function updateAddress($id, $data){
        return $this->update($id, $data);
    }

    public function getUserAddress($id)
    {
        try {
            $sql = "SELECT 
                        provinces.name AS province_name, 
                        districts.name AS district_name, 
                        wards.name AS ward_name, 
                        checkout_addresses.*
                    FROM checkout_addresses
                    JOIN provinces ON checkout_addresses.province_id = provinces.id
                    JOIN districts ON checkout_addresses.district_id = districts.id
                    JOIN wards ON checkout_addresses.ward_id = wards.id
                    WHERE checkout_addresses.user_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result; 
        } catch (Throwable $e) {
            error_log('Lỗi khi lấy dữ liệu địa chỉ của người dùng: ' . $e->getMessage());
            return []; 
        }
    }

    public function getOneAddress($userId, $addressId)
    {
        try {
            $sql = "SELECT 
                        provinces.name AS province_name, 
                        districts.name AS district_name, 
                        wards.name AS ward_name, 
                        checkout_addresses.*
                    FROM checkout_addresses
                    JOIN provinces ON checkout_addresses.province_id = provinces.id
                    JOIN districts ON checkout_addresses.district_id = districts.id
                    JOIN wards ON checkout_addresses.ward_id = wards.id
                    WHERE checkout_addresses.user_id = ? AND checkout_addresses.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $userId, $addressId); 
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc(); 
            return $result ?: []; 
        } catch (Throwable $e) {
            error_log('Lỗi khi lấy dữ liệu địa chỉ cụ thể của người dùng: ' . $e->getMessage());
            return []; 
        }
    }
    
}
