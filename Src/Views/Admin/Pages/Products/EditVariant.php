<?php
$this->layout('Admin/Layouts/Layout')
?>


<?php
$this->start('main_content');
var_dump($variant_data);
?>


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm sản phẩm</h4>
            <form action="/admin/product/store" id="productAddForm" method="post" enctype="multipart/form-data">

                <div class="sku-item row mb-3" id="sku-item-${skuIndex}" class="sku-form" data-sku-index="${skuIndex}">
                    <div class="col-md-3">
                        <label>Mã SKU</label>
                        <input type="text" name="sku[${skuIndex}][sku]" class="form-control" placeholder="SKU" value="<?=$variant_data[0]['sku']?>">
                        <small class="text-danger" style="display:none">Vui lòng nhập mã SKU</small>
                    </div>
                    <div class="col-md-3">
                        <label>Giá gốc</label>
                        <input type="number" name="sku[${skuIndex}][price]" class="form-control" value="<?=$variant_data[0]['price']?>" placeholder="Giá">
                        <small class="text-danger" style="display:none">Vui lòng nhập giá</small>
                    </div>
                    <div class="col-md-3">
                        <label>Số lượng</label>
                        <input type="number" name="sku[${skuIndex}][quantity]" value="<?=$variant_data[0]['quantity']?>" class="form-control" placeholder="Số lượng">
                        <small class="text-danger" style="display:none">Vui lòng nhập số lượng</small>
                    </div>
                    <div class="col-md-3">
                        <label>Hình ảnh</label>
                        <input type="file" name="sku[${skuIndex}][images]" class="form-control" id="skuImage" accept="image/*">
                        <small class="text-danger" style="display:none">Vui lòng tải hình ảnh</small>
                    </div>
                    <?php foreach($variant_data as $index => $variant): ?>

                    <div class="col-12 properties-container mt-2">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <label>Tên thuộc tính</label>
                                <select name="sku[${skuIndex}][option][][option_id]" class="form-control option-select">
                                    <option value="">Chọn thuộc tính</option>
                                    <?php
                                    foreach($options as $attribute):
                                    ?>
                                        <option value="<?= $attribute['id'] ?>" <?= $variant['option_id'] == $attribute['id'] ? 'selected' : ''?>><?= htmlspecialchars($attribute['name']) ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label>Giá trị</label>
                                <input type="text" name="sku[${skuIndex}][option][][value_name]" class="form-control" placeholder="Đen, trắng, ..." value="<?=$variant['value_name']?>">
                                <small class="text-danger" style="display:none">Vui lòng nhập giá trị thuộc tính</small>
                            </div>
                            <div class="col-md-2 d-flex align-items-end justify-content-center">
                                <a href="javascript:void(0)" onclick="removeProperty(this)" class="btn btn-danger">Xóa</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                    <span class="text-danger" style="display:none" id="propertyCheck-${skuIndex}">Vui lòng nhập thuộc tính</span>
                    <div class="col-12 mt-3">
                        <a href="javascript:void(0)" onclick="addProperty(this)" class="btn btn-primary">Thêm Thuộc tính</a>
                        <a href="javascript:void(0)" onclick="" class="btn btn-danger">Xóa SKU</a>
                    </div>
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
    function addProperty(element) {
    const skuItem = $(element).closest('.sku-item'); 
    const skuIndex = skuItem.data('sku-index'); 
    const propertyContainer = skuItem.find('.properties-container'); 

    const newProperty = `
        <div class="row mb-2">
            <div class="col-md-5">
                <label>Tên thuộc tính</label>
                <select name="sku[${skuIndex}][option][][option_id]" class="form-control option-select">
                    <option value="">Chọn thuộc tính</option>
                    <?php foreach ($options as $attribute): ?>
                        <option value="<?= $attribute['id'] ?>"><?= htmlspecialchars($attribute['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5">
                <label>Giá trị</label>
                <input type="text" name="sku[${skuIndex}][option][][value_name]" class="form-control" placeholder="Đen, trắng, ...">
                <small class="text-danger" style="display:none">Vui lòng nhập giá trị thuộc tính</small>
            </div>
            <div class="col-md-2 d-flex align-items-end justify-content-center">
                <a href="javascript:void(0)" onclick="removeProperty(this)" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    `;
    propertyContainer.append(newProperty);
    updateDisabledOptions(null, skuIndex);
}
</script>
<?php
$this->end();
?>