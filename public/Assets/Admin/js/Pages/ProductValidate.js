
function getProductInput() {
    return {
        name: $('input[name="name"]').val().trim(),
        description: $('textarea[name="description"]').val().trim(),
        brand: $('input[name="brand"]').val().trim(),
        total_quantity: $('input[name="total_quantity"]').val().trim(),
        discount: $('input[name="discount"]').val().trim(),
        status: $('select[name="status"]').val(),
    };
}

function productValidate() {
    let input = getProductInput();
    let is_valid = true;

    // Kiểm tra trường rỗng
    Object.entries(input).forEach(([key, value]) => {
        if (value === '') {
            $(`#${key}-validate`).show();
            is_valid = false;
        } else {
            $(`#${key}-validate`).hide();
        }
    });

    // Kiểm tra độ dài tên sản phẩm (tối đa 100 ký tự)
    if (input.name && input.name.length > 100) {
        $('#name-invalid').show();
        is_valid = false;
    } else {
        $('#name-invalid').hide();
    }

    // Kiểm tra độ dài mô tả sản phẩm (tối đa 500 ký tự)
    if (input.description && input.description.length > 500) {
        $('#description-invalid').show();
        is_valid = false;
    } else {
        $('#description-invalid').hide();
    }

    // Kiểm tra số lượng tổng hợp lệ (lớn hơn 0 và là số)
    if (!input.total_quantity || isNaN(input.total_quantity) || parseInt(input.total_quantity) <= 0) {
        $('#total_quantity-invalid').show();
        is_valid = false;
    } else {
        $('#total_quantity-invalid').hide();
    }

    // Kiểm tra giá giảm trong khoảng 0 - 100%
    if (!input.discount || isNaN(input.discount) || parseInt(input.discount) < 0 || parseInt(input.discount) > 100) {
        $('#discount-invalid').show();
        is_valid = false;
    } else {
        $('#discount-invalid').hide();
    }

    return is_valid;
}

// Sự kiện submit cho form thêm sản phẩm
$('#productForm').on('submit', (e) => {
    if (!productValidate()) {
        e.preventDefault();
    }
});


$(function() {
    $('#categories').on('change', function() {
        var parentId = $(this).val();
        if (parentId) {
            $.ajax({
                type: 'POST',
                url: '/admin/get-child-categories', 
                data: { category_id: parentId },
                success: function(response) {
                    if (response.length > 0) {
                        $('#child_category').show();
                        $('#child_category select').empty();
                        $('#child_category select').append('<option value="">Chọn danh mục con</option>');
                        
                        response.forEach(function(childCategory) {
                            $('#child_category select').append('<option value="' + childCategory.id + '">' + childCategory.name + '</option>');
                        });
                    } else {
                        $('#child_category').hide();
                    }
                },
                error: function() {
                    console.log('Có lỗi xảy ra khi lấy danh mục con.');
                }
            });
        } else {
            $('#child_category').hide();
        }
    });
});

