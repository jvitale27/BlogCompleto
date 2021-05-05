<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Navigation extends Component
{
    public function render()
    {
    	$categories = Category::all();

    	//retorno la vista de livewire que esta en resources\views\livewire\navigation.blade.php
        return view('livewire.navigation', compact('categories'));
    }
}
