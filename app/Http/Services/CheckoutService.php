<?php

namespace App\Http\Services;

use App\Models\ExtraService;
use App\Models\Hotel;
use App\Models\HotelRoom;
use DateTime;
use Illuminate\Support\Facades\Session;

class CheckoutService
{
    protected $booking;

    public function __construct()
    {
        $this->booking = Session::get('bookings');
    }

    public function getAllDate($checkin, $checkout)
    {
        $dateCheckIn = DateTime::createFromFormat('Y-m-d', $checkin);
        $checkInDisplay = $dateCheckIn->format('F d, Y');
        $dateCheckOut = DateTime::createFromFormat('Y-m-d', $checkout);
        $checkOutDisplay = $dateCheckOut->format('F d, Y');

        return $checkInDisplay.' - '.$checkOutDisplay;
    }

    public function getDate($dateString)
    {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        return $date->format('F d, Y');
    }

    public function getTotalGuest($guests)
    {
        return array_sum(array_values($guests));
    }

    public function getStringGuest($guests)
    {
        $str = '';

        foreach($guests as $key => $item){
            if($item != 0){
                $str .= $item.' '.ucfirst($key).', ';
            }
        }

        return substr(trim($str),0,-1);
    }

    public function getNumberDay()
    {
        return (strtotime($this->booking->check_out) - strtotime($this->booking->check_in))/86400;
    }

    public function getPricePerNightOrigin()
    {
        if($this->booking->room == 0){
            $hotel = Hotel::find($this->booking->hotel_id);
            return $hotel->price;
        }

        $room = HotelRoom::where('id', $this->booking->room)->first();
        return $room->price;
    }

    public function getDiscountPrice()
    {
        if($this->booking->room == 0){
            $hotel = Hotel::find($this->booking->hotel_id);
            return $hotel->price_sale ?? $hotel->price;
        }

        $room = HotelRoom::where('id', $this->booking->room)->first();
        return $room->price_sale ?? $room->price;
    }

    public function getDiscountPercent()
    {
        $originPrice = $this->getPricePerNightOrigin();
        $discountPrice = $this->getDiscountPrice();

        return $originPrice == $discountPrice ? 0 : number_format((float)((1 - $discountPrice/$originPrice)*100), 2);
    }

    public function getExFeaturesPrice()
    {
        if(is_null($this->booking->features)) return 0;

        $total = 0;

        foreach( $this->booking->features as $feature_id ){
            $featureInstance = ExtraService::find($feature_id);
            $total += $featureInstance->price;
        }

        return $total;
    }
}
