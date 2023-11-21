$('.payment-method-item').click(function(){
    var self = $(this);
    var paymentType = self.data('payment');
    var url = self.data('url');
    self.closest('form').attr('action', url);

    $('.payment-method-item').each(function(){
        $(this).removeClass('active');
    });

    self.addClass('active');

    $('.payment-method .payment-detail').each(function(){
        if($(this).data('payment') == paymentType){
            $(this).show();
        }else{
            $(this).hide();
        }
    });
});

$('#confirm-payment').on('click', function(){
    var self = $(this);
    var form = self.closest('form');

    if(form.attr('action') != undefined){
        form.submit();
    }
});
