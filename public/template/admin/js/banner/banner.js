$('#form-custom-modal').on('submit', function(e){
    e.preventDefault();
    var fomrData = new FormData();

    $('#form-custom-modal input').each(function(){
        if($(this).attr('type') == 'file'){
            fomrData.append('image', $(this)[0].files[0]);
        }else{
            fomrData.append($(this).attr('name'), $(this).val());
        }
    });

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        url : '/admin/banners/items/add',
        data: fomrData,
        success: function(response){
            if(response.error == false){
                $('#table_field_add_item').append(response.html);
                $('#exampleModal').modal('hide');
            }
        }
    });
});

$('#save').on('click', function(){
    var origin = window.location.origin;
    var items = [];
    var data = {};

    $('.form-data-banner input').each(function(){
        data[$(this).attr('name')] = $(this).val();
    });

    $('#table_field_add_item tbody tr').each(function(){
        var obj = {};

        $(this).find('td').each(function(){
            obj[$(this).data('key')] = $(this).data('value');
        });

        items.push(obj);
    });

    $.ajax({
        dataType: 'JSON',
        data: {
            items: items,
            id: $(this).data('id'),
            data: data
        },
        url: origin + '/admin/banners/items/store',
        type: 'POST',
        success: function(response){
            if(!response.error){
                window.location.replace(origin + `/${response.url_redirect}`);
            }
        }
    });
});

$('.delete-row').each(function(){
    $(this).on('click', function(){
        if(confirm('Do you want to remove?')){
            $(this).parent().parent().remove();
        }
    });
});

$('.edit-banner-item').each(function () {
    $(this).on('click', function(){
        $(this).parent().parent().find('td').each(function(){
            $('#form-custom-modal').find(`input[name="${$(this).data('key')}"]`).val($(this).data('value'));

            if($(this).data('key') == 'image'){
                $('#feature-image-show').html(`
                    <div class="image-show-item d-inline-block" data-path="${$(this).data('value')}">
                        <a href="${$(this).data('value')}" target="_blank">
                            <img src="${$(this).data('value')}" alt="">
                        </a>
                        <span class="text-secondary delete-image" data-path="${$(this).data('value')}">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                        <input type="hidden" name="image" value="${$(this).data('value')}">
                    </div>`
                );
            }
        });
    });
});
