<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PipeiroCadastrarFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cpf' => ['required', 'unique:pipeiro_users'],
            'nome' => ["required"],
            'email' => ['required', 'email', 'unique:pipeiro_users'],
            'password' => ['required']
        ];
    }
}
