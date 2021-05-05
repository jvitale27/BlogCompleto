<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
		//retorno la vista que esta en resources\views\layouts\app.blade.php
        return view('layouts.app');
    }
}
