<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
            <form class="forms-sample" action="/admin/update-product/{id}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{id}">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" value="{name}" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" rows="4" name="description">{description}</textarea>
                </div>

                <div class="form-group">
                    <label for="brand_id">Thương hiệu</label>
                    <select readonly class="form-control" id="brand_id" name="brand_id">
                        <option value="{brand_id}">{brand_name}</option>
                        <option disabled value="{brand_id}">{brand_name}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id">Phân loại sản phẩm</label>
                    <select readonly class="form-control" id="category_id" name="category_id">
                        <option value="{category_id}">{category_name}</option>
                        <option disabled value="{category_id}">{category_name}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Giá tiền</label>
                    <input type="number" class="form-control" name="price" id="price" value="{price}" placeholder="Price">
                </div>

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{quantity}" placeholder="Quantity">
                </div>

                <div class="form-group">
                    <label for="discountRate">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discountRate" id="discountRate" value="{discountRate}" placeholder="Discount Rate">
                </div>

                <div class="form-group">
                    <label for="weight">Trọng lượng (kg)</label>
                    <input type="number" class="form-control" name="weight" id="weight" value="{weight}" placeholder="Weight">
                </div>

                <div class="form-group">
                    <label for="height">Chiều cao (cm)</label>
                    <input type="number" class="form-control" name="height" id="height" value="{height}" placeholder="Height">
                </div>

                <div class="form-group">
                    <label for="width">Chiều rộng (cm)</label>
                    <input type="number" class="form-control" name="width" id="width" value="{width}" placeholder="Width">
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image">
                    <img src="/public/uploads/{image}" alt="Current Image" width="100px">
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail[]" multiple class="form-control file-upload-info" placeholder="Upload Thumbnail">
                    <img src="/public/uploads/{thumbnail}" alt="Current Thumbnail" width="100px">
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control form-control-sm col-lg-2" name="status">
                        <option value="1">Hoạt động</option>
                        <option value="2">Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>
                <a href="/admin/products" class="btn btn-light">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>

<?php

$this->stop();
?>