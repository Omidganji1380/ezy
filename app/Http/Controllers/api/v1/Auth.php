<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\SmsRequest;
use App\Models\User;
use Carbon\Carbon;
use Cryptommer\Smsir\Smsir;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Auth extends Controller
{
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

    public $smsCodeSent;
    public $sendAgainTime = 120;
    public $phone;

    public function sendSms(Request $request)
    {
        $this->phone = $request->phone;
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()[]-_+=|":;>,<`~';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < 30; $i++) {
//            $randomString .= $characters[random_int(0, $charactersLength - 1)];
//        }
////        return $randomString;
//        dd($randomString);
//        dd($phone);
        $this->__construct();
        $reqTime = SmsRequest::query()->where('phone', $this->phone)->latest()->first();
        if ($reqTime) {
            $expire = Carbon::parse($reqTime->created_at)->addMinutes(2) >= now();
            $time   = Carbon::parse($reqTime->created_at)->addMinutes(2)->diffInSeconds();
            if ($expire) {
                $this->sendAgainTime = $time + 1;
            }
            $this->smsCodeSent = $reqTime->code;
        }
        else {
            $p    = $this->phone;
            $code = rand(11111, 99999);
            SmsRequest::query()->create([
                'phone' => $p,
                'code'  => $code,
            ]);
            $send      = Smsir::Send();
            $parameter = new \Cryptommer\Smsir\Objects\Parameters('CODE', $code);
            $send->Verify($p, 749726, [$parameter]);
            $this->smsCodeSent = $code;
        }

        $data = [
            'sendAgainTime' => $this->sendAgainTime,
            'smsCodeSent'   => $this->smsCodeSent,
            'status'        => 200
        ];
        return response()->json($data);
    }

//    public function register(Request $request)
//    {
//        $request->validate([
//            'phone' => ['required']
//        ]);
//        User::create([
//            'phone' => $this->phone
//        ]);
//        return response()->json([
//            'msg' => 'user created',
//        ]);
//    }

    public function login(Request $request)
    {
//        $request->validate([
//            'phone'=>['required']
//        ]);
        $user = User::where('phone', $request->phone)->first();
//        return $user;
        if ($request->otpCode == $this->smsCodeSent) {
            $currentUser = null;

            if ($user) {
                \Auth::login($user, true);
                $currentUser = $user;
            }
            else {
                $newUser = User::query()->create([
                    'phone' => $request->phone
                ]);
                \Auth::login($newUser, true);
                $currentUser = $newUser;
            }
            $data = [
                'currentUser' => $currentUser,
                'login'       => true,
                'msg'         => 'شما وارد شدید',
                'status'      => 200,
            ];
            return response()->json($data);
        }
        else {
            $data = [
                'login'  => false,
                'msg'    => 'کد وارد شده اشتباه است',
                'status' => 422,
            ];
            return response()->json($data, 422);
        }
//        if (! $user || ! Hash::check(/*$request->password,*/ $user->password)) {
//            throw ValidationException::withMessages([
//                'email' => ['The provided credentials are incorrect.'],
//            ]);
//        }
//        dd($user->createToken('$request->device_name')->plainTextToken);

//        return $user->createToken('$request->device_name')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $userToLogout = User::find($request->id);
        if ($userToLogout) {
            \Auth::setUser($userToLogout);
            \Auth::logout();
            $data = [
                'status' => 200
            ];
            return response()->json($data);
        }
    }
}
