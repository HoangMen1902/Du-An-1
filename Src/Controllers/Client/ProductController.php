<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\ProductModel;
use Src\Models\Client\CommentModel;
use Src\Models\Client\RatingModel;
use Src\Models\Client\InstallmentModel;

class ProductController extends BaseController
{
    public function loadDescription($params)
    {
        $id = $params['id'];
        $ProductModel = new ProductModel();
        $data = $ProductModel->getOneProduct($id);
        echo $this->view->render('Admin/Pages/Products/Description', ['data' => $data]);
    }
    public function show($id)
    {
        $productId = $id['id'];
        $userId = $_SESSION['user']['id'] ?? 0;

        if (!$productId) {
            echo "ID sản phẩm không hợp lệ.";
            return;
        }

        $productModel = new ProductModel();
        $productData = $productModel->getProductById($productId);
        if (!$productData) {
            echo "Sản phẩm không tồn tại.";
            return;
        }

        $categoryId = null;

        if (!empty($productData['skus'])) {
            $firstSku = reset($productData['skus']);
            $categoryId = $firstSku['category_id'] ?? null;
        }

        $skuIds = [];
        foreach ($productData['skus'] as $key => $product) {
            if (isset($product['sku_id'])) {
                $skuIds[] = $product['sku_id'];
            }
        }

        $sku_id = $skuIds;
        $installmentValue = new InstallmentModel();
        $installment = $installmentValue->getInstallmentBySku($sku_id);

        // echo '<pre>';
        // var_dump($installment[0]['sku_id']);

        if (!$categoryId) {
            echo "Không tìm thấy category_id.";
            return;
        }
        $productDescAndSpecs = $productModel->getProductSpecsAndDesc($productId);
        $commentModel = new CommentModel();
        $commentData = $commentModel->getAllCommentByProductId($productId);
        $commentReply = $commentModel->getAllCommentByParentId($productId);
        $allowRating = $commentModel->allowRating($userId, $productId);
        $ratingModel = new RatingModel();
        $ratingData = $ratingModel->getAllRatingByProductId($productId);
        $userRating = $ratingModel->getUserRating($userId, $productId);
        $avgRating = $ratingModel->analyticRatingByProductId($productId);
        $relatedProducts = $productModel->getRelatedProducts($productId, $categoryId);

        echo $this->view->render('Client/Pages/Product/Detail', [
            'productData' => $productData,
            'commentData' => $commentData,
            'installment' => $installment,
            'commentReply' => $commentReply,
            'commentModel' => $commentModel,
            'ratingModel' => $ratingModel,
            'allowRating' => $allowRating,
            'ratingData' => $ratingData,
            'userRating' => $userRating,
            'userId' => $userId,
            'desc_specs' => $productDescAndSpecs,
            'avgRating' => $avgRating,
            'relatedProducts' => $relatedProducts // Truyền danh sách sản phẩm liên quan vào view
        ]);
    }
}
