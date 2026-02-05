<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class ForgotPassword extends Component
{
    public $email = '';
    public $status = null;

    public function sendResetLink()
    {
        $this->validate(['email' => 'required|email']);

        // We will send the password reset link via the standard Laravel broker
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = trans($status);
        } else {
            $this->addError('email', trans($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
