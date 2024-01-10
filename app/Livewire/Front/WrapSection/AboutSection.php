<?php

namespace App\Livewire\Front\WrapSection;

use App\Models\About;
use Livewire\Component;

class AboutSection extends Component
{
    public $firstRecord;
    public $teams;
    public $skills;
    public $bottoms;

    public function mount()
    {
        $this->firstRecord = About::query()->first();
        if (!$this->firstRecord) {
            $this->firstRecord = About::query()->create();
        }
        $this->teams   = About::query()->where('id', '>', $this->firstRecord->id)->whereNull(['skillPercentage', 'bottomTitle'])->get();
        $this->skills  = About::query()->where('id', '>', $this->firstRecord->id)->whereNotNull('skillPercentage')->get();
        $this->bottoms = About::query()->where('id', '>', $this->firstRecord->id)->whereNotNull('bottomTitle')->whereNull(['skillPercentage', 'infoTitle', 'infoImg', 'infoLocation', 'skillTitle'])->get();
    }

    public function render()
    {
        return view('livewire.front.wrap-section.about-section');
    }
}
