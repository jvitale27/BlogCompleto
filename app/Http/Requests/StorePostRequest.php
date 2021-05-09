<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        if($this->user_id == auth()->user()->id)
            return true;                            //si el usuario que devuelve el formulario es el identificado
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    
       $rules = [                                  //validacion del request
            'name'   => 'required',
            'slug'   => 'required|unique:posts',
            'status' => 'required|in:1,2'
        ];

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
