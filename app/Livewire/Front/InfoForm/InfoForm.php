<?php

namespace App\Livewire\Front\InfoForm;

use App\Models\InfoFormOption;
use App\Models\SmsRequest;
use App\Models\User;
use Carbon\Carbon;
use Cryptommer\Smsir\Smsir;
use Livewire\Component;
use Livewire\WithFileUploads;

class InfoForm extends Component
{
    use WithFileUploads;
    public $user;
    public $infoForm;
    public $userPhone;
    public $submitted = false;
//    public $smsCode;
//    public $smsCodeSent;


    public $name;
    public $address;
    public $postCode;

    public    $products         = [];
    public    $options          = [];
    public    $option;
    public    $title;
    public    $text;
    public    $file;
    public    $submitButtonFlag = false;
    protected $rules            = [
        'name'    => 'required',
        'address' => 'required',
    ];
    protected $messages         = [
        'name.required'    => 'نام خود را وارد کنید',
        'address.required' => 'آدرس خود را وارد کنید',
    ];

    public function updated()
    {
        if ($this->text != null && $this->title != null)
        $this->submitButtonFlag = true;
    else
        $this->submitButtonFlag = false;
    }

    public function updateTexts()
    {
        $this->user->update([
            'name'     => $this->name,
            'postCode' => $this->postCode,
            'address'  => $this->address,
        ]);
    }

    public function addOption()
    {
        $this->clearInputs();
        $this->option = InfoFormOption::query()->create([
            'infoForm_id' => $this->infoForm->id,
        ]);
        $this->mount($this->user->phone);
    }

    public function submitOption()
    {
//        dd(is_file($this->text));
        $val = $this->validate([
            'title' => 'required',
            'text'  => 'required',
        ], [
            'title.required' => 'لطفا فیلد مورد نظر را پر کنید',
            'text.required'  => 'لطفا فیلد مورد نظر را پر کنید',
        ]);
        if ($val) {
            $this->option->update([
                'title' => $this->title,
                'text'  => $this->text,
            ]);
            $this->clearInputs();
            $this->addOption();
//            $this->mount($this->user->phone);
        }
    }

    public function deleteOption(InfoFormOption $option)
    {
        $option->delete();
        $this->clearInputs();
    }

    public function cancelOption()
    {
        $this->option->delete();
        $this->clearInputs();
    }

    public function clearInputs()
    {
        $this->resetErrorBag();
        $this->title  = null;
        $this->text   = null;
        $this->option = null;
        $this->mount($this->user->phone);
    }

    public function mount($phone)
    {
        $this->user = User::query()->where('phone', $phone)->first();
        abort_if($this->user == null, 404);
        $this->infoForm = \App\Models\InfoForm::query()->where(['user_id' => $this->user->id])->first();
        abort_if($this->infoForm == null, 404);
        if ($this->infoForm->status == 1) {
            $this->userPhone = $this->infoForm->user->phone;
            $this->fetchData();
        }
        elseif ($this->infoForm->status == 0) {
            $this->submitted = true;
            session()->put('submitted', 'فرم شما قبلا ثبت شده است');
        }
    }

    public function fetchData()
    {
        $this->name     = $this->user->name;
        $this->postCode = $this->user->postCode;
        $this->address  = $this->user->address;
        $this->products = $this->infoForm->infoProducts;
        $this->options  = $this->infoForm->infoOptions;
    }

    public function submit()
    {
        if ($this->validate()) {
            $this->infoForm->update([
                'status' => 0,
            ]);
            $this->submitted = true;
            session()->put('submitted', 'فرم شما ثبت شد');
        }
    }

    public function render()
    {
        return view('livewire.front.info-form.info-form')->layout('components.layouts.front.app');
    }
}
