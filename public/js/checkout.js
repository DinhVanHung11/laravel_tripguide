/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
var formElements = {
  formBooking: $('#form-booking'),
  checkInInput: $('#form-booking input[name="check_in"]'),
  checkOutInput: $('#form-booking input[name="check_out"]'),
  featuresInput: $('#form-booking input[name="extra_features"]'),
  guestAdultsInput: $('#form-booking .guest-number-adults'),
  guestChildrenInput: $('#form-booking .guest-number-children'),
  guestInfantsInput: $('#form-booking .guest-number-infants'),
  hotelInput: $('#form-booking input[name="hotel_id"]'),
  totalInput: $('#form-booking input[name="total"]')
};
var errorElements = {
  errorTime: $('#form-booking .error-time'),
  errorRoom: $('#form-booking .error-room'),
  errorGuest: $('#form-booking .error-guest')
};
var dayBooking = 0;

//Handle Booking
$('#action-book').on('click', function () {
  var isValid = true;
  if (!validateTimeBooking() || !checkAmoutGuest()) {
    isValid = false;
  }
  ;
  if ($('.header-profile.user-logined').length == 0) {
    isValid = false;
    $('.authorization-link').trigger('click');
  }
  ;
  if (!isValid) return;
  formElements.formBooking.submit();
});
//End Handle Booking

//Handle Change Input Time
$('#form-booking .input-booking-time').on('change', function () {
  if (!validateTimeBooking()) {
    return;
  }
  ;
  var checkInTime = new Date(formElements.checkInInput.val()).getTime();
  var checkOutTime = new Date(formElements.checkOutInput.val()).getTime();
  dayBooking = (checkOutTime - checkInTime) / 86400000;
  var roomPrice = formElements.formBooking.find('input[name="room"]:checked').data('price');
  var roomOldPrice = formElements.formBooking.find('input[name="room"]:checked').data('old-price');
  var totalOldPrice = roomOldPrice * dayBooking;
  var totalPrice = roomPrice * dayBooking;
  formElements.totalInput.val(totalPrice); //set New Total Price
  displayPrice(roomPrice, totalOldPrice);
});
//End Handle Change Input Time

//Handle Select Room
$('#hotel-room input').each(function () {
  $(this).on('click', function () {
    var self = $(this);

    //Handle Price
    var roomPrice = self.data('price');
    var roomOldPrice = self.data('old-price');
    var totalOldPrice = dayBooking ? roomOldPrice * dayBooking : roomOldPrice;
    var totalPrice = dayBooking ? roomPrice * dayBooking : roomPrice;
    formElements.totalInput.val(totalPrice); //set New Total Price
    displayPrice(roomPrice, totalOldPrice);

    //Selecte Room Completed
    var position = formElements.formBooking.offset().top - $('.page-header').height();
    $("html, body").animate({
      scrollTop: position
    }, "slow");
  });
});
//End Handle Select Room

//Handle Selecte Features
$('#form-booking .info-extra-futures input').each(function () {
  $(this).on('click', function () {
    var self = $(this);
    var totalPrice = 0;
    var currentTotal = +formElements.totalInput.val();
    formElements.formBooking.find('.info-feature-selected').each(function () {
      if ($(this).data('feature') == self.val()) {
        if (self.is(':checked')) {
          $(this).css('display', 'flex');
        } else {
          $(this).hide();
        }
      }
    });
    if (self.is(':checked')) {
      totalPrice = currentTotal + parseInt(self.data('price'));
    } else {
      totalPrice = currentTotal - parseInt(self.data('price'));
    }
    formElements.totalInput.val(totalPrice); //Set New Total Price
    formElements.formBooking.find('.total-price-text').text("$".concat(formElements.totalInput.val()));
  });
});
//End Handle Selecte Features

function validateTimeBooking() {
  var isValid = true;
  if (new Date().getTime() - new Date(formElements.checkInInput.val()).getTime() > 0) {
    errorElements.errorTime.text('Checkin time must be after or in today');
    isValid = false;
  } else if (!formElements.checkInInput.val() || !formElements.checkOutInput.val()) {
    errorElements.errorTime.text('Both field time cannot be empty');
    isValid = false;
  } else if (dayBooking < 0) {
    errorElements.errorTime.text('Checkout time must be bigger than checkin time');
    isValid = false;
  }
  if (!isValid) {
    var position = formElements.formBooking.find('.info-time').offset().top - $('.page-header').height();
    $("html, body").animate({
      scrollTop: position
    }, "slow");
  } else {
    errorElements.errorTime.text(''); //remove text error
  }

  return isValid;
}
function displayPrice(roomPrice, totalOldPrice) {
  var checkInTime = new Date(formElements.checkInInput.val()).getTime();
  var checkOutTime = new Date(formElements.checkOutInput.val()).getTime();
  var dayBooking = (checkOutTime - checkInTime) / 86400000;
  var discount = ((1 - formElements.totalInput.val() / totalOldPrice) * 100).toFixed(2);

  //Display Price
  formElements.formBooking.find('.price-per-night').text('$' + roomPrice);
  formElements.formBooking.find('.percent-sale').text("".concat(discount !== null && discount !== void 0 ? discount : '0', "%"));
  formElements.formBooking.find('.info-price .price-for-night-label').text("".concat(dayBooking ? dayBooking : '1', " Nights"));
  formElements.formBooking.find('.info-price .price-for-night-number').text('$' + totalOldPrice);
  formElements.formBooking.find('.price-discount-percent').text("Discount ".concat(discount !== null && discount !== void 0 ? discount : '0', "%"));
  formElements.formBooking.find('.price-discount-number').text("$".concat(totalOldPrice - formElements.totalInput.val()));
  formElements.formBooking.find('.total-price-text').text("$".concat(formElements.totalInput.val()));
  if (discount != 0) {
    formElements.formBooking.find('.percent-sale').text("".concat(discount, "% OFF"));
    formElements.formBooking.find('.percent-sale').show();
  } else {
    formElements.formBooking.find('.percent-sale').hide();
  }
}

//Order Summary Guest
$('.order-summary .guest-display').on('click', function () {
  var self = $(this);
  self.parent().toggleClass('show');
});
var guestAdults = $('.guest-display .guest-adults');
var guestChildren = $('.guest-display .guest-children');
var guestInfant = $('.guest-display .guest-infant');
$('.order-summary .info-guest button').on('click', function () {
  var self = $(this);
  var action = self.data('action');
  var elNumberText = self.closest('.guest-option-item').find('.guest-number-text');
  var elNumberInput = self.closest('.guest-option-item').find('.guest-number-input');
  action == 'decrease' ? decreaseGuest(self, elNumberText, elNumberInput) : increaseGuest(self, elNumberText, elNumberInput);
});
function decreaseGuest(button, elNumberText, elNumberInput) {
  var number = +elNumberText.text();
  var dataText = elNumberText.data('text');
  number--;
  if (number <= 0) {
    button.addClass('disabled');
    elNumberText.text('0');
  } else {
    elNumberText.text(number);
  }
  elNumberInput.val(number);
  displayGuestSelected(dataText, number);
  showNoGuestSelected();
  displayComma();
}
function increaseGuest(button, elNumberText, elNumberInput) {
  $('.guest-no-selected').css('display', 'none');
  errorElements.errorGuest.text('');
  button.closest('.guest-option-item').find('.decrease-guest').removeClass('disabled');
  var number = +elNumberText.text();
  var dataText = elNumberText.data('text');
  number++;
  elNumberText.text(number);
  elNumberInput.val(number);
  displayGuestSelected(dataText, number);
  displayComma();
}
function displayGuestSelected(dataText, numberText) {
  switch (dataText) {
    case 'adults':
      numberText <= 0 ? guestAdults.text('') : guestAdults.text("".concat(numberText, " Adults"));
      break;
    case 'children':
      numberText <= 0 ? guestChildren.text('') : guestChildren.text("".concat(numberText, " Children"));
      break;
    case 'infant':
      numberText <= 0 ? guestInfant.text('') : guestInfant.text("".concat(numberText, " Infants"));
      break;
  }
}
function showNoGuestSelected() {
  if (guestAdults.text() == '' && guestChildren.text() == '' && guestInfant.text() == '') {
    $('.guest-no-selected').css('display', 'inline');
  }
}
function displayComma() {
  if (guestAdults.text() != '' && guestChildren.text() != '') {
    $('.comma-first').css('display', 'inline');
  } else {
    $('.comma-first').css('display', 'none');
  }
  if (guestInfant.text() != '' && guestChildren.text() != '' || guestInfant.text() != '' && guestAdults.text() != '') {
    $('.comma-second').css('display', 'inline');
  } else {
    $('.comma-second').css('display', 'none');
  }
}
function checkAmoutGuest() {
  isValid = true;
  if (formElements.guestAdultsInput.val() == 0 && formElements.guestChildrenInput.val() == 0 && formElements.guestInfantsInput.val() == 0) {
    errorElements.errorGuest.text('Please give us info amount people');
    isValid = false;
  } else if (formElements.guestAdultsInput.val() == 0) {
    errorElements.errorGuest.text('Must be adults or children in your trip');
    isValid = false;
  }
  if (!isValid) {
    var position = formElements.formBooking.find('.info-guest').offset().top - $('.page-header').height();
    $("html, body").animate({
      scrollTop: position
    }, "slow");
  } else {
    errorElements.errorGuest.text(''); //remove text error
  }

  return isValid;
}
//End Order Summary Guest
/******/ })()
;