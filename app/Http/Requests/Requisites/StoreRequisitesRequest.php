<?php

namespace App\Http\Requests\Requisites;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRequisitesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
     {
        return [
            'name' => 'required|string',
            'inn' => 'required|numeric|min:1000',
            'kpp' => 'nullable|numeric|min:1000',
            'bik' => 'required|numeric|min:1000',
            'bankName' => 'required|string',
            'corrAccountNumber' => 'required|numeric|min:1000',
            'accountNumber' => 'required|numeric|min:1000',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Получатель',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'bik' => 'БИК',
            'bankName' => 'Наименование банка получателя',
            'corrAccountNumber' => 'Корреспондентский счет банка получателя',
            'accountNumber' => 'Номер расчетного счета',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
