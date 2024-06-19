<?php

namespace App\Livewire\Employee\Order;

use Livewire\Component;
use App\Models\Order;

class OrderList extends Component
{
    public $orderList;
    public $selectedStatus = 'pending';

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orderList = Order::where('status', $this->selectedStatus)->get();
    }

    public function filterOrders($status)
    {
        $this->selectedStatus = $status;
        $this->loadOrders();
    }

    public function openOrderDetail($orderId)
    {
        $this->dispatch('openModalDetail', $orderId);
    }

    public function deleteOrder($orderId)
    {
        Order::find($orderId)->delete();
        $this->loadOrders();
    }

    public function render()
    {
        return view('livewire.employee.order.order-list');
    }
}

