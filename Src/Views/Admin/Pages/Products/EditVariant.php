<?php
$this->layout('Admin/Layouts/Layout')
?>


<?php
$this->start('main_content');
?>


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa SKU</h4>
            <form action="/admin/variant/edit/<?= $variant_data[0]['product_id'] ?>/<?= $variant_data[0]['sku_id'] ?>" id="variantEditForm" method="post" enctype="multipart/form-data" data-product="<?= $variant_data[0]['product_id'] ?>" data-sku="<?= $variant_data[0]['sku_id'] ?>">

                <div class="sku-item row mb-3" id="sku-item-1" class="sku-form" data-sku-index="1">
                    <div class="col-md-3">
                        <label>Mã SKU</label>
                        <input type="text" name="sku" class="form-control" placeholder="SKU" value="<?= $variant_data[0]['sku'] ?>">
                        <small class="text-danger" style="display:none">Vui lòng nhập mã SKU</small>
                    </div>
                    <div class="col-md-3">
                        <label>Giá gốc</label>
                        <input type="number" name="price" class="form-control" value="<?= $variant_data[0]['price'] ?>" placeholder="Giá">
                        <small class="text-danger" style="display:none">Vui lòng nhập giá</small>
                    </div>
                    <div class="col-md-3">
                        <label>Số lượng</label>
                        <input type="number" name="quantity" value="<?= $variant_data[0]['quantity'] ?>" class="form-control" placeholder="Số lượng">
                        <small class="text-danger" style="display:none">Vui lòng nhập số lượng</small>
                    </div>
                    <div class="col-md-3">
                        <label>Hình ảnh</label>
                        <input type="file" name="images" class="form-control" id="skuImage" accept="image/*">
                        <small class="text-danger" style="display:none">Vui lòng tải hình ảnh</small>
                    </div>
                    <div class="properties col-md-12 p-0" id="propertyContainer">
                        <?php foreach ($variant_data as $index => $variant): ?>
                            <?php
                            ?>
                            <div class="col-12 properties-container mt-2" id="property[<?= $index ?>]" data-index="<?= $index ?>" data-valueId="<?= $variant['value_id'] ?>" data-skuVal="<?= $variant['sku_values_id'] ?>">
                                <div class="row mb-2">
                                    <div class="col-md-5">
                                        <label>Tên thuộc tính</label>
                                        <select name="option_id[<?= $index ?>]" class="form-control option-select">
                                            <option value="">Chọn thuộc tính</option>
                                            <?php
                                            foreach ($options as $attribute):
                                            ?>
                                                <option value="<?= $attribute['id'] ?>" <?= $variant['option_id'] == $attribute['id'] ? 'selected' : '' ?>><?= htmlspecialchars($attribute['name']) ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <small class="text-danger" style="display:none">Vui lòng chọn thuộc tính</small>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Giá trị</label>
                                        <input type="text" name="value_name[<?= $index ?>]" class="form-control" placeholder="Đen, trắng, ..." value="<?= $variant['value_name'] ?>">
                                        <small class="text-danger" style="display:none">Vui lòng nhập giá trị thuộc tính</small>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end justify-content-center">
                                        <a href="javascript:void(0)" data-sku="<?=$variant['sku_values_id']?>"  data-option="<?=$variant['value_id']?>" onclick="<?=count($variant_data) < 2 ? 'deleteOnly()' : 'deleteProperty(this)'?>" class="btn btn-danger">Xóa</a>
                                    </div>
                                    <div class="col-md-12 mt-3" style="text-align: end">
                                        <span class="text-danger" style="display:none" id="onlyProperty">Không thể xóa thuộc tính duy nhất</span>

                                    </div>

                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                    <span class="text-danger" style="display:none" id="propertyCheck-<?= $index ?>">Vui lòng nhập thuộc tính</span>
                    <div class="col-12 mt-3">
                        <a href="javascript:void(0)" onclick="addProperty(this)" class="btn btn-primary">Thêm Thuộc tính</a>
                        <a onclick="confirmDelete(event)" href="/admin/delete-sku/<?=$variant_data[0]['sku_id']?>/<?=$variant_data[0]['product_id']?>" class="btn btn-danger">Xóa SKU</a>
                    </div>
                </div>
                <div class="col-md-12 px-0" style="text-align: right;">
                    <a href="javascript:void(0)" onclick="window.location.reload();" class="btn btn-success">Làm mới</a>
                    <button class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
$this->stop();
?>

<?php
$this->push('scripts');
?>
<script>
    function deleteOnly() {
        $('#onlyProperty').show();
    }
    function addProperty(element) {
        let lastElement = $('.properties-container').last();
        let dataIndex = lastElement.data('index') + 1;
        let html = `
        <div class="col-12 properties-container mt-2" id="property[${dataIndex}]" data-index="${dataIndex}">
                                <div class="row mb-2">
                                    <div class="col-md-5">
                                        <label>Tên thuộc tính</label>
                                        <select name="option_id[${dataIndex}]" class="form-control option-select">
                                            <option value="">Chọn thuộc tính</option>
                                            <?php
                                            foreach ($options as $attribute):
                                            ?>
                                                <option value="<?= $attribute['id'] ?>"><?= htmlspecialchars($attribute['name']) ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <small class="text-danger" style="display:none">Vui lòng chọn thuộc tính</small>

                                    </div>
                                    <div class="col-md-5">
                                        <label>Giá trị</label>
                                        <input type="text" name="value_name[${dataIndex}]" class="form-control" placeholder="Đen, trắng, ..." value="">
                                        <small class="text-danger" style="display:none">Vui lòng nhập giá trị thuộc tính</small>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end justify-content-center">
                                        <a href="javascript:void(0)" onclick="removeProperty(this)" class="btn btn-danger">Xóa</a>
                                    </div>
                                </div>
                            </div>
        `
        $('#propertyContainer').append(html);

    }

    function removeProperty(element) {
        $(element).closest('.properties-container').remove();

        $('.properties-container').each(function(index) {
            $(this).attr('data-index', index);
            $(this).attr('id', `property[${index}]`);
            $(this).find('select').attr('name', `option_id[${index}]`);
            $(this).find('input').attr('name', `value_name[${index}]`);
        });
    }
    function confirmDelete(event) {
    if (!confirm('Bạn chắc chứ?')) {
        event.preventDefault(); 
    }
}
</script>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\VariantEdit.js"></script>
<?php
$this->end();
?>