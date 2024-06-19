<?php

namespace App\Livewire\Forms;

use App\Models\Order;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Ramsey\Uuid\Type\Integer;

class OrderForm extends Form
{
    public $items;
    public $desc;
    public $price;
    public $status;
    public ?Order $order;
    
    public function setOrder(Order $order) {
        $this->order = $order;
        
        $this->items = $order->items;
        $this->desc = $order->desc;
        $this->price = $order->price;
        $this->status = $order->status;
    }

    public function store() {
        $validate = $this->validate([
            'items' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        Order::create($validate);
        $this->reset();
    }

    public function update() {
        $validate = $this->validate([
            'items' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        $this->order->update($validate);
        $this->reset();
    }
}
