<?php

namespace App\Livewire\Customer;

use App\Models\Category;
use App\Models\Menu;
use Livewire\Component;
use Livewire\Attributes\Url;

class Order extends Component
{
    public $menus;
    public $category;
    public $search;

    public Menu $selectedMenu;

    #[Url]
    public $table, $orderType;

    protected $queryString = [
        'category' => ['except' => 'semua']
    ];
    public function mount()
    {
        // $this->menus = Menu::all();
        $this->category = request()->query('category', 'semua');
        $this->loadMenus();
    }

    public function menuDetail(Menu $menu)
    {
        $this->selectedMenu = $menu;

        $this->dispatch('open-modal', name: 'menu-detail');
    }

    public function updatedSearch() {
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
            if($activeCategory){
                $query->where('categories_id', $activeCategory->id);
            }
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $this->menus = $query->get();
    }

    public function render()
    {
        return view('livewire.customer.order');
    }
}
