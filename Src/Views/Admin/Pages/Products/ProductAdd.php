<?php

namespace App\Views\Admin\Pages\Products;

use App\Views\BaseView;

class ProductAdd extends BaseView
{
    public static function render($data = null, $brands = null)
    {


        ?>

        <div class="col-12 grid-margin ">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Thêm sản phẩm</h4>
                    <form class="forms-sample" action="/admin/add-product" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $_POST['name'] ?? ''; ?>"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="description" rows="4"
                                name="description"><?= $_POST['description'] ?? ''; ?></textarea>

                        </div>
                        <div class="form-group">
                            <label for="brand_id">Thương hiệu</label>
                            <select class="form-control" id="brand_id" name="brand_id">
                                <option value="">Chọn thương hiệu</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= $brand['id']; ?>" <?= (isset($_POST['brand_id']) && $_POST['brand_id'] == $brand['id']) ? 'selected' : ''; ?>><?= $brand['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Phân loại sản phẩm</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Chọn loại sản phẩm</option>
                                <?php foreach ($data['category'] as $category): ?>
                                    <option value="<?= $category['id']; ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>><?= $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" name="price" id="price"
                                value="<?= $_POST['price'] ?? ''; ?>" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                value="<?= $_POST['quantity'] ?? ''; ?>" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <label for="discountRate">Giá giảm (%)</label>
                            <input type="number" class="form-control" name="discountRate" id="discountRate"
                                value="<?= $_POST['discountRate'] ?? ''; ?>" placeholder="Discount Rate">
                        </div>
                        <div class="form-group">
                            <label for="weight">Trọng lượng (kg)</label>
                            <input type="number" class="form-control" name="weight" id="weight"
                                value="<?= $_POST['weight'] ?? ''; ?>" placeholder="Weight">
                        </div>
                        <div class="form-group">
                            <label for="height">Chiều cao (cm)</label>
                            <input type="number" class="form-control" name="height" id="height"
                                value="<?= $_POST['height'] ?? ''; ?>" placeholder="Height">
                        </div>
                        <div class="form-group">
                            <label for="width">Chiều rộng (cm)</label>
                            <input type="number" class="form-control" name="width" id="width"
                                value="<?= $_POST['width'] ?? ''; ?>" placeholder="Width">
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image">

                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail[]" multiple class="form-control file-upload-info"
                                placeholder="Upload Thumbnail" >

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
                        <div class="form-group">
                            <label for="">Thuộc tính</label>
                            <a href="javascript:void(0)" onclick="create()" class="btn btn-primary btn-sm">ADD</a>
                            <div id="multi_properties">
                                <div class="row items_properties mb-3">
                                    <div class="col-5">
                                        <label for="">Tên thuộc tính</label>
                                        <select name="option_id[]" id="" class="form-select">
                                            <option value="">Chọn thuộc tính</option>
                                            <?php foreach ($data['options'] as $item_option): ?>
                                                <option value="<?= $item_option['id'] ?>"><?= $item_option['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label for="option_vl_name">Giá trị</label>
                                        <input type="text" class="form-control" id="option_vl_name" name="option_vl_name[]"
                                            placeholder="Giá trị">
                                    </div>
                                    <div class="col-1">
                                        <label for="">&nbsp;</label>
                                        <a href="javascript:void(0)" onclick="delete_(this)"
                                            class="btn btn-danger btn-sm d-block">Xóa</a>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top">
                                <div class="card-body">
                                    <button type="reset" class="btn btn-danger text-white" name="">Làm lại</button>
                                    <button type="submit" class="btn btn-primary" name="">Thêm</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm mới</button>
                        <a href="/admin?url=products" class="btn btn-light">Hủy bỏ</a>
                    </form>
                </div>
            </div>

        </div>
        <script>
            function create() {
                let count_items = document.querySelectorAll(".items_properties").length - 1;
                count_items++;
                $("#multi_properties").append(`
                                    <div class="row items_properties mb-3">
                                        <div class="col-5">
                                            <label for="">Tên thuộc tính</label>
                                            <select name="option_id[]" id="" class="form-select">
                                                <option value="">Chọn thuộc tính</option>
                                                <?php foreach ($data['options'] as $item_option): ?>
                                                                        <option value="<?= $item_option['id'] ?>"><?= $item_option['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <label for="option_vl_name">Giá trị</label>
                                            <input type="text" class="form-control" id="option_vl_name" name="option_vl_name[]" placeholder="Giá trị">
                                        </div>
                                        <div class="col-1">
                                            <label for="">&nbsp;</label>
                                            <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger btn-sm d-block">Xóa</a>
                                        </div>
                                    </div>
                                `);
            }

            function delete_(__this) {
                let count_items = document.querySelectorAll(".items_properties").length - 1;
                count_items--;
                $(__this).closest(".items_properties").remove();
            }
        </script>
        <?php
    }
}

?>