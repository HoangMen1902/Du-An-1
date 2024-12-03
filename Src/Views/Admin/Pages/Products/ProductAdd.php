<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->push('styles');
?>
<style>
    .cke_notification {
    display: none !important;
}
</style>
<?php
$this->end();
?>
<?php
$this->start('main_content');
?>


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm sản phẩm</h4>
            <form action="/admin/product/store" id="productAddForm" method="post" enctype="multipart/form-data">

                <p class="card-description">Thông tin sản phẩm</p>
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($data['name'] ?? '') ?>">
                    <small id="name-required" class="text-danger" style="display:none">Vui lòng nhập tên sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả ngắn</label>
                    <textarea class="form-control" name="short_description" id="short_description" rows="2" placeholder="Mô tả sản phẩm"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                    <small id="description-required" class="text-danger" style="display:none">Vui lòng nhập mô tả sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" id="description" rows="4" placeholder="Mô tả sản phẩm"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                    <small id="description-required" class="text-danger" style="display:none">Vui lòng nhập mô tả sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="brand">Thương hiệu</label>
                    <select class="form-control" name="brand">
                        <?php
                        if (isset($brands) && !empty($brands)):
                            foreach ($brands as $brand):
                        ?>
                                <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <option value="">Không có thương hiệu</option>

                        <?php
                        endif;
                        ?>
                    </select>
                    <small id="brand-required" class="text-danger" style="display:none">Vui lòng chọn thương hiệusản phẩm</small>

                </div>
                    <div class="form-group">
                        <label for="categories">Danh mục cha:</label>
                        <select class="form-control" id="categories" name="categories" >
                            <option value="">Chọn danh mục cha</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div id="child_category" style="display:none;">
                            <label for="child_category">Danh mục con:</label>
                            <select class="form-control" id="child_category" name="child_category">
                                <option value="">Chọn danh mục con</option>
                            </select>
                        </div>
                    <small id="categories-required" class="text-danger" style="display:none">Vui lòng chọn danh mục sản phẩm</small>
                    </div>



                <div class="form-group">
                    <label for="discount">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discount" placeholder="Giảm giá" min="0" max="100" value="<?= htmlspecialchars($data['discount'] ?? '') ?>">
                    <small id="discount-required" class="text-danger" style="display:none">Vui lòng nhập giá giảm</small>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="thumbnail[]" accept="image/*" multiple>
                    <div id="imagesPreview" style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap;"></div>
                    <small id="thumbnail-required" class="text-danger" style="display:none">Vui lòng chọn hình ảnh sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="specifications_file">Tải lên file Excel cho thông số kỹ thuật (.xls hoặc .xlsx)</label>
                    <input type="file" class="form-control" name="specifications_file" accept=".xls, .xlsx">
                    <small id="categories-required" class="text-danger" style="display:none">Vui lòng tải lên file excel sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status">
                        <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= isset($data['status']) && $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Thêm biến thể</label>
                    <div id="sku_section">
                        
                    </div>
                    <a href="javascript:void(0)" onclick="addSku()" class="btn btn-success mt-3">Thêm SKU</a>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>



<?php $this->stop(); ?>
<?php

$this->push('scripts');
?>
<script src="<?=$_ENV['APP_URL']?>/node_modules\ckeditor4\ckeditor.js"></script>
<script>
let skuIndex = 0;

function addSku() {
    skuIndex++;
    $('#sku_section').append(`
        <div class="sku-item row mb-3" id="sku-item-${skuIndex}" class="sku-form" data-sku-index="${skuIndex}">
            <div class="col-md-3">
                <label>Mã SKU</label>
                <input type="text" name="sku[${skuIndex}][sku]" class="form-control"  placeholder="SKU">
                <small class="text-danger" style="display:none">Vui lòng nhập mã SKU</small>
            </div>
            <div class="col-md-3">
                <label>Giá gốc</label>
                <input type="number" name="sku[${skuIndex}][price]" class="form-control"  placeholder="Giá">
                <small class="text-danger" style="display:none">Vui lòng nhập giá</small>
            </div>
            <div class="col-md-3">
                <label>Số lượng</label>
                <input type="number" name="sku[${skuIndex}][quantity]" class="form-control"  placeholder="Số lượng">
                <small class="text-danger" style="display:none">Vui lòng nhập số lượng</small>
            </div>
            <div class="col-md-3">
                <label>Hình ảnh</label>
                <input type="file" name="sku[${skuIndex}][images]" class="form-control" id="skuImage" accept="image/*">
                <small class="text-danger" style="display:none">Vui lòng tải hình ảnh</small>
            </div>
            <div class="col-12 properties-container mt-2">
            </div>
            <span class="text-danger" style="display:none" id="propertyCheck-${skuIndex}">Vui lòng nhập thuộc tính</span>
            <div class="col-12 mt-3">
                <a href="javascript:void(0)" onclick="addProperty(this)" class="btn btn-primary">Thêm Thuộc tính</a>
                <a href="javascript:void(0)" onclick="removeSku(${skuIndex})" class="btn btn-danger">Xóa SKU</a>
            </div>
        </div>
    `);
}
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


function updateDisabledOptions(changedSelect = null, skuIndex) {
    const skuItem = $(`[data-sku-index="${skuIndex}"]`); 
    const allSelects = skuItem.find('.option-select'); 
    const selectedValues = [];
    
    allSelects.each(function () {
        const value = $(this).val();
        if (value) {
            selectedValues.push(value);
        }
    });
    allSelects.each(function () {
        const currentSelect = $(this);
        const currentValue = currentSelect.val();

        currentSelect.find('option').each(function () {
            const optionValue = $(this).attr('value');
            if (optionValue) {
                if (selectedValues.includes(optionValue) && optionValue !== currentValue) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            }
        });
    });
}

    function removeProperty(element) {
        $(element).closest('.row').remove();
        updateDisabledOptions(null, skuIndex); 
    }

    function removeSku(skuIndex) {
        $('#sku-item-' + skuIndex).remove();
        skuIndex--;
    }
    CKEDITOR.replace('description', {
    height: 300,
});

</script>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\ProductValidate.js"></script>
<?php

$this->end();