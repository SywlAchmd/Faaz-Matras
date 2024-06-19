<?php

namespace App\Livewire\Employee\Order;

use App\Models\Order;
use Livewire\Component;

class Bill extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.employee.order.bill');
    }
}
