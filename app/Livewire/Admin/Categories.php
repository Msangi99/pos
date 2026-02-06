<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Category;

#[Layout('components.layouts.app')]
class Categories extends Component
{
    public $categories;
    
    // List Properties
    public $selected = [];
    public $selectAll = false;

    // Form Properties
    public $showCreateModal = false;
    public $isEditMode = false;
    public $categoryId = null;
    public $name = '';
    public $icon = '';

    protected $rules = [
        'name' => 'required|min:3',
        'icon' => 'required',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->categories = Category::where('tenant_id', auth()->user()->tenant_id)
            ->latest()
            ->get();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->showCreateModal = true;
    }

    public function openEditModal($id)
    {
        $category = Category::where('tenant_id', auth()->user()->tenant_id)->find($id);
        if ($category) {
            $this->categoryId = $id;
            $this->name = $category->name;
            $this->icon = $category->icon;
            $this->isEditMode = true;
            $this->showCreateModal = true;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            $category = Category::where('tenant_id', auth()->user()->tenant_id)->find($this->categoryId);
            $category->update([
                'name' => $this->name,
                'icon' => $this->icon,
            ]);
        } else {
            Category::create([
                'tenant_id' => auth()->user()->tenant_id,
                'name' => $this->name,
                'icon' => $this->icon,
            ]);
        }

        $this->resetForm();
        $this->showCreateModal = false;
        $this->loadData();
    }

    public function delete($id)
    {
        $category = Category::where('tenant_id', auth()->user()->tenant_id)->find($id);

        if ($category) {
            $category->delete();
            $this->loadData();
        }
    }

    public function deleteSelected()
    {
        Category::where('tenant_id', auth()->user()->tenant_id)
            ->whereIn('id', $this->selected)
            ->delete();

        $this->selected = [];
        $this->selectAll = false;
        $this->loadData();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->categories->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'icon', 'categoryId', 'isEditMode', 'showCreateModal']);
    }

    public function render()
    {
        return view('livewire.admin.categories');
    }
}
