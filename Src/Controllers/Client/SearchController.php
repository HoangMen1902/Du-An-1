<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\SearchModel;

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
            $searchResult = $SearchModel->search($keyword);
            echo $this->view->render('Client/Components/SearchResult', [
                'searchResult' => $searchResult,
                'keyword' => $keyword,

            ]);
        } else {
            echo ' tìm kiếm thành công cốc';
            // header('location: /?url=home');   
        }
    }
}
