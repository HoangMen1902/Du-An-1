function getForm() {
    let  userInput = {
        name: $('input[name="name"]').val().trim(),
        image: $('input[name="image"]').val().trim(),
        description: $('input[name="description"]').val().trim(),
        status: $('select[name="status"]').val(),
    };
    return userInput;
}

$( () => {
    $('#brandAdd').on('submit', (e) => {
        let is_valid = true;
        let input = getForm();

        Object.entries(input).forEach(([key, value]) => {
            if(!value) {
                $(`#${key}-validate`).show();
                is_valid = is_valid;
            } else {
                $(`#${key}-validate`).hide();
            }
        }) 
        if(!is_valid) {
            e.preventDefault()
        }
    })
})