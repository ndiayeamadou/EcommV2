<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.app-front")]
class ThankYou extends Component
{
    public function render()
    {
        return view('livewire.frontend.thank-you');
    }
}
