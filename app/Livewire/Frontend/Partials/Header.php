<?php

namespace App\Livewire\Frontend\Partials;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\CartService;

class Header extends Component
{
    public $currentLanguage = 'en';
    public $cartCount = 0;
    public $isMenuOpen = false;
    
    /* public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    } */
    
    public function mount()
    {
        $this->currentLanguage = App::getLocale();
        $this->cartCount = 0;//$this->cartService->count();
    }
    
    public function toggleLanguage()
    {
        $newLocale = $this->currentLanguage === 'en' ? 'fr' : 'en';
        $this->currentLanguage = $newLocale;
        
        session()->put('locale', $newLocale);
        App::setLocale($newLocale);
        
        $this->dispatch('localeChanged');
    }
    
    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }
    
    #[On('cartUpdated')]
    public function updateCartCount($count)
    {
        $this->cartCount = $count;
    }
    
    public function render()
    {
        return view('livewire.frontend.partials.header');
    }
}

