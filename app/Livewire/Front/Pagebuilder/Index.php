<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Models\Profile;
use App\Models\UrlRedirector;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Index extends Component
{
    use WithFileUploads;

    public    $nextButton  = false;
    public    $nextButton2 = false;
    public    $url;
    public    $img;
    public    $title;
    public    $subtitle;
    public    $category_id;
    public    $profiles;
    protected $rules       = [
        'url' => 'required'
    ];

    public function edit(Profile $profile)
    {
        $this->redirect(route('pagebuilder.pagebuilder', $profile->link));
    }

    public function reservedUrls()
    {
        $routes = \Route::getRoutes()->getRoutes();
        $nr     = [];
        $nr2    = [];

        foreach ($routes as $route) {
            $nr[] = explode('/', $route->uri);
        }
        foreach ($nr as $item) {
            foreach ($item as $i) {
                $nr2[] = $i;
            }
        }
        $nr2 = array_unique($nr2);
        $nr2 = array_filter($nr2);
//        dd($nr2);
        $aa = array_search($this->url, $nr2);
        return $aa;

    }

    public function mount()
    {
        $this->profiles = Profile::query()->where('user_id', Auth::id())->orderByDesc('created_at')->get();
//        $this->reservedUrls();
    }

    public function updated()
    {
        $this->resetErrorBag();
        if ($this->url && strlen($this->url) > 2) {
            $redirectorUrlsReserved = UrlRedirector::query()->where('url', $this->url)->exists();
            if (!Profile::query()->where('link', $this->url)->exists() && !$redirectorUrlsReserved && !$this->reservedUrls())
                $this->nextButton = true;
            else {
                $this->nextButton = false;
                $this->addError('url', 'این لینک قبلا ثبت شده است');
            }
        }
        else {
            $this->nextButton = false;
        }
        if ($this->title && strlen($this->url) > 2) {
            $this->nextButton2 = true;
        }
        else
            $this->nextButton2 = false;
    }

    public function submit()
    {
        if (!Profile::query()->where('link', $this->url)->exists() && !$this->reservedUrls()) {
            $profile = Profile::query()->create([
                'link'     => $this->url,
                'title'    => $this->title ? $this->title : 'بدون عنوان',
                'subtitle' => $this->subtitle,
                'user_id'  => Auth::id(),
            ]);
            if ($this->img) {
                $filename     = $this->img->getFilename();
                $originalName = $this->img->getClientOriginalName();
                $this->img->storeAs('pb/profiles/profile-' . $profile->id, $originalName, 'public');
                Storage::disk('local')->delete('livewire-tmp/' . $filename);
                $profile->update([
                    'img' => $originalName
                ]);
            }
            $this->redirect(route('pagebuilder.pagebuilder', $profile->link));
        }
    }

    public function render()
    {
        return view('livewire.front.pagebuilder.index')->layout('components.layouts.pageBuilder.app');
    }
}
