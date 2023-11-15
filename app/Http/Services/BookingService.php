<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Booking;
use App\Models\BookingFeature;
use App\Models\HotelRoom;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Session;

class BookingService
{
    protected $hotelService;

    public function __construct()
    {
        $this->hotelService = new HotelService;
    }

    /**
     *
     *  @param \Illuminate\Http\Request $request;
     *  @return bool
     */
    public function createBooking($request)
    {
        $booking = (object) [
            "check_in" => $request->check_in,
            "check_out" => $request->check_out,
            "room" => $request->room,
            "hotel_id" => $request->hotel_id,
            "guest" => $request->guest,
            "features" => $request->extra_features,
            "price" => $request->total
        ];

        Session::put('bookings', $booking); //Moi 1 lan chi duoc dat 1 khach san

        return true;
    }


    /**
     *
     * @param object $booking
     * @param int $status
     */
    public function insertDB($status, $payment)
    {
        $booking = session()->get('bookings');
        $uid = (string) hexdec(uniqid());

        try{
            $bookingInstance = Booking::create([
                'booking_code' => 'FD_'.substr($uid, -6),
                'user_id' => auth()->user()->id,
                'check_in' => $booking->check_in,
                'check_out' =>  $booking->check_out,
                'hotel_id' =>  $booking->hotel_id,
                'room_id' =>  $booking->room,
                'total_price' =>  $booking->price,
                'payment' => $payment,
                'adults' =>  $booking->guest["adults"],
                'children' =>  $booking->guest["children"],
                'infants' =>  $booking->guest["infants"],
                'status' => $status
            ]);

            if(!is_null($booking->features)){

                foreach($booking->features as $feature_id){
                    BookingFeature::create([
                        'booking_id' => $bookingInstance->id,
                        'feature_id' => $feature_id
                    ]);
                }
            }
        }catch(\Exception $e){
            Session::flash('error', $e->getMessage());
        }
    }

    public function getAll()
    {
        return Booking::orderBy('created_at','desc')->get();
    }

        public function getPaginate()
    {
        return Booking::orderBy('created_at','desc')->paginate(20);
    }

    public function getNewestBooking()
    {
        return Booking::orderBy('created_at','desc')->limit(1)->first();
    }

    public function getAllCompleted()
    {
        return Booking::orderBy('created_at','desc')->where('status', Booking::COMPLETED)->get();
    }

    public function getAllCancel()
    {
        return Booking::orderBy('created_at','desc')->where('status', Booking::CANCELED)->get();
    }

    public function getHotel($hotel_id)
    {
        return $this->hotelService->getHotel($hotel_id);
    }

    public function getRoom($id)
    {
        if($id == 0){
            return 'Basic Room';
        }

        return HotelRoom::where('id', $id)->first();
    }

    public function getRoomName($id)
    {
        if($id == 0){
            return 'Basic Room';
        }

        $room =  HotelRoom::where('id', $id)->first();
        return $room->room_name;
    }

    public function sendEmail()
    {
        $user = auth()->user();
        SendMail::dispatch($user->email)->delay(now()->addSeconds(5));
    }

    public function getDate($dateString)
    {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        return $date->format('F d, Y');
    }

    public function getUser($id)
    {
        return User::find($id);
    }
}
