<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;
    
    // List filters and sorting
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $perPage = 10;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }
    
    public function updatingStatusFilter() 
    {
        $this->resetPage();
    }
    
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function render()
    {
        $query = Product::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('sku', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                return $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter !== '', function ($query) {
                return $query->where('is_active', $this->statusFilter == 'active');
            })
            ->orderBy($this->sortField, $this->sortDirection);
        
        $products = $query->paginate($this->perPage);
        
        $categories = Category::orderBy('name')->get();
        
        return view('livewire.admin.product.products-list', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}

