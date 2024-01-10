<?php

namespace App\Livewire\Front\WrapSection;

use App\Models\Contact;
use Livewire\Component;

class ContactSection extends Component
{
    public $firstRecord;
    public $infos;

    public    $name;
    public    $phone;
    public    $email;
    public    $text;
    protected $rules    = [
        'name'  => 'required|min:3',
        'phone' => 'numeric|digits:11|required_without:email',
        'email' => 'required_without:phone|email',
        'text'  => 'required|min:10|max:5000',
    ];
    protected $messages = [
        'name.required'          => 'نام خود را وارد کنید',
        'name.min'               => 'نام باید بیشتر از 3 کاراکتر باشد',
        'phone.numeric'          => 'شماره خود را صحیح وارد کنید',
        'phone.digits'           => 'شماره خود را صحیح وارد کنید',
        'phone.required_without' => 'در صورت عدم وجود ایمیل، شماره خود را وارد کنید',
        'email.required_without' => 'در صورت عدم وجود شماره، ایمیل خود را وارد کنید',
        'email.email'            => 'ایمیل خود را صحیح وارد کنید',
        'text.required'          => 'متن پیام خود را وارد کنید',
        'text.min'               => 'متن پیام، باید بین 10 تا 5000 کاراکتر باشد',
        'text.max'               => 'متن پیام، باید بین 10 تا 5000 کاراکتر باشد',
    ];


    public function mount()
    {
        $this->firstRecord = Contact::query()->first();
        if (!$this->firstRecord) {
            $this->firstRecord = Contact::query()->create();
        }
        $this->infos = Contact::query()->where('id', '>', $this->firstRecord->id)->where('position', 0)->get();
    }

    public function sendMessage()
    {
        if ($this->validate()) {
            Contact::query()->create([
                'name'     => $this->name,
                'phone'    => $this->phone,
                'email'    => $this->email,
                'text'     => $this->text,
                'position' => 1,
            ]);
            $this->name  = '';
            $this->phone = '';
            $this->email = '';
            $this->text  = '';
            $this->addError('sent', 'با تشکر، پیام شما فرستاده شد. در اسرع وقت با شما تماس میگیریم.');
        }
    }

    public function render()
    {
        return view('livewire.front.wrap-section.contact-section');
    }
}
