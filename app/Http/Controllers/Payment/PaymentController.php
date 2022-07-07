<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(){
        $get_member = auth::user()->member;
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $pay = [
            'transaction_details' => [
                'order_id' => rand(1,99),
                'gross_amount' => 100000,
            ],
            'customer_details' => [
                'first_name' => 'hengkywibowo',
                'email' => 'hengkywibowo@gmail.com'
            ],
            'enabled_payments' => ['gopay','bank_transfer']
        ];

        try {
            $snaptoken = \Midtrans\Snap::getSnapToken($pay);
            // return $snaptoken;
            // $resp = [
            //     'status' => 'success',
            //     'message' => 'Request pembayaran berhasil!'
            // ];
            // return response()->json($resp);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('admin.accpembayaran',compact('get_member','snaptoken'));
    }
    public function checkout(){
        
    }
}
