<?php

namespace App\Livewire\Cashier;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Pos extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $cart = [];

    public function mount()
    {
        $this->categories = Category::where('tenant_id', auth()->user()->tenant_id)->get();
        if ($this->categories->isNotEmpty()) {
            $this->selectedCategory = $this->categories->first()->id;
        }
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
    }

    public $showApprovalModal = false;
    public $managerPin = '';
    public $itemToRemove = null;

    // ... existing addToCart ...

    public function removeFromCart($productId)
    {
        // If Cashier, require Approval
        if (auth()->user()->role === 'cashier') {
            $this->itemToRemove = $productId;
            $this->showApprovalModal = true;
            return;
        }

        $this->forcedRemoveFromCart($productId);
    }

    public function verifyPin()
    {
        // Simulated Manager PIN (In real app, check against Manager users)
        if ($this->managerPin === '7890') {
            $this->forcedRemoveFromCart($this->itemToRemove);
            $this->closeModal();
        } else {
            $this->addError('managerPin', 'Invalid PIN');
        }
    }

    public function closeModal()
    {
        $this->showApprovalModal = false;
        $this->managerPin = '';
        $this->itemToRemove = null;
    }

    public function forcedRemoveFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
            } else {
                unset($this->cart[$productId]);
            }
        }
    }

    public function getSubtotalProperty()
    {
        return collect($this->cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function getTaxProperty()
    {
        return $this->subtotal * 0.18; // 18% VAT
    }

    public function getTotalProperty()
    {
        return $this->subtotal + $this->tax;
    }

    public function charge()
    {
        if (empty($this->cart)) {
            return;
        }

        \Illuminate\Support\Facades\DB::transaction(function () {
            // 1. Create Sale
            $sale = \App\Models\Sale::create([
                'tenant_id' => auth()->user()->tenant_id,
                'user_id' => auth()->id(),
                'sale_number' => 'ORD-' . strtoupper(uniqid()),
                'subtotal' => $this->subtotal,
                'tax' => $this->tax,
                'total_amount' => $this->total,
                'payment_method' => 'cash', // Default for now
                'status' => 'pending',
            ]);

            // 2. Create Sale Items & Update Stock
            foreach ($this->cart as $item) {
                \App\Models\SaleItem::create([
                    'tenant_id' => auth()->user()->tenant_id,
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Decrement Stock
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }
        });

        // 3. Clear Cart & Flash Success
        $this->cart = [];
        session()->flash('success', 'Transaction Completed!');
    }

    public function render()
    {
        $products = Product::where('tenant_id', auth()->user()->tenant_id)
            ->where('category_id', $this->selectedCategory)
            ->get();

        return view('livewire.cashier.pos', [
            'products' => $products
        ]);
    }
}
