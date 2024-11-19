document.querySelector('form').addEventListener('submit', function (e) {
    let is_valid = true;

    const fields = [
        { id: 'currentPassword', errorId: 'currentPassword-error', message: 'Mật khẩu hiện tại không được để trống *' },
        { id: 'newPassword', errorId: 'newPassword-error', message: 'Mật khẩu mới không được để trống *' },
        { id: 'confirmPassword', errorId: 'confirmPassword-error', message: 'Xác nhận mật khẩu không được để trống *' }
    ];

    fields.forEach((field) => {
        const input = document.getElementById(field.id);
        const errorDiv = document.getElementById(field.errorId);

        if (input && input.value.trim() === '') {
            errorDiv.textContent = field.message; 
            errorDiv.style.display = 'block';
            is_valid = false;
        } else if (input) {
            errorDiv.style.display = 'none'; 
        }
    });

    if (!is_valid) {
        e.preventDefault();
    }
});
