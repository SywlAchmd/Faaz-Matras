<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class DeleteAllModal extends Component
{
    public $list_pesanan = [];


    public function mount()
    {
        //dd("masuk mount deleteitemmodal");
        $this->list_pesanan = Session::get('cart', []);
    }

    public function confirmDeleteAll()
    {
        Session::forget('cart');
        $this->updateSumPrice();
        //dd('confirmdelete');
        $this->dispatch('close-delete-all');
        $this->redirect(route('checkout'));
    }

    public function updateSumPrice()
    {
        $this->sumprice = array_reduce($this->list_pesanan, function ($carry, $item) {
            return $carry + ($item['price'] * $item['qty']);
        }, 0);
    }    

    public function render()
    {
        return view('livewire.customer.delete-all-modal');
    }
}