<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $user;
    public $name;
    public $phone;
    public $email;
    public $postCode;
    public $address;
    public $password;
    public $userProfiles=[];

    public function render() {
        $users = User::query()
                     ->whereBetween('role', [0, 3])
                     ->orderByDesc('created_at')
                     ->paginate(20);
        return view('livewire.admin.users', ['users' => $users]);
    }

    public function clearInputs() {
        $this->user     = null;
        $this->name     = null;
        $this->phone    = null;
        $this->email    = null;
        $this->postCode = null;
        $this->address  = null;
        $this->password = null;
        $this->userProfiles = null;
    }

    public function edit(User $user) {
        $this->clearInputs();
        $this->user     = $user;
        $this->name     = $user->name;
        $this->phone    = $user->phone;
        $this->email    = $user->email;
        $this->postCode = $user->postCode;
        $this->address  = $user->address;
    }

    public function delete(User $user) {
        $user->delete();
    }

    public function submit() {
        if ($this->user) {
            $this->user->update([
                                    'name'     => $this->name,
                                    'phone'    => $this->phone,
                                    'email'    => $this->email,
                                    'postCode' => $this->postCode,
                                    'address'  => $this->address,
                                    'password' => Hash::make($this->password),
                                ]);
        }
        else {
            /* $newUser =*/
            User::query()
                ->create([
                             'name'     => $this->name,
                             'phone'    => $this->phone,
                             'email'    => $this->email,
                             'postCode' => $this->postCode,
                             'address'  => $this->address,
                             'password' => Hash::make($this->password),
                         ]);
        }
        $this->clearInputs();
    }

    public function showProfiles(User $user) {
        $this->clearInputs();
        $this->userProfiles = $user->profiles;
    }
}
