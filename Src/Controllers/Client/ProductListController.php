<?php
    namespace Src\Controllers\Client;

    use Src\Controllers\BaseController;
    use Src\Models\Client\ProductModel;
    use Src\Models\Admin\CategoryValueModel;
    use Src\Models\Admin\CategoryModel;
    use Src\Models\Admin\BrandModel;

    class ProductListController extends BaseController {
        public function show() {
            $productModel = new ProductModel();
            $CategoryModel = new CategoryModel;
            $BrandModel = new BrandModel();
            $categories = $CategoryModel->getAllActiveCategories();
            $brands = $BrandModel->getAllActiveBrands();
            $productData = $productModel->getAllProductWithSkus();
            
    
            echo $this->view->render('Client/Pages/Product/List', [
                'productData' => $productData,
                'categories' => $categories,
                'brands' => $brands
            ]);
        }

        public function selectResult()
        {
            $categoryModel = new CategoryValueModel();
            $categoryModel->getChildCategories();
        }

        public function filterResult(){
            $productModel = new ProductModel();
            $productModel->filterProduct();
        }
    }
?>