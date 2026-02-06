<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Reports extends Component
{
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = \Carbon\Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $sales = \App\Models\Sale::where('tenant_id', auth()->user()->tenant_id)
            ->whereBetween('created_at', [
                $this->startDate . ' 00:00:00', 
                $this->endDate . ' 23:59:59'
            ])
            ->where('status', 'completed')
            ->with(['user', 'items.product'])
            ->latest()
            ->get();

        $totalSellPrice = 0;
        $totalBuyPrice = 0;

        foreach ($sales as $sale) {
            $totalSellPrice += $sale->total_amount;
            
            foreach ($sale->items as $item) {
                // Calculate buy price using current product cost
                // Note: If product is deleted, buy_price defaults to 0 to avoid errors
                $buyPrice = $item->product->buy_price ?? 0;
                $totalBuyPrice += $item->quantity * $buyPrice;
            }
        }

        $totalProfit = $totalSellPrice - $totalBuyPrice;

        return view('livewire.admin.reports', [
            'sales' => $sales,
            'totalSellPrice' => $totalSellPrice,
            'totalBuyPrice' => $totalBuyPrice,
            'totalProfit' => $totalProfit,
        ]);
    }
}
