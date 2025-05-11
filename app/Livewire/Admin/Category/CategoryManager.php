<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryManager extends Component
{
    use WithPagination, WithFileUploads;

    public $name;
    public $slug;
    public $description;
    public $parent_id;
    public $is_active = true;
    public $image;
    public $tempImage;
    
    public $category_id;
    public $editMode = false;
    
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required|unique:categories,slug',
        'description' => 'nullable',
        'parent_id' => 'nullable|exists:categories,id',
        'is_active' => 'boolean',
        'image' => 'nullable|image|max:1024', // 1MB max
    ];
    
    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
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
    
    public function create()
    {
        $this->validate();
        
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->description = $this->description;
        $category->parent_id = $this->parent_id;
        $category->is_active = $this->is_active;
        
        /* if ($this->image) {  // does not work
            $filename = Str::slug($this->name) . '-' . time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/categories', $filename);
            $category->image = 'categories/' . $filename;
        } */
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('categories' ,'public');
        }

        $category->image = $imagePath;
        
        $category->save();
        
        $this->reset(['name', 'slug', 'description', 'parent_id', 'is_active', 'image']);
        session()->flash('success', 'Category created successfully.');
    }
    
    public function edit($id)
    {
        $this->resetValidation();
        $this->editMode = true;
        $this->category_id = $id;
        
        $category = Category::find($id);
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->is_active = $category->is_active;
        $this->tempImage = $category->image;
    }
    
    public function update()
    {
        $this->rules['slug'] = 'required|unique:categories,slug,' . $this->category_id;
        $this->validate();
        
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->description = $this->description;
        $category->parent_id = $this->parent_id;
        $category->is_active = $this->is_active;
        
        /* if ($this->image) {  // does not work
            $filename = Str::slug($this->name) . '-' . time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/categories', $filename);
            $category->image = 'categories/' . $filename;
        } */

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('categories' ,'public');
        }

        $category->image = $imagePath;
        
        $category->save();
        
        $this->reset(['name', 'slug', 'description', 'parent_id', 'is_active', 'image', 'tempImage']);
        $this->editMode = false;
        session()->flash('success', 'Category updated successfully.');
    }
    
    public function delete($id)
    {
        $category = Category::find($id);
        
        // Check if category has products or subcategories before deletion
        if ($category->products()->count() > 0) {
            session()->flash('error', 'Cannot delete category with associated products.');
            return;
        }
        
        if ($category->children()->count() > 0) {
            session()->flash('error', 'Cannot delete category with subcategories.');
            return;
        }
        
        $category->delete();
        session()->flash('success', 'Category deleted successfully.');
    }
    
    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
            
        $parentCategories = Category::whereNull('parent_id')->orWhere('id', '!=', $this->category_id)->get();
            
        return view('livewire.admin.category.category-manager', [
            'categories' => $categories,
            'parentCategories' => $parentCategories
        ]);
    }
}

