<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $errorMessage;

    public function login() {
        $valid = $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($valid)) {
            $user = Auth::user();
            if ($user->role != 2) {
                Auth::logout();
                $this->errorMessage = 'Anda tidak memiliki akses untuk login.';
                return;
            }
            return redirect()->route('employee');
        }

        $this->errorMessage = 'Username atau password tidak cocok.';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
