<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $category;
    public $menus;
    public $search;
    public $items = [];

    
    protected $queryString = [
        'category' => ['except' => 'semua']
    ];
    
    public function mount()
    {
        $this->category = request()->query('category', 'semua');
        $this->loadMenus();
    }

    public function updatedSearch()
    {
        $this->loadMenus();
    }

    public function setCategory($currentCategory)
    {
        $this->category = $currentCategory;
        $this->loadMenus();
    }

    public function loadMenus()
    {
        $query = Menu::query()->where('status', true);

        if ($this->category !== 'semua') {
            $activeCategory = Category::where('name', $this->category)->first();
            $query->where('categories_id', $activeCategory->id);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // $this->menus = $query->get();
        $this->menus = $query->with('media')->get();
    }

    public function addItem($menuId)
    {
        $menu = Menu::findOrFail($menuId);

        if (isset($this->items[$menu->id])) {
            $item = $this->items[$menu->id];

            $this->items[$menu->id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'qty' => $item['qty'] + 1,
                'price' => $menu->price,
                'note' => $item['note']
            ];
        } else {
            $this->items[$menu->id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'qty' => 1,
                'price' => $menu->price,
                'note' => ''
            ];
        }
    }

    public function increaseQuantity($id)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['qty']++;
        }
    }

    public function decreaseQuantity($id)
    {
        if (isset($this->items[$id]) && $this->items[$id]['qty'] > 1) {
            $this->items[$id]['qty']--;
        } elseif (isset($this->items[$id]) && $this->items[$id]['qty'] === 1) {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }

    public function updateNote($id, $note)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['note'] = $note;
        }
    }

    public function clearItems()
    {
        $this->items = [];
    }

    public function getHasItemsProperty()
    {
        return !empty($this->items);
    }

    public function getSubtotalProperty()
    {
        $subtotal = 0;

        foreach ($this->items as $item) {
            $subtotal += $item['qty'] * $item['price'];
        }

        return $subtotal;
    }

    public function getTotalItemsProperty()
    {
        return array_sum(array_column($this->items, 'qty'));
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.employee.home', [
            'menus' => $this->menus,
            'subtotal' => $this->subtotal,
            'totalItems' => $this->totalItems,
            'hasItems' => $this->hasItems
        ]);
    }
}
