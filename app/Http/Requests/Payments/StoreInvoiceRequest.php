<?php

namespace App\Http\Requests\Payments;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreInvoiceRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1000',
            'account_number' => 'required|numeric|min:1000',
            'payer_name' => 'required|string',
            'payer_inn' => 'required|numeric|min:1000',
            'payer_kpp' => 'nullable|numeric|min:1000',
            'contact_email' => 'nullable|string',
            'contact_phone' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'amount' => 'Сумма пополнения',
            'account_number' => 'Рублевый расчетный счет отправителя',
            'payer_name' => 'Наименование плательщика',
            'payer_inn' => 'ИНН плательщика',
            'payer_kpp' => 'КПП плательщика',
            'contact_email' => 'Электронная почта',
            'contact_phone' => 'Номер мобильного телефона, на который придет СМС-сообщение со счетом',
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
