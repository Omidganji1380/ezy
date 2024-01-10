<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;


    public function render()
    {
        $users = User::query()->whereBetween('role', [0, 3])->orderByDesc('created_at')->paginate(20);
        return view('livewire.admin.users', ['users' => $users]);
    }
}
