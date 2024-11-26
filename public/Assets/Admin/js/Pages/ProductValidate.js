function getProductInput() {
    return {
        name: $('input[name="name"]').val().trim(),
        brand: $('select[name="brand"]').val().trim(),
        discount: $('input[name="discount"]').val().trim(),
        status: $('select[name="status"]').val(),
        categories: $('select[name="categories"]').val(),
        child_category: $('select[name="child_category"]').val(),
        specifications_file: $('input[name="specifications_file"]').val().trim()
    };
}


function validationAddForm() {
    let input = getProductInput();
    let is_valid = true;
    Object.entries(input).forEach(([key, value]) => {
        if (!value) {
            $(`#${key}-required`).show()
            $(`input[name="${key}"]`).addClass('border-danger');
            $(`textarea[name="${key}"]`).addClass('border-danger');
            $(`select[name="${key}"]`).addClass('border-danger');
            is_valid = false;
        } else {
            $(`#${key}-required`).hide()
            $(`input[name="${key}"]`).removeClass('border-danger');
            $(`textarea[name="${key}"]`).removeClass('border-danger');
            $(`select[name="${key}"]`).removeClass('border-danger');
        }
    })

    if (is_valid === false) {
        return false;
    }
    return true;
}


function skuValidate() {
    let isValid = true;

    $('.sku-item').each(function () {
        const skuIndex = $(this).data('sku-index');
        const sku = $(`input[name="sku[${skuIndex}][sku]"]`).val().trim();
        const price = $(`input[name="sku[${skuIndex}][price]"]`).val().trim();
        const quantity = $(`input[name="sku[${skuIndex}][quantity]"]`).val().trim();
        const images = $(`input[name="sku[${skuIndex}][images]"]`).val();

        if (!sku) {
            isValid = false;
            $(`input[name="sku[${skuIndex}][sku]"]`).siblings('.text-danger').show();
            $(`input[name="sku[${skuIndex}][sku]"]`).addClass('border-danger');
        } else {
            $(`input[name="sku[${skuIndex}][sku]"]`).siblings('.text-danger').hide();
            $(`input[name="sku[${skuIndex}][sku]"]`).removeClass('border-danger');

        }

        if (!price || parseFloat(price) <= 0) {
            isValid = false;
            $(`input[name="sku[${skuIndex}][price]"]`).siblings('.text-danger').show();
            $(`input[name="sku[${skuIndex}][price]"]`).addClass('border-danger');
        } else {
            $(`input[name="sku[${skuIndex}][price]"]`).siblings('.text-danger').hide();
            $(`input[name="sku[${skuIndex}][price]"]`).removeClass('border-danger');
        }

        if (!quantity || parseInt(quantity) <= 0) {
            isValid = false;
            $(`input[name="sku[${skuIndex}][quantity]"]`).siblings('.text-danger').show();
            $(`input[name="sku[${skuIndex}][quantity]"]`).addClass('border-danger');

        } else {
            $(`input[name="sku[${skuIndex}][quantity]"]`).siblings('.text-danger').hide();
            $(`input[name="sku[${skuIndex}][quantity]"]`).removeClass('border-danger');

        }

        if (!images) {
            isValid = false;
            $(`input[name="sku[${skuIndex}][images]"]`).siblings('.text-danger').show();
            $(`input[name="sku[${skuIndex}][images]"]`).addClass('border-danger');

        } else {
            $(`input[name="sku[${skuIndex}][images]"]`).siblings('.text-danger').hide();
            $(`input[name="sku[${skuIndex}][images]"]`).removeClass('border-danger');
        }

        if($(`select[name="sku[${skuIndex}][option][][option_id]"]`).length == 0) {
            $(`#propertyCheck-${skuIndex}`).show();
            isValid = false;
        } else {
            $(`#propertyCheck-${skuIndex}`).hide();
            $(`input[name="sku[${skuIndex}][option][][value_name]"]`).each(function() {
                if ($(this).val().trim() === '') {
                    isValid=false;
                    $(this).addClass('border-danger')
                    $(this).next('.text-danger').show();
                } else {
                    $(this).removeClass('border-danger')
                    $(this).next('.text-danger').hide(); 
                }
            })
            $(`select[name="sku[${skuIndex}][option][][option_id]"]`).each(function() {
                if ($(this).val().trim() === '') {
                    isValid=false;
                    $(this).addClass('border-danger')
                } else {
                    $(this).removeClass('border-danger')
                }
            })
        }
    });

    return isValid;
}
$('#productAddForm').on('submit', (e) => {
    if (!validationAddForm()) {
        e.preventDefault();
    }
    if($('.sku-item').length > 0) {
        if(skuValidate() === false) {
            e.preventDefault();
        }
    }
})




$(function () {
    $('#categories').on('change', function () {
        var parentId = $(this).val();
        if (parentId) {
            $.ajax({
                type: 'POST',
                url: '/admin/get-child-categories',
                data: { category_id: parentId },
                success: function (response) {
                    if (response.length > 0) {
                        $('#child_category').show();
                        $('#child_category select').empty();
                        $('#child_category select').append('<option value="">Chọn danh mục con</option>');

                        response.forEach(function (childCategory) {
                            $('#child_category select').append('<option value="' + childCategory.id + '">' + childCategory.name + '</option>');
                        });
                    } else {
                        $('#child_category').hide();
                    }
                },
                error: function () {
                    console.log('Có lỗi xảy ra khi lấy danh mục con.');
                }
            });
        } else {
            $('#child_category').hide();
        }
    });
});

