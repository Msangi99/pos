<?php

namespace App\Livewire\Cashier;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Sale;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $todaySalesCount;
    public $todaySalesTotal;

    public function mount()
    {
        $todaySales = Sale::where('tenant_id', auth()->user()->tenant_id)
            ->where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->get();

        $this->todaySalesCount = $todaySales->count();
        $this->todaySalesTotal = $todaySales->sum('total_amount');
    }

    public function render()
    {
        return view('livewire.cashier.dashboard');
    }
}