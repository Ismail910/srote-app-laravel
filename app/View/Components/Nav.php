<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{

    public $items;
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct($context = 'side')
    {
        $this->items =config('nav');
        $this->active = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // if $items is public attribute you not need to 
        // pass it in this method but if it not public you most pass it to the view

        return view('components.nav');
       
    }
}
