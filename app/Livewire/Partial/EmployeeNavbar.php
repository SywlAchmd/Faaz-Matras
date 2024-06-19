<?php

namespace App\Livewire\Partial;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeeNavbar extends Component
{
    public $search;

    public function logout() {
        Auth::logout();
        $this->redirect(route('login'));
    }

    public function updatedSearch()
    {
        $this->emit('searchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.partial.employee-navbar');
    }
}
