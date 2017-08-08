<?php

namespace CodeFlix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCpfRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validationData()
    {
        $cpf = preg_replace("/[^0-9]/", "", $this->get('cpf'));
        $this->replace([
            'cpf' => $cpf
        ]);
        return parent::validationData();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => [
                'required',
                'cpf',
                Rule::unique('users', 'cpf')->ignore($this->user('api')->id)
            ]
        ];
    }
}
