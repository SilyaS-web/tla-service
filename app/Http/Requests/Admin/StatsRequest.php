<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start' => 'nullable|date',
            'end' => 'nullable|date|after:start',
        ];
    }

    public function messages(): array
    {
        return [
            'start.date' => 'Поле "Начальная дата" должно быть корректной датой.',
            'end.date' => 'Поле "Конечная дата" должно быть корректной датой.',
            'end.after' => 'Поле "Конечная дата" должно быть позже, чем "Начальная дата".',
        ];
    }

    public function attributes(): array
    {
        return [
            'start' => 'Начальная дата',
            'end' => 'Конечная дата',
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
