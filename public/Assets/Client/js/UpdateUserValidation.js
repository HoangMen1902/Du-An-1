document.querySelector('form').addEventListener('submit', function (e) {
    let is_valid = true;

    const fields = [
        { id: 'fullname', errorId: 'fullname-error', message: 'Tên đầy đủ không được để trống *' },
        { id: 'firstname', errorId: 'firstname-error', message: 'Tên không được để trống *' },
        { id: 'lastname', errorId: 'lastname-error', message: 'Họ không được để trống *' },
        { id: 'phone', errorId: 'phone-error', message: 'Số điện thoại không được để trống *' },
        { id: 'email', errorId: 'email-error', message: 'Email không được để trống *' } 
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
