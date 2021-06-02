<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Navigation extends Component
{

    //funcion que se ejecuta automaticamente cada vez que cambia algo del componente, una propiedad, etc.
    public function render()
    {
    	$categories = Category::all();

    	//retorno la vista de livewire que esta en resources\views\livewire\navigation.blade.php
        return view('livewire.navigation', compact('categories'));
    }
}
