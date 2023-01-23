const baseUrl = 'http://localhost:21080/api';

$(document).ready(function() {
    loadProducts();
});

function createRequest() {
    clearErrors();
    const data = getFormData($('#application').serializeArray());
    $.post(baseUrl + '/applications',data)
        .done(function(data) {
            onRequestCreated(data.id);
        })
        .fail(function(data) {
            if (data.status == 422) {
                showErrors(data.responseJSON);
            }
        })

}

function onRequestCreated(id) {
    $('#app_num').html('№ '+ id);
    $('#application').hide();
    $('#app_alert').show();
}

function showErrors(errors) {
    $.each(errors, function(index, error) {
        $('#' + error.field + '_error').html(error.message);
    });
}

function clearErrors() {
    $('#name_error').html('');
    $('#customer_name_error').html('');
    $('#product_id_error').html('');
    $('#price_error').html('');
    $('#phone_error').html('');
}

function getFormData(dataArray) {
    const data = {};
    $.each(dataArray, function(index, item) {
        data[item.name] = item.value;
    });

    return data;
}

function loadProducts()
{
    $.get( baseUrl + '/products', function( data ) {
        const productSelect = $("select[name='product_id']");
        $.each(data, function (index, item) {
            productSelect.append($("<option />").val(item.id).text(item.name));
        });
    });
}
