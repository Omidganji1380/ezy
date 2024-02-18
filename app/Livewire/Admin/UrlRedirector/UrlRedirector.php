<?php

namespace App\Livewire\Admin\UrlRedirector;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\UrlRedirector as Redirector;
use function Laravel\Prompts\error;

class UrlRedirector extends Component
{
    use WithPagination;

    public    $link;
    public    $url;
    public    $redirectTo;
    public    $visit;
    public    $submitFlag = false;
    protected $rules      = [
        'url'        => 'required|unique:url_redirectors,url',
        'redirectTo' => 'required',
    ];
    protected $messages   = [
        'url.required'        => 'لینک مبدا را وارد کنید',
        'url.unique'          => 'لینک مبدا تکراری می باشد',
        'redirectTo.required' => 'لینک مقصد را وارد کنید',
    ];

    public function clearInputs()
    {
        $this->link       = null;
        $this->url        = null;
        $this->redirectTo = null;
        $this->visit      = null;
    }

    public function edit(Redirector $urlRedirector)
    {
        $this->clearInputs();
        $this->link       = $urlRedirector;
        $this->url        = $urlRedirector->url;
        $this->redirectTo = $urlRedirector->redirectTo;
        $this->visit      = $urlRedirector->visit;
    }

    public function delete(Redirector $urlRedirector)
    {
        $urlRedirector->delete();
    }

    public function submit()
    {
        if ($this->link) {
            $this->link->update([
                'url'        => $this->url,
                'redirectTo' => $this->redirectTo,
            ]);
        }
        else {
            Redirector::query()->create([
                'url'        => $this->url,
                'redirectTo' => $this->redirectTo,
            ]);
        }
        $this->clearInputs();
    }

    public function updated($url)
    {
        $this->validateOnly($url);
        if ($this->validate()) {
            $this->submitFlag = true;
        }
        else {
            $this->submitFlag = false;
        }
    }

    public function randUrl()
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $this->url = $randomString;
    }

    public function render()
    {
        $urls = Redirector::query()->orderByDesc('id')->paginate(20);
        return view('livewire.admin.url-redirector.url-redirector', ['urls' => $urls]);
    }
}
