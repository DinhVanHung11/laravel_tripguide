@extends('admin.dashboard')

@php
use App\Http\Services\HotelService;
use App\Http\Services\BookingService;

$hotelService = new HotelService;
$bookingService = new BookingService;
@endphp

@section('admin.content.more')
    <div class="row">
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Booking Code</th>
                        <th>Client</th>
                        <th>Hotel</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Price</th>
                        <th>Booked At</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($bookings) > 0)
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ $bookingService->getUser($booking->user_id)->name }}</td>
                                <td>{{ $bookingService->getHotel($booking->hotel_id)->name }}</td>
                                <td>{{ $bookingService->getDate($booking->check_in) }}</td>
                                <td>{{ $bookingService->getDate($booking->check_out) }}</td>
                                <td>{{ $booking->total_price }}</td>
                                <td>{{ $booking->created_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            {{$bookings->links("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection
