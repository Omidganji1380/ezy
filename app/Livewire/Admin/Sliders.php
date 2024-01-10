<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Sliders extends Component
{
    use WithFileUploads;

    public $sliders;

    public $slider;
    public $title;
    public $subtitle;

    public $image;

    public function mount()
    {
        $this->sliders = Slider::query()->orderByDesc('created_at')->get();
    }

    public function submit()
    {
        if ($this->slider) {
            $this->slider->update([
                'title'    => $this->title,
                'subtitle' => $this->subtitle,
            ]);
        } else {
            $slider       = Slider::query()->create([
                'title'    => $this->title,
                'subtitle' => $this->subtitle,
                'img'      => 0,
            ]);
            $this->slider = $slider;
        }
        if ($this->image) {
            $this->uploadImage($this->slider);
        }
        $this->clearInputs();
        $this->mount();
    }

    public function changeStatus(Slider $slider)
    {
        if ($slider->status == 0)
            $slider->update(['status' => 1]);
        else
            $slider->update(['status' => 0]);
//        dd($slider);
        $this->mount();
    }

    public function uploadImage(Slider $slider)
    {
        Storage::disk('public')->delete('sliders/slide-' . $slider->id . '/' . $slider->img);
        $filename     = $this->image->getFilename();
        $originalName = $this->image->getClientOriginalName();
        $this->image->storeAs('sliders/slide-' . $slider->id, $originalName, 'public');
        Storage::disk('local')->delete('livewire-tmp/' . $filename);

        $slider->update([
            'img' => $originalName,
        ]);
    }

    public function delete(Slider $slider)
    {
        Storage::disk('public')->deleteDirectory('sliders/slide-' . $slider->id);
        $slider->delete();
        $this->mount();
    }

    public function edit(Slider $slider)
    {
        $this->clearInputs();
        $this->slider   = $slider;
        $this->title    = $slider->title;
        $this->subtitle = $slider->subtitle;
    }

    public function clearInputs()
    {
        $this->slider   = '';
        $this->title    = '';
        $this->subtitle = '';
        $this->image    = '';
    }

    public function render()
    {
        return view('livewire.admin.sliders');
    }
}
