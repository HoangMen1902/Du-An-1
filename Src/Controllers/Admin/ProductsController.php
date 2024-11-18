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

class ProductsController extends BaseController
{
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
        echo $this->view->render(
            'Admin/Pages/Products/ProductDetail',
            ['data' => $data,]
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
        echo "<pre>";
        $thumbnail = [];
        $thumbnail_name = [];
        $thumbnail_tmp = [];
        if (isset($_FILES['thumbnail'])) {
            $target_dir = 'public/Uploads/Products';
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
                $thumbnail_temp = explode(".", $value);
                $newThumbnail = round(microtime(true)) . '.' . end($thumbnail_temp);
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
                    $temp = explode(".", $value['images']);
                    $newfilename = round(microtime(true)) . '.' . end($temp);
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
        $brand_data = $brandModel->getAllActiveBrands();
        echo $this->view->render('/Admin/Pages/Products/ProductEdit', ['data' => $data, 'brands' => $brand_data]);
    }
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $id['id'];

            $data = [
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'total_quantity' => $_POST['total_quantity'] ?? 0,
                'brand' => $_POST['brand'] ?? null,
                'status' => $_POST['status'] ?? null,
                'discount' => $_POST['discount'] ?? 0
            ];

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $thumbnailTmpPath = $_FILES['thumbnail']['tmp_name'];
                $thumbnailName = uniqid() . '.' . pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $targetDir = 'public/Uploads/Products/';

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($thumbnailTmpPath, $targetDir . $thumbnailName)) {
                    $data['thumbnail'] = $thumbnailName;
                } else {
                    echo "Lỗi khi tải ảnh thumbnail lên!";
                    return;
                }
            }

            $errors = ProductValidation::productValidation($data, $id);

            if ($errors !== true) {
                $ProductModel = new ProductModel();
                $data = $ProductModel->getOneProduct($id);
                echo $this->view->render('/Admin/Pages/Products/ProductEdit', [
                    'data' => $data,
                    'errors' => $errors,
                ]);




                return;
            }

            $ProductModel = new ProductModel();
            $updateSuccess = $ProductModel->updateProduct($id, $data);

            if ($updateSuccess) {
                header('Location: /admin/products');
                exit;
            } else {
                echo "Cập nhật sản phẩm thất bại!";
            }
        }
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
}
