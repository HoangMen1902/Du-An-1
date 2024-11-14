
$('#loginForm').on('submit', (e) => {

    let email = $('#email').val();
    let password = $('#password').val();
    let is_valid = true;

    if(email == '') {
        $('#email-required').show();
        is_valid = false;
    } else {
        $('#email-required').hide();
    }

    if(password == '') {
        $('#password-required').show();
        is_valid = false;
    } else {
        $('#password-required').hide();
    }
    console.log(email, password);
    if(is_valid != true) {
        e.preventDefault();

    }
})

function registerValidate() {
    let registerForm = document.getElementById('registerForm');
    let input = registerForm.elements;
    let is_valid = 0;
    if (input['email'].value === '') {
        document.getElementById('email-required').style.display = 'block';
        is_valid = 1;
    } else {
        document.getElementById('email-required').style.display = 'none';
    }


    if (input['firstname'].value === '') {
        document.getElementById('firstname-required').style.display = 'block';
        is_valid = 1;
    } else {
        document.getElementById('firstname-required').style.display = 'none';
    }
    if (input['lastname'].value === '') {
        document.getElementById('lastname-required').style.display = 'block';
        is_valid = 1;
    } else {
        document.getElementById('lastname-required').style.display = 'none';
    }

    if (input['password'].value === '') {
        document.getElementById('password-required').style.display = 'block';
        is_valid = 1;
    } else {
        document.getElementById('password-required').style.display = 'none';
    }
    if (input['passwordhash'].value === '') {
        document.getElementById('passwordhash-required').style.display = 'block';
        is_valid = 1;
    } else {
        document.getElementById('passwordhash-required').style.display = 'none';
    }
    if (is_valid === 1) {
        return false;
    }
    return true;
}

