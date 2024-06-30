<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\SmsRequest;
use App\Models\User;
use App\Responses\Errors;
use App\traits\api\JsonResponse;
use Carbon\Carbon;
use Cryptommer\Smsir\Objects\Parameters;
use Cryptommer\Smsir\Smsir;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Auth extends Controller
{
    use JsonResponse;
    public function __construct() {
        $reqTime = SmsRequest::all();
        foreach ($reqTime as $item) {
            $expire = Carbon::parse($item->created_at)
                            ->addMinutes(2) <= now();
            if ($expire) {
                $item->delete();
            }
        }
    }

    public $smsCodeSent;
    public $sendAgainTime = 120;
    public $phone;

    public function sendSms(Request $request) {
        $this->phone = $request->phone;
        $this->__construct();
        $reqTime = SmsRequest::query()
                             ->where('phone', $this->phone)
                             ->latest()
                             ->first();
        if ($reqTime) {
            $expire = Carbon::parse($reqTime->created_at)
                            ->addMinutes(2) >= now();
            $time   = Carbon::parse($reqTime->created_at)
                            ->addMinutes(2)
                            ->diffInSeconds();
            if ($expire) {
                $this->sendAgainTime = $time + 1;
            }
            $this->smsCodeSent = $reqTime->code;
        }
        else {
            $p    = $this->phone;
            $code = rand(11111, 99999);
            SmsRequest::query()
                      ->create([
                                   'phone' => $p,
                                   'code'  => $code,
                               ]);
            $send      = Smsir::Send();
            $parameter = new Parameters('CODE', $code);
            $send->Verify($p, 749726, [$parameter]);
            $this->smsCodeSent = $code;
        }

        $data = [
            'sendAgainTime' => $this->sendAgainTime,
            'smsCodeSent'   => $this->smsCodeSent,
            'status'        => 200,
        ];
        return response()->json($data);
    }

    public function login(Request $request) {
        $credential = $request->validate([
                                             'phone'    => 'required|string',
                                             'password' => 'required|min:8|string',
                                         ]);

        $user = User::where('phone', $credential['phone'])
                    ->first();
        if (!$user)
            return $this->throwError(Errors::$_USER_NOT_FOUND);

        if (\Auth::attempt($credential)) {
            \Auth::login($user, true);
            return $user;
        }
        else
            return $this->throwError(Errors::$_WRONG_PASSWORD);
    }

    public function logout(Request $request) {
        $userToLogout = User::find($request->id);
        if ($userToLogout) {
            \Auth::setUser($userToLogout);
            \Auth::logout();
            $data = [
                'logout'  => true,
                'massage' => 'Logout successful',
            ];
            return response()->json($data);
        }
    }
}
