<?php

namespace App\Http\Controllers;

use App\Http\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        return view('frontend.pages.booking',[
            'bookings'=> $this->bookingService->getAllCompleted(),
            'bookingsCancel'=> $this->bookingService->getAllCancel(),
            'hideSearchBar' => true,
            'bodyClass' => 'account-booking-index'
        ]);
    }
}
