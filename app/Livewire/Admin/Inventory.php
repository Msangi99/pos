<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Category;

#[Layout('components.layouts.app')]
class Inventory extends Component
{
    public $products;
    public $categories;
    
    // List Properties
    public $selected = [];
    public $selectAll = false;

    // Form Properties
    public $showCreateModal = false;
    public $isEditMode = false;
    public $productId = null;
    
    public $name = '';
    public $category_id = '';
    public $price = '';
    public $buy_price = '';
    public $stock = '';

    protected $rules = [
        'name' => 'required|min:3',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'buy_price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->products->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function loadData()
    {
        $this->products = Product::where('tenant_id', auth()->user()->tenant_id)
            ->with('category')
            ->latest()
            ->get();
            
        $this->categories = Category::where('tenant_id', auth()->user()->tenant_id)->get();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->showCreateModal = true;
    }

    public function edit($id)
    {
        $product = Product::where('tenant_id', auth()->user()->tenant_id)->find($id);
        
        if ($product) {
            $this->productId = $id;
            $this->name = $product->name;
            $this->category_id = $product->category_id;
            $this->price = $product->price;
            $this->buy_price = $product->buy_price;
            $this->stock = $product->stock;
            
            $this->isEditMode = true;
            $this->showCreateModal = true;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            $product = Product::where('tenant_id', auth()->user()->tenant_id)->find($this->productId);
            $product->update([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'price' => $this->price,
                'buy_price' => $this->buy_price,
                'stock' => $this->stock,
            ]);
        } else {
            Product::create([
                'tenant_id' => auth()->user()->tenant_id,
                'name' => $this->name,
                'category_id' => $this->category_id,
                'price' => $this->price,
                'buy_price' => $this->buy_price,
                'stock' => $this->stock,
                'image' => null, // Placeholder
            ]);
        }

        $this->resetForm();
        $this->showCreateModal = false;
        $this->loadData();
    }

    public function resetForm()
    {
        $this->reset(['name', 'category_id', 'price', 'buy_price', 'stock', 'productId', 'isEditMode', 'showCreateModal']);
    }

    // ... duplicate selected was here ...
}
