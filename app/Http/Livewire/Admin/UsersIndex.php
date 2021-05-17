<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersIndex extends Component
{
	use WithPagination;			//clase para paginar en Livewire

	//debido a que Livewire usa Tailwind, pero AdminLTE usa bootstrap, debo decirle a Livewire que use los estilos
	//de bootstrap porque los otros se ven muy feos
	protected $paginationTheme = 'bootstrap';

    public $search;             //propiedad que va a estar vinculada(cableada) al campo de busqueda

    public function updatingSearch(){   //se ejecuta automaticamente cada vez que cambia la vble $search
        $this->resetPage();             //en cada busqueda vuelve a la pagina 1
    }

    public function render()
    {
    	$users = User::where('name', 'LIKE', '%' . $this->search . '%')
    					->orWhere('email', 'LIKE', '%' . $this->search . '%')
    					->paginate(8);

    	//retorno la vista de livewire que esta en resources\views\livewire\Admin\users-index.blade.php
        return view('livewire.admin.users-index', compact('users'));
    }
}
