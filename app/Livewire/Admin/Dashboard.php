<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $todayRevenue = 0;
    public $todayOrders = 0;

    public function mount()
    {
        $todaySales = \App\Models\Sale::where('tenant_id', auth()->user()->tenant_id)
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->get();

        $this->todayRevenue = $todaySales->sum('total_amount');
        $this->todayOrders = $todaySales->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
