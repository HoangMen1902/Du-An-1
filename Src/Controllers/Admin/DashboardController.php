<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\AnalyticModel;

class DashboardController extends BaseController
{
    public function show()
    {
        $AnalyticModel = new AnalyticModel();
        $countProduct = $AnalyticModel->countProduct();
        $countBrand = $AnalyticModel->countBrand();
        $countCategoryParent = $AnalyticModel->countCategoryParent();
        $countCategory = $AnalyticModel->countCategory();
        $countComment = $AnalyticModel->countComment();
        $countRating = $AnalyticModel->countRating();
        $countUser = $AnalyticModel->countUser();
        $countOrder = $AnalyticModel->countOrder();
        $analyticProductByDay = $AnalyticModel->anaLyticProductByDay();
        $analyticProductByMonth = $AnalyticModel->anaLyticProductByMonth();
        $analyticProductByYear = $AnalyticModel->anaLyticProductByYear();
        $anaLyticRevenueByDay = $AnalyticModel->anaLyticRevenueByDay();
        $anaLyticRevenueByMonth = $AnalyticModel->anaLyticRevenueByMonth();
        $anaLyticRevenueByYear = $AnalyticModel->anaLyticRevenueByYear();
        $specificDate = date('Y-m-d');  
        $anaLyticRevenueBySpecificDate = $AnalyticModel->anaLyticRevenueBySpecificDate($specificDate);
        echo $this->view->render(
            'Admin/index',
            [
                'countProduct' => $countProduct,
                'countUser' => $countUser,
                'countOrder' => $countOrder,
                'countCategoryParent' => $countCategoryParent,
                'countCategory' => $countCategory,
                'countComment' => $countComment,
                'countRating' => $countRating,
                'countBrand' => $countBrand,
                'analyticProductByDay' => $analyticProductByDay,
                'analyticProductByMonth' => $analyticProductByMonth,
                'analyticProductByYear' => $analyticProductByYear,
                'anaLyticRevenueByDay' => $anaLyticRevenueByDay,
                'anaLyticRevenueByMonth' => $anaLyticRevenueByMonth,
                'anaLyticRevenueByYear' => $anaLyticRevenueByYear,
                'anaLyticRevenueBySpecificDate' => $anaLyticRevenueBySpecificDate
            ]

        );
    }
}
