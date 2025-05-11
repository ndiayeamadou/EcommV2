<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Home - E-commerce Store')]
#[Layout('components.layouts.app-front')]
class HomePage extends Component
{
    public $featuredProducts = [];
    public $categories = [];
    public $trendingProducts = [];
    public $partners = [];
    public $email = '';
    public $currentLanguage = 'en';
    
    public function mount()
    {
        $this->currentLanguage = App::getLocale();
        $this->loadHomePageData();
    }
    
    private function loadHomePageData()
    {
        // Load featured products
        $this->featuredProducts = Product::where('is_featured', true)
            ->with(['category', 'primaryImage'])
            ->take(4)
            ->get();
            
        // Load categories
        $this->categories = Category::where('is_active', true)
            //->orderBy('position')
            ->get();
            
        // Load trending products for the slider
        //$this->trendingProducts = Product::orderBy('views', 'desc')
        $this->trendingProducts = Product::orderBy('name', 'desc')
            ->with(['category', 'primaryImage'])
            ->take(8)
            ->get();
            
        // Load partners
        /* $this->partners = \App\Models\Partner::where('active', true)
            ->orderBy('position')
            ->take(5)
            ->get(); */
    }
    
    public function switchLanguage()
    {
        $newLocale = $this->currentLanguage === 'en' ? 'fr' : 'en';
        $this->currentLanguage = $newLocale;
        
        session()->put('locale', $newLocale);
        App::setLocale($newLocale);
        
        $this->dispatch('localeChanged');
    }
    
    public function subscribeNewsletter()
    {
        $this->validate([
            'email' => 'required|email|max:255',
        ]);
        
        try {
            // Store subscriber in database
            \App\Models\Subscriber::create([
                'email' => $this->email,
                'status' => 'active',
                'subscribed_at' => now(),
            ]);
            
            $this->dispatch('notify', [
                'title' => __('newsletter.success_title'),
                'message' => __('newsletter.success_message'),
                'type' => 'success',
            ]);
            
            $this->email = '';
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'title' => __('newsletter.error_title'),
                'message' => __('newsletter.error_message'),
                'type' => 'error',
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.frontend.home-page');
    }
}

