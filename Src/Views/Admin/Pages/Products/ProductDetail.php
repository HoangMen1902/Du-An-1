<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->push('styles')
?>
<style>
    .footer {
        padding: 0 !important;
    }
</style>
<?php
$this->end();
?>
<?php
$this->start('main_content');
?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin sản phẩm</h4>
            <form class="forms-sample" action="/admin/add-product-detail-action/" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($data['product_name'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="thumbnail">Hình ảnh sản phẩm</label><br>
                    <?php if (!empty($data['thumbnail'])):
                        $data['thumbnail'] = explode(',', $data['thumbnail']);
                        foreach ($data['thumbnail'] as $thumbnail):
                    ?>

                            <img src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= htmlspecialchars($thumbnail) ?>" alt="Thumbnail" style="max-width: 100px; height: auto;">
                    <?php
                        endforeach;
                    endif; ?>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <div  class="form-control" name="description" id="description" disabled>
                        <a href="/admin/product/detail/description/<?=$data['product_id']?>">Xem mô tả sản phẩm</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand_id">Thương hiệu</label>
                    <input type="text" class="form-control" name="brand_id" id="brand_id" value="<?= $data['brand_name'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="category_id">Phân loại sản phẩm chung</label>
                    <input type="text" class="form-control" name="category_id" id="category_id" value="<?= htmlspecialchars($data['category_name'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="category_id">Phân loại sản phẩm chi tiết</label>
                    <input type="text" class="form-control" name="category_id" id="category_id" value="<?= htmlspecialchars($data['value_name'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="<?= htmlspecialchars($data['total_quantity'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="discountRate">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discountRate" id="discountRate" value="<?= htmlspecialchars($data['discount'] ?? '') ?>" disabled>
                </div>
                <div class="col-md-12 p-0" style="text-align:end">
                    <a href="/admin/edit-product/<?=$data['product_id']?>" class="btn btn-primary">Sửa</a>
                </div>
            </form>
        </div>


    </div>
</div>
<?php
$specs = $data['specifications'];
$specs = json_decode($specs);
?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông số kỹ thuật</h4>
            <form class="forms-sample" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">
                <?php
                foreach ($specs as $spec):
                ?>
                    <div class="form-group">
                        <label for="cpu_technology"><?= $spec->spec_name ?></label>
                        <input type="text" class="form-control" name="technology" id="technology" value="<?= $spec->spec_value ?>" disabled>
                    </div>
                <?php
                endforeach;
                ?>
                <div class="col-md-12 p-0" style="text-align:end">
                    <a href="/admin/edit-specification/<?=$data['product_id']?>" class="btn btn-primary">Sửa</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
foreach ($variant as $index => $item):
    $option = explode(',', $item['option_values']);
    $option_name = explode(',', $item['option_names'])
?>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Thông tin biến thể <?= $index + 1 ?></h4>

                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpu_technology">SKU ID</label>
                                <input type="text" class="form-control" name="technology" id="technology" value="<?= $item['sku_id'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpu_technology">Mã SKU</label>
                                <input type="text" class="form-control" name="technology" id="technology" value="<?= $item['sku'] ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cpu_technology">Số lượng</label>
                                <input type="text" class="form-control" name="technology" id="technology" value="<?= $item['quantity'] ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($option_name as $count => $name):
                    ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpu_technology">Thuộc tính <?= $count + 1 ?></label>
                                    <input type="text" class="form-control" name="technology" id="technology" value="<?= $name ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpu_technology">Giá trị</label>
                                    <input type="text" class="form-control" name="technology" id="technology" value="<?= $option[$count] ?>" disabled>
                                </div>
                            </div>

                        </div>
                    <?php
                    endforeach;
                    ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="cpu_technology">Hình ảnh</label>
                                </div>
                                <div class="col-md-6">
                                    <img src="<?= $_ENV['APP_URL'] ?>/public\Uploads\Products/<?= $item['images'] ?>" style="max-width:20%" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    ?>
                    <div class="col-md-12 p-0" style="text-align:end">
                        <a href="/admin/edit-variant/<?=$data['product_id']?>/<?=$item['sku_id']?>" class="btn btn-primary">Sửa</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
endforeach;

$this->stop();
?>