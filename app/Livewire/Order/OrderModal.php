<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class OrderModal extends Component
{

    public $customer_name;
    public $table_number;
    public $selectedOrderType = 'dine_in';
    public $selectedPaymentType = 'cash';
    public $payment_amount;

    public function render()
    {
        return view('livewire.employee.order.order-modal');
    }

    public function saveOrder($items, $status = 'pending')
    {
        $this->validate([
            'customer_name' => 'required',
            'table_number' => 'required|integer',
            'selectedOrderType' => 'required',
            'selectedPaymentType' => 'required',
        ]);


        // Create a new order instance
        $order = new Order();
        $order->customer_name = $this->customer_name;
        $order->table_number = $this->table_number;
        $order->order_type = $this->selectedOrderType;
        $order->payment_type = $this->selectedPaymentType;
        $order->payment_amount = $this->payment_amount;
        $order->status = $status;
        $order->items = json_encode($items);
        $order->gross_amount = json_encode($items['subtotal']);
        $order->save();

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->dispatch('close-modal');

        $this->reset([
            'customer_name',
            'table_number',
            'selectedOrderType',
            'selectedPaymentType',
            'payment_amount',
            // 'items',
        ]);
    }
}
