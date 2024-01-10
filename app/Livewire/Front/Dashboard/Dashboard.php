<?php

namespace App\Livewire\Front\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public function gotoPageBuilder()
    {
        $this->redirect(route('pagebuilder.index'));
    }
    public function render()
    {
        return view('livewire.front.dashboard.dashboard')->layout('components.layouts.front.app');
    }
}
