<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'category' => 'required | string | in:Urban Plot,Upcountry Plot,House,Apartment',
            'ownersName' => 'required | string',
            'location' => 'required | string',
            'propertyValuation' => 'required | numeric',
            'images' => 'required | array | size:4',
            'images.*' => 'required | image | mimes:jpeg, png, jpg, pdf | max:10240'
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'You must select the category of the property',
            'ownersName.required' => 'You must enter the name of the owner of the property',
            'location.required' => 'You must enter the location of the property',
            'propertyValuation.required' => 'You must enter the price of the property',

            'images.required' => 'Property images are required. Please upload exactly 3 images',
            'images.array' => 'Invalid format of the images',
            'images.size' => 'You must upload exactly 3 images, no more, no less.',

            'images.0.required' => 'The first property image is required',
            'images.0.image' => 'The first file must be a valid image',
            'images.0.mimes' => 'The first image must be in JPEG, PNG, JPG or WebP format.',
            'images.0.max' => 'The first image must not exceed 10MB in size',

            'images.1.required' => 'The second property image is required',
            'images.1.image' => 'The second file must be a valid image',
            'images.1.mimes' => 'The second image must be in JPEG, PNG, JPG or WebP format.',
            'images.1.max' => 'The second image must not exceed 10MB in size',

            'images.2.required' => 'The third property image is required',
            'images.2.image' => 'The third file must be a valid image',
            'images.2.mimes' => 'The third image must be in JPEG, PNG, JPG or WebP format.',
            'images.2.max' => 'The third image must not exceed 10MB in size'
        ];
    }
}
