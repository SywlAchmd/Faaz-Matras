<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use LivewireUI\Modal\ModalComponent;

class MenuDetail extends Component
{

    public $name;
    public $menu;
    public $qty = 1;
    public $note = '';

    public function mount(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function updatedNote($value)
    {
        $this->note = $value;
    }

    public function addToCart()
    {
        $cart = Session::get('cart', []);

        // Menambahkan item baru ke keranjang dengan detail yang diberikan pengguna
        $cart[$this->menu->id] = [
            'menu_id' => $this->menu->id,
            'name' => $this->menu->name,
            'price' => $this->menu->price,
            'qty' => $this->qty,
            'note' => $this->note,
        ];

        Session::put('cart', $cart);

        // Panggil event cartUpdated untuk memberi tahu komponen lain yang mendengarkan bahwa keranjang telah diperbarui
        // $this->dispatch('cartUpdated');

        $this->dispatch('close-modal');

        $this->dispatch('show-toast');
    }

    public function increaseQty()
    {
        $this->qty++;
    }

    public function decreaseQty()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }

    

    public function render()
    {
        return view('livewire.customer.menu-detail');
    }
}
