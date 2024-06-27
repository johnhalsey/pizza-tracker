<?php

namespace App\Http\Requests;

use App\PizzaStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePizzaStatusRequest extends FormRequest
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
            'status' => [
                'required',
                'string',
                'in:' . implode(',', array_column(PizzaStatus::cases(), 'value'))
            ]
        ];
    }
}
