<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;        //clase para paginar en Livewire

class UsersIndex extends Component
{
	use WithPagination;			//clase para paginar en Livewire, solo refresca este componente

	//debido a que Livewire usa Tailwind, pero AdminLTE usa bootstrap, debo decirle a Livewire que use los estilos
	//de bootstrap porque los otros se ven muy feos
	protected $paginationTheme = 'bootstrap';

    public $search;             //propiedad que va a estar vinculada(cableada) al campo de busqueda

//  public function updating(){       //se ejecuta automaticamente cada vez que cambia de valor cualquier propiedad
//  public function updatingPost(){   //se ejecuta automaticamente cada vez que cambia de valor la propiedad $post
    public function updatingSearch(){   //se ejecuta automaticamente cada vez que cambia la propiedad $search
        $this->resetPage();             //en cada busqueda vuelve a la pagina 1
    }

    //funcion que se ejecuta automaticamente cada vez que cambia algo del componente, una propiedad, etc.
    public function render()
    {
    	$users = User::where('name', 'LIKE', '%' . $this->search . '%')
    					->orWhere('email', 'LIKE', '%' . $this->search . '%')
    					->paginate(8);

    	//retorno la vista de livewire que esta en resources\views\livewire\Admin\users-index.blade.php
        return view('livewire.admin.users-index', compact('users'));
    }
}
