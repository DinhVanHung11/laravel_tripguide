import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    $('.lazy').Lazy();
});

$(document).ready(function(){
    //Modal Authentication
    $('.modal-auth-content .toggle-auth-content').on('click', function(){
        $('.modal-auth-signin, .modal-auth-signup').toggleClass('active');
    });
    //End Modal Authentication

    //Toggle Show Password
    $('.form-group .toggle-show-password').on('click', function(){
        $(this).find('img').toggleClass('active');
        var input = $(this).prev();
        var type = input.attr('type');
        if(type == 'password'){
            input.attr('type', 'text');
        }else{
            input.attr('type', 'password');
        }
    });
    //End Toggle Show Password

    //Update My Profile
    $('.form-account-update #file-input-circle').change(function(){
        var parents = $(this).closest('.form-account-update');
        parents.find('.action-save').text('Confirm Change');
        parents.find('.action-save').attr('type', 'submit');

        const form = new FormData();
        form.append('file', $(this)[0].files[0]);

        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            url : '/services/upload/store',
            data: form,
            success: function(response){
                if(!response.error){
                    parents.find('#input-image').val(response.url);
                    parents.find('.input-file-label ').find('img').attr('src', response.url);
                    parents.find('.input-file-label ').find('a').attr('href', response.url);
                }
            }
        });
    });

    $('.form-account-update').each(function(){
        var self = $(this);
        var inputs = self.find('input');
        var btnSaves = self.find('.action-save');

        btnSaves.each(function(e){
            $(this).on('click',function(e){
                if($(this).attr('type') == 'button'){
                    e.preventDefault();
                    $(this).text('Confirm Change');
                    $(this).attr('type', 'submit');
                    $(this).addClass('button-submit');
                }

                self.find('.account-name-input').removeClass('hidden');
                self.find('.account-name-input').focus();
                self.find('.account-name').addClass('hidden');
            });
        });

        inputs.each(function(){
            $(this).click(function(){
                self.find('.action-save').text('Confirm Change');
                self.find('.action-save').attr('type', 'submit');
                self.find('.action-save').addClass('button-submit');
            });
        });
    });
    //End Update My Profile

    //Tabs Home Page
    var cateItems = $('.block-search .search-cate-item');
    var cateHomeContents = $('.home-category-content');
    var dataCaetegoryId = 0;

    $(cateItems[0]).addClass('active');

    cateItems.each(function(){
        var self = $(this);

        if(self.hasClass('active')){
            dataCaetegoryId = self.data('category-id');
        }

        self.on('click', () => {
            cateItems.each(function(){
                $(this).removeClass('active');
            });

            self.addClass('active');
            dataCaetegoryId = self.data('category-id');

            cateHomeContents.each(function(){
                if($(this).data('category-id') == dataCaetegoryId){
                    $(this).addClass('active');
                }else{
                    $(this).removeClass('active');
                }
            });
        });
    });

    cateHomeContents.each(function(){
        if($(this).data('category-id') == dataCaetegoryId){
            $(this).addClass('active');
        }
    });
    //End Tabs Home Page

    //Filter Search
    $('.search-box input').each(function(){
        var self = $(this);

        self.on('keyup', function(){
            var value = self.val();
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url : $(this).data('url'),
                data: {
                    value: value
                },
                success: function(response){
                    if(!response.error){
                        self.parent().find('.search-results').html(response.html);
                    }
                },
            });
        });
    });

    $('body').on('click', '.search-box .search-results', function(e){
        if($(e.target).is('.result-item')){
            var self = $(e.target);
            var valueSelected = self.find('.result-text').text().trim();
            var resultId = self.data('id');

            self.closest('.search-box').find('.search-input').val(valueSelected.trim());
            self.closest('.search-box').find('.search-value').val(resultId);

        }else if($(e.target).is('.result-text')){
            var self = $(e.target);
            var valueSelected = self.text().trim();
            var resultId = self.parent().data('id');

            self.closest('.search-box').find('.search-input').val(valueSelected.trim());
            self.closest('.search-box').find('.search-value').val(resultId);
        }
    });

    $('#action-search').on('click', function(e){
        e.preventDefault();
        var self = $(this);
        var origin   = window.location.origin;

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: self.closest('form').serialize(),
            url: self.closest('form').attr('action'),
            success: function(response){
                if(!response.error){
                    window.location.href = `${origin}/${response.url}`;
                }
            }
        })
    });
    //End Filter Search

    //Top Tour Slide
    $(".tour-list").slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow:
            `<button class='top-prev slick-prev pull-left button-slide'>
                <i class="fa-solid fa-chevron-left"></i>
            </button>`,
        nextArrow:
            `<button class='top-next slick-next pull-right button-slide'>
                <i class="fa-solid fa-chevron-right"></i>
            </button>`,
        responsive: [
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    //End Top Tour Slide

    //Explore World Slide
    $(".explore-list").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow:
            `<button class='top-prev slick-prev pull-left button-slide'>
                <i class="fa-solid fa-chevron-left"></i>
            </button>`,
        nextArrow:
            `<button class='top-next slick-next pull-right button-slide'>
                <i class="fa-solid fa-chevron-right"></i>
            </button>`,
        responsive: [
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1.5,
                    slidesToScroll: 1,
                },
            }
        ],
    });
    //End Explore World Slide

    //Details Tabs Desc
    $($('.actions-list .action-item')[0]).addClass('active');

    $('.actions-list .action-item').each(function(){
        var self = $(this);
        var href = self.find('a').attr('href');

        self.on('click', function(){
            $('.info-description .action-item').each(function(){
                $(this).removeClass('active');
            });
            self.addClass('active');
        });
    });
    //End Details Tabs Desc

    //Tab My Bookings
    $('.bookings-tabs-nav .tab-item').on('click', function(){
        var self = $(this);
        var dataContent = self.data('content');

        $('.bookings-tabs-nav .tab-item').each(function(){
            $(this).removeClass('active');
        });

        self.addClass('active');

        $('.bookings-main .booking-content').each(function(){
            if($(this).data('content') == dataContent){
                $(this).addClass('active');
            }else{
                $(this).removeClass('active');
            }
        });
    });
    //End Tab My Bookings
});
