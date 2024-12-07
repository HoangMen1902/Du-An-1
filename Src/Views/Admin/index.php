<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
$this->insert('Admin/Pages/Dashboard/Dashboard' ,
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
 'anaLyticRevenueByYear' => $anaLyticRevenueByYear

]);
$this->stop();
?>
