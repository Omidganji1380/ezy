<?php

namespace App\Livewire\Admin\Pb;

use App\Models\Icon;
use App\Models\Log;
use App\Models\pbOption;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Options extends Component
{
    use WithFileUploads;

    public $options = [];
    public $option;
    public $selectedOption;

    public $title;
    public $icon;
    public $color;
    public $for;
    public $table;
    public $icons;

    public $linkTitle;
    public $link;
    public $linkDescription;
    public $moreDescription;
    public $moreOptionTitle;
    public $moreOptionDescription;

    public    $iconsFlag    = false;
    protected $rules        = [
        'title' => 'required',
        'icon'  => 'required',
        'color' => 'required',
        'for'   => 'required',
    ];
    protected $messages     = [
        'title.required' => 'تمام فیلد ها را پر کنید',
        'icon.required'  => 'تمام فیلد ها را پر کنید',
        'color.required' => 'تمام فیلد ها را پر کنید',
        'for.required'   => 'تمام فیلد ها را پر کنید',
    ];
    protected $dismissModal = false;

    public function getOptions($options)
    {
        $this->options = [];
        $this->option  = null;
        $this->option  = $options;
        $this->options = pbOption::query()->where('for', $options)->get();
        $this->title   = $options;
        if ($this->title == 'messenger')
            $this->title = 'پیام رسان ها';
        if ($this->title == 'social')
            $this->title = 'شبکه های اجتماعی';
        if ($this->title == 'call')
            $this->title = 'تماس و راه های ارتباطی';
        if ($this->title == 'link')
            $this->title = 'لینک و سوپر لینک';
    }

    public function getIconPaths()
    {
        for ($ii = 1; $ii <= 50; $ii++) {
            echo '<span class="path' . $ii . '"></span >';
        }
    }

    public function clearInputs()
    {
        $this->title                 = null;
        $this->icon                  = null;
        $this->color                 = null;
        $this->for                   = null;
        $this->linkTitle             = null;
        $this->link                  = null;
        $this->linkDescription       = null;
        $this->moreDescription       = null;
        $this->moreOptionTitle       = null;
        $this->moreOptionDescription = null;
        $this->selectedOption        = null;
    }

    public function insert()
    {
        if ($this->validate()) {
            if (!$this->selectedOption) {
                $option = pbOption::query()->create([
                    'title'                 => $this->title,
                    'color'                 => $this->color,
                    'for'                   => $this->for,
                    'icon'                  => $this->icon,
                    'sort'                  => 0,
                    'linkTitle'             => $this->linkTitle,
                    'link'                  => $this->link,
                    'linkDescription'       => $this->linkDescription,
                    'moreDescription'       => $this->moreDescription,
                    'moreOptionTitle'       => $this->moreOptionTitle,
                    'moreOptionDescription' => $this->moreOptionDescription,
                ]);
                $this->makeLog($option->id, 'آپشن ( ' . $this->title . ' ) را برای ( ' . $this->for . ' ) ایجاد کرد');
            }else{
                $this->selectedOption->update([
                    'title'                 => $this->title,
                    'color'                 => $this->color,
                    'for'                   => $this->for,
                    'icon'                  => $this->icon,
                    'sort'                  => 0,
                    'linkTitle'             => $this->linkTitle,
                    'link'                  => $this->link,
                    'linkDescription'       => $this->linkDescription,
                    'moreDescription'       => $this->moreDescription,
                    'moreOptionTitle'       => $this->moreOptionTitle,
                    'moreOptionDescription' => $this->moreOptionDescription,
                ]);
                $this->makeLog($this->selectedOption->id, 'آپشن ( ' . $this->title . ' ) را برای ( ' . $this->for . ' ) ویرایش کرد');
            }
            /*if ($this->icon) {
                $filename     = $this->icon->getFilename();
                $originalName = time() . '_' . $this->icon->getClientOriginalName();
                $this->icon->storeAs('pb/options', $originalName, 'public');
                Storage::disk('local')->delete('livewire-tmp/' . $filename);
            }
            $option->update([
                'icon' => $originalName,
            ]);*/

            if ($this->for == 'messenger')
                $this->for = 'پیام رسان';
            if ($this->for == 'social')
                $this->for = 'شبکه اجتماعی';
            if ($this->for == 'call')
                $this->for = 'تماس و راه های ارتباطی';
            if ($this->for == 'link')
                $this->for = 'لینک و سوپر لینک';

            $this->clearInputs();
        }
    }

    public function delete(pbOption $option)
    {
        $option->delete();
        $this->clearInputs();
        $this->getOptions($this->option);
    }

    public function edit(pbOption $option)
    {
        $this->clearInputs();
        $this->selectedOption        = $option;
        $this->title                 = $option->title;
        $this->icon                  = $option->icon;
        $this->color                 = $option->color;
        $this->for                   = $option->for;
        $this->linkTitle             = $option->linkTitle;
        $this->link                  = $option->link;
        $this->linkDescription       = $option->linkDescription;
        $this->moreDescription       = $option->moreDescription;
        $this->moreOptionTitle       = $option->moreOptionTitle;
        $this->moreOptionDescription = $option->moreOptionDescription;
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

    public function updated()
    {
        if ($this->title && $this->icon && $this->color && $this->for) {
            $this->dismissModal = true;
        }
        else {
            $this->dismissModal = false;
        }
    }

    public function searchIcons()
    {
        if ($this->icon) {
            $this->iconsFlag = true;
            $this->icons     = Icon::query()
                ->where('icon', 'like', '%' . $this->icon . '%')
                ->limit(10)
                ->orderByDesc('icon')
                ->get();
        }
        else
            $this->iconsFlag = false;
    }

    public function setIcon($icon)
    {
        $this->icon      = null;
        $this->icon      = $icon;
        $this->iconsFlag = false;
    }

    public function mount()
    {
//        $this->icons = Icon::query()->get();
    }

    public function render()
    {
        $this->table = pbOption::class;
        return view('livewire.admin.pb.options', ['dismissModal' => $this->dismissModal]);
    }
}
