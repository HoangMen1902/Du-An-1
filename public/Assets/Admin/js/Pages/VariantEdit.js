function deleteProperty(element) {

    let option = $(element).data('option');
    let skuVal = $(element).data('sku');


    if(confirm('Bạn chắc chắn chứ?')) {
        $.ajax({
            type: "DELETE",
            url: `/admin/variant/delete/${skuVal}/${option}`,
            success: function (response) {
                console.log(response);
                if(response.status == 200 || 201) {
                    location.reload();
                }
            },error(xhr,status,error) {
                console.log('that bai, ma loi: ' + error);
            }
        });
    }
}


function validateForm() {
    let isValid = true; 
    $(".properties-container").each(function () {
        const optionSelect = $(this).find(".option-select");
        const valueInput = $(this).find("input[name^='value_name']");
        const optionError = optionSelect.next(".text-danger");
        const valueError = valueInput.next(".text-danger");
        console.log(optionSelect);

        optionError.hide();
        valueError.hide();

        if (!optionSelect.val()) {
            optionError.text("Vui lòng chọn thuộc tính").show();
            isValid = false;
        }

        if (!valueInput.val().trim()) {
            valueError.text("Vui lòng nhập giá trị thuộc tính").show();
            isValid = false;
        }
    });

    return isValid;
}

$('#variantEditForm').on('submit', (e) => {
        if(!validateForm()) {
            e.preventDefault();
        }
})