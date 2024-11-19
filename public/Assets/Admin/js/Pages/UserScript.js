
function getInput() {
    let input = {
        firstName: $('input[name="firstName"]').val().trim(),
        lastName: $('input[name="lastName"]').val().trim(),
        password: $('input[name="password"]').val().trim(),
        email: $('input[name="email"]').val().trim(),
        role: $('input[name="role"]').val(),
    }

    return input;
}

function userValidate() {
    let input = getInput();
    let is_valid = true;
    Object.entries(input).forEach(([key, value]) => {
        if (value === '') {
            console.log(`${key}-validate`);
            $(`#${key}-validate`).show();
            is_valid = false;
        } else {
            $(`#${key}-validate`).hide();
        }
    })

    if (input.lastName.length > 50) {
        $('#lastName-invalid').show();
        is_valid = false;
    } else {
        $('#lastName-invalid').hide();
    }

    if (input.firstName.length > 50) {
        $('#firstName-invalid').show();
        is_valid = false;
    } else {
        $('#firstName-invalid').hide();
    }

    if (input.password.length < 8 && input.password != '') {
        $('#password-invalid').show();
        console.log(input.password);
        is_valid = false;
    } else {
        $('#firstName-invalid').hide();

    }


    if (!is_valid) {
        return false;
    }
    return true;
}

$('#addForm').on('submit', (e) => {
    if (!userValidate()) {
        e.preventDefault();
    }
})



$('#user-search').on('submit', (e) => {
    e.preventDefault();
});

$('#userSearch').on('change', (e) => {

    setTimeout(() => {
        $.ajax({
            type: "post",
            url: "/admin/user-search",
            data: { user: $('input[name="user"]').val().trim() },
            dataType: "text",
            success: function (response) {
                if (response === 'false') {
                    console.log('Lỗi khi fetch dữ liệu');
                } else {
                    let data = JSON.parse(response);
                    $('#userTable').fadeOut(200, () => {
                        $('#userTable').empty();
                    });
                    data.forEach(user => {
                        let html = `
                        <tr>
                                <td>${user.id}</td>
                                <td>${user.firstname} ${user.lastname}</td>
                                <td>${user.email}</td>
                                <td>${user.phone !== '' ? user.phone : 'Không có'}</td>
                                <td>${user.status == 1 ? 'Hoạt động' : 'Khóa'}</td>
                                <td>${user.role == 1 ? 'Khách hàng' : 'Quản Trị Viên'}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="/admin/edit-user/${user.id}">
                                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Sửa
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </button>
                                        </a>
                                        <form action="/admin/delete-user/1" method="get" onsubmit="return confirm('Bạn chắc là xóa chứ?')">
                                            <input type="hidden" name="method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm btn-icon-text">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `
                    $('#userTable').fadeIn(200, () => {
                        $("#userTable").append(html);
                    });

                    });
                }
            },
            error: function (xhr, status, error) {
                console.log("Error" + error);
            }
        });
    }, 500);
})

$('#lockedUserTable').on('submit', $('#deleteForm'), (e) => {
    e.preventDefault();
    let id = $('#deleteForm').attr('data-user');
    if(confirm('Bạn chắc chứ?')) {
        $.ajax({
            type: 'DELETE',
            url: `/admin/delete-user/${id}`,
            success: function (response) {
                if(response != []) {
                    $('#lockedUserTable').empty();
                    response.forEach(user => {
                        let html = `
                        <tr>
                                            <td>${user.id}</td>
                                            <td>${user.firstname} ${user.lastname}</td>
                                            <td>${user.email}</td>
                                            <td>${user.phone}</td>
                                            <td>${user.status == 1 ? 'Hoạt động' : 'Khóa'}</td>
                                            <td>${user.role == 1 ? 'Khách hàng' : 'Quản trị'}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="/admin/edit-user/${user.id}">
                                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                            Sửa
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </button>
                                                    </a>
                                                    <form action="/admin/delete-user/${user.id}" data-user="${user.id}" method="post" id="deleteForm">
                                                        <button type="submit" class="btn btn-danger btn-sm btn-icon-text">Xóa</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                        `
                        $('#lockedUserTable').append(html);
                    });
                } else {
    
                }
                
            }
        });
    }
    
})