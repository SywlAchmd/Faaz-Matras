<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;

class Checkout extends Component
{
    public $list_pesanan = [];
    public $sumprice = 0;
    public $table_number;
    public $deleteIndex = null;
    protected $listeners = ['openOrderModal', 'deleteItem'];
    
    #[Url]
    public $table, $orderType;


    public function mount()
    {
        $this->list_pesanan = Session::get('cart', []);
        $this->updateSumPrice();
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'list_pesanan') === 0) {
            Session::put('cart', $this->list_pesanan);
            $this->updateSumPrice();
        }
    }

    public function updateSumPrice()
    {
        $this->sumprice = array_reduce($this->list_pesanan, function ($carry, $item) {
            return $carry + ($item['price'] * $item['qty']);
        }, 0);
    }

    public function increaseQty($index)
    {
        $this->list_pesanan[$index]['qty']++;
        Session::put('cart', $this->list_pesanan);
        $this->updateSumPrice();
    }

    public function decreaseQty($index)
    {
        if ($this->list_pesanan[$index]['qty'] > 1) {
            $this->list_pesanan[$index]['qty']--;
            Session::put('cart', $this->list_pesanan);
            $this->updateSumPrice();
        }
    }

    public function openDeleteItem($index)
    {
        $this->deleteIndex = $index;

        $this->dispatch('open-delete-item', name: 'delete-item-modal');
    }

    public function openDeleteAll()
    {
        $this->dispatch('open-delete-all');
    }

    public function openOrderModal()
    {
        $this->dispatch('open-modal');
    }

    // public function pesan()
    // {
    //     Session::forget('cart');
    //     $this->list_pesanan = [];
    //     $this->updateSumPrice();
    //     $this->dispatch('orderPlaced');
    // }

    public function render()
    {
        return view('livewire.customer.checkout');
    }
}
