<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'category' => 'required | string',
            'ownersName' => 'required | string',
            'location' => 'required | string',
            'propertyValuation' => 'required | numeric',
         ];
    }

    public function messages()
    {
        return [
            'category.required' => 'You must select the category of the property',
            'ownersName.required' => 'You must enter the name of the owner of the property',
            'location.required' => 'You must enter the location of the property',
            'propertyValuation.required' => 'You must enter the price of the property',
        ];
    }
}
