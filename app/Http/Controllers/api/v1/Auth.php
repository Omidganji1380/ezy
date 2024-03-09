<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\SmsRequest;
use App\Models\User;
use Carbon\Carbon;
use Cryptommer\Smsir\Smsir;
use Illuminate\Http\Request;

class Auth extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $reqTime = SmsRequest::all();
        foreach ($reqTime as $item) {
            $expire = Carbon::parse($item->created_at)->addMinutes(2) <= now();
            if ($expire) {
                $item->delete();
            }
        }
    }

    public function index($phone)
    {
//        $user = User::where('phone', $phone)->first();
//        $time   = Carbon::parse($user->created_at)->addMinutes(2)->diffInMinutes()*60;
//            dd($time);
//        $user = User::where('phone', $phone)->first();
//        if ($user && $user->phone == $phone) {
//            return response()->json([
//                'message' => $phone . ' exists',
//                'status'  => 200,
//            ]);
//        }
//        else {
//            return response()->json([
//                'message' => $phone . ' wtf??',
//                'status'  => 404,
//            ]);
//        }
        $this->sendSms($phone);
    }

    public $smsCodeSent;
    public $sendAgainTime = 120;

    public function sendSms($phone)
    {
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()[]-_+=|":;>,<`~';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < 100; $i++) {
//            $randomString .= $characters[random_int(0, $charactersLength - 1)];
//        }
////        return $randomString;
//        dd($randomString);
        $this->__construct();
        $reqTime = SmsRequest::query()->where('phone', $phone)->latest()->first();
        if ($reqTime) {
            $expire = Carbon::parse($reqTime->created_at)->addMinutes(2) >= now();
            $time   = Carbon::parse($reqTime->created_at)->addMinutes(2)->diffInSeconds();
//            dd($time);
            if ($expire) {
                $this->sendAgainTime = $time + 1;
//                $this->addError('smsCode', 'لطفا بعد از ' . ($time + 1) . ' دقیقه مجددا تلاش کنید' . ' یا آخرین کد ارسال شده را وارد کنید');
            }
            $this->smsCodeSent = $reqTime->code;
        }
        else {
            $p    = $phone;
            $code = rand(11111, 99999);
            SmsRequest::query()->create([
                'phone' => $p,
                'code'  => $code,
            ]);
//            $send      = Smsir::Send();
//            $parameter = new \Cryptommer\Smsir\Objects\Parameters('CODE', $code);
//            $send->Verify($p, 749726, [$parameter]);
            $this->smsCodeSent = $code;
        }
//        dd($time);

        $response = [
            'sendAgainTime' => $this->sendAgainTime,
            'smsCodeSent'   => $this->smsCodeSent,
            'status'        => 200
        ];
//        dd($this->sendAgainTime, $response);

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
