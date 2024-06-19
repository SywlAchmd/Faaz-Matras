<?php

namespace App\Livewire\Employee\Order;

use App\Models\Order;
use Livewire\Component;

class OrderModalDetail extends Component
{
    public $orderId;
    public $customer_name;
    public $table_number;
    public $selectedStatus;
    public $selectedOrderType = 'dine_in';
    public $selectedPaymentType = 'cash';
    public $payment_amount;
    public $items = [];

    protected $listeners = ['openModalDetail' => 'loadOrder'];

    public function loadOrder($orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            $this->orderId = $order->id;
            $this->customer_name = $order->customer_name;
            $this->table_number = $order->table_number;
            $this->selectedStatus = $order->status;
            $this->selectedOrderType = $order->order_type;
            $this->selectedPaymentType = $order->payment_type;
            $this->payment_amount = $order->payment_amount;
            $this->items = json_decode($order->items, true);

            $this->dispatch('open-modal-detail');
        }

    }

    public function payOrder()
    {
        $this->selectedStatus = 'in progress';
        $this->updateOrder();
    }

    public function updateOrder()
    {
        $this->validate([
            'customer_name' => 'required',
            'table_number' => 'required|integer',
            'selectedStatus' => 'required',
            'selectedOrderType' => 'required',
            'selectedPaymentType' => 'required',
        ]);

        $order = Order::find($this->orderId);
        $order->customer_name = $this->customer_name;
        $order->table_number = $this->table_number;
        $order->order_type = $this->selectedOrderType;
        $order->payment_type = $this->selectedPaymentType;
        $order->payment_amount = $this->payment_amount;
        $order->status = $this->selectedStatus;
        $order->items = $this->items;

        if (isset($this->items['subtotal'])) {
            $order->gross_amount = $this->items['subtotal'];
        } else {
            $order->gross_amount = collect($this->items)->sum(function($item) {
                return $item['price'] * $item['qty'];
            });
        }

        $order->save();

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->dispatch('close-modal-detail');

        $this->reset([
            'orderId',
            'customer_name',
            'table_number',
            'selectedOrderType',
            'selectedPaymentType',
            'selectedStatus',
            'payment_amount',
            'items',
        ]);
    }

    public function render()
    {
        return view('livewire.employee.order.order-modal-detail');
    }
}
