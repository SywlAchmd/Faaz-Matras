<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $username;
    public $email;
    public $password;
    public ?User $user;

    public function mount()
    {
        $this->user = auth()->user();
        $this->username = $this->user->username;
        $this->email = $this->user->email;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'username' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable',
        ]);

        if (empty($validatedData['email'])) {
            $validatedData['email'] = $this->user->email;
        }

        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $this->user->update($validatedData);

        session()->flash('message', 'Profil berhasil diperbarui.');

        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->password = '';

        // $this->reset(['password']);
        // $this->mount();
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.auth.profile');
    }
}
