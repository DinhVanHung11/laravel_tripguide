<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BookingService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function add(Request $request)
    {
        $res = $this->bookingService->createBooking($request);

        if($res){
            return redirect()->route("hotel.booking.checkout");
        }

        return redirect()->back();
    }

    public function checkout()
    {
        // dd(session()->get("bookings"));
        if(session()->get("bookings")){
            return view('frontend.pages.checkout',[
                'hideSearchBar' => true,
                'bodyClass' => 'checkout-index-index'
            ]);
        }

        return redirect()->back()->with('error', 'Please selected hotel to checkout');
    }

    public function success()
    {
        return view('frontend.pages.success',[
            'hideSearchBar' => true,
            'bodyClass' => 'checkout-success',
            'booking' => $this->bookingService->getNewestBooking()
        ]);
    }
}
