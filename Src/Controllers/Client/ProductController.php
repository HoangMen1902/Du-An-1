<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\ProductModel;
use Src\Models\Client\CommentModel;

class ProductController extends BaseController
{
    public function show($id)
    {
        $productId = $id['id'];
        if (!$productId) {
            echo "ID sản phẩm không hợp lệ.";
            return;
        }

        $productModel = new ProductModel();
        $productData = $productModel->getProductById($productId);
        $commentModel = new commentModel();
        $commentData = $commentModel->getAllCommentByProductId($productId);
        $commentReply = $commentModel->getAllCommentByParentId($productId);
     


        if (!$productData) {
            echo "Sản phẩm không tồn tại.";
            return;
        }

        echo $this->view->render('Client/Pages/Product/Detail', [
            'productData' => $productData,
            'commentData' => $commentData,
            'commentReply' => $commentReply,
            'commentModel' => $commentModel

        ]);
    }
}
