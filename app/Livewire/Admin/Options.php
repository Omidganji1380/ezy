<?php

namespace App\Livewire\Admin;

use App\Models\Option;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Options extends Component
{
    use WithFileUploads;

    public $options;
    public $value   = [];
    public $favicon = '01';
    public $logo    = '01';
    public $music    = '01';

    public function updateOptions($key, Option $option)
    {
        $option->update([
            'value' => $this->value[$key][$option->id],
        ]);
    }

    public function updated()
    {
        if ($this->favicon != '01') {
            $this->favicon->storeAs('favicon', 'favicon.png', 'public');
            Storage::disk('local')->delete('livewire-tmp/' . $this->favicon->getFilename());
            $this->favicon = '';
            return redirect(route('admin.options'));
        }
        if ($this->logo != '01') {
            $this->logo->storeAs('favicon', 'logo.png', 'public');
            Storage::disk('local')->delete('livewire-tmp/' . $this->logo->getFilename());
            $this->logo = '';
            return redirect(route('admin.options'));
        }
        if ($this->music != '01') {
            $this->music->storeAs('favicon', 'music.mp3', 'public');
            Storage::disk('local')->delete('livewire-tmp/' . $this->music->getFilename());
            $this->music = '';
            return redirect(route('admin.options'));
        }
        $this->mount();
    }

    public function mount()
    {
        $this->options = Option::all();
        for ($i = 0; $i < count($this->options); $i++) {
            $this->value[] = [$this->options[$i]->id => $this->options[$i]->value];
        }
    }

    public function opt()
    {
        Storage::disk('local')->deleteDirectory('livewire-tmp');
        \Artisan::call('optimize');
    }
    public function render()
    {
        return view('livewire.admin.options');
    }
}
