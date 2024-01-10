<?php

namespace App\Livewire\Admin\Customers;

use App\Models\InfoForm;
use App\Models\InfoFormProducts;
use App\Models\InfoFormProductWork;
use App\Models\Log;
use App\Models\User;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Forms extends Component
{
    use WithPagination;

    public $phone;

    public $form;

    public $logs         = [];
    public $table;
    public $products     = [];
    public $productWorks = [];
    public $product;
    public $title;
    public $productWorkTitle;
    public $qty          = 1;
    public $user;


    public    $link;
    public    $smsPhone;
    public    $works          = [];
    public    $connectingWays = [];
    protected $rules          = [
        'phone' => 'required|digits:11',
    ];
    protected $messages       = [
        'phone.required' => 'شماره را وارد کنید',
        'phone.digits'   => 'شماره را صحیح وارد کنید',
    ];

    public function mount()
    {
        $this->clearInputs();
//        dd($this->forms[0]->logs[0]->user);
    }

    public function delete(InfoForm $infoForm)
    {
        $this->makeLog($infoForm->id, 'این فرم را حذف کرد');
        $infoForm->update([
            'status' => 0,
        ]);
    }

    public function restoring(InfoForm $infoForm)
    {
        $this->makeLog($infoForm->id, 'این فرم را بازیابی کرد');
        $infoForm->update([
            'status' => 1,
        ]);
    }

    public function edit(InfoForm $infoForm)
    {
        $this->clearInputs();
        $this->form     = $infoForm;
        $this->phone    = $infoForm->user->phone;
        $this->products = InfoFormProducts::query()->where('infoForm_id', $infoForm->id)->orderBy('id')->get();
        $this->user     = User::query()->where('phone', $this->form->user->phone)->first();
    }

    public function canEditPhone()
    {
        if ($this->form) {
            $log = Log::query()->with('user')->where(['model' => $this->table, 'model_id' => $this->form->id])->first();
            if (Auth::id() == $log->user_id) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return true;
        }
    }

    public function clearInputs()
    {
        $this->form     = null;
        $this->phone    = null;
        $this->products = [];
        $this->product  = null;
        $this->user     = null;
    }

    public function addCustomer()
    {
        if ($this->validate()) {
            $u = $this->createUser();

            if (!$this->form) {
                $form = InfoForm::query()->create([
                    'user_id' => $u->id,
                ]);
                $i    = $form->id;
            }
            else {
                $i = $this->form->id;
            }

            $text = $this->form ? 'شماره این فرم را به ( ' . $this->phone . ' ) ویرایش کرد' : 'این فرم را با شماره ( ' . $this->phone . ' ) ایجاد کرد';
            $this->makeLog($i, $text);
            $this->mount();
        }
    }

    public function showLogs(InfoForm $infoForm)
    {
        $this->logs = Log::query()->with('user')->where(['model' => $this->table, 'model_id' => $infoForm->id])->orderBy('created_at')->get();
    }

    public function addProduct()
    {
        if ($this->validate()) {
            if ($this->product) {
                $this->productSubmit($this->product);
            }
            $u = $this->createUser();
            if (!$this->form) {
                $form       = InfoForm::query()->create([
                    'user_id' => $u->id,
                ]);
                $f          = $form;
                $this->form = $f;
                $this->makeLog($f->id, 'این فرم را با شماره ( ' . $this->phone . ' ) ایجاد کرد');
            }
            else {
                $f = $this->form;
            }
            $this->product = InfoFormProducts::query()->create([
                'infoForm_id' => $f->id,
            ]);
            $this->makeLog($f->id, 'یک محصول اضافه کرد');
            $this->products = InfoFormProducts::query()->where('infoForm_id', $f->id)->orderBy('id')->get();
        }
    }

    public function createUser()
    {
        $u = User::query()->where('phone', $this->form ? $this->user->phone : $this->phone)->first();

        if (!$u) {
            $u = User::query()->create([
                'phone' => $this->phone,
            ]);
        }
        if ($this->form && $this->user->phone != $this->phone) {
            $u = $u->update([
                'phone' => $this->phone,
            ]);
        }
        return $u;
    }

    public function makeLog($model_id, $text)
    {
        Log::query()->create([
            'model'    => $this->table,
            'model_id' => $model_id,
            'user_id'  => Auth::id(),
            'text'     => $text,
        ]);
    }

    public function productSubmit(InfoFormProducts $infoFormProducts)
    {
        $qty = $this->qty > 0 ? $this->qty : 1;
        if ($infoFormProducts->title != $this->title || $infoFormProducts->qty != $qty) {
            $text = 'عنوان محصول را از ( ' . $infoFormProducts->title . ' ) به ( ' . $this->title . ' ) و تعداد محصول را از ( ' . $infoFormProducts->qty . ' ) به ( ' . $qty . ' ) تغییر داد';
            $this->makeLog($this->form->id, $text);
            $infoFormProducts->update([
                'title' => $this->title,
                'qty'   => $qty,
            ]);
        }
        $this->clearProductsInput();
    }

    public function addProductWork(InfoFormProducts $infoFormProducts)
    {
        if ($this->productWorkTitle) {
            InfoFormProductWork::query()->create([
                'title'              => $this->productWorkTitle,
                'infoFormProduct_id' => $infoFormProducts->id,
                'user_id'            => Auth::id(),
            ]);
            $formPhone    = $this->form->user->phone;
            $productTitle = $infoFormProducts->title;
            $workTitle    = $this->productWorkTitle;
            $text         = 'برای فرم شماره ( ' . $formPhone . ' ) محصول ( ' . $productTitle . ' ) کاری با عنوان ( ' . $workTitle . ' ) اضافه کرد';
            $this->makeLog($this->form->id, $text);
            $this->productWorkTitle = null;
            $qty                    = $this->qty > 0 ? $this->qty : 1;
            if ($infoFormProducts->title != $this->title || $infoFormProducts->qty != $qty) {
                $text = 'عنوان محصول را از ( ' . $infoFormProducts->title . ' ) به ( ' . $this->title . ' ) و تعداد محصول را از ( ' . $infoFormProducts->qty . ' ) به ( ' . $qty . ' ) تغییر داد';
                $this->makeLog($this->form->id, $text);
                $infoFormProducts->update([
                    'title' => $this->title,
                    'qty'   => $qty,
                ]);
            }
        }
    }

    public function deleteProductWork(InfoFormProductWork $infoFormProductWork, InfoFormProducts $infoFormProducts)
    {
        $formPhone    = $this->form->user->phone;
        $workTitle    = $infoFormProductWork->title;
        $productTitle = $infoFormProducts->title;
        $infoFormProductWork->delete();
        $text = 'برای فرم شماره ( ' . $formPhone . ' ) کار ( ' . $workTitle . ' ) را از محصول ( ' . $productTitle . ' ) حذف کرد';
        $this->makeLog($this->form->id, $text);
    }

    public function productCancel()
    {
        $this->clearProductsInput();
    }

    public function productEdit(InfoFormProducts $infoFormProducts)
    {
        $this->clearProductsInput();
        $this->product = $infoFormProducts;
        $this->title   = $infoFormProducts->title;
        $this->qty     = $infoFormProducts->qty;
    }

    public function productDelete(InfoFormProducts $infoFormProducts)
    {
        $text = 'محصولی با عنوان ( ' . $infoFormProducts->title . ' ) با تعداد ( ' . $infoFormProducts->qty . ' ) را حذف کرد';
        $this->makeLog($this->form->id, $text);
        $infoFormProducts->delete();
        $this->clearProductsInput();
    }

    public function clearProductsInput()
    {
        $this->product  = null;
        $this->title    = null;
        $this->qty      = null;
        $this->products = InfoFormProducts::query()->where('infoForm_id', $this->form->id)->orderBy('id')->get();
    }

    public function showLink(InfoForm $infoForm)
    {
        $this->link     = null;
        $this->qrCode   = null;
        $this->smsPhone = $infoForm->user->phone;
        $this->link     = route('infoForm', ['phone' => $this->smsPhone]);
    }

    public function showProgress(InfoForm $infoForm)
    {
        $this->works          = $infoForm->infoProducts;
        $this->form           = $infoForm;
        $this->connectingWays = $infoForm->infoOptions;
    }

    public function addWrokerForWork(InfoFormProductWork $work, $product)
    {
        if ($work->worker == Auth::id()) {
            $work->update([
                'worker' => null
            ]);
            $this->makeLog($this->form->id, 'برای شماره ( ' . $this->form->user->phone . ' ) برای محصول ( ' . $product . ' ) کار ( ' . $work->title . ' ) را تیک زد');
        }
        elseif ($work->worker == null) {
            $work->update([
                'worker' => Auth::id()
            ]);
            $this->makeLog($this->form->id, 'برای شماره ( ' . $this->form->user->phone . ' ) تیک کار ( ' . $work->title . ' ) را برای محصول ( ' . $product . ' ) برداشت');
        }
    }

    public function render()
    {
        $forms       = InfoForm::query()->with('logs')->orderByDesc('created_at')->paginate(20);
        $this->table = InfoForm::class;
        $Works       = InfoFormProductWork::query()->get('title')->groupBy('title');
        $allWorks    = [
            'پرداخت',
            'طراحی محصول',
            'طراحی وب',
            'تولید',
            'ارسال',
            'CRM',
        ];
        foreach ($Works as $k => $item) {
            array_push($allWorks, $k);
        }
        $allWorks = array_unique($allWorks);
        return view('livewire.admin.customers.forms', ['forms' => $forms, 'allWorks' => $allWorks]);
    }
}
