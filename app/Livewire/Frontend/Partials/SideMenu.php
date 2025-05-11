<?php

namespace App\Livewire\Frontend\Partials;

use App\Models\Category;
use Livewire\Component;

class SideMenu extends Component
{
    public $isOpen = false;
    public $currentLanguage = 'en';
    
    public function mount($currentLanguage = 'en')
    {
        $this->currentLanguage = $currentLanguage;
    }
    
    public function toggleSidebar()
    {
        $this->isOpen = !$this->isOpen;
    }
    
    public function toggleLanguage()
    {
        $this->dispatch('toggleLanguage');
    }
    
    public function render()
    {
        $categories = Category::where('is_active', true)->orderBy('created_at')->take(5)->get();
        
        return view('livewire.frontend.partials.side-menu', [
            'categories' => $categories
        ]);
    }
}

