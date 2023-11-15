@php
use App\Http\Services\CheckoutService;
use App\Http\Services\HotelService;
use App\Http\Services\BookingService;

$checkoutService = new CheckoutService;
$hotelService = new HotelService;
$bookingService = new BookingService;

$booking = $bookingService->getNewestBooking();
$hotel = $hotelService->getHotel($booking->hotel_id);
$user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="font-size: 40px">Hi {{ $user->name }}. Thanks for your booking!</h1>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="inner email-body" style="margin: 0 auto;">
        <tr class="hotel-info">
            <td>
                <span style="font-size: 28px; font-weight: 700; margin-top: 0; margin-bottom: 0">{{ $hotel->name }}</span>
            </td>
        </tr>
        <tr>
            <td  style="padding-bottom: 24px;"></td>
        </tr>
        <tr>
            <td>
                <span style="font-size: 18px; font-weight: 500; display: inline-block; width: 150px">Booking Code</span>
                <span style="padding-left: 30px; font-size: 18px; font-weight: 400">{{ $booking->booking_code }}</span>
            </td>
        </tr>
        <tr>
            <td  style="padding-bottom: 12px;"></td>
        </tr>
        <tr>
            <td>
                <span style="font-size: 18px; font-weight: 500; display: inline-block; width: 150px">Check In</span>
                <span style="padding-left: 30px; font-size: 18px; font-weight: 400">
                    {{ $checkoutService->getDate($booking->check_in) }}
                </span>
            </td>
        </tr>
        <tr>
            <td  style="padding-bottom: 12px;"></td>
        </tr>
        <tr>
            <td>
                <span style="font-size: 18px; font-weight: 500; display: inline-block; width: 150px">Check Out</span>
                <span style="padding-left: 30px; font-size: 18px; font-weight: 400">
                    {{ $checkoutService->getDate($booking->check_out) }}
                </span>
            </td>
        </tr>
        <tr>
            <td  style="padding-bottom: 12px;"></td>
        </tr>
        <tr>
            <td>
                <span style="font-size: 18px; font-weight: 500; display: inline-block; width: 150px">Room</span>
                <span style="padding-left: 30px; font-size: 18px; font-weight: 400">
                    {{ $bookingService->getRoomName($booking->room_id) }}
                </span>
            </td>
        </tr>
        <tr>
            <td  style="padding-bottom: 24px;"></td>
        </tr>
        <tr class="email-action" style="text-align: center;">
            <td style="background: #3B71FE; color: #FFFFFF !important; font-size: 16px; line-height: 20.93px; letter-spacing: 0.2px; text-transform: uppercase; padding: 8px 48px; display: inline-block;"><div><a href="{{ route('home') }}" style="color: #FFFFFF !important;" class="email-nav">Countinue Booking Now!</a></div></td>
        </tr>
    </table>
</body>
</html>





