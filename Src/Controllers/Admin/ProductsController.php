<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\BrandModel;
use Src\Validations\Admin\ProductValidation;
use Src\Models\Admin\ProductModel;
use Src\Models\Admin\ProductSkuModel;
use Src\Models\Admin\AttributeModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;


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
        echo $this->view->render('Admin/Pages/Products/ProductDetail', ['data' => $data]);
    }

    public function add()
    {
        $BrandModel = new BrandModel();
        $brands = $BrandModel->getAllActiveBrands();
        $option = new AttributeModel();
        $options = $option->getAllAttribute();
        echo $this->view->render('Admin/Pages/Products/ProductAdd', ['brands' => $brands, 'options' => $options ]);
    }
    public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => $_POST['name'] ?? null,
            'description' => $_POST['description'] ?? null,
            'brand_id' => $_POST['brand'] ?? null,
            'status' => $_POST['status'] ?? null,
            'discount' => $_POST['discount'] ?? 0,
            'skus' => $_POST['skus'] ?? [],
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
                $errors[] = 'File must be an Excel file (.xls, .xlsx).';
            }

            if ($_FILES['specifications_file']['size'] > 10485760) { 
                $errors[] = 'File is too large. Please upload a file under 10MB.';
            }

            if (empty($errors)) {
                try {
                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
                    $specifications = [];

                    foreach ($sheet->getRowIterator() as $row) {
                        $specName = $sheet->getCell('A' . $row->getRowIndex())->getValue();  
                        $specValue = $sheet->getCell('B' . $row->getRowIndex())->getValue(); 

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

        // SKU validation and handling images for SKUs
        $skuErrors = [];
        if (!empty($data['skus'])) {
            foreach ($data['skus'] as $skuIndex => $sku) {
                if (empty($sku['sku'])) {
                    $skuErrors[] = "SKU at position $skuIndex cannot be empty.";
                }

                // Handle SKU images
                if (isset($_FILES["sku"][$skuIndex]["images"]) && !empty($_FILES["sku"][$skuIndex]["images"]["name"])) {
                    $skuImages = $_FILES["sku"][$skuIndex]["images"];
                    $skuImagePaths = [];
                    foreach ($skuImages["tmp_name"] as $key => $tmpPath) {
                        $skuImageName = $skuImages["name"][$key];
                        $skuImageType = pathinfo($skuImageName, PATHINFO_EXTENSION);
                        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                        if (in_array(strtolower($skuImageType), $allowedTypes)) {
                            $targetDir = 'public/Uploads/SKUs/';

                            if (!is_dir($targetDir)) {
                                mkdir($targetDir, 0777, true);
                            }

                            $newImageName = uniqid() . '.' . $skuImageType;
                            $imagePath = $targetDir . $newImageName;

                            if (move_uploaded_file($tmpPath, $imagePath)) {
                                $skuImagePaths[] = $newImageName;
                            } else {
                                $skuErrors[] = "Unable to save image for SKU $skuIndex. Please try again.";
                            }
                        } else {
                            $skuErrors[] = "Invalid image format for SKU $skuIndex. Only JPG, JPEG, PNG, GIF are allowed.";
                        }
                    }
                    if (!empty($skuImagePaths)) {
                        $data['skus'][$skuIndex]['images'] = json_encode($skuImagePaths, JSON_UNESCAPED_UNICODE);
                    }
                }

                // Handle SKU options and values
                if (isset($_POST['option_id'][$skuIndex])) {
                    $sku['option_values'] = [];
                    $optionIds = $_POST['option_id'][$skuIndex] ?? [];
                    $optionValues = $_POST['option_value'][$skuIndex] ?? [];

                    foreach ($optionIds as $key => $optionId) {
                        if (!empty($optionId) && !empty($optionValues[$key])) {
                            $sku['option_values'][] = [
                                'option_id' => $optionId,
                                'option_value' => $optionValues[$key]
                            ];
                        }
                    }
                }
            }
        }

        // Combine SKU errors with general errors
        $errors = array_merge($errors, $skuErrors);

        // Product validation
        $validationResult = ProductValidation::productValidation($data);

        if ($validationResult === true && empty($errors)) {
            $ProductModel = new ProductModel();
            $ProductSkuModel = new ProductSkuModel();
            $ProductOptionModel = new ProductOptionModel(); // Assuming you have this model for option_values

            // Save product
            $saveResult = $ProductModel->createProduct($data);

            if ($saveResult) {
                foreach ($data['skus'] as $sku) {
                    // Save SKU
                    $skuData = [
                        'sku' => $sku['sku'],
                        'price' => $sku['price'],
                        'quantity' => $sku['quantity'],
                        'product_id' => $saveResult, 
                        'images' => $sku['images'] ?? null
                    ];
                    $skuId = $ProductSkuModel->saveSku($skuData, $saveResult);

                    // Save SKU options and values
                    if (!empty($sku['option_values'])) {
                        foreach ($sku['option_values'] as $optionValue) {
                            $optionData = [
                                'sku_id' => $skuId,
                                'option_id' => $optionValue['option_id'],
                                'value' => $optionValue['option_value']
                            ];
                            $ProductOptionModel->saveOptionValue($optionData); // Assuming this function is available in your model
                        }
                    }
                }

                header("Location: /admin/products?status=success");
                exit();
            } else {
                $errors[] = "Unable to save the product. Please try again.";
            }
        } else {
            $errors = array_merge($errors, is_array($validationResult) ? $validationResult : []);
        }

        echo $this->view->render('Admin/Pages/Products/ProductAdd', [
            'data' => $data,
            'errors' => $errors
        ]);
    } else {
        header("Location: /admin/Product/add");
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

                var_dump($data);
                var_dump($errors);
                var_dump($id);


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
                exit;
            } else {
                header('Location: /admin/products?status=failed ');
            }
        }
    }
}
