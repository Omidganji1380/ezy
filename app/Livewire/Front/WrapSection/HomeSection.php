<?php

namespace App\Livewire\Front\WrapSection;

use App\Models\Slider;
use Livewire\Component;

class HomeSection extends Component
{
    public $sliders;

    public function mount()
    {
        $this->sliders = Slider::query()->where('status', 1)->orderByDesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.front.wrap-section.home-section');
    }

    public function dashboard()
    {
        if (\Auth::user()) {
            return redirect(route('front.dashboard'));
        }
    }
}
