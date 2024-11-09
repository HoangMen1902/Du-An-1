const { ajax } = require("jquery");

function getProductInput() {
    let input = {
        name: $('input[name="name"]').val().trim(),
        description: $('textarea[name="description"]').val().trim(),
        brand: $('input[name="brand"]').val().trim(),
        total_quantity: $('input[name="total_quantity"]').val().trim(),
        discount: $('input[name="discount"]').val().trim(),
        status: $('select[name="status"]').val(),
    };
    return input;
}

function productValidate() {
    let input = getProductInput();
    let is_valid = true;

    // Kiểm tra trường rỗng
    Object.entries(input).forEach(([key, value]) => {
        if (value === '') {
            console.log(`${key}-validate`);
            $(`#${key}-validate`).show();
            is_valid = false;
        } else {
            $(`#${key}-validate`).hide();
        }
    });

    // Kiểm tra độ dài tên sản phẩm
    if (input.name.length > 100) {
        $('#name-invalid').show();
        is_valid = false;
    } else {
        $('#name-invalid').hide();
    }

    // Kiểm tra độ dài mô tả sản phẩm
    if (input.description.length > 500) {
        $('#description-invalid').show();
        is_valid = false;
    } else {
        $('#description-invalid').hide();
    }

    // Kiểm tra số lượng tổng hợp lệ
    if (isNaN(input.total_quantity) || parseInt(input.total_quantity) <= 0) {
        $('#total_quantity-invalid').show();
        is_valid = false;
    } else {
        $('#total_quantity-invalid').hide();
    }

    // Kiểm tra giá giảm trong khoảng hợp lệ
    if (isNaN(input.discount) || parseInt(input.discount) < 0 || parseInt(input.discount) > 100) {
        $('#discount-invalid').show();
        is_valid = false;
    } else {
        $('#discount-invalid').hide();
    }

    if (!is_valid) {
        return false;
    }
    return true;
}
