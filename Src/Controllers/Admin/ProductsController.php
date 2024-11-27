<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\BrandModel;
use Src\Models\Admin\ProductCategoryModel;
use Src\Models\Admin\SkuModel;
use Src\Models\Database;
use Src\Validations\Admin\ProductValidation;
use Src\Models\Admin\ProductModel;
use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\CategoryValueModel;
use Src\Models\Admin\ProductSkuModel;
use Src\Models\Admin\AttributeModel;
use Respect\Validation\Validator as v;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;
use Phinx\Db\Table\Index;
use Respect\Validation\Validator;
use Src\Models\Admin\ProductOptionModel;
use Src\Models\Admin\SkuValuesModel;
use Src\Notifications\Notification;
use Symfony\Component\Console\Helper\Dumper;

class ProductsController extends BaseController
{

    public function deleteSku($params) {
        $product_id = $params['product_id'];
        $sku_id = $params['sku_id'];
        
        $SkuModel = new ProductSkuModel();
        
        $variant_data = $SkuModel->getAllSkuByProduct($product_id);
        if(count($variant_data) < 2) {
            Notification::error('Xóa thất bại', 'Không thể xóa sản phẩm chỉ có 1 SKU');
            header('location:/admin/product/detail/' . $product_id);
            exit();
        }

        $result = $SkuModel->deleteSku($sku_id);
        if($result) {
            Notification::success('Xóa thành công', 'Đã xóa thành công SKU');
            header('location:/admin/product/detail/' . $product_id);
            exit();
        }
    }
    public function variantEdit($params) {
        $variant_id = $params['sku_id'];
        $product_id = $params['product_id'];

        $option = new AttributeModel();
        $options = $option->getAllAttribute();

        $SkuValues = new SkuValuesModel;
        $variant_data = $SkuValues->getAllOptionOfSku($variant_id);
        echo $this->view->render('Admin/Pages/Products/EditVariant', ['variant_data' => $variant_data, 'options' => $options]);
    }

    public function deleteProperty($params) {
        $database = new Database;

        $conn = $database->MySQLi();
        $conn->begin_transaction();

        $optionValModel = new ProductOptionModel();

        $optionVal = $params['option_value'];

        $optionValDel = $optionValModel->deleteOptionValue($optionVal);
        if($optionValDel) {
            Notification::success('Xóa thành công', 'Đã xóa thuộc tính');
        } else {
            Notification::error('Xóa thất bại', 'Đã xóa thuộc tính thất bại' . $optionValDel);
        }
    }
    public function updateVariant($params) {

        $database = new Database();
        $conn = $database->MySQLi();

        $SkuValuesModel = new SkuValuesModel();
        $optionValueModel = new ProductOptionModel();
        $skuModel = new ProductSkuModel();
        $productModel = new ProductModel();


        $skuId = $params['sku_id'];
        $productId = $params['product_id']; 

        $productData = $productModel->getOneNormal($productId);
        $currSku = $skuModel->getOne($skuId);
        $allSkuData = $SkuValuesModel->getAllOptionOfSku($skuId);

        $option_values_id = [];
        $option_values_data = [];
        $option_values_insert_data = [];
        $product_sku_data = [
            'sku' => $_POST['sku'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
        ];

        if(!empty($_FILES['images']['name'])) {
            $target_dir = 'public/Uploads/Products/';
            if (!v::image()->validate($_FILES['images']['tmp_name'])) {
                Notification::error('Thêm thất bại', 'Hình ảnh sản phẩm không hợp lệ');
                header('location: /admin/edit-variant/' . $productId . '/' . $skuId);

                exit();
            }
            $bin2hex = bin2hex(random_bytes(10));
            $name_temp = explode(".", $_FILES['images']['name']);
            $newName = $bin2hex . '_' . round(microtime(true)) . '.' . end($name_temp);
            if (!move_uploaded_file($_FILES['images']['tmp_name'], $target_dir . $newName)) {
                Notification::error('Sửa thất bại', 'Lỗi khi upload hình ảnh sản phẩm!');
                header('location: /admin/edit-variant/' . $productId . '/' . $skuId);

                exit();
            }
            $product_sku_data['images'] = $newName;
        }

        $SkuUpdate = $skuModel->updateSku($skuId, $product_sku_data);
        if(!$SkuUpdate) {
            Notification::error('Sửa thất bại', 'Lỗi khi update SKU!');
                 header('location: /admin/edit-variant/' . $productId . '/' . $skuId);

            exit();
        }

        $totalQuantity = $productData['total_quantity'];
        $tmp = 0;
        echo '<pre>';

        if($currSku['quantity'] < $_POST['quantity']) {
            $tmp = $_POST['quantity'] - $currSku['quantity'];
            $totalQuantity += $tmp;
        } else if($currSku['quantity'] === $_POST['quantity']) {
            $totalQuantity = $productData['total_quantity'];
        } else {
            $tmp = $currSku['quantity'] - $_POST['quantity'] ;
            $totalQuantity -= $tmp;
        }

        $updateTotalQuantity = $productModel->update($productId, ['total_quantity' => $totalQuantity]);
        if(!$updateTotalQuantity) {
            $conn->rollback();
            Notification::error('Sửa thất bại', 'Đã xảy ra lỗi ở quá trình sửa số lượng sản phẩm');

                header('location: /admin/edit-variant/' . $productId . '/' . $skuId);
                exit();
        }

        foreach($_POST['value_name'] as $index => $value) {
            if(!isset($allSkuData[$index]['value_name'])){
                $option_values_insert_data[] = [
                    'product_id' => $productId,
                    'option_id' => $_POST['option_id'][$index],
                    'value_name' => $value
                ];
                continue;
            }



            if(strcmp($allSkuData[$index]['value_name'], $value) != 0) {
                $option_values_data[] = [
                    'value_name' => $value
                ];
                $option_values_id[] = [$allSkuData[$index]['value_id']];
            }
        }


        $returnedId = [];
        $conn->begin_transaction();
            foreach($option_values_insert_data as $dataInsert) {
                $returnedId[] = $optionValueModel->storeReturnId($dataInsert);
            }


        foreach($returnedId as $id) {
            if(!isset($id) || empty($id) || !$id) {
                Notification::error('Sửa thất bại', 'Đã xảy ra lỗi ở quá trình thêm values');
                $conn->rollback();
                header('location: /admin/edit-variant/' . $productId . '/' . $skuId);
                exit();
            }
        }

        $skuValuesInsertData = [];
        $indexValue = 0;
        foreach($_POST['option_id'] as $index => $option_id) {
            if(!isset($allSkuData[$index]['option_id'])) {
                $skuValuesInsertData[] = [
                    'sku_id' => $skuId,
                    'option_id' => $option_id,
                    'value_id' => $returnedId[$indexValue]
                ];
                $indexValue++;
                continue;
            }
            if($allSkuData[$index]['option_id'] !== (int)$option_id) {
                $option_values_data[$index]['option_id'] = $option_id;
            }
        }
        $result = [];
        foreach($option_values_data as $index => $option_value) {
            $result[] = $optionValueModel->updateValue($option_values_id[$index][0], $option_value);
        }

        foreach( $skuValuesInsertData as $skuData) {
            $result[] = $SkuValuesModel->store($skuData);
        }

        foreach($result as $query) {
            if(!$query) {
                Notification::error('Sửa thất bại', 'Đã xảy ra lỗi ở quá trình sửa biến thể');
                $conn->rollback();
                header('location: /admin/edit-variant/' . $productId . '/' . $skuId);
                exit();
            }
        }
        Notification::success('Sửa thành công', 'Đã cập nhật thông tin');
        header('location: /admin/edit-variant/' . $productId . '/' . $skuId);
        $conn->commit();
    }
    public function index()
    {
        $ProductModel = new ProductModel();
        $data = $ProductModel->getAllProduct();
        echo $this->view->render('Admin/Pages/Products/ProductList', ['data' => $data]);
    }
    public function show($params)
    {
        $id = $params['id'];
        $ProductModel = new ProductModel();
        $data = $ProductModel->getOneProduct($id);
        $variant = $ProductModel->getVariantOfProduct($id);
        echo $this->view->render(
            'Admin/Pages/Products/ProductDetail',
            ['data' => $data, 'variant' => $variant]
        );
    }

    public function add()
    {
        $BrandModel = new BrandModel();
        $CategoryModel = new CategoryModel;
        $brands = $BrandModel->getAllActiveBrands();
        $categories = $CategoryModel->getAllActiveCategories();
        $option = new AttributeModel();
        $options = $option->getAllAttribute();
        echo $this->view->render('Admin/Pages/Products/ProductAdd', ['brands' => $brands,   'categories' => $categories, 'options' => $options]);
    }
    public function store()
    {
        $data = [
            'name' => $_POST['name'] ?? null,
            'description' => $_POST['description'] ?? null,
            'brand_id' => $_POST['brand'] ?? null,
            'status' => $_POST['status'] ?? null,
            'discount' => $_POST['discount'] ?? 0,
            'specifications' => []
        ];

        foreach ($data as $input => $value) {
            if ($input === 'specifications') {
                continue;
            }
            if (empty($value) || $value === null) {
                Notification::error('Thêm thất bại', 'Vui lòng nhập đầy đủ thông tin');
                header('location:/admin/product/add');
                exit();
            }
        }

        $errors = [];
        $thumbnail = [];
        $thumbnail_name = [];
        $thumbnail_tmp = [];
        if (isset($_FILES['thumbnail'])) {
            $target_dir = 'public/Uploads/Products/';
            for ($i = 0; $i < count($_FILES['thumbnail']['name']); $i++) {
                $thumbnail_name[] = $_FILES['thumbnail']['name'][$i];
                $thumbnail_tmp[] = $_FILES['thumbnail']['tmp_name'][$i];
            }

            foreach ($thumbnail_tmp as $tmp_name) {
                if (!v::image()->validate($tmp_name)) {
                    Notification::error('Thêm thất bại', 'Hình ảnh sản phẩm không hợp lệ');
                    header('location: /admin/product/add');
                    exit();
                }
            }
            foreach ($thumbnail_name as $index => $value) {
                $bin2hex = bin2hex(random_bytes(10));
                $thumbnail_temp = explode(".", $value);
                $newThumbnail = $bin2hex . '_' . round(microtime(true)) . '.' . end($thumbnail_temp);
                $thumbnail[] = $newThumbnail;
            }

            foreach ($thumbnail as $index => $item) {
                if (!move_uploaded_file($thumbnail_tmp[$index], $target_dir . $item)) {
                    Notification::error('Thêm thất bại', 'Lỗi khi upload hình ảnh sản phẩm!');
                    header('location:/admin/product/add');
                    exit();
                }
            }
            $fileName = implode(',', $thumbnail);
            $data['thumbnail'] = $fileName;
        } else {
            Notification::error('Thêm thất bại', 'Vui lòng thêm hình ảnh sản phẩm');
            header('location: /admin/product/add');
            exit();
        }

        // Specifications file upload handling
        if (isset($_FILES['specifications_file']) && $_FILES['specifications_file']['error'] == 0) {
            $filePath = $_FILES['specifications_file']['tmp_name'];
            $fileType = pathinfo($_FILES['specifications_file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileType), ['xls', 'xlsx'])) {
                $errors[] = 'Bạn cần phải tải lên file excel thông số kỹ thuật (.xls, .xlsx).';
            }

            if ($_FILES['specifications_file']['size'] > 10485760) { // 10MB max
                $errors[] = 'File quá lớn. Vui lòng tải lên file dưới 10MB.';
            }

            if (empty($errors)) {
                try {
                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
                    $specifications = [];

                    // Duyệt qua các dòng của sheet
                    foreach ($sheet->getRowIterator() as $row) {
                        $specName = $sheet->getCell('A' . $row->getRowIndex())->getValue();  // Cột A: Tên thuộc tính
                        $specValue = $sheet->getCell('B' . $row->getRowIndex())->getValue(); // Cột B: Giá trị thuộc tính

                        if (!empty($specName) && !empty($specValue)) {
                            $specifications[] = [
                                'spec_name' => $specName,
                                'spec_value' => $specValue,
                            ];
                        }
                    }

                    if (empty($specifications)) {
                        $errors[] = 'No valid product specifications found in the Excel file.';
                    } else {
                        $data['specifications'] = json_encode($specifications, JSON_UNESCAPED_UNICODE);
                    }
                } catch (Exception $e) {
                    $errors[] = 'Error reading Excel file: ' . $e->getMessage();
                }
            }
        } else {
            $errors[] = 'No Excel file uploaded or error during upload.';
            Notification::error('Thêm thất bại', 'Đã xảy ra lỗi khi upload file excel!');
            header('location:/admin/product/add');
            exit();
        }


        $validationResult = ProductValidation::productValidation($data);

        if (empty($errors)) {
            $database = new Database();
            $conn = $database->MySQLi();
            $conn->begin_transaction();
            try {
                $productModel = new ProductModel();
                $product_insert = $productModel->createReturnProductId($data);


                if (!$product_insert) {
                    $errors[] = 'No Excel file uploaded or error during upload.';
                    echo $this->view->render('Admin/Pages/Products/ProductAdd', [
                        'data' => $data,
                        'errors' => $errors
                    ]);
                    exit();
                }
                $ProductCategory = new ProductCategoryModel;
                $CategoryValueId = $_POST['child_category'];

                if (empty($CategoryValueId) || !is_numeric($CategoryValueId)) {
                    Notification::error('Thêm thất bại', 'Danh mục sản phẩm không hợp lệ!');
                    header('location: /admin/product/add');
                    exit();
                }


                $ProductCategoryData = ['category_values_id' => $CategoryValueId, 'product_id' => $product_insert];
                $ProductCategoryInsert = $ProductCategory->store($ProductCategoryData);
                if (!$ProductCategoryInsert) {
                    Notification::error('Thêm thất bại', 'Đã xảy ra lỗi khi danh mục sản phẩm');
                    header('location: /admin/product/add');
                }


                $skuDataInsert = [];
                $skuModel = new SkuModel();
                $skuValuesModel = new SkuValuesModel();
                $optionModel = new ProductOptionModel();

                foreach ($_POST['sku'] as $sku) {

                    if (empty($sku['price']) || !is_numeric($sku['price'])) {
                        Notification::error('Thêm thất bại', 'Giá sản phẩm không hợp lệ!');
                        header('location: /admin/product/add');
                        exit();
                    }
                    $skuDataInsert[] = [
                        'sku' => $sku['sku'],
                        'price' => $sku['price'],
                        'quantity' => $sku['quantity'],
                        'product_id' => $product_insert
                    ];
                }
                $images = [];
                $tmp_name = [];
                $target_dir =  "public/Uploads/Products/";
                foreach ($_FILES['sku']['tmp_name'] as $index => $skuTmp) {
                    if (v::image()->validate($skuTmp['images'])) {
                        $tmp_name[] = $skuTmp['images'];
                    } else {
                        Notification::error('Thêm thất bại', 'Hình ảnh biến thể không hợp lệ!');
                        header('location:/admin/product/add');
                        exit();
                    }
                }
                foreach ($_FILES['sku']['name'] as $index => $value) {
                    $bin2hex = bin2hex(random_bytes(5));
                    $temp = explode(".", $value['images']);
                    $newfilename = $bin2hex . '_' . round(microtime(true)) . '.' . end($temp);
                    $images[] = $newfilename;
                }

                foreach ($tmp_name as $index => $temp_name) {
                    if (!move_uploaded_file($temp_name, $target_dir . $images[$index])) {
                        Notification::error('Thêm thất bại', 'Lỗi khi upload hình ảnh biến thể!');
                        header('location:/admin/product/add');
                        exit();
                    }
                }

                foreach ($skuDataInsert as $index => $skuDataValues) {
                    $skuDataInsert[$index]['images'] = $images[$index];
                }

                foreach ($skuDataInsert as $skuData) {
                    $insertData[] = $skuModel->storeReturnId($skuData);
                }

                foreach ($insertData as $dataCheck) {
                    if ($dataCheck === false) {
                        Notification::error('Thêm thất bại', 'Đã xảy ra lỗi khi thêm SKU!');
                        header('location:/admin/product/add');
                        exit();
                    }
                }

                $optionData = [];
                $option_values_id = [];
                $skuPost = $_POST['sku'];
                $options_index = 0;
                foreach ($skuPost as $singleSku => $value) {
                    $skuPost[$singleSku]['sku_id'] = $insertData[$options_index];
                    $options_index++;

                    $option = [];

                    foreach ($value['option'] as $options) {
                        if (isset($options['option_id'])) {
                            $option['option_id'] = $options['option_id']; // Lưu option_id
                        }
                        if (isset($options['value_name'])) {
                            $option['value_name'] = $options['value_name']; // Lưu value_name
                        }

                        if (isset($option['option_id']) && isset($option['value_name'])) {
                            $optionData[] = [
                                'option_id' => $option['option_id'],
                                'value_name' => $option['value_name']
                            ];
                            $option = [];
                        }
                    }
                }

                foreach ($optionData as $option) {
                    $option['product_id'] = $product_insert;
                    $option_values_id[] = $optionModel->storeReturnId($option);
                }

                foreach ($option_values_id as $dataCheck) {
                    if ($dataCheck === false) {
                        Notification::error('Thêm thất bại', 'Đã xảy ra lỗi khi thêm SKU!');
                        header('location:/admin/product/add');
                        exit();
                    }
                }

                $SkuValuesResult = [];
                $sku_data['product_id'] = $product_insert;

                $SkuValuesResult = [];
                $valueIndex = 0;


                foreach ($skuPost as $item) {
                    if (isset($item['option'], $item['sku_id'])) {
                        $options = $item['option'];
                        for ($i = 0; $i < count($options); $i += 2) {
                            if (isset($options[$i]['option_id'], $options[$i + 1]['value_name'])) {
                                $SkuValuesResult[] = [
                                    'sku_id' => $item['sku_id'],
                                    'option_id' => $options[$i]['option_id'],
                                    'value_id' => $option_values_id[$valueIndex]
                                ];
                                $valueIndex++;
                            }
                        }
                    }
                }
                var_dump($skuPost);
                $totalQuantity = 0;
                foreach($skuPost as $sku) {
                    $totalQuantity += $sku['quantity'];
                }

                $quantityInsert = $productModel->updateProduct($product_insert, ['total_quantity' => $totalQuantity]);

                if(!$quantityInsert) {
                    Notification::error('Thêm thất bại', 'Đã xảy ra lỗi khi thêm!');
                    $conn->rollback();
                    header('location:/admin/product/add');
                    exit();
                }
                $result = [];
                foreach ($SkuValuesResult as $skuValue) {

                    $result = $skuValuesModel->store($skuValue);
                }
                $conn->commit();
                if ($result === false) {
                    Notification::error('Thêm thất bại', 'Đã xảy ra lỗi khi thêm SKU!');
                    header('location:/admin/product/add');
                    exit();
                } else {
                    Notification::success('Thêm thành công', 'Đã thêm sản phẩm thành công!');
                    header('location:/admin/product/add');
                    exit();
                }
            } catch (Exception $e) {
                $conn->rollback();
                error_log('Lỗi: ' . $e->getMessage());
            }
            exit();
        }
    }
    public function edit($params)
    {
        $id = $params['id'];
        $ProductModel = new ProductModel();
        $data = $ProductModel->getOneProduct($id);
        $brandModel = new BrandModel();
        $CategoryModel = new CategoryModel();
        $categories = $CategoryModel->getAllActiveCategories();
        $brand_data = $brandModel->getAllActiveBrands();
        $productCategory = $ProductModel->getProductCategories($id);
        $categoryValueModel = new CategoryValueModel();
        $child_category = $categoryValueModel->getChildCategoriesWithParentId($data['category_id']);
        echo $this->view->render('/Admin/Pages/Products/ProductEdit', ['data' => $data, 'brands' => $brand_data, 'categories' => $categories, 'product_category' => $productCategory, 'child_category' => $child_category]);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ProductModel = new ProductModel();

            $deleteSuccess = $ProductModel->deleteProduct($id['id']);

            if ($deleteSuccess) {
                header('Location: /admin/products?status=success ');
            } else {
                header('Location: /admin/products?status=failed ');
            }
        }
    }

    public function selectResult()
    {
        $categoryModel = new CategoryValueModel();
        $categoryModel->getChildCategories();
    }
    public function update($params)
    {
        $database = new Database();
        $conn = $database->MySQLi();
        $id = $params['id'];
        $data = [];
        $productCategoryData = [];
        foreach ($_POST as $key => $input) {
            if ($key === 'child_category') {
                $productCategoryData['category_values_id'] = $input;
                continue;
            }
            if (empty($input) || $input === null || $key === 'categories') {
                continue;
            }
            $data[$key] = $input;
        };
        $conn->begin_transaction();
        if (isset($_FILES['thumbnail']) && !empty($_FILES['thumbnail'])) {
            $target_dir = 'public/Uploads/Products/';
            for ($i = 0; $i < count($_FILES['thumbnail']['name']); $i++) {
                $thumbnail_name[] = $_FILES['thumbnail']['name'][$i];
                $thumbnail_tmp[] = $_FILES['thumbnail']['tmp_name'][$i];
            }
            if (!empty($thumbnail_tmp[0])) {
                foreach ($thumbnail_tmp as $tmp_name) {
                    if (!v::image()->validate($tmp_name)) {
                        Notification::error('Thêm thất bại', 'Hình ảnh sản phẩm không hợp lệ');
                        header('location: /admin/product/detail/' . $id);
                        exit();
                    }
                }
                foreach ($thumbnail_name as $index => $value) {
                    $bin2hex = bin2hex(random_bytes(10));
                    $thumbnail_temp = explode(".", $value);
                    $newThumbnail = $bin2hex . '_' . round(microtime(true)) . '.' . end($thumbnail_temp);
                    $thumbnail[] = $newThumbnail;
                }
                foreach ($thumbnail as $index => $item) {
                    if (!move_uploaded_file($thumbnail_tmp[$index], $target_dir . $item)) {
                        Notification::error('Thêm thất bại', 'Lỗi khi upload hình ảnh sản phẩm!');
                        header('location:/admin/product/add');
                        exit();
                    }
                }
                $fileName = implode(',', $thumbnail);
                $data['thumbnail'] = $fileName;
            }
        }

        $ProductCategory = new ProductCategoryModel();
        $fetchProductCategory = $ProductCategory->findCategory($id);
        $ProductModel = new ProductModel();
        $updateCategory = $ProductCategory->updateCategory($fetchProductCategory['id'], $productCategoryData);
        $result = $ProductModel->updateProduct($id, $data);




        if (!$updateCategory) {
            Notification::error('Thao tác thất bại', 'Có lỗi đã xảy ra trong quá trình update phân loại');
            header('location: /admin/product/detail/' . $id);
            exit();
        }

        if (!$result) {
            Notification::error('Thao tác thất bại', 'Có lỗi đã xảy ra');
            header('location: /admin/product/detail/' . $id);
            $conn->rollback();
            exit();
        } else {
            Notification::success('Thành công', 'Đã cập nhật thông tin sản phẩm');
            header('location: /admin/product/detail/' . $id);
            $conn->commit();
            exit();
        }
    }


    public function specificationEdit($params) {
        $id = $params['id'];
        $productModel = new ProductModel();
        $data = $productModel->getOneProduct($id);
        echo $this->view->render('Admin/Pages/Products/SpecificationsEdit', ['data' => $data]);
    }

    public function updateSpecs($params) {
        $id = $params['id'];
        $data = [
            'specifications' => []
        ];
        if(empty($_FILES['specifications_file']['name'])) {
            Notification::error('Sửa thất bại', 'Vui lòng tải lên file Excel');
            header('location: /admin/edit-specification/' . $id);
            exit();
        }

        if (isset($_FILES['specifications_file']) && $_FILES['specifications_file']['error'] == 0) {
            $filePath = $_FILES['specifications_file']['tmp_name'];
            $fileType = pathinfo($_FILES['specifications_file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileType), ['xls', 'xlsx'])) {
                $errors[] = 'Bạn cần phải tải lên file excel thông số kỹ thuật (.xls, .xlsx).';
            }

            if ($_FILES['specifications_file']['size'] > 10485760) { // 10MB max
                $errors[] = 'File quá lớn. Vui lòng tải lên file dưới 10MB.';
            }

            if (empty($errors)) {
                try {
                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
                    $specifications = [];

                    // Duyệt qua các dòng của sheet
                    foreach ($sheet->getRowIterator() as $row) {
                        $specName = $sheet->getCell('A' . $row->getRowIndex())->getValue();  // Cột A: Tên thuộc tính
                        $specValue = $sheet->getCell('B' . $row->getRowIndex())->getValue(); // Cột B: Giá trị thuộc tính

                        if (!empty($specName) && !empty($specValue)) {
                            $specifications[] = [
                                'spec_name' => $specName,
                                'spec_value' => $specValue,
                            ];
                        }
                    }

                    if (empty($specifications)) {
                        $errors[] = 'No valid product specifications found in the Excel file.';
                    } else {
                        $data['specifications'] = json_encode($specifications, JSON_UNESCAPED_UNICODE);
                    }
                } catch (Exception $e) {
                    $errors[] = 'Error reading Excel file: ' . $e->getMessage();
                }
            }
        } else {
            Notification::error('Sửa thất bại', 'Đã xảy ra lỗi khi upload file excel!');
            header('location: /admin/product/detail/' . $id);
            exit();
        }
        $ProductModel = new ProductModel();
        $result = $ProductModel->updateProduct($id, $data);
        if($result) {
            Notification::success('Cập nhật thành công', 'Đã cập nhật thành công thông số kỹ thuật');
            header('location: /admin/product/detail/' . $id);
            exit();
        } else {
            Notification::error('Cập nhật thất bại', 'Đã xảy ra lỗi');
            header('location: /admin/product/detail/' . $id);
            exit();
        }
        
    } 
}
