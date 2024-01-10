<?php

namespace App\Livewire\Front;

use App\Models\SmsRequest;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Cryptommer\Smsir\Smsir;

class Auth extends Component
{
    public $phoneFlag = true;
    public $loginFlag = false;
    public $smsFlag   = false;
    public $phone;
    public $smsCode;
    public $smsCodeSent;
    public $password;
    public $user;

    protected $rules    = [
        'phone' => 'required|numeric|digits:11',
    ];
    protected $messages = [
        'phone.required' => 'لطفا شماره خود را وارد کنید',
        'phone.numeric'  => 'شماره خود را صحیح وارد کنید',
        'phone.digits'   => 'شماره خود را صحیح وارد کنید',
    ];

    public function render()
    {
        return view('livewire.front.auth');
    }

    public function mount()
    {
        $reqTime = SmsRequest::all();
        foreach ($reqTime as $item) {
            $expire = Carbon::parse($item->created_at)->addMinutes(2) <= now();
            if ($expire) {
                $item->delete();
            }
        }
    }

    public function smsSubmit()
    {
        $validate = $this->validate([
            'smsCode' => 'required',
        ], [
            'smsCode.required' => 'لطفا کد ارسال شده را وارد کنید',
        ]);

        if ($this->smsCode != $this->smsCodeSent)
            $this->addError('smsCode', 'کد وارد شده اشتباه است');

        if ($validate && $this->smsCode == $this->smsCodeSent) {
            if ($this->user) {
                \Auth::login($this->user, true);
            } else {
                $user = User::query()->create([
                    'phone' => $this->phone,
                ]);
                \Auth::login($user, true);
            }
            $this->redirect(route('front.dashboard'));
        }
    }

    public function loginPassword()
    {
        $credential = $this->validate([
            'phone'    => 'required|alpha_num|digits:11|exists:users,phone'
            ,
            'password' => 'required|between:8,20',
        ], [
            'phone.required'    => 'شماره خود را صحیح وارد کنید',
            'phone.alpha_num'   => 'شماره خود را صحیح وارد کنید',
            'phone.digits'      => 'شماره خود را صحیح وارد کنید',
            'phone.exists'      => 'چنین شماره ای وجود ندارد',
            'password.required' => 'رمز عبور خود را وارد کنید',
            'password.between'  => 'رمز عبور باید بین 8 تا 20 کاراکتر باشد',
        ]);

        if (\Auth::attempt($credential)) {
            \Auth::login($this->user, true);
            return redirect(route('front.dashboard'));
        } else {
            $this->addError('password', 'رمز عبور اشتباه است');
        }
    }

    public function showLoginForm()
    {
        if ($this->validate()) {
            $this->user = User::query()->where('phone', $this->phone)->first();
            if ($this->user && $this->user->password != null) {
                $this->phoneFlag = false;
                $this->loginFlag = true;
            } else {
                $this->showSmsForm();
            }
        }
    }

    public function sendSms()
    {
        $this->mount();
        $this->resetErrorBag();
        $reqTime = SmsRequest::query()->where('phone', $this->phone)->latest()->first();
        if ($reqTime) {
            $expire = Carbon::parse($reqTime->created_at)->addMinutes(2) >= now();
            $time   = Carbon::parse($reqTime->created_at)->addMinutes(2)->diffInMinutes();
            if ($expire) {
                $this->addError('smsCode', 'لطفا بعد از ' . ($time + 1) . ' دقیقه مجددا تلاش کنید' . ' یا آخرین کد ارسال شده را وارد کنید');
            }
            $this->smsCodeSent = $reqTime->code;
        } else {
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
    }

    public function showSmsForm()
    {
        $this->sendSms();
        $this->returnToPhone();
        $this->phoneFlag = false;
        $this->smsFlag   = true;
    }

    public function returnToPhone()
    {
        $this->phoneFlag = true;
        $this->loginFlag = false;
        $this->smsFlag   = false;
        $this->smsCode   = null;
        $this->password  = null;
    }

    public function logout()
    {
        \Auth::logout();
        return redirect(route('index'));
    }
}
