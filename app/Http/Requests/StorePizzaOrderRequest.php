<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePizzaOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * Here I would be checking if the request header incluces a valid token
         * that had been set somenwhere.  Probably encrypted in a database table.
         *
         * I haven't implemented that, as it is assumed the POS can talk to this application
         * and for the purpose of this exercise, I am not going to implement that.
         *
         * It would also be worth checking if the request is coming from a valid IP address
         *
         * For now, we would let all requests through.
         *
         * I would also think about putting that authentication on the route itself on a middleware
         */

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
            'order_number' => 'required|string',
            'pizza'        => 'required|array',
            'pizza.*.type' => 'required|string',
            'pizza.*.size' => 'required|string',

        ];
    }
}
