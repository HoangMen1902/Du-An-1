<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\BrandModel;
use Src\Models\Admin\SkuModel;
use Src\Models\Database;
use Src\Validations\Admin\ProductValidation;
use Src\Models\Admin\ProductModel;
use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\CategoryValueModel;
use Src\Models\Admin\ProductSkuModel;
use Src\Models\Admin\AttributeModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;
use Phinx\Db\Table\Index;
use Src\Models\Admin\ProductOptionModel;
use Src\Models\Admin\SkuValuesModel;

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $data = [
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'brand_id' => $_POST['brand'] ?? null,
                'status' => $_POST['status'] ?? null,
                'discount' => $_POST['discount'] ?? 0,
                'specifications' => []
            ];

            $errors = [];

            // Thumbnail upload handling
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $thumbnailTmpPath = $_FILES['thumbnail']['tmp_name'];
                $thumbnailName = $_FILES['thumbnail']['name'];
                $thumbnailType = pathinfo($thumbnailName, PATHINFO_EXTENSION);
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($thumbnailType), $allowedTypes)) {
                    $targetDir = 'public/Uploads/Products/';

                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $newThumbnailName = uniqid() . '.' . $thumbnailType;
                    $thumbnailPath = $targetDir . $newThumbnailName;

                    if (move_uploaded_file($thumbnailTmpPath, $thumbnailPath)) {
                        $data['thumbnail'] = $newThumbnailName;
                    } else {
                        $errors[] = "Unable to save thumbnail. Please try again.";
                    }
                } else {
                    $errors[] = "Invalid image format for thumbnail. Only JPG, JPEG, PNG, GIF are allowed.";
                }
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
            }


            $validationResult = ProductValidation::productValidation($data);

            if (empty($errors)) {
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



                $skuDataInsert = [];
                $skuModel = new SkuModel();
                $skuValuesModel = new SkuValuesModel();
                $optionModel = new ProductOptionModel();
                foreach ($_POST['sku'] as $sku) {

                    $skuDataInsert[] = [
                        'sku' => $sku['sku'],
                        'price' => $sku['price'],
                        'quantity' => $sku['quantity'],
                        'product_id' => $product_insert
                    ];
                }
                foreach ($skuDataInsert as $skuData) {
                    $insertData[] = $skuModel->storeReturnId($skuData);
                }


                $skuPost = $_POST['sku'];
                foreach ($skuPost as $singleSku => $value) {
                    $skuPost[$singleSku]['sku_id'] = $insertData[$singleSku - 1];
                    foreach ($value['option'] as $index => $options) {
                        $optionData[] = $options;
                    }
                }



                foreach ($optionData as $option) {
                    $option['product_id'] = $product_insert;
                    $option_values_id[] = $optionModel->storeReturnId($option);
                }

                $sku_data['product_id'] = $product_insert;

                foreach ($skuPost as $index => $item) {
                    foreach ($item['option'] as $optionIndex => $option) {
                        $SkuValuesResult[] = [
                            'sku_id' => $item['sku_id'],
                            'option_id' => $option['option_id'],
                            'value_id' => $option_values_id[$optionIndex - 1]
                        ];
                    }
                }

            
                foreach ($SkuValuesResult as $skuValue) {
                    $result = $skuValuesModel->store($skuValue);
                }


            }
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

    public function selectResult(){
        $categoryModel = new CategoryValueModel();
        $categoryModel->getChildCategories();
    }
}
