<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $tenant_name = '';

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'tenant_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // In a real multi-tenant app, we would create a Tenant model here.
        // For now, we will just generate a tenant_id or use a placeholder logic 
        // as per the requirement to simple "register/login".
        // Assuming single DB column isolation, we might just store the tenant_name 
        // in a user profile or a separate tenants table.
        // Given the constraints, I will create the user and assume specific tenant logic 
        // comes later with the full schema. For now, I'll save the user.
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            // 'tenant_id' => ... (To be implemented with Tenant Model)
        ]);

        Auth::login($user);

        return redirect()->intended(route('cashier.dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
