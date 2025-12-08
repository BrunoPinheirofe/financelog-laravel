<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTransactionRequest extends FormRequest
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
            'type' => 'nullable|sometimes|in:income,expense',
            'start_date' => 'nullable|sometimes|date',
            'end_date' => 'nullable|sometimes|date|after_or_equal:start_date',
            'year' => 'nullable|sometimes|integer|min:1900|max:2100',
            'month' => 'nullable|sometimes|integer|min:1|max:12',
            'search'=>'nullable|string|max:255',
        ];
    }
}
