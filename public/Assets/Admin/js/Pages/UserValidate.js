const { ajax } = require("jquery");

function getInput() {
    let input = {
        username: $('input[name="username"]').val().trim(),
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
        if(value === '') {
            console.log(`${key}-validate`);
            $(`#${key}-validate`).show();
            is_valid = false;
        } else {
            $(`#${key}-validate`).hide();
        }
    })

    if(input.lastName.length > 50 ) {
        $('#lastName-invalid').show();
        is_valid = false;
    }  else {
        $('#lastName-invalid').hide();
    }

    if(input.firstName.length > 50 ) {
        $('#firstName-invalid').show();
        is_valid = false;
    }  else {
        $('#firstName-invalid').hide();
    }

    if(input.password.length < 8 && input.password != '') {
        $('#password-invalid').show();
        console.log(input.password);
        is_valid = false;
    } else {
        $('#firstName-invalid').hide();

    }


    if(!is_valid) {
        return false;
    }
    return true;
}


