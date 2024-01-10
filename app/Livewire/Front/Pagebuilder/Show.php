<?php

namespace App\Livewire\Front\Pagebuilder;

use Livewire\Component;

class Show extends Component
{
    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.front.pagebuilder.show')->layout('components.layouts.pageBuilder.app');
    }
}
