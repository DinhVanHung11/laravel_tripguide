// const { forEach } = require("lodash");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteRow(id, url){
    if(confirm('Do you want to remove?')){
        $.ajax({
            type: 'DELETE',
            dataType: 'JSON',
            data: {id},
            url: url,
            success: function(response){
                console.log(response);
                if(!response.error){
                    alert(response.message);
                    location.reload();
                }else{
                    alert(response.message);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status==403) {
                    alert("This action is unauthorized");
                }
            }
        })
    }
}

$(document).ready(function(){
    var url = window.location.href;
    $('.nav-item .nav-link').each( function () {
        var href = $(this).attr('href');
        if(href == url){
            $(this).addClass('active');
            $(this).parents('.nav-treeview').prev().addClass('active');
            $(this).parents('.nav-treeview').parent().addClass('menu-open');
        }
    });
});

if($('#slug').length > 0 && $('#name').length > 0){
    $('#slug').on('focus', function(){
        $(this).val(convertToSlug($('#name').val()));
    })
}

function convertToSlug(str) {
    // Chuyển hết sang chữ thường
	str = str.toLowerCase();

	// xóa dấu
	str = str
		.normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
		.replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

	// Thay ký tự đĐ
	str = str.replace(/[đĐ]/g, 'd');

	// Xóa ký tự đặc biệt
	str = str.replace(/([^0-9a-z-\s])/g, '');

	// Xóa khoảng trắng thay bằng ký tự -
	str = str.replace(/(\s+)/g, '-');

	// Xóa ký tự - liên tiếp
	str = str.replace(/-+/g, '-');

	// xóa phần dư - ở đầu & cuối
	str = str.replace(/^-+|-+$/g, '');

	return str;
}

//Upload one file
$('#upload').change(function(){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        url : '/admin/upload/services/store',
        data: form,
        success: function(response){
            if(!response.error){
                $('#feature-image-show').html(response.html);
            }
        }
    });
});

//Upload multiple
$('#upload_gallery').change(function(){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        url : '/admin/upload/services/store',
        data: form,
        success: function(response){
            if(!response.error){
                var randomId = randomNumber();
                $('#gallery-image-show').append(`
                    <div class="image-show-item d-inline-block" data-id="${randomId}">
                        <a href="${response.url}" target="_blank">
                            <img src="${response.url}" alt="">
                        </a>
                        <span class="text-secondary delete-image" data-id="${randomId}">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                        <input type="hidden" name="image_gallery[]" value="${response.url}">
                    </div>
                `);
            }
        }
    });
});

$(document).on("click",".delete-image",function() {
    var id = $(this).data('id');
    $('#upload').val(null);
    $('#upload_gallery').val(null);
    $('.image-show-item').each(function(){
        if($(this).data('id') == id){
            $(this).remove();
        }
    })
});

function randomNumber(){
    var result = Math.floor(Math.random() * 10000) + 1;
    return result;
}


//Add Option Attribute
$('#add-attrbiute-option').on('click', function(){
    var tbody = $('#table-attribute-options tbody');
    var count = tbody.find('tr').length;

    tbody.append(`
        <tr class="new-option" id="new_option_${count}">
            <td>
                <input type="text" name="attribute_values[option_${count}][label]"/>
            </td>
            <td>
                <input type="text" name="attribute_values[option_${count}][value]"/>
            </td>
            <td>
                <input type="file" name="attribute_values[option_${count}][image]"/>
            </td>
            <td>
                <a href="javascript:void(0)" class="btn-delete-option" id="delete-option-${count}">Delete</a>
            </td>
            <input type="hidden" class="input-delete" name="attribute_values[option_${count}][delete]" value="0">
        </tr>
    `);
});
//End Add Option Attribute


//Add Hotel Advance Price Option
$('#add-price-option').on('click', function(){
    var tbody = $('#table-price-options tbody');
    var count = tbody.find('tr').length;

    tbody.append(`
        <tr class="new-option" id="new_option_${count}">
            <td>
                <input type="text" name="price_options[option_${count}][price]"/>
            </td>
            <td>
                <input type="text" name="price_options[option_${count}][price_sale]"/>
            </td>
            <td>
                <input type="number" name="price_options[option_${count}][people]"/>
            </td>
            <td>
                <a href="javascript:void(0)" class="btn-delete-option" id="delete-option-${count}">Delete</a>
            </td>
            <input type="hidden" class="input-delete" name="price_options[option_${count}][delete]" value="0">
        </tr>
    `);
});
//End Add Hotel Advance Price Option


//Delete Table Option
$('body').on('click' , '.table-add-options tr', function(e){
    if($(e.target).is('.btn-delete-option')){
        var self = $(e.target);

        var tr = self.closest('tr');
        tr.css('display', 'none');
        // tr.find('.input-delete').val(1);
        tr.find('.input-delete').each(function(){
            $(this).val(1);
        });
    }
});
//End Delete Table Option


//Save Table Option
$('body').on('click' , '.modal-advance', function(e){
    if($(e.target).is('#save-advance')){
        var self = $(e.target);
        var modal = self.closest('.modal-advance');

        if(modal.find('tr').length > 0){
            modal.addClass('has-options');
        }else{
            modal.removeClass('has-options');
        }
    }

    if($(e.target).is('#no-save-advance')){
        var self = $(e.target);
        var modal = self.closest('.modal-advance');

        if(!modal.hasClass('has-options')){
            var tbody = modal.find('tbody');
            tbody.html('');
        }
    }
});
//Save Table Option


//Save Hotel
$('#action-save').on('click', function(e){
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url : $(this).data('url'),
        data: $('#form-add, .advance-options-form').serialize(),
        success: function(response){
            if(!response.error){
                window.location.href = response.url;
            }else{
                window.location.reload();
            }
        },
    });
});
//End Save Hotel


//Upload Image For Table Option
$('.upload-table-image').each(function(){
    var self = $(this);

    self.change(function(){
        const form = new FormData();
        form.append('file', self[0].files[0]);

        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            url : '/admin/upload/services/store',
            data: form,
            success: function(response){
                if(!response.error){
                    var imageShow = self.closest('td').find('.feature-image-show');
                    var optionId = self.closest('tr').data('option-id');
                    imageShow.html(`
                        <a href="${response.url}" target="_blank">
                            <img src="${response.url}" alt="">
                        </a>
                        <span class="text-secondary delete-image" onclick="removeImageUpload(${optionId})">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                        <input type="hidden" name="attribute_values[${optionId}][image]" value="${response.url}">
                    `);
                }
            }
        });
    });
})
//End Upload Image For Table Option









