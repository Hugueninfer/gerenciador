<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     public function authorize(): bool
     {
         return true; 
     }
 
     public function rules(): array
     {
         return [
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:students,email',
         ];
     }
 
     public function messages()
     {
         return [
             'name.required' => 'O campo nome é obrigatório.',
             'name.string' => 'O nome deve ser um texto válido.',
             'email.required' => 'O campo e-mail é obrigatório.',
             'email.email' => 'O e-mail deve ser um e-mail válido.',
             'email.unique' => 'Este e-mail já está cadastrado.',
         ];
     }
}
