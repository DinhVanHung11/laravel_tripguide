<?php

namespace App\Http\Controllers;

use App\Http\Services\BookingService;
use App\Models\Booking;
use Illuminate\Http\Request;

class VnpayController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function create(Request $request)
    {
        // session(['url_prev' => url()->previous()]);  //Save url to redirect back if checkout failed

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route("hotel.booking.vnpay.return");
        $vnp_TmnCode = "2AU3E5C7"; //Mã website tại VNPAY
        $vnp_HashSecret = "FVFALPBJARPBDWXQBYWCHRVJPTQDGQDG"; //Chuỗi bí mật

        $vnp_TxnRef = uniqid().time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Pay for hotel reservations';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)$request->price * 10000;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        //Handle Bank Code
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
        if($request->vnp_ResponseCode == "00") {
            $this->bookingService->insertDB(Booking::COMPLETED, 'Vnpay');
            $this->bookingService->sendEmail();
            session()->forget('bookings');
            return redirect()->route("hotel.booking.success");
        }

        session()->forget('url_prev');
        return redirect()->route("hotel.booking.checkout")->with('error' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
}
