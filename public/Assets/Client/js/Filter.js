const APP_URL = 'http://localhost:8000/';

function updatePriceDisplay(value) {
    const display = document.querySelector('.price-display');
    display.textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
}

$(function () {
    // Lắng nghe sự kiện thay đổi danh mục
    $('#categories').on('change', function () {
        var parentId = $(this).val();
        if (parentId) {
            $.ajax({
                type: 'POST',
                url: '/get-child-categories',
                data: { category_id: parentId },
                success: function (response) {
                    if (response.length > 0) {
                        $('#child_category').show();
                        $('#child_category select').empty();
                        $('#child_category select').append('<option value="">Chọn danh mục</option>');

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

