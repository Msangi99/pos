<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Sale;

#[Layout('components.layouts.app')]
class Sales extends Component
{
    public $pendingSales;
    public $completedSales;
    public $cancelledSales;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $tenantId = auth()->user()->tenant_id;

        $this->pendingSales = Sale::where('tenant_id', $tenantId)
            ->where('status', 'pending')
            ->with(['user', 'items.product'])
            ->latest()
            ->get();

        $this->completedSales = Sale::where('tenant_id', $tenantId)
            ->where('status', 'completed')
            ->with(['user', 'items.product'])
            ->latest()
            ->get();

        $this->cancelledSales = Sale::where('tenant_id', $tenantId)
            ->whereIn('status', ['rejected', 'voided', 'refunded'])
            ->with(['user', 'items.product'])
            ->latest()
            ->get();
    }

    public function approve($id)
    {
        $sale = Sale::where('tenant_id', auth()->user()->tenant_id)->find($id);
        if ($sale) {
            $sale->update(['status' => 'completed']);
            $this->loadData();
            session()->flash('message', 'Sale approved successfully.');
        }
    }

    public function reject($id)
    {
        $sale = Sale::where('tenant_id', auth()->user()->tenant_id)->find($id);
        if ($sale) {
            $sale->update(['status' => 'rejected']);
            // Optionally restore stock here if needed
            $this->loadData();
            session()->flash('message', 'Sale rejected.');
        }
    }

    public function render()
    {
        return view('livewire.admin.sales');
    }
}
