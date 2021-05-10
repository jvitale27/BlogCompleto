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
//        return false;
/*        if($this->user_id == auth()->user()->id)
            return true;                            //si el usuario que devuelve el formulario es el identificado
        else
            return false;*/

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
