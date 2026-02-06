<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;

#[Layout('components.layouts.app')]
class Users extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::where('tenant_id', auth()->user()->tenant_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.users');
    }
}
