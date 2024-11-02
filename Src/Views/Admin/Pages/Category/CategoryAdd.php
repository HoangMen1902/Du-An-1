<?php

namespace App\Views\Admin\Pages\Category;
use App\Views\BaseView;

class CategoryAdd extends BaseView
{
    public static function render($data = null)
    {


?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm phân loại</h4>
            <form action="/admin/category-add" method="post">
                <input type="hidden" name="method" value="POST">
                <div class="form-group">
                    <label>Tên phân loại</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Bàn phím.." aria-label="Category Name" name="name">
                </div>
                <div class="form-group">
                    <label>Mô tả loại sản phẩm</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Bàn phím.." aria-label="Category Name" name="description">
                </div>
                
                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success ">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1">Hoạt động</option>
                            <option value="2">Không hoạt động</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary" style="justify-self: flex-end;">Thêm</button>
            </form>
            <?php if (isset($_SESSION['category']['error'])) : ?>
                <div class="mt-5 alert alert-danger" role="alert">
                    <?= $_SESSION['category']['error'] ?>
                </div>
                <?php
                unset($_SESSION['category']['error']);
                endif;
                ?>
        </div>
    </div>
</div>
<?php

}
}

?>