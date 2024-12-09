<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\SearchModel;
use Src\Models\Client\ProductModel;
use Src\Models\Admin\CategoryValueModel;
use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\BrandModel;

class SearchController extends BaseController
{
    private $searchModel;
    // public function __construct()
    // {
    //     $this->searchModel = new SearchModel();
    // }

    public function show()
    {
        echo $this->view->render('Client/Components/SearchResult', ['Name' => 'Bao']);
    }
    public function search()
    {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $SearchModel = new SearchModel();
            $CategoryModel = new CategoryModel;


            $BrandModel = new BrandModel();
            $categories = $CategoryModel->getAllActiveCategories();
            $brands = $BrandModel->getAllActiveBrands();
            $searchResult = $SearchModel->search($keyword);
            echo $this->view->render('Client/Components/SearchResult', [
                'searchResult' => $searchResult,
                'keyword' => $keyword,
                'categories' => $categories,
                'brands' => $brands,
            ]);
        } else {
            echo ' tìm kiếm thành công cốc';
            header('location: /');
        }
    }
    public function selectResult()
    {
        $categoryModel = new CategoryValueModel();
        $categoryModel->getChildCategories();
    }

    public function filterResult()
    {
        $productModel = new ProductModel();
        $productModel->filterProduct();
    }
}
