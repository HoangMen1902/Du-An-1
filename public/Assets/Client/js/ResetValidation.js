$('#loginForm').on('submit', (e) => {
    if(!$('input[name="email"]').val().trim()) {
        e.preventDefault();
        $('#email-required').show();
    } else {
        $('#email-required').hide();
    }
})