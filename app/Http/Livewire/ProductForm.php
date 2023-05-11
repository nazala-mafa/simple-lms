<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductForm extends Component
{
    public $modelTitle = 'modal title';
    public $name;

    protected $rules = [
        'name' => 'min:6|required'
    ];

    public function updated($propType)
    {
        $this->validateOnly($propType);
    }

    public function render()
    {
        return view('livewire.product-form');
    }

    public function saveProduct()
    {
        Product::create([
            'name' => $this->name
        ]);
    }
}