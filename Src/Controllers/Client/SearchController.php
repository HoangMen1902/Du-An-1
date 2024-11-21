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
            // echo '<pre>';
            $keyword = $_GET['search'];
            // echo ' tìm kiếm thành công';`
            // var_dump($keyword);
            $SearchModel = new SearchModel();
            $searchResult = $SearchModel->search($keyword);
            // var_dump($results);
            echo $this->view->render('Client/Components/SearchResult', [
                'searchResult' => $searchResult,
                'keyword' => $keyword,

            ]);
            // var_dump($this);
        } else {
            echo ' tìm kiếm thành công cốc';
            // header('location: /?url=home');   
        }
    }
}
