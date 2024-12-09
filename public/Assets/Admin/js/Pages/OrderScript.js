$('#order-search').on('submit', (e) => {
    e.preventDefault();
});

$('#orderSearch').on('change', (e) => {
    setTimeout(() => {
        $.ajax({
            type: "post",
            url: "/admin/order-search",
            data: { order: $('input[name="order"]').val().trim() },
            dataType: "text",
            success: function (response) {
                if (response === 'false') {
                    console.log('Lỗi khi fetch dữ liệu');
                } else {
                    let data = JSON.parse(response);
                    $('#orderTable').fadeOut(200, () => {
                        $('#orderTable').empty();
                    });

                    if (data.length === 0) {
                        $('#orderTable').append(`
                            <tr>
                                <td colspan="7" class="text-center">Không có đơn hàng.</td>
                            </tr>
                        `);
                    } else {
                        data.forEach(order => {
                            let productsHtml = '';
                            let products = order.products.split(';');
                            products.forEach(product => {
                                let productDetails = product.split('|');
                                productsHtml += `
                                    <li>
                                        <img src="${productDetails[1]}" alt="${productDetails[0]}" style="width: 50px; height: 50px;">
                                        ${productDetails[0]} (Số lượng: ${productDetails[2]})
                                    </li>
                                `;
                            });

                            let orderStatus = '';
                            switch (order.order_status) {
                                case 1:
                                    orderStatus = 'Đang xử lý';
                                    break;
                                case 2:
                                    orderStatus = 'Chờ thanh toán';
                                    break;
                                case 3:
                                    orderStatus = 'Đã thanh toán';
                                    break;
                                case 4:
                                    orderStatus = 'Đang vận chuyển';
                                    break;
                                case 5:
                                    orderStatus = 'Đã giao';
                                    break;
                                default:
                                    orderStatus = 'Đã hủy';
                                    break;
                            }

                            let orderRow = `
                                <tr>
                                    <td>${order.order_id}</td>
                                    <td>
                                        <ul>${productsHtml}</ul>
                                    </td>
                                    <td>${order.phone || 'Không có'}</td>
                                    <td>${order.address}</td>
                                    <td>${new Intl.NumberFormat().format(order.order_price)} VND</td>
                                    <td>${orderStatus}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/admin/order-detail/${order.order_id}">
                                                <button type="button" class="btn btn-info btn-sm btn-icon-text mr-3">
                                                    Chi tiết
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `;

                            $('#orderTable').fadeIn(200, () => {
                                $('#orderTable').append(orderRow);  
                            });
                        });
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }, 500);
});

$(document).ready(function() {
    $('.order-status').on('change', function() {
        var status = $(this).val();
        var orderId = $(this).data('order-id');
        console.log('Order ID: ' + orderId + ', Status: ' + status);
        $.ajax({
            url: '/admin/update-order-status', 
            method: 'POST',
            data: {
                order_id: orderId,
                order_status: status
            },
            success: function(response) {
                if (response.success) {
                    console.log('Cập nhật trạng thái thành công');
                } else {
                    console.log('Cập nhật thất bại');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
                console.log('Có lỗi xảy ra, vui lòng thử lại');
            }
            
        });
    });
});

