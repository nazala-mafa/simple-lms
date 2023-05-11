<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    public $search = '';
    public $name;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|min:6',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $products = Product::where('name', 'like', "%$this->search%")->paginate(10);

        return view('livewire.products', [
            'products' => $products
        ]);
    }

    public function addProduct()
    {
        $this->validate();

        Product::create([
            'name' => $this->name
        ]);

        $this->emit('render');

        $this->name = '';
    }
}