<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
/*       
        Lo siguiente debe acompaniarse con el agregado de {!! Form::hidden('user_id', auth()->user()->id) !!}
        en el formulario de Create y Edit, o en la plantilla form comun a mabos.
        Aunque solo es necesario en la plantilla Create lo debo agregar en las dos porque este PostRequest es para ambos
        Si lo resuelvo con un Observer puedo eliminar este chequeo de aqui
        if($this->user_id == auth()->user()->id)    //si el usuario que devuelve el formulario es el identificado
            return true;                            
        else
            return false;
*/
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    
        $post = $this->route()->parameter('post');  //recupero la variable post desde el formulario

       $rules = [                                  //validacion del request
            'name'   => 'required',
            'slug'   => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'file'   => 'image'                 //en caso de existir, debe ser de tipo 'image'
        ];

        //si vengo desde el formulario editar, el posts ya tiene slug y puedo repetirlo. No lo valido
        if($post)
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;

        if($this->status == 2){
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags'        => 'required',
                'extract'     => 'required',
                'body'        => 'required',
            ]);
        }

        return $rules;
    }
}
