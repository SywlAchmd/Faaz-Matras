<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class DeleteItemModal extends Component
{
    public $list_pesanan = [];
    public $deleteIndex = null;

    public function mount($index)
    {
        //dd("masuk mount deleteitemmodal");
        $this->deleteIndex = $index;
        $this->list_pesanan = Session::get('cart', []);
    }

    public function confirmDelete()
    {
        //dd('confirmdelete');

        if (!is_null($this->deleteIndex)) {
            unset($this->list_pesanan[$this->deleteIndex]);
            $this->list_pesanan = array_values($this->list_pesanan);
            Session::put('cart', $this->list_pesanan);
            $this->updateSumPrice();
            $this->deleteIndex = null;
        } else {
            dd($this->deleteIndex);
        }
        $this->dispatch('close-delete-item');
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
        return view('livewire.customer.delete-item-modal');
    }
}