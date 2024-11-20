$('#loginForm').on('submit', (e) => {
    if(!$('input[name="email"]').val().trim()) {
        e.preventDefault();
        $('#email-required').show();
    } else {
        $('#email-required').hide();
    }
})


$('#mail-form').on('submit', (e) => {
    if(!$('input[name="password"]').val().trim()) {
        e.preventDefault();
        $('#password-required').show();
    } else {
        $('#password-required').hide();
    }
})

$('#reset-form').on('submit', (e) => {
    if(!$('input[name="password"]').val().trim()) {
        e.preventDefault();
        $('#password-required').show();
    } else {
        $('#password-required').hide();
    }

    if(!$('input[name="password-verify"]').val().trim()) {
        e.preventDefault();
        $('#password-verify-required').show();
    } else {
        $('#password-verify-required').hide();
    }

    if($('input[name="password"]').val().trim() != $('input[name="password-verify"]').val().trim()) {
        e.preventDefault();
        $('#password-false').show();
    } else {
        $('#password-false').hide();
    }
})

