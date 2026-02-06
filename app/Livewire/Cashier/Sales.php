<?php

namespace App\Livewire\Cashier;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Sale;

#[Layout('components.layouts.app')]
class Sales extends Component
{
    public $sales;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->sales = Sale::where('tenant_id', auth()->user()->tenant_id)
            ->where('user_id', auth()->id()) // Scope to current cashier
            ->with(['items.product']) // Eager load relations
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.cashier.sales');
    }
}
