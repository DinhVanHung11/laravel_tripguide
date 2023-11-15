$(document).ready(function(){
    $('#input-search-country').on('keyup', function(){
        var self = $(this);

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: '/admin/countries/services/searchAjax/get',
            data: {value: self.val()},
            success: function(response){
                if(!response.error){
                    self.parent().find('.search-results').html(response.html);
                }
            }
        });
    });

    $('body').on('click', '.form-group .search-results', function(e){
        if($(e.target).is('.result-item')){
            var self = $(e.target);
            var valueSelected = self.find('.result-text').text().trim();
            var resultId = self.data('id');

            self.closest('.form-group').find('.search-input').val(valueSelected.trim());
            self.closest('.form-group').find('.search-value').val(resultId);

        }else if($(e.target).is('.result-text')){
            var self = $(e.target);
            var valueSelected = self.text().trim();
            var resultId = self.parent().data('id');

            self.closest('.form-group').find('.search-input').val(valueSelected.trim());
            self.closest('.form-group').find('.search-value').val(resultId);
        }
    });
});
